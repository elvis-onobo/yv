<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('created_by');
            $table->string('project_picture');
            $table->string('title');
            $table->string('returns');
            $table->string('duration');
            $table->string('location');
            $table->string('minimum_investment');
            $table->string('risk'); //low, medium and high
            $table->string('partner'); //company we are running the project with
            $table->text('details');       
            $table->string('code');
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
        Schema::dropIfExists('projects');
    }
}
