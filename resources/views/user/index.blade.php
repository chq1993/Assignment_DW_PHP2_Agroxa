@extends('layouts.admin')
@section('content_layout')

<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">Bảng danh sách người dùng</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Người dùng</a></li>
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

              <h4 class="mt-0 header-title">Bảng thông tin người dùng</h4>
              <p class="text-muted m-b-30"></p>
              <a href="{{route('user.create')}}" style="margin-bottom: 5px;" class="btn btn-danger">Thêm mới</a>
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
                        <th data-priority="1">Tên người dùng</th>
                        <th data-priority="1">Họ và tên</th>
                        <th data-priority="1">Ngày sinh</th>
                        <th data-priority="1">Địa chỉ</th>
                        <th data-priority="1">Email</th>
                        <th data-priority="1">Số điện thoại</th>
                        <th data-priority="1">Trạng thái</th>
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
                          <a onclick="changeStatus({{ $user->id }})" class="fa fa-thumbs-up" style="color: green; font-size: 24px;" />
                          @else
                          <a onclick="changeStatus({{ $user->id }}) " class="fa fa-thumbs-down" style="color: red; font-size: 24px;" />
                          @endif
                        </td>
                        <td> {{ $user->created_at }}</td>
                        <td> {{ $user->updated_at }}</td>
                        <td>
                          <a href="{{ route('user.edit', $user -> id) }}" class="btn btn-primary">Sửa</a>
                        </td>
                        <td>
                          <form action="{{ route('user.destroy', $user->id) }}" method="post">
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
<script type="text/javascript">
  function changeStatus(user_id) {
    $.ajax({
      url: '{{ route('
      user.changeStatus ') }}',
      method: 'GET',
      data: {
        id: user_id,

      },
      success: function(res) {
        $("#td" + user_id).html(res);
      }
    });
  }
</script>


@endsection