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
                            <h3 class="mb-0">Collages</h3>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                                        
                 <div class="table-responsive">
                    <table id="datatable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($collages as $key => $collage)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $collage->name }}</td>
                                <td>{{ $collage->status ==1 ? "Active":"Inactive" }}</td>
                                <td>
                                    <a class="btn btn-primary" href="{{ route('admin.collages.view',['id' => $collage->id]) }}"><i class='fa fa-eye'></i></a>
                                    <a class="btn btn-info" href="{{ route('admin.collages.edit',['id' => $collage->id]) }}"><i class='fa fa-edit'></i></a>
                                    <a class="btn btn-info" onclick="return confirm('Are you sure to delete this collage?')" href="{{ route('admin.collages.delete',['id' => $collage->id]) }}"><i class='fa fa-trash'></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
