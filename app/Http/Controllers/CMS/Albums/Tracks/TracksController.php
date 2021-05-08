<?php

namespace App\Http\Controllers\CMS\Albums\Tracks;
 
use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\Albums\Tracks\CreateAlbumTrack;
use App\Http\Requests\CMS\Albums\Tracks\UpdateAlbumTrack;
use App\Models\Album;
use App\Models\Track;
use App\Services\SelectBoxes\Pages\CMS\AlbumsTracksCreateEdit;
use Illuminate\Http\Request;

class TracksController extends Controller
{
    public function __construct(
       protected Album $albums, 
       protected Track $tracks,
       protected AlbumsTracksCreateEdit $selectBoxes
    ){}

    /**
     * Display a listing of the resource.
     * GET /cms/albums/{album)/tracks
     *
     * @return \Illuminate\View\View
     */
    public function index(Album $album, Request $request)
    {
        return View('cms.albums.tracks.index', [
            'album' => $album,
            'tracks' => $album->tracks()->withFilters($request->input())->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * GET /cms/albums/{album)/tracks/create
     *
     * @param Album $album
     * 
     * @return \Illuminate\View\View
     */
    public function create(Album $album)
    {        
        return View('cms.albums.tracks.create', [            
            'album' => $album,
            'selectBoxes' => $this->selectBoxes->get()
        ]);
    }

    /**
     * Add a new track to an Album.
     * POST /cms/albums/{album)/tracks
     * 
     * @param CreateAlbumTrack $request
     * @param Album $album
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(CreateAlbumTrack $request, Album $album)
    {
        $this->tracks->create(
            $request->validated()
        );

        return redirect()
            ->route('cms.basedata.albums.tracks.index', $album->slug)
            ->with('success',"Successfully added a new track to: $album->title !");   
    }

    /**
     * Display the specified resource.
     *
     * @param Album $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET /cms/albums/{album)/tracks/{track}/edit
     *
     * @param Album $album
     * @param Track $track
     * 
     * @return \Illuminate\View\View
     */
    public function edit(Album $album, Track $track)
    {     
        return View('cms.albums.tracks.edit', [
            'album' => $album,
            'track' => $track,
            'selectBoxes' => $this->selectBoxes->get()
        ]);
    }

    /**
     * Update an existing track on an existing album.
     * PATCH /cms/albums/{album)/tracks/{track}
     *
     * @param UpdateAlbumTrack $request
     * @param Album $album
     * @param Track $track
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAlbumTrack $request, Album $album, Track $track)
    {
        $track->fill($request->validated())->save();

        return redirect()
            ->route("cms.basedata.albums.tracks.index", [$album->slug])
            ->with("success", "The track has been updated successfully on the album: $album->title");              
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
