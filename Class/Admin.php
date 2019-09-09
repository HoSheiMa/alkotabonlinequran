<?php

include_once __DIR__ . '/LOGIN_SESSION.php';
include_once __DIR__ . '/helper.php';


class Admin {
    public $c = null;
    
    private function IsCreateToDatColletionViews($date) {
        $q = "SELECT * FROM `userslogin` WHERE `date`='$date'";

        $r = mysqli_query($this->c, $q);
        
        if ($r->num_rows == 0) {
            return false;
        } else {
            return true;
        }
    }

    private function InsertNewToDayViews($date) {

        $q = "INSERT INTO `userslogin`
        (`date`, `UserLoginToday`, `TeacherLoginToday`, `SalaryTakedTodayFromStudents`, `SalaryTakedTodayFromWebToTeachers`, `BookedMeetsToday`)
         VALUES ('$date', '0', '0', '0', '0', '0')";
        $r = mysqli_query($this->c, $q);

    }

    public function hasPermission($permission) {


        $me = $_SESSION['who'];

        $q = "SELECT * FROM `admininfo` WHERE `email`='$me'";

        $r =  json_decode(mysqli_fetch_array(mysqli_query($this->c, $q))['permission']);

        if (in_array($permission, $r)) {
            return true;
        } else {
            return false;
        }

    }


    public function increaseLoginWebToDay($date) {

        // for user
        $q = "SELECT * FROM `userslogin` WHERE `date`='$date'";

        $r = mysqli_query($this->c, $q);
        
        if ($r->num_rows == 0) {
            $this->InsertNewToDayViews($date);

            $q = "SELECT * FROM `userslogin` WHERE `date`='$date'";

            $r = mysqli_query($this->c, $q);
        } 
  
        $info = mysqli_fetch_array($r);

        $LoginWebToDay = (int) $info['UserLoginToday'];

        $LoginWebToDay = $LoginWebToDay + 1;


        $q = "UPDATE `userslogin` SET `UserLoginToday`='$LoginWebToDay' WHERE `date`='$date'";

        $r = mysqli_query($this->c, $q);


    }

    public function increaseLoginWebToDayForTeachers($date) {
        // for teachers
        $q = "SELECT * FROM `userslogin` WHERE `date`='$date'";

        $r = mysqli_query($this->c, $q);
        
        if ($r->num_rows == 0) {
            $this->InsertNewToDayViews($date);

            $q = "SELECT * FROM `userslogin` WHERE `date`='$date'";

            $r = mysqli_query($this->c, $q);
        } 

        $info = mysqli_fetch_array($r);

        $LoginWebToDay = (int) $info['TeacherLoginToday'];

        $LoginWebToDay = $LoginWebToDay + 1;


        $q = "UPDATE `userslogin` SET `TeacherLoginToday`='$LoginWebToDay' WHERE `date`='$date'";

        $r = mysqli_query($this->c, $q);


    }

    public function _Connection ($c) {
        $this->c = $c;
    }

    public function userslogin() {

        $l = new LOGIN_SESSION();

        $l->_Connection($this->c);

        // if ($l->IsAdmin() == false) return;



        $date = new Date('d-m-Y');

        if ($this->IsCreateToDatColletionViews($date) == false) {
            $this->InsertNewToDayViews($date);
        } else {
            $this->increaseLoginWebToDay($date);
        }
    }

    public function Teacherslogin() {

        $l = new LOGIN_SESSION();

        $l->_Connection($this->c);

        // if ($l->IsAdmin() == false) return;



        $date = new Date('d-m-Y');

        if ($this->IsCreateToDatColletionViews($date) == false) {
            $this->InsertNewToDayViews($date);
        } else {
            $this->increaseLoginWebToDayForTechers($date);
        }
    }

    public function ChangePasswordOfUser($email, $NewPassword) {
        $l = new LOGIN_SESSION();

        $l->_Connection($this->c);

        return $l->NewPassword($email, $NewPassword);

    }

    public function ChangeTeacherSalary($email, $NewSalary) {
        if ($email == null) {
            // me
    
            $email = $_SESSION['who'];
    
            $q = "UPDATE `toucherinfo` SET `Salary`='$NewSalary' WHERE `ID`='$email'";
    
            $r = mysqli_query($this->c, $q);
        } else {
    
                // $email = $_SESSION['who'];
    
            $q = "UPDATE `toucherinfo` SET `Salary`='$NewSalary' WHERE `ID`='$email'";
    
            $r = mysqli_query($this->c, $q);
        }
    }

    

    public function CHANGE_BLOCK_STATE($email, $newValue){
        $h = new helper();

        $h->_Connection($this->c);

        if ($newValue == "false" || $newValue == "true") {
   
            return $h->Update('users', [["BLOCK_STATE", $newValue]],[['email', '=', $email]], false);
            
        }

    }


    public function REMOVE_USER($email) {

        $h = new helper();

        $h->_Connection($this->c);

        $h->delete('users', [['email', '=', $email]], false);

    }


    public function AddNewAdmin($email, $pass, $name, $permissions) {

        $q = "INSERT INTO `users`(`email`, `pass`, `name`, `profile_img`, `BLOCK_STATE`, `freeCoursestrial`, `permission`)
         VALUES ('$email', '$pass', '$name', 'assets/default.png', 'false', '[]','" . "{ \"permission\" : \"admin-permission\" }')";


        // return $q;
        mysqli_query($this->c, $q);


        $q = "INSERT INTO `admininfo`(`email`, `permission`) VALUES ('$email','$permissions')";

        mysqli_query($this->c, $q);



    }


}

