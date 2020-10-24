<?php

namespace App\Http\Controllers;

use App\Unit;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UnitController extends Controller
{
    private function unitNameExists($unitName){
        $unit= Unit::where('unit_name','=',$unitName)->first();
        if(!is_null($unit)){
            Session::flash('message','Unit Name '.$unit->unit_name.' already exists');
            return true;
        }
        return false;
    }

    private function unitCodeExists($unitCode){
        $unit= Unit::where('unit_code','=',$unitCode)->first();
        if(!is_null($unit)){
            Session::flash('message','Unit Code '.$unit->unit_code.' already exists');
            return true;
        }
        return false;
        
    }
    
    public function showAdd()
    {
        return view('admin.units.add_edit');
    }
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::paginate(env('PAGINATE_COUNT'));

        return view('admin.units.units')->with([
            'units' => $units,
            'showLinks' => true,
            ]);
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
        $request->validate([
            'unit_name' => 'required',
            'unit_code' => 'required',
        ]);
        
        
        $unitName=$request->input('unit_name');
        $unitCode=$request->input('unit_code');

        if($this->unitNameExists($unitName)){ 
             return redirect()->back();
        }
        if($this->unitCodeExists($unitCode)){
            return redirect()->back();
        }
        
        
        $unit = new Unit();
        $unit->unit_name = $request->input('unit_name');
        $unit->unit_code = $request->input('unit_code');
        $unit->save();
        Session::flash('message', 'the unit '.$unit->unit_name.' has been added');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        //
    }
    public function search(Request $request){
        
        $request->validate([
            'unit_search' => 'required'
        ]);
        $searchTerm = $request->input('unit_search');

        $units=Unit::where(
            'unit_name' , 'LIKE' , '%'.$searchTerm.'%'
        )->orWhere(
            'unit_code' , 'LIKE' , '%'.$searchTerm.'%'
        )->get();
        if(count($units) > 0) {
            return view('admin.units.units')->with([
                'units' => $units,
                'showLinks' => false,
            ]); 
        }
        Session::flash('message','Nothing Found !!');
        return redirect()->back();
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Unit $unit)
    {
        //
        
        $request->validate([
            'unit_code' => 'required',
            'unit_id' => 'required',
            'unit_name' => 'required',
        ]);

        $unitName=$request->input('unit_name');
        $unitCode=$request->input('unit_code');

        if($this->unitNameExists($unitName)){ 
            return redirect()->back();
       }
       if($this->unitCodeExists($unitCode)){
           return redirect()->back();
       }
        $unitID = intval($request->input('unit_id'));
        $unit = Unit::find($unitID);

        $unit->unit_name = $request->input('unit_name');
        $unit->unit_code = $request->input('unit_code');
        $unit->save();
        Session::flash('message','Unit '.$unit->unit_name.' has been apdated');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        if( is_null($request->input('unit_id')) || empty($request->input('unit_id')) ){
            Session::flash('message','Unit ID is required');
            return redirect()->back();  
        }
        
        $id=$request->input('unit_id');
        Unit::destroy($id);
        Session::flash('message', 'the unit has been deleted');
        return redirect()->back();
    }
}
