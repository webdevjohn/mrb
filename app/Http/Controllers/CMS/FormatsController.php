<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Repositories\FormatRepository;
use App\Http\Requests\CMS\Formats\CreateFormat;
use App\Http\Requests\CMS\Formats\UpdateFormat;

class FormatsController extends Controller
{
    protected $formats;

    public function __construct(FormatRepository $formats)
    {
        $this->formats = $formats;        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('cms.formats.index', [
            'page'      => 'Formats',
            'formats'   => $this->formats->getPaginated()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('cms.formats.create', [
            'page' => 'Formats'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(CreateFormat $request)
    {
        $this->formats->store($request->all());
        return redirect()
            ->route('cms.formats.create')
            ->with('success','Format created successfully!');  
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
        $format = $this->formats->find($id);
        return View('cms.formats.edit', [
            'page'          => 'Formats',
            'format'        => $format
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CMS\Formats\UpdateFormat
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFormat $request, $id)
    {
        $format = $this->formats->update($id, $request->all());

        return redirect()
            ->route('cms.formats.edit', $format->id)
            ->with('success',"Format updated successfully!");   
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
