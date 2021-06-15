<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CandidateRequest;
use App\Models\Candidate;
use App\Models\ElectionCandidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::all();
        return view('backend.candidates.index', compact('candidates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.candidates.create');
    }

    public function storeFile(Request $request, $fieldname = 'image', $directory = 'files', $isFullPath = false)
    {
        if ($request->hasFile($fieldname)) {
            if (!$request->file($fieldname)->isValid()) {
                flash('Invalid Image!')->error()->important();
                return redirect()->back()->withInput();
            }
            // Get filename with the extension
            $filenameWithExtension  = $request->file($fieldname)->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            //Get just extension
            $extension = $request->file($fieldname)->getClientOriginalExtension();
            //Filename to store;
            $filenameToStore = $filename . '_' . time() . '.' . $extension;
            $path = $request->file($fieldname)->storeAs("public/$directory", $filenameToStore);
            return $isFullPath ? "/storage/$directory/$filenameToStore" : $filenameToStore;
        }
        return null;
    }

    public function deleteFile($filename)
    {
        $name = str_replace('/storage', '', $filename);
        if (Storage::disk('public')->exists("$name")) {
            Storage::disk('public')->delete("$name");
            return true;
        }
        return null;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CandidateRequest $request)
    {
        $candidate = Candidate::create($request->all());
        $candidate->profile_image = $this->storeFile($request, 'profile_image', 'candidates', true);
        $candidate->save();
        ElectionCandidate::create([
            'election_id' => 1,
            'candidate_id' => $candidate->id
        ]);
        return redirect()->route('admin.candidates.index', $candidate)->withFlashSuccess('Data kandidat baru telah dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $candidate = Candidate::findOrFail($id);
        return view('backend.candidates.show', compact('candidate'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $candidate = Candidate::findOrFail($id);
        return view('backend.candidates.edit', compact('candidate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editFile($oldFilename, Request $request, $fieldname = 'image', $directory = 'files')
    {
        if ($request->hasFile($fieldname)) {
            if ($this->deleteFile($oldFilename)) {
                return $this->storeFile($request, $fieldname, $directory, true);
            }
        }
        return $oldFilename;
    }
    public function update(Request $request, $id)
    {
        $candidate = Candidate::findOrFail($id);
        $candidate->profile_image = $this->editFile($candidate->profile_image, $request, 'profile_image', 'candidates');
        $candidate->save();
        return redirect()->route('admin.candidates.index')->withFlashSuccess('Data kandidat baru telah diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $candidate = Candidate::findOrFail($id);
        $this->deleteFile($candidate->profile_image);
        $candidate->delete();
        return response()->json(['message' => 'data berhasil dihapus']);
    }
}
