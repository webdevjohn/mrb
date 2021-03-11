<?php

namespace App\Http\Controllers\CMS\Albums;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\Albums\CreateAlbum;
use App\Http\Requests\CMS\Albums\UpdateAlbum;
use App\Models\Album;
use App\Repositories\CMS\CMSAlbumRepository;
use App\Repositories\ComboListsRepository;

class AlbumsController extends Controller
{
    public function __construct(
       protected CMSAlbumRepository $albums, 
       protected ComboListsRepository $comboLists
    ){}

    /**
     * Display a listing of the resource.
     * GET /cms/albums
     * 
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('cms.albums.index', [
            'albums' => $this->albums->getAlbums()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('cms.albums.create', [
            'genreList'     => $this->comboLists->getList('App\Models\Genre', 'genre'),
            'labelList'     => $this->comboLists->getList('App\Models\Label', 'label'),
            'formatList'    => $this->comboLists->getList('App\Models\Format', 'format')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(CreateAlbum $request)
    {
        $this->albums->store(
            $request->validated()
        );
        
        return redirect()
            ->route('cms.albums.create')
            ->with('success','Album created successfully!');  
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
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        return View('cms.albums.edit', [
            'album'         => $album,
            'genreList'     => $this->comboLists->getList('App\Models\Genre', 'genre'),
            'labelList'     => $this->comboLists->getList('App\Models\Label', 'label'),
            'formatList'    => $this->comboLists->getList('App\Models\Format', 'format')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CMS\albums\UpdateAlbum
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAlbum $request, Album $album)
    {
        $album = $this->albums->update(
            $album->id, 
            $request->validated()
        );

        return redirect()
            ->route("cms.albums.index")
            ->with("success", "Updated successfully!");          
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