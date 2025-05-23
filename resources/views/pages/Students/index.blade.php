@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
{{trans('main_trans.list_students')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('main_trans.list_students')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <a href="{{route('Students.create')}}" class="btn btn-success btn-sm" role="button"
                                aria-pressed="true">{{trans('main_trans.add_student')}}</a><br><br>
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                    data-page-length="50"
                                    style="text-align: center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{trans('Students_trans.name')}}</th>
                                            <th>{{trans('Students_trans.email')}}</th>
                                            <th>{{trans('Students_trans.gender')}}</th>
                                            <th>{{trans('Students_trans.Grade')}}</th>
                                            <th>{{trans('Students_trans.classrooms')}}</th>
                                            <th>{{trans('Students_trans.section')}}</th>
                                            <th>{{trans('Students_trans.Processes')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $student)
                                        <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{$student->name}}</td>
                                            <td>{{$student->email}}</td>
                                            <td>{{$student->gender->Name}}</td>
                                            <td>{{$student->grade->Name}}</td>
                                            <td>{{$student->classroom->Name_Class}}</td>
                                            <td>{{$student->section->Name_Section}}</td>
                                            <td>
                                                <div class="dropdown show">
                                                    <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{trans('Students_trans.Operations')}}
                                                    </a>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                        <a class="dropdown-item" href="{{route('Students.show',$student->id)}}">
                                                            <i style="color: #ffc107" class="fa fa-eye"></i>&nbsp; {{trans('Students_trans.View_student')}}
                                                        </a>

                                                        <a class="dropdown-item" href="{{route('Students.edit',$student->id)}}">
                                                            <i style="color:rgb(204, 111, 11)" class="fa fa-edit"></i>&nbsp; {{trans('Students_trans.Modify_student_data')}}
                                                        </a>

                                                        <a class="dropdown-item" href="{{route('Fees_Invoices.show',$student->id)}}">
                                                            <i style="color: #0000cc" class="fa fa-edit"></i>&nbsp; {{trans('Students_trans.Add_a_fee_invoice')}}
                                                        </a>

                                                        <a class="dropdown-item" href="{{route('receipt_students.show',$student->id)}}">
                                                            <i style="color: #9dc8e2" class="fa fa-money"></i>&nbsp; {{trans('Students_trans.Receipt_voucher')}}
                                                        </a>

                                                        <a class="dropdown-item" href="{{route('ProcessingFee.show',$student->id)}}">
                                                            <i style="color: #aa2801cb" class="fa fa-ban"></i>&nbsp; {{trans('Students_trans.Exclude_Fees')}}
                                                        </a>

                                                        <a class="dropdown-item" href="{{route('Payment_students.show',$student->id)}}">
                                                            <i style="color:rgb(83, 187, 22)" class="fa fa-handshake-o"></i>&nbsp; {{trans('Students_trans.Bill_of_exchange')}}
                                                        </a>

                                                        <a class="dropdown-item" data-target="#Delete_Student{{ $student->id }}" data-toggle="modal" href="#Delete_Student{{ $student->id }}">
                                                            <i style="color: red" class="fa fa-trash"></i>&nbsp; {{trans('Students_trans.Delete_student_data')}}
                                                        </a>
                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                        @include('pages.Students.Delete')
                                        @endforeach
                                </table>
                            </div>
                        </div>
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