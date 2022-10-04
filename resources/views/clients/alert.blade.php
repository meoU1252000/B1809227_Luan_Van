@if ($errors->any())
    <div class="alert alert-danger">
        <ul style="list-style:none;color:red;text-align:center;margin-right:10px">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Thong bao dang nhap that bai --}}
@if(Illuminate\Support\Facades\Session::has('error'))
    <div class="alert alert-danger" style="list-style:none;color:red;text-align:center;margin-right:10px">
        {{Session::get('error')}}
    </div>
@endif

{{-- Thong bao dang nhap thanh cong --}}

@if(Illuminate\Support\Facades\Session::has('success'))
    <div class="alert alert-success" >
        {{Session::get('success')}}
    </div>
@endif