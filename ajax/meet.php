<?php

session_start();

include '../config/db_config.php';
include '../Class/meet.php';

if (isset($_POST['req'])) {


    $req = $_POST['req'];


    if ($req == "IsAvalibaleTimeForMeet") {
        if (isset($_POST['teacher']) && isset($_POST['TimZone'])  && isset($_POST['Date']) && isset($_POST['Time'])) {
            $t = $_POST['teacher'];
            $Date = $_POST['Date'];
            $Time = $_POST['Time'];
            $TimZone = $_POST['TimZone'];
            if ($_SESSION['who']) {
              
             $IsAvalibaleTimeForMeet = new meet();

             $IsAvalibaleTimeForMeet = $IsAvalibaleTimeForMeet->IsAvalibaleTimeForMeet($c, $t, $Date, $Time, $TimZone);

             echo $IsAvalibaleTimeForMeet;

            }
        }
    } else if ($req == "TimefromToJSON") {
        if (isset($_POST['teacher']) && isset($_POST['me'])) {
            $t = $_POST['teacher'];
            $me = $_POST['me'];
            $TimefromToJSON = new meet();

            $TimefromToJSON = $TimefromToJSON->TimefromToJSON($c, $t);

            echo $TimefromToJSON; 
        }

    } else if ($req == "MeetsListToJson" && isset($_POST['Time']) && isset($_POST['Date'])) {

        $Localusertime = $_POST['Time'];
        $LocaluserDate = $_POST['Date'];

        

            $m = new meet();

            
            echo $m->MeetsListToJson($c, $Localusertime, $LocaluserDate);
        
    } else if ($req == "CancelMeet" && isset($_POST['id'])) {
        $id = $_POST['id'];
        $m = new meet();
        return  $m->CancelMeet($c, $id);
    } else if ($req == "FASTINFOTEACHER" && $_POST['date']) {
        


        $m = new meet();
        $meets_today = $m->MeetsToday($c, $_POST['date']);

        $meets_total = $m->MeetsTotal($c);

        $TotalSalary = $m->TotalSalary($c);

        $TotalStars = $m->TotalStars($c);


        $arr = json_encode(
            [
                $meets_today,
                $meets_total,
                $TotalSalary,
                $TotalStars
            ],
            true
        );
        echo $arr;






    } else if ($req == "GetAllTeacher") {
        $m = new meet();

        echo $m->returnAllTeacherWithHTMLstyle($c);
        

    } else if ($req == "UpdateMeetsState") {

        if (!isset($_POST['Time']) && !isset($_POST['Date']) && !isset($_POST['id'])) return;

        $time = $_POST['Time'];
        $date = $_POST['Date'];
        $id = $_POST['id'];


        $m = new meet();
        

        echo $m->CheckMeetReturnState($c, $time, $date, $id);

    } else if ($req == "addRoomLive") {

        if (!isset($_POST['idRoom']) || !isset($_POST['student']) || !isset($_POST['idmeet']) ) return;
        
        $m = new meet();
        $id = $_POST['idRoom'];
        $student = $_POST['student'];
        $idmeet = $_POST['idmeet'];
        $idroom = $_POST['idRoom'];



        $m->CreateRoom($c, $student, $idroom, $idmeet);

    } else if ($req == "GetRoomUrl") {
        if (isset($_POST['idRoom'])) {

            $m = new meet();

            echo $m->ReturnLinkRoom($c, $_POST['idRoom']);

        }
    } else if ($req == "add_peer_ids_to_meet") {
        if (
            !isset($_POST['type_']) || 
            !isset($_POST['idmeet']) || 
            !isset($_POST['peerid'])
        ) return;

        $type_ = $_POST['type_'];
        $idmeet = $_POST['idmeet'];
        $peerid = $_POST['peerid'];


        $h = new helper;

        $h->_Connection($c);
            
        $type_ = $type_  == 'teacher' ?  'teacherPeerId':'studentPeerId';

        $h->Update('rooms', [
            ["$type_", "$peerid"],
        ], [
            ["ID_Meet", '=', "$idmeet"],
        ],false);
    } else if ($req == "GetAllDeals") {

        $h = new helper;

        $h->_Connection($c);

        $d = $h->GetAll('deals', [], false, false);

        $d = $h->ToJSON($d);

        echo $d;

    } else if ($req == "GetDealshours") {

        $h = new helper;

        $h->_Connection($c);

        $me = $_SESSION['who'];

        $d = $h->GetAll('users', [
            ["email", "=", "$me"]
        ])[0]['BuyHoursInDeal'];


        echo $d;

    } else if ($req == "stateOfBuy") {

        
        if (!isset($_POST['t'])) return;

        $m = new meet();

        $t = $_POST['t'];

        if ($m->IsFreetrial($c, $t) == true) {
            echo 'free';
            return;
        }
        if ($m->IshaveHoursDeal($c) == true) {
            echo 'deal';
            return;
        }

        echo 'buy';
        return;

    } else if ($req == "delete_deal") {

        if (!isset($_POST['id'])) return;

        $id = $_POST['id'];

        $q = "DELETE FROM `deals` WHERE `id`='$id'";

        mysqli_query($c, $q);

    } else if ($req == "edit_deal") {
        
        if (
            !isset($_POST['id']) ||
            !isset($_POST['info']) ||
            !isset($_POST['salary']) ||
            !isset($_POST['title']) ||
            !isset($_POST['hours'])
        ) return;
        $id =    ($_POST['id']);
        $info =  ($_POST['info']);
        $salary= ($_POST['salary']);
        $title = ($_POST['title']);
        $hours = ($_POST['hours']);
            
        $h = new helper;

        $h->_Connection($c);

        $h->Update('deals', [
            ["info", $info],
            ["salary", $salary],
            ["title", $title],
            ["hours", $hours],
        ], [
            ['id', '=', $id]
        ]);


    } else if ($req == "add_deal"){

          
        if (
            !isset($_POST['info']) ||
            !isset($_POST['salary']) ||
            !isset($_POST['title']) ||
            !isset($_POST['hours'])
        ) return;


        $id =    'id_' . rand(9999, 99999999);
        $info =  ($_POST['info']);
        $salary= ($_POST['salary']);
        $title = ($_POST['title']);
        $hours = ($_POST['hours']);
        $json_data = '[]';



        // add new deal
        $q = "INSERT INTO `deals`(`id`, `title`, `info`, `Salary`, `hours`, `json_data`)
         VALUES ('$id', '$title', '$info', '$salary', '$hours', '$json_data')";

        mysqli_query($c, $q);


            

    } else if ($req == "GetAdminLink") {
        if (!isset($_POST['MeetId'])) return;

        $id = $_POST['MeetId'];


        $l = new LOGIN_SESSION;
        $l->_Connection($c);

        $h = new helper;
        $h->_Connection($c);


        if ($l->IsAdmin() == false) return;


        $d = $h->GetAll('rooms', [
            ["ID_Meet", "=", "$id"]
        ], 1, false);

        $d = $d[0];


        $tpeer = $d['teacherPeerId'];
        $speer = $d['studentPeerId'];

        if ($tpeer == "null" || $speer == "null") {
            echo "state-not-yet";
            return;
        }

        // $link = "http://localhost/project5/liveroom/?adminAccess=true&idmeet=$id&speer=$speer&tpeer=$tpeer";
        $link = "$_url/liveroom/?adminAccess=true&idmeet=$id&speer=$speer&tpeer=$tpeer";

        echo $link;


    } else if ($req == "isAdmin") {
        $l = new LOGIN_SESSION;
        $l->_Connection($c);
        if ($l->IsAdmin() == true) {
            echo 'true';
            return;
        }
        echo 'false';
        return;
    }
}