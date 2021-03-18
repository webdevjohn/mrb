<?php

namespace App\Http\Controllers\CMS\Playlists\Tracks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Track;

class TracksController extends Controller
{
    public function __construct(
       protected Track $tracks
    ){}


    /**
     * Display a playlist with tracks.
     *
     * @param Playlist $playlist     
     * 
     * @return \Illuminate\View\View
     */
    public function index(Playlist $playlist)
    {
        return View('cms.playlists.tracks.index', [
            'playlist' => $playlist->with('tracks.label')
                ->where('slug', $playlist->slug)
                ->firstOrFail()
        ]);
    }

  
    /**
     * Show the form for creating a new resource.
     *
     * @param Playlist $playlist
     * @param \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\View\View
     */
    public function create(Playlist $playlist, Request $request)
    {    
        return View('cms.playlists.tracks.create', [
            'playlist' => $playlist,
            'tracks' => $this->tracks->WithRelations()
                ->whereNotIn('id', $playlist->getTrackIds())
                ->Filters($request->input())
			    ->Sortable($request->input())
                ->orderBy('purchase_date', 'DESC')
                ->paginate(48)	
        ]);
    }
    
    /**
     * Add an existing track to an existing playlist.
     *
     * @param Playlist $playlist
     * @param Request $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(Playlist $playlist, Request $request)
    {        
        $playlist->tracks()->attach($request->id);
        
        return redirect()->back(); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
