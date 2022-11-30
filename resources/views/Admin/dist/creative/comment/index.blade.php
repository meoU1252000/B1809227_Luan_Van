@extends('Admin.dist.creative.main')
@section('content')
    <div class="content-page">
        <div class="content">

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box">
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">UBold</a></li>
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">eCommerce</a></li>
                                    <li class="breadcrumb-item active">Comments</li>
                                </ol>
                            </div>
                            <h4 class="page-title">Trang Quản Lý Bình Luận</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="table">
                                        <table class="table table-centered table-nowrap mb-0" style="table-layout:fixed;"
                                            id="basic-datatable-comment">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 90px;">ID BL</th>
                                                    <th style="width: 90px;">ID NV</th>
                                                    <th style="width: 90px;">ID KH</th>
                                                    <th>Khách Bình Luận</th>
                                                    <th>Trả Lời</th>
                                                    <th style="width: 125px;">Tương Tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($comments as $comment)
                                                    <tr>
                                                        <td><a href=""
                                                                class="text-body fw-bold">{{ $comment->id }}</a>
                                                        </td>
                                                        <td
                                                            style="word-wrap: break-word;
                                                    white-space: normal;">
                                                            @if (isset($comment->get_staff->id))
                                                                {{ $comment->get_staff->id }}
                                                            @endif
                                                        </td>
                                                        <td
                                                            style="word-wrap: break-word;
                                                        white-space: normal;">
                                                            @if (isset($comment->get_customer->id))
                                                                {{ $comment->get_customer->id }}
                                                            @endif
                                                        </td>
                                                        <td style="white-space: inherit;">
                                                            @if (isset($comment->get_customer->id))
                                                                <h5> {{ $comment->get_customer->customer_name }}:</h5>
                                                                {{ $comment->comment_content }}
                                                            @elseif (isset($comment->get_staff->id))
                                                                <h5> {{ $comment->get_staff->name }}:</h5>
                                                                {{ $comment->comment_content }}
                                                            @endif
                                                        </td>
                                                        <td style="word-wrap: break-word;
                                                        white-space: normal;">
                                                            @if (isset($comment->get_comment_reply($comment->id)->comment_content))
                                                                <h5> {{ $comment->get_staff_reply($comment->id)->name }}:
                                                                </h5>
                                                                {{ $comment->get_comment_reply($comment->id)->comment_content }}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div style="display:flex">
                                                                @if(isset($comment->get_comment_reply($comment->id)->comment_content))
                                                                <a href="{{ route('comment.replyView', $comment->id) }}"
                                                                    class="assign_role action-icon" style="pointer-events: none;">
                                                                    <i class="mdi mdi-pencil-outline me-1" ></i></a>
                                                                @else
                                                                <a href="{{ route('comment.replyView', $comment->id) }}"
                                                                    class="assign_role action-icon">
                                                                    <i class="mdi mdi-pencil-outline me-1"></i></a>
                                                                @endif
                                                                <form action="{{ route('comment.delete', $comment->id) }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <button type="submit" class="action-icon"
                                                                        style="background: none!important;border: none;padding: 0!important; text-decoration: underline;cursor: pointer;"><i
                                                                            class="mdi mdi-delete me-1"
                                                                            onclick="deleteData(event);"></i></button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div> <!-- end card-body-->
                        </div> <!-- end card-->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->

            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> &copy; UBold theme by <a href="">Coderthemes</a>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-end footer-links d-none d-sm-block">
                            <a href="javascript:void(0);">About Us</a>
                            <a href="javascript:void(0);">Help</a>
                            <a href="javascript:void(0);">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
        <div class="modal fade" id="view-assign-role" tabindex="-1">

        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#basic-datatable-comment').DataTable({

                order: [
                    [3, 'desc']
                ],
            });
        });
    </script>
@endsection
