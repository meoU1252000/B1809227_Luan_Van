<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductComment extends Model
{
    use HasFactory;
    protected $table = 'product_comment';
    protected $primaryKey = 'id';
    protected $fillable = [
        'comment_parent',
        'product_id',
        'customer_id',
        'staff_id',
        'comment_content'
    ];

    public function get_customer(){
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function get_staff(){
        return $this->belongsTo(User::class, 'staff_id', 'id');
    }

    public function get_comment_reply($comment_id){
        $users = User::all(['id']);
        return ProductComment::where('comment_parent', $comment_id)->whereIn('staff_id', $users)->first();
    }
    public function get_staff_reply($comment_id){
        $comment = ProductComment::where('comment_parent', $comment_id)->first();
         return User::find($comment->staff_id);
    }
}
