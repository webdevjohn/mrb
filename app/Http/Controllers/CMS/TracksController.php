<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\Tracks\CreateTrack;
use App\Http\Requests\CMS\Tracks\UpdateTrack;
use App\Models\Track;
use App\Repositories\ComboListsRepository;

class TracksController extends Controller
{
    public function __construct(
        protected Track $tracks, 
        protected ComboListsRepository $comboLists
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\Response     
     */
    public function index(Request $request)
    {     
        return View('cms.tracks.index', [
            'tracks' => $this->tracks->getTracks($request->input())
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
            'artistList'    => $this->comboLists->getList('App\Models\Artist', 'artist_name', false),
            'genreList'     => $this->comboLists->getList('App\Models\Genre', 'genre'),
            'labelList'     => $this->comboLists->getList('App\Models\Label', 'label'),
            'formatList'    => $this->comboLists->getList('App\Models\Format', 'format'),
            'albumList'     => $this->comboLists->getList('App\Models\Album', 'title'),
            'tagList'       => $this->comboLists->getList('App\Models\Tag', 'tag', false)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(CreateTrack $request)
    {
        $this->tracks->storeTrack(
            $request->validated()
        );

        return redirect()
            ->route('cms.tracks.create')
            ->with('success','Track created successfully!');  
    }

    /**
     * Display the specified resource.
     *
     * @param  Track  $track
     * @return \Illuminate\Http\Response
     */
    public function show(Track $track)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Track  $track
     * @return \Illuminate\Http\Response
     */
    public function edit(Track $track)
    {
        return View('cms.tracks.edit', [
            'track'         => $track,
            'artistList'    => $this->comboLists->getList('App\Models\Artist', 'artist_name', false),
            'genreList'     => $this->comboLists->getList('App\Models\Genre', 'genre'),
            'labelList'     => $this->comboLists->getList('App\Models\Label', 'label'),
            'formatList'    => $this->comboLists->getList('App\Models\Format', 'format'),
            'tagList'       => $this->comboLists->getList('App\Models\Tag', 'tag', false) 
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CMS\Tracks\UpdateTrack  $request
     * @param  Track  $track
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrack $request, Track $track)
    {
        $this->tracks->amend(
            $track, 
            $request->validated()
        );
        
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
