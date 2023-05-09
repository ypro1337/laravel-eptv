<?php

namespace App\Http\Controllers;

use App\Models\Affectation;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\configuration\Sieges;
use App\Models\configuration\Structures;

require_once app_path('Helpers/PermissionsHelper.php');
require_once app_path('Helpers/StructureUpdateHelper.php');
require_once app_path('Helpers/StructureAddHelper.php');

class AffectationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        CreatePermissionsTable($table='affectations');
        $affectations=Affectation::all();
        $structures = Structures::whereNull('parent_id')->get();
        return view('configurations.affectations.index', compact('affectations','structures'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $affectation=new Affectation;
        $structures = Structures::whereNull('parent_id')->get();
        $users = User::All();       

        return view('configurations.affectations.create', compact('affectation','structures','users'));  

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
            'affectation_date' => 'required|date',                 
            'user_id' => 'required',
            'structure_id' => 'required',
          ]);

    
            $affectation = new Affectation;
    
            $affectation->affectation_date = $request->affectation_date;
            $affectation->user_id = $request->user_id;            
            $affectation->structure_id = $request->structure_id;
            $affectation->save();
    
            return to_route('affectations.index')->withSuccess('affectation successfully created.');  
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Affectation  $affectation
     * @return \Illuminate\Http\Response
     */
    public function show(Affectation $affectation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Affectation  $affectation
     * @return \Illuminate\Http\Response
     */
    public function edit(Affectation $affectation)
    {
        $structures = Structures::whereNull('parent_id')->get();  
    
        $users=User::all();
        
        return view('configurations.affectations.edit', compact('structures', 'affectation','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Affectation  $affectation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Affectation $affectation)
    {

        $data=$request->validate([
            'affectation_date' => 'required|date',
            'user_id' => 'required',
            'structure_id' => 'required',
              ]);
      
          $affectation->affectation_date = $request->affectation_date;
          $affectation->user_id = $request->user_id;
          $affectation->structure_id = $request->structure_id;
          $affectation->update($data); 
          
          return to_route('affectations.index')->withSuccess('Data succcessfully updated.'); 

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Affectation  $affectation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Affectation $affectation)
    {
        $affectation->delete();
		return to_route('affectations.index')->withSuccess('affectation successfully deleted.');       
    }
}
