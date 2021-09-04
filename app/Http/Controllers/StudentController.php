<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\User;
use App\Models\Class_info;
use App\Models\ClassRoom;
use App\Models\Attendance;


class StudentController extends Controller
{
    public function emailForm($id){
        $student = Student::find($id);
        $email = $student['student_email'];
        
        return view('student.email', compact('email'));
    }

    public function emailUpdate($id, Request $req){
        $student = User::find($id);
        $password = $req->input('password');
        $email = $req->input('email');

        if(Hash::check($password, $student['password'])){
            $stu = Student::find($id);
            $stu->student_email = $email;
            $stu->save();
            return redirect()->back()->with('message','Email Updated Successfully');

        }else{
            return redirect()->back()->withErrors(['Invalid password']);
        }
    }

    public function index($id){
        $student = Student::find($id);
        $name = $student['student_name'];
        return \view('student.index', compact('name'));
    }
    public function result($id){
        $infos = [];
        $classCount = 0;
        $student = Student::find($id);

        $courses = Course::where('course_dept', $student['student_dept'])
                        ->where('course_semester', $student['student_semester'])
                        ->get();
        // dd($courses);
        foreach ($courses as $course) {
            $class = Class_info::where('course_code', $course['course_code'])
                    ->orderBy('date', 'desc')->get();
            
            if(count($class) == 0){
                $currClass = 0;
            }else{
                $currClass = $class[0];

            }
            $classCount = count($class);
            
            $attInfo = Attendance::where('course_code', $course['course_code'])
                        ->where('student_id', $id)->orderBy('date', 'desc')->get();
            if(count($attInfo) == 0){
                array_push($infos, [$course['course_code'], $course['class_number'], 0, 0, 0]);
            }else{
                $present = count($attInfo);
                $absent = (int)$currClass['class_num'] - $present;
                $mark = $attInfo[0]['result'];

                array_push($infos, [$course['course_code'], $course['class_number'], $absent, $present, $mark]);
            }

        }

        // dd($infos);
        return view('student.result', compact('infos'));
    }
    public function showCourses($id){
        $student = Student::find($id);
        $courses = Course::where([
            'course_dept' => $student['student_dept'],
            'course_semester' => $student['student_semester'],
        ])->get();
        return \view('student.courses', \compact('courses'));
    }
    public function course($id, $code){
        // dd($code);
        $studentId = $id;
        $course = Course::find($code);
        $classInfo = Class_info::where('course_code', $course['course_code'])
                ->orderBy('date', 'desc')
                ->first();
        if($classInfo !== null){
        // dd($classInfos);
           
            $roomInfo = ClassRoom::find($classInfo['room_num']);

        }else{

            $classInfo = null;
            $roomInfo = null;
        }
        return \view('student.course', \compact('studentId', 'course', 'classInfo', 'roomInfo') );
    
    }


