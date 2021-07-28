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
                            <h3 class="mb-0">View Zone</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('admin.expo.zones') }}"  class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
                 <div class="card-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{ $zone->name }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>{{ $zone->status==1?"Active":"Inactive" }}</td>
                            </tr>
                            <tr>
                                <th>Sub Regions</th>
                                <td>
                                    @foreach($zonestates as $id => $state)
                                    <p>{{ $subregions[$state] }}</p>
                                    @endforeach
                                </td>
                            </tr>
                        </tbody>
                    </table>
                   
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