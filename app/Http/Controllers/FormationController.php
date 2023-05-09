<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\User;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        CreatePermissionsTable($table='formations');
        $formations=Formation::all();
        return view('configurations.formations.index', compact('formations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $formation=new Formation;
        $users = User::All();
        $formations=Formation::all();
        return view('configurations.formations.create', compact('formation','formations','users'));

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
            'designation' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'user_id' => 'required',
          ]);

          $user=User::findOrFail($request->user_id);

          $formation = new Formation;
          $formation->date_debut=$request->date_debut;
          $formation->date_fin=$request->date_fin;
          $formation->designation=$request->designation;
          $formation->source=ucfirst($user->nom)." ".ucfirst($user->prenom);
          $formation->save();

          return to_route('formations.index')->withSuccess('formations successfully created.');
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
    public function edit(Formation $formation)
    {
        $users=User::all();

        return view('configurations.formations.edit', compact('formation','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formation $formation)
    {
        $data=$request->validate([
            'designation' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'user_id' => 'required',
          ]);
          $user=User::findOrFail($request->user_id);

          $formation->date_debut=$request->date_debut;
          $formation->date_fin=$request->date_fin;
          $formation->designation=$request->designation;
          $formation->source=ucfirst($user->nom)." ".ucfirst($user->prenom);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formation $formation)
    {
        $formation->delete();
		return to_route('formations.index')->withSuccess('formation successfully deleted.');
    }
}
