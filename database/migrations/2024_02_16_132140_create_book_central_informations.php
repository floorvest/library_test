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
        Schema::create('book_central_informations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('book_id');
            $table->date('borrow_date');
            $table->date('expected_return_date');

            $table->string('borrower_name');
            $table->string('borrower_id');
            $table->string('borrower_phone');
            $table->string('borrower_email');

            $table->datetime('return_date')->nullable();
            $table->text('additional_info')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_central_informations');
    }
};
