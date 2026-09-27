<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budget_expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('workplancontainer_id')->nullable();
            $table->string('annual_budget')->nullable();
            $table->string('budget_current_period')->nullable();
            $table->string('expense_previous_period')->nullable();
            $table->string('expense_current_period')->nullable();
            $table->string('expense_total')->nullable();
            $table->string('utilization')->nullable();
            $table->string('organization_id')->nullable();
            $table->string('status')->nullable();
            $table->string('created_by')->nullable();
            $table->string('project_id')->nullable();
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
        Schema::dropIfExists('budget_expenses');
    }
}
