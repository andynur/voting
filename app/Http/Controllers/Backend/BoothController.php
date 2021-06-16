<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Election;
use App\Models\ElectionVote;
use Auth;
use Illuminate\Http\Request;

class BoothController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $votes = Election::first()->votes;
        return view('backend.booth.index', compact('votes'));
    }

    public function destroy($id) {
        $vote = ElectionVote::findOrFail($id);
        $vote->voter->update([
            'has_elected' => 0,
            'selected_date' => null
        ]);
        $vote->delete();
        return response()->json([
            'message' => 'Success'
        ]);
    }

    public function destroyAll() {
        $votes = Election::first()->votes;
        foreach($votes as $vote) {
            $vote->voter->update([
                'has_elected' => 0,
                'selected_date' => null
            ]);
            $vote->delete();
        }
        return response()->json([
            'message' => 'Success'
        ]);
    }

    public function count() {
        $candidates = Election::first()->candidates;
        $colors = ['#FEC007', '#4CBC74', '#62C2DF', '#86D6A', '#21A8D9'];

        return view('backend.booth.count', compact('candidates', 'colors'));
    }
}
