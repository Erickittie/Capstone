# Study Guide Questions & Answers

This document provides a comprehensive, in-depth reference for key architectural, routing, controller, model, and workflow questions across the system. For every question, it provides the direct answer, the **actual code implementation from the codebase**, and a **detailed line-by-line explanation of how the code functions**.

---

## 1. Which route handles the instructor dashboard?

### Direct Answer
* **Route:** `GET /teacher`
* **Route Name:** `instructor.dashboard`
* **Middleware:** `['auth', 'role:Instructor']`
* **Controller Action:** `InstructorDashboardController@index`
* **View Rendered:** `resources/views/instructor/dashboard.blade.php`

### Actual Code Implementation

#### Route Definition (`routes/web.php`):
```php
Route::middleware(['auth', 'role:Instructor'])->group(function () {
    Route::get(
        '/teacher',
        [InstructorDashboardController::class, 'index']
    )->name('instructor.dashboard');
});
```

#### Controller Implementation (`app/Http/Controllers/InstructorDashboardController.php`):
```php
<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InstructorDashboardController extends Controller
{
    public function index() {
        $classes = ClassRoom::where('Instructor_Id', Auth::id())
            ->latest()
            ->get();

        return view('instructor.dashboard', compact('classes'));
    }
}
```

### Code Functionality Explanation
1. **`Route::middleware(['auth', 'role:Instructor'])`**: Guarantees that only logged-in users whose assigned role is `Instructor` can access this route. Unauthorized users or other roles (e.g., Student, Admin) are blocked by middleware.
2. **`ClassRoom::where('Instructor_Id', Auth::id())`**: Queries the `class_rooms` database table to fetch only the class sections where `Instructor_Id` matches the currently authenticated instructor's ID (`Auth::id()`). This prevents instructors from viewing classes owned by others.
3. **`->latest()`**: Orders the retrieved classes in descending chronological order (most recently created first) using the `created_at` timestamp.
4. **`->get()`**: Executes the SQL query and returns an Eloquent Collection of `ClassRoom` model instances.
5. **`return view('instructor.dashboard', compact('classes'))`**: Loads the Blade view `resources/views/instructor/dashboard.blade.php` and passes the `$classes` collection to it so the frontend can loop through and render each class card.

---

## 2. Which controller loads the class configuration page?

### Direct Answer
* **Controller:** `InstructorClassController` (`app/Http/Controllers/InstructorClassController.php`)
* **Method:** `show($classId)`
* **Route:** `GET /instructor/class/{classId}`
* **Route Name:** `instructor.class.configure`
* **View Rendered:** `resources/views/instructor/course-detail.blade.php`

### Actual Code Implementation

#### Route Definition (`routes/web.php`):
```php
Route::get(
    '/instructor/class/{classId}',
    [InstructorClassController::class, 'show']
)->name('instructor.class.configure');
```

#### Controller Method (`app/Http/Controllers/InstructorClassController.php`):
```php
public function show($classId) {
    $class = ClassRoom::where('id', $classId)
        ->where('Instructor_Id', Auth::id())
        ->with('students')
        ->firstOrFail();

    return view('instructor.course-detail', compact('class'));
}
```

### Code Functionality Explanation
1. **`$classId` parameter**: Receives the target class ID directly from the URL wildcard `{classId}`.
2. **`where('id', $classId)`**: Finds the class record with the matching primary key.
3. **`where('Instructor_Id', Auth::id())`**: Enforces strict tenant ownership check. Even if an instructor modifies the URL parameter to another existing class ID, the query will fail if they are not the assigned instructor.
4. **`->with('students')`**: Preloads all enrolled students in a single query (Eager Loading) to make the page load faster and avoid performance slowdowns.
5. **`->firstOrFail()`**: Returns the single `ClassRoom` model instance if found, or automatically throws a `404 Not Found` HTTP exception if no record matches both conditions.
6. **`return view('instructor.course-detail', compact('class'))`**: Renders `course-detail.blade.php`, supplying the classroom model along with its pre-loaded student roster.

---

## 3. Which controller handles roster import?

