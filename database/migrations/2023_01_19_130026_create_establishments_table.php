<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establishments', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->string('owner')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('ops_number')->nullable()->unique();
            $table->date('date_released')->nullable();
            $table->string('fsic_prefix')->nullable();
            $table->integer('fsic_number')->nullable();
            $table->string('fsic')->nullable()->unique();
            $table->enum('issuance', ['NEW', 'RENEW'])->default('NEW')->nullable();
            $table->enum('status', ['For Inspection', 'For Compliance', 'For Re-Inspection', 'Completed'])->default('For Inspection')->nullable();
            $table->string('occupancy')->nullable();
            $table->string('area')->nullable();
            $table->string('remarks')->nullable();
            $table->date('inspection_date')->nullable();
            $table->string('io_number')->nullable();
            $table->string('amount')->nullable();
            $table->string('realty_tax')->nullable();
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
        Schema::dropIfExists('establishments');
    }
};
