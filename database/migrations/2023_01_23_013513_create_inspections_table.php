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
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('establishment_id')->constrained('establishments', 'id')->cascadeOnDelete();
            $table->string('io_number')->unique();
            $table->text('to');
            $table->text('proceed');
            $table->string('purpose');
            $table->string('duration');
            $table->string('remarks');
            $table->string('chief');
            $table->string('marshal');
            $table->timestamp('processed_at');
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
        Schema::dropIfExists('inspections');
    }
};
