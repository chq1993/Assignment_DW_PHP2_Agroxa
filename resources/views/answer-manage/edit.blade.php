@extends('layouts.admin')
@section('content_layout')
<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <h4>
        <span>Quản lý đáp án</span>
        <i class="fas fa-caret-down ml-1"></i>
      </h4>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('answer-manage.index') }}">Danh sách</a></li>
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
            <span>Chỉnh sửa đáp án</span>
            <i class="fas fa-edit"></i>
          </h5>
          <p class="text-muted m-b-30 ">Vui lòng chỉnh sửa thông tin đáp án bên dưới!</p>

          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <form action="{{ route('answer-manage.update', $answer->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-row">

              <div class="form-group col-md-6">
                <label for="value_answer">Tên đáp án</label>
                <select class="custom-select mr-sm-2" name="value_answer" id="value_answer">
                  <option value="1" selected>Rất kém</option>
                  <option value="2">Kém</option>
                  <option value="3">Trung bình</option>
                  <option value="4">Khá</option>
                  <option value="5">Tốt</option>
                </select>
              </div>

              <div class="form-group col-md-6">
                <label for="label">Nhãn đáp án</label>
                <div>
                  <input type="text" name="label" id="label" class="form-control" value="{{$answer->label}}" required
                    placeholder="Nhập nhãn đáp án" />
                </div>
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