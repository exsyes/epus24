<?php

namespace App\Services\Impl;


use App\Models\Book;
use App\Services\BookServices;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Time;

class BookServiceImpl implements BookServices
{
    public function getAll()
    {
        return Book::query()->paginate(5);
    }

    public function findAll()
    {
        return Book::query()->get();
    }

    public function find(int $id)
    {
        return Book::query()->find($id);
    }

    public function decrementStock(int $id, int $stock):bool
    {
        DB::beginTransaction();
        try {
            $book = $this->find($id);
            if (!$book || $book->stock < $stock) {
                DB::rollBack();
                return false;
            }
            $book->stock -= $stock;
            $book->update();
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            return false;
        }
    }

    public function incrementStock(int $id, int $stock):bool
    {
        DB::beginTransaction();
        try {
            $book = $this->find($id);
            if (!$book) {
                DB::rollBack();
                return false;
            }
            $book->stock += $stock;
            $book->update();
            DB::commit();
            return true;
        }catch(\Exception $e){
            DB::rollBack();
            return false;
        }
    }

    public function getBorrowersBook()
    {
       $book =  DB::table('borrowers_borrower_books as bb')
                            ->join('books', 'bb.book_id', '=', 'books.id')
                            ->join('borrowers', 'bb.borrower_id', '=', 'borrowers.id')
                            ->select('bb.id', 'bb.book_id', 'bb.borrower_id', 'bb.jumlah_pinjaman', 'bb.jumlah_kembali', 'bb.created_at', 'bb.updated_at', 'books.title as title', 'borrowers.name as name')
                            ->orderBy('bb.id')
                            ->paginate(5);;
        return $book;
    }

    public function findBorrowedBooks(int $id){
        $book = DB::table("borrowers_borrower_books")
            ->select("id","jumlah_pinjaman", "jumlah_kembali")
            ->where("id", $id)
            ->first();

        return $book;
    }

    public function returnBook(int $id, int $book_id, int $jml_kembali):bool
    {
        DB::beginTransaction();
        try {
            $result = $this->findBorrowedBooks($id);
            if (!$result || ($result->jumlah_pinjaman - $jml_kembali) < 0){
                    DB::rollBack();
                    return false;
            }
            $this->incrementStock($book_id, $jml_kembali);
            $row = DB::table("borrowers_borrower_books")
                ->where("id", $id)
                ->update([
                    'jumlah_pinjaman'=> $result->jumlah_pinjaman - $jml_kembali,
                    'jumlah_kembali'=> $result->jumlah_kembali + $jml_kembali,
                    'updated_at' => Carbon::now()
                ]);
            if ($row > 0){
                DB::commit();
                return true;
            }else{
                DB::rollBack();
                return false;
            }

        }catch (\Exception $exception){
            DB::rollBack();
            return false;
        }

    }


    public function storeBook(string $title, int $stock):void
    {
        $book = new Book([
           "title"=>$title,
           "stock"=>$stock
        ]);

        $book->save();

    }

    public function deleteBook(int $id):bool
    {
        DB::beginTransaction();
        try {
            $result = Book::query()->find($id)->delete();
            if ($result < 0){
                DB::rollBack();
                return false;
            }
            DB::commit();
            return true;
        }catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }



    public function storeBorrowed(int $book_id, int $borrower_id, int $total):bool
    {
        DB::beginTransaction();
        try {
            $result = $this->decrementStock($book_id, $total);
            $this->find($book_id)->borrowedBook()->attach($borrower_id, ["jumlah_pinjaman" => $total]);
            if (!$result){
               throw new \Exception("failed");
            }
            DB::commit();
            return true;
        }catch (\Exception $e){
            DB::rollBack();
            return false;
        }
    }

    public function deleteBorrowed(int $id)
    {
        $result = DB::table("borrowers_borrower_books")
            ->where("id",$id)
            ->delete();
        if($result > 0){
            return true;
        }else{
            return false;
        }
    }


}
