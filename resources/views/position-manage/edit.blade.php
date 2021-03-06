@extends('layouts.admin')
@section('content_layout')
<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <h4>
        <span>Quản lý chức vụ</span>
        <i class="fas fa-caret-down ml-1"></i>
      </h4>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('position-manage.index') }}">Danh sách</a></li>
        <li class="breadcrumb-item active">Chỉnh sửa</li>
      </ol>
    </div>
  </div>
</div>

<div class="page-content-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <div class="card m-b-20">
        <div class="card-body">
          <h5>
            <span>Chỉnh sửa chức vụ</span>
            <i class="fas fa-edit"></i>
          </h5>
          <p class="text-muted m-b-30 ">Vui lòng chỉnh sửa thông tin chức vụ bên dưới!</p>

          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <form action="{{ route('position-manage.update', $position->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="name_position">Tên chức vụ</label>
                <input type="text" class="form-control" name="name_position" id="name_position" value="{{$position->name_position}}"
                  required placeholder="Nhập tên phiếu" />
              </div>
              <div class="form-group col-md-6">
                <label for="descrtion_position">Cấp độ của chức vụ</label>
                <div>
                  <input type="number" name="level_position" id="level_position" class="form-control" value="{{ $position->level_position }}" placeholder="Nhập cấp độ của vai trò" required/>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="descrtion_position">Miêu tả thêm</label>
              <div>
                <input type="text" name="descrtion_position" id="descrtion_position" class="form-control"
                  value="{{$position->descrtion_position}}" required placeholder="Nhập thông tin thêm" />
              </div>
            </div>

            <button type="submit" class="btn btn-primary waves-effect waves-light">Lưu</button>
          </form>

        </div>
      </div>
    </div> <!-- end col -->


  </div> <!-- end row -->
</div>
@endsection
