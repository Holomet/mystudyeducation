<form method="post" id="updaterole" action="{{ route('admin.roles.update') }}" autocomplete="off">
    @csrf
    <input type="hidden" name="id" value="{{ $role->id }}" />
    <div class="pl-lg-4">
        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
            <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
            <input type="text" value="{{ $role->name }}" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}"  autofocus>
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
                <option value="1" {{ $role->status==1?'selected':'' }}>Active</option>
                <option value="0" {{ $role->status==0?'selected':'' }}>Inactive</option>
            </select>
            <span class="invalid-feedback" role="alert">
                <strong></strong>
            </span>
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-success mt-4">{{ __('Update') }}</button>
        <a href="{{ route('admin.roles') }}" class="btn mt-4">Cancel</a>
    </div>
</form>