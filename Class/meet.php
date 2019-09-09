
<?php

include __DIR__ .'/Teacher.php'; // this may change in other webs
include_once __DIR__ . "/LOGIN_SESSION.php";
include_once __DIR__ . '/Forms.php';
include_once __DIR__ . '/helper.php';
// include_once '../config/db_config.php';

if (session_id() == '') {

    session_start();
}

class meet {
    public $days = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");

    public function IsAvalibaleTimeForMeet($c, $t, $date = "1-2-2001", $time = "1", $TimZone) {

        $datetime = DateTime::createFromFormat('d-m-Y', $date);

        $dayName  =  $datetime->format('l'); // get name of day


        $avaDaysArr =  $this->GetAvalibleDaysToArray($c, $t); // avalible days array !

        $avalibleDay = false;
    

        for ($day= 0; $day < sizeof($avaDaysArr); $day++) {
            if (strtolower($this->days[$day]) == strtolower($dayName)) {
                $avalibleDay = true;
                break;
            }
        }

        if ($avalibleDay == false) return "0"; // if contiune we should check if teacher have meet in this day or time


        
        $Found = "SELECT * FROM `meets` WHERE `IDTeacter`='$t' AND `Time`='$time' AND `date`='$date'";

        if (mysqli_query($c, $Found)->num_rows == 0) {

            if ($this->IsFreetrial($c, $t) == true) {

                $this->AddNewMeet($c, $t, $date, $datetime->format('d'), $time, $TimZone, 'free');
                $this->KilloneFreeTrailForThisTeacher($c, $t);
            
            } else if ($this->IshaveHoursDeal($c) == true) {

                $this->AddNewMeet($c, $t, $date, $datetime->format('d'), $time, $TimZone, '!free');
                $this->removeOneHour($c);

            }else {

                $_SESSION['WaitingMeet'] = [
                    $t,
                    $date,
                    $datetime->format('d'),
                    $time,
                    $TimZone,
                    '!free'
                ];
                return '2';


            }
            
            return "1";
        } else {
            return "0";
        }




    }

    public function KilloneFreeTrailForThisTeacher($c, $t) {


        $me = $_SESSION['who'];

        $q = "SELECT * FROM `users` WHERE `email`='$me'";

        $r = json_decode(mysqli_fetch_array( mysqli_query($c, $q))['freeCoursestrial']);


        array_push($r, $t);

        $r = json_encode($r);

        $q = "UPDATE `users` SET `freeCoursestrial`='$r' WHERE `email`='$me'";

        mysqli_query($c, $q);


    }

    public function removeOneHour($c) {


        $me = $_SESSION['who'];

        $q = "SELECT * FROM `users` WHERE `email`='$me'";

        $r = (int) mysqli_fetch_array( mysqli_query($c, $q))['BuyHoursInDeal'];

        $r = $r - 1;

        $q = "UPDATE `users` SET `BuyHoursInDeal`='$r' WHERE `email`='$me'";

        mysqli_query($c, $q);


    } 

    public function IsFreetrial($c, $teacherEmail) {
        $me = $_SESSION['who'];

        $q = "SELECT * FROM `users` WHERE `email`='$me'";

        $r = mysqli_fetch_array( mysqli_query($c, $q));

        $trialArray = json_decode($r['freeCoursestrial']);


        if (in_array($teacherEmail, $trialArray)) {
            return false;
        } else {
            return true;
        }

    }

    public function IshaveHoursDeal($c) {

        $me = $_SESSION['who'];

        $q = "SELECT * FROM `users` WHERE `email`='$me'";

        $r = mysqli_fetch_array( mysqli_query($c, $q));

        $BuyHoursInDeal = (int) json_decode($r['BuyHoursInDeal']);

        if ($BuyHoursInDeal > 0) {
            return true;
        }
        return false;

    }
    public function TimefromToJSON ($c, $t) {

        $tinfo = "SELECT * FROM `toucherinfo` WHERE `ID`='$t'";

        $rinfo = mysqli_fetch_array(mysqli_query($c, $tinfo));
        return json_encode(
            [
                [$rinfo['TimeactFrom'],
                 $rinfo['TimeactTo']
                ],
                json_decode($rinfo['ActWeek'], true),
                $rinfo['TimeZone'],
                $rinfo['Salary']
                ], true);
  
    }

    public function GetAvalibleDaysToArray($c, $t) {
        $tinfo = "SELECT * FROM `toucherinfo` WHERE `ID`='$t'";

        $rinfo = mysqli_fetch_array(mysqli_query($c, $tinfo));

        return json_decode($rinfo['ActWeek']);

    }

