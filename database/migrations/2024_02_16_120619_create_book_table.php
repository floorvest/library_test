<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->string('book_id')->unique();
            $table->string('title');
            $table->string('author')->default('Anonymous');
            $table->bigInteger('isbn')->nullable();
            $table->string('genre')->nullable();
            $table->integer('publication_year')->default(1971);
            $table->string('publisher');
            $table->string('edition')->nullable();
            $table->string('language')->nullable();
            $table->string('format')->nullable();
            $table->integer('number_of_pages')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
