<?php
include_once __DIR__ .'/helper.php';

 class PageViews extends helper{

    public $c = null;

    public function _Connection($c) {
        $this->c = $c;
    }
    public function getPageCode($id) {
        $h = new helper;

        $h->_Connection($this->c);

        $d = $h->GetAll('menu', [
            ["id", "=", "$id"],
            ["visible", "=", 'on']
        ], false, false); 

        $code = $d[0]['code'];

        return $code;

    }
    public function getkeywords($id) {
        $h = new helper;

        $h->_Connection($this->c);

        $d = $h->GetAll('menu', [
            ["visible", "=", 'on'],
            ["id", "=", "$id"]
        ]); 

        $code = $d[0]['keywords'];

        return $code;

    }
    public function getdescription($id) {
        $h = new helper;

        $h->_Connection($this->c);

        $d = $h->GetAll('menu', [
            ["visible", "=", 'on'],
            ["id", "=", "$id"]
        ]); 

        $code = $d[0]['description'];

        return $code;

    }
    public function gettitle($id) {
        $h = new helper;

        $h->_Connection($this->c);

        $d = $h->GetAll('menu', [
            ["visible", "=", 'on'],
            ["id", "=", "$id"]
        ]); 

        $code = $d[0]['title'];

        return $code;

    }
    
     public function AddNewLink ($title, $id, $type, $GroupName,  $code, $visible, $description, $keywords) {


        $q = "INSERT INTO `menu`(`title`, `id`, `type`, `GroupName`, `code`, `visible`, `keywords`, `description`)
        VALUES ('$title', '$id', '$type', '$GroupName',  '$code', '$visible', '$keywords', '$description')";
    

        mysqli_query($this->c, $q);

    }

    public function UpdateLink ($title, $id, $type, $GroupName, $code, $visible, $description, $keywords) {
        $h = new helper;

        $h->_Connection($this->c);

        $h->Update(
            'menu',
            [
                ['title', "$title"],
                ['type', "$type"],
                ['GroupName', "$GroupName"],
                ['code', "$code"],
                ['visible', "$visible"],
                ['description', "$description"],
                ['keywords', "$keywords"],
            ],
            [["id", '=', "$id"]]
            
        );

    }
    public function GetLinks($state, $id = null) {

        if ($state == '*') {
            
            $h = new helper;

            $h->_Connection($this->c);

            $d = $h->GetAll('menu', [
            ], false, false); 

            return $d;
            
        } else {

            $h = new helper;

            $h->_Connection($this->c);

            $d = $h->GetAll('menu', [
                ['id', '=', "$id"]
            ]); 

            return $d[0]; // for get just one link data
        

        }
        
    }
    public function DeleteLink ($id) {

        $q = "DELETE FROM `menu` WHERE `id`='$id'";

        mysqli_query($this->c, $q);


    }
    public function getMenuLinks () {

        $h = new helper;

        $h->_Connection($this->c);

        $d = $h->GetAll('menu', [
            [
              "visible", "=", 'on',
            ],
        ]); 

        $html = '';

        $d = array_reverse($d,  false);

        for ($i=0; $i < sizeof($d); $i++) {

            $title = $d[$i]['title'];
            $type = $d[$i]['type'];
            $id = $d[$i]['id'];
            $code = $d[$i]['code'];
            $GroupName = $d[$i]['GroupName'];
            if ($GroupName == "Null") {
                if ($type == "External_link") {
                    $l = "<a class=\"item\" href=\"{$code}\">{$title}</a>";
                } else {
                    $l = "<a class=\"item\" href=\"Links.php?q=$id\">{$title}</a>";

                }
                $html = $html . $l;                

            } else if ($GroupName == "") {

                $dropDownLinksHtml = "";
                $dropDownLinks = $h->GetAll('menu', [
                    [
                      "visible", "=", 'on',
                    ],
                    ["GroupName", "=", "$id"]
                ]); 

                for ($ii=0; $ii < sizeof($dropDownLinks); $ii++) {
                    $_dropDownLinksHtml= "<a class=\"item\" href=\"{$dropDownLinks[$ii]['code']}\">{$dropDownLinks[$ii]['title']}</a>";
                    $dropDownLinksHtml = $dropDownLinksHtml . $_dropDownLinksHtml;

                }
                $l = '<div class="ui  dropdown item">
                ' . $title . ' <i class="dropdown icon"></i>
                <div class="menu">
                 ' . $dropDownLinksHtml . '
                </div>
              </div>';
              $html = $html . $l;                


            }

            

        }
        return $html;

    } 
    

 }