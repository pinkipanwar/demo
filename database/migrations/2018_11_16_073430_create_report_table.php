<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report', function (Blueprint $table) {
            $table->increments('id');
            $table->string('beneficiary_name');
            $table->string('address');
            $table->string('supplier_gst_number')->nullable();
            $table->string('bank_name');
            $table->string('bank_account_number');
            $table->string('ifsc_code');
            /*$table->float('amount');
            $table->string('utr_number');*/
            $table->timestamps();
            $table->SoftDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('report');
    }
}
