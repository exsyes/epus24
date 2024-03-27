<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use App\Services\BookServices;
use App\Services\BorrowerServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    private BookServices $bookServices;
    /**
     * @param BookServices $bookServices
     */
    public function __construct(BookServices $bookServices,
                                BorrowerServices $borrowerServices)
    {
        $this->bookServices = $bookServices;
    }

    public function books():Response
    {
        $collection = $this->bookServices->getAll();

        return response()->view('books', ['books'=>$collection]);
    }



    public function createBook(Request $request):RedirectResponse
    {
        $title = $request->input("title");
        $stock = (int)$request->input("stock");
        $result = $this->bookServices->storeBook($title, $stock);

        return redirect("/books")->with("success", "Data berhasil ditambahkan");
    }


    public function removeBook(Request $request,int $id):RedirectResponse
    {
        $result = $this->bookServices->deleteBook($id);

        if ($result){
            return redirect("/books")->with("success", "Data buku berhasil dihapus");
        }

        return redirect("/books")->with("error", "Data gagal dihapus, periksa data peminjam yang masih ada");
    }

}
