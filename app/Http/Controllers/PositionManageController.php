<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions = DB::table('positions');

        if (isset($_GET['name-position'])) {
            $positions = $positions->where("name_position", "like", "%" . $_GET["name-position"] . "%");
        }

        $positions = $positions->paginate(5)->appends(request()->query());
        return view('position-manage.index', ['positions' => $positions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('position-manage.create');
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
        alert()->success('Chức vụ được thêm mới', 'Thành công');

        $request->validate([
            'name_position' => 'required|max:255',
            'descrtion_position' => 'required|max:500'
        ]);

        $position = new Position([
            'name_position' => $request->get('name_position'),
            'descrtion_position' => $request->get('descrtion_position')
        ]);
        $position->save();
        return redirect('position-manage')->with('create-success', 'Chức vụ tạo thành công !');
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
        $position = Position::find($id);
        return view('position-manage.edit', compact('position'));
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
            'name_position' => 'required|max:255',
            'descrtion_position' => 'required|max:500'
        ]);

        $position = Position::find($id);
        $position->name_position = $request->get('name_position');
        $position->descrtion_position = $request->get('descrtion_position');
        $position->save();

        return redirect('position-manage')->with('update-success', 'Cập nhật chức vụ thành công');
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
        alert()->success('Mẫu phiếu được xóa', 'Thành công');

        $position = Position::find($id);
        $position->delete();
        return redirect('position-manage')->with('delete-success', 'Xóa chức vụ thành công !');
    }
}
