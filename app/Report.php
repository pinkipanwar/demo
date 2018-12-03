<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;

    protected $table = "report";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'beneficiary_name',
        'address',
        'supplier_gst_number',
        'bank_name',
        'bank_account_number',
        'ifsc_code',
        /*'amount',
        'utr_number'*/
    ];

    public function getRules()
    {
        return [
            'beneficiary_name' => 'required|alpha_spaces',
            'address' => 'required',
            'supplier_gst_number'=>'nullable',
            'bank_name'=>'required|alpha_spaces',
            'bank_account_number'=>'required|onlyNumbers',
            'ifsc_code'=>'required|onlyLettersNumbers',
            /*'amount'=>'required|between:1,99.99',
            'utr_number'=>'required|onlyLettersNumbers'*/
        ];
    }
}
