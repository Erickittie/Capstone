<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Student\GroupLeaderVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoteController extends Controller
{

    public function index($classId)
    {
        $student = Auth::user();

        $group = Group::where('class_room_id', $classId)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->with('students')
            ->firstOrFail();

        $existingVote = GroupLeaderVote::where('group_id', $group->id)
            ->where('voter_id', $student->id)
            ->first();

        $leader = $group->students
            ->first(function ($member) {
                return $member->pivot->is_leader;
            });

        return view('student.leader-vote', compact(
            'student',
            'group',
            'existingVote',
            'leader'
        ));
    }

    public function store(Request $request, $classId)
    {
        $student = Auth::user();

        $group = Group::where('class_room_id', $classId)
            ->whereHas('students', function ($query) use ($student) {
                $query->where('users.id', $student->id);
            })
            ->with('students')
            ->firstOrFail();

        $leaderExists = $group->students
            ->contains(function ($member) {
                return $member->pivot->is_leader;
            });

        if ($leaderExists) {
            return back()->with(
                'error',
                'A group leader has already been selected.'
            );
        }

        $request->validate([
            'candidate_id' => ['required', 'integer'],
        ]);

        $candidate = $group->students()
            ->where('users.id', $request->candidate_id)
            ->first();

        if (!$candidate) {
            return back()->with(
                'error',
                'You can only vote for a member of your group.'
            );
        }

        GroupLeaderVote::updateOrCreate(
            [
                'group_id' => $group->id,
                'voter_id' => $student->id,
            ],
            [
                'candidate_id' => $candidate->id,
            ]
        );

        $totalMembers = $group->students->count();

        $totalVotes = GroupLeaderVote::where(
            'group_id',
            $group->id
        )->count();

        if ($totalVotes < $totalMembers) {

            $remaining = $totalMembers - $totalVotes;

            return back()->with(
                'success',
                "Your vote has been recorded. {$remaining} member(s) still need to vote."
            );
        }

        $voteCounts = GroupLeaderVote::where(
            'group_id',
            $group->id
        )
        ->select(
            'candidate_id',
            DB::raw('COUNT(*) as total_votes')
        )
        ->groupBy('candidate_id')
        ->orderByDesc('total_votes')
        ->get();

        if ($voteCounts->isEmpty()) {
            return back()->with(
                'error',
                'No votes were found.'
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
            'Voting is complete! The group leader has been selected.'
        );
    }
}