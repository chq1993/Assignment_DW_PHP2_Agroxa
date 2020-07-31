@extends('layouts.admin')
@section('content_layout')
<div class="row">
  <div class="col-sm-12">
    <div class="page-title-box">
      <h4>
        <span>Quản lý câu hỏi</span>
        <i class="fas fa-caret-down ml-1"></i>
      </h4>
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
            <span> Bảng danh sách câu hỏi</span>
            <i class="fas fa-list-alt ml-2"></i>
          </h5>

          <p class="text-muted m-b-30"></p>
          <section class="d-flex justify-content-between">
            <form role="table-search" class="table-search rounded w-25 py-3">
              <div class="form-group mb-0">
                <input type="text" class="form-control" placeholder="Tìm kiếm...">
              </div>
            </form>
            <a href="{{ route('question-manage.create') }}" style="margin: 19px;" class="btn btn-primary">
              <span>Thêm mới câu hỏi</span>
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
              <table id="tech-companies-1" class="table table-bordered ">
                <thead>
                  <tr style="background-color: #35a989" class="shadow-sm text-white">
                    <td>ID</td>

                    <td>
                      <div class="d-flex justify-content-between align-items-center">
                        <span>Câu hỏi</span>

                        {{-- search-question --}}
                        <div class="dropdown">
                          <button type="button" class="btn btn-sm shadow-none bg-transparent" id="isearch-question"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="-120,15">
                            <i class="fas fa-search text-white"></i>
                          </button>

                          <div class="dropdown-menu shadow" aria-labelledby="isearch-question">
                            <div class="p-2">

                              <form role="search-question" class="table-search rounded">
                                <div class="form-group mb-0">
                                  {{-- value="{{ $_GET["search-question"] ?? ""}}" --}}
                                  <input style="height: 34px" id="search-question" type="text" class="form-control"
                                    name="search-question" placeholder="Tìm kiếm...">
                                </div>
                                <div class="mt-2 d-flex justify-content-between align-items-center">
                                  <button type="submit" class="btn btn-sm btn-primary mr-1 shadow-sm">
                                    <i class="fas fa-search text-white"></i>
                                    <span>tìm kiếm</span>
                                  </button>
                                  <button type="reset" class="btn btn-sm w-50 ml-1 shadow-sm btn-hover">xóa</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                      </div>
                    </td>

                    <td>
                      <div class="d-flex justify-content-between align-items-center">
                        <span>Nhóm câu hỏi</span>

                        {{-- search-group-question --}}
                        <div class="dropdown">
                          <button type="button" class="btn btn-sm shadow-none bg-transparent"
                            id="isearch-group-question" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" data-offset="-120,15">
                            <i class="fas fa-search text-white"></i>
                          </button>

                          <div class="dropdown-menu shadow" aria-labelledby="isearch-group-question">
                            <div class="p-2">
                              <form role="search-group-question" class="table-search rounded">
                                <div class="form-group mb-0">
                                  <select class="custom-select mr-sm-2" name="search-group-question"
                                    id="search-group-question">
                                    @foreach ($groupWorks as $groupWork)
                                    <option value="{{$loop->index + 1}}">{{$groupWork}}</option>
                                    @endforeach
                                  </select>
                                </div>
                                <div class="mt-2 d-flex justify-content-between align-items-center">
                                  <button type="submit" class="btn btn-sm btn-primary mr-1 shadow-sm">
                                    <i class="fas fa-search text-white"></i>
                                    <span>tìm kiếm</span>
                                  </button>
                                  <button type="reset" class="btn btn-sm w-50 ml-1 shadow-sm btn-hover">xóa</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                      </div>
                    </td>

                    <td>
                      <div class="d-flex justify-content-between align-items-center">
                        <span>Loại câu hỏi</span>

                        {{-- search-type-question --}}
                        <div class="dropdown">
                          <button type="button" class="btn btn-sm shadow-none bg-transparent" id="isearch-type-question"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="-120,15">
                            <i class="fas fa-filter text-white"></i>
                          </button>

                          <div class="dropdown-menu shadow" aria-labelledby="isearch-type-question">
                            <div class="p-2">
                              <form role="search-type-question" class="table-search rounded">
                                <div class="form-group form-check">
                                  <input type="checkbox" class="form-check-input" id="text-question-type">
                                  <label class="form-check-label font-weight-normal"
                                    for="text-question-type">Nhập</label>
                                </div>
                                <div class="form-group form-check">
                                  <input type="checkbox" class="form-check-input" id="select-question-type">
                                  <label class="form-check-label font-weight-normal" for="select-question-type">Lựa
                                    chọn</label>
                                </div>
                                <hr>
                                <div class="mt-2 w-100 d-flex justify-content-between align-items-center">

                                  <button type="reset" class="btn btn-sm shadow-sm btn-hover w-50 mr-1">xóa</button>
                                  <button type="submit" class="btn btn-sm btn-primary shadow-sm w-50 ml-1">
                                    <span>Lọc</span>
                                  </button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                      </div>
                    </td>

                    <td>
                      <div class="d-flex justify-content-between align-items-center">
                        <span>Câu hỏi bắt buộc</span>

                        {{-- search-required-question --}}
                        <div class="dropdown">
                          <button type="button" class="btn btn-sm shadow-none bg-transparent"
                            id="isearch-required-question" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" data-offset="-120,15">
                            <i class="fas fa-filter text-white"></i>
                          </button>

                          <div class="dropdown-menu shadow" aria-labelledby="isearch-required-question">
                            <div class="p-2">
                              <form role="search-required-question" class="table-search rounded">
                                <div class="form-group form-check">
                                  <input type="checkbox" class="form-check-input" value="1" name="required-question"
                                    id="required-question">
                                  <label class="form-check-label font-weight-normal" for="required-question">Bắt
                                    buộc</label>
                                </div>
                                <div class="form-group form-check">
                                  <input type="checkbox" class="form-check-input" value="0" name="not-required-question"
                                    id="not-required-question">
                                  <label class="form-check-label font-weight-normal" for="not-required-question">Không
                                    bắt buộc</label>
                                </div>
                                <hr>
                                <div class="mt-2 w-100 d-flex justify-content-between align-items-center">

                                  <button type="reset" class="btn btn-sm shadow-sm btn-hover w-50 mr-1">xóa</button>
                                  <button type="submit" class="btn btn-sm btn-primary shadow-sm w-50 ml-1">
                                    <span>Lọc</span>
                                  </button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>

                      </div>
                    </td>
                    <td>Miêu tả thêm</td>
                    <td colspan=2>Hành động</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($questions as $question)
                  <tr>
                    <td>{{$question->id}}</td>
                    <td>{{$question->question}}</td>
                    <td>{{$groupWorks[$question->group_question - 1]}}</td>
                    <td>{{$question->kind_question}}</td>
                    <td>{{$groupRequests[$question->required_question]}}</td>
                    <td>{{$question->description_question}}</td>
                    <td>
                      <div class="d-flex">
                        <a href="{{ route('question-manage.edit', ['question_manage' => $question->id]) }}"
                          class="btn btn-primary mr-2"><i class="far fa-edit"></i></a>
                        <form action="{{ route('question-manage.destroy', $question->id) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button onclick="return confirm('Bạn có chắc muốn xóa?')" class="btn btn-danger" type="submit"><i
                              class="far fa-trash-alt"></i></button>
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
            {{$questions -> links()}}
          </div>

        </div>
      </div>
    </div> <!-- end col -->
  </div> <!-- end row -->
</div>
@endsection