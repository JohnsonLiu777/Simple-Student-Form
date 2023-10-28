<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

//Fetch data dari data base
class StudentController extends Controller
{
    public function index()
    {
        $student= Student::all();    //Object student


        if($student->count() > 0){
            return response()->json([                   //Jika data ada maka akan berjalan jika tidak maka akan muncul tidak ada record
                'status' => 200,
                'students' => $student
            ], 200);

        }else{
            return response()->json([
                'status' => 404,
                'messagge' => 'No record founds'
            ], 404);

        }
      
    }

    public function store(Request $request){                //Untuk mengelola input ke dalam data base api
        $validator = Validator::make($request->all() ,[
            'name' => 'required|string|max:191',
            'course' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|max:14',


        ]);

        if($validator->fails()){                            //Memvalidasi data yang masuk

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ],422);
        }else{

            $student =Student::create([                     //Bila tidak ada masalah maka request akan dimasukkan ke dalam data base
                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone,

            ]);

            if($student){
                return response()->json([
                    'status' => 200,
                    'message' => "Student Created Succesfully"
                ],200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => "Something Went Wrong!"
                ],500);
            }

        }
    }

    public function show($id){
        $student = Student::find($id);
        if($student){
            return response()->json([
                'status' => 200,
                'student' => $student
            ],200);
        }else{
            return response()->json([
                'status' => 400,
                'message' => "No Such Student Found!!"
            ],404);
        }
    }


    public function edit($id){

        $student = Student::find($id);
        if($student){
            return response()->json([
                'status' => 200,
                'student' => $student
            ],200);
        }else{
            return response()->json([
                'status' => 400,
                'message' => "No Such Student Found!!"
            ],404);
        }
    }

    public function update(Request $request,int $id){
        $validator = Validator::make($request->all() ,[
            'name' => 'required|string|max:191',
            'course' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|max:14',


        ]);

        if($validator->fails()){                            //Memvalidasi data yang masuk

            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ],422);
        }else{

            $student =Student::find($id);

           

            if($student){
                $student -> update([                     //Bila tidak ada masalah maka request akan dimasukkan ke dalam data base
                    'name' => $request->name,
                    'course' => $request->course,
                    'email' => $request->email,
                    'phone' => $request->phone,
    
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => "Student Update Succesfully"
                ],200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => "No Such Student found"
                ],404);
            }

        }
    }

    public function destroy($id)
    {
        $student= Student::find($id);
        if($student){
            $student->delete();
            return response()->json([
            'status' => 200,
            'message' => "Student deleted successfully"
        ],404); }
        else{
            return response()->json([
                'status' => 404,
                'message' => "No Such Student found"
            ],404);

        }

    }

    }



