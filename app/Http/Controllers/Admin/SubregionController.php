<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateSubregionRequest;
use App\Http\Requests\UpdateSubregionRequest;
use App\Models\SubRegion;
use App\Models\Country;

class SubregionController extends Controller
{
    public function index()
    {
    	return view('admin.subregion.index');
    }

    public function paginate()
    {
    	$limit = (request('length') != '') ? request('length') : 10;
        $offset = (request('start') != '') ? request('start') : 0;

        $countries = SubRegion::with('country')->orderBy('id', 'asc');
        $result['count'] = $countries->count();
        $result['data']  = $countries->limit($limit)->offset($offset)->get();
        $data = ["iTotalDisplayRecords" => $result['count'], "iTotalRecords" => $limit, "TotalDisplayRecords" => $limit];
        $data['data'] = $result['data'];
        return response()->json($data);
    }

    public function add()
    {
    	$countries 			=	Country::where('status', 1)->pluck('name','id')->toArray();
    	return view('admin.subregion.add')->with(compact('countries'));
    }

    public function create(CreateSubregionRequest $request)
    {
    	$subregion 					=	new SubRegion();
    	$subregion->name 			=	$request->name;
    	$subregion->country_id 		=	$request->country_id;
    	$subregion->status 			=	$request->status;
    	if($subregion->save())
    	{
    		return redirect(route('admin.subregion.index'))->with('success', 'Subregion added successfully');
    	}else
    	{
    		return redirect()->back()->with('error', 'Something went wrong'); 
    	}
    }

    public function edit($id)
    {
    	$countries 			=	Country::where('status', 1)->pluck('name','id')->toArray();
    	$subregion 					=	SubRegion::where('id', $id)->first();
    	return view('admin.subregion.edit')->with(compact('countries','subregion'));
    }

    public function update(UpdateSubregionRequest $request)
    {
    	$subregion 					=	SubRegion::where('id', $request->id)->first();
    	$subregion->name 			=	$request->name;
    	$subregion->country_id 		=	$request->country_id;
    	$subregion->status 			=	$request->status;
    	if($subregion->save())
    	{
    		return redirect(route('admin.subregion.index'))->with('success', 'Subregion updated successfully');
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
