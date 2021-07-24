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
                            <h3 class="mb-0">Change Logo</h3>
                        </div>
                    </div>
                </div>
                 <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="{{ route('admin.collages.updatelogo') }}" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('logo') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-logo">{{ __('Logo') }}</label>
                                <input type="file" name="logo" id="input-logo" class="form-control form-control-alternative{{ $errors->has('logo') ? ' is-invalid' : '' }}" placeholder="{{ __('Logo') }}" value="" required autofocus>

                                @if ($errors->has('logo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('logo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">{{ __('Update') }}</button>
                            <a href="{{ route('admin.collages.view',['id' => $id]) }}" class="btn mt-4">Cancel</a>
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