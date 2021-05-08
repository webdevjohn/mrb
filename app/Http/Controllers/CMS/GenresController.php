<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\Genres\CreateGenre;
use App\Http\Requests\CMS\Genres\UpdateGenre;
use App\Models\Genre;
use Illuminate\Support\Str;

class GenresController extends Controller
{
    public function __construct(
        protected Genre $genres
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return Illuminate\View\View 
     */
    public function index()
    {
        return View('cms.genres.index', [
            'genres' => $this->genres->paginate(48)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Illuminate\View\View 
     */
    public function create()
    {
        return View('cms.genres.create');
    }

    /**
     * Store a newly created genre.
     *
     * @param CreateGenre $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(CreateGenre $request)
    {
        $this->genres->create(
            array_merge($request->validated(), [
                'slug' => Str::slug($request->genre)
            ])   
        );

        return redirect()
            ->route('cms.basedata.genres.create')
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
     * Show the form for editing the specified genre.
     *
     * @param Genre $genre
     * 
     * @return Illuminate\View\View 
     */
    public function edit(Genre $genre)
    {
        return View('cms.genres.edit', [     
            'genre' => $genre
        ]);
    }

    /**
     * Update the specified genre.
     *
     * @param UpdateGenre $request
     * @param Genre $genre
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(UpdateGenre $request, Genre $genre)
    {
        $genre->fill(
            array_merge($request->validated(), [
                'slug' => Str::slug($request->genre)
            ])   
        )->save();
        
        return redirect()
            ->route('cms.basedata.genres.index')
            ->with('success',"Genre updated successfully!");   
    }

    /**
     * Remove the specified genre from storage.
     *
     * @param Genre $genre
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function destroy(Genre $genre)
    {
        //
    }
}
