@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 row-1">
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
            <div class="card">
                <div class="card-header">Add Beneficiary</div>

                <div class="card-body">

                        <form role="form" enctype="multipart/form-data" method="post" action="{{ route('report.form.submit') }}" class="form-horizontal report_form" name = "report_form">
                            <!-- text input -->
                            {{ csrf_field() }}
                            <div class="form-group">
                                {!! Html::decode(Form::label('beneficiary_name', 'Beneficiary Name <span class="required_star">*</span>',['class'=>'control-label col-lg-3'])) !!}
                                <div class="col-lg-9">
                                    <input type="text" required class="form-control" name="beneficiary_name" placeholder="Beneficiary Name" value="{!! old('beneficiary_name') !!}">
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Html::decode(Form::label('address', 'Address <span class="required_star">*</span>',['class'=>'control-label col-lg-3'])) !!}
                                <div class="col-lg-9">
                                    <input type="text" required class="form-control" name="address" placeholder="Address" value="{!! old('address') !!}">
                                </div>
                            </div>

                            <div class="form-group">
                                {!! Html::decode(Form::label('supplier_gst_number', 'Supplier GST Number',['class'=>'control-label col-lg-3'])) !!}
                                <div class="col-lg-9">
                                    <input type="text" class="form-control" name="supplier_gst_number" placeholder="Supplier GST Number" value="{!! old('supplier_gst_number') !!}">
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Html::decode(Form::label('bank_name', 'Bank Name <span class="required_star">*</span>',['class'=>'control-label col-lg-3'])) !!}
                                <div class="col-lg-9">
                                    <input type="text" required class="form-control" name="bank_name" placeholder="Bank Name" value="{!! old('bank_name') !!}">
                                </div>
                            </div>
                            <div class="form-group date_tp">
                                {!! Html::decode(Form::label('bank_account_number', 'Bank Account Number <span class="required_star">*</span>',['class'=>'control-label col-lg-3'])) !!}
                                <div class="col-lg-9">
                                    <input type="text" required class="form-control" name="bank_account_number" placeholder="Bank Account Number" value="{!! old('bank_account_number') !!}">
                                </div>
                            </div>
                            <div class="form-group date_tp">
                                {!! Html::decode(Form::label('ifsc_code', 'IFSC Code <span class="required_star">*</span>',['class'=>'control-label col-lg-3'])) !!}
                                <div class="col-lg-9">
                                    <input type="text" required class="form-control" name="ifsc_code" placeholder="IFSC Code" value="{!! old('ifsc_code') !!}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form_btn_row">
                                    <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>

        <div class="col-md-12 row-2">
            <div class="card">
                <div class="card-header">Beneficiary <a href="#" id="cmd" class="btn btn-primary">Generate Report</a></div>

                <div class="card-body" id="content">
                    @if($reports->count() > 0)
                        <table class="report-table">
                            <thead>
                                <tr><th></th>
                                    <th>S.No.</th>
                                    <th>Beneficiary Name</th>
                                    <th>Address</th>
                                    <th>Supplier GST Number</th>
                                    <th>Bank Name</th>
                                    <th>Bank Account Number</th>
                                    <th>IFSC Code</th>
                                    <th>Amount</th>
                                    <th>UTR Number</th>
                                    <th>Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reports as $key=>$report)
                                    <tr class="{{ $key }}">
                                        <td><input type="checkbox" class="report-checkbox"></td>
                                        <td class="sno">{{ $loop->iteration }}</td>
                                        <td class="beneficiary_name">{{ $report->beneficiary_name }}</td>
                                        <td class="address">{{ $report->address }}</td>
                                        <td class="supplier_gst_number">{{ $report->supplier_gst_number }}</td>
                                        <td class="bank_name">{{ $report->bank_name }}</td>
                                        <td class="bank_account_number">{{ $report->bank_account_number }}</td>
                                        <td class="ifsc_code">{{ $report->ifsc_code }}</td>
                                        <td class="amount"><input type="text" required class="form-control" name="amount" placeholder="Amount" ></td>
                                        <td class="utr_number"><input type="text" required class="form-control" name="utr_number" placeholder="UTR Number" ></td>
                                        <td><a href="{{ route('report.edit',$report->id) }}" title="Edit"><i class="fa fa-pencil"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div style="display:none;">
    <div id="pdf-content">
        <div class="container">
            <div class="report-header1" style="width: 100%;">
                <div class="left-div" style="float:right;">Date: {{ date('d-m-Y') }}</div>
            </div>
            <h1 style="width: 100%;text-align: center;">AMBICA CLOTHES</h1>
            <div class="report-header2">
                <div class="left-div" style="float:left;">491/492 NCR Delhi</div>
                <div class="right-div" style="float:right;">Cheque No. : </div>
            </div>
            <p>Kindly transfer the following amount to the respective parties and debit the same to our Current A/c No. 120110000512.</p>
            <table width="100%">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Beneficiary Name</th>
                        <th>Address</th>
                        <th>Supplier GST Number</th>
                        <th>Bank Name</th>
                        <th>Bank Account Number</th>
                        <th>IFSC Code</th>
                        <th>Amount</th>
                        <th>UTR Number</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $( document ).ready(function() {
          // Default export is a4 paper, portrait, using milimeters for units
        $('#cmd').on('click', function (e) {
            e.preventDefault();
            var tr = '';
            $('.report-checkbox').each(function () {
                if (this.checked) {
                    tr += '<tr>';
                    tr += '<td>'+$(this).closest('tr').find('td.sno').text()+'</td>';
                    tr += '<td>'+$(this).closest('tr').find('td.beneficiary_name').text()+'</td>';
                    tr += '<td>'+$(this).closest('tr').find('td.address').text()+'</td>';
                    tr += '<td>'+$(this).closest('tr').find('td.supplier_gst_number').text()+'</td>';
                    tr += '<td>'+$(this).closest('tr').find('td.bank_name').text()+'</td>';
                    tr += '<td>'+$(this).closest('tr').find('td.bank_account_number').text()+'</td>';
                    tr += '<td>'+$(this).closest('tr').find('td.ifsc_code').text()+'</td>';
                    if($(this).closest('tr').find('td.amount').find('input[type=text]').val() != '') {
                        tr += '<td>' + $(this).closest('tr').find('td.amount').find('input[type=text]').val() + '</td>';
                    } else {
                        tr += '<td></td>';
                    }
                    if($(this).closest('tr').find('td.utr_number').find('input[type=text]').val() != '') {
                        tr += '<td>' + $(this).closest('tr').find('td.utr_number').find('input[type=text]').val() + '</td>';
                    } else {
                        tr += '<td></td>';
                    }
                    tr += '</tr>';
                }
            });
            $('#pdf-content').find('tbody').html(tr);

            var doc = new jsPDF();
            doc.fromHTML($('#pdf-content').html(), 5, 5)
            doc.save('a4.pdf');
        });

    });
</script>
@endsection