    public function courseSubmit(Request $req, $id, $code){

        $formLat = $req->input('latitude');
        $formLon = $req->input('longitude');
        $formRadious = $req->input('radious');

        $classInfo = Class_info::where('course_code', $code)
                    ->orderBy('date', 'desc')
                    ->first();
        
        if($classInfo == null){
            return redirect()->back()->withErrors(['No Class Found']);
            
        }else{
            date_default_timezone_set("Asia/Dhaka");

            $studentDate = strtotime(date("Y-m-d h:i"));
            
            $classDate = strtotime($classInfo['date']) + ((double)$classInfo['time_limit'] * 60);

            if($studentDate < $classDate){
                if(strpos($classInfo['student_id'], $id) !== false){
                    return redirect()->back()->withErrors(['Your Attendance is already given']);
    
                }else{
                    $oldStuIds = null;
                    $newStuIds = null;
    
                    if($classInfo['student_id'] == null){
                        $newStuIds = $id;
                    }else{
                        $oldStuIds = $classInfo['student_id'];
                        $newStuIds = $oldStuIds . " " . $id;
                    }
                    $classInfo->update([
                        'student_id' => $newStuIds
                    ]);
                    
                    // make attandance 
                    $classNum = (int)$req->input('class-num');
                    $numberOfAtt = substr_count($classInfo['student_id'], $id);
                    $attPercent = ($numberOfAtt / $classNum) * 100;

                    if($attPercent < 60){
                        $marks = 0;
                    }else if($attPercent >= 60 && $attPercent <=65){
                        $marks = 4;
                    }else if($attPercent >= 65 && $attPercent <=70){
                        $marks = 5;
                    }else if($attPercent >= 70 && $attPercent <=75){
                        $marks = 6;
                    }else if($attPercent >= 75 && $attPercent <=80){
                        $marks = 7;
                    }else if($attPercent >= 80 && $attPercent <=85){
                        $marks = 8;
                    }else if($attPercent >= 85 && $attPercent <=90){
                        $marks = 9;
                    }else if($attPercent >= 90){
                        $marks = 10;
                    }
                    $totalClassNum = $req->input('total-class-num');
                    Attendance::create([
                        'class_code' => $classInfo['class_code'],
                        'course_code' => $code,
                        'current_class_num' => $classNum,
                        'percentage' => $attPercent,
                        'result' => $marks,
                        'student_id' => $id,
                        'total_class_num' => $totalClassNum
                    ]);

                    return redirect()->back()->with('message', 'Attendance Done');
                }
            }else{
                return redirect()->back()->withErrors(['Attendance Time Out']);
            }
        }
    }

    public function signup(){
        return view('student.signup');
    }

    public function signupSubmit(Request $req, $studentId){
        $newPass = $req->input('password');
        // dd($req->input());
        $oldPass = $req->input('old-password');
        $user = User::find($studentId);
        if($user !== null){
            // dd($user);
            if(Hash::check($oldPass, $user['password'])){
                $req->validate([
                    'password' => ['required' , 'confirmed' , 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
                ]);

                if($user['pass_1'] ==null && $user['pass_2'] ==null && $user['pass_3'] ==null){
                    if(!Hash::check($newPass, $user['password'])){
                        User::find($studentId)
                            ->update(['pass_1' => $user['password'], 'password' => Hash::make($newPass)]);
                        return redirect()->back()->with('message', 'Successfully updated');
                    }else{
                        return redirect()->back()->with('message', 'password is matching between last three password!');
                    }
                }elseif($user['pass_2'] == null && $user['pass_3'] == null){
                    if(!Hash::check($newPass, $user['password']) && !Hash::check($newPass, $user['pass_1'])){
                        User::find($studentId)
                            ->update([
                                'pass_2' => $user['pass_1'], 
                                'pass_1' => $user['password'],
                                'password' => Hash::make($newPass),
                                ]);

                        
                        return redirect()->back()->with('message', 'Successfully updated');
                    }else{
                        return redirect()->back()->with('message', 'password is matching between last three password!');

                    }
                }elseif($user['pass_3'] == null){
                    if (!Hash::check($newPass, $user['password']) && !Hash::check($newPass, $user['pass_1']) && !Hash::check($newPass, $user['pass_2'])) {
                        User::find($studentId)
                            ->update([
                                'pass_3' => $user['pass_2'], 
                                'pass_2' => $user['pass_1'],
                                'pass_1' => $user['password'],
                                'password' => Hash::make($newPass),
                                ]);
                        return redirect()->back()->with('message', 'Successfully updated');
                    } else {
                        return redirect()->back()->with('message', 'password is matching between last three password!');

                    }
                
                }elseif(!Hash::check($newPass, $user['password']) && !Hash::check($newPass, $user['pass_1']) && !Hash::check($newPass, $user['pass_2']) && !Hash::check($newPass, $user['pass_3'])){
                    User::find($studentId)
                            ->update([
                                'pass_3' => $user['pass_2'], 
                                'pass_2' => $user['pass_1'],
                                'pass_1' => $user['password'],
                                'password' => Hash::make($newPass),
                                ]);
                    return redirect()->back()->with('message', 'Successfully updated');
                }


            }else{
                return redirect()->back()->with('message', 'Invalid User Password');
            }
        }else{
            return redirect()->back()->with('message', 'Invalid User');
            
        }
    }


}
