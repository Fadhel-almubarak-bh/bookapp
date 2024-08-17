<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocationsBooksTable extends Migration
{
    public function up()
    {
        Schema::create('locations_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('locations_books');
        Schema::table('locations_books', function (Blueprint $table) {
            $table->dropForeign(['location_id']);
            $table->dropForeign(['book_id']);
    
            $table->foreign('location_id')
                  ->references('id')
                  ->on('locations');
    
            $table->foreign('book_id')
                  ->references('id')
                  ->on('books');
        });

    }
}
