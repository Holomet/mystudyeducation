<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collage;
use App\Models\CollageCourse;
use App\Models\CourseCategory;
use App\Models\Course;
use App\Models\CourseFee;
use App\Http\Requests\CreateCollageCourse;
use App\Http\Requests\UpdateCollageCourse;

class CollageCourseController extends Controller
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
    	return view('admin.collages.courses.index')->with(compact('id'));
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
        
        $course = CollageCourse::with('course')->with('course.category')->where('college_id', $collage_id)->orderBy('id', 'asc');
        $result['count'] = $course->count();
        $result['data']  = $course->limit($limit)->offset($offset)->get();
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
    	$categories 			=	CourseCategory::pluck('name', 'id')->toArray();
    	return view('admin.collages.courses.add')->with(compact('id', 'categories'));
    }

    public function create(CreateCollageCourse $request)
    {
    	if(\Auth::user()->role_id!=1)
    	{
    		$collage 	=	Collage::where('id', $request->college_id)->where('user_id', \Auth::user()->id)->first();
    		if(empty($collage))
    		{
    			return response('Unautherised.', 401);
    		}
    	}
    	$course 				=	new CollageCourse();
    	$course->course_name 	=	$request->course_name;
    	$course->college_id 	=	$request->college_id;
    	$course->course_id 		=	$request->course_id;
    	$broschure 			= 	$request->broschure->getClientOriginalName();
    	if(!file_exists(public_path('/broschure/'))){
    		mkdir(public_path('/broschure/'));
    	}
    	while(file_exists(public_path('/broschure/').$broschure)){
    		$broschure = rand(1,100).$broschure;
    	}
        $request->broschure->move(public_path('/broschure/'), $broschure);
        $course->broschure		=	$broschure;
        $course->created_by 	=	\Auth::user()->id;
        $course->updated_by 	=	\Auth::user()->id;
        if($course->save())
        {
        	$coursefee 			=	new CourseFee();
        	$coursefee->college_course_id	=	$course->id;
        	$coursefee->fee_details	=	$request->fee_details;
        	$coursefee->link_more_details 	=	$request->link_more_details;
        	$coursefee->link_apply 	=	$request->link_apply;
        	$coursefee->status 	=	1;
        	$coursefee->created_by	=	\Auth::user()->id;
        	$coursefee->updated_by	=	\Auth::user()->id;
        	$coursefee->save();
        	return redirect(route('admin.collages.courses',['id' => $request->college_id]))->with('success', 'Course added successfully');
        }else{
        	return redirect()->back()->with('error', 'Something went wrong');
        }
    }

    public function view($id)
    {
    	$course 		=	CollageCourse::with('course')->with('course.category')->where('id', $id)->first();
    	if(\Auth::user()->role_id!=1)
    	{
    		$collage 	=	Collage::where('id', $course->college_id)->where('user_id', \Auth::user()->id)->first();
    		if(empty($collage))
    		{
    			return response('Unautherised.', 401);
    		}
    	}
    	$coursefee 		=	CourseFee::where('college_course_id', $id)->first();
    	return view('admin.collages.courses.view')->with(compact('course', 'coursefee'));
    }

    public function edit($id)
    {
    	$course 		=	CollageCourse::with('course')->with('course.category')->where('id', $id)->first();
    	if(\Auth::user()->role_id!=1)
    	{
    		$collage 	=	Collage::where('id', $course->college_id)->where('user_id', \Auth::user()->id)->first();
    		if(empty($collage))
    		{
    			return response('Unautherised.', 401);
    		}
    	}
    	$coursefee 		=	CourseFee::where('college_course_id', $id)->first();
    	$courses 		=	Course::where('course_category_id', $course->course->course_category_id)->pluck('name', 'id')->toArray();
    	$categories 			=	CourseCategory::pluck('name', 'id')->toArray();
    	return view('admin.collages.courses.edit')->with(compact('id', 'categories', 'course', 'courses', 'coursefee'));	
    }

    public function update(UpdateCollageCourse $request)
    {
    	$course 				=	CollageCourse::where('id', $request->id)->first();
    	if(\Auth::user()->role_id!=1)
    	{
    		$collage 	=	Collage::where('id', $course->college_id)->where('user_id', \Auth::user()->id)->first();
    		if(empty($collage))
    		{
    			return response('Unautherised.', 401);
    		}
    	}
    	$course->course_name 	=	$request->course_name;
    	$course->course_id 		=	$request->course_id;
    	if($request->broschure){
	    	$broschure 			= 	$request->broschure->getClientOriginalName();
	    	if(!file_exists(public_path('/broschure/'))){
	    		mkdir(public_path('/broschure/'));
	    	}
	    	while(file_exists(public_path('/broschure/').$broschure)){
	    		$broschure = rand(1,100).$broschure;
	    	}
	        $request->broschure->move(public_path('/broschure/'), $broschure);
	        $course->broschure		=	$broschure;
    	}
        $course->updated_by 	=	\Auth::user()->id;
        if($course->save())
        {
        	$coursefee 			=	CourseFee::where('college_course_id', $course->id)->first();
        	if(empty($coursefee))
        	{
        		$coursefee 		=	new CourseFee();
        		$coursefee->college_course_id = $course->id;
        	}
        	$coursefee->fee_details	=	$request->fee_details;
        	$coursefee->link_more_details 	=	$request->link_more_details;
        	$coursefee->link_apply 	=	$request->link_apply;
        	$coursefee->status 	=	1;
        	$coursefee->updated_by	=	\Auth::user()->id;
        	$coursefee->save();

        	return redirect(route('admin.collages.courses',['id' => $course->college_id]))->with('success', 'Course added successfully');
        }else{
        	return redirect()->back()->with('error', 'Something went wrong');
        }
    }	

    public function delete($id)
    {
    	try{

    		if(\Auth::user()->role_id!=1)
	    	{
	    		$course 				=	CollageCourse::where('id', $id)->first();
	    		$collage 	=	Collage::where('id', $course->college_id)->where('user_id', \Auth::user()->id)->first();
	    		if(empty($collage))
	    		{
	    			return response('Unautherised.', 401);
	    		}
	    	}
            CollageCourse::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Course deleted successfully'); 
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Failed to delete the course'); 
        }
    }
}
