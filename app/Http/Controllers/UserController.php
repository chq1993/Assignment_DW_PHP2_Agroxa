<?php

namespace App\Http\Controllers;

use App\User;
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
        $txtUserName = $request->get("txtUserName");
        $txtFullName = $request->get("txtFullName");
        $txtEmail = $request->get("txtEmail");
        $txtAddress = $request->get("txtAddress");
        $txtPhone = $request->get("txtPhone");
        $txtPassword = $request->get("txtPassword");
        
        
        $mota = $request->get("mota");
        
        $obj= new User([
            'username'=>$txtUserName,
            'fullname'=>$txtFullName,
            'email'=>$txtEmail,
            'address'=>$txtAddress,
            'phone'=>$txtPhone,
            'status'=>1,
            'password'=>bcrypt($txtPassword)
        ]);
        
        if ($request->hasFile("txtAnhdd")){
            if ($request->file("txtAnhdd")->isValid()){
                $imagePath = $request->file('file');
                $imageName = $txtUserName.'_'.time().'.'.$request->txtAnhdd->extension();  
                $request->txtAnhdd->move(public_path('uploads'), $imageName);
                $path_image = "uploads/".$imageName;
                $obj->image= $path_image;
            }
        }


        $obj->save();
        //return view('user.create')->with("message", "Thêm mới thành công");
        return Redirect()->to('user/create')->with('message', 'Thêm mới người dùng thành công!');

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
        $user = User::find($id);
        
        $txtUserName = $request->get("txtUserName");
        $txtFullName = $request->get("txtFullName");
        $txtAddress = $request->get("txtAddress");
        $txtEmail = $request->get("txtEmail");
        $txtPhone = $request->get("txtPhone");
        $txtAnhdd = $request->get("txtAnhdd");

        
        $user->username= $txtUserName;
        $user->fullname= $txtFullName;
        $user->address= $txtAddress;
        $user->email= $txtEmail;
        $user->phone= $txtPhone;
        $user->image= $txtAnhdd;
        
        
        $user->save();
        return redirect()->to('user/'.$id.'/edit')->with("message", "Sửa thông tin người dùng thành công");
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
        return redirect()->to('/user')->with('message','Xóa thành công');
    }

    public function changeStatus(Request $request){
        $user_id = $request->get('id');
        
        $user = User::find($user_id);
        if ($user){
            $result = '';
            // thay doi trang thai cua ban ghi
            $status = $user->status;
            if ($status == 1){
                $user->status = 0;
                $result = '<a class="fa fa-thumbs-down" style="color: red; font-size: 24px;;" onclick="changeStatus('.$user_id.')"/>';
            } else {
                $user->status = 1;
                $result = '<a class="fa fa-thumbs-up" style="color: green; font-size: 24px;;" onclick="changeStatus('.$user_id.')"/>';
            }
            $user->save();
            return $result;
        } else {
            return "-1";
        }
    }
    public function ajax_update(Request $request){
        $id = $request->get("id");
        $user = User::find($id);
        
        $txtUserName = $request->get("txtUserName");
        $txtFullName = $request->get("txtFullName");
        $txtAddress = $request->get("txtAddress");
        $txtEmail = $request->get("txtEmail");
        $txtPhone = $request->get("txtPhone");
        $txtAnhdd = $request->get("txtAnhdd");

        
        try {
            $user->username= $txtUserName;
            $user->fullname= $txtFullName;
            $user->address= $txtAddress;
            $user->email= $txtEmail;
            $user->phone= $txtPhone;
            $user->image= $txtAnhdd;


            $user->save();
            return "<div class='alert alert-success'>Sửa thành công</div>";
        } catch (\Exception $ex){
            return "<div class='alert alert-danger'>Sửa thất bại</div>";
        }
        
        
    }
}
