<?php

namespace App\Http\Controllers;

use App\Models\Authentication;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class authenticationController extends Controller
{
    //
    public function authentication(Request $request){
        $data   = new Authentication();
        $data->name  = $request->name;
        $data->password = $request->password;
        $userData = Authentication::all();
         $isNameMatched = $userData[0]['name'] == $data->name;
        $isPasswordMatched = $userData[0]['password'] == $data->password;
         try{
             $userData = Authentication::all();
              if($isNameMatched && $isPasswordMatched){
                $randomString = Str::random(16);
                  return response()->json([
                      'responseResult'=>true,
                      'message'=>'Berhasil Login',
                      'token'=>$randomString
                  ]);
              }else{
                  return response()->json([
                      'responseResult'=>false,
                      'message'=>'Something Wrong'
                  ],400);
              }
         }catch(Exception $e){
             return response()->json([
                   'responseResult'=>false,
                     'message'=>$e
             ]);
         };
    }
}
