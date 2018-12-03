@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 row-1">
                <div class="card">
                    <div class="card-header">Edit Beneficiary</div>

                    <div class="card-body">
                        @if (session('status'))
                            @php
                                $status = session('status');
                            @endphp
                            <div class="alert @if($status == 'success')alert-success @else alert-danger @endif" role="alert">
                                <ul>
                                    @if($status == 'success')
                                        <li>{{ $status }}</li>
                                    @endif
                                    @if ($errors->any())
                                        {!! implode('', $errors->all('<ul><li>:message</li></ul>')) !!}
                                    @endif
                                </ul>
                            </div>
                        @endif

                        <form role="form" enctype="multipart/form-data" method="post" action="{{ route('report.update') }}" class="form-horizontal report_form" name = "report_form">
                            <!-- text input -->
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value="{{ $report->id }}">
                            <div class="form-group">
                                {!! Html::decode(Form::label('beneficiary_name', 'Beneficiary Name <span class="required_star">*</span>',['class'=>'control-label col-lg-3'])) !!}
                                <div class="col-lg-9">
                                    <input type="text" required class="form-control" name="beneficiary_name" placeholder="Beneficiary Name" value="{!! old('beneficiary_name',$report->beneficiary_name) !!}">
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Html::decode(Form::label('address', 'Address <span class="required_star">*</span>',['class'=>'control-label col-lg-3'])) !!}
                                <div class="col-lg-9">
                                    <input type="text" required class="form-control" name="address" placeholder="Address" value="{!! old('address',$report->address) !!}">
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Html::decode(Form::label('supplier_gst_number', 'Supplier GST Number',['class'=>'control-label col-lg-3'])) !!}
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="supplier_gst_number" placeholder="Supplier GST Number" value="{!! old('supplier_gst_number',$report->supplier_gst_number) !!}">
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Html::decode(Form::label('bank_name', 'Bank Name <span class="required_star">*</span>',['class'=>'control-label col-lg-3'])) !!}
                                <div class="col-lg-9">
                                    <input type="text" required class="form-control" name="bank_name" placeholder="Bank Name" value="{!! old('bank_name',$report->bank_name) !!}">
                                </div>
                            </div>
                            <div class="form-group date_tp">
                                {!! Html::decode(Form::label('bank_account_number', 'Bank Account Number <span class="required_star">*</span>',['class'=>'control-label col-lg-3'])) !!}
                                <div class="col-lg-9">
                                    <input type="text" required class="form-control" name="bank_account_number" placeholder="Bank Account Number" value="{!! old('bank_account_number',$report->bank_account_number) !!}">
                                </div>
                            </div>
                            <div class="form-group date_tp">
                                {!! Html::decode(Form::label('ifsc_code', 'IFSC Code <span class="required_star">*</span>',['class'=>'control-label col-lg-3'])) !!}
                                <div class="col-lg-9">
                                    <input type="text" required class="form-control" name="ifsc_code" placeholder="IFSC Code" value="{!! old('ifsc_code',$report->ifsc_code) !!}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form_btn_row">
                                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                    <a href="{!! route('home') !!}" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
