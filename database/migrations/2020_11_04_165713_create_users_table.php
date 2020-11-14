<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'users',
            function (Blueprint $table) {
                $table->id();
                $table->string('first_name', 50);
                $table->string('last_name', 50);
                $table->foreignId('company_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->string('role', 20)->default('user');
                $table->foreign('role')->references('id')->on('user_roles')->cascadeOnUpdate();
                $table->string('email')->unique();
                $table->string('password')->nullable();
                $table->rememberToken();
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
