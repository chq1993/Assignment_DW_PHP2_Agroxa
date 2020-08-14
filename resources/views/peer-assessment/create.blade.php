@extends('layouts.admin')
@section('content_layout')

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4>
                <span>Đánh giá</span>
                <i class="fas fa-caret-down ml-1"></i>
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                {{-- <li class="breadcrumb-item"><a href="{{ route('division-manage.index') }}">Mẫu đánh giá</a></li>
                --}}
                <li class="breadcrumb-item active">Mẫu đánh giá</li>
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
                        <span>Mẫu phiếu đánh giá đồng cấp</span>
                        <i class="fas fa-pen-square ml-1"></i>
                    </h5>
                    <p class="text-muted m-b-30 ">Vui lòng nhập đầy đủ thông tin.</p>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('peer-assessment.store') }}" method="POST">
                        @csrf


                        <div class="form-group">
                            <label for="value_answer">Đánh giá ai</label>
                            <select class="custom-select mr-sm-2" name="value_answer" id="value_answer">
                                {{-- <option value="1" selected>-- chọn người đánh giá --</option> --}}
                                {{-- @foreach ($other as $item)
                                <option value="{{$userReview->id}}">{{$userReview->fullname}}</option>
                                @endforeach --}}
                            </select>
                        </div>
                        <div>
                            <p>mẫu form đánh giá</p>
                        </div>
                        {{-- <div class="form-row">
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
            </div> --}}

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
