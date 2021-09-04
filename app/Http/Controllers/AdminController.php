<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\User;
use App\Models\ClassRoom;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\TeachersImport;
use App\Imports\StudentsImport;
use App\Imports\CoursesImport;
use App\Imports\UsersStudentImport;
use App\Imports\UsersTeacherImport;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;

class AdminController extends Controller
{
    public function doteacherPriority(Request $req){
        $dbTeacher = Teacher::where('priority', $req->input('priority'))
                            ->where('teacher_username', '!=' ,$req->input('name'))
                            ->get();

        if(count($dbTeacher) == 0){
            Teacher::find($req->input('name'))
                     ->update(['priority' => $req->input('priority')]);
            
            return redirect()->back()->with('message','This priority is successfully updated');
            
        }else{
            return redirect()->back()->withErrors('This priority is already given');

        }
    }
    public function teacherPriority(){
        $teachers = Teacher::all();
    
        return view('admin.teacherPriority', compact('teachers'));
    }
    public function browseCourseInfo(){
        return view('admin.browseInfo.course');
    }
    public function browseCourseInfoPost(Request $req){
        // dd($req->all());
        $courses = Course::where('course_dept', $req->input('dept'))->get();
        // dd($courses);
        if(count($courses) == 0){
            return \redirect()->back()->withErrors('No Courses Found');
        }else{
            return view('admin.browseInfo.course', compact('courses'));
            
        }

    }
    public function passwordReset(){
        return view('admin.passwordReset');
    }
    public function passwordResetSubmit($id, Request $req){
        $newPass = $req->input('password');
        // dd($req->input());
        $oldPass = $req->input('old-password');
        $user = User::find($id);
        if($user !== null){
        
            if(Hash::check($oldPass, $user['password'])){
                $req->validate([
                    'password' => ['required' , 'confirmed' , 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'],
                ]);

                if($user['pass_1'] ==null && $user['pass_2'] ==null && $user['pass_3'] ==null){
                    if(!Hash::check($newPass, $user['password'])){
                        User::find($id)
                            ->update(['pass_1' => $user['password'], 'password' => Hash::make($newPass)]);
                        return redirect()->back()->with('message', 'Successfully updated');
                    }else{
                        return redirect()->back()->with('message', 'password is matching between last three password!');
                    }
                }elseif($user['pass_2'] == null && $user['pass_3'] == null){
                    if(!Hash::check($newPass, $user['password']) && !Hash::check($newPass, $user['pass_1'])){
                        User::find($id)
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
                        User::find($id)
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
                    User::find($id)
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
    public function index(){
        
        return \view('admin.index');
    }
    public function downloadTeacherExcel(){
        $file = public_path()."/sample/teachers-info.xlsx";
        $headers = array('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        return response()->download($file, 'teachers-info.xlsx',$headers);
    }

    public function downloadStudentExcel(){
        $file = public_path()."/sample/students-info.xlsx";
        $headers = array('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        return response()->download($file, 'students-info.xlsx',$headers);
    }

    public function downloadCourseExcel(){
        $file = public_path()."/sample/courses-info.xlsx";
        $headers = array('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        return response()->download($file, 'courses-info.xlsx',$headers);
    }

    public function upload(){
        return \view('admin.upload');
    }
    public  function uploadTeacher(Request $req){
        $req->validate([
            'teacherFile' => 'mimes:xlsx,xls,csv'
        ]);
        $file = $req->file('teacherFile')->store('uploads');
        // dd($file);
        (new TeachersImport)->import($file);
        (new UsersTeacherImport)->import($file);

        return \back()->withStatus("Excel file uploaded");
    }

    public  function uploadStudent(Request $req){
        $req->validate([
            'studentFile' => 'mimes:xlsx,xls,csv'
        ]);
        $file = $req->file('studentFile')->store('uploads');
        (new StudentsImport)->import($file);
        (new UsersStudentImport)->import($file);
        return \back()->withStatus("Excel file uploaded");
    }

    public  function uploadCourse(Request $req){
        $req->validate([
            'courseFile' => 'mimes:xlsx,xls,csv'
        ]);
        $file = $req->file('courseFile')->store('uploads');
        (new CoursesImport)->import($file);
        return \back()->withStatus("Excel file uploaded");
    }

    public function addinfo(){
        return \view('admin.addInfo.addinfo');
    }
    public function addStudent(){
        return \view('admin.addInfo.addStudent');
    }
    public function postStudent(Request $req){
        $query = Student::create([
            'student_id' => $req->input('student-id'),
            'student_name' => $req->input('student-name'),
            'student_username' => $req->input('student-id'),
            'student_dept' => $req->input('dept'),
            'student_email' => $req->input('student-email'),
            'student_semester' => $req->input('student-semester'),
            'student_session' => $req->input('student-session'),
            'student_password' => Hash::make($req->input('student-id'))
        ]);
        $user = User::create([
            'username' => $req->input('student-id'),
            'role' => 'student',
            'password' => Hash::make($req->input('student-id')),
        ]);

        if($query->wasRecentlyCreated && $user->wasRecentlyCreated){
            return \redirect()->back()->with('message', 'Student Added Successfully');

        }else{
            return \redirect()->back()->withErrors(['Something went wrong']);

        }
    }
    public function addTeacher(){
        return \view('admin.addInfo.addTeacher');
    }
    public function postTeacher(Request $req){
        // dd($req->input());
        $query = Teacher::create([
            'teacher_name' => $req->input('teacher-name'),
            'teacher_username' => $req->input('teacher-username'),
            'teacher_dept' => $req->input('dept'),
            'teacher_email' => $req->input('teacher-email'),
            'teacher_phone' => $req->input('phone-number'),
            'teacher_password' => Hash::make($req->input('teacher-username'))
        ]);
        $user = User::create([
            'username' => $req->input('teacher-username'),
            'role' => 'teacher',
            'password' => Hash::make($req->input('teacher-username')),
        ]);

        if($query->wasRecentlyCreated && $user->wasRecentlyCreated){
            return \redirect()->back()->with('message', 'Teacher Added Successfully');

        }else{
            return \redirect()->back()->withErrors(['Something went wrong']);

        }
    }
    public function addCourse(){
        return \view('admin.addInfo.addCourse');
    }
    public function postCourse(Request $req){
        // dd($req->input());
        $query = Course::create([
            'class_number' => $req->input('course-class'),
            'course_code' => $req->input('course-code'),
            'course_credit' => $req->input('course-credit'),
            'course_dept' => $req->input('dept'),
            'course_name' => $req->input('course-name'),
            'course_semester' => $req->input('course-semester')
        ]);

        if($query->wasRecentlyCreated){
            return \redirect()->back()->with('message', 'Course Added Successfully');

        }else{
            return \redirect()->back()->withErrors(['Something went wrong']);

        }
    }
    public function addClassRoom(){
        return \view('admin.addInfo.addClassRoom');
    }
    public function postClassRoom(Request $req){
        // dd($req->input());
        $query = ClassRoom::create([
            'room_number' => $req->input('room-num'),
            'latitude' => $req->input('dept'),
            'longitude' => $req->input('latitude'),
            'radious' => $req->input('longitude'),
            'room_dept' => $req->input('dept'),
        ]);
        if($query->wasRecentlyCreated){
            return \redirect()->back()->with('message', 'Room Added Successfully');

        }else{
            return \redirect()->back()->withErrors(['Something went wrong']);

        }
    }





    public function deleteinfo(){
        return \view('admin.deleteInfo.deleteinfo');
    }

    public function deleteStudent(){
        return view('admin.deleteInfo.deleteStudent');
    }
    public function deleteStudentData(Request $req){
        $id = $req->input('student-id');
        $stu = Student::where('student_id', $id);
        $stu->delete();
        $user = User::find($id);
        $user->delete();
        return redirect()->route('deleteStudent.admin')->with('message', 'Student Deleted Successfully');
    }
    public function searchStudent(Request $req){
        $query = $req->input('search-student');
        $stu = Student::query()
        ->where('student_id', 'LIKE', "%{$query}%")
        ->get();
        if(count($stu) == 0){
            return \redirect()->back()->withErrors(['No Student Found']);
        }else{
            return view('admin.deleteInfo.deleteStudentDetails', compact('stu'));
        }
    }

    public function deleteTeacher(){
        return view('admin.deleteInfo.deleteTeacher');
    }
    public function deleteTeacherData(Request $req){
        $id = $req->input('teacher-id');
        $stu = Teacher::where('teacher_username', $id);
        $stu->delete();

        $user = User::find($id);
        $user->delete();
        
        return redirect()->route('deleteTeacher.admin')->with('message', 'Teacher Deleted Successfully');
    }
    public function searchTeacher(Request $req){
        // dd('ok');
        $query = $req->input('search-teacher');
        $tea = Teacher::query()
        ->where('teacher_username', 'LIKE', "%{$query}%")
        ->get();
        if(count($tea) == 0){
            return \redirect()->back()->withErrors(['No Teacher Found']);
        }else{
            return view('admin.deleteInfo.deleteTeacherDetails', compact('tea'));
        }
    }
    public function deleteCourse(){
        return view('admin.deleteInfo.deleteCourse');
    }
    public function deleteAllCourse(){
        return view('admin.deleteInfo.deleteAllCourse');
    }
    public function deleteAllCourseDate(Request $req){
        $dept = $req->input('dept');
        $courses = Course::where('course_dept', $dept);
        $courses->delete();

        return \redirect()->route('deleteCourse.admin')->with('message', 'All Courses Deleted Successfully');
    }
    public function deleteCourseData(Request $req){
        $id = $req->input('teacher-id');
        $stu = Teacher::where('teacher_id', $id);
        $stu->delete();
        return redirect()->route('deleteTeacher.admin');
    }

    public function deleteOneCourse(){
        return \view('admin.deleteInfo.deleteOneCourse');
    }
    public function deleteOneCourseData(Request $req){
        // dd($req->input());
        $courseCode = $req->input('course-code');
        $course = Course::find($courseCode);
        if($course == null){
            return \redirect()->back()->withErrors(['No Course Found!!']);
        }else{
            // dd($course);
            $course->delete();
            return \redirect()->back()->with('message', 'Course deleted successfully');
        }
    }
    public function deleteClass(){
        return \view('admin.deleteInfo.deleteClass');
    }
    public function deleteClassData(Request $req){
        
        $roomNum = $req->input('room-num');
        $room = ClassRoom::find($roomNum);
        if($room == null){
            return \redirect()->back()->withErrors(['No Class Room Found!!']);
        }else{
            // dd($room);
            $room->delete();
            return \redirect()->back()->with('message', 'Class Room deleted successfully');
        }
    }

    public function updateinfo(){
        return \view('admin.updateInfo.updateinfo');
    }
    public function updateStudent(){
        return \view('admin.updateInfo.updateStudent');
    }
    public function updateStudentDetails(Request $req){
        // \dd($req->input());
        $stuId = $req->input('student-id');
        $student = Student::where('student_id', '=', $stuId)->first();
        // dd($student);
        if($student == null){
            return \redirect()->back()->withErrors(['No student found!!']);
        }else{
            // dd($student);
            $student->update([
                'student_dept'=> $req->input('student-dept'),
                'student_name'=> $req->input('student-name'),
                'student_semester'=> $req->input('student-semester'),
                'student_session'=> $req->input('student-session'),
            ]);

            return \redirect()->back()->with('message', 'Student Updated Successfully');
        }
    }

    public function updateTeacher(){
        return \view('admin.updateInfo.updateTeacher');
    }
    public function updateTeacherDetails(Request $req){
        // \dd($req->input());
        $teacherId = $req->input('teacher-id');
        $teacher = Teacher::where('teacher_username', '=', $teacherId)->first();
    
        if($teacher == null){
            return \redirect()->back()->withErrors(['No Teacher found!!']);
        }else{
            $teacher->update([
                'teacher_dept'=> $req->input('teacher-dept'),
                'teacher_name'=> $req->input('teacher-name'),
                'teacher_phone'=> $req->input('teacher-phone'),
                
            ]);

            return \redirect()->back()->with('message', 'Teacher Updated Successfully');
        }
    }
    public function updateCourse(){
        return \view('admin.updateInfo.updateCourse');
    }
    public function updateCourseDetails(Request $req){
        // \dd($req->input());
        $courseCode = $req->input('course-code');
        $course = Course::where('course_code', '=', $courseCode)->first();
    
        if($course == null){
            return \redirect()->back()->withErrors(['No Course found!!']);
        }else{
            // \dd($course);
            $course->update([
                'course_dept'=> $req->input('course-dept'),
                'course_name'=> $req->input('course-name'),
                'course_semester'=> $req->input('course-semester'),
                'class_number'=> $req->input('course-class'),
                'course_credit'=> $req->input('course-credit'),
            ]);

            return \redirect()->back()->with('message', 'Course Updated Successfully');
        }
    }

    public function updateRoom(){
        return \view('admin.updateInfo.updateRoom');
    }
    public function updateRoomDetails(Request $req){
        // \dd($req->input());
        $roomNum = $req->input('room-num');
        $room = ClassRoom::where('room_number', '=', $roomNum)->first();
    
        if($room == null){
            return \redirect()->back()->withErrors(['No Class Room found!!']);
        }else{
            // \dd($course);
            $room->update([
                'room_dept'=> $req->input('room-dept'),
                'latitude'=> $req->input('latitude'),
                'longitude'=> $req->input('longitude'),
                'radious'=> $req->input('radious'),
            ]);

            return \redirect()->back()->with('message', 'Class Room Updated Successfully');
        }
    }


    public function browseinfo(){
        return \view('admin.browseInfo.browseinfo');
    }
    public function browseStudentInfo(){
        return \view('admin.browseInfo.browseStudent');
    }
    public function browseStudentInfoById(){
        return \view('admin.browseInfo.browseStudentById');
    }
    public function browseStudentInfoByIdPost(Request $req){
        // dd($req->input());
        $student = Student::find($req->input('student-id'));
        // dd($student['student_id']);
        if(empty($student)){
            return \redirect()->back()->withErrors(['No Student Found']);
        }else{
            $data = [$student['student_id'], $student['student_name'], $student['student_dept'], $student['student_session'], $student['student_username'], $student['student_password']];

            return \view('admin.browseInfo.browseStudentById', compact('data'));
        }
    }
    public function browseStudentInfoBySemester(){
        return \view('admin.browseInfo.studentBySemester');
    }
    public function browseStudentInfoBySemesterPost(Request $req){
        // dd($req->input());
        $students = Student::where([
            'student_semester' => $req->input('semester'),
            'student_dept' => $req->input('dept'),
        ])->get();
        
        if(count($students) == 0){
            return \redirect()->back()->withErrors(['No Student Found !!']);
        }else{
            return \view('admin.browseInfo.studentBySemester', compact('students'));
        }
    }
    public function browseStudentInfoBySession(){
        return \view('admin.browseInfo.studentBySession');
    }
    public function browseStudentInfoBySessionPost(Request $req){
        // dd($req->input());
        $students = Student::where('student_session', '=', $req->input('session'))->get();
        
        if(count($students) == 0){
            return \redirect()->back()->withErrors(['No Student Found !!']);
        }else{
            return \view('admin.browseInfo.studentBySession', compact('students'));
        }
    }

    public function browseTeacherInfo(){
        return \view('admin.browseInfo.teacher');
    }
    public function browseTeacherInfoById(){
        return \view('admin.browseInfo.teacherById');

    }
    public function browseTeacherInfoByIdPost(Request $req){
        // dd($req->input());
        $teacher = Teacher::find($req->input('teacher-id'));
        // dd($student['student_id']);
        if(empty($teacher)){
            return \redirect()->back()->withErrors(['No Teacher Found']);
        }else{
            $data = [$teacher['teacher_name'], $teacher['teacher_dept'], $teacher['teacher_phone'], $teacher['teacher_username'], $teacher['teacher_email']];

            return \view('admin.browseInfo.teacherById', compact('data'));
        }
    }
    public function browseTeacherInfoByDept(){
        return \view('admin.browseInfo.teacherByDept');

    }
    public function browseTeacherInfoByDeptPost(Request $req){
        $teachers = Teacher::where('teacher_dept', '=', $req->input('dept'))->get();
        
        if(count($teachers) == 0){
            return \redirect()->back()->withErrors(['No Teachers Found !!']);
        }else{
            return \view('admin.browseInfo.teacherByDept', compact('teachers'));
        }
    }




    public function assign(){
        return \view('admin.assign');
    }
    public function assignDept($dept){
        $teacher_name = Teacher::where('teacher_dept', '=', $dept)->pluck('teacher_name');
        $arr = [];

        foreach ($teacher_name as  $name) {
            array_push($arr, "<option>$name</option>");
        }
        
        if(\count($teacher_name) == 0){
            return \response()->json(["<option>No Teacher found</option>"]);
        }else{
            return \response()->json($arr);
        }
    }
    public function assignPostDept(Request $req){
        $teacher_name = $req->input("teacher-name");
        $dept = $req->input('dept');
        // dd($req->all());
        $teacher = Teacher::select('teacher_username')->where([
            ['teacher_name', $teacher_name],
            ['teacher_dept', $dept]
        ])->first();
        // dd($teacher['teacher_username']);
        

        return \view('admin.assignCourses', compact('dept', 'teacher'));

    }
    public function assignCourses($dept, $year, $semses){
        $semester = '';

        if($year == '1' && $semses == '1'){
            $semester = '1st';
        }elseif($year == '1' && $semses == '2'){
            $semester = '2nd';
        }elseif($year == '2' && $semses == '1'){
            $semester = '3rd';
        }elseif($year == '2' && $semses == '2'){
            $semester = '4th';
        }elseif($year == '3' && $semses == '1'){
            $semester = '5th';
        }elseif($year == '3' && $semses == '2'){
            $semester = '6th';
        }elseif($year == '4' && $semses == '1'){
            $semester = '7th';
        }elseif($year == '4' && $semses == '2'){
            $semester = '8th';
        }

        $courses = Course::select('course_name', 'course_code')
            ->where([
                ['course_dept', '=', $dept],
                ['course_semester', '=', $semester]
            ])
            ->get();
            $arr  = [];

        if(\count($courses) == 0){
            return \response()->json(["null"]);
            
        }else{
            foreach ($courses as $course) {
                array_push($arr, '<div class="course-codes code-area" style="margin: 5px;"><input type="checkbox" id="'. $course['course_code']. '"'. 'name="courses[]"'. 'value="'. $course['course_code'] . '"'.'>
                <label for="'. $course['course_code']. '"'.'style="padding: 0px 5px 0px 40px;">'. $course['course_code']. '</label>'. $course['course_name'] . '</div>');
            }
            return \response()->json($arr);
        }
    }

    public function assignPostCourses(Request $req){
        $courses = $req->input('courses');
        $teacher_id = $req->input('teacher_id');
        // dd($req->all());
        if($courses == null){
            return \redirect()->back()->withErrors(['No Course selected']);
            
        }else{
            foreach ($courses as $course) {
                Course::where('course_code', $course)
                ->update([
                    'course_teacher' => $teacher_id
                ]);
            }
            return \redirect()->back()->with('message', 'Assigned Teacher Successfully');
        }
    }

}
