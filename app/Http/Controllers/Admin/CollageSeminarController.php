<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collage;
use App\Models\Seminar;
use App\Http\Requests\CreateSeminarRequest;
use App\Http\Requests\UpdateSeminarRequest;

class CollageSeminarController extends Controller
{
    public function index($id)
    {
    	if(\Auth::user()->role_id!=1)
    	{
    		$collage 	=	Collage::where('id', $id)->where('user_id', \Auth::user()->id)->first();
    		if(empty($collage))
    		{
    			return response('Unautherised.', 401);
    		}
    	}
    	return view('admin.collages.seminars.index')->with(compact('id'));
    }

    public function all()
    {
        return view('admin.collages.seminars.all');   
    }
    public function paginate()
    {
    	$collage_id  = request('collage_id');
    	if(\Auth::user()->role_id!=1)
    	{
    		$collage 	=	Collage::where('id', $collage_id)->where('user_id', \Auth::user()->id)->first();
    		if(empty($collage))
    		{
    			$collage_id = 0;
    		}
    	}
    	$limit = (request('length') != '') ? request('length') : 10;
        $offset = (request('start') != '') ? request('start') : 0;
        
        $seminars = Seminar::where('college_id', $collage_id)->orderBy('id', 'asc');
        $result['count'] = $seminars->count();
        $result['data']  = $seminars->limit($limit)->offset($offset)->get();
        $data = ["iTotalDisplayRecords" => $result['count'], "iTotalRecords" => $limit, "TotalDisplayRecords" => $limit];
        $data['data'] = $result['data'];
        return response()->json($data);
    }

    public function paginateall()
    {
        $limit = (request('length') != '') ? request('length') : 10;
        $offset = (request('start') != '') ? request('start') : 0;
        
        $seminars = Seminar::orderBy('id', 'asc');
        $result['count'] = $seminars->count();
        $result['data']  = $seminars->limit($limit)->offset($offset)->get();
        $data = ["iTotalDisplayRecords" => $result['count'], "iTotalRecords" => $limit, "TotalDisplayRecords" => $limit];
        $data['data'] = $result['data'];
        return response()->json($data);   
    }

    public function add($id)
    {
    	if(\Auth::user()->role_id!=1)
    	{
    		$collage 	=	Collage::where('id', $id)->where('user_id', \Auth::user()->id)->first();
    		if(empty($collage))
    		{
    			return response('Unautherised.', 401);
    		}
    	}
    	return view('admin.collages.seminars.add')->with(compact('id'));	
    }

    public function addSeminar()
    {
        if(\Auth::user()->role_id!=1)
        {
            return response('Unautherised.', 401);
        }
        $collages           =   Collage::pluck('name','id')->toArray();
        return view('admin.collages.seminars.addnew')->with(compact('collages'));
    }

    public function create(CreateSeminarRequest $request)
    {
    	if(\Auth::user()->role_id!=1)
    	{
    		$collage 	=	Collage::where('id', $request->collage_id)->where('user_id', \Auth::user()->id)->first();
    		if(empty($collage))
    		{
    			return response('Unautherised.', 401);
    		}
    	}
    	$seminar 							=	new Seminar();
    	$seminar->college_id				=	$request->collage_id;
    	$seminar->name 						=	$request->name;
    	$seminar->description 				=	$request->description;
    	$seminar->url 						=	isset($request->url)?$request->url:"";
        $seminar->start_date                =   $request->start_date;
        if($request->end_date){
            $seminar->end_date                  =   $request->end_date?$request->end_date:"";
        }
    	$seminar->status 					=	$request->status;
    	$seminar->created_by 				=	\Auth::user()->id;
    	$seminar->updated_by				=	\Auth::user()->id;
    	if($seminar->save())
    	{
    		return redirect(route('admin.collages.seminars',['id' => $seminar->college_id]))->with('success', 'Seminar added successfully');
    	}else{
    		return redirect()->back()->with('error', 'Something went wrong');
    	}
    }

    public function createSeminar(CreateSeminarRequest $request)
    {
        if(\Auth::user()->role_id!=1)
        {
            return response('Unautherised.', 401);
        }
        $seminar                            =   new Seminar();
        if($request->collage_id)
        {
            $seminar->college_id                =   $request->collage_id?$request->collage_id:"";
        }
        $seminar->name                      =   $request->name;
        $seminar->description               =   $request->description;
        $seminar->url                       =   isset($request->url)?$request->url:"";
        $seminar->start_date                =   $request->start_date;
        if($request->end_date){
            $seminar->end_date                  =   $request->end_date?$request->end_date:"";
        }
        $seminar->status                    =   $request->status;
        $seminar->created_by                =   \Auth::user()->id;
        $seminar->updated_by                =   \Auth::user()->id;
        if($seminar->save())
        {
            return redirect(route('admin.collages.seminars.all',))->with('success', 'Seminar added successfully');
        }else{
            return redirect()->back()->with('error', 'Something went wrong');
        }   
    }

