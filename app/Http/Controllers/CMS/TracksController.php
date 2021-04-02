<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\Tracks\CreateTrack;
use App\Http\Requests\CMS\Tracks\UpdateTrack;
use App\Models\Track;
use App\Services\ImageResize\TrackImageResize;
use App\Services\SelectBoxes\Pages\CMS\TracksCreateEdit;

class TracksController extends Controller
{
    public function __construct(
        protected Track $tracks, 
        protected TracksCreateEdit $selectBoxes,
        protected TrackImageResize $trackImageResize
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response     
     */
    public function index(Request $request)
    {     
        return View('cms.tracks.index', [
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
        return View('cms.tracks.create', [
            'selectBoxes' => $this->selectBoxes->get(),
        ]);
    }

    /**
     * Store a newly created Track.
     *
     */
    public function store(CreateTrack $request)
    {
        if ($request->file('image')) {

            $this->trackImageResize->setUp($request->file('image'), $request->label_id);

            $this->tracks->create(
                array_merge($request->validated(), [
                    'track_image' => $this->trackImageResize->main(),
                    'track_thumbnail' => $this->trackImageResize->thumb()
                ])
            );

        } else {
            $this->tracks->create($request->validated());
        }    

        return redirect()
            ->route('cms.tracks.create')
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
        return View('cms.tracks.edit', [
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
    public function update(UpdateTrack $request, Track $track)
    {
        if ($request->file('image')) {
            
            $this->trackImageResize->setUp($request->file('image'), $request->label_id);

            $track->fill(
                array_merge($request->validated(), [
                    'label_image' => $this->trackImageResize->main(),
                    'label_thumbnail' => $this->trackImageResize->thumb()
                ])
            )->save();

        } else {
		    $track->fill($request->validated())->save();
        }

        // Need to fire the event manually, after every update, as the event will 
        // not fire automatically if only the pivot table changes (e.g. Artists, Tags).
        event('eloquent.updated: App\Models\Track', $track);
        
        return redirect()
            ->route('cms.tracks.index')
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
    

    public function getTracksByYearPurchased($year = 2017)
    {        
        return $this->tracks->getTracksByYearPurchased($year);
    }
}
