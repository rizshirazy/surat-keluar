<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsAtUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nip')->nullable();
            $table->string('position')->nullable();
            $table->integer('department_id')->unsigned()->nullable();
            $table->enum('is_active', ['N', 'Y'])->default('N');
            $table->enum('is_admin', ['N', 'Y'])->default('N');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nip');
            $table->dropColumn('position');
            $table->dropColumn('department_id');
            $table->dropColumn('is_active');
            $table->dropColumn('is_admin');
            $table->dropSoftDeletes();
        });
    }
}
