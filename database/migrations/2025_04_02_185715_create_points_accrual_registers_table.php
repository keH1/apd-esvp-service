<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('points_accrual_registers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('road_id')->constrained('roads');
            $table->string('travel_identifier');
            $table->dateTime('date_of_travel');
            $table->string('act');
            $table->foreignId('enter_toll_collection_point_id')->nullable()->constrained('toll_collection_points');
            $table->foreignId('exit_toll_collection_point_id')->nullable()->constrained('toll_collection_points');
            $table->string('client');
            $table->string('client_type');
            $table->foreignId('personification_status_id')->constrained('personification_statuses');
            $table->string('personal_account');
            $table->string('kt');
            $table->string('pan');
            $table->string('email')->nullable();
            $table->string('number_of_points');
            $table->string('date_of_points')->nullable();
            $table->foreignId('points_accrual_status_id')->constrained('points_accrual_statuses');
            $table->string('sent_to_broker')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('points_accrual_registers');
    }
};
