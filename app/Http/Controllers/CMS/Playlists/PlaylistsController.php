<?php

namespace App\Http\Controllers\CMS\Playlists;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CMS\CMSPlaylistRepository;
use App\Http\Requests\CMS\Playlists\CreatePlaylist;
use App\Http\Requests\CMS\Playlists\UpdatePlaylist;
use App\Models\Playlist;
use App\Services\SelectBoxes\SelectBoxService;

class PlaylistsController extends Controller
{
    public function __construct(
        protected CMSPlaylistRepository $playlists, 
        protected SelectBoxService $selectBox
    ){}


    /**
     * Display a listing of the resource.
     * GET /cms/playlists
     * 
     * @param \Illuminate\Http\Request 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return View('cms.playlists.index', [
            'playlists' => $this->playlists->getPaginated()
        ]);
    }


    /**
     * Show the form for creating a new resource.
     * GET /cms/playlists/create
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('cms.playlists.create', [
            'genreList' => $this->selectBox->createFrom('App\Models\Genre')
                ->orderBy('genre')
                ->display('genre')
                ->asArray()
        ]);
    }


    /**
     * Store a newly created resource in storage.
     * POST /cms/playlists
     * 
     * @param  \App\Http\Requests\CMS\Playlists\CreatePlaylist  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePlaylist $request)
    {
        $this->playlists->store($request->all());

        return redirect()
            ->route('cms.playlists.create')
            ->with('success','Playlist created successfully!');   
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
     * GET /cms/playlists/{$slug}/edit
     * 
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit(Playlist $playlist)
    {
        return View('cms.playlists.edit', [
            'playlist'  => $playlist,
            'genreList' => $this->selectBox->createFrom('App\Models\Genre')
                ->orderBy('genre')
                ->display('genre')
                ->asArray()
        ]);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  string  $slug
     * @param  \Illuminate\Http\Request  $request
     *      
     * @return \Illuminate\Http\Response
     */
    public function update(Playlist $playlist, UpdatePlaylist $request)
    {
        $playlist = $this->playlists->update($playlist->id, $request->all());

        return redirect()
            ->route('cms.playlists.edit', $playlist->slug)
            ->with('success',"Playlist updated successfully!");   
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
