<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Models\ProductComment;
use App\Models\Product;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(CommentRepositoryInterface $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }
    public function index()
    {
        //
        $comments = $this->commentRepo->getAll();
        $comments = $comments->sortByDesc('id');
        return view('Admin.dist.creative.comment.index',[
            'title'=>'Trang Quản Lý Bình Luận'
        ],compact('comments'));
    }

    public function replyView($id){
        $comment = $this->commentRepo->find($id);
        // $roles = Role::all();
        return view('Admin.dist.creative.comment.reply', compact('comment'))->render();
    }

    public function replyComment($id,Request $request){
        $data = $request->all();
        $commentParent = $this->commentRepo->find($id);
        $product = Product::find($commentParent->product_id);
        $data['comment_parent'] = $id;
        $data['product_id'] = $product->id;
        $data['staff_id'] = auth()->user()->id;
        $reply = $this->commentRepo->create($data);
        return redirect()->route('comment.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->commentRepo->delete($id);
        return redirect()->route('comment.index');
    }
}
