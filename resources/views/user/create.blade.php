@extends('layouts.admin')
@section('content_layout')

<script>
    function validateForm() {
    var txtUserName, txtFullName, dateBirthday, txtAddress, txtEmail, txtPhone, txtPassword;
    txtUserName = document.getElementById("txtUserName").value;
    txtFullName = document.getElementById("txtFullName").value;
    dateBirthday = document.getElementById("dateBirthday").value;
    txtAddress = document.getElementById("txtAddress").value;
    txtEmail = document.getElementById("txtEmail").value;
    txtPhone = document.getElementById("txtPhone").value;
    txtPassword = document.getElementById("txtPassword").value;
    var today = new Date();
    var emailValidator = "/^\w+([\.-]?\w+)+@\w+([\.:]?\w+)+(\.[a-zA-Z0-9]{2,3})+$/";
    alert(5 + 6);
    //lengthMaBanDoc = txtMaBanDoc.length;


    if (txtUserName === null || txtUserName === "") {
      alert("Tên đăng nhập không được để trống!");
      document.getElementById('txtUserName').focus();
      return false;
    } else if (txtFullName === null || txtFullName === "") {
      alert("Tên người dùng không được để trống!");
      document.getElementById('txtFullName').focus();
      return false;
    } else if (dateBirthday === null || dateBirthday === "") {
      alert("Ngày sinh không được để trống!");
      document.getElementById('dateBirthday').focus();
      return false;
    } else if (dateBirthday > today) {
      alert("Ngày sinh không được lớn hơn ngày hiện tại hoặc quá nhỏ!");
      document.getElementById('dateBirthday').focus();
      return false;
    } else if (txtAddress === null || txtAddress === "") {
      alert("Địa chỉ không được để trống!");
      document.getElementById('txtAddress').focus();
      return false;
    } else if (txtEmail === null || txtEmail === "") {
      alert("Địa chỉ email không được để trống!");
      document.getElementById('txtEmail').focus();
      return false;
    } else if (!txtEmail.match(emailValidator)) {
      alert("Email không hợp lệ!");
      document.getElementById('txtEmail').focus();
      return false;
    } else if (txtPhone === null || txtPhone === "") {
      alert("Số điện thoại không được để trống!");
      document.getElementById('txtPhone').focus();
      return false;
    } else if (txtPassword === null || txtPassword === "") {
      alert("Mật khẩu không được để trống!");
      document.getElementById('txtPassword').focus();
      return false;
    } else {
      return true;
    }
    document.getElementById("text").innerHTML = text;
  }
</script>

<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Thêm mới người dùng</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Danh sách</a></li>
                        <li class="breadcrumb-item active">Thêm mới</li>
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
                            <p class="text-muted m-b-30 ">Vui lòng nhập đầy đủ thông tin để có thể tạo mới người dùng!
                            </p>

                            @if (session()->get('create-success'))
                            @include('sweetalert::alert')
                            @endif
                            @if (session()->get('update-success'))
                            @include('sweetalert::alert')
                            @endif
                            @if (session()->get('delete-success'))
                            @include('sweetalert::alert')
                            @endif

                            <form class="" action="{{ route('user.store') }}" onsubmit="return(validateForm());"
                                method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Họ và tên</label>
                                        <input type="text" class="form-control" name="txtFullName" id="txtFullName"
                                            required placeholder="Nhập họ và tên" />
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Ngày sinh</label>
                                        <input type="date" class="form-control" name="dateBirthday" id="dateBirthday"
                                            required placeholder="Nhập ngày sinh" />
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4"><label>Tên đăng nhập</label>
                                        <input type="text" class="form-control" name="txtUserName" id="txtUserName"
                                            required placeholder="Nhập tên đăng nhập" /></div>
                                    <div class="form-group col-md-4"><label>Mật khẩu</label>
                                        <div>
                                            <input type="password" id="pass2" name="txtPassword" id="txtPassword"
                                                class="form-control" required placeholder="Mật khẩu" />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4"><label for="slbUserType">Loại người dùng</label>
                                        <select name="slbUserType" id="slbUserType" class="form-control" required>
                                            <option value="">--- Chọn quyền ---</option>
                                            <option value="1">User</option>
                                            <option value="2">Admin</option>
                                        </select></div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6"><label>E-Mail</label>
                                        <div>
                                            <input type="email" class="form-control" required name="txtEmail"
                                                id="txtEmail" parsley-type="email" placeholder="Nhập địa chỉ email" />
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6"><label>Số điện thoại</label>
                                        <div>
                                            <input data-parsley-type="number" type="text" name="txtPhone" id="txtPhone"
                                                class="form-control" required placeholder="Nhập số điện thoại" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" class="form-control" name="txtAddress" id="txtAddress" required
                                        placeholder="Nhập địa chỉ" />
                                </div>

                                <div class="form-group">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light"
                                            style="margin-top: 15px;">Thêm mới</button>
                                        <button type="reset" class="btn btn-secondary waves-effect m-l-5"
                                            style="margin-top: 15px;">
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
