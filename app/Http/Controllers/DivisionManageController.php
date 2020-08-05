<?php

namespace App\Http\Controllers;

use App\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DivisionManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $divisions = DB::table('divisions');
        // dd(Question::all());

        // search
        if (isset($_GET["name-division"])) {

            $divisions = $divisions->where("name_division", "like", "%" . $_GET["name-division"] . "%");
        }

        if (isset($_GET["kind-division"])) {

            $divisions = $divisions->where("kind_division", "like", "%" . $_GET["kind-division"] . "%");
        }

        if (isset($_GET["level-division"])) {

            $divisions = $divisions->where("division_level", "like", "%" . $_GET["level-division"] . "%");
        }

        $divisions = $divisions->paginate(5)->appends(request()->query());
        return view('division-manage.index', [
            'divisions' => $divisions
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('division-manage.create');
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
        alert()->success('Đơn vị được thêm mới', 'Thành công');

        $request->validate([
            'name_division' => 'required|max:255',
            'description_division' => 'required|max:500',
            'kind_division' => 'required|max:100',
            'division_level' => 'required'
        ]);

        $division = new Division([
            'name_division' => $request->get('name_division'),
            'description_division' => $request->get('description_division'),
            'kind_division' => $request->get('kind_division'),
            'division_level' => $request->get('division_level')
        ]);
        $division->save();
        return redirect('division-manage')->with('create-success', 'Thêm mới đơn vị thành công !');
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
        $division = Division::find($id);
        return view('division-manage.edit', compact('division'));
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
            'name_division' => 'required|max:255',
            'description_division' => 'required|max:500',
            'kind_division' => 'required|max:100',
            'division_level' => 'required'
        ]);

        $division = Division::find($id);
        $division->name_division = $request->get('name_division');
        $division->description_division = $request->get('description_division');
        $division->kind_division = $request->get('kind_division');
        $division->division_level = $request->get('division_level');
        $division->save();
        return redirect('division-manage')->with('update-success', 'Cập nhật đơn vị thành công!');
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

        $division = Division::find($id);
        $division->delete();

        return redirect('division-manage')->with('delete-success', 'Xóa đơn vị thành công!');
    }
}
