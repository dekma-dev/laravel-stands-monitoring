<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('mark_infos', function (Blueprint $table) {
            $table->id();
            $table->text('Mark');
            $table->text('Purpose');
            $table->string('Country');
            $table->timestamps();

            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mark_infos');
    }
};
