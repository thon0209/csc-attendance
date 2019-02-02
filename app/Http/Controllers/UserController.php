<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $user = User::where('name', 'LIKE', "%$keyword%")
                -> latest()->paginate($perPage);
        } else {
            $user = User::latest()->paginate($perPage);
        }

        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {

        $roles = Role::all();
        $rolesArray = [];
        foreach ($roles as $role) {
          $rolesArray[$role->id] = $role->name;
        }
        return view('user.create')->with('rolesArray',$rolesArray);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

      $this->validate($request, [
          'name' => 'required',
          'username' => 'required|unique:users,username',
          'email' => 'required|unique:users,email',
          'password' => 'required|between:6,20|confirmed'
      ]);

        $requestData = $request->except('roles');
        $roles=$request->roles;
        $user = User::create($requestData);
        $user->assignRole($roles);
        return redirect('user')->with('flash_message', 'User added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {

        $roles = Role::all();
        $rolesArray = [];

        foreach ($roles as $role) {
          $rolesArray[$role->id] = $role->name;
        }

        $user = User::findOrFail($id);


        return view('user.edit', compact('user','rolesArray','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {

      $user = User::findOrFail($id);
      $requestData = $request->only(['name','username','email','password']);
      $roles = $request['roles'];
      $user->fill($requestData)->save();

      if (isset($roles)) {
          $user->roles()->sync($roles);
      }
      else {
          $user->roles()->detach();
      }

    //  $user->synRoles($request->roles);

      return redirect('user')->with('flash_message', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect('user')->with('flash_message', 'User deleted!');
    }    


}
