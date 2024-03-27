<?php

namespace App\Services\Impl;

use App\Models\Borrower;
use App\Services\BorrowerServices;

class BorrowerServiceImpl implements BorrowerServices
{
    public function getAll()
    {
        return Borrower::query()->get();
    }
}
