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
                <li class="breadcrumb-item"><a href="{{ route('form-manage.index') }}">Danh sách</a></li>
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
                        <span>Thông tin cấu hình phiếu và câu hỏi</span>
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

                    <form action="{{ route('config-fq.store') }}" method="POST" id="js-main-form"
                        style="height: 400px; overflow-y: scroll">
                        @csrf

                        <div class="form-row w-100">

                            <div class="form-group col-md-8">
                                <div class="list-group m-b-30">
                                    <span style="position: sticky; top: 0"
                                        class="list-group-item list-group-item-action btn-primary active">
                                        <input type="checkbox" id="checkAll3" class="check3">
                                        Danh sách câu hỏi
                                    </span>

                                    <input type="hidden" value="{{$configForm->question_forms}}" id="json" />

                                    @foreach ($questions as $key => $question)
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="checkbox" name="qChecked[]" value="{{$question->id}}"
                                                class="form-check-input select_question check3" id="{{$key}}">

                                            <label class="form-check-label"
                                                for="{{$key}}">{{$question->question}}</label>
                                        </div>
                                    </li>
                                    @endforeach

                                </div>
                            </div>

                            <div class="form-group col-md-4" id="test">

                                <div style="position: sticky; top: 0" class="list-group m-b-30">
                                    <span class="list-group-item list-group-item-action btn-primary active">
                                        Loại Phiếu
                                    </span>

                                    @foreach ($forms as $key => $form)
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input type="radio" name="chooseForm" value="{{$form->id}}"
                                                class="form-check-input select_question radioCheckForm" id="{{$key}}">
                                            <label class="form-check-label" for="{{$key}}">{{$form->name_form}}</label>
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

{{-- @section('content_script')
<script type="text/javascript">
    $(document).ready(function(){
        const idQuestionInput = $(`[name="id_question"]`);

        $('.select_question').click(function(e){
            let idQuestionInput__value
            try {
                idQuestionInput__value = JSON.parse(idQuestionInput.val());
            } catch (error) {
                idQuestionInput__value = [];
            }

            let indexSelectQuestionId = idQuestionInput__value.indexOf($(this).val());

            if(this.checked){
                if(indexSelectQuestionId < 0){
                    idQuestionInput__value.push($(this).val())
                }
            }else{
                if(indexSelectQuestionId >= 0){
                    idQuestionInput__value.splice(indexSelectQuestionId, 1)
                }
            }

            idQuestionInput.val(JSON.stringify(idQuestionInput__value))

        })

    })
</script>
@endsection --}}

@section('content_script')
<script type="text/javascript">
    $(document).ready(function(){
        let question = JSON.parse($('#json').val())
        let rCheckForm = document.getElementsByClassName('radioCheckForm')
        for (let i = 0; i < rCheckForm.length; i++) {
            try {
                if (parseInt(rCheckForm[i].value) === question[0].id_form) {
                    rCheckForm[i].checked = true
                }

            } catch (error) {

            }
        }

        $('.form-check-input').each(function(){
            if(question.find(it => it.id_question === Number($(this).val()))){
                this.checked = true
            }
        })

        $("#checkAll3").click(function () {
            $(".check3").prop('checked', $(this).prop('checked'));
        });
        $("#checkAll2").click(function () {
            $(".check2").prop('checked', $(this).prop('checked'));
        });

    })
</script>
@endsection