    public function returnSalary($c, $t) {

        $q = "SELECT * FROM `toucherinfo` WHERE `ID`='$t'";
        
        $s = mysqli_fetch_array(mysqli_query($c,$q));



        return [(int)$s['Salary'],(int)$s['TotalSalaryHaveNowFRomMeets'], json_decode($s['Total_salary_history'], true) ];

    }
    public function addNewSalaryToTeacher($c, $t) {

        $s = $this->returnSalary($c, $t);

        $TotalSalaryHaveNowFRomMeets = $s[0] + $s[1];

        $Total_salary_history = $s[2];

        $date__today = Date('d-m-Y');

        array_push($Total_salary_history, array(
            "DATE" => "$date__today",
            "SalaryTaked"=> "$s[0]",
        ));

        $Total_salary_history = json_encode($Total_salary_history, true);

        $h = new helper;
        
        $h->_Connection($c);

        $h->Update('toucherinfo', [
            ['TotalSalaryHaveNowFRomMeets', $TotalSalaryHaveNowFRomMeets],
            ['Total_salary_history', $Total_salary_history],

        ], [
            ["ID", "=", "$t"]
        ]);

    }

    public function AddNewMeet($c, $t, $date, $day, $time, $TimZone, $type) {

        $this->addNewSalaryToTeacher($c, $t);
        $i = $_SESSION['who'];
        $date__today = Date('d-m-Y');
        $id =   "id_" . rand(99999, 99999999);
        $w = "INSERT INTO `meets`(`IDTeacter`, `IDFrom`, `state`, `TimZone`, `Time`, `Day`, `date`,`DateOFNow`,  `ID`, `type`) 
        VALUES ('$t', '$i', 'Process','$TimZone', '$time', '$day', '$date', '$date__today','$id', '$type')";

        mysqli_query($c, $w);
        

    }

    public function CancelMeet ($c, $id) {

        $me = $_SESSION['who'];

        $q = "DELETE FROM `meets` WHERE `ID`='$id' AND `IDFrom`='$me'";

        return mysqli_query($c, $q);


    }

    public function ChangeState ($c, $newState, $id) {

        $q = "UPDATE `meets` SET `state`='$newState' WHERE `ID`='$id'";

        $r = mysqli_query($c, $q);


    }
    public function RealTimeCircle ($time) {
        if (strpos($time, "pm") == true) {
            $time = str_replace("pm", "", $time);
            return $time = (integer) $time + 12;
        } else {
            $time = str_replace("am", "", $time);
            return $time = (integer) $time;
        }
    }

    public function FoundRoom($c, $id) {

        $q = "SELECT * FROM `rooms` WHERE `ID_Meet`='$id'";

        $r = mysqli_query($c, $q);

        return $r->num_rows == 0 ? false : true;


    }
    
    public function CheckMeetReturnState($c, $Localusertime, $LocaluserDate, $id = null) {

        // state 001 date lost
        // state 002 date inprocess
        // state 003 meet avalible now with enter teacher
        // state 004 meet avalible without enter teacher 

        $me = $_SESSION['who'];

        $l = new LOGIN_SESSION;

        $l->_Connection($c);
        

        if ($l->IsToucher() == true) {

            if ($id == null) {   
                $q = "SELECT * FROM `meets` WHERE `IDTeacter`='$me'";
            } else {
                $q = "SELECT * FROM `meets` WHERE `IDTeacter`='$me' AND `ID`='$id'";
                
            }

        } else if ($l->IsAdmin() == true){
            // access all meets
            if ($id == null) {   
                $q = "SELECT * FROM `meets` WHERE";
            } else {
                $q = "SELECT * FROM `meets` WHERE `ID`='$id'";
                
            }

        } else {

            
            if ($id == null) {   
                $q = "SELECT * FROM `meets` WHERE `IDFrom`='$me'";
            } else {
                $q = "SELECT * FROM `meets` WHERE `IDFrom`='$me' AND `ID`='$id'";
                
            }

        }


        $r = mysqli_query($c, $q);

        if ($r->num_rows == 0) return; // this if no date 

 

        
        
        while ($tec = mysqli_fetch_array($r)) {
            
            $saveDate = $tec['date'];

            $saveTime = $tec['Time'];

            $today =DateTime::createFromFormat( "d-m-Y", $LocaluserDate); 
            $today->setTime( 0, 0, 0 ); // reset time part, to prevent partial comparison
    
            $match_date = DateTime::createFromFormat( "d-m-Y", $saveDate);
            $match_date->setTime( 0, 0, 0 ); 
    
            $diff = $today->diff( $match_date );
            $diffDays = (integer)$diff->format( "%R%a" ); // Extract days count in interval
    

            if ($diffDays == 0) {
                // 003

                // for give me time 24 style not 12 am or 12 pm style :D 

                $Localusertime = $this->RealTimeCircle($Localusertime);

                $saveTime = $this->RealTimeCircle($saveTime);

                if ($saveTime == $Localusertime) {

                    if ($this->FoundRoom($c, $tec['ID']) == true) {

                        $this->ChangeState($c, 'Meet Is Avalible', $tec['ID']);
                        // 003
                    } else {
                        $this->ChangeState($c, 'preparing a Meet', $tec['ID']);
                        // 004
                    }

                    
                } else if ($saveTime < $Localusertime) {
                    // 001
                    $this->ChangeState($c, 'Missed', $tec['ID']);

                } else {
                    // 002
                    $this->ChangeState($c, 'Prograss', $tec['ID']);

                }




            } else if ($diffDays > 0) {
                // 002
                $this->ChangeState($c, 'Prograss', $tec['ID']);

            } else if ($diffDays < 0) {
                // 001 
                $this->ChangeState($c, 'Missed', $tec['ID']);

            }

            

        }

        return;







    }


