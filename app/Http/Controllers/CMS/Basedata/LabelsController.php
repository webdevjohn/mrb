<?php

namespace App\Http\Controllers\CMS\Basedata;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\Labels\CreateLabel;
use App\Http\Requests\CMS\Labels\UpdateLabel;
use App\Models\Label;
use App\Services\CRUD\Label\LabelCreationService;
use App\Services\CRUD\Label\LabelUpdateService;

class LabelsController extends Controller
{
    public function __construct(
        protected Label $labels,
    ){}

    /**
     * Display all labels.
     *
     * @return Illuminate\View\View 
     */
    public function index()
    {
        return View('cms.basedata.labels.index', [     
            'labels' => $this->labels->WithFields()
                ->orderBy('label')
                ->paginate(48)
        ]);
    }

    /**
     * Show the form for creating a new label.
     *
     * @return Illuminate\View\View 
     */
    public function create()
    {
        return View('cms.basedata.labels.create');
    }

    /**
     * Store a newly created label.
     *
     * @param CreateLabel $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(CreateLabel $request, LabelCreationService $labelCreationService)
    {               
        $labelCreationService->create($request->validated());
        
        return redirect()
            ->route('cms.basedata.labels.create')
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
     * @param Label $label
     * 
     * @return Illuminate\View\View 
     */
    public function edit(Label $label)
    {
        return View('cms.basedata.labels.edit', [   
            'label' => $label
        ]);
    }

    /**
     * Update an existing label.
     *
     * @param UpdateLabel $request
     * @param Label $label
     * @param LabelUpdateService $labelUpdateService
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(UpdateLabel $request, Label $label, LabelUpdateService $labelUpdateService)
    {
        $labelUpdateService->update($request->validated(), $label);
 
        return redirect()
            ->route('cms.basedata.labels.index')
            ->with('success',"Label updated successfully!");   
    }

    /**
     * Remove the specified label from storage.
     *
     * @param Label $label
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function destroy(Label $label)
    {
        //
    }
}
