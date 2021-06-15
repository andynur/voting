<?php

namespace App\Http\Controllers\Frontend\User;

use App\Models\ElectionVote;
use Auth;
use Illuminate\Http\Request;

/**
 * Class DashboardController.
 */
class DashboardController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $elections = Auth::user()->elections;
        $selected_election = $request->has('e') ? $elections->where('id', $request->e)->first() : Auth::user()->scopeElectionsNotVote()->first();
        return view('frontend.user.dashboard', compact('elections', 'selected_election'));
    }

    public function election($election_id, $candidate_id) {

        $voter = Auth::user()->elections->where('id', $election_id)->first();
        $voter->update([
            'has_elected' => 1,
            'selected_date' => now()
        ]);
        $vote = ElectionVote::create([
            'election_id' => $voter->election_id,
            'candidate_id' => $candidate_id,
            'voter_id' => $voter->id
        ]);
        return redirect()->route('frontend.user.dashboard', $vote)->withFlashSuccess('Terima karena telah menggunakan suara anda!');
    }
}