### Direct Answer
* **Controller:** `InstructorClassController` (`app/Http/Controllers/InstructorClassController.php`)
* **Method:** `importRoster(Request $request, $classId)`
* **Route:** `POST /instructor/class/{classId}/roster/import`
* **Route Name:** `instructor.class.roster.import`

### Actual Code Implementation (`app/Http/Controllers/InstructorClassController.php`):
```php
public function importRoster(Request $request, $classId) {
    $class = ClassRoom::where('id', $classId)
        ->where('Instructor_Id', Auth::id())
        ->firstOrFail();

    $request->validate([
        'roster' => 'required|file|mimes:csv,txt|max:2048'
    ]);

    $file = $request->file('roster');
    $handle = fopen($file->getRealPath(), 'r');

    if (!$handle) {
        return back()->with('error', 'Unable to read the CSV file.');
    }

    $header = fgetcsv($handle);
    if (!$header) {
        fclose($handle);
        return back()->with('error', 'The CSV file is empty.');
    }

    // Clean Byte Order Mark (BOM) and whitespace from headers
    $header = array_map(function ($value) {
        return trim(str_replace("\xEF\xBB\xBF", '', $value));
    }, $header);

    $requiredColumns = ['student_id', 'name', 'email'];
    foreach ($requiredColumns as $column) {
        if (!in_array($column, $header)) {
            fclose($handle);
            return back()->with('error', "Missing required column: {$column}");
        }
    }

    $imported = 0;
    $skipped = 0;

    while (($row = fgetcsv($handle)) !== false) {
        if (count(array_filter($row)) === 0) continue;
        if (count($row) !== count($header)) {
            $skipped++;
            continue;
        }

        $data = array_combine($header, $row);
        $studentId = trim($data['student_id'] ?? '');
        $email = trim($data['email'] ?? '');

        if (!$studentId || !$email) {
            $skipped++;
            continue;
        }

        $student = User::where('student_id', $studentId)
            ->where('role', 'Student')
            ->first();

        if (!$student) {
            $skipped++;
            continue;
        }

        // Attach student to class without removing existing enrollments
        $class->students()->syncWithoutDetaching([$student->id]);
        $imported++;
    }

    fclose($handle);

    return back()->with(
        'success',
        "{$imported} student(s) imported successfully. {$skipped} row(s) skipped."
    );
}
```

### Code Functionality Explanation
1. **Ownership Authorization**: Verifies that `$classId` exists and belongs to the authenticated instructor (`Instructor_Id = Auth::id()`).
2. **File Validation**: `$request->validate()` ensures the uploaded payload contains a file under 2MB (`max:2048`) with allowed MIME types (`csv,txt`).
3. **Stream Handling**: Uses `fopen()` and `fgetcsv()` for memory-efficient streaming of large CSV rosters.
4. **Header Normalization & Validation**:
   - `str_replace("\xEF\xBB\xBF", '', $value)` removes UTF-8 BOM characters that Excel often prepends to CSV files.
   - Checks that required column headers (`student_id`, `name`, `email`) exist before attempting to process rows.
5. **Row-by-Row Matching**:
   - Skips empty rows and mismatched column lengths.
   - Queries `User::where('student_id', $studentId)->where('role', 'Student')->first()` to verify that the student account is registered in the system.
6. **Pivot Syncing**: `$class->students()->syncWithoutDetaching([$student->id])` inserts the record into the `class_student` pivot table without wiping existing enrolled students.
7. **Flash Feedback**: Closes file handle with `fclose($handle)` and redirects back with session flash messages stating total imported vs skipped rows.

---

## 4. Which controller handles manual and automatic grouping?

### Direct Answer
* **Controller:** `InstructorGroupController` (`app/Http/Controllers/InstructorGroupController.php`)
* **Methods:**
  * `index($classId)` &rarr; Loads the grouping UI (`GET /instructor/class/{classId}/groups`)
  * `saveManual(Request $request, $classId)` &rarr; Saves drag-and-drop manual groups (`POST /instructor/class/{classId}/groups/manual`)
  * `automatic(Request $request, $classId)` &rarr; Automatically divides students into groups (`POST /instructor/class/{classId}/groups/automatic`)
* **View Rendered:** `resources/views/instructor/groups.blade.php`

### Actual Code Implementation (`app/Http/Controllers/InstructorGroupController.php`):

