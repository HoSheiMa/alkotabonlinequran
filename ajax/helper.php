<?php

session_start();

include_once '../config/db_config.php';
include_once '../Class/LOGIN_SESSION.php';
include_once '../Class/helper.php';
include_once '../Class/Admin.php';
include_once '../Class/Teacher.php';
include_once '../Class/PageViews.php';

$_ = new LOGIN_SESSION();
$h = new helper();

$_->_Connection($c);

$h->_Connection($c);



if (isset($_POST['req'])) {


    $req = $_POST['req'];


    if ($_->IsAdmin() == false)  return '{"Error" : "NO-ADMIN-ACCESS"}';


    if ( $req == "GetAllUsers" ) {



        $d = $h->GetAll('users', [
            ["permission", "=", '{"permission" : "No-admin-permission" }'],
        ], false);



        $d = $h->filter($d, ['pass', 'permission']);

        $d = $h->ToJSON($d);

        echo ($d);




    } else if ($req == "GetUsersViews") {
        $d = $h->GetAll('UsersLogin', [], false);

        $d = $h->ToJSON($d);

        echo ($d);

    } else if ($req == "GetTeachersViews") {
        $d = $h->GetAll('UsersLogin', [], false);

        $d = $h->ToJSON($d);

        echo ($d);

    } else if ($req == "toucherinfo") {
        $d = $h->GetAll('users', [], false);

        $h->filter($d, [""]);

        $d = $h->ToJSON($d);

        echo ($d);

    } else if ($req == "AllTeacherRating") {

        $d = $h->GetAll('toucherinfo', [], false, true);

        $d = $h->filterJustReturn($d, [0, 5]); // id, star

        $d = $h->ToJSON($d);

        echo ($d);
        

    
    }else if ($req == "GetAllTeachers") {

       
        $d = $h->GetAll('users', [
        ["permission", "=", '{"permission" : "Toucher-permission" }'],
        ], false);

        $d = $h->filter($d, ['pass', 'permission']);

        for ($i = 0; $i < sizeof($d); $i++) {

            $d[$i] = $h->CloneFromTo(
                $h->GetAll('toucherinfo', [
                    [
                    "ID", "=", $d[$i]["email"]
                    ]
                ], false, true)[0],
                $d[$i],
                [1, 2, 8, 3]); // "TimeactFrom", "TimeactTo", "Salary"
        }

        $d = $h->ToJSON($d);

        echo ($d);
    
    
    }else if ($req == "RemoveThisUser") {

        if (!isset($_POST['email'])) return;
        $a = new Admin();

        $a->_Connection($c);

        $e = $_POST['email'];


        $a->REMOVE_USER($e);



    }else if ($req == "Change_Block_State") {

        if (!isset($_POST['email'])) return;
        if (!isset($_POST['state'])) return;
        $a = new Admin();

        $a->_Connection($c);

        $e = $_POST['email'];
        $s = $_POST['state'];


        echo $a->CHANGE_BLOCK_STATE($e, $s);
        


    }
    else if ($req == "NewPassword") {

        if (!isset($_POST['email'])) return;
        if (!isset($_POST['NewPassword'])) return;
        $a = new Admin();

        $a->_Connection($c);

        $e = $_POST['email'];
        $p = $_POST['NewPassword'];


        echo $a->ChangePasswordOfUser($e, $p);
        


    } else if ($req == "NewSalary") {


        if (!isset($_POST['email'])) return;
        if (!isset($_POST['Salary'])) return;
        $a = new Admin();

        $a->_Connection($c);

        $e = $_POST['email'];
        $s = $_POST['Salary'];


        echo $a->ChangeTeacherSalary($e, $s);


    } else if ($req == "GetSalaryHistroy") {
        if (!isset($_POST['email'])) return ;
        $e = $_POST['email'];


        $d = $h->GetAll('toucherinfo', [
            [
            "ID", "=", $e,
            ]
        ], false, true);

        $d = $h->filterJustReturn($d, [11, 13]);// ["Total_salary_history", "TotalSalaryDoneTake"]);

        $d = $d[0];

        $d[0] = json_decode($d[0]);
        $d[1] = json_decode($d[1]);

        echo $h->ToJSON($d);







    } else if ($req == "AddNewTeacher") {

        echo var_dump($_POST);
        // return;
        if (
            isset($_POST['email']) &&
            isset($_POST['pass']) &&
            isset($_POST['name']) &&
            isset($_POST['info']) &&
            isset($_POST['salary']) &&
            isset($_POST['TimeTo']) &&
            isset($_POST['tz']) &&
            isset($_POST['TimeFrom']) &&
            isset($_POST['ActWeeks']) &&
            isset($_FILES['Profile_cv'])
            ) {

                echo "Here";

                $urls = [];


                // first i will move files 
                $Profile_cv = $_FILES['Profile_cv'];
                for ($i = 0 ; $i < sizeof($Profile_cv['name']); $i++) {
                    
                    $l = new LOGIN_SESSION();
                    
                    $l = $l->UploadProfileImage($Profile_cv, $i);

                    
                    array_push($urls, $l->url);
                    

                    // echo "Profile_cv {$Profile_cv['name'][$i]}";


                }


                $urls = json_encode($urls, true);


                $t = new Teacher();
                $t->_Connection($c);

                $t->AddNewTeacher(
                    ($_POST['email']),
                    ($_POST['pass']),
                    ($_POST['name']),
                    ($_POST['info']),
                    $urls,
                    ($_POST['TimeFrom']),
                    ($_POST['TimeTo']),
                    ( "[" . $_POST['ActWeeks'] . "]"),
                    ($_POST['tz']),
                    ($_POST['salary'])
                );






                

        }
    } else if ($req == "GetallAdmins") {

        $h = new helper();

        $h->_Connection($c);

        $d = $h->GetAll('users', [["permission", "=", '{ "permission" : "admin-permission" }']], false, false);

        $d = $h->filter($d, ['pass']);

        $d = $h->ToJSON($d);

        echo $d;

    } else if ($req == "AddAdmin" && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['name']) ) {
        // echo print_r($_POST);

        $permissioms = [];

        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $name = $_POST['name'];

        if (isset($_POST['Dashboard'])) {
            array_push($permissioms, 'Dashboard');
        }
        if (isset($_POST['Students'])) {
            array_push($permissioms, 'Students');
        }
        if (isset($_POST['Teachers'])) {
            array_push($permissioms, 'Teachers');
        }
        if (isset($_POST['Meets'])) {
            array_push($permissioms, 'Meets');
        }
        if (isset($_POST['AdminsAccess'])) {
            array_push($permissioms, 'AdminsAccess');
        }
        if (isset($_POST['Deals'])) {
            array_push($permissioms, 'Deals');
        }
        if (isset($_POST['Links'])) {
            array_push($permissioms, 'Links');
        }

        

        
        $a = new Admin();

        $a->_Connection($c);

        echo $a->AddNewAdmin($email, $pass,$name, json_encode($permissioms));

        
    } else if ($req == "getAdminInfo") {

        if (!isset($_POST['email'])) return;

        $e = $_POST['email'];


        $h = new helper();

        $h->_Connection($c);


        $t = $h->GetAll(
            'users',
            [
                ['permission', '=', '{ "permission" : "admin-permission" }']
            ],
            1,
            false
        );

        $t = $h->filter($t, ["permission", "pass", "profile_img", "freeCoursestrial"]);

        $i = $h->GetAll('admininfo', [['email', '=', "$e"]], 1, false); // return [ contxt ]

        $t = $h->CloneFromTo($i[0], $t[0], ["permission"]); // contxt[0] to contxt[0] return contxt[0]

        echo $h->ToJSON($t);
        

    } else if ($req == "editAdmin" && isset($_POST['email']) && isset($_POST['name'])) {


             // echo print_r($_POST);

             $permissioms = [];
            
             $email = $_POST['email'];
             $name = $_POST['name'];
     
             if (isset($_POST['Dashboard'])) {
                 array_push($permissioms, 'Dashboard');
             }
             if (isset($_POST['Students'])) {
                 array_push($permissioms, 'Students');
             }
             if (isset($_POST['Teachers'])) {
                 array_push($permissioms, 'Teachers');
             }
             if (isset($_POST['Meets'])) {
                 array_push($permissioms, 'Meets');
             }
             if (isset($_POST['AdminsAccess'])) {
                 array_push($permissioms, 'Admins-Access');
             }
             if (isset($_POST['Deals'])) {
                array_push($permissioms, 'Deals');
            }
            if (isset($_POST['Links'])) {
                array_push($permissioms, 'Links');
            }

            
             $h = new helper();

             $h->_Connection($c);


             
     

             if (isset($_POST['pass'])){ 

                $h->Update('users', [
                    ['email', $email],
                    ['name', $name],
                ],
                [["email", '=', $email]],
                false
            );
             } else {


                $h->Update('users', [
                    ['email', $email],
                    ['name', $name],
                    ['pass', $pass],
                ],
                [["email", '=', $email]],
                false
            );
             }

             $h->Update('admininfo', [
                ["permission", $h->ToJSON($permissioms)],
            ],
            [["email", '=', $email]],
            false);

    } else if ($req == "getAllLinks") {

        $pv = new PageViews;

        $pv->_Connection($c);

        $d = $pv->GetLinks('*', null);

        echo json_encode($d, true);


    } else if ($req == "SetNewLink") {

        if (
            !isset($_POST['title']) ||
            !isset($_POST['description']) ||
            !isset($_POST['keywords']) ||
            !isset($_POST['type']) ||
            !isset($_POST['visible'])
        ) return;

        $GroupName = null;

        if ($_POST['type'] != "BigTitle_link") {
            if (!isset($_POST['Located_inBigData'])) {
                return;
            } else {
                $GroupName = $_POST['Located_inBigData'];
            }
        }


        if ($_POST['type'] == 'Internal_link') {
            if ( !isset($_POST['code'])) return;
            $code = $_POST['code'];
        } else {
            if ( !isset($_POST['link'])) return;
            $code = $_POST['link'];
        }
        $title = $_POST['title'];
        $description = $_POST['description'];
        $keywords = $_POST['keywords'];
        $type = $_POST['type'];
        $visible = $_POST['visible'];

        $id = "id_" . rand(9999, 9999999999);

        $pv = new PageViews;

        $pv->_Connection($c);

         $pv->AddNewLink(
            $title,
            $id,
            $type,
            $GroupName,
            str_replace("'", "\'",$code),
            $visible,
            $description,
            $keywords
        );


    
    } else if ($req == "getInfoLink") {
    
        if (!isset($_POST['id'])) return 'error';
    
        $id = $_POST['id'];
    
        $pv = new PageViews;

        $pv->_Connection($c);

        $d = $pv->GetLinks('', $id);

        echo json_encode($d, true);
        

    } else if ($req == "updateLink")  {

        
        if (
            !isset($_POST['title']) ||
            !isset($_POST['description']) ||
            !isset($_POST['keywords']) ||
            !isset($_POST['type']) ||
            !isset($_POST['visible']) || 
            !isset($_POST['id'])
        ) return;

            $GroupName = null;
        if ($_POST['type'] != "BigTitle_link") {
            if (!isset($_POST['Located_inBigData'])) {
                return;
            } else {
                $GroupName = $_POST['Located_inBigData'];
            }
        }

      
        if ($_POST['type'] == 'Internal_link') {
            if ( !isset($_POST['code'])) return;
            $code = $_POST['code'];
        } else {
            if ( !isset($_POST['link'])) return;
            $code = $_POST['link'];
        }
        $title = $_POST['title'];
        $description = $_POST['description'];
        $keywords = $_POST['keywords'];
        $type = $_POST['type'];
        $visible = $_POST['visible'];

        $id = $_POST['id'];

        $pv = new PageViews;

        $pv->_Connection($c);
        
        $pv->UpdateLink($title, $id, $type, $GroupName, str_replace("'", "\'", $code), $visible, $description, $keywords);

    
    }
     else if ($req == "deleteLink") {

        if (!isset($_POST['id'])) return 'error';

        $id = $_POST['id'];
        
        $pv = new PageViews;

        $pv->_Connection($c);

        $d = $pv->DeleteLink($id);
          
    } else if ($req == "GetBigTitles") {

        $h = new helper;
        $h->_Connection($c);
        $d = $h->GetAll('menu', [
            ['type', "=", "BigTitle_link"]
        ], false, false);

        echo json_encode($d, true);
    } 

}