    public function edit($id)
    {
    	$seminar 				=	Seminar::where('id', $id)->first();
    	if(\Auth::user()->role_id!=1)
    	{
    		$collage 	=	Collage::where('id', $seminar->college_id)->where('user_id', \Auth::user()->id)->first();
    		if(empty($collage))
    		{
    			return response('Unautherised.', 401);
    		}
    	}
    	return view('admin.collages.seminars.edit')->with(compact('seminar'));	
    }

    public function editSeminar($id)
    {
        if(\Auth::user()->role_id!=1)
        {
            return response('Unautherised.', 401);
        }
        $seminar                =   Seminar::where('id', $id)->first();        
        $collages               =   Collage::pluck('name','id')->toArray();
        
        return view('admin.collages.seminars.editnew')->with(compact('seminar', 'collages'));     
    }

    public function update(UpdateSeminarRequest $request)
    {
    	$seminar 							=	Seminar::where('id', $request->id)->first();
    	if(\Auth::user()->role_id!=1)
    	{
    		$collage 	=	Collage::where('id', $seminar->college_id)->where('user_id', \Auth::user()->id)->first();
    		if(empty($collage))
    		{
    			return response('Unautherised.', 401);
    		}
    	}
    	$seminar->name 						=	$request->name;
    	$seminar->description 				=	$request->description;
    	$seminar->url 						=	isset($request->url)?$request->url:"";
        $seminar->start_date                =   $request->start_date;
        if($request->end_date){
            $seminar->end_date              =   $request->end_date;
        }
        else{
            $seminar->end_date              =   null;
        }
    	$seminar->status 					=	$request->status;
    	$seminar->updated_by				=	\Auth::user()->id;
    	if($seminar->save())
    	{
    		return redirect(route('admin.collages.seminars',['id' => $seminar->college_id]))->with('success', 'Seminar updateds successfully');
    	}else{
    		return redirect()->back()->with('error', 'Something went wrong');
    	}	
    }

    public function updateSeminar(UpdateSeminarRequest $request)
    {
        if(\Auth::user()->role_id!=1)
        {
            return response('Unautherised.', 401);
        }
        $seminar                            =   Seminar::where('id', $request->id)->first();
        if(isset($request->college_id)){
            $seminar->college_id            =   $request->college_id;
        }else{
            $seminar->college_id            =   null;
        }
        $seminar->name                      =   $request->name;
        $seminar->description               =   $request->description;
        $seminar->url                       =   isset($request->url)?$request->url:"";
        $seminar->start_date                =   $request->start_date;
        if($request->end_date){
            $seminar->end_date              =   $request->end_date;
        }
        else{
            $seminar->end_date              =   null;
        }
        $seminar->status                    =   $request->status;
        $seminar->updated_by                =   \Auth::user()->id;
        if($seminar->save())
        {
            return redirect(route('admin.collages.seminars.all'))->with('success', 'Seminar updateds successfully');
        }else{
            return redirect()->back()->with('error', 'Something went wrong');
        }   
    }

    public function view($id)
    {
    	$seminar 				=	Seminar::where('id', $id)->first();
    	if(\Auth::user()->role_id!=1)
    	{
    		$collage 	=	Collage::where('id', $seminar->college_id)->where('user_id', \Auth::user()->id)->first();
    		if(empty($collage))
    		{
    			return response('Unautherised.', 401);
    		}
    	}
    	return view('admin.collages.seminars.view')->with(compact('seminar'));	
    }

    public function delete($id)
    {
    	try{
    		if(\Auth::user()->role_id!=1)
	    	{
	    		$seminar 				=	Seminar::where('id', $id)->first();
	    		$collage 	=	Collage::where('id', $seminar->college_id)->where('user_id', \Auth::user()->id)->first();
	    		if(empty($collage))
	    		{
	    			return response('Unautherised.', 401);
	    		}
	    	}
            Seminar::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Seminar deleted successfully'); 
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Failed to delete the seminar'); 
        }
    }
}
