<?php

namespace App\Http\Controllers\CMS\Albums\Tracks;
 
use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\Albums\Tracks\CreateAlbumTrack;
use App\Http\Requests\CMS\Albums\Tracks\UpdateAlbumTrack;
use App\Models\Album;
use App\Models\Track;
use App\Repositories\ComboListsRepository;

class TracksController extends Controller
{
    public function __construct(
       protected Album $albums, 
       protected Track $tracks,
       protected ComboListsRepository $comboLists
    ){}

    /**
     * Display a listing of the resource.
     * GET /cms/albums/{album)/tracks
     *
     * @return \Illuminate\View\View
     */
    public function index(Album $album)
    {
        return View('cms.albums.tracks.index', [
            'page' => 'Albums',
            'album' => $this->albums->getAlbumTracks($album->slug)
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
            'page'          => 'Albums',
            'album'         => $album,
            'artistList'    => $this->comboLists->getList('App\Models\Artist', 'artist_name', false),
            'genreList'     => $this->comboLists->getList('App\Models\Genre', 'genre'),
            'labelList'     => $this->comboLists->getList('App\Models\Label', 'label'),
            'tagList'       => $this->comboLists->getList('App\Models\Tag', 'tag', false) 
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
        $this->tracks->store(
            $request->validated()
        );

        return redirect()
            ->route('cms.albums.tracks.create', $album->slug)
            ->with('success',"Track added to $album->title successfully!");   
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
            'album'         => $album,
            'track'         => $track,
            'artistList'    => $this->comboLists->getList('App\Models\Artist', 'artist_name', false),
            'genreList'     => $this->comboLists->getList('App\Models\Genre', 'genre'),
            'labelList'     => $this->comboLists->getList('App\Models\Label', 'label'),
            'tagList'       => $this->comboLists->getList('App\Models\Tag', 'tag', false) 
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
        $track = $this->tracks->amend(
            $track, 
            $request->validated()
        );

        return redirect()
            ->route("cms.albums.tracks.index", [$album->slug])
            ->with("success", "The track: $track->title has been updated successfully on the album: $album->title");              
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
