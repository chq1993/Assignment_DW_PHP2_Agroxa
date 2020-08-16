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
                        <span>Mẫu phiếu đánh giá cấp trên</span>
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

                    <form action="{{ route('superior-assessment.store') }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="plan_assessment">Kế hoạch đánh giá</label>
                                <select class="custom-select mr-sm-2" name="id_plan" id="plan_assessment" required>
                                    <option value="" selected>--- Chọn kế hoạch ---</option>
                                    @foreach ($listPlan as $key => $item)
                                    <option class="checkId" value="{{$item->id}}">{{$item->name_plan}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="person_assessed">Người được đánh giá</label>
                                <select class="custom-select mr-sm-2" name="id_role_beassessed" id="person_assessed"
                                    required>
                                    <option value="" selected>--- Chọn đối tượng ---</option>
                                    @foreach ($listSuperior as $item)
                                    <option value="{{$item->roleId}}">{{$item->fullname}} -
                                        {{$item->name_position}} -
                                        {{$item->name_division}}</option>
                                    @endforeach
                                    {{$listSuperior}}
                                </select>
                            </div>
                        </div>
                        @php
                        foreach ($listPlan as $item){
                        if ($item->id == 1) {
                        $currentDesPlan = $item->description_plan;
                        }
                        }
                        @endphp

                        <p class="font-italic mt-3">{{$currentDesPlan}}</p>

                        <div class="form-group">
                            @foreach ($listQuestion as $key => $item)
                            <div class="mb-4">
                                {{-- <input class="d-none checkValue" name="id_question_forms_{{$item -> questionId}}"
                                value="{{$item->QFId}}"> --}}
                                <p style="font-size: 1rem" class="font-weight-bold">{{$key+1}}. {{$item -> question}}
                                </p>

                                @foreach ($listAnswer as $key => $answer)
                                @if ($answer -> questionId == $item -> questionId)

                                <div class="form-check form-check-block ml-4">
                                    <input class="form-check-input" type="radio"
                                        name="id_answer_questions_{{$item -> questionId}}[]"
                                        id="id_answer_questions_{{$item -> questionId}}_{{$answer->answerId}}"
                                        value="{{$answer->AQId}}" required>

                                    <label class="form-check-label mb-2"
                                        for="id_answer_questions_{{$item -> questionId}}_{{$answer->answerId}}">{{$answer -> label}}</label>
                                </div>
                                @endif
                                @endforeach
                            </div>
                            @endforeach
                        </div>

                        <p style="font-size: 1rem" class="font-italic">Nếu bạn có đánh giá bổ sung vui lòng nhập
                            thêm thông tin ở đây (Không bắt buộc).</p>
                        <textarea name="description_assessment" rows="3" class="form-control" aria-label="With textarea"
                            placeholder="Thông tin thêm"></textarea>

                        <div class="form-group mt-4">
                            <div>
                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                    Gửi đánh giá
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

@section('content_script')
<script type="text/javascript">
    $(document).ready(function(){
        let check_value  = document.getElementsByClassName('checkValue')
        for (let i = 0; i < check_value.length; i++) {
            console.log(check_value[i].value);
        }
    })
</script>
@endsection
