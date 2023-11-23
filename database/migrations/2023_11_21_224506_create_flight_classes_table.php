<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flight_classes', function (Blueprint $table) {
            $table->id();
            $table->integer('seats_qty');
            $table->foreignId('flight_class_type_id')->constrained('flight_class_types');
            $table->foreignId('flight_id')->constrained('flights');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_classes');
    }
};