#### Manual Grouping (`saveManual`):
```php
public function saveManual(Request $request, $classId) {
    $class = ClassRoom::where('id', $classId)
        ->where('Instructor_Id', Auth::id())
        ->firstOrFail();

    $request->validate([
        'groups' => 'required|array|min:1',
        'groups.*.name' => 'required|string|max:255',
        'groups.*.students' => 'nullable|array',
    ]);

    DB::transaction(function () use ($request, $class) {
        // Remove old group structures for this class
        $class->groups()->delete();

        foreach ($request->groups as $index => $groupData) {
            $group = $class->groups()->create([
                'name' => $groupData['name'],
                'group_number' => $index + 1,
            ]);

            if (!empty($groupData['students'])) {
                $attachData = [];
                foreach ($groupData['students'] as $studentId) {
                    $attachData[$studentId] = ['is_leader' => false];
                }
                $group->students()->attach($attachData);
            }
        }
    });

    return back()->with('success', 'Groups saved successfully.');
}
```

#### Automatic Grouping (`automatic`):
```php
public function automatic(Request $request, $classId) {
    $class = ClassRoom::where('id', $classId)
        ->where('Instructor_Id', Auth::id())
        ->with('students')
        ->firstOrFail();

    $request->validate([
        'number_of_groups' => [
            'required', 'integer', 'min:1',
            'max:' . max(1, $class->students->count()),
        ],
    ]);

    // Randomize enrolled students
    $students = $class->students->shuffle()->values();
    $numberOfGroups = (int) $request->number_of_groups;

    DB::transaction(function () use ($class, $students, $numberOfGroups) {
        $class->groups()->delete();

        $groups = [];
        for ($i = 1; $i <= $numberOfGroups; $i++) {
            $groups[] = $class->groups()->create([
                'name' => 'Group ' . $i,
                'group_number' => $i,
            ]);
        }

        // Round-robin assignment using modulo distribution
        foreach ($students as $index => $student) {
            $groupIndex = $index % $numberOfGroups;
            $groups[$groupIndex]->students()->attach(
                $student->id,
                ['is_leader' => false]
            );
        }
    });

    return back()->with('success', 'Students were automatically grouped successfully.');
}
```

### Code Functionality Explanation
1. **Atomic Execution with `DB::transaction()`**: Both methods wrap group deletion and recreation inside a database transaction. If any error occurs while attaching students, the entire transaction rolls back, preventing broken or empty group states.
2. **Manual Grouping Flow**:
   - Takes array of groups submitted by frontend JavaScript (drag-and-drop state).
   - Creates each group record with a dynamic `group_number`.
   - Adds students to their assigned groups (with `is_leader` set to false by default).
3. **Automatic Grouping Flow**:
   - `$class->students->shuffle()` randomly shuffles the list of students.
   - Creates `$numberOfGroups` empty groups (`Group 1`, `Group 2`, etc.).
   - Distributes students using the modulo operator `$index % $numberOfGroups` (round-robin distribution), ensuring balanced team sizes across all generated groups.

---

## 5. Which controller handles project CRUD operations?

### Direct Answer
* **Controller:** `InstructorProjectController` (`app/Http/Controllers/InstructorProjectController.php`)
* **Methods:**
  * **Create:** `create($classId)` & `store(Request $request, $classId)`
  * **Read:** `index($classId)`
  * **Update:** `edit($classId, $projectId)` & `update(Request $request, $classId, $projectId)`
  * **Delete:** `destroy($classId, $projectId)`

### Actual Code Implementation (`app/Http/Controllers/InstructorProjectController.php`):

#### 1. Store (Create Project and Sync Groups):
```php
public function store(Request $request, $classId) {
    $class = ClassRoom::where('id', $classId)
        ->where('Instructor_Id', Auth::id())
        ->firstOrFail();

    $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string'],
        'start_date' => ['nullable', 'date'],
        'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
        'status' => ['required', 'string', 'max:50'],
        'groups' => ['required', 'array', 'min:1'],
        'groups.*' => ['integer', 'exists:groups,id'],
    ]);

    // Ensure selected groups strictly belong to this class
    $validGroupIds = $class->groups()
        ->whereIn('groups.id', $request->groups)
        ->pluck('groups.id')
        ->toArray();

    if (count($validGroupIds) !== count($request->groups)) {
        return back()->withInput()->withErrors([
            'groups' => 'One or more selected groups do not belong to this class.'
        ]);
    }

    $project = Project::create([
        'class_room_id' => $class->id,
        'title' => $request->title,
        'description' => $request->description,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'status' => $request->status,
    ]);

    // Attach assigned groups via project_groups pivot table
    $project->groups()->sync($validGroupIds);

    return redirect()
        ->route('instructor.projects.index', $class->id)
        ->with('success', 'Project created and assigned to the selected groups successfully.');
}
```

