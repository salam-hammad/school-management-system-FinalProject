@extends('layouts.master')
@section('css')
    @toastr_css
    <style>
        .custom-select,
        .form-control {
            height: auto !important;
            min-height: 45px;
            padding: 10px;
            line-height: 1.5;
            white-space: normal;
        }
    </style>
@endsection
@section('title')
    {{ trans('Students_trans.Add_a_new_invoice') }}
@stop
@section('page-header')
@section('PageTitle')
    {{ trans('Students_trans.Add_a_new_invoice') }} {{ $student->name }}
@stop
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="row mb-30" action="{{ route('Fees_Invoices.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Fees">
                                <div data-repeater-item>
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label>{{ trans('Students_trans.name') }}</label>
                                            <select class="form-control" name="student_id" required>
                                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>{{ trans('Students_trans.Fee_type') }}</label>
                                            <select class="form-control" name="fee_id" required>
                                                <option value="">--
                                                    {{ trans('Students_trans.Choose_from_the_list') }}--</option>
                                                @foreach ($fees as $fee)
                                                    <option value="{{ $fee->id }}">{{ $fee->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>{{ trans('Students_trans.Amount') }}</label>
                                            <select class="form-control" name="amount" required>
                                                <option value="">
                                                    --{{ trans('Students_trans.Choose_from_the_list') }}--</option>
                                                @foreach ($fees as $fee)
                                                    <option value="{{ $fee->amount }}">{{ $fee->amount }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label>{{ trans('Students_trans.Statement') }}</label>
                                            <input type="text" class="form-control" name="description" required>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label>{{ trans('My_Classes_trans.Processes') }}</label>
                                            <input class="btn btn-danger btn-block" data-repeater-delete type="button"
                                                value="{{ trans('My_Classes_trans.delete_row') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-20">
                                <div class="col-12">
                                    <input class="btn btn-success" data-repeater-create type="button"
                                        value="{{ trans('My_Classes_trans.add_row') }}" />
                                </div>
                            </div>
                            <br>

                            <input type="hidden" name="Grade_id" value="{{ $student->Grade_id }}">
                            <input type="hidden" name="Classroom_id" value="{{ $student->Classroom_id }}">

                            <button type="submit"
                                class="btn btn-primary">{{ trans('Students_trans.submit_data') }}</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection