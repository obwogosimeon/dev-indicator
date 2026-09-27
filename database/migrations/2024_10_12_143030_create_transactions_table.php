<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('project_id')->nullable();
            $table->string('implementation_container_id')->nullable();
            $table->string('program_id')->nullable();
            $table->string('budget_id')->nullable();
            $table->string('total_expense')->nullable();
            $table->string('total_budget')->nullable();
            $table->string('reporting_frequency_tally')->nullable();
            $table->string('total_utilization')->nullable();
            $table->string('funding_id')->nullable();
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
