<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collage;
use App\User;
use App\Models\ExpoZone;
use App\Models\CollageZone;
use App\Http\Requests\AddCollageRequest;
use App\Http\Requests\UpdateCollageRequest;
use App\Http\Requests\UpdateCollageLogoRequest;
use App\Http\Requests\UpdateRollupBannerRequest;
use App\Http\Requests\UpdateStallVideoRequest;
use App\Http\Requests\UpdateProspectusRequest;

class CollageController extends Controller
{
    public function index()
    {
    	return view('admin.collages.index');
    }

    public function paginate()
    {
    	$limit = (request('length') != '') ? request('length') : 10;
        $offset = (request('start') != '') ? request('start') : 0;
        
        $plans = Collage::orderBy('id', 'asc');
        $result['count'] = $plans->count();
        $result['data']  = $plans->limit($limit)->offset($offset)->get();
        $data = ["iTotalDisplayRecords" => $result['count'], "iTotalRecords" => $limit, "TotalDisplayRecords" => $limit];
        $data['data'] = $result['data'];
        return response()->json($data);
    }

    public function add()
    {
        if(\Auth::user()->role_id!=1)
        {
            return response('Unautherised.', 401);
        }
    	$zones 		=	ExpoZone::pluck('name', 'id')->toArray();
    	$users 		=	User::where('role_id', 2)->get();
    	return view('admin.collages.add')->with(compact('zones','users'));
    }

    public function create(AddCollageRequest $request){
    	$collage 				=	new Collage();

    	$logoname 				= 	$request->logo->getClientOriginalName();
    	if(!file_exists(public_path('/logo/'))){
    		mkdir(public_path('/logo/'));
    	}
    	while(file_exists(public_path('/logo/').$logoname)){
    		$logoname = rand(1,100).$logoname;
    	}
        $request->logo->move(public_path('/logo/'), $logoname);

        $rollup_banner 				= 	$request->rollup_banner->getClientOriginalName();
    	if(!file_exists(public_path('/rollup_banner/'))){
    		mkdir(public_path('/rollup_banner/'));
    	}
    	while(file_exists(public_path('/rollup_banner/').$rollup_banner)){
    		$rollup_banner = rand(1,100).$rollup_banner;
    	}
        $request->rollup_banner->move(public_path('/rollup_banner/'), $rollup_banner);

        $stall_video 				= 	$request->stall_video->getClientOriginalName();
    	if(!file_exists(public_path('/stall_video/'))){
    		mkdir(public_path('/stall_video/'));
    	}
    	while(file_exists(public_path('/stall_video/').$stall_video)){
    		$stall_video = rand(1,100).$stall_video;
    	}
        $request->stall_video->move(public_path('/stall_video/'), $stall_video);

        $prospectus 				= 	$request->prospectus->getClientOriginalName();
    	if(!file_exists(public_path('/prospectus/'))){
    		mkdir(public_path('/prospectus/'));
    	}
    	while(file_exists(public_path('/prospectus/').$prospectus)){
    		$prospectus = rand(1,100).$prospectus;
    	}
        $request->prospectus->move(public_path('/prospectus/'), $prospectus);

        $collage->name 						=	$request->name;
        $collage->stall_id                  =   $request->stall_id;
        $collage->address 					=	$request->address;
        $collage->logo 						=	$logoname;
        $collage->rollup_banner 			=	$rollup_banner;
        $collage->stall_video 				=	$stall_video;
        $collage->about 					=	$request->about;
        $collage->prospectus 				=	$prospectus;
        $collage->status 					=	$request->status;
        $collage->user_id 					=	$request->user_id;
        $collage->created_by				=	\Auth::user()->id;
        $collage->updated_by				=	\Auth::user()->id;
        if($collage->save())
        {
        	foreach ($request->zones as $id => $zone) {
        		$collagezone 				=	new CollageZone();
        		$collagezone->college_id 	=	$collage->id;
        		$collagezone->expo_zone_id	=	$zone;
        		$collagezone->status 		=	1;
        		$collagezone->created_by 	=	\Auth::user()->id;
				$collagezone->updated_by 	=	\Auth::user()->id;
				$collagezone->save();
        	}
        	return redirect(route('admin.collages'))->with('success', 'Collage added successfully');
        }else{
        	return redirect()->back()->with('error', 'Failed to add the collage'); 
        }
    }	

