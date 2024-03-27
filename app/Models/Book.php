<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
//    use HasFactory;

    protected $table = 'books';

    protected $fillable = ["title","stock"];

    function borrowedBook()
    {
        return $this->belongsToMany(Borrower::class, "borrowers_borrower_books","book_id", "borrower_id")
            ->withPivot('id','jumlah_pinjaman', 'jumlah_kembali','created_at','updated_at');
    }
}
