<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');//should not be unique because one user can invest more than once
            $table->string('project_id');
            $table->string('tranx_type'); //records whether the transaction type is withdrawal or deposit
            $table->string('amount_invested');
            $table->string('slots'); //number of slots bought by the user
            $table->string('duration');
            $table->string('roi');
            $table->string('project_code');
            $table->string('authorization');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
