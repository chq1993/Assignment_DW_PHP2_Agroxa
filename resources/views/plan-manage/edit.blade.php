@extends('layouts.admin')
@section('content_layout')

<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <h4>
        <span>Quản lý kế hoạch</span>
        <i class="fas fa-caret-down ml-1"></i>
      </h4>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plan-manage.index') }}">Danh sách</a></li>
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
            <span>Chỉnh sửa kế hoạch</span>
            <i class="fas fa-pen-square ml-1"></i>
          </h5>
          <p class="text-muted m-b-30 ">Vui lòng nhập đầy đủ thông tin cần chỉnh sửa kế hoạch dưới đây!</p>

          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <form action="{{ route('plan-manage.update', $plan->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
              <label for="name_plan">Tên kế hoạch</label>
              <input type="text" class="form-control" value="{{$plan->name_plan}}" name="name_plan" id="name_plan"
                required placeholder="Nhập tên kế hoạch" />
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label class="mr-sm-2" for="start_date">Thời gian bắt đầu đánh giá</label>
                <input type="date" class="form-control" value="{{$plan->start_date}}" name="start_date" id="start_date"
                  required />
              </div>

              <div class="form-group col-md-6">
                <label for="end_date">Thời gian kết thúc đánh giá</label>
                <input type="date" class="form-control" value="{{$plan->end_date}}" name="end_date" id="end_date"
                  required />
              </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label class="mr-sm-2" for="begin_rate">Thời gian bắt đầu thực hiện đánh giá</label>
                <input type="date" class="form-control" value="{{$plan->begin_rate}}" name="begin_rate" id="begin_rate"
                  required />
              </div>

              <div class="form-group col-md-6">
                <label for="finish_rate">Thời gian kết thúc thực hiện đánh giá</label>
                <input type="date" class="form-control" value="{{$plan->finish_rate}}" name="finish_rate" id="finish_rate"
                  required />
              </div>
            </div>

            <div class="form-group">
              <label for="description_plan">Miêu tả thêm</label>
              <div>
                <textarea rows="3" type="text" name="description_plan" id="description_plan" class="form-control"
                  required placeholder="Nhập thông tin thêm"></textarea>
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