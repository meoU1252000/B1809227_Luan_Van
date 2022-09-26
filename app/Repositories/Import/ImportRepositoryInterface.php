<?php

namespace App\Repositories\Import;
use App\Repositories\RepositoryInterface;

interface ImportRepositoryInterface extends RepositoryInterface
{
    public function getSupplier();
    public function getStaff();
}
