<?php

namespace App\Http\Controllers\CMS\Albums;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\Albums\CreateAlbum;
use App\Http\Requests\CMS\Albums\UpdateAlbum;
use App\Models\Album;
use App\Services\SelectBoxes\Pages\CMS\AlbumsCreateEdit;
use Illuminate\Support\Str;

class AlbumsController extends Controller
{
    public function __construct(
       protected Album $albums, 
       protected AlbumsCreateEdit $selectBoxes
    ){}

    /**
     * Display a listing of the resource.
     * GET /cms/albums
     * 
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return View('cms.basedata.albums.index', [
            'albums' => $this->albums->orderBy('purchase_date', 'DESC')->paginate(48)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
       return View('cms.basedata.albums.create', [                
           'selectBoxes' => $this->selectBoxes->get(),
       ]);
    }

    /**    
     * @param CreateAlbum $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(CreateAlbum $request)
    {
        $this->albums->create(
            array_merge($request->validated(), [
                'slug' => Str::slug($request->title)
            ])          
        );
        
        return redirect()
            ->route('cms.basedata.albums.create')
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
     * @param Album $album
     * 
     * @return \Illuminate\View\View
     */
    public function edit(Album $album)
    {
        return View('cms.basedata.albums.edit', [
            'album' => $album,
            'selectBoxes' => $this->selectBoxes->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateAlbum $request
     * @param Album $album
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(UpdateAlbum $request, Album $album)
    {
        $album->fill(
            array_merge($request->validated(), [
                'slug' => Str::slug($request->title)
            ])  
        )->save();

        return redirect()
            ->route("cms.basedata.albums.index")
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
