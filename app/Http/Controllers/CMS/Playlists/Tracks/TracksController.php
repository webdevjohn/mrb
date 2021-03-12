<?php

namespace App\Http\Controllers\CMS\Playlists\Tracks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Track;
use App\Repositories\CMS\CMSPlaylistRepository;

class TracksController extends Controller
{
    public function __construct(
       protected CMSPlaylistRepository $playlists, 
       protected Track $tracks
    ){}


    /**
     * Display a listing of the resource.
     * GET /cms/playlists/{playlist)/tracks
     *
     * @param Playlist $playlist
     * @param \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\View\View
     */
    public function index(Playlist $playlist, Request $request)
    {
        return View('cms.playlists-tracks.index', [
            'playlist' => $this->playlists->getPlaylistTracks($playlist->slug),
            'tracks' => $this->tracks->getTracks($request->input())
        ]);
    }

  
    /**
     * Show the form for creating a new resource.
     * GET /cms/playlists/{playlist)/tracks/create
     *
     * @param Playlist $playlist
     * @param \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\View\View
     */
    public function create(Playlist $playlist, Request $request)
    {
        return View('cms.playlists-tracks.create', [
            'playlistTracks' => $this->playlists->getPlaylistTracks($playlist->slug),
            'tracks' => $this->tracks->getTracks($request->input())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * POST /cms/playlists/{$slug)/tracks
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(Playlist $playlist, Request $request)
    {        
        $playlist = $this->playlists->findBySlug($playlist->slug);
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
