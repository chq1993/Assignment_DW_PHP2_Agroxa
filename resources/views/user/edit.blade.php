@extends('layouts.admin')
@section('content_layout')

<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Sửa thông tin người dùng</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('user.store') }}">User</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('user.edit') }}">Edit user</a></li>
                        <li class="breadcrumb-item active">Form</li>
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

                            <form class="" action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" id="user_id" value="{{ $user->id }}"/>
                                <div class="form-group">
                                    <label>Tên đăng nhập</label>
                                    <input type="text" class="form-control" name="txtUserName" id="txtUserName"  required placeholder="Nhập tên đăng nhập" value="{{ $user->username }}"/>
                                </div>
                                <div class="form-group">
                                    <label>Họ và tên</label>
                                    <input type="text" class="form-control" name="txtFullName" id="txtFullName" required placeholder="Nhập họ và tên" value="{{ $user->fullname }}"/>
                                </div>
                                <div class="form-group">
                                    <label>Địa chỉ</label>
                                    <input type="text" class="form-control" name="txtAddress" id="txtAddress" required placeholder="Nhập địa chỉ" value="{{ $user->address }}"/>
                                </div>
                                <div class="form-group">
                                    <label>E-Mail</label>
                                    <div>
                                        <input type="email" class="form-control" required name="txtEmail" id="txtEmail"
                                                parsley-type="email" placeholder="Nhập địa chỉ email" value="{{ $user->email }}"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <div>
                                        <input data-parsley-type="number" type="text" name="txtPhone" id="txtPhone"
                                                class="form-control" required
                                                placeholder="Nhập số điện thoại" value="{{ $user->phone }}"/>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtAnhdd">Ảnh đại diện</label>
                                    <input type="file" class="form-control-file" id="txtAnhdd" name="txtAnhdd" placeholder="Ảnh đại diện" value="{{ $user->path_image }}">
                                  </div>
                                
                                
                                <div class="form-group">
                                    <div>
                                        <button type="button" class="btn btn-primary waves-effect waves-light" onclick="call_update()">
                                            Thêm mới
                                        </button>
                                        <button type="button" class="btn btn-secondary waves-effect m-l-5"  href="{{ route('user.index') }}">
                                            Quay lại
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

<script type="text/javascript">
    function call_update(){
        $.ajax({
            url : '{{ route('user.ajax_update') }}',
            method: 'POST',
            data:{
                _token:$("input[name=_token]").val(),
                id:$("#user_id").val(),
                username:$("#txtUserName").val(),
                fullname:$("#txtFullName").val(),
                address:$("#txtAddress").val(),
                email:$("#txtEmail").val(),
                phone:$("#txtPhone").val(),
                image:$("#txtAnhdd").val()
            },
            success:function(res){
                  //alert(res);
                  $("#divalert").html(res);
            }
        });
    }
</script>

@endsection