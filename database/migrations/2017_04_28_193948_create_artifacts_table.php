<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtifactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artifacts', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('component_id');
            $table->string('assignment_id');
            $table->boolean('is_published');
            $table->boolean('is_visible');
            $table->string('artifact_path');
            $table->string('artifact_thumb');
            $table->string('title');
            $table->string('medium');
            $table->string('description', 750);
            $table->string('dimensions_height');
            $table->string('dimensions_width');
            $table->string('dimensions_depth')->nullable();
            $table->string('dimensions_units');
            $table->integer('user_id')->unsigned();            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('artifacts');
    }
}