    public function view($id)
    {
    	$collage 			=	Collage::where('id', $id)->first();
    	$collagezones 		=	CollageZone::where('status', 1)->with('expozone')->where('college_id', $id)->get();
    	return view('admin.collages.view')->with(compact('collage','collagezones'));
    }

    public function edit($id)
    {
    	$collage 			=	Collage::where('id', $id)->first();
    	$collagezones 		=	CollageZone::where('college_id', $id)->where('status', 1)->pluck('expo_zone_id', 'id')->toArray();


    	$users 		=	User::where('role_id', 2)->get();
        if(\Auth::user()->role_id==1)
        {
    	   $zones 		=	ExpoZone::pluck('name', 'id')->toArray();
        }else{
            $incollagezones       =   CollageZone::where('college_id', $id)->pluck('expo_zone_id', 'id')->toArray();            
            $zones      =   ExpoZone::whereIn('id', $incollagezones)->pluck('name', 'id')->toArray();
        }
    	return view('admin.collages.edit')->with(compact('collage', 'collagezones','zones', 'users'));
    }

    public function update(UpdateCollageRequest $request)
    {
    	$collage 			=	Collage::where('id', $request->id)->first();
    	$collage->name 		=	$request->name;
        $collage->stall_id  =   $request->stall_id;
    	$collage->about 	=	$request->about;
    	$collage->address 	=	$request->address;
    	$collage->status 	=	$request->status;
    	
    	if($collage->save())
    	{
            if(\Auth::user()->role_id==1)
            {
        		CollageZone::where('college_id', $request->id)->delete();
        		foreach ($request->zones as $id => $zone) {
            		$collagezone 				=	new CollageZone();
            		$collagezone->college_id 	=	$collage->id;
            		$collagezone->expo_zone_id	=	$zone;
            		$collagezone->status 		=	1;
            		$collagezone->created_by 	=	\Auth::user()->id;
    				$collagezone->updated_by 	=	\Auth::user()->id;
    				$collagezone->save();
            	}
            }else{
                $collagezones       =   CollageZone::where('college_id', $request->id)->pluck('expo_zone_id', 'id')->toArray(); 
                CollageZone::where('college_id', $request->id)->delete();
                foreach ($request->zones as $id => $zone) {
                    $collagezone                =   new CollageZone();
                    $collagezone->college_id    =   $collage->id;
                    $collagezone->expo_zone_id  =   $zone;
                    $collagezone->status        =   1;
                    $collagezone->created_by    =   \Auth::user()->id;
                    $collagezone->updated_by    =   \Auth::user()->id;
                    $collagezone->save();
                    if(in_array($zone, $collagezones)){
                        $collagezones = array_filter($collagezones, function($e) use ($zone){
                            return ($e !== $zone);
                        });
                    }
                }
                foreach ($collagezones as $key => $zone) {
                    $collagezone                =   new CollageZone();
                    $collagezone->college_id    =   $collage->id;
                    $collagezone->expo_zone_id  =   $zone;
                    $collagezone->status        =   0;
                    $collagezone->created_by    =   \Auth::user()->id;
                    $collagezone->updated_by    =   \Auth::user()->id;
                    $collagezone->save();
                }
            }
        	return redirect(route('admin.collages'))->with('success', 'Collage updated successfully');
    	}else{
    		return redirect()->back()->with('error', 'Failed to update the collage details'); 
    	}
    }

    public function delete($id)
    {
    	try{
            Collage::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Collage deleted successfully'); 
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Failed to delete the collage'); 
        }
    }

