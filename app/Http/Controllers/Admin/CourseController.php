<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseCategory;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Requests\CourseAddRequest;
use App\Http\Requests\CourseEditRequest;

class CourseController extends Controller
{
    public function index()
    {
    	return view('admin.courses.index');
    }

    public function paginate()
    {
    	$limit = (request('length') != '') ? request('length') : 10;
        $offset = (request('start') != '') ? request('start') : 0;
        
        $plans = Course::with('category')->orderBy('id', 'asc');
        $result['count'] = $plans->count();
        $result['data']  = $plans->limit($limit)->offset($offset)->get();
        $data = ["iTotalDisplayRecords" => $result['count'], "iTotalRecords" => $limit, "TotalDisplayRecords" => $limit];
        $data['data'] = $result['data'];
        return response()->json($data);
    }

    public function add()
    {
    	$categories 			=	CourseCategory::pluck('name', 'id')->toArray();
    	return view('admin.courses.add')->with(compact('categories'));
    }

    public function create(CourseAddRequest $request)
    {
    	$course 					=	new Course();
    	$course->name 				=	$request->name;
    	$course->course_category_id	=	$request->course_category_id;
    	$course->status 			=	$request->status;
    	if($course->save())
    	{
			return redirect(route('admin.courses'))->with('success', 'Course created successfully'); 
    	}else{
    		return redirect()->back()->with('error', 'Failed to save course'); 
    	}
    }

    public function view($id)
    {
    	$course 				=	Course::with('category')->where('id', $id)->first();
    	return view('admin.courses.view')->with(compact('course'));
    }


    public function edit($id)
    {
    	$categories 			=	CourseCategory::pluck('name', 'id')->toArray();
    	$course 				=	Course::with('category')->where('id', $id)->first();
    	return view('admin.courses.edit')->with(compact('course', 'categories'));
    }

    public function update(CourseEditRequest $request)
    {
    	$course 					=	Course::where('id', $request->id)->first();
    	$course->name 				=	$request->name;
    	$course->course_category_id	=	$request->course_category_id;
    	$course->status 			=	$request->status;
    	if($course->save())
    	{
			return redirect(route('admin.courses'))->with('success', 'Course updated successfully'); 
    	}else{
    		return redirect()->back()->with('error', 'Failed to update the course'); 
    	}
    }

    public function delete($id)
    {
    	try{
            Course::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Course deleted successfully'); 
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Failed to delete the course'); 
        }
    }

    public function courseList($id)
    {
        $courses    =   Course::where('course_category_id', $id)->pluck('name','id')->toArray();
        return $courses;
    }
}
