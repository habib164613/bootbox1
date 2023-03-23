<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Faker\Guesser\Name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Console\Migrations\StatusCommand;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $data['students']= Student::all();
        return view('student.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
        //dd($request->all());
        
        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'email' => 'required|email|unique:students,email,',
            'photo' => 'required|mimes:phg,jpg,jpeg',
            'accepeted'=>'accepted',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),

            ]);
        } else {

            $student = new Student;
            $student->name = $request->name;
            $student->email = $request->email;

            if ($request->hasFile('photo')) {
                $file = $request->file('photo');
                $extenttion = $file->getClientOriginalExtension();
                $fileName = time() . '.' . $extenttion;  //123456.jpeg,png,  
                $file->move('uploads/student-img', $fileName);

                //photo save in database

                $student->photo = $fileName;
            }

            $student->save();
            return response()->json(['status' => 200, 'message' => 'student create successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['student'] = Student::find($id);
        return view('student.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data['student'] = Student::find($id);
        return view('student.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'email' => 'required|email|unique:students,email,'.$id,
            'photo' => 'mimes:phg,jpg,jpeg',
            'accepeted'=>'accepted',

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->errors(),

            ]);
        } else {

            $student = Student::find($id);
            $student->name = $request->name;
            $student->email = $request->email;

            if ($request->hasFile('photo')) {

                $path = 'uploads/student_img/'. $student->photo;
                   if (File::exists($path)) {
                       File::delete($path);
                    }


                $file = $request->file('photo');
                $extenttion = $file->getClientOriginalExtension();
                $fileName = time() . '.' . $extenttion;  //123456.jpeg,png,  
                $file->move('uploads/student-img/', $fileName);

                //photo save in database

                $student->photo = $fileName;
            }

            $student->save();
            return response()->json(['status' => 200, 'message' => 'student Update successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);

        if ($student) {
            $student->delete();
            return response()->jason(['status'=>200,'message'=>'successrully deleted']);
        } else {
            return response()->jason(['status'=>400,'message'=>'your student Not found']);
        }
        
       
    }
}
