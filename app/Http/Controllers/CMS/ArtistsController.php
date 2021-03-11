<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Repositories\CMS\CMSArtistRepository;
use App\Http\Requests\CMS\Artists\CreateArtist;
use App\Http\Requests\CMS\Artists\UpdateArtist;

class ArtistsController extends Controller
{
    protected $artists;

    public function __construct(CMSArtistRepository $artists)
    {
        $this->artists = $artists;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('cms.artists.index', [
            'page' => 'Artists',
            'artists' => $this->artists->getPaginated()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('cms.artists.create', [
            'page' => 'Artists'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(CreateArtist $request)
    {
        $this->artists->store($request->all());
        return redirect()
            ->route('cms.artists.create')
            ->with('success','Artist created successfully!');  
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
        $artist = $this->artists->find($id);
        return View('cms.artists.edit', [
            'page' => 'Artists',
            'artist' => $artist
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CMS\Artists\UpdateArtist
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArtist $request, $id)
    {
        $artist = $this->artists->update($id, $request->all());

        return redirect()
            ->route('cms.artists.edit', $artist->id)
            ->with('success',"Artist updated successfully!");   
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
