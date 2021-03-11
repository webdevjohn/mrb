<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\Genres\CreateGenre;
use App\Http\Requests\CMS\Genres\UpdateGenre;
use App\Repositories\CMS\CMSGenreRepository;

class GenresController extends Controller
{
    protected $genres;

    public function __construct(CMSGenreRepository $genres)
    {
        $this->genres = $genres;        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('cms.genres.index', [
            'page' => 'Genres',
            'genres' => $this->genres->getPaginated()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('cms.genres.create', [
            'page' => 'Genres'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(CreateGenre $request)
    {
        $this->genres->store($request->all());
        return redirect()
            ->route('cms.genres.create')
            ->with('success','Genre created successfully!');   
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
        $genre = $this->genres->find($id);
        return View('cms.genres.edit', [
            'page'  => 'Genres',
            'genre' => $genre
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CMS\Genres\UpdateGenre  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGenre $request, $id)
    {
        $genre = $this->genres->update($id, $request->all());
        
        return redirect()
            ->route('cms.genres.edit', $genre->id)
            ->with('success',"Genre updated successfully!");   
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
