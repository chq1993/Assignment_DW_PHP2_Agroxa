<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeerAssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        // dd($levelPositionUserDef);

        $role = Role::select('roles.*')->where('id_user', $user->id)->first();

        /*-------------------- Phiếu đánh giá đồng cấp ---------------------*/
        /* Lấy tất cả role được đánh giá  */
        $listPeer = DB::table('roles')
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
                ['level_position', '=', $levelPositionUserDef[0]->level_position],
                ['id_user', '!=', $user->id]
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
                ['question_forms.id_form', '=', 1]
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
                ['question_forms.id_form', '=', 1]
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



        return view('peer-assessment.create', [
            'listPeer' => $listPeer,
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
                ['question_forms.id_form', '=', 1]
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
                ['question_forms.id_form', '=', 1]
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

                $resultData[] = array(
                    'id_plan' => $checkIdPlan,
                    'id_role_beassessed' => $checkIdRoleBeassessed,
                    'id_role_assess' => $checkIdRoleAssess,
                    'id_answer_questions' => $answer,
                    'id_question_forms' => $item->questionId,
                    'description_assessment' => $request->get('description_assessment'),
                    'created_at' => now(),
                    'updated_at' => now()
                );
            }
        }

        //chưa check được
        alert()->success('Đã đánh giá', 'Thành công');
        DB::table('result_assessments')->insert($resultData);
        return redirect()->to('peer-assessment/create')->with('assessment-success', 'Đánh giá thành công');

        // foreach ($result as $resultValue) {
        //     if (
        //         $resultValue->id_role_assess == $checkIdRoleAssess
        //         && $resultValue->id_role_beassessed == $checkIdRoleBeassessed
        //         && $resultValue->id_plan == $checkIdPlan
        //         && $resultValue->id_question_forms == $listQuestion[0]->questionId
        //     ) {
        //         alert()->success('Đã đánh giá', 'Thành công');
        //         return redirect()->to('peer-assessment/create')->with('assessment-success', 'Đánh giá thành công');
        //     } else {
        //         alert()->warning('Người dùng này bạn đã đánh giá', 'Vui lòng đánh giá người khác');
        //         DB::table('result_assessments')->insert($resultData);
        //         return redirect()->to('peer-assessment/create')->with('submit-failed', 'Bạn đã đánh giá người này');
        //     }
        // }

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
        //
    }
}
