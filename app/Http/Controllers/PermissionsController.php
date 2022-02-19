<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use Spatie\Permission\Models\Permission;

use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\DB;

use Inertia\Inertia;

class PermissionsController extends Controller
{
    public function index(){
        return Inertia::render('Permissions/Index', [
            'permissions' => Permission::orderBy('id','ASC')
            ->get()
            ->transform(function ($permission) {
                return [
                    'id' => $permission->id,
                    'name' => $permission->name,
                    'guard_name' => $permission->guard_name,
                ];
            }),

        ]);
    }

    public function create()
    {
        return Inertia::render('Permissions/Create',[
            'permissions' => Permission::orderBy('name')
            ->get()
            ->map
            ->only('id', 'name'),
        ]);
    }


    public function edit(Permission $permission)
    { 
    //if( Auth::user()->hasRole('admin') ) return true;
    //Only user awith same id can edit , if user is admin than proceed

        return Inertia::render('Permissions/Edit', [
            'permission' => [
                'id' => $permission->id,
                'name' => $permission->name,
                'guard_name' => $permission->guard_name,
            ]
        ]);
    }

    public function update(Request $request, $permission)
    {
        
        $request->validate(
            [
                'name' => ['required', 'max:50'],
                'guard_name' => ['required', 'max:50'],
            ]
        );
 

        $permission = Permission::find($permission);
        $permission->name = $request->input('name');
        $permission->save();

        return Redirect::back()->with('success', 'Permission updated.');
    }


    public function store(Request $request)
    {
        
        $request->validate(
            [
                'name' => ['required', 'max:50'],
                'guard_name' => ['required', 'max:50'],
            ]
        );
 
        // create permissions
        Permission::create(
            [
                'guard_name' => $request->input('guard_name'), 
                'name' => $request->input('name')
            ]
        );

        return Redirect::route('permissions')->with('success', 'Permission created.');

    }

    public function destroy(Permission $permission)
    {
        
        //$permission =  Permission::find(4);
        //print("<pre>".print_r($permission,true)."</pre>"); exit;

        $permission->forceDelete();

        return Redirect::route('permissions')->with('success', 'Permission Trashed.');
    }

}
