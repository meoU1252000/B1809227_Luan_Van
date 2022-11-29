<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Trả Lời Bình Luận</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="{{ route('comment.replyComment', $comment->id) }}" method="POST">
            @csrf
            <div class="modal-body">
                  <textarea name="comment_content" id="comment-content" min="3" maxlength="255" cols="50" rows="5" class="p-2" placeholder="Tối đa 255 ký tự ..."></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
    </div>
</div>
