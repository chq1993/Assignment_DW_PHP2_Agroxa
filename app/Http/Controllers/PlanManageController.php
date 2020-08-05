<?php

namespace App\Http\Controllers;

use App\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlanManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = DB::table('plans');

        if (isset($_GET['name-plan'])) {
            $plans = $plans->where("name_plan", "like", "%" . $_GET["name-plan"] . "%");
        }

        $plans = $plans->paginate(5)->appends(request()->query());
        return view('plan-manage.index', ['plans' => $plans]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plan-manage.create');
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
        alert()->success('Kế hoạch được thêm mới', 'Thành công');

        $request->validate([
            'name_plan' => 'required|max:255',
            'description_plan' => 'required|max:255',
            'start_date' => 'required',
            'end_date' => 'required',
            'begin_rate' => 'required',
            'finish_rate' => 'required'
        ]);

        $plan = new Plan([
            'name_plan' => $request->get('name_plan'),
            'description_plan' => $request->get('description_plan'),
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'begin_rate' => $request->get('begin_rate'),
            'finish_rate' => $request->get('finish_rate')
        ]);
        $plan->save();
        return redirect('plan-manage')->with('create-success', 'Kế hoạch tạo thành công !');
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
        $plan = Plan::find($id);
        return view('plan-manage.edit', compact('plan'));
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
        alert()->success('Chức vụ được cập nhật', 'Thành công');

        $request->validate([
            'name_plan' => 'required|max:255',
            'description_plan' => 'required|max:255',
            'start_date' => 'required',
            'end_date' => 'required',
            'begin_rate' => 'required',
            'finish_rate' => 'required'
        ]);

        $plan = Plan::find($id);
        $plan->name_plan = $request->get('name_plan');
        $plan->description_plan = $request->get('description_plan');
        $plan->start_date = $request->get('start_date');
        $plan->end_date = $request->get('end_date');
        $plan->begin_rate = $request->get('begin_rate');
        $plan->finish_rate = $request->get('finish_rate');
        $plan->save();

        return redirect('plan-manage')->with('update-success', 'Cập nhật kế hoạch thành công');
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
        alert()->success('Kế hoạch được xóa', 'Thành công');

        $plan = Plan::find($id);
        $plan->delete();
        return redirect('plan-manage')->with('delete-success', 'Xóa kế hoạch thành công !');
    }
}
