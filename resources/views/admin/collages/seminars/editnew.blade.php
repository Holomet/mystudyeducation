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
                            <h3 class="mb-0">Create Seminar</h3>
                        </div>
                    </div>
                </div>
                 <div class="card-body">
                    @if($errors->any())
                        {{ implode('', $errors->all('<div>:message</div>')) }}
                    @endif
                    <form method="post" enctype="multipart/form-data" action="{{ route('admin.collages.seminars.updateseminar') }}" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id" value="{{ $seminar->id }}" />
                         <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ $seminar->name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('description')? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-description">{{ __('Description') }}</label>
                                <textarea class="form-control" name="description" placeholder="Description">{{ $seminar->description }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" description="alert">
                                        <strong>{{ $errors->first('fee_details') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('url') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-url">{{ __('URL') }}</label>
                                <input type="text" name="url" id="input-url" class="form-control form-control-alternative{{ $errors->has('url') ? ' is-invalid' : '' }}" placeholder="{{ __('URL') }}" value="{{ $seminar->url }}" autofocus>

                                @if ($errors->has('url'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div><div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('collage_id')? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-collage_id">{{ __('College') }}</label>
                                <select name="collage_id" id="input-collage_id" class="form-control form-control-alternative{{ $errors->has('collage_id') ? ' is-invalid' : '' }}" >
                                    <option value="">Select</option>
                                    @foreach($collages as $id => $collage)
                                    <option value="{{ $id }}" {{ $seminar->college_id==$id?"selected":"" }}>{{ $collage }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('collage_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('collage_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('start_date') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-start_date">{{ __('Start Date') }}</label>
                                <input type="text" name="start_date" id="input-start_date" class="datepicker form-control form-control-alternative{{ $errors->has('start_date') ? ' is-invalid' : '' }}" placeholder="{{ __('Start Date') }}" value="{{ $seminar->start_date }}" required autofocus>

                                @if ($errors->has('start_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('start_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('end_date') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-end_date">{{ __('End Date') }}</label>
                                <input type="text" name="end_date" id="input-end_date" class="datepicker form-control form-control-alternative{{ $errors->has('end_date') ? ' is-invalid' : '' }}" placeholder="{{ __('End Date') }}" value="{{ $seminar->end_date }}" autofocus>

                                @if ($errors->has('end_date'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('end_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('status')? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-status">{{ __('Status') }}</label>
                                <select name="status" id="input-status" class="form-control form-control-alternative{{ $errors->has('status') ? ' is-invalid' : '' }}" >
                                    <option>Select</option>
                                    <option value="1" {{ $seminar->status==1?"selected":"" }}>Active</option>
                                    <option value="0" {{ $seminar->status==0?"selected":"" }}>Inactive</option>
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4">{{ __('Create') }}</button>
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
    $(document).on("change", "#input-category", function(){
        var catid = $(this).val();
        var url = "{{ route('admin.courses.courselist', ['id' => '__id__']) }}";
        $.ajax({
            url : url.replace('__id__', catid),
            dataType: 'json'
        }).done(function(data){
            $('#input-course').empty();
            $('#input-course').append("<option value=''>Select</option>");
            $.each(data, function(key, val){
                $('#input-course').append("<option value='"+key+"'>"+val+"</option>");
            })
        })
    });

    $(document).on("change", "#input-course", function(){
        var coursename = $("#input-course option:selected").text();
        $("#input-name").val(coursename);
    })
</script>
@endpush