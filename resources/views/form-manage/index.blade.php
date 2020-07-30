@extends('layouts.admin')
@section('content_layout')
<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <h4><span>Quản lý phiếu</span>
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
            <span> Bảng danh sách phiếu</span>
            <i class="fas fa-list-alt ml-2"></i>
          </h5>
          @if (session()->get('success'))
          <div class="alert alert-success">
            {{session()->get('success')}}
          </div>
          @endif
          <p class="text-muted m-b-30"></p>
          <section class="d-flex justify-content-between">
            <form role="table-search" class="table-search rounded w-25 py-3">
              <div class="form-group mb-0">
                <input type="text" class="form-control" placeholder="Tìm kiếm...">
              </div>
            </form>
            <a href="{{ route('form-manage.create') }}" style="margin: 19px;" class="btn btn-primary">
              <span>Thêm mới phiếu</span>
              <i class="far fa-question-circle ml-1"></i></a>
          </section>
          @if(session()->get('message'))
          <div class="alert alert-info">
            {{ session()->get('message') }}
          </div>
          @endif
          <div class="table-rep-plugin">
            <div class="table-responsive b-0" data-pattern="priority-columns">
              <table id="tech-companies-1" class="table table-striped">
                <thead>
                  <tr style="background-color: #35a989" class="shadow-sm text-white">
                    <td>ID</td>
                    <td>Tên phiếu</td>
                    <td>Miêu tả thêm</td>
                    <td colspan=2>Hành động</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($forms as $form)
                  <tr>
                    <td>{{$form->id}}</td>
                    <td>{{$form->name_form}}</td>
                    <td>{{$form->description_form}}</td>
                    <td>
                      <div class="d-flex">
                        <a href="{{ route('form-manage.edit', ['form_manage' => $form->id]) }}"
                          class="btn btn-primary mr-2"><i class="far fa-edit"></i></a>
                        <form action="{{ route('form-manage.destroy', $form->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-danger" type="submit"><i class="far fa-trash-alt"></i></button>
                        </form>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

          </div>

          <div class="d-flex justify-content-center mt-4">
            {{$forms -> links()}}
          </div>

        </div>
      </div>
    </div> <!-- end col -->
  </div> <!-- end row -->
</div>
@endsection