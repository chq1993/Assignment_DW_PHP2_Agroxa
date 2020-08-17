@extends('layouts.admin')
@section('content_layout')

<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4>
                        <span>Quản lý người dùng</span>
                        <i class="fas fa-caret-down ml-1"></i>
                    </h4>
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

                            <h5>
                                <span>Bảng danh sách người dùng</span>
                                <i class="fas fa-list-alt ml-2"></i>
                            </h5>
                            <p class="text-muted m-b-30"></p>
                            <section class="d-flex justify-content-between">
                                <form role="table-search" class="table-search rounded w-25 py-3">
                                    <div class="form-group mb-0">
                                        <input type="text" name="fullnameUser" class="form-control"
                                            placeholder="Tìm tên...">
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
                                                <td>STT</td>
                                                <td>Tên đăng nhập</td>

                                                <td>
                                                    {{-- Họ và tên --}}
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span>Họ và tên</span>

                                                        {{-- search-fullname --}}
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn btn-sm shadow-none bg-transparent"
                                                                id="isearch-fullnameUser" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"
                                                                data-offset="-120,15">
                                                                <i class="fas fa-search text-white"></i>
                                                            </button>

                                                            <div class="dropdown-menu shadow"
                                                                aria-labelledby="isearch-fullnameUser">
                                                                <div class="p-2">

                                                                    <form role="search-fullnameUser"
                                                                        class="table-search rounded">
                                                                        <div class="form-group mb-0">
                                                                            <input style="height: 34px"
                                                                                id="search-fullnameUser" type="text"
                                                                                class="form-control" name="fullnameUser"
                                                                                placeholder="Tìm tên">
                                                                        </div>
                                                                        <div
                                                                            class="mt-2 d-flex justify-content-between align-items-center">
                                                                            <button type="submit"
                                                                                class="btn btn-sm btn-primary mr-1 shadow-sm">
                                                                                <i class="fas fa-search text-white"></i>
                                                                                <span>tìm kiếm</span>
                                                                            </button>
                                                                            <button type="reset"
                                                                                class="btn btn-sm w-50 ml-1 shadow-sm btn-hover">xóa</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </td>
                                                <td>Ngày sinh</td>
                                                <td>Địa chỉ</td>
                                                <td>Email</td>
                                                <td>Số điện thoại</td>
                                                <td>Trạng thái</td>
                                                <td>Loại người dùng</td>
                                                <td>Thời gian tạo</td>
                                                <td>Thời gian sửa</td>
                                                <td colspan=2>Hành động</td>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @php
                                            $stt = 0;
                                            @endphp
                                            @foreach($user as $item)
                                            @php
                                            $stt++;
                                            @endphp
                                            <tr>
                                                <td>{{ $stt }}</td>
                                                <td>{{ $item->username }}</td>
                                                <td>{{ $item->fullname }}</td>
                                                <td>{{ $item->birthday }}</td>
                                                <td> {{ $item->address }}</td>
                                                <td> {{ $item->email }}</td>
                                                <td> {{ $item->phone }}</td>

                                                <td id="td{{ $item->id }}">
                                                    @if ($item->status === 1)
                                                    <a onclick="changeStatus({{ $item->id }})" class="fa fa-thumbs-up"
                                                        style="color: green; font-size: 24px;" />
                                                    @else
                                                    <a onclick="changeStatus({{ $item->id }}) "
                                                        class="fa fa-thumbs-down"
                                                        style="color: red; font-size: 24px;" />
                                                    @endif
                                                </td>
                                                <td> @if ($item->user_type === 1)
                                                    User
                                                    @else
                                                    Admin
                                                    @endif
                                                </td>
                                                <td> {{ $item->created_at }}</td>
                                                <td> {{ $item->updated_at }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('user.edit', $item -> id) }}"
                                                            class="btn btn-outline-primary waves-effect waves-light"><i
                                                                class="far fa-edit"></i></a>
                                                        <form action="{{ route('user.destroy', $item->id) }}"
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

                            <div class="d-flex justify-content-center mt-4">
                                {{$user -> links()}}
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
