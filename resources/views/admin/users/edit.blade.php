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
                            <h3 class="mb-0">Edit User</h3>
                        </div>
                        <div class="col-4 text-right">
                            <a href="{{ route('admin.users') }}"  class="btn btn-sm btn-primary">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
                 <div class="card-body">
                    <form method="post" action="{{ route('admin.users.update') }}" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id" value="{{ $user->id }}">
                         <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('first_name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-first_name">{{ __('First Name') }}</label>
                                <input type="text" name="first_name" id="input-first_name" class="form-control form-control-alternative{{ $errors->has('first_name') ? ' is-invalid' : '' }}" placeholder="{{ __('First Name') }}" value="{{ $user->first_name }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-last_name">{{ __('Last Name') }}</label>
                                <input type="text" name="last_name" id="input-last_name" class="form-control form-control-alternative{{ $errors->has('last_name') ? ' is-invalid' : '' }}" placeholder="{{ __('Last Name') }}" value="{{ $user->last_name }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                <input type="text" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ $user->email }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('role_id')? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-role_id">{{ __('Role') }}</label>
                                <select name="role_id" id="input-role_id" class="form-control form-control-alternative{{ $errors->has('role_id') ? ' is-invalid' : '' }}" >
                                    <option>Select</option>
                                    @foreach($roles as $id => $role)
                                    <option value="{{ $id }}" {{ $id==$user->role_id?"selected":'' }} >{{ $role }}</option>
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
                                    <option value="1" {{ $user->status==1?"selected":'' }}>Active</option>
                                    <option value="0" {{ $user->status==0?"selected":'' }}>Inactive</option>
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">{{ __('Update') }}</button>
                            <a href="{{ route('admin.users') }}" class="btn mt-4">Cancel</a>
                        </div>
                    </form>
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