    public function changeLogo($id)
    {
    	return view('admin.collages.changelogo')->with(compact('id'));
    }

    public function updateLogo(UpdateCollageLogoRequest $request)
    {
		$logoname 				= 	$request->logo->getClientOriginalName();
    	if(!file_exists(public_path('/logo/'))){
    		mkdir(public_path('/logo/'));
    	}
    	while(file_exists(public_path('/logo/').$logoname)){
    		$logoname = rand(1,100).$logoname;
    	}
        $request->logo->move(public_path('/logo/'), $logoname);

        $collage 		=	Collage::where('id', $request->id)->first();
        $collage->logo 	=	$logoname;
        if($collage->save())
        {
        	return redirect(route('admin.collages.view',['id' => $request->id]))->with('success', 'Logo updated successfully');
        }else{
        	return redirect()->back()->with('error', 'Failed to update the logo');	
        } 	
    }

    public function changerollupbanner($id)
    {
    	return view('admin.collages.changerollupbanner')->with(compact('id'));
    }

    public function updaterollupbanner(UpdateRollupBannerRequest $request)
    {
    	$rollup_banner 				= 	$request->rollup_banner->getClientOriginalName();
    	if(!file_exists(public_path('/rollup_banner/'))){
    		mkdir(public_path('/rollup_banner/'));
    	}
    	while(file_exists(public_path('/rollup_banner/').$rollup_banner)){
    		$rollup_banner = rand(1,100).$rollup_banner;
    	}
        $request->rollup_banner->move(public_path('/rollup_banner/'), $rollup_banner);
        $collage 		=	Collage::where('id', $request->id)->first();
        $collage->rollup_banner 	=	$rollup_banner;
        if($collage->save())
        {
        	return redirect(route('admin.collages.view',['id' => $request->id]))->with('success', 'Rollup banner updated successfully');
        }else{
        	return redirect()->back()->with('error', 'Failed to update the rollup banner');	
        } 	
    }

    public function changestallvideo($id)
    {
    	return view('admin.collages.changestallvideo')->with(compact('id'));
    }

    public function updatestallvideo(UpdateStallVideoRequest $request)
    {
    	$stall_video 				= 	$request->stall_video->getClientOriginalName();
    	if(!file_exists(public_path('/stall_video/'))){
    		mkdir(public_path('/stall_video/'));
    	}
    	while(file_exists(public_path('/stall_video/').$stall_video)){
    		$stall_video = rand(1,100).$stall_video;
    	}
        $request->stall_video->move(public_path('/stall_video/'), $stall_video);
        $collage 		=	Collage::where('id', $request->id)->first();
        $collage->stall_video 	=	$stall_video;
        if($collage->save())
        {
        	return redirect(route('admin.collages.view',['id' => $request->id]))->with('success', 'Stall video updated successfully');
        }else{
        	return redirect()->back()->with('error', 'Failed to update the stall video');	
        } 	
    }

    public function changeprospectus($id)
    {
    	return view('admin.collages.updateprospectus')->with(compact('id'));
    }

    public function updateprospectus(UpdateProspectusRequest $request)
    {
    	$prospectus 				= 	$request->prospectus->getClientOriginalName();
    	if(!file_exists(public_path('/prospectus/'))){
    		mkdir(public_path('/prospectus/'));
    	}
    	while(file_exists(public_path('/prospectus/').$prospectus)){
    		$prospectus = rand(1,100).$prospectus;
    	}
        $request->prospectus->move(public_path('/prospectus/'), $prospectus);
        $collage 		=	Collage::where('id', $request->id)->first();
        $collage->prospectus 	=	$prospectus;
        if($collage->save())
        {
        	return redirect(route('admin.collages.view',['id' => $request->id]))->with('success', 'Prospectus updated successfully');
        }else{
        	return redirect()->back()->with('error', 'Failed to update the prospectus');	
        } 	
    }

}
