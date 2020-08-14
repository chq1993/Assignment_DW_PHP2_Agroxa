@extends('layouts.admin')
@section('content_layout')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            @php
            $fullname = Auth::user()->fullname;
            $arrName = explode(" ", $fullname);

            $firstName = array_shift($arrName);
            $lastName = array_pop($arrName);
            $middleName = implode(" ", $arrName);
            @endphp
            <h4>
                <span>Chào mừng đã trở lại - {{$lastName}} {{$firstName}}</span>
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item active">Thông tin cá nhân</li>
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
                        <span class="aaa"><strong>Thông tin cá nhân</strong></span>
                        <i class="far fa-address-card ml-1"></i>
                    </h5>

                    <p class="text-muted m-b-30"></p>
                    <div class="row">
                        <div class="col-md-4">
                            <section class="profile-left">
                                <div class="card shadow">
                                    <img class="card-img-top cus-img"
                                        src="https://vtv1.mediacdn.vn/zoom/640_360/2016/phan-xi-pang-1477370209111.png"
                                        alt="Card image cap">
                                    <div class="d-flex justify-content-center avatar-img">
                                        <img class="card-img-top rounded-circle cursor"
                                            src="https://kenh14cdn.com/2016/4-1473151037257.jpg" alt="Card image cap">
                                    </div>

                                    <div style="padding-top: 56px" class="card-body">
                                        <h4 class="text-center">{{$lastName}} {{$firstName}}</h4>
                                        <p style="color: #83848a" class="text-center">Nhà phát triển giao diện người
                                            dùng</p>
                                        <p style="color: #bbb" class="text-center">Một người ghét cô đơn</p>
                                        <div class="d-flex justify-content-center">
                                            <span class="p-2 social-network-custom text-info cursor"><i
                                                    class="fab fa-twitter"></i></span>
                                            <span class="p-2 social-network-custom text-danger cursor"><i
                                                    class="fab fa-google"></i></span>
                                            <span class="p-2 social-network-custom text-success cursor"><i
                                                    class="fab fa-facebook"></i></span>
                                            <span class="p-2 social-network-custom text-danger cursor"><i
                                                    class="fab fa-dribbble"></i></span>
                                        </div>
                                        <button style="padding: .6rem 1rem;" type="button"
                                            class="btn btn-primary waves-effect waves-light w-100 ">Thông tin trang cá
                                            nhân</button>
                                        <div class="row mt-4">
                                            <div class="col-md-4 border-vertical-bricks">
                                                <p class="text-center"><strong>20</strong></p>
                                                <span class="badge badge-info cus-badge">Công việc</span>
                                            </div>
                                            <div class="col-md-4 border-vertical-bricks">
                                                <p class="text-center"><strong>14</strong></p>

                                                <span class="badge badge-success cus-badge">Hoàn thành</span>
                                            </div>
                                            <div class="col-md-4">
                                                <p class="text-center"><strong>6</strong></p>
                                                <span class="badge badge-danger cus-badge">Còn lại</span>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-md-8">
                            <section class="profile-right shadow">
                                <ul class="nav nav-tabs nav-tabs-custom" role="tablist">
                                    <li class="nav-item"><a class="nav-link active show" data-toggle="tab"
                                            href="#profile2" role="tab" aria-selected="false">Hồ sơ</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#edit" role="tab"
                                            aria-selected="true">Chỉnh sửa</a></li>
                                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#settings2"
                                            role="tab" aria-selected="false">Cài đặt</a></li>
                                </ul>
                                <div class="tab-content container">
                                    <div class="tab-pane p-3 active show" id="profile2" role="tabpanel">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Họ và tên</h6>
                                                <p>{{Auth::user()->fullname}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Email</h6>
                                                <p>{{Auth::user()->email}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Sinh nhật</h6>
                                                <p>{{Auth::user()->birthday}}</p>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Điện thoại</h6>
                                                <p>{{Auth::user()->phone}}</p>
                                            </div>
                                        </div>
                                        <div class="w-100">
                                            <h6>Điện thoại</h6>
                                            <p>{{Auth::user()->address}}</p>
                                        </div>
                                        <div class="border-top-user"></div>
                                        <div class="w-100 pt-3">
                                            {{-- chart here --}}
                                            <canvas id="doughnutChartUser" height="300" width="470"
                                                style="width: 470px; height: 300px;"></canvas>
                                        </div>
                                    </div>
                                    <div class="tab-pane p-3" id="edit" role="tabpanel">
                                        <form class="" action="{{ route('user.update', Auth::user()->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" id="user_id" value="{{ Auth::user()->id }}" />

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Họ và tên</label>
                                                    <input type="text" class="form-control" name="txtFullName"
                                                        id="txtFullName" required placeholder="Nhập họ và tên"
                                                        value="{{ Auth::user()->fullname }}" />
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Ngày sinh</label>
                                                    <input type="date" class="form-control" name="dateBirthday"
                                                        id="dateBirthday" required placeholder="Nhập ngày sinh"
                                                        value="{{ Auth::user()->birthday }}" />
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Tên đăng nhập</label>
                                                    <input type="text" class="form-control" name="txtUserName"
                                                        value="{{ Auth::user()->username }}" id="txtUserName" required
                                                        placeholder="Nhập tên đăng nhập" />
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Mật khẩu</label>
                                                    <input type="password" id="pass2" name="txtPassword"
                                                        id="txtPassword" class="form-control" required
                                                        placeholder="Mật khẩu" />
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>E-Mail</label>
                                                    <input type="email" class="form-control" required name="txtEmail"
                                                        id="txtEmail" parsley-type="email"
                                                        placeholder="Nhập địa chỉ email"
                                                        value="{{ Auth::user()->email }}" />
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Số điện thoại</label>
                                                    <input data-parsley-type="number" type="text" name="txtPhone"
                                                        id="txtPhone" class="form-control" required
                                                        placeholder="Nhập số điện thoại"
                                                        value="{{ Auth::user()->phone }}" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="slbUserType">Loại người dùng</label>
                                                <select name="slbUserType" id="slbUserType" class="form-control">
                                                    {{-- <option value="">--- Chọn quyền ---</option> --}}
                                                    @if (Auth::user()->user_type == 1)
                                                    <option value="{{Auth::user()->user_type}}" selected>User</option>
                                                    @else
                                                    <option value="2" selected>Admin</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Địa chỉ</label>
                                                <input type="text" class="form-control" name="txtAddress"
                                                    id="txtAddress" required placeholder="Nhập địa chỉ"
                                                    value="{{ Auth::user()->address }}" />
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light"
                                                    style="margin-top: 15px; width: 90px;">Lưu</button>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane p-3" id="settings2" role="tabpanel">
                                        <h1>settings</h1>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
<script>
    window.onload = function() {
      this.doughnutChartUser();
    };
</script>
@endsection
