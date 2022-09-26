<?php

namespace App\Repositories\Supplier;
use App\Repositories\BaseRepository;
class SupplierRepository extends BaseRepository implements SupplierRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\Supplier::class;
    }

    public function getStatusSupplier($id)
    {
        $supplier =  $this->model->find($id);
        switch ($supplier->supplier_status) {
            case (0):
                $status = 'Không Nhập Hàng';
                break;
            case (1):
                $status = "Đang nhập hàng";
                break;
            case (2):
                $status = "Tạm Ngưng Nhập Hàng";
                break;
        }

        return $status;
    }

    public function getStatusSupplierExceptStatus($status)
    {
        // dd($status);
        $arrayStatus = [];
        $i = 0;
        while ($i <= 3) {
            switch (true) {
                case ($i == 0 && $i !== $status):
                    $arrayStatus[$i] =  'Không Nhập Hàng';
                    break;
                case ($i == 1 && $i !== $status):
                    $arrayStatus[$i] =  "Đang nhập hàng";
                    break;
                case ($i == 2 && $i !== $status):
                    $arrayStatus[$i] =  "Tạm Ngưng Nhập Hàng";
                    break;
            }
            $i++;
        }

        // dd($arrayStatus);
        return $arrayStatus;
    }


}
