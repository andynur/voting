<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Election;
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

    public function count() {
        $candidates = Election::first()->candidates;
        return view('backend.booth.count', compact('candidates'));
    }
}
