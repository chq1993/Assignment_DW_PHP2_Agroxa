@extends('layouts.admin')
@section('content_layout')

<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Sửa thông tin người dùng</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Danh sách</a></li>
                        <li class="breadcrumb-item active">Chỉnh sửa</li>
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

                            <h4 class="mt-0 header-title">Trang sửa thông tin người dùng</h4>
                            <p class="text-muted m-b-30 ">Vui lòng chỉnh sửa thông tin của người dùng!</p>

                            @if(session()->get('message'))
                            <div class="alert alert-info">
                                <strong>{{ session()->get('message') }}</strong>
                            </div>
                            @endif
                            <div id='divalert'>
                                @isset($message)
                                <div class="alert alert-success">
                                    {{ $message }}
                                </div>
                                @endisset
                            </div>
                            <!--
                                @isset($message)
                                <div class="alert alert-success">
                                    {{ $message }}
                                </div>
                                @endisset-->

                            <form class="" action="{{ route('user.update', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" id="user_id" value="{{ $user->id }}" />

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Họ và tên</label>
                                        <input type="text" class="form-control" name="txtFullName" id="txtFullName"
                                            required placeholder="Nhập họ và tên" value="{{ $user->fullname }}" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Ngày sinh</label>
                                        <input type="date" class="form-control" name="dateBirthday" id="dateBirthday"
                                            required placeholder="Nhập ngày sinh" value="{{ $user->birthday }}" />
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Tên đăng nhập</label>
                                        <input type="text" class="form-control" name="txtUserName"
                                            value="{{ $user->username }}" id="txtUserName" required
                                            placeholder="Nhập tên đăng nhập" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Mật khẩu</label>
                                        <input type="password" id="pass2" name="txtPassword" id="txtPassword"
                                            class="form-control" required placeholder="Mật khẩu" />
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>E-Mail</label>
                                        <input type="email" class="form-control" required name="txtEmail" id="txtEmail"
                                            parsley-type="email" placeholder="Nhập địa chỉ email"
                                            value="{{ $user->email }}" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Số điện thoại</label>
                                        <input data-parsley-type="number" type="text" name="txtPhone" id="txtPhone"
                                            class="form-control" required placeholder="Nhập số điện thoại"
                                            value="{{ $user->phone }}" />
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <label for="slbUserType">Loại người dùng</label>
                                    <select name="slbUserType" id="slbUserType" class="form-control">
                                        <option value="{{ $user->phone }}">User</option>    
                                        <option value="1">User</option>
                                        <option value="2">Admin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" class="form-control" name="txtAddress" id="txtAddress" required
                                        placeholder="Nhập địa chỉ" value="{{ $user->address }}" />
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light"
                                        style="margin-top: 15px;">Thêm mới</button>
                                    <button type="reset" class="btn btn-secondary waves-effect m-l-5"
                                        style="margin-top: 15px;">
                                        Xóa thông tin
                                    </button>
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

<script type="text/javascript">


</script>

@endsection
