<?php

namespace App\Http\Controllers\CMS\Basedata;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\Tags\CreateTag;
use App\Http\Requests\CMS\Tags\UpdateTag;
use App\Models\Tag;

class TagsController extends Controller
{
    public function __construct(
        protected Tag $tags
    ){}


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return View('cms.basedata.tags.index', [
            'tags' => $this->tags->orderBy('tag')->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return View('cms.basedata.tags.create');
    }

    /**
     * Store a new Tag.
     *
     * @param CreateTag $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(CreateTag $request)
    {
        $this->tags->create(
            $request->validated()
        );
        
        return redirect()
            ->route('cms.basedata.tags.create')
            ->with('success','Tag created successfully!');  
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
     * @param Tag $tag
     * 
     * @return \Illuminate\View\View
     */
    public function edit(Tag $tag)
    {        
        return View('cms.basedata.tags.edit', [
            'tag' => $tag
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateTag $request
     * @param Tag $tag
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(UpdateTag $request, Tag $tag)
    {             
        $tag->fill($request->validated())->save();
        
        return redirect()
            ->route('cms.basedata.tags.index')
            ->with('success',"Tag updated successfully!");   
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
