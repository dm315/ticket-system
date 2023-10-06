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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('subject');
            $table->tinyInteger('type')->default(1)->comment('صفر ==>نامه  و یک ==>تسک');
            $table->tinyInteger('priority')->default(0)->comment('صفر ==>عادی  یک ==>لحظه ای  دو ==>آنی');
            $table->foreignId('status_id')->constrained('statuses')->onUpdate('cascade');
            $table->timestamp('due_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
