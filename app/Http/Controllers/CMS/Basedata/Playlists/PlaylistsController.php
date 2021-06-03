<?php

namespace App\Http\Controllers\CMS\Basedata\Playlists;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\Playlists\CreatePlaylist;
use App\Http\Requests\CMS\Playlists\UpdatePlaylist;
use App\Models\Playlist;
use App\Services\CRUD\Playlist\PlaylistCreationService;
use App\Services\CRUD\Playlist\PlaylistUpdateService;
use Webdevjohn\SelectBoxes\SelectBoxService;

class PlaylistsController extends Controller
{
    public function __construct(
        protected Playlist $playlists, 
        protected SelectBoxService $selectBoxes
    ){}

    /**
     * Display a listing of the resource.
     * 
     * @return Illuminate\View\View 
     */
    public function index()
    {
        return View('cms.basedata.playlists.index', [
            'playlists' => $this->playlists->paginate(48)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return Illuminate\View\View 
     */
    public function create()
    {
        return View('cms.basedata.playlists.create', [
            'genreList' => $this->selectBoxes->createFrom('App\Models\Genre')
                ->orderBy('genre')
                ->display('genre')
                ->asArray()
        ]);
    }

    /**
     * Store a newly created playlist.
     *
     * @param CreatePlaylist $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(CreatePlaylist $request, PlaylistCreationService $playlistCreationService)
    {
        $playlistCreationService->create($request->validated());

        return redirect()
            ->route('cms.basedata.playlists.create')
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
     * Show the form for editing the specified playlist.
     *
     * @param Playlist $playlist
     * 
     * @return Illuminate\View\View 
     */
    public function edit(Playlist $playlist)
    {
        return View('cms.basedata.playlists.edit', [
            'playlist'  => $playlist,
            'genreList' => $this->selectBoxes->createFrom('App\Models\Genre')
                ->orderBy('genre')
                ->display('genre')
                ->asArray()
        ]);
    }

    /**
     * Update the specified playlist.
     *
     * @param UpdatePlaylist $request
     * @param Playlist $playlist
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePlaylist $request, Playlist $playlist, PlaylistUpdateService $playlistUpdateService)
    {
        $playlistUpdateService->update($request->validated(), $playlist);

        return redirect()
            ->route('cms.basedata.playlists.index')
            ->with('success',"Playlist updated successfully!");   
    }

    /**
     * Remove the specified playlist.
     *
     * @param Playlist $playlist
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function destroy(Playlist $playlist)
    {
        //
    }
}
