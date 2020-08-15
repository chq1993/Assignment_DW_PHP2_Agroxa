@extends('layouts.admin')
@section('content_layout')
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4>
                <span>Quản lý cấu hình</span>
                <i class="fas fa-caret-down ml-1"></i>
            </h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="{{ route('question-manage.index') }}">Danh sách</a></li>
                <li class="breadcrumb-item active">Cấu hình</li>
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
                        <span>Cấu hình câu hỏi và đáp án</span>
                        <i class="fas fa-pen-square ml-1"></i>
                    </h5>
                    <p class="text-muted m-b-30 ">Có thể chỉnh sửa được thông tin</p>
                    <section class="d-flex justify-content-between">
                        <form role="table-search" class="table-search rounded w-25 py-3">
                            <div class="form-group mb-0">
                                <input name="search-question" type="text" class="form-control"
                                    placeholder="Tìm kiếm...">
                            </div>
                        </form>
                    </section>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form style="height: 400px; overflow-y: scroll" action="{{ route('config-aq.store') }}"
                        method="POST" id="js-main-form" class="vh-100 overflow-auto">
                        @csrf

                        <div class="form-row w-100">
                            <div class="form-group col-md-8">
                                <div class="list-group m-b-30">
                                    <span style="position: sticky; top: 0"
                                        class="list-group-item list-group-item-action btn-primary active">
                                        Danh Sách Câu Hỏi
                                    </span>


                                    @foreach ($questions as $key => $question)
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            @if ($configQuestion->id == $question->id)
                                            <input type="radio" name="chooseQuestion" value="{{$question->id}}"
                                                class="form-check-input radioCheck" id="{{$key}}"
                                                checked="{{$configQuestion->id == $question->id}}">
                                            @else
                                            <input type="radio" name="chooseQuestion" value="{{$question->id}}"
                                                class="form-check-input radioCheck" id="{{$key}}">
                                            @endif


                                            <label class="form-check-label"
                                                for="{{$key}}">{{$question->question}}</label>
                                        </div>
                                    </li>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <div style="position: sticky; top: 0" class="list-group m-b-30">
                                    <span href="#" class="list-group-item list-group-item-action btn-primary active">
                                        <input type="checkbox" id="checkAll1" class="check1">
                                        Loại Đánh Giá
                                    </span>
                                    <input type="hidden" value="{{$configQuestion->answer_questions}}"
                                        id="jsonQuestion" />
                                    @foreach ($answers as $key => $answer)
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="checkbox" name="aChecked[]" value="{{$answer->value_answer}}"
                                                class="form-check-input select_answer check1" id="{{$key}}">

                                            <label class="form-check-label" for="{{$key}}">{{$answer->label}}</label>
                                        </div>
                                    </li>
                                    @endforeach
                                    <button style="z-index: 2" type="submit"
                                        class="btn btn-outline-primary waves-effect waves-light">
                                        Lưu
                                    </button>

                                </div>

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
        let answer = JSON.parse($('#jsonQuestion').val())
        let rCheck = document.getElementsByClassName('radioCheck')
        for (let i = 0; i < rCheck.length; i++) {
            try {
                if (parseInt(rCheck[i].value) === answer[0].id_question) {
                    rCheck[i].checked = true
                }else{
                    rCheck[i].disabled = true
                }

            } catch (error) {

            }

        }
        $('.select_answer').each(function(){
            if(answer.find(it => it.id_answer === Number($(this).val()))){
                this.checked = true
            }
        })

        $("#checkAll1").click(function () {
            $(".check1").prop('checked', $(this).prop('checked'));
        });


    })
</script>
@endsection
