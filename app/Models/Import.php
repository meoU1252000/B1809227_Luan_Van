<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    use HasFactory;
    protected $table = 'import';
    protected $primaryKey = 'id';
    protected $fillable = [
        'supplier_id',
        'staff_id',
    ];

    public function get_supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }

    public function get_staff(){
        return $this->belongsTo(Staff::class,'staff_id','id');
    }

    public function get_import_details(){
        return $this->hasMany(ImportDetail::class,'import_id','id');
    }

    
}
