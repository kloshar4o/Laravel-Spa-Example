<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'company_addresses',
            function (Blueprint $table) {
                $table->id();
                $table->foreignId('company_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
                $table->string('country', 55);
                $table->string('city', 50);
                $table->string('town', 60);
                $table->string('street_address', 60);
                $table->string('state', 50)->nullable();
                $table->string('zip', 18);
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
        Schema::dropIfExists('company_addresses');
    }
}
