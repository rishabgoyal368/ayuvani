<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUserRelation2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_family_relations', function(Blueprint $table) {
              $table->dropColumn('phone_no');
        });
        Schema::table('user_family_relations', function($table) {
            $table->BigInteger('phone_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_family_relations', function($table) {
            $table->dropColumn('phone_no');
        });
    }
}
