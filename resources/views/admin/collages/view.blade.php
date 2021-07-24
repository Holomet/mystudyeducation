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
                            <h3 class="mb-0">Collage Details</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('admin.collages.courses',['id' => $collage->id]) }}" class="btn btn-sm btn-primary">Courses</a>

                            <a href="{{ route('admin.collages.gallery', ['id' => $collage->id]) }}" class="btn btn-sm btn-primary">Gallery</a>

                            <a href="{{ route('admin.collages.seminars', ['id' => $collage->id]) }}" class="btn btn-sm btn-primary">Seminarts</a>
                        </div>
                    </div>
                </div>
                 <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Name</th>
                            <td>{{ $collage->name }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{!! nl2br($collage->address) !!}</td>
                        </tr>
                        <tr>
                            <th>About</th>
                            <td>{!! nl2br($collage->about) !!}</td>
                        </tr>
                        <tr>
                            <th>Logo</th>
                            <td>
                                <img src="{{ asset('logo/'.$collage->logo) }}"  width="75px" />
                                <br/>
                                <a href="{{ route('admin.collages.changelogo',['id' => $collage->id]) }}" class="btn btn-primary">Change Logo</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Rollup Banner</th>
                            <td>    
                                <img src="{{ asset('rollup_banner/'.$collage->rollup_banner) }}"  width="100px" />
                                <br/>
                                <a href="{{ route('admin.collages.changerollupbanner',['id' => $collage->id]) }}" class="btn btn-primary">Change Rollup Banner</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Stall Video</th>
                            <td>
                                <video src="{{ asset('stall_video/'.$collage->stall_video) }}"  width="150px" controls></video>
                                <br/>
                                <a href="{{ route('admin.collages.changestallvideo',['id' => $collage->id]) }}" class="btn btn-primary">Change Stall Video</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Prospectus</th>
                            <td>
                                <a href="{{asset('prospectus/'.$collage->prospectus) }}" target="_blank">Download</a>
                                <br/>
                                <a href="{{ route('admin.collages.changeprospectus',['id' => $collage->id]) }}" class="btn btn-primary">Change Prospectus</a>
                            </td>
                        </tr>
                        <tr>
                            <th>Zones</th>
                            <td>
                                @foreach($collagezones as $zone)
                                <p>{{ $zone->expozone->name }}</p>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $collage->status==1?"Active":"Inactive" }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script type="text/javascript" src="{{ asset('admin/argon/js/bootstrap-datepicker.min.js') }}"></script>
<script type="text/javascript">
    $.fn.datepicker.defaults.format = "yyyy-mm-dd";
    $(document).ready(function(){
        $('.datepicker').datepicker();
    })
</script>
@endpush