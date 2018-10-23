
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArtifactCollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artifact_collection', function (Blueprint $table) {
            $table->integer('collection_id')->unsigned();
            $table->integer('artifact_id')->unsigned();
            $table->integer('position')->unsigned();
            
            $table->foreign('collection_id')
                  ->references('id')
                  ->on('collections')
                  ->onDelete('cascade');

            $table->foreign('artifact_id')
                  ->references('id')
                  ->on('artifacts')
                  ->onDelete('cascade');

            $table->primary(['artifact_id', 'collection_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('artifact_collection');
    }
}
