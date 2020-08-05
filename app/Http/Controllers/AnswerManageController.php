<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnswerManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answers = DB::table('answers');

        if (isset($_GET['search-answer'])) {
            $answers = $answers->where("value_answer", "like", "%" . $_GET["search-answer"] . "%");
        }

        $answers = $answers->paginate('5')->appends(request()->query());
        return view('answer-manage.index', [
            "answers" => $answers,
            'groupAnswers' => \Helper::groupAnswers()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('answer-manage.create');
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
        alert()->success('Đáp án được thêm mới', 'Thành công');

        $request->validate([
            'value_answer' => 'required',
            'label' => 'required|max:255',
        ]);

        $answer = new Answer([
            'value_answer' => $request->get('value_answer'),
            'label' => $request->get('label')
        ]);
        $answer->save();
        return redirect('answer-manage')->with('create-success', 'Thêm mới đáp án thành công !');
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
        $answer = Answer::find($id);
        return view('answer-manage.edit', compact('answer'));
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
        //Hiển thị thông báo check với điều kiện ngoài index
        alert()->success('Đáp án được cập nhật', 'Thành công');

        $request->validate([
            'value_answer' => 'required',
            'label' => 'required|max:255',
        ]);

        $answer = Answer::find($id);
        $answer->value_answer = $request->get('value_answer');
        $answer->label = $request->get('label');
        $answer->save();
        return redirect('answer-manage')->with('update-success', 'Cập nhật đáp án thành công!');
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
        alert()->success('Đáp án được xóa', 'Thành công');

        $answer = Answer::find($id);
        $answer->delete();

        return redirect('answer-manage')->with('delete-success', 'Xóa đáp án thành công!');
    }
}