#### 2. Update (Edit Project & Sync Groups):
```php
public function update(Request $request, $classId, $projectId) {
    $class = ClassRoom::where('id', $classId)
        ->where('Instructor_Id', Auth::id())
        ->firstOrFail();

    $project = Project::where('id', $projectId)
        ->where('class_room_id', $class->id)
        ->firstOrFail();

    $validGroupIds = $class->groups()
        ->whereIn('groups.id', $request->groups)
        ->pluck('groups.id')
        ->toArray();

    $project->update([
        'title' => $request->title,
        'description' => $request->description,
        'start_date' => $request->start_date,
        'end_date' => $request->end_date,
        'status' => $request->status,
    ]);

    $project->groups()->sync($validGroupIds);

    return redirect()
        ->route('instructor.projects.index', $class->id)
        ->with('success', 'Project updated successfully.');
}
```

#### 3. Destroy (Delete Project):
```php
public function destroy($classId, $projectId) {
    $class = ClassRoom::where('id', $classId)
        ->where('Instructor_Id', Auth::id())
        ->firstOrFail();

    $project = Project::where('id', $projectId)
        ->where('class_room_id', $class->id)
        ->firstOrFail();

    $project->delete();

    return redirect()
        ->route('instructor.projects.index', $class->id)
        ->with('success', 'Project deleted successfully.');
}
```

### Code Functionality Explanation
1. **Date Logical Validation**: `'end_date' => 'after_or_equal:start_date'` prevents logical errors where project deadlines precede start dates.
2. **Cross-Class Group Hijack Prevention**: `$class->groups()->whereIn('groups.id', $request->groups)->pluck('groups.id')` checks that every assigned group ID actually belongs to the specified classroom.
3. **Many-to-Many Synchronization (`$project->groups()->sync(...)`)**: Updates the `project_groups` pivot table, automatically inserting new assignments and removing unselected ones.
4. **Cascading Project Scope**: `$project = Project::where('id', $projectId)->where('class_room_id', $class->id)` guarantees that updates and deletes cannot cross classroom boundaries.

---

## 6. Which controller handles the task ledger?

### Direct Answer
* **Controller:** `InstructorTaskLedgerController` (`app/Http/Controllers/InstructorTaskLedgerController.php`)
* **Methods:**
  * `index(Request $request, $classId)` &rarr; `GET /instructor/class/{classId}/task-ledger` (Renders Blade view)
  * `data(Request $request, $classId)` &rarr; `GET /instructor/class/{classId}/task-ledger/data` (Returns live JSON payload)
* **View Rendered:** `resources/views/instructor/tasks/ledger.blade.php`

### Actual Code Implementation (`app/Http/Controllers/InstructorTaskLedgerController.php`):
```php
public function index(Request $request, $classId) {
    $class = ClassRoom::where('id', $classId)
        ->where('Instructor_Id', Auth::id())
        ->with('groups')
        ->firstOrFail();

    $tasks = Task::whereHas('project', function ($query) use ($class) {
            $query->where('class_room_id', $class->id);
        })
        ->with([
            'project',
            'group',
            'assignments.student',
            'submissions.student',
        ])
        ->latest()
        ->get();

    $rows = [];

    foreach ($tasks as $task) {
        // Each assigned student becomes one row in the ledger
        foreach ($task->assignments as $assignment) {
            $submission = $task->submissions
                ->where('student_id', $assignment->student_id)
                ->sortByDesc(function ($s) {
                    return $s->submitted_at ?? $s->created_at;
                })
                ->first();

            $rows[] = [
                'task_id'           => $task->id,
                'assignment_id'     => $assignment->id,
                'task_title'        => $task->title,
                'project_title'     => $task->project->title ?? 'No Project',
                'group_name'        => $task->group->name ?? 'No Group',
                'student_id'        => $assignment->student_id,
                'student_name'      => $assignment->student->name ?? 'Unknown Student',
                'points'            => $task->points,
                'assignment_status' => $assignment->status,
                'submission_status' => $submission->status ?? 'Not Submitted',
                'submitted_at'      => $submission?->submitted_at,
                'approved_at'       => $submission?->approved_at,
                'feedback'          => $submission?->feedback,
            ];
        }
    }

    return view('instructor.tasks.ledger', compact('class', 'rows'));
}
```

