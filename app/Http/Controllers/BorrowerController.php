<?php

namespace App\Http\Controllers;

use App\Services\BorrowerServices;
use Illuminate\Http\Request;

class BorrowerController extends Controller
{
    private BorrowerServices $borrowerService;

    /**
     * @param BorrowerServices $borrowerService
     */
    public function __construct(BorrowerServices $borrowerService)
    {
        $this->borrowerService = $borrowerService;
    }

    public function borrowers(){
        $borrowers = $this->borrowerService->getAll();

        return view('borrowers', ['borrowers'=>$borrowers]);
    }
}
