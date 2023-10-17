<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('histories', function (Blueprint $table) {
            $table->id();
            $table->integer('ID_stanok');
            $table->text('RFID');
            $table->integer('Count')->nullable();
            $table->timestamps();
            
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('histories');
    }
};