### Code Functionality Explanation
1. **Relationship Filtering with `whereHas`**: `Task::whereHas('project', ...)` queries tasks across the relationship tree, retrieving only tasks linked to projects belonging to this class section.
2. **Deep Eager Loading**: Loads `'project'`, `'group'`, `'assignments.student'`, and `'submissions.student'` simultaneously in 4 optimized queries instead of hundreds of repeated queries.
3. **Data Denormalization into Rows**:
   - Loops over every `TaskAssignment` to ensure individual student accountability.
   - For each student assignment, finds their latest `TaskSubmission` sorted by `submitted_at`.
   - Constructs a flattened `$rows` array containing student identity, task requirements, submission deliverables, evaluation scores (`points`), approval timestamps, and feedback.
4. **Dual Rendering Architecture**:
   - `index()` renders the complete Blade UI table.
   - `data()` returns this exact data structure as a JSON response (`response()->json(...)`) for dynamic client-side filtering and real-time polling without full page reloads.

---

## 7. Which model represents a class?

### Direct Answer
* **Model:** `ClassRoom` (`app/Models/ClassRoom.php`)
* **Table:** `class_rooms`

### Actual Code Implementation (`app/Models/ClassRoom.php`):
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassRoom extends Model
{
    protected $fillable = [
        'course_code',
        'course_name',
        'offer_code',
        'semester',
        'academic_year',
        'Instructor_Id'
    ];

    public function instructor(): BelongsTo {
        return $this->belongsTo(User::class, 'Instructor_Id', 'id');
    }

    public function students(): BelongsToMany {
        return $this->belongsToMany(
            User::class,
            'class_student',
            'class_room_id',
            'student_id'
        )->withTimestamps();
    }

    public function groups(): HasMany {
        return $this->hasMany(Group::class, 'class_room_id');
    }
}
```

### Code Functionality Explanation
1. **`$fillable`**: Protects against mass-assignment vulnerabilities. Only specified attributes (`course_code`, `course_name`, `offer_code`, `semester`, `academic_year`, `Instructor_Id`) can be assigned via `create()` or `update()`. Note that `section` was renamed to `offer_code` via database migrations.
2. **`instructor()` (`BelongsTo`)**: Links the class section to the assigned instructor in the `users` table via foreign key `Instructor_Id`.
3. **`students()` (`BelongsToMany`)**: Defines the many-to-many relationship with students via the `class_student` pivot table. `withTimestamps()` automatically tracks when students were enrolled.
4. **`groups()` (`HasMany`)**: Establishes that one classroom owns multiple student groups (`Group` models).

---

## 8. Which model represents a group?

### Direct Answer
* **Model:** `Group` (`app/Models/Group.php`)
* **Table:** `groups`
* **Pivot / Membership Model:** `GroupMember` (`app/Models/GroupMember.php`) / `group_members` table

### Actual Code Implementation (`app/Models/Group.php`):
```php
<?php

namespace App\Models;

