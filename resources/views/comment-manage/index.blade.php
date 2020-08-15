@extends('layouts.admin')
@section('content_layout')

<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <h4><span>Quản lý phản hồi</span>
        <i class="fas fa-caret-down ml-1"></i></h4>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
        <li class="breadcrumb-item active">Danh sách</li>
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
            <span>Bảng danh sách phản hồi</span>
            <i class="fas fa-list-alt ml-2"></i>
          </h5>

          <p class="text-muted m-b-30"></p>

          <section class="d-flex justify-content-between">
            <form role="table-search" class="table-search rounded w-25 py-3">
              <div class="form-group mb-0">
                <input type="text" class="form-control" placeholder="Tìm kiếm...">
              </div>
            </form>
            <a href="{{ route('comment-manage.create') }}" style="margin: 19px;" class="btn btn-primary waves-effect waves-light">
              <span>Thêm mới phản hồi</span>
              <i class="far fa-question-circle ml-1"></i></a>
          </section>


          <div class="table-rep-plugin">
            <div class="table-responsive b-0" data-pattern="priority-columns">
              <table id="tech-companies-1" class="table table-bordered table-striped">
                <thead>
                  <tr style="background-color: #35a989" class="shadow-sm text-white">
                    <td>ID</td>
                    <td>Tiêu đề phản hồi</td>
                    <td>Nội dung phản hồi</td>
                    <td>Hành động</td>
                  </tr>
                  @foreach($comments as $key => $comment)
                  <tr>
                    <td> {{ $comment ->id }} </td>
                    <td> {{ $comment->label_comment }} </td>
                    <td> {{ $comment->content_comment }} </td>
                    <td>
                      <form action="{{ route('comment-manage.destroy', $comment->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('comment-manage.show', $comment->id) }}">Show</a>
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Bạn có chắc muốn xóa?')" class="btn btn-outline-danger waves-effect waves-light" type="submit"><i class="far fa-trash-alt"></i></button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
              </table>






            </div>
          </div>
        </div> <!-- end col -->
      </div> <!-- end row -->
    </div>

    @endsection