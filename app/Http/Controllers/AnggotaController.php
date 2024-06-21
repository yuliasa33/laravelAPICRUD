<?php

namespace App\Http\Controllers;
use App\Models\Anggota;
use Exception;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index(){
        $data = Anggota::all();
        
        try{
            return response()->json([
                "responseResult"=>true,
                "message"=>"Sukses",
                "data"=>$data
            ],200);
        }catch(Exception $e){
            return response()->json([
                'responseResult'=>false,
                "message"=>$e
            ],400);
        }
    }

    public function addAnggota(Request $request){
        try{
            $insert =new Anggota();
            $insert->nama =$request->nama;
            $insert->alamat =$request->alamat;
            $insert->phone =$request->phone;
            $insert->email =$request->email;
            $insert->jenis_kelamin =$request->jenis_kelamin;
            $insert->save();

            return response()->json([
                'responseResult'=>true,
                'message'=>'Berhasil Simpan data',
            ],200);

        }catch(Exception $e){
            return response()->json([
                "responseResult"=>false,
                "message"=>$e
            ],400);
        }
    }

    public function getById($id){
        try{
            $getData = Anggota::find($id);
            if(!$getData){
                return response()->json([
                    'responseResult'=>false,
                'message'=>"Data ditemukan",
                ],400);
            }
            return response()->json([
                'responseResult'=>true,
                'message'=>"Data ditemukan",
                'data'=>$getData
            ],200);
        }catch(Exception $e){
            return response()->json([
                'responseResult'=>false,
                'message'=>$e
            ],400);
        }
    }

    public function EditAnggota(Request $request,$id){
        try{
            $getData = Anggota::findOrFail($id);

            // Validate the request data
            $validatedData = $request->validate([
                'id' => 'required',
                'nama' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'phone' => 'required|string|max:15',
                'email' => 'required|string|max:255',
                'jenis_kelamin' => 'required|string|in:Laki-laki,Perempuan',
            ]);

            // Update the resource with the validated data
            $getData->update($validatedData);

            return response()->json([
                'responseResult' => true,
                'message' => 'Data Berhasil di Update',
                'statusCode' => 1,
                'data' => $getData
            ], 200);
        

        }catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'responseResult' => false,
                'message' => 'Validation error',
                'errors' => $e->errors(),
                'statusCode' => 422
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'responseResult' => false,
                'message' => $e->getMessage(),
                'statusCode' => 400
            ], 400);
        }
    }

    public function DeleteAnggota($id){
        try{
            $data = Anggota::findOrFail($id);

            $data->delete();
            return response()->json([
                'responseResult'=>true,
                'message'=>'Data Berhasil di hapus'
            ],200);
        }catch(Exception $e){
            return response()->json([
                'responseResult'=>false,
                'message'=>$e->getMessage()()
            ],400);
        }
    }

}
