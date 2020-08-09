@extends('layouts.admin')
@section('content_layout')

<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">Bảng danh sách Vai trò người dùng</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Vai trò</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Danh sách</a></li>
            <li class="breadcrumb-item active">Table</li>
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
                        <a href="{{route('role-manage.create')}}" style="margin-bottom: 5px;" class="btn btn-danger">Thêm mới</a>
                                @if(session()->get('message'))
                                <div class="alert alert-info">
                                    {{ session()->get('message') }}
                                </div>
                                @endif
                            <div class="table-rep-plugin">
                                <div class="table-responsive b-0" data-pattern="priority-columns">
                                    <table id="tech-companies-1" class="table  table-striped">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th data-priority="1">Tên đăng nhập</th>
                                                <th data-priority="1">Họ và tên</th>
                                                <th data-priority="1">Chức vụ</th>
                                                <th data-priority="1">Đơn vị</th>
                                                <th data-priority="1">Phần trăm</th>
                                                <th data-priority="1">Ngày bắt đầu vai trò</th>
                                                <th data-priority="1">Ngày kết thúc vai trò</th>
                                                <th data-priority="1">Thời gian tạo</th>
                                                <th data-priority="1">Thời gian sửa</th>
                                                <th data-priority="1">Sửa</th>
                                                <th data-priority="6">Xóa</th>
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
                                                <td>{{ $item->percentageOfRole }}</td>
                                                <td> {{ $item->start_time }}</td>
                                                <td> {{ $item->end_time }}</td>
                                                <td> {{ $item->updated_at }}</td>
                                                <td> {{ $item->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('role-manage.edit', $item -> id) }}" class="btn btn-primary">Sửa</a>
                                                </td>
                                                <td>
                                                    <form action="{{ route('role-manage.destroy', $item->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger" type="submit" onclick="return confirm('Bạn chắc chắn muốn xóa bản ghi này?')">Xóa</button>
                                                    </form>
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