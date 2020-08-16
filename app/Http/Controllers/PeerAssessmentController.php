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


        // dd($other);

        // $userDb = User::find($user->id);
        // $listRole = Role::where([
        //         ['id_division', '=', $role->id_division],
        //         ['id_user','!=',$user->id]
        //     ])
        //     ->get();


        // var_dump($userDb->positions()->pluck('level_position')[0]);
        /*
                    $other = array_filter($other->toArray(), function ($item) use ($userDb) {
                        return $userDb->positions()->pluck('level_position')[0] == $item['positions'][0]['level_position'] &&
                        $item['divisions'][0]['id']  == $userDb->divisions()->pluck('id_division')[0];
                    });
                    */
        /*
                    echo "<pre>";
                    var_dump($other);
                    echo "</pre>";
        */
        // foreach($other as $item){
        //     var_dump($item);
        // }
        // dd($other);

        /*lấy người danh sách user != user login */
        // $other = User::with('positions', 'divisions')
        //     ->where('id', '!=', $user->id)
        //     ->get();
        // $role = Role::select('roles.*')->where('id_user', $user->id)->first();
        // $id_positionLogin = $role->id_position;
        // $id_divisionLogin = $role->id_division;
        // $listRoleReview = Role::where([
        //     ['id_position', '=', $id_positionLogin],
        //     ['id_division', '=', $id_divisionLogin]
        // ])
        //     ->get();

        // $listUser = [];
        // for ($i = 0; $i < count($listRoleReview); $i++) {
        //     $listUser[] = User::where([
        //         ['id', '=', $listRoleReview[$i]->id_user]
        //     ])
        //         ->get();
        // }

        // dd($listUser);

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
        //
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
