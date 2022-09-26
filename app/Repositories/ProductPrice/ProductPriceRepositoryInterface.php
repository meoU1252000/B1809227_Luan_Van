<?php

namespace App\Repositories\ProductPrice;
use App\Repositories\RepositoryInterface;
interface ProductPriceRepositoryInterface extends RepositoryInterface
{
    public function getProductAll();
    public function getImportAll();
    public function getImport($id);
    public function getProduct($id);
}
