<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\Formats\CreateFormat;
use App\Http\Requests\CMS\Formats\UpdateFormat;
use App\Models\Format;

class FormatsController extends Controller
{
    public function __construct(
        protected Format $formats
    ){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View 
     */
    public function index()
    {
        return View('cms.formats.index', [
            'formats' => $this->formats->paginate(48)
        ]);
    }

    /**
     * Show the form for creating a new format.
     *
     * @return \Illuminate\View\View 
     */
    public function create()
    {
        return View('cms.formats.create');
    }

    /**
     * Store a newly created format.n
     *
     * @param CreateFormat $request
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateFormat $request)
    {
        $this->formats->create(
            $request->validated()
        );

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
     * Show the form for editing an existing format.
     *
     * @param Format $format
     * 
     * @return \Illuminate\View\View 
     */
    public function edit(Format $format)
    {
        return View('cms.formats.edit', [     
            'format' => $format
        ]);
    }

    /**
     * Update an existing format.
     *
     * @param UpdateFormat
     * @param Format $format
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateFormat $request, Format $format)
    {
        $format->fill(
            $request->validated()
        )->save();

        return redirect()
            ->route('cms.formats.index')
            ->with('success',"Format updated successfully!");   
    }

    /**
     * Remove the specified format from storage.
     *
     * @param format $format
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Format $format)
    {
        //
    }
}
