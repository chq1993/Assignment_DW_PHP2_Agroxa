@extends('layouts.admin')
@section('content_layout')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4><span>Quản lý mẫu phiếu</span>
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
                        <span>Bảng danh sách mẫu phiếu</span>
                        <i class="fas fa-list-alt ml-2"></i>
                    </h5>

                    <p class="text-muted m-b-30"></p>

                    <section class="d-flex justify-content-between">
                        <form role="table-search" class="table-search rounded w-25 py-3">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" placeholder="Tìm kiếm...">
                            </div>
                        </form>
                        <a href="{{ route('form-manage.create') }}" style="margin: 19px;" class="btn btn-primary waves-effect waves-light mx-0">
                            <span>Thêm mới phiếu</span>
                            <i class="far fa-question-circle ml-1"></i></a>
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

                    <div class="table-rep-plugin">
                        <div class="table-responsive b-0" data-pattern="priority-columns">
                            <table id="tech-companies-1" class="table table-bordered table-striped">
                                <thead>
                                    <tr style="background-color: #35a989" class="shadow-sm text-white">
                                        <td>ID</td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span>Tên mẫu phiếu</span>

                                                {{-- tên mẫu phiếu --}}
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm shadow-none bg-transparent"
                                                        id="tenMauPhieu" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false" data-offset="-120,15">
                                                        <i class="fas fa-search text-white"></i>
                                                    </button>

                                                    <div class="dropdown-menu shadow" aria-labelledby="tenMauPhieu">
                                                        <div class="p-2">

                                                            <form role="search-form" class="table-search rounded">
                                                                <div class="form-group mb-0">
                                                                    {{-- value="{{ $_GET["search-question"] ?? ""}}"
                                                                    --}}
                                                                    <input style="height: 34px" id="search-form"
                                                                        type="text" class="form-control"
                                                                        name="search-form" placeholder="Tìm kiếm...">
                                                                </div>
                                                                <div
                                                                    class="mt-2 d-flex justify-content-between align-items-center">
                                                                    <button type="submit"
                                                                        class="btn btn-sm btn-primary mr-1 shadow-sm">
                                                                        <i class="fas fa-search text-white"></i>
                                                                        <span>tìm kiếm</span>
                                                                    </button>
                                                                    <button type="reset"
                                                                        class="btn btn-sm w-50 ml-1 shadow-sm btn-hover"><i
                                                                            class="fas fa-sync-alt"></i></button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
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
                                                    class="btn btn-outline-primary waves-effect waves-light"><i
                                                        class="far fa-edit"></i></a>

                                                <a href="{{ route('config-fq.create', ['config_fq' => $form->id]) }}"
                                                    class="btn btn-outline-success waves-effect waves-light ml-2"><i class="fas fa-cogs"></i></a>
                                                <form action="{{ route('form-manage.destroy', $form->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button onclick="return confirm('Bạn có chắc muốn xóa?')"
                                                        class="btn btn-outline-danger waves-effect waves-light ml-2" type="submit"><i
                                                            class="far fa-trash-alt"></i></button>
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
