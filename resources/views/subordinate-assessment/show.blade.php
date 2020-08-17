@extends('layouts.admin')
@section('content_layout')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4><span>Quản lý đánh giá</span>
                <i class="fas fa-caret-down ml-1"></i></h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard">Trang chủ</a></li>
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
                        <span>Bảng chi tiết đánh giá cấp dưới</span>
                        <i class="fas fa-list-alt ml-2"></i>
                    </h5>

                    <p class="text-muted m-b-30"></p>

                    <section class="d-flex justify-content-between">
                        <form role="table-search" class="table-search rounded w-25 py-3">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" placeholder="Tìm kiếm...">
                            </div>
                        </form>

                    </section>

                    {{-- @if (session()->get('create-success'))
                    @include('sweetalert::alert')
                    @endif
                    @if (session()->get('update-success'))
                    @include('sweetalert::alert')
                    @endif

                    @if (session()->get('delete-success'))
                    @include('sweetalert::alert')
                    @endif --}}

                    <div class="table-rep-plugin">
                        <div class="table-responsive b-0" data-pattern="priority-columns">
                            <table id="tech-companies-1" class="table table-bordered table-striped">
                                <thead>
                                    <tr style="background-color: #35a989" class="shadow-sm text-white">
                                        <td>ID</td>
                                        <td>Người đánh giá</td>
                                        <td>Người được đánh giá</td>
                                        <td>Mẫu phiếu</td>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>

                    <div class="d-flex justify-content-center mt-4">

                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
@endsection
