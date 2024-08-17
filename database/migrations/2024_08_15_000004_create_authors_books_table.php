<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsBooksTable extends Migration
{
    public function up()
    {
        Schema::create('authors_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            $table->foreignId('author_id')->constrained('authors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('authors_books', function (Blueprint $table) {
            $table->dropForeign(['author_id']);
            $table->dropForeign(['book_id']);
    
            $table->foreign('author_id')
                  ->references('id')
                  ->on('authors');
    
            $table->foreign('book_id')
                  ->references('id')
                  ->on('books');
        });
    }
}
