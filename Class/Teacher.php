<?php

class Teacher{ 

    public $c = Null;

    public function GetNameFromEmail($c, $e) {

        $q = "SELECT * FROM `users` WHERE `email`='$e'";

        return mysqli_fetch_array(mysqli_query($c, $q))['name'];
    }

    public function GetSalaryFromEmail($c, $e) {

        $q = "SELECT * FROM `toucherinfo` WHERE `ID`='$e'";

        return mysqli_fetch_array(mysqli_query($c, $q))['Salary'];
    }

    public function GetProfileImageUrlFromEmail($e) {

        $q = "SELECT * FROM `users` WHERE `email`='$e'";

        return mysqli_fetch_array(mysqli_query($this->c, $q))['profile_img'];
    }


    public function _Connection ($c) {
        $this->c = $c;
    }

    public function getAllInfo($e) {

        $q = "SELECT * FROM `toucherinfo` WHERE `ID`='$e'";

        return mysqli_fetch_array(mysqli_query($this->c, $q), MYSQLI_ASSOC);
    }


    public function TeacherFullProfile($email) {

        /* 
        return email, name, profile image url, info, cv, course he/she given
        */

        $name = $this->GetNameFromEmail($this->c, $email);

        $allinfo = $this->getAllInfo($email);
        $allinfo['name'] = $name;
        $allinfo['profile_img'] = $this->GetProfileImageUrlFromEmail($email);
        $arr = json_encode($allinfo, true);


        return $arr;


    }

    public function AddNewTeacher($email, $pass, $name, $info, $cv_links, $timefrom, $timeto, $actweek, $tz, $salary) {


        $q = "INSERT INTO `users`(`email`, `pass`, `name`, `profile_img`, `BLOCK_STATE`, `permission`)
        VALUES ('$email','$pass','$pass','assets/default.png','false','{\"permission\" : \"Toucher-permission\" }')";

        $q2 = "INSERT INTO `toucherinfo`(`ID`, `TimeactFrom`, `TimeactTo`, `ActWeek`, `Info`, `star`, `TimeZone`, `cv_images`, `Salary`, `TotalSalaryHaveNowFRomMeets`, `TotalSalaryDoneTake`, `SalaryHistoryTakeFromWeb`, `stars_history`, `Total_salary_history`) 
        VALUES ('$email','$timefrom','$timeto','$actweek','$info','0','$tz','$cv_links','$salary','0','0','[]','[]','[]')";


        mysqli_query($this->c, $q);
        mysqli_query($this->c, $q2);
        

    }


}