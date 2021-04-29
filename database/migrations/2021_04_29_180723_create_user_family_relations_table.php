<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFamilyRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_family_relations', function (Blueprint $table) {
            $table->id();
            $table->Integer('user_id');
            $table->Integer('relation_id');
            $table->String('dob')->nullable();
            $table->Integer('age')->nullable();
            $table->LongText('address')->nullable();
            $table->Integer('phone_no')->nullable();
            $table->String('email')->nullable();  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_family_relations');
    }
}