use App\Models\Student\GroupLeaderVote;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    protected $fillable = [
        'class_room_id',
        'name',
        'group_number',
    ];

    public function classRoom(): BelongsTo {
        return $this->belongsTo(ClassRoom::class, 'class_room_id');
    }

    public function students(): BelongsToMany {
        return $this->belongsToMany(
            User::class,
            'group_members',
            'group_id',
            'student_id'
        )
        ->withPivot('is_leader')
        ->withTimestamps();
    }

    public function leaderVotes(): HasMany {
        return $this->hasMany(GroupLeaderVote::class, 'group_id');
    }

    public function projects(): BelongsToMany {
        return $this->belongsToMany(
            Project::class,
            'project_groups',
            'group_id',
            'project_id'
        )->withTimestamps();
    }
}
```

### Code Functionality Explanation
1. **`classRoom()` (`BelongsTo`)**: Links the group back to its parent `ClassRoom`.
2. **`students()` (`BelongsToMany`)**: Connects the group to student users through the `group_members` pivot table. The `withPivot('is_leader')` method allows Eloquent to read and write leadership status directly on the pivot relation.
3. **`leaderVotes()` (`HasMany`)**: Tracks democratic peer leadership voting records within this group.
4. **`projects()` (`BelongsToMany`)**: Connects the group to assigned projects through the `project_groups` pivot table.

---

## 9. Which model represents a project?

### Direct Answer
* **Model:** `Project` (`app/Models/Project.php`)
* **Table:** `projects`

### Actual Code Implementation (`app/Models/Project.php`):
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $fillable = [
        'class_room_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function classRoom(): BelongsTo {
        return $this->belongsTo(ClassRoom::class, 'class_room_id');
    }

    public function groups(): BelongsToMany {
        return $this->belongsToMany(
            Group::class,
            'project_groups',
            'project_id',
            'group_id'
        )->withTimestamps();
    }

    public function tasks(): HasMany {
        return $this->hasMany(Task::class, 'project_id');
    }
}
```

### Code Functionality Explanation
1. **`$casts` Property**: Automatically converts `start_date` and `end_date` database strings into Carbon date objects, enabling date formatting (`->format('Y-m-d')`) and comparisons.
2. **`classRoom()` (`BelongsTo`)**: Links the project to the specific classroom section.
3. **`groups()` (`BelongsToMany`)**: Defines which student teams are assigned to execute this project via the `project_groups` pivot table.
4. **`tasks()` (`HasMany`)**: One project contains multiple work deliverables and milestones represented by `Task` models.

---

## 10. Which model represents a task?

### Direct Answer
* **Model:** `Task` (`app/Models/Task.php`)
* **Table:** `tasks`
* **Related Models:**
  * `TaskAssignment` (`app/Models/TaskAssignment.php`) &rarr; Assigns tasks to specific students.
  * `TaskSubmission` (`app/Models/TaskSubmission.php`) &rarr; Records student submissions, links, files, and instructor approval.

### Actual Code Implementation (`app/Models/Task.php`):
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    protected $fillable = [
        'project_id',
        'group_id',
        'title',
        'description',
        'points',
        'due_date',
        'status',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function project(): BelongsTo {
        return $this->belongsTo(Project::class, 'project_id');
    }

    public function group(): BelongsTo {
        return $this->belongsTo(Group::class, 'group_id');
    }

    public function assignments(): HasMany {
        return $this->hasMany(TaskAssignment::class, 'task_id');
    }

    public function submissions(): HasMany {
        return $this->hasMany(TaskSubmission::class, 'task_id');
    }
}
```

#### Task Submission Model (`app/Models/TaskSubmission.php`):
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskSubmission extends Model
{
    protected $fillable = [
        'task_id',
        'student_id',
        'submission_text',
        'file_path',
        'status',
        'submitted_at',
        'approved_at',
        'approved_by',
        'feedback',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    public function task(): BelongsTo {
        return $this->belongsTo(Task::class, 'task_id');
    }

    public function student(): BelongsTo {
        return $this->belongsTo(User::class, 'student_id');
    }

    public function approver(): BelongsTo {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
```

### Code Functionality Explanation
1. **`project()` & `group()` (`BelongsTo`)**: A task is scoped to a specific project and assigned to a specific group.
2. **`assignments()` (`HasMany`)**: Connects the task to `TaskAssignment` records, tracking which group members are responsible for the task and their individual progress status.
3. **`submissions()` (`HasMany`)**: Relates the task to `TaskSubmission` records storing submitted deliverable text/URLs (`submission_text`), uploaded documents/archives (`file_path`), submitted timestamps, approval dates, approver reference (`approved_by`), and grading feedback.

---

## 11. Which files are backend and which are frontend?

