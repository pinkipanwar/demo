<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::all();
        $data['reports'] = $reports;
        return view('home',$data);
    }

    public function reportFormSubmit(Request $request)
    {
        $model = new Report();
        $validator = \Validator::make($request->all(), $model->getRules());
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors())->with(['status' => 'error', 'message' => 'Please check errors.']);
        }

        try {
            \DB::beginTransaction();
            $model->beneficiary_name = $request->beneficiary_name;
            $model->address = $request->address;
            $model->supplier_gst_number = $request->supplier_gst_number;
            $model->bank_name = $request->bank_name;
            $model->bank_account_number = $request->bank_account_number;
            $model->ifsc_code = $request->ifsc_code;
                /*'amount' => $request->amount,
                'utr_number' => $request->utr_number*/
            $model->save();
            \DB::commit();
            return redirect()->back()->with(['status' => 'success', 'message' => 'Record has been added successfully.']);

        } catch (\Exception $e) {
            \Log::info('report_add_error' . $e->getMessage());
        }
        return redirect()->back()->withInput()->with(['status' => 'error', 'message' => 'Something went wrong. Please try again later.']);
    }


    public function report_edit($report_id)
    {
        $report = Report::find($report_id);
        $data['report'] = $report;
        return view('report-edit',$data);
    }

    public function report_update(Request $request)
    {
        $model = Report::find($request->id);
        $validator = \Validator::make($request->all(), $model->getRules());
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator->errors())->with(['status' => 'error', 'message' => 'Please check errors.']);
        }

        try {
            \DB::beginTransaction();
            $model->beneficiary_name = $request->beneficiary_name;
            $model->address = $request->address;
            $model->supplier_gst_number = $request->supplier_gst_number;
            $model->bank_name = $request->bank_name;
            $model->bank_account_number = $request->bank_account_number;
            $model->ifsc_code = $request->ifsc_code;
            /*'amount' => $request->amount,
            'utr_number' => $request->utr_number*/
            $model->save();
            \DB::commit();
            return redirect()->route('home')->with(['status' => 'success', 'message' => 'Record has been updated successfully.']);
        } catch (\Exception $e) {
            \Log::info('report_update_error' . $e->getMessage());
        }
        return redirect()->back()->withInput()->with(['status' => 'error', 'message' => 'Something went wrong. Please try again later.']);
    }
}
