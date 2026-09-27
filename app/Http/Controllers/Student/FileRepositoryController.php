<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\File;
use App\Models\FileFolder;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileRepositoryController extends Controller
{
    /**
     * Display the shared file repository.
     */
    public function index(Request $request, $classId)
    {
        $student = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Verify student belongs to the class
        |--------------------------------------------------------------------------
        */

        $class = ClassRoom::whereKey($classId)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Get student's group
        |--------------------------------------------------------------------------
        */

        $group = $student->groups()
            ->where('class_room_id', $classId)
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Student must belong to a group
        |--------------------------------------------------------------------------
        */

        if (!$group) {
            return view('student.file-repository', [
                'class' => $class,
                'group' => null,
                'project' => null,
                'folders' => collect(),
                'files' => collect(),
                'currentFolder' => null,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Get the selected project
        |--------------------------------------------------------------------------
        */

        $projectId = $request->query('project');

        $project = null;

        if ($projectId) {
            $project = $group->projects()
                ->where('projects.class_room_id', $classId)
                ->where('projects.id', $projectId)
                ->first();
        }

        /*
        |--------------------------------------------------------------------------
        | If no project selected, use latest project
        |--------------------------------------------------------------------------
        */

        if (!$project) {
            $project = $group->projects()
                ->where('projects.class_room_id', $classId)
                ->latest()
                ->first();
        }

        /*
        |--------------------------------------------------------------------------
        | Current folder
        |--------------------------------------------------------------------------
        */

        $folderId = $request->query('folder');

        $currentFolder = null;

        if ($folderId) {
            $currentFolder = FileFolder::where('id', $folderId)
                ->where('class_room_id', $classId)
                ->where('group_id', $group->id)
                ->when(
                    $project,
                    fn ($query) =>
                        $query->where('project_id', $project->id)
                )
                ->firstOrFail();
        }

        /*
        |--------------------------------------------------------------------------
        | Get folders
        |--------------------------------------------------------------------------
        */

        $folders = FileFolder::where('class_room_id', $classId)
            ->where('group_id', $group->id)
            ->when(
                $project,
                fn ($query) =>
                    $query->where('project_id', $project->id)
            )
            ->where(
                'parent_id',
                $currentFolder?->id
            )
            ->withCount('files')
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Get files
        |--------------------------------------------------------------------------
        */

        $files = File::where('class_room_id', $classId)
            ->where('group_id', $group->id)
            ->when(
                $project,
                fn ($query) =>
                    $query->where('project_id', $project->id)
            )
            ->where(
                'folder_id',
                $currentFolder?->id
            )
            ->with('uploader')
            ->latest()
            ->get();

        return view('student.file-repository', compact(
            'class',
            'group',
            'project',
            'folders',
            'files',
            'currentFolder'
        ));
    }

    /**
     * Upload a file.
     */
    public function upload(Request $request, $classId)
    {
        $student = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Verify class membership
        |--------------------------------------------------------------------------
        */

        $class = ClassRoom::whereKey($classId)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Find student's group
        |--------------------------------------------------------------------------
        */

        $group = $student->groups()
            ->where('class_room_id', $classId)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Validate upload
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'file' => [
                'required',
                'file',
                'max:51200', // 50 MB
            ],

            'project_id' => [
                'nullable',
                'integer',
                'exists:projects,id',
            ],

            'folder_id' => [
                'nullable',
                'integer',
                'exists:file_folders,id',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Verify project belongs to group
        |--------------------------------------------------------------------------
        */

        $project = null;

        if (!empty($validated['project_id'])) {
            $project = $group->projects()
                ->where('projects.id', $validated['project_id'])
                ->firstOrFail();
        }

        /*
        |--------------------------------------------------------------------------
        | Verify folder belongs to this group
        |--------------------------------------------------------------------------
        */

        $folder = null;

        if (!empty($validated['folder_id'])) {
            $folder = FileFolder::where('id', $validated['folder_id'])
                ->where('class_room_id', $classId)
                ->where('group_id', $group->id)
                ->firstOrFail();

            /*
            | If a project was selected, the folder must belong
            | to the same project.
            */

            if (
                $project &&
                $folder->project_id !== $project->id
            ) {
                abort(403);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Store physical file
        |--------------------------------------------------------------------------
        */

        $uploadedFile = $request->file('file');

        $storedPath = $uploadedFile->store(
            'shared-repository/' . $classId . '/' . $group->id
        );

        /*
        |--------------------------------------------------------------------------
        | Save file information
        |--------------------------------------------------------------------------
        */

        File::create([
            'class_room_id' => $classId,
            'group_id' => $group->id,
            'project_id' => $project?->id,
            'folder_id' => $folder?->id,
            'uploaded_by' => $student->id,

            'name' => pathinfo(
                $uploadedFile->getClientOriginalName(),
                PATHINFO_FILENAME
            ),

            'original_name' =>
                $uploadedFile->getClientOriginalName(),

            'file_path' => $storedPath,

            'file_type' =>
                $uploadedFile->getClientMimeType(),

            'file_size' =>
                $uploadedFile->getSize(),
        ]);

        return back()->with(
            'success',
            'File uploaded successfully.'
        );
    }

    /**
     * Create a new folder.
     */
    public function createFolder(Request $request, $classId)
    {
        $student = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Verify class membership
        |--------------------------------------------------------------------------
        */

        $class = ClassRoom::whereKey($classId)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Get student's group
        |--------------------------------------------------------------------------
        */

        $group = $student->groups()
            ->where('class_room_id', $classId)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Validate folder
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
            ],

            'project_id' => [
                'nullable',
                'integer',
                'exists:projects,id',
            ],

            'parent_id' => [
                'nullable',
                'integer',
                'exists:file_folders,id',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Verify project
        |--------------------------------------------------------------------------
        */

        $project = null;

        if (!empty($validated['project_id'])) {
            $project = $group->projects()
                ->where('projects.id', $validated['project_id'])
                ->firstOrFail();
        }

        /*
        |--------------------------------------------------------------------------
        | Verify parent folder
        |--------------------------------------------------------------------------
        */

        $parent = null;

        if (!empty($validated['parent_id'])) {
            $parent = FileFolder::where('id', $validated['parent_id'])
                ->where('class_room_id', $classId)
                ->where('group_id', $group->id)
                ->firstOrFail();

            if (
                $project &&
                $parent->project_id !== $project->id
            ) {
                abort(403);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Create folder
        |--------------------------------------------------------------------------
        */

        FileFolder::create([
            'class_room_id' => $classId,
            'group_id' => $group->id,
            'project_id' => $project?->id,
            'parent_id' => $parent?->id,
            'name' => $validated['name'],
            'created_by' => $student->id,
        ]);

        return back()->with(
            'success',
            'Folder created successfully.'
        );
    }

    /**
     * Download a file.
     */
    public function download($classId, $fileId)
    {
        $student = Auth::user();

        /*
        |--------------------------------------------------------------------------
        | Verify class membership
        |--------------------------------------------------------------------------
        */

        $class = ClassRoom::whereKey($classId)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Get student's group
        |--------------------------------------------------------------------------
        */

        $group = $student->groups()
            ->where('class_room_id', $classId)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Find file belonging to the group
        |--------------------------------------------------------------------------
        */

        $file = File::where('id', $fileId)
            ->where('class_room_id', $classId)
            ->where('group_id', $group->id)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Make sure physical file exists
        |--------------------------------------------------------------------------
        */

        abort_unless(
            Storage::exists($file->file_path),
            404,
            'File not found.'
        );

        /*
        |--------------------------------------------------------------------------
        | Download
        |--------------------------------------------------------------------------
        */

        return Storage::download(
            $file->file_path,
            $file->original_name
        );
    }

    /**
     * Delete a file uploaded by the current student.
     */
    public function deleteFile($classId, $fileId)
    {
        $student = Auth::user();

        $group = $student->groups()
            ->where('class_room_id', $classId)
            ->firstOrFail();

        $file = File::where('id', $fileId)
            ->where('class_room_id', $classId)
            ->where('group_id', $group->id)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Only uploader can delete for now
        |--------------------------------------------------------------------------
        */

        abort_if(
            $file->uploaded_by !== $student->id,
            403,
            'You can only delete files that you uploaded.'
        );

        /*
        |--------------------------------------------------------------------------
        | Delete physical file
        |--------------------------------------------------------------------------
        */

        if (Storage::exists($file->file_path)) {
            Storage::delete($file->file_path);
        }

        $file->delete();

        return back()->with(
            'success',
            'File deleted successfully.'
        );
    }

    /**
     * Delete a folder created by the current student.
     */
    public function deleteFolder($classId, $folderId)
    {
        $student = Auth::user();

        $group = $student->groups()
            ->where('class_room_id', $classId)
            ->firstOrFail();

        $folder = FileFolder::where('id', $folderId)
            ->where('class_room_id', $classId)
            ->where('group_id', $group->id)
            ->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Only creator can delete for now
        |--------------------------------------------------------------------------
        */

        abort_if(
            $folder->created_by !== $student->id,
            403,
            'You can only delete folders that you created.'
        );

        /*
        |--------------------------------------------------------------------------
        | Delete files inside folder
        |--------------------------------------------------------------------------
        */

        $files = File::where('folder_id', $folder->id)->get();

        foreach ($files as $file) {
            if (Storage::exists($file->file_path)) {
                Storage::delete($file->file_path);
            }

            $file->delete();
        }

        /*
        |--------------------------------------------------------------------------
        | Delete folder
        |--------------------------------------------------------------------------
        */

        $folder->delete();

        return back()->with(
            'success',
            'Folder deleted successfully.'
        );
    }
}