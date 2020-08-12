<?php

namespace App\Http\Controllers;

use App\Division;
use App\Position;
use App\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB as DB;
use App\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $role = Role::with('position','division','user')->get();
        $role = DB::table('roles')->join('user', 'roles.id_user', '=', 'user.id')->join('positions', 'roles.id_position', '=', 'positions.id')->join('divisions', 'roles.id_division', '=', 'divisions.id')->select('roles.id','roles.created_at','roles.updated_at','roles.percentageOfRole', 'roles.start_time', 'roles.end_time', 'divisions.name_division', 'positions.name_position', 'user.username', 'user.fullname')->get();
      
        return view('role-manage.index', compact('role'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $user = DB::table('user')->get();
        $user = User::all();
        $division = Division::all();
        $position = Position::all();
        return view('role-manage.create', compact('user','division', 'position'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slbUser = $request->get("slbUser");
        $slbDivision = $request->get("slbDivision");
        $slbPosition = $request->get("slbPosition");
        $txtPercentageOfRole = $request->get("txtPercentageOfRole");
        $dateStartTime = $request->get("dateStartTime");
        $dateEndTime = $request->get("dateEndTime");
        
        $obj= new Role([
            'id_user'=>$slbUser,
            'id_position'=>$slbDivision,
            'id_division'=>$slbPosition,
            'percentageOfRole'=>$txtPercentageOfRole,
            'start_time'=>$dateStartTime,
            'end_time'=>$dateEndTime,
        ]);

        $obj->save();
        return Redirect()->to('role-manage/create')->with('message', 'Thêm mới vai trò cho người dùng thành công!');

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
        // $role = Role::find($id);
        $role = DB::table('roles')->join('user', 'roles.id_user', '=', 'user.id')->join('positions', 'roles.id_position', '=', 'positions.id')->join('divisions', 'roles.id_division', '=', 'divisions.id')->select('roles.id','roles.id_user','roles.id_position','roles.id_division','roles.created_at','roles.updated_at','roles.percentageOfRole', 'roles.start_time', 'roles.end_time', 'divisions.name_division', 'positions.name_position', 'user.username', 'user.fullname')->where('roles.id', $id)->first();
        $user = User::all();
        $division = Division::all();
        $position = Position::all();
        return view('role-manage.edit', compact('role', 'user', 'division','position'));
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
        $role = Role::find($id);
        
        $slbUser = $request->get("slbUser");
        $slbDivision = $request->get("slbDivision");
        $slbPosition = $request->get("slbPosition");
        $txtPercentageOfRole = $request->get("txtPercentageOfRole");
        $dateStartTime = $request->get("dateStartTime");
        $dateEndTime = $request->get("dateEndTime");

        $role->id_user= $slbUser;
        $role->id_division= $slbDivision;
        $role->id_position= $slbPosition;
        $role->percentageOfRole= $txtPercentageOfRole;
        $role->start_time= $dateStartTime;
        $role->end_time= $dateEndTime;
        
        
        $role->save();
        return redirect()->to('role-manage')->with("message", "Sửa thông tin người dùng thành công");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Role::destroy($id);
        return redirect()->to('/role-manage')->with('message','Xóa thành công');
    }
}
