<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotariesTableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notaries_table', function (Blueprint $table) {
            $table->id();
            $table->integer('number_loan')->unique();
            $table->string('iin')->unique();
            $table->string('identification')->unique();
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('mobile_phone');
            $table->string('work_phone')->nullable();
            $table->string('residence_address')->nullable();
            $table->string('place_of_residence')->nullable();
            $table->string('date_of_issue');
            $table->integer('loan_term');
            $table->integer('issued_amount');
            $table->integer('number_of_day_overdue');
            $table->double('delayed_od');
            $table->double('delayed_prc');
            $table->double('delayed_fines');
            $table->double('total')->nullable();
            $table->double('notary_cost')->nullable();
            $table->double('total_with_notary_cost')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('notaries_table');
    }
}
