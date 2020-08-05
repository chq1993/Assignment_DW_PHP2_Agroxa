@extends('layouts.admin')
@section('content_layout')
<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <h4><span>Quản lý kế hoạch</span>
        <i class="fas fa-caret-down ml-1"></i></h4>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
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
            <span>Bảng danh sách kế hoạch</span>
            <i class="fas fa-list-alt ml-2"></i>
          </h5>

          <p class="text-muted m-b-30"></p>

          <section class="d-flex justify-content-between">
            <form role="table-search" class="table-search rounded w-25 py-3">
              <div class="form-group mb-0">
                <input type="text" class="form-control" placeholder="Tìm kiếm...">
              </div>
            </form>
            <a href="{{ route('plan-manage.create') }}" style="margin: 19px;" class="btn btn-primary">
              <span>Thêm mới kế hoạch</span>
              <i class="far fa-question-circle ml-1"></i></a>
          </section>

          @if (session()->get('create-success'))
          @include('sweetalert::alert')
          @endif
          @if (session()->get('update-success'))
          @include('sweetalert::alert')
          @endif
          @if (session()->get('delete-success'))
          @include('sweetalert::alert')
          @endif

          <div class="table-rep-plugin">
            <div class="table-responsive b-0" data-pattern="priority-columns">
              <table id="tech-companies-1" class="table table-bordered">
                <thead>
                  <tr style="background-color: #35a989" class="shadow-sm text-white">
                    <td>ID</td>
                    <td>
                      <div class="d-flex justify-content-between align-items-center">
                        <span>Kế hoạch</span>

                        {{-- tên kế hoạch --}}
                        <div class="dropdown">
                          <button type="button" class="btn btn-sm shadow-none bg-transparent" id="tenKeHoach"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="-120,15">
                            <i class="fas fa-search text-white"></i>
                          </button>

                          <div class="dropdown-menu shadow" aria-labelledby="tenKeHoach">
                            <div class="p-2">

                              <form role="name-plan" class="table-search rounded">
                                <div class="form-group mb-0">
                                  {{-- value="{{ $_GET["search-question"] ?? ""}}"
                                  --}}
                                  <input style="height: 34px" id="name-plan" type="text" class="form-control"
                                    name="name-plan" placeholder="Tìm kiếm...">
                                </div>
                                <div class="mt-2 d-flex justify-content-between align-items-center">
                                  <button type="submit" class="btn btn-sm btn-primary mr-1 shadow-sm">
                                    <i class="fas fa-search text-white"></i>
                                    <span>tìm kiếm</span>
                                  </button>
                                  <button type="reset" class="btn btn-sm w-50 ml-1 shadow-sm btn-hover"><i
                                      class="fas fa-sync-alt"></i></button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                      </div>
                    </td>
                    <td>Thời gian bắt đầu</td>
                    <td>Thời gian kết thúc</td>
                    <td>Thời gian bắt đầu thực hiện</td>
                    <td>Thời gian kết thúc thực hiện</td>
                    <td>Miêu tả thêm</td>
                    <td colspan=2>Hành động</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($plans as $plan)
                  <tr>
                    <td>{{$plan->id}}</td>
                    <td>{{$plan->name_plan}}</td>       
                    <td>{{$plan->start_date}}</td>
                    <td>{{$plan->end_date}}</td>
                    <td>{{$plan->begin_rate}}</td>
                    <td>{{$plan->finish_rate}}</td>
                    <td>{{$plan->description_plan}}</td>
                    <td>
                      <div class="d-flex">
                        <a href="{{ route('plan-manage.edit', ['plan_manage' => $plan->id]) }}"
                          class="btn btn-primary mr-2"><i class="far fa-edit"></i></a>
                        <form action="{{ route('plan-manage.destroy', $plan->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button onclick="return confirm('Bạn có chắc muốn xóa?')" class="btn btn-danger"
                            type="submit"><i class="far fa-trash-alt"></i></button>
                        </form>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>

          </div>

          <div class="d-flex justify-content-center mt-4">
            {{$plans -> links()}}
          </div>

        </div>
      </div>
    </div> <!-- end col -->
  </div> <!-- end row -->
</div>
@endsection