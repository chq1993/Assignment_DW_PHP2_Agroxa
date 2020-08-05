@extends('layouts.admin')
@section('content_layout')

<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <h4>
        <span>Quản lý đơn vị</span>
        <i class="fas fa-caret-down ml-1"></i>
      </h4>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('division-manage.index') }}">Danh sách</a></li>
        <li class="breadcrumb-item active">Thêm mới</li>
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
            <span>Thêm mới đơn vị</span>
            <i class="fas fa-pen-square ml-1"></i>
          </h5>
          <p class="text-muted m-b-30 ">Vui lòng nhập đầy đủ thông tin để có thể tạo mới đơn vị!</p>

          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <form action="{{ route('division-manage.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="name_division">Tên đơn vị</label>
              <input type="text" class="form-control" name="name_division" id="name_division" required
                placeholder="Nhập tên đơn vị" />
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label class="mr-sm-2" for="kind_division">Loại đơn vị</label>
                <input type="text" class="form-control" name="kind_division" id="kind_division" required
                  placeholder="Nhập loại đơn vị" />
              </div>

              <div class="form-group col-md-6">
                <label for="division_level">Cấp đơn vị</label>
                <input type="number" class="form-control" name="division_level" id="division_level" required
                  placeholder="Nhập cấp đơn vị" />
              </div>

            </div>

            <div class="form-group">
              <label for="description_division">Miêu tả thêm</label>
              <div>
                <textarea rows="3" type="text" name="description_division" id="description_division"
                  class="form-control" required placeholder="Nhập thông tin thêm"></textarea>
              </div>
            </div>


            <div class="form-group">
              <div>
                <button type="submit" class="btn btn-primary waves-effect waves-light">
                  Thêm mới
                </button>
                <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                  Xóa thông tin
                </button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div> <!-- end col -->


  </div> <!-- end row -->
</div>
@endsection