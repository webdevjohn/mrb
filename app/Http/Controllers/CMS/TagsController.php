<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Repositories\TagRepository;
use App\Http\Requests\CMS\Tags\CreateTag;
use App\Http\Requests\CMS\Tags\UpdateTag;

class TagsController extends Controller
{
    protected $tags;

    public function __construct(TagRepository $tags)
    {
        $this->tags = $tags;        
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('cms.tags.index', [
            'page' => 'Tags',
            'tags' => $this->tags->getPaginated()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('cms.tags.create', [
            'page' => 'Tags'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(CreateTag $request)
    {
        $this->tags->store($request->all());
        return redirect()
            ->route('cms.tags.create')
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = $this->tags->find($id);
        return View('cms.tags.edit', [
            'page'  => 'Tags',
            'tag'   => $tag,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CMS\Tags\UpdateTag  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTag $request, $id)
    {
        $tag = $this->tags->update($id, $request->all());

        return redirect()
            ->route('cms.tags.edit', $tag->id)
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
