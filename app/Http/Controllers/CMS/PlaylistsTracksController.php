<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CMS\CMSTrackRepository;
use App\Repositories\CMS\CMSPlaylistRepository;

class PlaylistsTracksController extends Controller
{
    protected $playlists, $tracks, $comboLists;

    public function __construct(CMSPlaylistRepository $playlists, CMSTrackRepository $tracks)
    {
        $this->playlists = $playlists;
        $this->tracks = $tracks;
    }


    /**
     * Display a listing of the resource.
     * GET /cms/playlists/{$slug)/tracks
     *
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(string $slug, Request $request)
    {
        return View('cms.playlists-tracks.index', [
            'playlist' => $this->playlists->getPlaylistTracks($slug),
            'tracks'    => $this->tracks->getTracks($request)
        ]);
    }

  
    /**
     * Show the form for creating a new resource.
     * GET /cms/playlists/{$slug)/tracks/create
     *
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function create(string $slug, Request $request)
    {
        return View('cms.playlists-tracks.create', [
            'playlistTracks'    => $this->playlists->getPlaylistTracks($slug),
            'tracks'            => $this->tracks->getTracks($request)
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * POST /cms/playlists/{$slug)/tracks
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(string $slug, Request $request)
    {        
        $playlist = $this->playlists->findBySlug($slug);
        $playlist->Tracks()->attach($request->id);
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
