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
                            <h3 class="mb-0">View Course</h3>
                        </div>
                    </div>
                </div>
                 <div class="card-body">
                    @if($errors->any())
                        {{ implode('', $errors->all('<div>:message</div>')) }}
                    @endif
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th>Course Category</th>
                                <td>{{ $course->course->category->name }}</td>
                            </tr>
                            <tr>
                                <th>Course Name</th>
                                <td>{{ $course->course_name }}</td>
                            </tr>
                            <tr>
                                <th>Brochure</th>
                                <td><a href="{{asset('broschure/'.$course->broschure) }}" target="_blank">Download</a></td>
                            </tr>
                            <tr>
                                <th>Fee Details</th>
                                <td>
                                    {!! nl2br($coursefee->fee_details) !!}
                                </td>
                            </tr>
                            <tr>
                                <th>Read More link</th>
                                <td>
                                    <a href="{{ $coursefee->link_more_details }}" target="_blank">Link</a>
                                </td>
                            </tr>
                            <tr>
                                <th>Apply link</th>
                                <td>
                                    <a href="{{ $coursefee->link_apply }}" target="_blank">Link</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection