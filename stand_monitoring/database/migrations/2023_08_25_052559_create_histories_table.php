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
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->integer('ID_stanok');
            $table->text('RFID');
            $table->integer('Count')->nullable();
            $table->boolean('State');
            $table->float('Condition')->nullable();
            $table->integer('worktime');
            $table->text('Purpose');
            $table->text('Country');
            $table->String('Authenticity');
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
