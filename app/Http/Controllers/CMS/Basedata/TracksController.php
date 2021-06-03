<?php

namespace App\Http\Controllers\CMS\Basedata;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\Tracks\CreateTrack;
use App\Http\Requests\CMS\Tracks\UpdateTrack;
use App\Models\Track;
use App\Services\CRUD\Track\TrackCreationService;
use App\Services\CRUD\Track\TrackUpdateService;
use App\Services\SelectBoxes\Pages\CMS\TracksCreateEdit;

class TracksController extends Controller
{
    public function __construct(
        protected Track $tracks, 
        protected TracksCreateEdit $selectBoxes
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response     
     */
    public function index(Request $request)
    {     
        return View('cms.basedata.tracks.index', [
            'tracks' => $this->tracks->withFilters($request->input())->paginate(48)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('cms.basedata.tracks.create', [
            'selectBoxes' => $this->selectBoxes->get(),
        ]);
    }

    /**
     * Store a newly created Track.
     *
     */
    public function store(CreateTrack $request, TrackCreationService $trackCreationService)
    {
        $trackCreationService->create($request->validated());

        return redirect()
            ->route('cms.basedata.tracks.create')
            ->with('success','Track created successfully!');  
    }

    /**
     * Display the specified resource.
     *
     * @param Track $track
     * @return \Illuminate\Http\Response
     */
    public function show(Track $track)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Track $track
     * @return \Illuminate\Http\Response
     */
    public function edit(Track $track)
    {
        return View('cms.basedata.tracks.edit', [
            'track' => $track,
            'selectBoxes' => $this->selectBoxes->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\CMS\Tracks\UpdateTrack  $request
     * @param Track $track
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrack $request, Track $track, TrackUpdateService $trackUpdateService)
    {
        $trackUpdateService->update($request->validated(), $track);
      
        return redirect()
            ->route('cms.basedata.tracks.index')
            ->with('success','Track updated successfully!');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
