<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrower extends Model
{
    protected $table = 'borrowers';
    function bookBorrowers()
    {
        return $this->belongsToMany(Book::class, "borrowers_borrower_books", "borrower_id", "book_id")
            ->withPivot('jumlah_pinjaman', 'jumlah_kembali');
    }
}
