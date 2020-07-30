@extends('layouts.admin')
@section('content_layout')
<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <h4>
        <span>Quản lý câu hỏi</span>
        <i class="fas fa-caret-down ml-1"></i>
      </h4>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('question-manage.index') }}">Danh sách</a></li>
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
            <span>Chỉnh sửa câu hỏi</span>
            <i class="fas fa-edit"></i>
          </h5>
          <p class="text-muted m-b-30 ">Vui lòng chỉnh sửa thông tin form bên dưới!</p>

          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <form action="{{ route('question-manage.update', $question->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-group">
              <label for="question">Đặt câu hỏi bạn muốn hỏi</label>
              <input type="text" class="form-control" name="question" id="question" value="{{ $question->question }}"
                required placeholder="Nhập câu hỏi" />
            </div>
            <div class="form-group">
              <label class="mr-sm-2" for="group_question">Nhóm câu hỏi</label>
              <select class="custom-select mr-sm-2" name="group_question" id="group_question">
                <option value="1" selected>Giải quyết vấn đề</option>
                <option value="2">Làm việc nhóm</option>
                <option value="3">Giao tiếp</option>
                <option value="4">Trách nhiệm</option>
                <option value="5">Ra quyết định</option>
                <option value="6">Lãnh đạo</option>
                <option value="7">Lập kế hoạch</option>
              </select>
            </div>
            <div class="form-group">
              <label for="kind_question">Loại câu hỏi</label>
              <input type="text" class="form-control" name="kind_question" id="kind_question" required
                placeholder="Nhập địa chỉ" />
            </div>
            <div class="form-group">
              <label class="mr-sm-2" for="required_question">Câu hỏi bắt buộc</label>
              <select class="custom-select mr-sm-2" name="required_question" id="required_question">
                <option value="1" selected>Bắt buộc</option>
                <option value="0">Không bắt buộc</option>
              </select>
            </div>
            <div class="form-group">
              <label for="description_question">Miêu tả thêm</label>
              <div>
                <input type="text" name="description_question" id="description_question" class="form-control" required
                  placeholder="Nhập thông tin thêm" />
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