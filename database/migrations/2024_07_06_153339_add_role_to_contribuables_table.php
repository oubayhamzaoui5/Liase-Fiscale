<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleToContribuablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contribuables', function (Blueprint $table) {
            $table->enum('role', ['user', 'admin'])->default('user'); // Add role column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contribuables', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
}
