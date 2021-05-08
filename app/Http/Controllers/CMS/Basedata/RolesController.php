<?php

namespace App\Http\Controllers\CMS\Basedata;

use App\Http\Controllers\Controller;
use App\Http\Requests\CMS\Roles\CreateRole;
use App\Http\Requests\CMS\Roles\UpdateRole;
use App\Models\Role;

class RolesController extends Controller
{
    public function __construct(
        protected Role $roles
    ){}

    /**
     * Display all roles.
     *
     * @return Illuminate\View\View 
     */
    public function index()
    {
        return View('cms.roles.index', [
            'roles' => $this->roles->orderBy('role')->paginate(25)
        ]);
    }

    /**
     * Show the form for creating a new role.
     *
     * @return Illuminate\View\View 
     */
    public function create()
    {
        return View('cms.roles.create', [
            'roles' => $this->roles->orderBy('role')->paginate(25)
        ]);
    }

    /**
     * Store a newly created role.
     *
     * @param CreateRole $request
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(CreateRole $request)
    {
        $this->roles->create(
            $request->validated()
        );

        return redirect()
            ->route('cms.basedata.roles.create')
            ->with('success','Role created successfully!');  
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
     * Edit an existing role.
     *
     * @param Role $role
     * 
     * @return Illuminate\View\View 
     */
    public function edit(Role $role)
    {
        return View('cms.roles.edit', [
            'role' => $role
        ]);
    }

    /**
     * Update the specified role.
     *
     * @param UpdateRole $request
     * @param Role $role
     * 
     * @return Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRole $request, Role $role)
    {
        $role->fill($request->validated())->save();

        return redirect()
            ->route('cms.basedata.roles.index')
            ->with('success',"Role updated successfully!");   
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
