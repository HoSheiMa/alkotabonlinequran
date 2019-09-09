<?php

if (!isset($_SESSION)) {

    session_start();
}

include __DIR__ . '/../config/db_config.php';



class LOGIN_SESSION {

    public $c = null;
    public $url = null;

    public function Login($email, $type) {
        // session [log] is for see email in live login or not
        $_SESSION['log'] = true;
        
        // session [who] using it for more process and ajax to know who server speaks
        $_SESSION['who'] = $email;
        
        // session [type] useing to know type of relation with server
        $_SESSION['type'] = $type;
    } 


    public function IsBlocked($email) {


        $q = "SELECT * FROM `users` WHERE `BLOCK_STATE`='true'";

        $r = mysqli_query($this->c, $q);


        if ($r->num_rows == 0) {
            return false;
        } else {
            return true;
        }




    }

    public function ProfileInfo ($email = null) {
        if ($email == null) {
            // return me

            $email = $_SESSION['who'];

            $q = "SELECT * FROM `users` WHERE `email`='$email'";

            $r = mysqli_fetch_array(mysqli_query($this->c, $q), MYSQLI_ASSOC);
            
            unset($r['pass']);
            unset($r['permission']);
           



            return json_encode($r, true);

            


        } else {
             // return email address

             $email = $_SESSION['who'];

             $q = "SELECT * FROM `users` WHERE `email`='$email'";
 
             $r = mysqli_fetch_array(mysqli_query($this->c, $q), MYSQLI_ASSOC);
             
             unset($r['pass']);
             unset($r['permission']);
            
 
 
 
             return json_encode($r, true);
        }
    }

    public function UploadImageURL($email, $url) {

        if ($email == null) {
            // me

            $email = $_SESSION['who'];

            $q = "UPDATE `users` SET `profile_img`='$url' WHERE `email`='$email'";

            $r = mysqli_query($this->c, $q);
            

            



        } else {

            // $email = $_SESSION['who'];

            $q = "UPDATE `users` SET `profile_img`='$url' WHERE `email`='$email'";

            $r = mysqli_query($this->c, $q);
            

        }

        
    } 


    public function UploadProfileImage($img, $index = null) {


        if (isset($img)) {

            $types = ['jpg', 'png', 'jpeg'];
            $img___ = !isset($index) ? $img['name'] : $img['name'][$index] ;
            $imgtype = explode('.', 
            $img___
        );
            $imgtype = strtolower(end($imgtype));
        
    
            if (in_array($imgtype, $types)) {
                $err =  !isset($index)  ? $img['error'] : $img['error'][$index];
    
                if ($err == 0) {
                    $sz = !isset($index)  ? $img['size'] : $img['size'][$index];
                    if ($sz <= 10000000) {
    
                        $new_name = uniqid('', true) . "." . $imgtype;
                        $id = uniqid('', true);
    
                        $d = "../assets/$new_name";

    
                        move_uploaded_file(
                            !isset($index) ? $img['tmp_name'] : $img['tmp_name'][$index]
                            ,$d);
    

                        $d = "./assets/$new_name";


                        $this->url = $d;
                        
                        return $this;

                        // $this->UploadImageURL(null, $d);

    
                    }
                }
            }
    
        }
    }

    public function NewPassword ($email, $NewPassword) {
        if ($email == null) {
            // me

            $email = $_SESSION['who'];

            $q = "UPDATE `users` SET `pass`='$NewPassword' WHERE `email`='$email'";

            $r = mysqli_query($this->c, $q);
            

            



        } else {

            // $email = $_SESSION['who'];

            $q = "UPDATE `users` SET `pass`='$NewPassword' WHERE `email`='$email'";

            $r = mysqli_query($this->c, $q);
            

            

        }
    }
    public function LogOut() {

        // session [log] is for see email in live login or not
        $_SESSION['log'] = false;
        
        // session [who] using it for more process and ajax to know who server speaks
        $_SESSION['who'] = '';
        
        // session [type] useing to know type of relation with server
        $_SESSION['type'] = '';

        session_destroy();
        

    }

    public function IsLogin() {

        if (!isset($_SESSION['log']) || $_SESSION['log'] == false) return false;
        if (isset($_SESSION['log'])  && $_SESSION['log'] == true ) return true;

    }
    
    public function _Connection ($c) {
        $this->c = $c;
    }



    private function permission () {
        $email = $_SESSION['who'];

        
        $q = "SELECT * FROM `users` WHERE `email`='$email'";

        
        $r = mysqli_query($this->c, $q);

        
        return mysqli_fetch_array($r);

    }


    public function IsAdmin() {

        $p = $this->permission();

        $p = json_decode($p['permission'], true);
        
        if ($p['permission'] == "admin-permission") {
            return true;
        } else {
            return false;
        }

    }

    public function IsToucher() {

        $p = $this->permission();

        $p = json_decode($p['permission'], true);


        if ($p['permission'] == "Toucher-permission") {
            return true;
        } else {
            return false;
        }

    }


    public function GetInfo() {


        if ($this->c == NULL) return;

        $email = $_SESSION['who'];

        
        $q = "SELECT * FROM `users` WHERE `email`='$email'";

        
        $r = mysqli_query($this->c, $q);

        
        return mysqli_fetch_array($r);

        
    }

}