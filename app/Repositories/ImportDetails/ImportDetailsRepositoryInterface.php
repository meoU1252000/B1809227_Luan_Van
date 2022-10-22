<?php

namespace App\Repositories\ImportDetails;
use App\Repositories\RepositoryInterface;
interface ImportDetailsRepositoryInterface extends RepositoryInterface
{
  public function getImport($id);
  public function getProduct();
  public function addImportDetails($attributes = []);
  public function getProductExceptInMonth();
}
