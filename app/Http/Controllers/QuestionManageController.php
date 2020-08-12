<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Question;
use Alert;
use SebastianBergmann\Environment\Console;

class QuestionManageController extends Controller
{
    // private $groupWorks = ["Giải quyết vấn đề", "Làm việc nhóm", "Giao tiếp", "Trách nhiệm", "Ra quyết định", "Lãnh đạo", "Lập kế hoạch"];
    // private $groupRequests = ["Không bắt buộc", "Bắt buộc"];

    public function index()
    {
        $questions = DB::table('questions');
        // dd(Question::all());

        // search
        if (isset($_GET["search-question"])) {

            $questions = $questions->where("question", "like", "%" . $_GET["search-question"] . "%");
        }

        // search
        if (isset($_GET["search-group-question"])) {
            $questions = $questions->where("group_question", "like", "%" . $_GET["search-group-question"] . "%");
        }


        // search
        if (isset($_GET["text-question-type"])) {

            $questions = $questions->where("kind_question", "like", "%" . $_GET["text-question-type"] . "%");

        }

        if (isset($_GET["select-question-type"])) {

            $questions = $questions->where("kind_question", "like", "%" . $_GET["select-question-type"] . "%");

        }

        // search
        if (isset($_GET["required-question"])) {

            $questions = $questions->where("required_question", "like", "%" . $_GET["required-question"] . "%");

        }

        if (isset($_GET["not-required-question"])) {
            $questions = $questions->where("required_question", "like", "%" . $_GET["not-required-question"] . "%");
        }


        $questions = $questions->paginate(10)->appends(request()->query());
        return view('question-manage.index', [
            'questions' => $questions,
            'groupWorks' => \Helper::groupWorks(),
            'groupRequests' => \Helper::groupRequests(),
            'groupTypeQuestion'=> \Helper::groupTypeQuestion()
        ]);
        // return view('question-manage.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('question-manage.create');
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
        alert()->success('Câu hỏi được thêm mới', 'Thành công');

        $request->validate([
            'question' => 'required|max:500',
            'description_question' => 'required|max:1000',
        ]);

        $question = new Question([
            'question' => $request->get('question'),
            'group_question' => $request->get('group_question'),
            'kind_question' => $request->get('kind_question'),
            'required_question' => $request->get('required_question'),
            'description_question' => $request->get('description_question'),
        ]);
        $question->save();
        return redirect('question-manage')->with('create-success', 'Thêm mới câu hỏi thành công !');
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
        $question = Question::find($id);
        return view('question-manage.edit', compact('question'));
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
        alert()->success('Câu hỏi được cập nhật', 'Thành công');

        $request->validate([
            'question' => 'required|max:500',
            'description_question' => 'required|max:1000',
        ]);

        $question = Question::find($id);
        $question->question = $request->get('question');
        $question->group_question = $request->get('group_question');
        $question->kind_question = $request->get('kind_question');
        $question->required_question = $request->get('required_question');
        $question->description_question = $request->get('description_question');
        $question->save();
        return redirect('/question-manage')->with('update-success', 'Cập nhật câu hỏi thành công!');
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
        alert()->success('Câu hỏi được xóa', 'Thành công');

        $question = Question::find($id);
        $question->delete();

        return redirect('/question-manage')->with('delete-success', 'Xóa câu hỏi thành công!');
    }
}
