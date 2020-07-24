@extends('layouts.admin')
@section('content_layout')

<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Thêm mới người dùng</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.store') }}">User</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.create') }}">Add user</a></li>
                        <li class="breadcrumb-item active">Form Validation</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="page-content-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card m-b-20">
                        <div class="card-body">

                            <h4 class="mt-0 header-title">Trang thêm mới người dùng</h4>
                            <p class="text-muted m-b-30 ">Vui lòng nhập đầy đủ thông tin để có thể tạo mới người dùng!</p>
                                
                                @if(session()->get('message'))
                                <div class="alert alert-info">
                                <strong>{{ session()->get('message') }}</strong>
                                </div>
                                @endif

                                <!-- 
                                @isset($message)
                                <div class="alert alert-success">
                                    {{ $message }}
                                </div>
                                @endisset-->

                            <form class="" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Tên đăng nhập</label>
                                    <input type="text" class="form-control" name="txtUserName" id="txtUserName" required placeholder="Nhập tên đăng nhập"/>
                                </div>
                                <div class="form-group">
                                    <label>Họ và tên</label>
                                    <input type="text" class="form-control" name="txtFullName" id="txtFullName" required placeholder="Nhập họ và tên"/>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" class="form-control" name="txtAddress" id="txtAddress" required placeholder="Nhập địa chỉ"/>
                                </div>
                                <div class="form-group">
                                    <label>E-Mail</label>
                                    <div>
                                        <input type="email" class="form-control" required name="txtEmail" id="txtEmail"
                                                parsley-type="email" placeholder="Nhập địa chỉ email"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <div>
                                        <input data-parsley-type="number" type="text" name="txtPhone" id="txtPhone"
                                                class="form-control" required
                                                placeholder="Nhập số điện thoại"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Mật khẩu</label>
                                    <div>
                                        <input type="password" id="pass2" name="txtPassword" id="txtPassword" class="form-control" required
                                                placeholder="Mật khẩu"/>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="txtAnhdd">Ảnh đại diện</label>
                                    <input type="file" class="form-control-file" id="txtAnhdd" name="txtAnhdd" placeholder="Ảnh đại diện">
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
        <!-- end page content-->

    </div> <!-- container-fluid -->

</div> <!-- content -->


@endsection