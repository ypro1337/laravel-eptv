<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\EmployeeDetail;
use Illuminate\Support\Facades\Auth;

class EmployeeDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\EmployeeDetail  $employeeDetail
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeDetail $employeeDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeDetail  $employeeDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeDetail $employeeDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeDetail  $employeeDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeDetail $employeeDetail)
    {


        $this->validate($request, [
            'nom'=>'required|string|max:60',
            'prenom'=>'required|string|max:40',
            'matricule' => 'required|string|unique:EmployeeDetail,matricule,' . $employeeDetail->id_user,
            'genre'=>'required|string',
            'date_naissance'=>'required|date',
            'lieux_naissance'=>'required|string',
            'phone'=>'required|digits:9',
            'nin'=>'required|digits:18|unique:EmployeeDetail,nin,' . $employeeDetail->id_user,
            'cnas'=>'required|digits:10|unique:EmployeeDetail,cnas,' . $employeeDetail->id_user,
            'date_recrutement'=>'required|date',
        ]);

        $user=User::findOrfail(Auth::user()->id);

        $user->update([
            'nom'->$request->nom,
            'prenom'->$request->prenom,
            'matricule'->$request->matricule,
        ]);

        $user->employeeDetail()->update([
            'user_id'->$user['id'],
            'genre'->$request->genre,
            'date_naissance'->$request->date_naissance,
            'lieux_naissance'->$request->lieux_naissance,
            'phone'->$request->phone,
            'nin'->$request->nin,
            'cnas'->$request->cnas,
            'date_recrutement'->$request->date_recrutement,
        ]);

        return redirect('empoyeedetail')->with('message','Employee Details Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeDetail  $employeeDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeDetail $employeeDetail)
    {
        //
    }
}
