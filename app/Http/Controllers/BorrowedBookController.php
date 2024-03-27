<?php

namespace App\Http\Controllers;

use App\Services\BookServices;
use App\Services\BorrowerServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BorrowedBookController extends Controller
{
    private BookServices $bookServices;
    private BorrowerServices $borrowerServices;

    /**
     * @param BookServices $bookServices
     * @param BorrowerServices $borrowerServices
     */
    public function __construct(BookServices $bookServices,
                                BorrowerServices $borrowerServices)
    {
        $this->bookServices = $bookServices;
        $this->borrowerServices = $borrowerServices;
    }

    public function borrowedBooks():Response
    {
        $collection = $this->bookServices->getBorrowersBook();
        $books = $this->bookServices->findAll();
        $borrowers = $this->borrowerServices->getAll();
        return \response()->view('dashboard',
            [
                'borrowedBook' => $collection,
                'books'=>$books,
                'borrowers'=>$borrowers
            ]
        );
    }

    public function storeBorrowedBooks(Request $request):RedirectResponse
    {
        $bookId = $request->input('book_id');
        $borrowerId = $request->input('borrower_id');
        $total = $request->input('total');
        $borrowed = $this->bookServices->storeBorrowed($bookId, $borrowerId, $total);
        if (!$borrowed){
            return redirect("/borrowed-books")->with("error", "Data gagal di proses, stock tidak cukup");
        }
        return redirect("/borrowed-books")->with("success", "Data berhasil ditambahkan");
    }

    public function updateBorrowedBooks(Request $request, int $id):RedirectResponse
    {
        $bookId = $request->input("book_id");
        $jmlKembali = $request->input("jumlah_kembali");

        $book = $this->bookServices->findBorrowedBooks($id);

        if ($book->jumlah_pinjaman < $jmlKembali){
            return redirect("/borrowed-books")->with("error", "Jumlah tidak sesuai");
        }

        $result = $this->bookServices->returnBook($id, $bookId, $jmlKembali);
        if (!$result){
            return redirect("/borrowed-books")->with("error", "Data gagal di Update");
        }

        return redirect("/borrowed-books")->with("success", "Data berhasil di update");
    }

    public function delete(Request $request, int $id):RedirectResponse
    {

        $result = $this->bookServices->deleteBorrowed($id);
        if($result){
            return redirect("/borrowed-books")->with("success", "Data berhasil di hapus");
        }
    }
}
