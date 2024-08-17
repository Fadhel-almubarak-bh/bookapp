<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesBooksTable extends Migration
{
    public function up()
    {
        Schema::create('categories_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('categories_books', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['book_id']);
    
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories');
    
            $table->foreign('book_id')
                  ->references('id')
                  ->on('books');
        });
    
    }
}
