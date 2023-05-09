<?php

namespace App\Http\Controllers\configuration;

use App\Http\Controllers\Controller;
use App\Models\configuration\Structures;
use App\Models\configuration\Sieges;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreStructuresRequest;
use App\Http\Requests\UpdateStructuresRequest;
use Spatie\Permission\Models\Permission;


use Illuminate\Http\Request;
require_once app_path('Helpers/StructureUpdateHelper.php');
require_once app_path('Helpers/StructureAddHelper.php');


class StructuresController extends Controller
{





    public function index()
    {


        $structures = Structures::with('children')->with('parent')->get();

        return view('configurations.structures.index', compact('structures'));    
    }


    public function create()
    {
        $structures = Structures::whereNull('parent_id')->get();

        $sieges=Sieges::all();

        return view('configurations.structures.create', compact('structures','sieges'));    }

 
    public function store(StoreStructuresRequest $request)
    {
        //$structure = Structures::create($request->all());


            $structure = new Structures;    
            $structure->name = $request->name;            
            $structure->slug = $request->slug;            
            $structure->description = $request->description;
            $structure->is_enabled = $request->get('is_enabled') == 'on' ? 1 : 0;
            $structure->parent_id = $request->parent_id;
            if($structure->parent_id==null){$structure->position=0;}
            if($structure->parent_id<>null){$structure->position=$request->position+1;}

            //$structure->position = $request->position;
            $structure->siege_id = $request->siege_id;

            $structure->save();
            
            

        return redirect()->route('structures.index')->with('success', 'Structure created successfully.');
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
    $structure = Structures::where('slug', $slug)->first();  

    //$structures = Structures::whereNull('parent_id')->get();


    $structures = Structures::where('slug', '<>', $slug)->whereNull('parent_id')->get();
    $sieges=Sieges::all();
    //dd($structures);
    return view('configurations.structures.edit', compact('structures', 'structure','sieges'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     */
    public function update(UpdateStructuresRequest $request, $slug)
    {

    
        $structure = Structures::where('slug', $slug)->first(); 


 /*        $collection = collect();
        do {
            $collection->push($structure->parent);
            $structure = $structure->parent;
        } while($structure->parent()->exists());

        dd(count($collection)); */

    
        $structure->name = $request->input('name');
        $structure->description = $request->input('description');
        $structure->slug = $request->slug;
        $structure->parent_id = $request->input('parent_id');
        $structure->siege_id = $request->siege_id;
        $structure->is_enabled = $request->get('is_enabled') == 'on' ? 1 : 0;
        $structure->position = $request->position;


    
        $structure->save();
    
       return redirect()->route('structures.index')->with('success', 'Structure updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $slug
     */
    public function destroy($slug)
    {
        $structure = Structures::where('slug', $slug)->first();  

        $structure->delete();

        return redirect()->route('structures.index')->with('success', 'Structure deleted successfully.');
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function autoCompleteSearch(Request $request): JsonResponse
    {
        $data = [];

        if($request->filled('q')){
            $data = Structures::select("name", "id")
                        ->where('name', 'LIKE', '%'. $request->get('q'). '%')
                        ->get();
        }
        
        return response()->json($data);
    }
}
