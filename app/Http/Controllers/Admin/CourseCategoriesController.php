<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCourseCategoryRequest;
use App\Http\Requests\UpdateCourseCategoryRequest;
use App\Models\CourseCategory;
use Illuminate\Http\Request;

class CourseCategoriesController extends Controller
{
    public function index()
    {
    	return view('admin.coursecategories.index');
    }

    public function paginate()
    {
    	$limit = (request('length') != '') ? request('length') : 10;
        $offset = (request('start') != '') ? request('start') : 0;
        
        $plans = CourseCategory::orderBy('id', 'asc');
        $result['count'] = $plans->count();
        $result['data']  = $plans->limit($limit)->offset($offset)->get();
        $data = ["iTotalDisplayRecords" => $result['count'], "iTotalRecords" => $limit, "TotalDisplayRecords" => $limit];
        $data['data'] = $result['data'];
        return response()->json($data);
    }

    public function add()
    {
    	return view('admin.coursecategories.add');
    }

    public function create(AddCourseCategoryRequest $request)
    {
    	$coursecategory 						=	new CourseCategory();
    	$coursecategory->name 					=	$request->name;
    	$coursecategory->status 				=	$request->status;
    	if($coursecategory->save())
    	{
			return redirect(route('admin.courses.categories'))->with('success', 'Course category created successfully'); 
    	}else{
    		return redirect()->back()->with('error', 'Failed to save category'); 
    	}
    }

    public function view($id)
    {
    	$coursecategory 				=	CourseCategory::where('id', $id)->first();
    	return view('admin.coursecategories.view')->with(compact('coursecategory'));
    }

    public function edit($id)
    {
    	$coursecategory 				=	CourseCategory::where('id', $id)->first();
    	return view('admin.coursecategories.edit')->with(compact('coursecategory'));
    }

    public function update(UpdateCourseCategoryRequest $request)
    {
    	$coursecategory 						=	CourseCategory::where('id', $request->id)->first();
    	$coursecategory->name 					=	$request->name;
    	$coursecategory->status 				=	$request->status;
    	if($coursecategory->save())
    	{
			return redirect(route('admin.courses.categories'))->with('success', 'Course category updated successfully'); 
    	}else{
    		return redirect()->back()->with('error', 'Failed to update category details'); 
    	}
    }

   	public function delete($id)
   	{
   		try{
            CourseCategory::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Course category deleted successfully'); 
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Failed to delete the course category'); 
        }
   	}

}
