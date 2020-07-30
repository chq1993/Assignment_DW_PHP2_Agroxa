@extends('layouts.admin')
@section('content_layout')
<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <h4>
        <span>Quản lý mẫu phiếu</span>
        <i class="fas fa-caret-down ml-1"></i>
      </h4>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('form-manage.index') }}">Danh sách</a></li>
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
            <span>Chỉnh sửa mẫu phiếu</span>
            <i class="fas fa-edit"></i>
          </h5>
          <p class="text-muted m-b-30 ">Vui lòng chỉnh sửa thông tin mẫu phiếu bên dưới!</p>

          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <form action="{{ route('form-manage.update', $form->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
              <label for="name_form">Tên phiếu</label>
              <input type="text" class="form-control" name="name_form" id="name_form" value="{{$form->name_form}}"
                required placeholder="Nhập tên phiếu" />
            </div>

            <div class="form-group">
              <label for="description_form">Miêu tả thêm</label>
              <div>
                <input type="text" name="description_form" id="description_form" class="form-control"
                  value="{{$form->description_form}}" required placeholder="Nhập thông tin thêm" />
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