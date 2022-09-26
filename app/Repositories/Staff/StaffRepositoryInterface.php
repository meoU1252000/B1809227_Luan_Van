<?php

namespace App\Repositories\Staff;
use App\Repositories\RepositoryInterface;
interface StaffRepositoryInterface extends RepositoryInterface
{
    public function getAll();
    public function getStatusStaff($id);
}
