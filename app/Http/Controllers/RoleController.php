<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{

    public function index(Request $request)
    {
      $keyword = $request->get('search');
      $perPage = 15;

      if (!empty($keyword)) {
          $role = Role::where('name', 'LIKE', "%$keyword%")
              ->latest()->paginate($perPage);
      } else {
          $role = Role::latest()->paginate($perPage);
      }

      return view('role.index', compact('role'));
    }

    public function show($id)
    {
        $role = Role::findOrFail($id);

        return view('role.show', compact('role'));
    }

    public function create()
    {
      $permissions = Permission::all();
      $permissionsArray = [];
      foreach ($permissions as $permission) {
        $permissionsArray[$permission->id] = $permission->name;
      }
      return view('role.create')->with('permissionsArray',$permissionsArray);
    }

    public function store(Request $request)
    {

      $requestData = $request->except('permissions');
      $permissions=$request->permissions;
      $role=Role::create($requestData);

      $role->givePermissionTo($permissions);

      return redirect('role')->with('flash_message', 'Role added!');

    }

    public function edit($id)
    {

        $role = Role::findOrFail($id);

        $permissions = Permission::all();
        $permissionsArray = [];
        foreach ($permissions as $permission) {
          $permissionsArray[$permission->id] = $permission->name;
        }

        return view('role.edit', compact('role','permissionsArray','permissions'));
    }

    public function update(Request $request, $id)
    {

        $requestData = $request->except('permissions');
        $permissions=$request->permissions;

        $role = Role::findOrFail($id);
        $role->update($requestData);

        $role->syncPermissions($permissions);

        return redirect('role')->with('flash_message', 'Role updated!');
    }

    public function destroy($id)
    {
        Role::destroy($id);

        return redirect('role')->with('flash_message', 'Permission deleted!');
    }    


}
