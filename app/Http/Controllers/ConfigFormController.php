<?php

namespace App\Http\Controllers;

use App\ConfigForm;
use App\Form;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class ConfigFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question_forms = DB::table('question_forms')
            ->join('forms', 'question_forms.id_form', '=', 'forms.id')
            ->join('questions', 'question_forms.id_question', '=', 'questions.id')
            ->select('question_forms.id', 'question_forms.created_at', 'question_forms.updated_at', 'forms.name_form', 'questions.question');

        $question_forms = $question_forms->paginate('5')->appends(request()->query());
        return view('config-fq.index', [
            'question_forms' => $question_forms
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $configFormId = $request->input('config_fq');
        $configForm = Form::find($configFormId);

        // $question_forms = ConfigForm::all();
        $forms = Form::all();
        $questions = Question::all();
        return view('config-fq.create', [
            'forms' => $forms,
            'questions' => $questions,
            'configForm' => $configForm
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Hiển thị thông báo check với điều kiện ngoài index
        alert()->success('Cấu hình được tạo', 'Thành công');

        $questionChecked = $request->get('qChecked');
        $dataSet = [];

        $idForm = $request->get('chooseForm');

        if (!empty($idForm)) {
            ConfigForm::where('id_form', $idForm)->delete();
            if (!empty($questionChecked)) {
                foreach ($questionChecked as $idQuestion) {
                    $dataSet[] = array(
                        'id_form' => $idForm,
                        'id_question' => $idQuestion,
                        'created_at' => now(),
                        'updated_at' => now()
                    );
                }
            }
        }

        // dd($dataSet);
        DB::table('question_forms')->insert($dataSet);


        // $question_forms->save();
        return redirect('form-manage')->with('create-success', 'Cấu hình thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('config-fq.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Hiển thị thông báo check với điều kiện ngoài index
        alert()->success('Cấu hình được xóa', 'Thành công');

        $question_forms = ConfigForm::find($id);
        $question_forms->delete();

        return redirect('form-manage')->with('delete-success', 'Xóa cấu hình thành công!');
    }
}
