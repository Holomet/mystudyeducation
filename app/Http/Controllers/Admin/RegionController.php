<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Http\Requests\CreateRegionRequest;
use App\Http\Requests\UpdateRegionRequest;

class RegionController extends Controller
{
    public function index()
    {
    	return view('admin.region.index');
    }

    public function paginate()
    {
    	$limit = (request('length') != '') ? request('length') : 10;
        $offset = (request('start') != '') ? request('start') : 0;

        $countries = Country::orderBy('id', 'asc');
        $result['count'] = $countries->count();
        $result['data']  = $countries->limit($limit)->offset($offset)->get();
        $data = ["iTotalDisplayRecords" => $result['count'], "iTotalRecords" => $limit, "TotalDisplayRecords" => $limit];
        $data['data'] = $result['data'];
        return response()->json($data);
    }

    public function add()
    {
    	return view('admin.region.add');
    }

    public function create(CreateRegionRequest $request)
    {
    	$country 					=	new Country();
    	$country->name 				=	$request->name;
    	$country->status 			=	$request->status;
    	if($country->save())
    	{
    		return redirect(route('admin.region'))->with('success', 'Region added successfully');
    	}else
    	{
    		return redirect()->back()->with('error', 'Something went wrong'); 
    	}
    }

    public function edit($id)
    {
    	$country 					=	Country::where('id', $id)->first();
    	return view('admin.region.edit')->with(compact('country'));
    }

    public function update(UpdateRegionRequest $request)
    {
    	$country 					=	Country::where('id', $request->id)->first();
    	$country->name 				=	$request->name;
    	$country->status 			=	$request->status;
    	if($country->save())
    	{
    		return redirect(route('admin.region'))->with('success', 'Region updated successfully');
    	}else
    	{
    		return redirect()->back()->with('error', 'Something went wrong'); 
    	}
    }

    public function delete($id)
    {
    	try{
            Country::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Rrgion deleted successfully'); 
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Failed to delete the region'); 
        }
    }

    public function view($id)
    {
    	$country 					=	Country::where('id', $id)->first();
    	return view('admin.region.view')->with(compact('country'));
    }
}
