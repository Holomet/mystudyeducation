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
                            <h3 class="mb-0">Create Course Category</h3>
                        </div>
                    </div>
                </div>
                 <div class="card-body">
                    <form method="post" action="{{ route('admin.courses.categories.create') }}" autocomplete="off">
                        @csrf
                         <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('status')? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-status">{{ __('Status') }}</label>
                                <select name="status" id="input-status" class="form-control form-control-alternative{{ $errors->has('status') ? ' is-invalid' : '' }}" >
                                    <option>Select</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">{{ __('Create') }}</button>
                            <a href="{{ route('admin.courses.categories') }}" class="btn mt-4">Cancel</a>
                        </div>
                    </form>
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