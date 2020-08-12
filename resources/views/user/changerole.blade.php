@extends('layouts.user')
@section('content_layout')


<div class="content">
  <div class="container-fluid">

    <div class="row">
      <div class="col-sm-12">
        <div class="page-title-box">
          <h4 class="page-title">Chọn vai trò để thực hiện đánh giá</h4>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0);">Vai trò</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0);">Danh sách</a></li>
          </ol>
        </div>
      </div>
    </div>
    <!-- end row -->

    <div class="page-content-wrapper">
      <div class="row">
        <div class="col-12">
          <div class="card m-b-20">
            <div class="card-body">
                @if(session()->get('message'))
                <div class="alert alert-info">
                    <strong>{{ session()->get('message') }}</strong>
                </div>
                @endif
                <form name="" action="{{ route('user.changerole') }}" method="POST">
                @csrf
                        <div class="form-group col-md-6 d-none d-sm-block" >
                            <select name="slbIdRole" id="slbIdRole" class="form-control">
                                <option value="">--Chọn vai trò--</option>
                                @foreach($role as $item)
                                <option value="{{ $item->id }}">{{ $item->name_position }} - {{ $item->name_division }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group d-none d-sm-block">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Lưu thông tin
                                </button>
                            </div>
                        </div>
                </form>
            </div>
          </div>
        </div> <!-- end col -->
      </div> <!-- end row -->
    </div>
    <!-- end page content-->

  </div> <!-- container-fluid -->

</div> <!-- content -->
@endsection