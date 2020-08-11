@extends('layouts.admin')
@section('content_layout')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4>
                <span>Quản lý đánh giá</span>
                <i class="fas fa-caret-down ml-1"></i>
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('answer-manage.index') }}">Danh sách</a></li>
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
                        <span>Thêm mới đánh giá</span>
                        <i class="fas fa-pen-square ml-1"></i>
                    </h5>
                    <p class="text-muted m-b-30 ">Vui lòng nhập đầy đủ thông tin để có thể tạo mới đánh giá!</p>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('answer-manage.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="label">Loại đánh giá</label>
                                <div>
                                    <input type="text" name="label" id="label" class="form-control" required
                                        placeholder="vd: Trung bình" />
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="value_answer">Điểm số</label>
                                <select class="custom-select mr-sm-2" name="value_answer" id="value_answer">
                                    <option value="1" selected>1 điểm</option>
                                    <option value="2">2 điểm</option>
                                    <option value="3">3 điểm</option>
                                    <option value="4">4 điểm</option>
                                    <option value="5">5 điểm</option>
                                </select>
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
