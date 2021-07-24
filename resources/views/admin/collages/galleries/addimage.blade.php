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
                            <h3 class="mb-0">Add Image</h3>
                        </div>
                    </div>
                </div>
                 <div class="card-body">
                    @if($errors->any())
                        {{ implode('', $errors->all('<div>:message</div>')) }}
                    @endif
                    <form method="post" enctype="multipart/form-data" action="{{ route('admin.collages.courses.image.save') }}" autocomplete="off">
                        @csrf
                        <input type="hidden" name="college_gallery_id" value="{{ $id }}" />
                        <div class="pl-lg-4">
                            <div class="form-group{{ $errors->has('image') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-image">{{ __('Image') }}</label>
                                <input type="file" name="image" id="input-image" class="form-control form-control-alternative{{ $errors->has('image') ? ' is-invalid' : '' }}" placeholder="{{ __('Image') }}" value="" required autofocus>

                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
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