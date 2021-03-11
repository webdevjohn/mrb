<?php

namespace App\Http\Controllers\CMS;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Repositories\CMS\CMSLabelRepository;
use App\Http\Requests\CMS\Labels\CreateLabel;
use App\Http\Requests\CMS\Labels\UpdateLabel;

class LabelsController extends Controller
{

    protected $labels;

    public function __construct(CMSLabelRepository $labels)
    {
        $this->labels = $labels;        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('cms.labels.index', [
            'page'      => 'Labels',
            'labels'    => $this->labels->getLabels()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('cms.labels.create', [
            'page' => 'Labels'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(CreateLabel $request)
    {
        $this->labels->store($request->all());
        return redirect()
            ->route('cms.labels.create')
            ->with('success','Label created successfully!');  
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
        $label = $this->labels->find($id);
        return View('cms.labels.edit', [
            'page'  => 'Labels',
            'label' => $label
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CMS\Labels\UpdateLabel  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLabel $request, $id)
    {
        $label = $this->labels->update($id, $request->all());

        return redirect()
            ->route('cms.labels.edit', $label->id)
            ->with('success',"Label updated successfully!");   
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
