<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeerAssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $user = auth()->user();

        $userDb = User::find($user->id);

        $other = User::with('positions', 'divisions')
            ->where('id', '!=', $user->id)
            ->get();

        // var_dump($userDb->positions()->pluck('level_position')[0]);

        $other = array_filter($other->toArray(), function ($item) use ($userDb) {
            return $userDb->positions()->pluck('level_position')[0] == $item['positions'][0]['level_position'] &&
                $item['divisions'][0]['id']  == $userDb->divisions()->pluck('id_division')[0];
        });

        // foreach($other as $item){
        //     var_dump($item);
        // }
        var_dump($other);

        return;

        // $role = Role::select('roles.*')->where('id_user', $user->id)->first();
        // $id_positionLogin = $role->id_position;
        // $id_divisionLogin = $role->id_division;
        // $listRoleReview = Role::where([
        //     ['id_position', '=', $id_positionLogin],
        //     ['id_division', '=', $id_divisionLogin]
        // ])
        //     ->get();

        // $listUser = [];
        // for ($i = 0; $i < count($listRoleReview); $i++) {
        //     $listUser[] = User::where([
        //         ['id', '=', $listRoleReview[$i]->id_user]
        //     ])
        //         ->get();
        // }

        // dd($listUser);

        return view('peer-assessment.create', [
            'user' => $userDb,
            'other' => $other
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
