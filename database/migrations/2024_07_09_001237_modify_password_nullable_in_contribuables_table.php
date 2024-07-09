<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPasswordNullableInContribuablesTable extends Migration
{
    public function up()
    {
        Schema::table('contribuables', function (Blueprint $table) {
            $table->string('password')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('contribuables', function (Blueprint $table) {
            $table->string('password')->nullable(false)->change();
        });
    }
}
