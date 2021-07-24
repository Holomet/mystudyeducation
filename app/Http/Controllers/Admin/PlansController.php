<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;

class PlansController extends Controller
{
    public function index()
    {
    	return view('admin.plans.index');
    }

    public function paginate(){
    	$limit = (request('length') != '') ? request('length') : 10;
        $offset = (request('start') != '') ? request('start') : 0;
        
        $plans = Plan::orderBy('id', 'asc');
        $result['count'] = $plans->count();
        $result['data']  = $plans->limit($limit)->offset($offset)->get();
        $data = ["iTotalDisplayRecords" => $result['count'], "iTotalRecords" => $limit, "TotalDisplayRecords" => $limit];
        $data['data'] = $result['data'];
        return response()->json($data);
    }

    public function add(){
    	return view('admin.plans.add');
    }

    public function create(CreatePlanRequest $request)
    {
    	$plan 								=	new Plan();
    	$plan->name 						=	$request->name;
    	$plan->amount 						=	$request->amount;
    	$plan->commission 					=	$request->commission;
    	$plan->tax							=	$request->tax;
    	$plan->total 						=	$request->total;
    	$plan->status 						=	$request->status;
    	$plan->created_by 					=	Auth::user()->id;
    	$plan->updated_by 					=	Auth::user()->id;
    	if($plan->save()){
    		$plandetail						=	new PlanDetail();
    		$plandetail->plan_detail_id		=	$plan->id;
    		$plandetail->item_count 		=	$request->item_count;
    		$plandetail->payout_amount 		=	$request->payout_amount;
    		$plandetail->maximum_visits 	=	$request->maximum_visits;
    		$plandetail->product_images		=	$request->product_images;
    		$plandetail->storage			=	$request->storage;
    		$plandetail->count_product_categories =	$request->count_product_categories;
    		$plandetail->created_by 		=	Auth::user()->id;
    		$plandetail->updated_by 		=	Auth::user()->id;
    		if($plandetail->save())
    		{
    			return redirect(route('admin.plans'))->with('success', 'Plan created successfully'); 
    		}else{
    			return redirect()->back()->with('error', 'Failed to save plan details'); 
    		}
    	}else{
    		return redirect()->back()->with('error', 'Failed to create the plan'); 
    	}
    }
}
