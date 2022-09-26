<?php

namespace App\Repositories\CategoryAttribute;
use App\Repositories\RepositoryInterface;

interface CategoryAttributeRepositoryInterface extends RepositoryInterface
{
    public function getAll();
    public function getCategory();
}

