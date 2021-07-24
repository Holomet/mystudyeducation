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
                            <h3 class="mb-0">Update Course</h3>
                        </div>
                    </div>
                </div>
                 <div class="card-body">
                    @if($errors->any())
                        {{ implode('', $errors->all('<div>:message</div>')) }}
                    @endif
                    <form method="post" enctype="multipart/form-data" action="{{ route('admin.collages.courses.update') }}" autocomplete="off">
                        @csrf
                        <input type="hidden" name="id" value="{{ $course->id }}" />
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-category">{{ __('Course Category') }}</label>
                                <select name="category" id="input-category" class="form-control form-control-alternative" >
                                    <option>Select</option>
                                    @foreach($categories as $id => $category)
                                    <option value="{{ $id }}" {{ $id==$course->course->course_category_id?"selected":"" }}>{{ $category }}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" for="input-category">{{ __('Course') }}</label>
                                <select name="course_id" id="input-course" class="form-control form-control-alternative" >
                                    <option>Select</option>

                                    @foreach($courses as $id => $cname)
                                    <option value="{{ $id }}" {{ $id==$course->course->id?"selected":"" }}>{{ $cname }}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                    <strong></strong>
                                </span>
                            </div>
                        </div>
                         <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                <input type="text" name="course_name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ $course->course_name }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('broschure') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-broschure">{{ __('Broschure') }}</label>
                                <input type="file" name="broschure" id="input-broschure" class="form-control form-control-alternative{{ $errors->has('broschure') ? ' is-invalid' : '' }}" placeholder="{{ __('Broschure') }}" value="" autofocus>

                                @if ($errors->has('broschure'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('broschure') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('fee_details')? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-fee_details">{{ __('Fee Details') }}</label>
                                <textarea class="form-control" name="fee_details" placeholder="Fee Details">{{ isset($coursefee->fee_details)?$coursefee->fee_details:'' }}</textarea>
                                @if ($errors->has('fee_details'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fee_details') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('link_more_details') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-link_more_details">{{ __('More details link') }}</label>
                                <input type="text" name="link_more_details" id="input-link_more_details" class="form-control form-control-alternative{{ $errors->has('link_more_details') ? ' is-invalid' : '' }}" placeholder="{{ __('More details link') }}" value="{{ isset($coursefee->link_more_details)?$coursefee->link_more_details:"" }}" required autofocus>

                                @if ($errors->has('link_more_details'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('link_more_details') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('link_apply') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-link_apply">{{ __('Apply link') }}</label>
                                <input type="text" name="link_apply" id="input-link_apply" class="form-control form-control-alternative{{ $errors->has('link_apply') ? ' is-invalid' : '' }}" placeholder="{{ __('Apply link') }}" value="{{ isset($coursefee->link_apply)?$coursefee->link_apply:"" }}" required autofocus>

                                @if ($errors->has('link_apply'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('link_apply') }}</strong>
                                    </span>
                                @endif
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