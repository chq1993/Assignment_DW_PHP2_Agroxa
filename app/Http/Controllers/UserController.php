<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


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
    public function store(Request $request)
    {

        //Hiển thị thông báo check với điều kiện ngoài index
        alert()->success('Người dùng được thêm mới', 'Thành công');

        $txtUserName = $request->get("txtUserName");
        $txtFullName = $request->get("txtFullName");
        $dateBirthday = $request->get("dateBirthday");
        $txtEmail = $request->get("txtEmail");
        $txtAddress = $request->get("txtAddress");
        $txtPhone = $request->get("txtPhone");
        $txtPassword = $request->get("txtPassword");


        $mota = $request->get("mota");

        $obj = new User([
            'username' => $txtUserName,
            'fullname' => $txtFullName,
            'birthday' => $dateBirthday,
            'email' => $txtEmail,
            'address' => $txtAddress,
            'phone' => $txtPhone,
            'status' => 1,
            'password' => bcrypt($txtPassword)
        ]);

        $obj->save();
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
        //Hiển thị thông báo check với điều kiện ngoài index
        alert()->success('Người dùng được cập nhật', 'Thành công');

        $user = User::find($id);

        $txtUserName = $request->get("txtUserName");
        $txtFullName = $request->get("txtFullName");
        $dateBirthday = $request->get("dateBirthday");
        $txtAddress = $request->get("txtAddress");
        $txtEmail = $request->get("txtEmail");
        $txtPhone = $request->get("txtPhone");


        $user->username = $txtUserName;
        $user->fullname = $txtFullName;
        $user->birthday = $dateBirthday;
        $user->address = $txtAddress;
        $user->email = $txtEmail;
        $user->phone = $txtPhone;


        $user->save();
        return redirect()->to('user')->with("update-success", "Sửa thông tin người dùng thành công");
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
        alert()->success('Người dùng đã được xóa', 'Thành công');

        User::destroy($id);
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
            return redirect()->to("/dashboard");
        } else {
            return view('login')->with("message", "Username hoặc Password không đúng");
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->to('/login');
    }

    public function show_dashboard()
    {
        return view('dashboard');
    }
}
