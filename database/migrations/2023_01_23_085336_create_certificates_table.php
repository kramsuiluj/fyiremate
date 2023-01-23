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
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('establishment_id')->constrained('establishments', 'id');
            $table->string('fsic')->unique();
            $table->date('filled_date');
            $table->date('valid_until');
            $table->text('description');
            $table->text('address');
            $table->string('chief');
            $table->string('marshal');
            $table->enum('validity', ['Valid', 'Invalid'])->default('Valid');
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
        Schema::dropIfExists('certificates');
    }
};
