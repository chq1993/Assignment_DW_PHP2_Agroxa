<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubordinateAssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result_assessments = DB::table('result_assessments');


        $result_assessments = $result_assessments->paginate(10);

        $user = auth()->user();

        $resultBeassessed = DB::table('result_assessments')
            ->join('roles', 'result_assessments.id_role_beassessed', '=', 'roles.id')
            ->join('positions', 'roles.id_position', '=', 'positions.id')
            ->join('divisions', 'roles.id_division', '=', 'divisions.id')
            ->join('user', 'roles.id_user', '=', 'user.id')
            ->select(
                'divisions.name_division',
                'positions.name_position',
                'user.id',
                'user.fullname'
            )
            ->where([
                ['result_assessments.id_role_beassessed', '!=', $user->id]
            ])
            ->get();
        // dd($resultBeassessed);
        $resultAssess = DB::table('result_assessments')
            ->join('roles', 'result_assessments.id_role_assess', '=', 'roles.id')
            ->join('divisions', 'roles.id_division', '=', 'divisions.id')
            ->join('positions', 'roles.id_position', '=', 'positions.id')
            ->join('user', 'roles.id_user', '=', 'user.id')
            ->select(
                'divisions.name_division',
                'positions.name_position',
                'user.id',
                'user.fullname'
            )
            ->where([
                ['result_assessments.id_role_assess', '!=', $user->id]
            ])
            ->get();
        // dd(array_unique($resultAssess));



        return view('subordinate-assessment.index', [
            'resultAssess' => $resultAssess,
            'resultBeassessed' => $resultBeassessed,
            'result_assessments' => $result_assessments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = auth()->user();

        $levelPositionUserDef = DB::table('roles')
            ->join('positions', 'roles.id_position', '=', 'positions.id')
            ->select('positions.level_position')
            ->where('id_user', '=', $user->id)
            ->get();
        //  var_dump($levelPositionUserDef);

        $role = Role::select('roles.*')->where('id_user', $user->id)->first();

        /*-------------------- Phiếu đánh giá Cấp dưới ---------------------*/
        /* Lấy tất cả role được đánh giá  */
        $listSubordinate = DB::table('roles')
            ->join('positions', 'roles.id_position', '=', 'positions.id')
            ->join('divisions', 'roles.id_division', '=', 'divisions.id')
            ->join('user', 'roles.id_user', '=', 'user.id')

            ->select(
                'roles.id as roleId',
                'user.fullname',
                'positions.name_position',
                'positions.level_position',
                'positions.id as positionId',
                'divisions.name_division',
                'divisions.id as divisionId'
            )
            ->where([
                ['id_division', '=', $role->id_division],
                ['level_position', '>', $levelPositionUserDef[0]->level_position],
            ])
            ->get();

        // dd($listPeer);
        // foreach ($listPeer as $key => $value) {
        //     $newArray[$listPeer[$key]->planId] = $value;
        // }
        // dd($newArray);

        /* Lấy tất cả câu hỏi và đáp án được đánh giá  */
        $listQuestion = DB::table('question_forms')
            ->join('questions', 'question_forms.id_question', '=', 'questions.id')
            ->join('forms', 'question_forms.id_form', '=', 'forms.id')
            ->select(
                'question_forms.id as QFId',
                'questions.id as questionId',
                'question_forms.id_form',
                'forms.description_form',
                'questions.question',
                'questions.description_question',
            )
            ->where([
                ['question_forms.id_form', '=', 3]
            ])
            ->get();
        // dd($listQuestion);
        /*Lấy câu trả lời theo câu hỏi*/
        $listAnswer = DB::table('question_forms')
            ->join('questions', 'question_forms.id_question', '=', 'questions.id')
            ->join('answer_questions', 'question_forms.id_question', '=', 'answer_questions.id_question')
            ->join('answers', 'answer_questions.id_answer', '=', 'answers.id')

            ->select(
                'questions.id as questionId',
                'question_forms.id_form',
                'answers.id as answerId',
                'answers.label',
                'answer_questions.id as AQId'
            )
            ->where([
                ['question_forms.id_form', '=', 3]
            ])
            ->get();
        // dd('list answer: ',$listAnswer,'list question: ', $listQuestion);

        /*
        ->join('answer_questions', 'question_forms.id_question', '=', 'answer_questions.id_question')
        ->join('answers', 'answer_questions.id_answer', '=', 'answers.id')
        'answers.id as answerId',
        'answers.label',
        'answer_questions.id as AQId'
        */
        // dd($listAnswer);
        /* Lấy tất cả kế hoạch đánh giá  */
        $listPlan = DB::table('plans')
            ->get();
        // dd($listPlan);



        return view('subordinate-assessment.create', [
            'listSubordinate' => $listSubordinate,
            'listQuestion' => $listQuestion,
            'listAnswer' => $listAnswer,
            'listPlan' => $listPlan
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
        /* Lấy tất cả câu hỏi và đáp án được đánh giá  */
        $listQuestion = DB::table('question_forms')
            ->join('questions', 'question_forms.id_question', '=', 'questions.id')
            ->join('forms', 'question_forms.id_form', '=', 'forms.id')
            ->select(
                'question_forms.id as QFId',
                'questions.id as questionId',
                'question_forms.id_form',
                'forms.description_form',
                'questions.question',
                'questions.description_question',
            )
            ->where([
                ['question_forms.id_form', '=', 3]
            ])
            ->get();
        // dd($listQuestion);
        /*Lấy câu trả lời theo câu hỏi*/
        $listAnswer = DB::table('question_forms')
            ->join('questions', 'question_forms.id_question', '=', 'questions.id')
            ->join('answer_questions', 'question_forms.id_question', '=', 'answer_questions.id_question')
            ->join('answers', 'answer_questions.id_answer', '=', 'answers.id')

            ->select(
                'questions.id as questionId',
                'question_forms.id_form',
                'answers.id as answerId',
                'answers.label',
                'answer_questions.id as AQId'
            )
            ->where([
                ['question_forms.id_form', '=', 3]
            ])
            ->get();
        // dd($listAnswer);





        $currentRole = auth()->user()->current_role;
        $resultData = [];
        $result = DB::table('result_assessments')
            ->get();




        $checkIdPlan = $request->get('id_plan');
        // echo "id_plan=".$checkIdPlan;
        $checkIdRoleAssess = $currentRole;
        $checkIdRoleBeassessed = $request->get('id_role_beassessed');

        foreach ($listQuestion as $item) {
            //id_answer_questions
            $idAnswerQuestions = $request->get('id_answer_questions_' . $item->questionId);
            foreach ($idAnswerQuestions as $answer) {
                // var_dump($answer);

                $resultData[] = array(
                    'id_plan' => $checkIdPlan,
                    'id_role_beassessed' => $checkIdRoleBeassessed,
                    'id_role_assess' => $checkIdRoleAssess,
                    'id_answer_questions' => $answer,
                    'id_question_forms' => $item->questionId,
                    'created_at' => now(),
                    'updated_at' => now()
                );
            }
        }
        DB::table('result_assessments')->insert($resultData);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resultBeassessed = DB::table('result_assessments')
            ->join('roles', 'result_assessments.id_role_beassessed', '=', 'roles.id')
            ->join('positions', 'roles.id_position', '=', 'positions.id')
            ->join('divisions', 'roles.id_division', '=', 'divisions.id')
            ->join('user', 'roles.id_user', '=', 'user.id')
            ->select(
                'divisions.name_division',
                'positions.name_position',
                'user.id',
                'user.fullname'
            )
            ->where('result_assessments.id_role_beassessed', '=', 'user.id')
            ->get();

        $resultAssess = DB::table('result_assessments')
            ->join('roles', 'result_assessments.id_role_assess', '=', 'roles.id')
            ->join('positions', 'roles.id_position', '=', 'positions.id')
            ->join('divisions', 'roles.id_division', '=', 'divisions.id')
            ->join('user', 'roles.id_user', '=', 'user.id')
            ->select(
                'divisions.name_division',
                'positions.name_position',
                'user.id',
                'user.fullname'
            )
            ->where('result_assessments.id_role_assess', '=', 'user.id')
            ->get();




        // $result = $result->paginate(10)->appends(request()->query());
        return view('subordinate-assessment.show', [
            'resultAssess' => $resultAssess,
            'resultBeassessed' => $resultBeassessed
        ]);
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
        //
    }
}
