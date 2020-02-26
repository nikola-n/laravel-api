<?php

namespace App\Http\Controllers;
use App\Vehicle;

use Illuminate\Http\Request;

class VehiclesController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::all();

        return response()->json(['success'=>1, 'data'=>$vehicles]);
    }

    public function get($id)
    {
        $vehicle = Vehicle::where('id', $id)->first();

        if($vehicle)
            return response()->json(['success' => 1, 'data' => $vehicle]);

        return response()->json(['error' => 1, 'data' => 'Vehicle not Found']);
    }
    public function create()
    {
        return view('createVehicle');
    }
    public function store(Request $request){

        $validator = \Validator::make($request->all(), [
            'brand' => 'required|max:255',
            'model' => 'required|max:255',
            'plate_number'=> 'required|max:255',
            'insurance_date'=> 'required|date'
        ]);

        if ($validator->fails()) {
            $array =
            [
                'error' => 1,
                'data'  => $validator->messages()
            ];
            return response()->json($array);
        }

        $vehicle = new Vehicle();
        $vehicle->brand=$request->brand;
        $vehicle->model =$request->model;
        $vehicle->plate_number = $request->plate_number;
        $vehicle->insurance_date=$request->insurance_date;

        if($vehicle->save()){
            return response()->json(['success'=>1,'data'=>$vehicle]);
        }else {
            return response()->json(['error'=>1, 'data' => 'data not found']);
        }

    }
    public function edit($id)
    {
        return view('editVehicles', ['id'=>$id]);
    }
    public function update($id,Request $request){

        $validator = \Validator::make($request->all(), [
            'brand' => 'required|max:255',
            'model' => 'required|max:255',
            'plate_number'=> 'required|max:255',
            'insurance_date'=> 'required|date'
        ]);

        if ($validator->fails()) {
            $array =
            [
                'error' => 1,
                'data'  => $validator->messages()
            ];
            return response()->json($array);
        }

        $vehicle = Vehicle::find($id);
        if($vehicle){

            $vehicle->brand=$request->brand;
            $vehicle->model =$request->model;
            $vehicle->plate_number = $request->plate_number;
            $vehicle->insurance_date=$request->insurance_date;
            if($vehicle->save()){
                return response()->json(['success'=>1,'data'=>$vehicle]);
            }else {
                return response()->json(['error'=>1, 'data' => 'data not found']);
            }

    }
}
    public function destroy($id)
    {
        $vehicle = Vehicle::where('id', $id)->first();
        if($vehicle)
        {
            Vehicle::where('id', $id)->delete();
            return response()->json(['success'=>1]);
        }else
            return response()->json(['error'=>1,'data'=>'Vehicle Not Found']);

    }
}
