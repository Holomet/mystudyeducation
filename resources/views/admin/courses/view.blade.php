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
                            <h3 class="mb-0">Course Category Details</h3>
                        </div>
                    </div>
                </div>
                 <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Name</th>
                            <td>{{ $course->name }}</td>
                        </tr>
                        <tr>
                            <th>Course Level</th>
                            <td>{{ $course->category->name }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $course->status==1?"Active":"Inactive" }}</td>
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