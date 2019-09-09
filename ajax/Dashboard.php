<?php

include '../config/db_config.php';
include '../Class/dashboard.php';
include '../Class/LOGIN_SESSION.php';


if (isset($_POST['req'])) {
    $req = $_POST['req'];

    $l = new LOGIN_SESSION();
    $l->_Connection($c);

    if ($l->IsAdmin() == false) return; // for admin only !


    if ($req == "dashboard"){

        $d = new dashboard();
        $d->_Connection($c);
        $data = $d->WebInfo();

        echo json_encode($data, true);



    } else if ($req == "updatedashboard") {

        
        echo print_r($_POST);

        if ( 

            !isset($_POST['description']) || 
            !isset($_POST['keywords']) || 
            !isset($_POST['WebTitle'])
           
            ) return;

            if ( !isset($_POST['WebState']) ) {
                $_POST['WebState'] = 'off';
            }
            

            $l = new LOGIN_SESSION();
            $l->_Connection($c);
            $d = new dashboard();
            $d->_Connection($c);

        if (isset($_FILES['ico']) && $_FILES['ico']['size'] > 0) {

            $url = $l->UploadProfileImage($_FILES['ico'])->url;

        }

        echo "Hello";

        if (isset($_FILES['ico']) && $_FILES['ico']['size'] > 0) {

            $d->Update('web', [
                
                ["description", $_POST['description']],
                ["keywords", $_POST['keywords']],
                ["WebTitle", $_POST['WebTitle']],
                ["WebState", $_POST['WebState']],
                ["ico", $url]
                
            ], [], false);       
            } else {
        echo "Hello 2";
        echo print_r($_POST);


                echo $d->Update('web', [
                    
                    ["description", $_POST['description']],
                    ["keywords", $_POST['keywords']],
                    ["WebTitle", $_POST['WebTitle']],
                    ["WebState", $_POST['WebState']],
                    
                ], [], false);       
            }
        } 

}
    