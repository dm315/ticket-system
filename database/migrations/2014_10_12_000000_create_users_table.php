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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fName');
            $table->string('lName');
            $table->string('username')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile')->nullable();
            $table->date('birth')->nullable();
            $table->string('position')->nullable()->comment('سِمَت کاربر');
            $table->text('profile')->nullable();
            $table->text('signature_image')->nullable();
            $table->tinyInteger('user_type')->default(0)->comment('0 => user , 1 => admin , 2 => super admin');
            $table->tinyInteger('is_verified')->default(0)->comment('0 => not verified , 1 => verified');
            $table->tinyInteger('gender')->default(0)->comment('0 => men , 1 => women');
            $table->tinyInteger('connection')->default(1)->comment('0 => dont send connection email , 1 => send connection email');
            $table->string('mail_authority')->nullable()->comment('0 => start , 1 => Initial review , 2 => returned');
            $table->string('task_authority')->nullable()->comment('0 => start , 1 => Initial review , 2 => complete, 3 => finish , 4 => ended , 5 => canceled');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
