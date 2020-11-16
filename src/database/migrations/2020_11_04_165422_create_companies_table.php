<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'companies',
            function (Blueprint $table) {
                $table->id();
                $table->string('company_name', 100);
                $table->string('company_status', 20);
                $table->foreign('company_status')
                    ->references('value')
                    ->on('company_statuses')
                    ->cascadeOnUpdate();
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
        Schema::dropIfExists('companies');
    }
}
