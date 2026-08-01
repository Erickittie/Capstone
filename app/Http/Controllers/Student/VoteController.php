<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    // Show the leader vote page with current vote counts
    public function index($groupId)
    {
        // Get all votes for this group
        $votes = Vote::where('group_id', $groupId)
            ->with('candidate') // load candidate details
            ->get();

        // Count votes per candidate
        $voteCounts = $votes->groupBy('candidate_id')
            ->map(fn($v) => $v->count());

        // Check if logged-in student already voted in this group
        $hasVoted = Vote::where('voter_id', auth()->id())
            ->where('group_id', $groupId)
            ->exists();

        return view('student.leader-vote', compact('votes', 'voteCounts', 'hasVoted'));
    }

    // Save a student's vote for a candidate
    public function store(Request $request)
    {
        // Validate the form fields
        $request->validate([
            'candidate_id' => 'required|exists:users,id',
            'group_id'     => 'required',
        ]);

        // Check if student already voted in this group
        $alreadyVoted = Vote::where('voter_id', auth()->id())
            ->where('group_id', $request->group_id)
            ->exists();

        if ($alreadyVoted) {
            // Redirect back with error if already voted
            return redirect()->back()->with('error', 'You have already cast your vote.');
        }

        // Save the vote
        Vote::create([
            'voter_id'     => auth()->id(), // logged-in student
            'candidate_id' => $request->candidate_id,
            'group_id'     => $request->group_id,
        ]);

        return redirect()->back()->with('success', 'Your vote has been cast successfully.');
    }
}