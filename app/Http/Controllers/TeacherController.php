<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Class_info;
use App\Models\ClassRoom;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Routine;

use Maatwebsite\Excel\Facades\Excel;
// use App\Exports\AttendanceExport;


class TeacherController extends Controller
{
    public function setRoutine(Request $req, $id){
        // $req->validate([
        //     'course-name' => 'required',
        //     'routine-time' => 'required|numeric'
        // ]);
        Routine::create([
            'course_code' => $req->input('course-name'),
            'teacher_id' => $id,
            'preferred_time' => $req->input('routine-time')
        ]);

        return \redirect()->back();

    }
    public function routine($id){
        $assignedCourses = Course::where('course_teacher', $id)->get();
        $routineInfos = Routine::select('preferred_time')->get();
        
        if(count($assignedCourses) == 0){
            return \redirect()->back()->withErrors('No courses found');
        }else{
        return view('teacher.routine', compact('assignedCourses', 'routineInfos'));
        }
    }
    public function emailForm($id){
        $teacher = Teacher::find($id);
        $email = $teacher['teacher_email'];
        
        return view('teacher.email', compact('email'));
    }

    public function emailUpdate($id, Request $req){
        $teacher = User::find($id);
        $password = $req->input('password');
        $email = $req->input('email');

        if(Hash::check($password, $teacher['password'])){
            $tea = Teacher::find($id);
            $tea->teacher_email = $email;
            $tea->save();
            return redirect()->back()->with('message','Email Updated Successfully');

        }else{
            return redirect()->back()->withErrors(['Invalid password']);
        }
    }

    public function export($id, $code){
        $data = Course::find($code);
        $dept = $data['course_dept'];
        $semester = $data['course_semester'];

        $attIds = [];
        $students = [];
        
        $dbStudents = Student::where([
            'student_dept' => $dept,
            'student_semester' => $semester
        ])->get();
        
        $attInfos = Attendance::where('course_code', $code)->distinct()->get(['student_id']);
        foreach($attInfos as $attInfo){
            array_push($attIds, $attInfo['student_id']);
        };
        
        foreach($dbStudents as $dbStudent){
            if(array_search($dbStudent['student_id'], $attIds)){
                $per = Attendance::where('student_id', $dbStudent['student_id'])
                        ->where('course_code', $code)
                        ->orderBy('date', 'desc')->first();
                
                $arr = [$dbStudent['student_id'], $dbStudent['student_name'], (int)$per['percentage'], (int)$per['result']];
                array_push($students, $arr);
            }else{
            
                $arr = [$dbStudent['student_id'], $dbStudent['student_name'], 0, 0];
                array_push($students, $arr);
            }
        };

        $html = '<table>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Attendance(%)</th>
                        <th>Marks</th>
                    </tr>';
        foreach ($students as $student) {
            $html.='<tr>
                        <td>'. $student[0] . '</td>
                        <td>'. $student[1] . '</td>
                        <td>'. $student[2] . '</td>
                        <td>'. $student[3] . '</td>';
        };
        $html.='</table>';

        $response = response($html, 200, [
            'Content-Type' => 'application/xls',
            'Content-Disposition' => 'attachment; filename="myfile.xls"',
        ]);

        return $response;
    }

    public function index($id){
        $teacher = Teacher::find($id);
        $name = $teacher['teacher_name'];
        return \view('teacher.index', compact('name'));
    }

    public function showCourses($id){
        $courses = Course::where('course_teacher', $id)->get();
        // dd($courses);
        return \view('teacher.courses', compact('courses'));

    }

    public function course($teacherId, $courseCode){
        $courseInfo = Course::find($courseCode);
        $prevClass = null;
        $currClass = null;
        $classCode = mt_rand(100000,900000);
        $rooms = ClassRoom::get();

        // dd($rooms);
        $prevClassInfo = Class_info::where('course_code', $courseCode)
                        ->orderBy('date', 'desc')->get();
        // dd($prevClassInfo);
        
        if(count($prevClassInfo) == 0){
            $prevClass = 0;
            $currClass = 1;
        }else{
            $prevClass = count($prevClassInfo);
            $currClass = $prevClass + 1;
        }

        return view('teacher.course', compact('courseInfo', 'currClass', 'classCode', 'rooms'));
    }

    public function courseSubmit(Request $req, $id, $code){
        // dd($req->input());

        date_default_timezone_set("Asia/Dhaka");
		$currentDate = date("Y-m-d h:i");

        Class_info::create([
            'class_code' => $req->input('class-code'),
            'class_num' => $req->input('current-class'),
            'course_code' => $code,
            'date' => $currentDate,
            'room_num' => $req->input('class-room'),
            'time_limit' => $req->input('time-limit')
        ]);

        return redirect()->back()->with('message', 'Class Created Successfully');
    }

    public function studentsInfo($id, $code, $dept, $semester){
        $attIds = [];
        $students = [];
        
        $dbStudents = Student::where([
            'student_dept' => $dept,
            'student_semester' => $semester
        ])->get();
        
        $attInfos = Attendance::where('course_code', $code)->distinct()->get(['student_id']);
        foreach($attInfos as $attInfo){
            array_push($attIds, $attInfo['student_id']);
        };
        
        foreach($dbStudents as $dbStudent){
            if(array_search($dbStudent['student_id'], $attIds)){
                $per = Attendance::where('student_id', $dbStudent['student_id'])
                        ->where('course_code', $code)
                        ->orderBy('date', 'desc')->first();
                
                $arr = [$dbStudent['student_id'], $dbStudent['student_name'], (int)$per['percentage'], (int)$per['result']];
                array_push($students, $arr);
            }else{
            
                $arr = [$dbStudent['student_id'], $dbStudent['student_name'], 0, 0];
                array_push($students, $arr);
            }
        };

        return view('teacher.studentsInfo', compact('students', 'code'));
    }

    public function studentInfo($teacherId, $code, $stuId){

        $classInfos = Class_info::where('course_code', $code)->get();
    
        return view('teacher.studentInfo', compact('classInfos', 'stuId'));
    }

    public function signup(){
        // dd('hell');
        return view('teacher.signup');
    }

    public function signupSubmit(Request $req, $teacherId){
        $newPass = $req->input('password');
        // dd($req->input());
        $oldPass = $req->input('old-password');
        $user = User::find($teacherId);
        if($user !== null){
            
            if(Hash::check($oldPass, $user['password'])){
                $req->validate([
                    'password' => ['required' , 'confirmed' , 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
                ]);

                if($user['pass_1'] ==null && $user['pass_2'] ==null && $user['pass_3'] ==null){
                    if(!Hash::check($newPass, $user['password'])){
                        User::find($teacherId)
                            ->update(['pass_1' => $user['password'], 'password' => Hash::make($newPass)]);
                        return redirect()->back()->with('message', 'Successfully updated');
                    }else{
                        return redirect()->back()->with('message', 'password is matching between last three password!');
                    }
                }elseif($user['pass_2'] == null && $user['pass_3'] == null){
                    if(!Hash::check($newPass, $user['password']) && !Hash::check($newPass, $user['pass_1'])){
                        User::find($teacherId)
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
                        User::find($teacherId)
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
                    User::find($teacherId)
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
