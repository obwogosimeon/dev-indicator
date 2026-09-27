<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budgets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('project_id');
            $table->string('entry_id');
            $table->string('annual_amounta')->nullable();
            $table->string('annual_amountb')->nullable();
            $table->string('annual_amountx')->nullable();
            $table->string('period');
            $table->string('exchange_rate');
            $table->string('status');
            $table->string('created_by');
            $table->string('organization_id');
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
        Schema::dropIfExists('budgets');
    }
}
