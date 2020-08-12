@extends('layouts.admin')
@section('content_layout')

<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Bảng danh sách Vai trò người dùng</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
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

                            <h4 class="mt-0 header-title">Bảng thông tin vai trò người dùng</h4>
                            <p class="text-muted m-b-30"></p>
                            <section class="d-flex justify-content-between">
                                <form role="table-search" class="table-search rounded w-25 py-3">
                                    <div class="form-group mb-0">
                                        <input type="text" class="form-control" placeholder="Tìm kiếm...">
                                    </div>
                                </form>
                                <a href="{{route('role-manage.create')}}" style="margin: 19px;"
                                    class="btn btn-primary waves-effect waves-light mx-0"><span>Phân quyền người
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
                                                <th data-priority="1">Chức vụ</th>
                                                <th data-priority="1">Đơn vị</th>
                                                <th data-priority="1" style="white-space: nowrap;">Phần trăm</th>
                                                <th data-priority="1">Ngày bắt đầu vai trò</th>
                                                <th data-priority="1">Ngày kết thúc vai trò</th>
                                                <th data-priority="1">Thời gian tạo</th>
                                                <th data-priority="1">Thời gian sửa</th>
                                                <th data-priority="6" colspan="2">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @php
                                            $stt = 0;
                                            @endphp
                                            @foreach($role as $item)
                                            @php
                                            $stt++;
                                            @endphp
                                            <tr>
                                                <td>{{ $stt }}</td>
                                                <td>{{ $item->username}}</td>
                                                <td>{{ $item->fullname}}</td>
                                                <td>{{ $item->name_position}}</td>
                                                <td>{{ $item->name_division}}</td>
                                                <td>{{ $item->percentageOfRole }} %</td>
                                                <td> {{ $item->start_time }}</td>
                                                <td> {{ $item->end_time }}</td>
                                                <td> {{ $item->updated_at }}</td>
                                                <td> {{ $item->created_at }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('role-manage.edit', $item -> id) }}"
                                                            class="btn btn-outline-primary waves-effect waves-light"><i
                                                                class="far fa-edit"></i></a></a>
                                                        <form action="{{ route('role-manage.destroy', $item->id) }}"
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

@endsection