    public function MeetsListToJson ($c, $Localusertime, $LocaluserDate) {


        // $this->CheckMeetReturnState($c, $Localusertime, $LocaluserDate);

        $me = $_SESSION['who'];

        $_ = new LOGIN_SESSION();
        $_->_Connection($c);

        if ($_->IsAdmin() != true) {


            
            if ($_->IsToucher() == true) {
                
                $q = "SELECT * FROM `meets` WHERE `IDTeacter`='$me'";
                
            } else {
                
                $q = "SELECT * FROM `meets` WHERE `IDFrom`='$me'";
                
            }
        } else {
            $q = "SELECT * FROM `meets` WHERE 1";


        }

        $r = mysqli_query($c, $q);

        $json = [];

        if ($r->num_rows == 0) return json_encode([], true); // this if no date 
        
        
        while ($tec = mysqli_fetch_array($r)) {
            

            $t = new Teacher();


            $tName = $t->GetNameFromEmail($c, $tec['IDTeacter']);

            $me = $_SESSION['who'];

            array_push($json, [
                $tName,
                $tec['state'],
                $tec['Time'],
                $tec['Day'],
                $tec['date'],
                $tec['ID'],
                $tec['TimZone'],
                $tec['IDTeacter'],
                $tec['IDFrom'],
                $tec['type'],
                ]);
 

        }

        return json_encode($json, true);




    }

    public function MeetsToday($c, $date) {

        $e = $_SESSION['who']; // me;

        $q = "SELECT * FROM `meets` WHERE `IDTeacter`='$e' AND `date`='$date'";


        return mysqli_query($c, $q)->num_rows;




    }

    public function MeetsTotal($c) {

        $e = $_SESSION['who']; // me;

        $q = "SELECT * FROM `meets` WHERE `IDTeacter`='$e'";


        return mysqli_query($c, $q)->num_rows;




    }

    public function TotalSalary($c) {

        $e = $_SESSION['who']; // me;
        
        $q = "SELECT * FROM `toucherinfo` WHERE `ID`='$e'";


        return mysqli_fetch_array(mysqli_query($c, $q))['TotalSalaryHaveNowFRomMeets'];


    }

    public function TotalStars($c){

        $e = $_SESSION['who']; // me;
        
        $q = "SELECT * FROM `toucherinfo` WHERE `ID`='$e'";


        return mysqli_fetch_array(mysqli_query($c, $q))['star'];



    }

    public function returnAllTeacherWithHTMLstyle($c) {
        
        $q = "SELECT * FROM `users` WHERE `permission`='{\"permission\" : \"Toucher-permission\" }'";

        $r = mysqli_query($c, $q);

        $html = '';

        
        
        while ($tec = mysqli_fetch_array($r)) {
           
           $email = $tec['email'];
           
           $qinfo = "SELECT * FROM `toucherinfo` WHERE `ID`='$email'";
  
           $rinfo =mysqli_fetch_array( mysqli_query($c, $qinfo) );

           $f = new Forms();

           $me = $_SESSION['who'];

            $html = $html . $f->SmallSizeTeacher($c, $tec['name'], $tec['profile_img'], $rinfo['Info'], $rinfo['star'], $email, $me);

        }

        return $html;

    }
    public function _url () {
        $http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http';
        $name = $_SERVER['SERVER_NAME'];

        //$uri = $_SERVER['REQUEST_URI'];

        $url = $http . '://' . $name;
        return $url;
    }

    public function CreateRoom($c, $student, $idroom, $idmeet) {


        if ($this->FoundRoom($c, $idmeet) == true){

            $q = "DELETE FROM `rooms` WHERE `ID_Meet`='$idmeet'";

            mysqli_query($c,$q);

        } 

        $me = $_SESSION['who'];

        // $url = $_SERVER['HTTP_REFERER'] . 'liveroom/?roomId=' . $idroom . "&Teacher=$me";
        // $url ='http://localhost/project5/liveroom/?roomId=' . $idroom . "&Teacher=$me&idmeet=$idmeet";
        $_url = $this->_url();
        $url = $_url . '/liveroom/?roomId=' . $idroom . "&Teacher=$me&idmeet=$idmeet";

        $me = $_SESSION['who'];

        $q = "INSERT INTO `rooms`(`Rooms_link`, `Teacher`, `standen`, `ID_Meet`, `teacherPeerId`, `studentPeerId`)
        VALUES ('$url', '$me', '$student', '$idmeet', 'null', 'null')";


        mysqli_query($c, $q);

    }

    public function ReturnLinkRoom($c, $idroom) {
        if ($this->FoundRoom($c, $idroom) == true){

            $q = "SELECT * FROM `rooms` WHERE `ID_Meet`='$idroom'";

            $r = mysqli_fetch_array(mysqli_query($c, $q));
        
            return $r['Rooms_link'];


        }    
    }
}