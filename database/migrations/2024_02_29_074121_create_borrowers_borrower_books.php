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
        Schema::create('borrowers_borrower_books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("borrower_id");
            $table->unsignedBigInteger("book_id");
//            $table->primary(["borrower_id","book_id"]);
            $table->integer("jumlah_pinjaman")->nullable(false);
            $table->integer("jumlah_kembali")->nullable(false)->default(0);
            $table->foreign("borrower_id")->on("borrowers")->references("id");
            $table->foreign("book_id")->on("books")->references("id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowers_borrower_books');
    }
};
