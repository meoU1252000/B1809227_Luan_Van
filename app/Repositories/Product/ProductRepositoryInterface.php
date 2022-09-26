<?php

namespace App\Repositories\Product;

use App\Repositories\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    //ví dụ: lấy 5 sản phầm đầu tiên
    public function getProducts();
    public function getProduct($id);
    public function getCategoryAll();
    public function getFamilyAll();
    public function getStatusProduct($id);
    public function getBrandExceptId($id);
    public function getFamilyExceptId($id);
    public function getAttributesByCategoryId($id);
    public function getAttributesNews($category_id);
    public function addAttributes($product_id, $attributes_id, $attributes_value);
    public function updateAttributes($product_id, $attribute_old, $attribute_new, $attributes_value);
    public function getBrandAll();
    public function getCategoryTree();
    public function getCart();
    public function getAttribute($id);
    public function getImport($id);
    public function getImportAll();
    public function getImportDetailAll();
    public function getImportPrice($attributes);
}
