@extends('layouts.admin')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
    <div class="container-fluid">
        <div class="header-body">
        </div>
    </div>
</div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col pt-md-12">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">View Gallery - {{ $gallery->name }}</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('admin.collages.gallery.addimage',['id' => $gallery->id]) }}" class="btn btn-sm btn-primary">Add Image</a>
                        </div>
                    </div>
                </div>
                 <div class="card-body">
                    <div class="row">
                        @foreach($images as $image)
                        <div class="col-md-3">
                            <img src="{{ asset('gallery/'.$image->name) }}"  width="100%" />
                            <div style="text-align: center;padding: 10px">
                            <a href="{{ route('admin.collages.gallery.image.delete', ['id' => $image->id]) }}" class="btn btn-danger" onclick="return confirm('Are you sure to delete this image')" >Delete</a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection