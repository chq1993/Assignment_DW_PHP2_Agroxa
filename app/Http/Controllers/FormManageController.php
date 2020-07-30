<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Form;

class FormManageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $forms = DB::table('forms')->paginate(5);
        return view('form-manage.index', ['forms' => $forms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form-manage.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_form' => 'required|max:255',
            'description_form' => 'required|max:255'
        ]);

        $form = new Form([
            'name_form' => $request->get('name_form'),
            'description_form' => $request->get('description_form')
        ]);
        $form->save();
        return redirect('form-manage')->with('success', 'Phiếu tạo thành công !');
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
        $form = Form::find($id);
        return view('form-manage.edit', compact('form'));
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
        $request->validate([
            'name_form' => 'required|max:255',
            'description_form' => 'required|max:255'
        ]);
        $form = Form::find($id);
        $form->name_form = $request->get('name_form');
        $form->description_form = $request->get('description_form');
        $form->save();

        return redirect('form-manage')->with('success', 'Cập nhật mẫu phiếu thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $form = Form::find($id);
        $form->delete();
        return redirect('form-manage')->with('success', 'Xóa mẫu phiếu thành công !');
    }
}
