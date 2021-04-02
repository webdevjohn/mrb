<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\Labels\CreateLabel;
use App\Http\Requests\CMS\Labels\UpdateLabel;
use App\Models\Label;
use App\Services\ImageResize\LabelImageResize;

class LabelsController extends Controller
{
    public function __construct(
        protected Label $labels,
        protected LabelImageResize $labelImageResize
    ){}

    /**
     * Display all labels.
     *
     * @return Illuminate\View\View 
     */
    public function index()
    {
        return View('cms.labels.index', [     
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
        return View('cms.labels.create');
    }

    /**
     * Store a newly created label.
     *
     * @param CreateLabel $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(CreateLabel $request)
    {            
        if ($request->file('image')) {
            
            $this->labelImageResize->setUp($request->file('image'));

            $this->labels->create(
                array_merge($request->validated(), [
                    'label_image' => $this->labelImageResize->main(),
                    'label_thumbnail' => $this->labelImageResize->thumb()
                ])
            );

        } else {
            $this->labels->create($request->validated());
        }

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
     * @param Label $label
     * 
     * @return Illuminate\View\View 
     */
    public function edit(Label $label)
    {
        return View('cms.labels.edit', [   
            'label' => $label
        ]);
    }

    /**
     * Update an existing label.
     *
     * @param UpdateLabel $request
     * @param Label $label
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(UpdateLabel $request, Label $label)
    {
        if ($request->file('image')) {

            $this->labelImageResize->setUp($request->file('image'));

            $label->fill(
                array_merge($request->validated(), [
                    'label_image' => $this->labelImageResize->main(),
                    'label_thumbnail' => $this->labelImageResize->thumb()
                ])
            )->save();

        } else {            
            $label->fill($request->validated())->save();
        }

        return redirect()
            ->route('cms.labels.index')
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
