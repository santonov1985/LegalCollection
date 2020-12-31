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
            $table->integer('notary_id')->unsigned();
            $table->foreign('notary_id')->references('id')->on('notaries')->cascadeOnDelete();
            $table->string('number_loan')->unique();
            $table->string('iin');
            $table->string('identification')->unique();
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('mobile_phone');
            $table->string('work_phone')->nullable();
            $table->string('residence_address')->nullable();
            $table->string('place_of_residence')->nullable();
            $table->string('date_of_issue');
            $table->string('loan_term');
            $table->string('issued_amount');
            $table->string('number_of_day_overdue');
            $table->double('delayed_od');
            $table->double('delayed_prc');
            $table->double('delayed_fines');
            $table->double('total')->nullable();
            $table->double('notary_cost')->nullable();
            $table->double('total_with_notary_cost')->nullable();
            $table->string('transfer_date');
            $table->string('key_status')->nullable();
            $table->string('part_payment')->nullable();
            $table->string('status')->nullable();
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
