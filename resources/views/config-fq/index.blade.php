@extends('layouts.admin')
@section('content_layout')
<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <h4><span>Cấu hình</span>
        <i class="fas fa-caret-down ml-1"></i></h4>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
        <li class="breadcrumb-item active">Mẫu phiếu</li>
      </ol>
    </div>
  </div>
</div>

<div class="page-content-wrapper">
  <div class="row">
    <div class="col-12">

      <div class="card m-b-20">
        <div class="card-body">

          <h5>
            <span>Mẫu phiếu</span>
            <i class="fas fa-cogs ml-2"></i>
          </h5>

          <p class="text-muted m-b-30"></p>

          <section class="d-flex justify-content-between">
            <div class="form-group">
              <label for="mauPhieu">Tên mẫu phiếu</label>
              <select class="form-control" id="mauPhieu">
                <option selected>Đánh giá đồng cấp</option>
                <option>Đánh giá cấp trên</option>
                <option>Đánh giá cấp dưới</option>
              </select>
            </div>
            {{-- <form role="table-search" class="table-search rounded w-25 py-3">
              <div class="form-group mb-0">
                <input type="text" class="form-control" placeholder="Tìm kiếm...">
              </div>
            </form> --}}
            {{-- <a href="{{ route('form-manage.create') }}" style="margin: 19px;" class="btn btn-primary">
            <span>Thêm mới phiếu</span>
            <i class="far fa-question-circle ml-1"></i></a> --}}
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



          <div class="d-flex justify-content-center mt-4">
            {{-- {{$forms -> links()}} --}}
          </div>

        </div>
      </div>
    </div> <!-- end col -->
  </div> <!-- end row -->
</div>
@endsection