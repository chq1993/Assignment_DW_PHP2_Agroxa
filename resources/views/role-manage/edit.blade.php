@extends('layouts.admin')
@section('content_layout')

<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <h4>
        <span>Chỉnh sửa vai trò cho người dùng</span>
        <i class="fas fa-caret-down ml-1"></i>
      </h4>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('role-manage.index') }}">Danh sách</a></li>
        <li class="breadcrumb-item active">Chỉnh sửa</li>
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
            <span>Chỉnh sửa vai trò</span>
            <i class="fas fa-pen-square ml-1"></i>
          </h5>
          <p class="text-muted m-b-30 ">Vui lòng cập nhật đầy đủ thông tin để có thể chỉnh sửa vai trò cho người dùng!</p>
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

          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif

          <form name="myForm" action="{{ route('role-manage.update', $role->id) }}" onsubmit="return validateForm()" method="POST">
            @csrf
            @method('PATCH')
            <div class="form-row"> <!-- Bắt đầu div form-row !-->
            <div class="form-group col-md-3" >
                <label for="slbUser">Chọn người dùng</label>
                <select name="slbUser" id="slbUser" class="form-control">
                    <option value="{{ $role->id_user }}">{{ $role->fullname }}</option>
                    @foreach($user as $user)
                    <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-3" >
                <label for="slbDivision">Chọn đơn vị</label>
                <select name="slbDivision" id="slbDivision" class="form-control">
                    <option value="{{ $role->id_division }}">{{ $role->name_division }}</option>
                    @foreach($division as $division)
                    <option value="{{ $division->id }}">{{ $division->name_division }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3" >
                <label for="slbPosition">Chọn đơn vị</label>
                <select name="slbPosition" id="slbPosition" class="form-control">
                    <option value="{{ $role->id_position }}">{{ $role->name_position }}</option>  
                    @foreach($position as $position)
                    <option value="{{ $position->id }}">{{ $position->name_position }}</option>
                    @endforeach
                </select>
            </div>
            </div> <!-- Kết thúc div form-row !--> 

            <div class="form-row"> <!-- Bắt đầu div form-row !-->
            <div class="form-group  col-md-3">
                <label>Vai trò này chiếm số % công việc:</label>
                <div>
                <input data-parsley-type="number" type="text" name="txtPercentageOfRole" id="txtPercentageOfRole" class="form-control" required placeholder="Nhập số phần trăm" value="{{ $role->percentageOfRole}}"/>
                </div>
            </div>
            <div class="form-group col-md-2">
                <label>Ngày bắt đầu nhận vai trò này</label>
                <input type="date" class="form-control" name="dateStartTime" id="dateStartTime" required placeholder="Nhập ngày bắt đầu làm vai trò này" value="{{ $role->start_time}}"/>
            </div>
            <div class="form-group col-md-2">
                <label>Ngày kết thúc vai trò này</label>
                <input type="date" class="form-control" name="dateEndTime" id="dateEndTime" value="{{ $role->end_time}}" placeholder="Nhập ngày kết thúc vai trò này nếu vẫn đang làm thì bỏ trống" />
            </div>
            </div> <!-- Kết thúc div form-row !--> 
            <div class="form-group">
              <div>
                <button type="submit" class="btn btn-primary waves-effect waves-light" >
                  Cập nhật
                </button>
                <a href="{{ route('role-manage.store') }}" class="btn btn-secondary">Quay lại</a>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div> <!-- end col -->


  </div> <!-- end row -->
</div>
<script type="text/javascript">
function validateForm() {
  var txtPercentageOfRole = document.forms["myForm"]["txtPercentageOfRole"].value;
  if (txtPercentageOfRole <1 || txtPercentageOfRole >100) {
    alert("Giá trị % chỉ nằm trong khoảng 1-100");
    document.forms["myForm"]["txtPercentageOfRole"].focus();
    return false;
  }
}
</script>

@endsection