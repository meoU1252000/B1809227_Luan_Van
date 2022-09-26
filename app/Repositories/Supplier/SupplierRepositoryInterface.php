<?php

namespace App\Repositories\Supplier;
use App\Repositories\RepositoryInterface;

interface SupplierRepositoryInterface extends RepositoryInterface
{
    public function getAll();
    public function getStatusSupplier($id);
    public function getStatusSupplierExceptStatus($status);
}
