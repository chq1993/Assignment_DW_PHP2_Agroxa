<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changerole(Request $request)
    {
        $slbIdRole = $request->get('slbIdRole');
        $request->session()->put('id_role', $slbIdRole);
        return Redirect()->to('/changerole')->with('message', 'Chọn vai trò thành công!');
    }

    public function store(Request $request)
    {



        $txtUserName = $request->get("txtUserName");
        $txtFullName = $request->get("txtFullName");
        $dateBirthday = $request->get("dateBirthday");
        $txtEmail = $request->get("txtEmail");
        $txtAddress = $request->get("txtAddress");
        $txtPhone = $request->get("txtPhone");
        $slbUserType = $request->get("slbUserType");
        $txtPassword = $request->get("txtPassword");

        $obj = new User([
            'username' => $txtUserName,
            'fullname' => $txtFullName,
            'birthday' => $dateBirthday,
            'email' => $txtEmail,
            'address' => $txtAddress,
            'phone' => $txtPhone,
            'status' => 1,
            'user_type' => $slbUserType,
            'password' => bcrypt($txtPassword)
        ]);

        $obj->save();
        if ($obj->save()) {
            //Hiển thị thông báo check với điều kiện ngoài index
            alert()->success('Người dùng được thêm mới', 'Thành công');
        }
        return Redirect()->to('user')->with('create-success', 'Thêm mới người dùng thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id_user = Auth::user()->id;
        $role = DB::table('roles')
            ->join('user', 'roles.id_user', '=', 'user.id')
            ->join('positions', 'roles.id_position', '=', 'positions.id')
            ->join('divisions', 'roles.id_division', '=', 'divisions.id')
            ->select('roles.id', 'roles.id_user', 'roles.id_position', 'roles.id_division', 'roles.created_at', 'roles.updated_at', 'roles.percentageOfRole', 'roles.start_time', 'roles.end_time', 'divisions.name_division', 'positions.name_position', 'user.username', 'user.fullname')
            ->where('roles.id_user', $id_user)->get();

        return view('user.show', compact('role'));
        // return view('user.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
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


        $user = User::find($id);

        $txtUserName = $request->get("txtUserName");
        $txtFullName = $request->get("txtFullName");
        $dateBirthday = $request->get("dateBirthday");
        $txtAddress = $request->get("txtAddress");
        $txtEmail = $request->get("txtEmail");
        $txtPhone = $request->get("txtPhone");
        $slbUserType = $request->get("slbUserType");
        $txtPassword = $request->get("txtPassword");


        $user->username = $txtUserName;
        $user->fullname = $txtFullName;
        $user->birthday = $dateBirthday;
        $user->address = $txtAddress;
        $user->email = $txtEmail;
        $user->phone = $txtPhone;
        $user->user_type = $slbUserType;
        $user->password = bcrypt($txtPassword);


        $user->save();
        if ($user->save()) {
            //Hiển thị thông báo check với điều kiện ngoài index
            alert()->success('Người dùng được cập nhật', 'Thành công');
        }
        if (Auth::user()->id == $user->id) {
            return redirect()->route('user.show', ['user' => Auth::user()->id])->with("update-success", "Sửa thông tin người dùng thành công");
        } else {
            return redirect('user')->with("update-success", "Sửa thông tin người dùng thành công");
        }
    }

    public function updaterole(Request $request)
    {

        $slbIdRole = $request->get("slbIdRole");
        $id = Auth::user()->id;

        $affected = DB::table('user')
            ->where('id', $id)
            ->update(['current_role' => $slbIdRole]);

        if ($affected) {
            //Hiển thị thông báo check với điều kiện ngoài index
            alert()->success('Vai trò được chọn', 'Thành công');
            return redirect()->route('user.show', ['user' => Auth::user()->id])->with("chooseRole-success", "Chọn vai trò thành công");
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        User::destroy($id);
        if (User::destroy($id)) {
            //Hiển thị thông báo check với điều kiện ngoài index
            alert()->success('Người dùng đã được xóa', 'Thành công');
        }
        return redirect()->to('user')->with('delete-success', 'Xóa thành công');
    }

    public function changeStatus(Request $request)
    {
        $user_id = $request->get('id');

        $user = User::find($user_id);
        if ($user) {
            $result = '';
            // thay doi trang thai cua ban ghi
            $status = $user->status;
            if ($status == 1) {
                $user->status = 0;
                $result = '<a class="fa fa-thumbs-down" style="color: red; font-size: 24px;;" onclick="changeStatus(' . $user_id . ')"/>';
            } else {
                $user->status = 1;
                $result = '<a class="fa fa-thumbs-up" style="color: green; font-size: 24px;;" onclick="changeStatus(' . $user_id . ')"/>';
            }
            $user->save();
            return $result;
        } else {
            return "-1";
        }
    }

    public function show_login()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $username = $request->get('txtUserName');
        $password = $request->get('txtPassword');

        if (Auth::attempt(['username' => $username, 'password' => $password, 'status' => 1])) {
            $user = Auth::user();
            if ($user->user_type == 1) {
                alert()->success('Chào mừng bạn đã trở lại', 'Thành công');
                return redirect()->to("/dashboard")->with('login-success', 'Xóa thành công');
            } elseif ($user->user_type == 2) {
                alert()->success('Chào mừng bạn đã trở lại', 'Thành công');
                return redirect()->to('/dashboard')->with('login-success', 'Xóa thành công');
            }
        } else {
            return view('login')->with("message", "Username hoặc Password không đúng");
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->to('/login');
    }

    public function show_dashboard_user()
    {
        return view('dashboard_user');
    }

    public function show_dashboard()
    {
        return view('dashboard');
    }

    public function choose_role()
    {
        $id_user = Auth::user()->id;
        $role = DB::table('roles')
            ->join('user', 'roles.id_user', '=', 'user.id')
            ->join('positions', 'roles.id_position', '=', 'positions.id')
            ->join('divisions', 'roles.id_division', '=', 'divisions.id')
            ->select('roles.id', 'roles.id_user', 'roles.id_position', 'roles.id_division', 'roles.created_at', 'roles.updated_at', 'roles.percentageOfRole', 'roles.start_time', 'roles.end_time', 'divisions.name_division', 'positions.name_position', 'user.username', 'user.fullname')
            ->where('roles.id_user', $id_user)->get();

        return view('user.show', compact('role'));
    }
}
