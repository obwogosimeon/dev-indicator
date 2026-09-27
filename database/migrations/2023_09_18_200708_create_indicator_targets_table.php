<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIndicatorTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('indicator_targets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('january')->nullable();
            $table->string('february')->nullable();
            $table->string('march')->nullable();
            $table->string('april')->nullable();
            $table->string('may')->nullable();
            $table->string('june')->nullable();
            $table->string('july')->nullable();
            $table->string('august')->nullable();
            $table->string('september')->nullable();
            $table->string('october')->nullable();
            $table->string('november')->nullable();
            $table->string('december')->nullable();
            $table->string('jan_feb')->nullable();
            $table->string('mar_apr')->nullable();
            $table->string('may_june')->nullable();
            $table->string('july_aug')->nullable();
            $table->string('sep_oct')->nullable();
            $table->string('nov_dec')->nullable();
            $table->string('jan_march')->nullable();
            $table->string('april_june')->nullable();
            $table->string('july_september')->nullable();
            $table->string('october_december')->nullable();
            $table->string('jan_june')->nullable();
            $table->string('july_december')->nullable();
            $table->string('jan_december')->nullable();
            $table->string('baseline')->nullable();
            $table->string('target')->nullable();
            $table->string('label')->nullable();
            $table->string('frequency')->nullable();
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
        Schema::dropIfExists('indicator_targets');
    }
}
