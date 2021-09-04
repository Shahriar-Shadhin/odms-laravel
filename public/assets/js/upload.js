const realTeacherfile = document.querySelector("#teacher-file");
const customfileButtonTeacher = document.querySelector("#custom-upload-button-teacher");
const fileTextTeacher = document.querySelector("#upload-text");

const realStudentfile = document.querySelector('#student-file');
const customfileButtonStudent = document.querySelector('#custom-upload-button-student');
const fileTextStudent = document.querySelector("#upload-text-student");

const realCoursefile = document.querySelector('#course-file');
const customfileButtonCourse = document.querySelector('#custom-upload-button-course');
const fileTextCourse = document.querySelector("#upload-text-course");

customfileButtonTeacher.addEventListener('click', () => {
    realTeacherfile.click();
});

realTeacherfile.addEventListener('change', () => {
    if (realTeacherfile.value) {
        fileTextTeacher.innerHTML = realTeacherfile.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
    } else {
        fileTextTeacher.innerHTML = 'No File Chossen';
    }
});

customfileButtonStudent.addEventListener('click', () => {
    realStudentfile.click();
});

realStudentfile.addEventListener('change', () => {
    if (realStudentfile.value) {
        fileTextStudent.innerHTML = realStudentfile.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
    } else {
        fileTextStudent.innerHTML = 'No File Chossen';
    }
});

customfileButtonCourse.addEventListener('click', () => {
    realCoursefile.click();
});

realCoursefile.addEventListener('change', () => {
    if (realCoursefile.value) {
        fileTextCourse.innerHTML = realCoursefile.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
    } else {
        fileTextCourse.innerHTML = 'No File Chossen';
    }
});
