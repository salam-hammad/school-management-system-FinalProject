@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('Students-trans.Add_a_study_subject') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ trans('Students_trans.Add_a_study_subject') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if (session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="col-xs-12">
                    <div class="col-md-12">
                        <br>
                        <form action="{{ route('subjects.store') }}" method="post" autocomplete="off">
                            @csrf

                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{ trans('Students_trans.Name_of_material_a') }}</label>
                                    <input type="text" name="Name_ar" class="form-control">
                                </div>
                                <div class="col">
                                    <label for="title">{{ trans('Students_trans.Name_of_material_e') }} </label>
                                    <input type="text" name="Name_en" class="form-control">
                                </div>
                            </div>
                            <br>

                            <div class="form-row">
                                <div class="form-group col">
                                    <label for="inputState"> {{ trans('Students_trans.Academic_stage') }}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="Grade_id">
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}">{{ $grade->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col">
                                    <label for="inputState">{{ trans('Students_trans.classrooms') }}</label>
                                    <select name="Class_id" class="custom-select"></select>
                                </div>


                                <div class="form-group col">
                                    <label for="inputState">{{ trans('Teacher_trans.Name_Teacher') }}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="teacher_id">
                                        <option selected disabled>{{ trans('Parent_trans.Choose') }}...</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}">{{ $teacher->Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right"
                                type="submit">{{ trans('Students_trans.submit_data') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render

@endsection