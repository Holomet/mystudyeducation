<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Auth;

class RolesController extends Controller
{
    public function index()
    {
    	return view('admin.roles.index');
    }

    public function paginate()
    {
    	$limit = (request('length') != '') ? request('length') : 10;
        $offset = (request('start') != '') ? request('start') : 0;
        
        $roles = Role::orderBy('id', 'asc');
        $result['count'] = $roles->count();
        $result['data']  = $roles->limit($limit)->offset($offset)->get();
        $data = ["iTotalDisplayRecords" => $result['count'], "iTotalRecords" => $limit, "TotalDisplayRecords" => $limit];
        $data['data'] = $result['data'];
        return response()->json($data);
    }

    public function create(CreateRoleRequest $request){
    	$role 				=	new Role();
    	$role->name 		=	$request->name;
    	$role->status 		=	$request->status;
    	$role->created_by 	=	Auth::user()->id;
    	$role->updated_by 	=	Auth::user()->id;
    	if($role->save())
    	{
    		return ['status' => 1];
    	}else{
    		return ['status' => 0];
    	}
    }

    public function edit($id)
    {
    	$role 				=	Role::where('id', $id)->first();
    	return view('admin.roles.edit')->with(compact('role'));
    }

    public function update(UpdateRoleRequest $request)
    {
    	$role 				=	Role::where('id', $request->id)->first();
    	$role->name 		=	$request->name;
    	$role->status 		=	$request->status;
    	$role->updated_by 	=	Auth::user()->id;
    	if($role->save())
    	{
    		return ['status' => 1];
    	}else{
    		return ['status' => 0];
    	}
    }

    public function delete($id)
    {
    	try{
            Role::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Role deleted successfully'); 
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Failed to delete the role'); 
        }
    }
}
