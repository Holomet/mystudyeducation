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
                            <h3 class="mb-0">Expo</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('admin.expo') }}"  class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
                 <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{ $expo->name }}</td>
                            </tr>
                            <tr>
                                <th>Start Date</th>
                                <td>{{ $expo->start_date }}</td>
                            </tr>
                            <tr>
                                <th>End Date</th>
                                <td>{{ $expo->end_date }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $expo->status==1?"Active":"Inactive" }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Zones</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('admin.expo.addzone',['id' => $expo->id]) }}"  class="btn btn-sm btn-primary">{{ __('Add Zone') }}</a>
                        </div>
                    </div>
                    @if(count($zones) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Country</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($zones as $key => $zone)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $zone->name }}</td>
                                <td>{{ $zone->country->country_nicename }}</td>
                                <td>{{ $zone->status==1?"Active":"Inactive" }}</td>
                                <td>
                                    <!-- <a class='edit btn btn-info' href="{{ route('admin.expo.viewzone',['id' => $zone->id]) }}"><i class='fa fa-eye'></i></a> -->
                                    <a class='edit btn btn-info' href="{{ route('admin.expo.editzone',['id' => $zone->id]) }}"><i class='fa fa-edit'></i></a>
                                    <a class='edit btn btn-danger' href="{{ route('admin.expo.deletezone',['id' => $zone->id]) }}"><i class='fa fa-trash'></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p>No zones added yet</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript">
</script>
@endpush