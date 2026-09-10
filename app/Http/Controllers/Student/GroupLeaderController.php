<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\GroupLeaderVote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GroupLeaderController extends Controller
{

    public function selectLeader($classId)
    {
        $student = Auth::user();

        $group = Group::where('class_room_id', $classId)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->with('students')
            ->firstOrFail();

        $voteCounts = GroupLeaderVote::where('group_id', $group->id)
            ->select('candidate_id', DB::raw('COUNT(*) as total_votes'))
            ->groupBy('candidate_id')
            ->orderByDesc('total_votes')
            ->get();

        if ($voteCounts->isEmpty()) {
            return back()->with(
                'error',
                'There are no votes yet.'
            );
        }

        $highestVotes = $voteCounts->first()->total_votes;

        $winners = $voteCounts->where(
            'total_votes',
            $highestVotes
        );

        if ($winners->count() > 1) {

            return back()->with(
                'error',
                'There is a tie. The group must vote again.'
            );
        }

        $winnerId = $voteCounts->first()->candidate_id;

        DB::table('group_members')
            ->where('group_id', $group->id)
            ->update([
                'is_leader' => false
            ]);

        DB::table('group_members')
            ->where('group_id', $group->id)
            ->where('student_id', $winnerId)
            ->update([
                'is_leader' => true
            ]);

        return back()->with(
            'success',
            'The group leader has been selected successfully.'
        );
    }
}