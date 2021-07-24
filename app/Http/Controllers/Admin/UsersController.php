<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{
    public function index()
    {
    	return view('admin.users.index');
    }

    public function paginate()
    {
    	$limit = (request('length') != '') ? request('length') : 10;
        $offset = (request('start') != '') ? request('start') : 0;

        $users = User::with('role')->orderBy('id', 'asc');
        $result['count'] = $users->count();
        $result['data']  = $users->limit($limit)->offset($offset)->get();
        $data = ["iTotalDisplayRecords" => $result['count'], "iTotalRecords" => $limit, "TotalDisplayRecords" => $limit];
        $data['data'] = $result['data'];
        return response()->json($data);
    }

    public function add()
    {
    	$roles 		=	Role::where('status', 1)->pluck('name', 'id')->toArray();
    	return view('admin.users.add')->with(compact('roles'));
    }

    public function create(CreateUserRequest $request)
    {
    	$user 					=	new User();
    	$user->first_name 		=	$request->first_name;
    	$user->last_name 		=	$request->last_name;
    	$user->email 			=	$request->email;
    	$user->password 		=	Hash::make($request->password);
    	$user->is_verified 		=	1;
    	$user->role_id 			=	$request->role_id;
    	$user->status 			=	$request->status;
    	$user->create_by		=	Auth::user()->id;
    	$user->updated_by		=	Auth::user()->id;
    	if($user->save()){
    		return redirect(route('admin.users'))->with('success', 'User created successfully'); 
    	}else{
            return redirect()->back()->with('error', 'Something went wrong'); 
    	}
    }

    public function view($id)
    {
    	$user 					=	User::where('id', $id)->with('role')->first();
    	return view('admin.users.view')->with(compact('user'));
    }

    public function edit($id)
    {
    	$roles 					=	Role::where('status', 1)->pluck('name', 'id')->toArray();
    	$user 					=	User::where('id', $id)->with('role')->first();
    	return view('admin.users.edit')->with(compact('user', 'roles'));	
    }

    public function update(UpdateUserRequest $request)
    {
    	$user 					=	User::where('id', $request->id)->first();
    	$user->first_name 		=	$request->first_name;
    	$user->last_name 		=	$request->last_name;
    	$user->email 			=	$request->email;
    	$user->role_id 			=	$request->role_id;
    	$user->status 			=	$request->status;
    	$user->updated_by		=	Auth::user()->id;
    	if($user->save()){
    		return redirect(route('admin.users'))->with('success', 'User updated successfully'); 
    	}else{
            return redirect()->back()->with('error', 'Something went wrong'); 
    	}
    }

    public function delete($id)
    {
    	try{
            User::where('id', $id)->delete();
            return redirect()->back()->with('success', 'User deleted successfully'); 
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Failed to delete the user'); 
        }
    }
}
