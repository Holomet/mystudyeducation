<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expo;
use App\Models\State;
use App\Models\ExpoZone;
use App\Models\SubRegion;
use App\Models\ZoneState;
use App\Http\Requests\CreateExpoRequest;
use App\Http\Requests\UpdateExpoRequest;
use App\Http\Requests\CreateZoneRequest;
use App\Http\Requests\UpdateZoneRequest;

class ExpoController extends Controller
{
    public function index()
    {
        return redirect(route('admin.expo.zones'));
    	return view('admin.expo.index');
    }

    public function paginate()
    {
    	$limit = (request('length') != '') ? request('length') : 10;
        $offset = (request('start') != '') ? request('start') : 0;

        $expo = Expo::orderBy('id', 'asc');
        $result['count'] = $expo->count();
        $result['data']  = $expo->limit($limit)->offset($offset)->get();
        $data = ["iTotalDisplayRecords" => $result['count'], "iTotalRecords" => $limit, "TotalDisplayRecords" => $limit];
        $data['data'] = $result['data'];
        return response()->json($data);
    }

    public function add()
    {
    	return view('admin.expo.add');
    }

    public function view($id)
    {
    	$expo 			=	Expo::where('id', $id)->first();
        $zones          =   ExpoZone::with('country')->where('expo_id', $id)->get();
    	return view('admin.expo.view')->with(compact('expo', 'zones'));
    }

    public function edit($id)
    {
    	$expo 			=	Expo::where('id', $id)->first();
    	return view('admin.expo.edit')->with(compact('expo'));
    }

    public function create(CreateExpoRequest $request)
    {
    	$expo 							=	new Expo();
    	$expo->name 					=	$request->name;
    	$expo->start_date 				=	$request->start_date;
    	$expo->end_date 				=	$request->end_date;
    	$expo->status 					=	$request->status;
    	if($expo->save()){
    		return redirect(route('admin.expo'))->with('success', 'Expo created successfully'); 
    	}else{
    		return redirect()->back()->with('error', 'Something went wrong'); 
    	}
            
    }

    public function update(UpdateExpoRequest $request)
    {
    	$expo 							=	Expo::where('id', $request->id)->first();
    	$expo->name 					=	$request->name;
    	$expo->start_date 				=	$request->start_date;
    	$expo->end_date 				=	$request->end_date;
    	$expo->status 					=	$request->status;
    	if($expo->save()){
    		return redirect(route('admin.expo'))->with('success', 'Expo updated successfully'); 
    	}else{
    		return redirect()->back()->with('error', 'Something went wrong'); 
    	}
    }


    public function delete($id)
    {
    	try{
            Expo::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Expo deleted successfully'); 
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Failed to delete the expo'); 
        }
    }

    public function zones()
    {
        return view('admin.expo.zones');
    }

    public function paginteZones()
    {
        $limit = (request('length') != '') ? request('length') : 10;
        $offset = (request('start') != '') ? request('start') : 0;

        $countries = ExpoZone::orderBy('id', 'asc');
        $result['count'] = $countries->count();
        $result['data']  = $countries->limit($limit)->offset($offset)->get();
        $data = ["iTotalDisplayRecords" => $result['count'], "iTotalRecords" => $limit, "TotalDisplayRecords" => $limit];
        $data['data'] = $result['data'];
        return response()->json($data);
    }

    public function addZone()
    {
        $id = 1;
        $subregions         =   SubRegion::where('status',1)->pluck('name','id')->toArray();
        return view('admin.expo.addzone')->with(compact('id', 'subregions'));
    }

    public function expoStates($id)
    {
        $states             =   State::where('country_id', $id)->pluck('state_name', 'id')->toArray();
        return $states;
    }

    public function createZone(CreateZoneRequest $request)
    {
        $zone               =   new ExpoZone();
        $zone->expo_id      =   $request->expo_id;
        $zone->name         =   $request->name;
        $zone->status       =   $request->status;
        if($zone->save()){
            foreach ($request->state_id as $key => $state_id) {
                $zonestate                  =   new ZoneState();
                $zonestate->expo_zone_id    =   $zone->id;
                $zonestate->state_id        =   $state_id;
                $zonestate->status          =   1;
                $zonestate->save();
            }
            return redirect(route('admin.expo.zones'))->with('success', 'Zone created successfully'); 
        }else{
            return redirect()->back()->with('error', 'Something went wrong');    
        }
    }

    public function editZone($id)
    {
        $zone               =   ExpoZone::where('id', $id)->first();
        $zonestates         =   ZoneState::where('expo_zone_id', $id)->pluck('state_id','id')->toArray();
        $subregions         =   SubRegion::where('status',1)->pluck('name','id')->toArray();   
        return view('admin.expo.editzone')->with(compact('zone', 'subregions', 'zonestates'));
    }

    public function viewZone($id)
    {
        $zone               =   ExpoZone::where('id', $id)->first();
        $zonestates         =   ZoneState::where('expo_zone_id', $id)->pluck('state_id','id')->toArray();
        $subregions         =   SubRegion::where('status',1)->pluck('name','id')->toArray();   
        return view('admin.expo.viewzone')->with(compact('zone', 'subregions', 'zonestates'));   
    }

    public function updateZone(UpdateZoneRequest $request){
        $zone               =   ExpoZone::where('id', $request->id)->first();
        $zone->name         =   $request->name;
        $zone->status       =   $request->status;
        if($zone->save()){
            ZoneState::where('expo_zone_id', $zone->id)->delete();
            foreach ($request->state_id as $key => $state_id) {
                $zonestate                  =   new ZoneState();
                $zonestate->expo_zone_id    =   $zone->id;
                $zonestate->state_id        =   $state_id;
                $zonestate->status          =   1;
                $zonestate->save();
            }
            return redirect(route('admin.expo.zones'))->with('success', 'Zone updated successfully'); 
        }else{
            return redirect()->back()->with('error', 'Something went wrong');    
        }
    }

    public function deleteZone($id)
    {
        try{
            ExpoZone::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Zone deleted successfully'); 
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Failed to delete the zone'); 
        }
    }
}