### Backend Files (Business Logic, Security, Data Storage)
Backend files execute on the web server, handle routing, process requests, enforce authentication/authorization, interact with MySQL, and prepare data.

| Category | File Paths | Key Responsibility |
|---|---|---|
| **Routing** | `routes/web.php`<br>`routes/api.php` | Maps incoming HTTP URL requests and methods to controller actions with middleware guards. |
| **Controllers** | `app/Http/Controllers/InstructorDashboardController.php`<br>`app/Http/Controllers/InstructorClassController.php`<br>`app/Http/Controllers/InstructorGroupController.php`<br>`app/Http/Controllers/InstructorProjectController.php`<br>`app/Http/Controllers/InstructorTaskLedgerController.php`<br>`app/Http/Controllers/AuthController.php` | Executes business logic, handles validation, queries database via Eloquent, and returns views or JSON. |
| **Models** | `app/Models/ClassRoom.php`<br>`app/Models/Group.php`<br>`app/Models/GroupMember.php`<br>`app/Models/Project.php`<br>`app/Models/Task.php`<br>`app/Models/TaskAssignment.php`<br>`app/Models/TaskSubmission.php`<br>`app/Models/User.php` | Defines database schema mapping, table relationships, type casting, and mass-assignment protection. |
| **Middleware** | `app/Http/Middleware/RoleMiddleware.php`<br>`app/Http/Middleware/Authenticate.php` | Intercepts requests before reaching controllers to verify login state and role permissions (`role:Instructor`). |
| **Database** | `database/migrations/*`<br>`database/seeders/*` | Defines database table schemas, foreign key constraints, indexes, and initial test seed data. |

### Frontend Files (Presentation, User Interface, Client-Side Interaction)
Frontend files compile or render into HTML, CSS, and JavaScript executed inside the user's web browser.

| Category | File Paths | Key Responsibility |
|---|---|---|
| **Blade Views** | `resources/views/instructor/dashboard.blade.php`<br>`resources/views/instructor/course-detail.blade.php`<br>`resources/views/instructor/groups.blade.php`<br>`resources/views/instructor/projects/index.blade.php`<br>`resources/views/instructor/projects/create.blade.php`<br>`resources/views/instructor/projects/edit.blade.php`<br>`resources/views/instructor/tasks/ledger.blade.php`<br>`resources/views/layouts/` | HTML templates using Laravel Blade directives (`@foreach`, `@if`, `@csrf`, `@method`) to dynamically render data. |
| **Client Scripts** | `resources/js/app.js`<br>`public/js/*` | Handles client-side interactivity such as drag-and-drop grouping, modal dialogs, and AJAX fetching for the Task Ledger. |
| **Stylesheets** | `resources/css/app.css`<br>`public/css/*` | Manages page layout, colors, responsive card designs, badges, and typography. |

---

## 12. Why is `Instructor_Id = Auth::id()` important?

### Direct Answer & Crucial Reasons
1. **Multi-Tenant Data Isolation:** Ensures instructors can only view, edit, and grade classes assigned specifically to them.
2. **Prevention of IDOR (Insecure Direct Object Reference) Attacks:** Prevents malicious users from tampering with URL parameters (e.g. changing `/instructor/class/1` to `/instructor/class/2`) to access another instructor's confidential student records, project submissions, or grades.
3. **Data Integrity & Relational Binding:** Guarantees that any newly created resources (projects, groups, roster relations) are explicitly bound to the authenticated user executing the action.

### Code Comparison: Vulnerable vs Secure Implementation

#### ❌ Vulnerable Implementation (IDOR Vulnerability):
```php
// INSECURE: Anyone can pass any $classId in the URL and modify other teachers' data!
public function show($classId) {
    $class = ClassRoom::findOrFail($classId);
    return view('instructor.course-detail', compact('class'));
}
```

#### ✅ Secure Implementation (Our Codebase):
```php
// SECURE: Enforces that the class must belong to the logged-in instructor
public function show($classId) {
    $class = ClassRoom::where('id', $classId)
        ->where('Instructor_Id', Auth::id())
        ->with('students')
        ->firstOrFail();

    return view('instructor.course-detail', compact('class'));
}
```

