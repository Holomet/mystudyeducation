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
                            <h3 class="mb-0">Edit College Details</h3>
                        </div>
                    </div>
                </div>
                 <div class="card-body">
                    <form method="post" action="{{ route('admin.collages.update') }}" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id" value="{{ $collage->id }}" />
                         <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ $collage->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('stall_id') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-stall_id">{{ __('Stall Layout') }}</label>

                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="radio" name="stall_id" value="1" {{ $collage->stall_id==1?"checked":"" }} /><label> &nbsp;&nbsp;Stall 1</label>
                                        <img src="{{ asset('stalls/DJ-AM-038-IM-2001-R1-Stall 1.png') }}" style="width: 100%" />
                                    </div>
                                    <div class="col-md-6">
                                        <input type="radio" name="stall_id" value="2" {{ $collage->stall_id==2?"checked":"" }} /><label> &nbsp;&nbsp;Stall 2</label>
                                        <img src="{{ asset('stalls/DJ-AM-038-IM-2003-R1-Stall 2.png') }}" style="width: 100%" />
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="radio" name="stall_id" value="3" {{ $collage->stall_id==3?"checked":"" }} /><label> &nbsp;&nbsp;Stall 3</label>
                                        <img src="{{ asset('stalls/DJ-AM-038-IM-2005-R1-Stall 3.png') }}" style="width: 100%" />
                                    </div>
                                    <div class="col-md-6">
                                        <input type="radio" name="stall_id" value="4" {{ $collage->stall_id==4?"checked":"" }} /><label> &nbsp;&nbsp;Stall 4</label>
                                        <img src="{{ asset('stalls/DJ-AM-038-IM-2007-R1-Stall 4.png') }}" style="width: 100%" />
                                    </div>
                                </div> 

                                @if ($errors->has('stall_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('stall_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('address')? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-address">{{ __('Address') }}</label>
                                <textarea name="address" id="input-address" class="form-control form-control-alternative{{ $errors->has('address') ? ' is-invalid' : '' }}" placeholder="{{ __('Address') }}" required autofocus>{{ $collage->address }}</textarea>
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('about') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-about">{{ __('About Info') }}</label>
                                <textarea name="about" id="input-about" class="form-control form-control-alternative{{ $errors->has('about') ? ' is-invalid' : '' }}" placeholder="{{ __('About Info') }}" required autofocus>{{ $collage->about }}</textarea>

                                @if ($errors->has('about'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('about') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('user_id')? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-user_id">{{ __('User') }}</label>
                                <select name="user_id" id="input-user_id" class="form-control form-control-alternative{{ $errors->has('user_id') ? ' is-invalid' : '' }}" >
                                    <option value="">Select</option> 
                                    @foreach($users as $id => $user)
                                    <option value="{{ $user->id }}" {{ $collage->user_id==$user->id?"selected":"" }}>{{ $user->first_name." ".$user->last_name }}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('zones')? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-zones">{{ __('Zones') }}</label>
                                <select name="zones[]" id="input-zones" class="form-control form-control-alternative{{ $errors->has('zones') ? ' is-invalid' : '' }}" multiple >
                                    @foreach($zones as $id => $zone)
                                    <option value="{{ $id }}" {{ in_array($id, $collagezones)?"selected":"" }}>{{ $zone }}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('status')? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-status">{{ __('Status') }}</label>
                                
                                <select name="status" id="input-status" class="form-control form-control-alternative{{ $errors->has('status') ? ' is-invalid' : '' }}" >
                                    <option>Select</option>
                                    <option value="1" {{ $collage->status==1?"selected":"" }}>Active</option>
                                    <option value="0" {{ $collage->status==0?"selected":"" }}>Inactive</option>
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">{{ __('Update') }}</button>
                            <a href="{{ route('admin.collages') }}" class="btn mt-4">Cancel</a>
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