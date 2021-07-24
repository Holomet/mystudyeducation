<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Collage;
use App\Models\CollageGallery;
use App\Models\CollageGalleryImage;
use App\Http\Requests\UpdateGalleryRequest;
use App\Http\Requests\CreateGalleryRequest;
use App\Http\Requests\CreateGalleryImageRequest;

class CollageGalleryController extends Controller
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
    	return view('admin.collages.galleries.index')->with(compact('id'));
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
        
        $galleries = CollageGallery::where('college_id', $collage_id)->orderBy('id', 'asc');
        $result['count'] = $galleries->count();
        $result['data']  = $galleries->limit($limit)->offset($offset)->get();
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
    	return view('admin.collages.galleries.add')->with(compact('id'));
    }

    public function create(CreateGalleryRequest $request)
    {
    	if(\Auth::user()->role_id!=1)
    	{
    		$collage 	=	Collage::where('id', $request->collage_id)->where('user_id', \Auth::user()->id)->first();
    		if(empty($collage))
    		{
    			return response('Unautherised.', 401);
    		}
    	}
    	// print_r($request->all());exit;
    	$gallery 				=	new CollageGallery();
    	$gallery->college_id 	=	$request->collage_id;
    	$gallery->name 			=	$request->name;
    	$gallery->status 		=	$request->status;
    	$gallery->created_by 	=	\Auth::user()->id;
    	$gallery->updated_by 	=	\Auth::user()->id;
    	if($gallery->save())
    	{
    		return redirect(route('admin.collages.gallery',['id' => $gallery->college_id]))->with('success', 'Gallery created successfully');
    	}else{
    		return redirect()->back()->with('error', 'Something went wrong');
    	}
    }

    public function edit($id)
    {

    	$gallery 				=	CollageGallery::where('id', $id)->first();
    	if(\Auth::user()->role_id!=1)
    	{
    		$collage 	=	Collage::where('id', $gallery->college_id)->where('user_id', \Auth::user()->id)->first();
    		if(empty($collage))
    		{
    			return response('Unautherised.', 401);
    		}
    	}
    	return view('admin.collages.galleries.edit')->with(compact('gallery'));
    }

    public function update(UpdateGalleryRequest $request)
    {
		$gallery 				=	CollageGallery::where('id', $request->id)->first();
		if(\Auth::user()->role_id!=1)
    	{
    		$collage 	=	Collage::where('id', $gallery->college_id)->where('user_id', \Auth::user()->id)->first();
    		if(empty($collage))
    		{
    			return response('Unautherised.', 401);
    		}
    	}
    	$gallery->name 			=	$request->name;
    	$gallery->status 		=	$request->status;
    	$gallery->updated_by 	=	\Auth::user()->id;
    	if($gallery->save())
    	{
    		return redirect(route('admin.collages.gallery',['id' => $gallery->college_id]))->with('success', 'Gallery updated successfully');
    	}else{
    		return redirect()->back()->with('error', 'Something went wrong');
    	}
    }

    public function delete($id)
    {
    	try{
    		if(\Auth::user()->role_id!=1)
	    	{
	    		$gallery 				=	CollageGallery::where('id', $id)->first();
	    		$collage 	=	Collage::where('id', $gallery->college_id)->where('user_id', \Auth::user()->id)->first();
	    		if(empty($collage))
	    		{
	    			return response('Unautherised.', 401);
	    		}
	    	}

            CollageGallery::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Gallery deleted successfully'); 
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Failed to delete the gallery'); 
        }
    }

    public function view($id)
    {
    	$gallery 			=	CollageGallery::where('id', $id)->first();
    	if(\Auth::user()->role_id!=1)
    	{
    		$collage 	=	Collage::where('id', $gallery->college_id)->where('user_id', \Auth::user()->id)->first();
    		if(empty($collage))
    		{
    			return response('Unautherised.', 401);
    		}
    	}
    	$images 			=	CollageGalleryImage::where('college_gallery_id', $id)->get();
    	return view('admin.collages.galleries.view')->with(compact('gallery', 'images'));
    }

    public function addImage($id)
    {
    	$gallery 			=	CollageGallery::where('id', $id)->first();
    	if(\Auth::user()->role_id!=1)
    	{
    		$collage 	=	Collage::where('id', $gallery->college_id)->where('user_id', \Auth::user()->id)->first();
    		if(empty($collage))
    		{
    			return response('Unautherised.', 401);
    		}
    	}
    	return view('admin.collages.galleries.addimage')->with(compact('id'));
    }

    public function saveImage(CreateGalleryImageRequest $request)
    {
    	$gallery 			=	CollageGallery::where('id', $request->college_gallery_id)->first();
    	if(\Auth::user()->role_id!=1)
    	{
    		$collage 	=	Collage::where('id', $gallery->college_id)->where('user_id', \Auth::user()->id)->first();
    		if(empty($collage))
    		{
    			return response('Unautherised.', 401);
    		}
    	}
    	$logoname 				= 	$request->image->getClientOriginalName();
    	if(!file_exists(public_path('/gallery/'))){
    		mkdir(public_path('/gallery/'));
    	}
    	while(file_exists(public_path('/gallery/').$logoname)){
    		$logoname = rand(1,100).$logoname;
    	}
        $request->image->move(public_path('/gallery/'), $logoname);
        $image 				=	new CollageGalleryImage();
        $image->college_gallery_id =	$request->college_gallery_id;
        $image->name 			=	$logoname;
        $image->status 			=	1;
        $image->created_by 		=	\Auth::user()->id;
        $image->updated_by 		=	\Auth::user()->id;
        if($image->save())
        {
    		return redirect(route('admin.collages.gallery.view',['id' => $image->college_gallery_id]))->with('success', 'Gallery created successfully');
    	}else{
    		return redirect()->back()->with('error', 'Something went wrong');
    	}
    }

    public function deleteImage($id)
    {
    	try{
    		if(\Auth::user()->role_id!=1)
	    	{
	    		$image 				=	CollageGalleryImage::where('id', $id)->first();
	    		$gallery 	=	CollageGallery::where('id', $image->college_gallery_id)->first();
	    		$collage 	=	Collage::where('id', $gallery->college_id)->where('user_id', \Auth::user()->id)->first();
	    		if(empty($collage))
	    		{
	    			return response('Unautherised.', 401);
	    		}
	    	}
            CollageGalleryImage::where('id', $id)->delete();
            return redirect()->back()->with('success', 'Gallery image deleted successfully'); 
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Failed to delete the gallery image'); 
        }	
    }
}
