<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyArtifactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('artifacts', function (Blueprint $table) {
        
        $table->string('title')->nullable()->change();
        $table->string('medium')->nullable()->change();
        $table->string('description', 500)->nullable()->change();
        $table->string('dimensions_height')->nullable()->change();
        $table->string('dimensions_width')->nullable()->change();
        $table->string('dimensions_depth')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
