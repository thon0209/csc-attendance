<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;
  
        if (!empty($keyword)) {
            $permission = Permission::where('name', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $permission = Permission::latest()->paginate($perPage);
        }
  
        return view('permission.index', compact('permission'));
    }
  
    public function create()
    {
        return view('permission.create');
    }
  
    public function store(Request $request)
    {
  
        $permission = new Permission;
        $permission->name = $request->name;
        $permission->save();
  
        return redirect('permission')->with('flash_message', 'Permission added!');
    }
  
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
  
        return view('permission.edit')->with('permission',$permission);;
    }
  
    public function update(Request $request, $id)
    {
  
        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->save();
  
        return redirect('permission')->with('flash_message', 'Permission updated!');
    }
  
    public function destroy($id)
    {
        Permission::destroy($id);
  
        return redirect('permission')->with('flash_message', 'Permission deleted!');
    }

}
