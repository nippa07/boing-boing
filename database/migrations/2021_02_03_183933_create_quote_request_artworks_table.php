<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteRequestArtworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_request_artworks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('quote_request_id')->nullable();
            $table->foreign('quote_request_id')
                ->references('id')
                ->on('quote_requests')
                ->onDelete('cascade');
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
        Schema::dropIfExists('quote_request_artworks');
    }
}
