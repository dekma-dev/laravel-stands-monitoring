<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('archive', function (Blueprint $table) {
            $table->id();
            $table->integer('ID_stanok')->nullable();
            $table->text('RFID')->nullable();
            $table->integer('Count')->default(1);
            $table->string('State')->nullable();
            $table->float('Condition')->default(100.0)->nullable();
            $table->integer('worktime')->default(1);
            $table->text('Purpose')->nullable();
            $table->text('Country')->nullable();
            $table->string('Authenticity')->default("False")->nullable();
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archive');
    }
};
