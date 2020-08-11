@extends('layouts.admin')
@section('content_layout')

<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Bảng danh sách người dùng</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Trang chủ</a></li>
                        <li class="breadcrumb-item active">Danh sách</li>

                    </ol>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="page-content-wrapper">
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">

                            <h4 class="mt-0 header-title">Bảng thông tin người dùng</h4>
                            <p class="text-muted m-b-30"></p>
                            <section class="d-flex justify-content-between">
                                <form role="table-search" class="table-search rounded w-25 py-3">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" placeholder="Tìm kiếm...">
                                    </div>
                                </form>
                                <a href="{{route('user.create')}}" style="margin: 19px;"
                                    class="btn btn-primary waves-effect waves-light mx-0"><span>Thêm mới người
                                        dùng</span>
                                    <i class="far fa-question-circle ml-1"></i></a>
                            </section>

                            @if (session()->get('create-success'))
                            @include('sweetalert::alert')
                            @endif
                            @if (session()->get('update-success'))
                            @include('sweetalert::alert')
                            @endif
                            @if (session()->get('delete-success'))
                            @include('sweetalert::alert')
                            @endif

                            <div class="table-rep-plugin">
                                <div class="table-responsive b-0" data-pattern="priority-columns">
                                    <table id="tech-companies-1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr style="background-color: #35a989" class="shadow-sm text-white">
                                                <th>STT</th>
                                                <th data-priority="1">Tên đăng nhập</th>
                                                <th data-priority="1">Họ và tên</th>
                                                <th data-priority="1">Ngày sinh</th>
                                                <th data-priority="1">Địa chỉ</th>
                                                <th data-priority="1">Email</th>
                                                <th data-priority="1">Số điện thoại</th>
                                                <th data-priority="1">Trạng thái</th>
                                                <th data-priority="1">Thời gian tạo</th>
                                                <th data-priority="1">Thời gian sửa</th>
                                                <th data-priority="1" colspan=2>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @php
                                            $stt = 0;
                                            @endphp
                                            @foreach($user as $user)
                                            @php
                                            $stt++;
                                            @endphp
                                            <tr>
                                                <td>{{ $stt }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->fullname }}</td>
                                                <td>{{ $user->birthday }}</td>
                                                <td> {{ $user->address }}</td>
                                                <td> {{ $user->email }}</td>
                                                <td> {{ $user->phone }}</td>

                                                <td id="td{{ $user->id }}">
                                                    @if ($user->status === 1)
                                                    <a onclick="changeStatus({{ $user->id }})" class="fa fa-thumbs-up"
                                                        style="color: green; font-size: 24px;" />
                                                    @else
                                                    <a onclick="changeStatus({{ $user->id }}) "
                                                        class="fa fa-thumbs-down"
                                                        style="color: red; font-size: 24px;" />
                                                    @endif
                                                </td>
                                                <td> {{ $user->created_at }}</td>
                                                <td> {{ $user->updated_at }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('user.edit', $user -> id) }}"
                                                            class="btn btn-outline-primary waves-effect waves-light"><i
                                                                class="far fa-edit"></i></a>
                                                        <form action="{{ route('user.destroy', $user->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                class="btn btn-outline-danger waves-effect waves-light ml-2"
                                                                type="submit"
                                                                onclick="return confirm('Bạn chắc chắn muốn xóa bản ghi này?')"><i
                                                                    class="far fa-trash-alt"></i></button>
                                                        </form>
                                                    </div>

                                                </td>

                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
        <!-- end page content-->

    </div> <!-- container-fluid -->

</div> <!-- content -->
<script type="text/javascript">
    function changeStatus(user_id){
        $.ajax({
            url : '{{ route('user.changeStatus') }}',
            method: 'GET',
            data:{
                id:user_id,

            },
            success:function(res){
                  $("#td"+user_id).html(res);
            }
        });
    }
</script>


@endsection
