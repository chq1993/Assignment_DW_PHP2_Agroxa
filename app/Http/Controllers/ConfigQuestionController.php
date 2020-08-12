<?php

namespace App\Http\Controllers;

use App\Answer;
use App\ConfigQuestion;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfigQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $answer_questions = DB::table('answer_questions')
            ->join('questions', 'answer_questions.id_question', '=', 'questions.id')
            ->join('answers', 'answer_questions.id_answer', '=', 'answers.id')
            ->select('answer_questions.id', 'answer_questions.created_at', 'answer_questions.updated_at', 'answers.label', 'answers.value_answer', 'questions.question');

        $answer_questions = $answer_questions->paginate('5')->appends(request()->query());

        return view('config-aq.index', [
            'answer_questions' => $answer_questions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $configQuestionId = $request->input('config_aq');
        $configQuestion = Question::find($configQuestionId);

        // $question_forms = ConfigForm::all();
        $questions = Question::all();
        $answers = Answer::all();
        return view('config-aq.create', [
            'answers' => $answers,
            'questions' => $questions,
            'configQuestion' => $configQuestion
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

        $answerChecked = $request->get('aChecked');
        $dataQuestionAnswer = [];

        $idQuestion = $request->get('chooseQuestion');

        if (!empty($idQuestion)) {
            ConfigQuestion::where('id_question', $idQuestion)->delete();
            if (!empty($answerChecked)) {
                foreach ($answerChecked as $idAnswer) {
                    $dataQuestionAnswer[] = array(
                        'id_answer' => $idAnswer,
                        'id_question' => $idQuestion,
                        'created_at' => now(),
                        'updated_at' => now()
                    );
                }
            }
        }

        // dd($dataSet);
        DB::table('answer_questions')->insert($dataQuestionAnswer);


        // $question_forms->save();
        return redirect('question-manage')->with('create-success', 'Cấu hình thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        $answer_questions = ConfigForm::find($id);
        $answer_questions->delete();

        return redirect('question-manage')->with('delete-success', 'Xóa cấu hình thành công!');
    }
}
