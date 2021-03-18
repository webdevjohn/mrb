<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\Artists\CreateArtist;
use App\Http\Requests\CMS\Artists\UpdateArtist;
use App\Models\Artist;

class ArtistsController extends Controller
{
    public function __construct(
        protected Artist $artists
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return Illuminate\View\View 
     */
    public function index()
    {
        return View('cms.artists.index', [
            'artists' => $this->artists->paginate(48)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Illuminate\View\View 
     */
    public function create()
    {
        return View('cms.artists.create', [
            'page' => 'Artists'
        ]);
    }

    /**
     * Store a newly created artist.
     *
     * @param CreateArtist $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(CreateArtist $request)
    {
        $this->artists->create(
            $request->validated()
        );

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
     * @param Artist $artist
     * 
     * @return Illuminate\View\View 
     */
    public function edit(Artist $artist)
    {
        return View('cms.artists.edit', [
            'artist' => $artist
        ]);
    }

    /**
     * Update the specified artist.
     *
     * @param UpdateArtist $request
     * @param Artist $artist
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(UpdateArtist $request, Artist $artist)
    {
        $artist->fill(
            $request->validated()
        )->save();

        return redirect()
            ->route('cms.artists.index')
            ->with('success',"Artist updated successfully!");   
    }

    /**
     * Remove the specified artist from storage.
     *
     * @param Artist $artist
     * @return Illuminate\Http\RedirectResponse
     */
    public function destroy(Artist $artist)
    {
        //
    }
}