### Explanation of Security Mechanism
- If Teacher A (ID = 5) attempts to access `GET /instructor/class/12` (owned by Teacher B, ID = 9), the SQL query executes:
  ```sql
  SELECT * FROM `class_rooms` WHERE `id` = 12 AND `Instructor_Id` = 5 LIMIT 1;
  ```
- Because no row satisfies both criteria, Eloquent's `firstOrFail()` immediately terminates the request with an HTTP `404 Not Found`, completely neutralizing unauthorized access attempts at the database layer.

---

## 13. How do these features connect to the overall academic workflow?

### Visual Workflow Diagram

```
┌─────────────────────────────────────────────────────────────────────────┐
│                        ACADEMIC SYSTEM WORKFLOW                         │
└─────────────────────────────────────────────────────────────────────────┘
                                     │
                                     ▼
 [1. Class Setup & Access]
 │   Route: GET /teacher
 │   Controller: InstructorDashboardController@index
 │   Model: ClassRoom (filtered by Instructor_Id = Auth::id())
 └───► Instructor logs in and opens their assigned course section.
                                     │
                                     ▼
 [2. Student Roster Enrollment]
 │   Route: POST /instructor/class/{classId}/roster/import
 │   Controller: InstructorClassController@importRoster
 │   Models: User, ClassRoom (Pivot: class_student)
 └───► CSV roster is parsed; verified student accounts are enrolled into the class.
                                     │
                                     ▼
 [3. Team & Group Formation]
 │   Routes: POST /instructor/class/{classId}/groups/manual
 │           POST /instructor/class/{classId}/groups/automatic
 │   Controller: InstructorGroupController
 │   Models: Group, GroupMember (Pivot: group_members with is_leader)
 └───► Enrolled students are organized into collaborative groups (manually or auto-shuffled).
                                     │
                                     ▼
 [4. Project Assignment]
 │   Routes: POST /instructor/class/{classId}/projects
 │   Controller: InstructorProjectController@store
 │   Models: Project (Pivot: project_groups)
 └───► Instructor defines project scope, rubrics, and deadlines; links projects to groups.
                                     │
                                     ▼
 [5. Student Execution & Task Submissions]
 │   Routes: Student Task Controller routes
 │   Models: Task, TaskAssignment, TaskSubmission
 └───► Students break projects into tasks, update progress status, and submit deliverables.
                                     │
                                     ▼
 [6. Ledger Monitoring, Evaluation & Grading]
 │   Routes: GET /instructor/class/{classId}/task-ledger
 │           GET /instructor/class/{classId}/task-ledger/data
 │   Controller: InstructorTaskLedgerController
 │   Models: Task, TaskAssignment, TaskSubmission, User
 └───► Instructor monitors live submissions, reviews peer contributions, approves tasks, and records grades.
```

### Detailed Step-by-Step System Connection

1. **Step 1: Class Discovery (`InstructorDashboardController`)**:
   - The instructor logs in. The system identifies their role as `Instructor` and directs them to `GET /teacher`. The controller queries all `ClassRoom` records matching `Instructor_Id = Auth::id()`.

2. **Step 2: Student Enrollment (`InstructorClassController::importRoster`)**:
   - The instructor opens a specific class and uploads a CSV student roster. The controller parses headers, matches `student_id` against the `users` table, and establishes records in the `class_student` pivot table.

3. **Step 3: Team Formation (`InstructorGroupController`)**:
   - With students enrolled, the instructor configures teams either manually (via drag-and-drop) or automatically (via randomized round-robin distribution). This populates the `groups` and `group_members` tables.

4. **Step 4: Project Initialization (`InstructorProjectController`)**:
   - The instructor creates a course project (title, milestones, start/end dates) and assigns target groups via the `project_groups` pivot table.

5. **Step 5: Task Breakdown and Student Work (`Task`, `TaskAssignment`, `TaskSubmission`)**:
   - Within each assigned project and group, tasks are created. Students receive task assignments and submit deliverables (files, repositories, documentation).

6. **Step 6: Oversight and Evaluation (`InstructorTaskLedgerController`)**:
   - The instructor opens the Task Ledger (`GET /instructor/class/{classId}/task-ledger`). The controller aggregates task milestones, assigned students, latest submission timestamps, and approval statuses into a unified grading matrix.
