<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('student.notifications.index', compact('notifications'));
    }

    public function read(Notification $notification)
    {
        abort_if($notification->user_id !== Auth::id(), 403);

        $notification->update([
            'is_read' => true,
        ]);

        if ($notification->task_id) {
            $task = $notification->task;

            if ($task) {
                return redirect()->route('student.tasks.show', [
                    'classId' => $task->group->class_room_id,
                    'projectId' => $task->project_id,
                    'taskId' => $task->id,
                ]);
            }
        }

        return redirect()->route('student.notifications.index');
    }

    public function readAll()
    {
        Notification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update([
                'is_read' => true,
            ]);

        return redirect()
            ->route('student.notifications.index')
            ->with('success', 'All notifications have been marked as read.');
    }
}