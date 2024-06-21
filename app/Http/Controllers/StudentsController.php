<?php

namespace App\Http\Controllers;

use App\Models\students;
use Exception;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function index(){
        $students = students::all();

        if($students->count()>0){
            $data = [
                'responseResult'=>200, 
                'data'=>$students,
                'message'=>'data Berhasil diambil',
    
            ];
            return response()->json($data,200);
        }else{
            $data = [
                'responseResult'=>404, 
                'data'=>$students,
                'message'=>'Something wrong',
    
            ];
            return response()->json($data,404);
        }
       
    }

    public function getById($id){
        try{
            $item = students::find($id);

            if(!$item)
            {
                return response()->json([
                    'responseResult'=>false,
                    'message'=>"Data tidak ditemukan"
                ]);
            };

            return response()->json([
                'responseResult'=>true,
                    'message'=>"Data ditemukan",
                    'data'=>$item
            ]);

        }catch(Exception $e){};
    }

    public function create(Request $request){
        try{
            $insert             = new students();
            $insert->name       = $request->name;
            $insert->email      = $request->email;
            $insert->course      = $request->course;
            $insert->phone      = $request->phone;
            $insert->save();
            return response()->json($insert,200);
        }catch(Exception $e)
        {
            return response()->json([
                'status'=>400,
                'message'=>$e,
            ]);
        }
    }
    
}
