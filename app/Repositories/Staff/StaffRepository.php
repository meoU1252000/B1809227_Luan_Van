<?php

namespace App\Repositories\Staff;
use App\Repositories\BaseRepository;

class StaffRepository extends BaseRepository implements StaffRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\User::class;
    }

    public function getStatusStaff($id)
    {
        $staff =  $this->model->find($id);
        switch ($staff->status) {
            case (0):
                $status = 'Đã Nghỉ Làm';
                break;
            case (1):
                $status = "Đang Làm Việc";
                break;
            case (2):
                $status = "Tạm Nghỉ";
                break;
        }

        return $status;
    }

    public function getStatusStaffExceptStatus($status)
    {
        // dd($status);
        $arrayStatus = [];
        $i = 0;
        while ($i <= 3) {
            switch (true) {
                case ($i == 0 && $i !== $status):
                    $arrayStatus[$i] =  "Đã Nghỉ Làm";
                    break;
                case ($i == 1 && $i !== $status):
                    $arrayStatus[$i] =  "Đang Làm Việc";
                    break;
                case ($i == 2 && $i !== $status):
                    $arrayStatus[$i] =  "Tạm Nghỉ";
                    break;
            }
            $i++;
        }

        // dd($arrayStatus);
        return $arrayStatus;
    }

}
