<?php

namespace App\Http\Controllers\Backend;

use App\Models\Election;

/**
 * Class DashboardController.
 */
class DashboardController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $election = Election::first();
        $results = $election->candidates->map(function($candidate) {
            return [$candidate->name, $candidate->votes()];
        })->toArray();
        array_push($results, ['Belum Memilih', $election->yetVoted()]);
        return view('backend.dashboard', compact('results', 'election'));
    }
}
