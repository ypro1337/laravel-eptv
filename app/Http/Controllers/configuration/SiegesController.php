<?php

namespace App\Http\Controllers\configuration;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\configuration\Sieges;
use Illuminate\Support\Str;

require_once app_path('Helpers/PermissionsHelper.php');

class SiegesController extends Controller
{

    public function index()
    {


      CreatePermissionsTable($table='sieges');

        $data['sieges']=Sieges::all();
        return view('configurations.sieges.index', $data);
    }

 
    public function create()
    {
        $siege = new Sieges;
		return view('configurations.sieges.create', compact('siege'));
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
        'designation' => 'required|string|unique:sieges',
              
        'adresse' => 'required|string',
      ]);

        $siege = new Sieges;

        $siege->designation = $request->designation;
        $siege->slug = $request->slug;

        
        $siege->adresse = $request->adresse;
        $siege->save();

       // $data['slug'] = Str::slug($data['designation'], '-');

       
		//Sieges::create($request->all());

		return to_route('sieges.index')->withSuccess('Siege successfully created.');        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     */
    public function edit($slug)
    {
      $siege = Sieges::where('slug', $slug)->first(); 
		return view('configurations.sieges.edit', compact('siege'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
 
    $siege = Sieges::where('slug', $slug)->first();  

		$data=$request->validate([
      'designation' => 'required|string|unique:sieges,designation,'.$siege->slug.',slug',
			'adresse' => 'required|string',
		]);

    $siege->slug = $request->slug;


     $siege->update($data);

		return to_route('sieges.index')->withSuccess('Data succcessfully updated.');   
  
  }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
    $siege = Sieges::where('slug', $slug)->first();  
    $siege->delete();
		return to_route('sieges.index')->withSuccess('Data successfully deleted.');        
    }
}
