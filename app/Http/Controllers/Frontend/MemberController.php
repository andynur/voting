<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Election;
use App\Models\ElectionVote;
use Auth;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function voting() {
        $election = Auth::user()->elections->first();
        return view('frontend.user.dashboard', compact('election'));
    }

    public function voted($candidate_id) {
        $voter = Auth::user()->elections->first();
        $voter->update([
            'has_elected' => 1,
            'selected_date' => now()
        ]);
        $vote = ElectionVote::create([
            'election_id' => $voter->election_id,
            'candidate_id' => $candidate_id,
            'voter_id' => $voter->id
        ]);
        return response()->json([
            'message' => 'Success'
        ]);
    }

    public function polling() {
        $election = Election::first();
        $results = $election->candidates->map(function($candidate) {
            return [$candidate->name, $candidate->votes()];
        })->toArray();
        array_push($results, ['Belum Memilih', $election->yetVoted()]);
        $votes = $election->votes;
        return view('frontend.polling', compact('results', 'election', 'votes'));
    }
}
