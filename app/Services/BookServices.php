<?php

namespace App\Services;


use Illuminate\Http\Request;

interface BookServices
{
    public function getAll();

    public function findAll();
    public function find(int $id);
    public function decrementStock(int $id, int $stock);
    public function incrementStock(int $id, int $stock);
    public function storeBook(string $title, int $stock);
    public function deleteBook(int $id);

//    for borrowed books
    public function getBorrowersBook();
    public function findBorrowedBooks(int $id);
    public function returnBook(int $id, int $book_id, int $jumlah_kembali);
    public function storeBorrowed(int $book_id, int $borrower_id, int $total);

    public function deleteBorrowed(int $id);

}
