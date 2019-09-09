<?php

class helper {

    public $c = null;


      
    public function _Connection ($c) {
        $this->c = $c;
    }


    private function Realcondition($conditions) {

        if (sizeof($conditions) == 0) return 'WHERE 1';

        $firstTime = true;
        
        $sqlContditions = '';
        
        for ($i=0; $i < sizeof($conditions);$i++) {

            $condition = $conditions[$i];


            if ($firstTime == true) {
                $sqlContditions = 'WHERE' . $sqlContditions . ' ' . "`{$condition[0]}`{$condition[1]}'{$condition[2]}'";
                $firstTime = false;

            }  else {
                
                $sqlContditions = $sqlContditions . ' AND ' . "`{$condition[0]}`{$condition[1]}'{$condition[2]}'";


            }


            
        }
        return $sqlContditions;

    }

    private function UpdateValues ($values = []) {

        if (sizeof($values) == 0) return 'WHERE 1';

        $sqlvalues= '';
        
        for ($i=0; $i < sizeof($values);$i++) {
            $value = $values[$i];

            if ($i == 0) {

                $sqlvalues = $sqlvalues . "`{$value[0]}`='{$value[1]}'";
            } else {


                $sqlvalues = $sqlvalues . ", `{$value[0]}`='{$value[1]}'";

            }

        }


        return $sqlvalues;

    }

    public function Update($collation, $newValue = [], $conditions = [], $limit = false) {
        // connection 
        // collation
        // new value
        // conditions ["collaction", "type == > == <", "value"] ! can set more and more

        $conditions  = $this->Realcondition($conditions);

        $values = $this->UpdateValues($newValue);

        if ($limit == false) {
            $q = "UPDATE `$collation` SET $values $conditions";
        } else {
            $q = "UPDATE `$collation` SET $values $conditions Limit $limit";
        }





        mysqli_query($this->c, $q);
        
        // return $q;


    }

    public function Delete($collation, $conditions, $limit){

        $conditions  = $this->Realcondition($conditions);
        
        if ($limit == false) {
            $q = "DELETE FROM `$collation` $conditions";
        } else {
            $q = "DELETE FROM `$collation` $conditions Limit $limit";
        }

        mysqli_query($this->c, $q);

    }

    public function GetAll($collation, $conditions, $limit = false, $type = false) {

        $conditions  = $this->Realcondition($conditions);

        if ($limit == false) {
            $q = "SELECT * FROM `$collation` $conditions";
        } else {
            $q = "SELECT * FROM `$collation` $conditions Limit $limit";
        }


        $r = mysqli_query($this->c, $q);

        return mysqli_fetch_all($r,  ($type == true) ? MYSQLI_NUM :  MYSQLI_ASSOC);

    }

    public function filter($arr = [], $filter = []) {

        for ($i=0; $i < sizeof($arr);$i++) {

            for ($io=0; $io < sizeof($filter);$io++) {
                
                unset($arr[$i][$filter[$io]]);

            }
        
        }

        return $arr;

    }

    public function filterJustReturn($arr = [], $filter = []) {


        $newArr = [];
        
        for ($i=0; $i < sizeof($arr);$i++) {

            for ($io=0; $io < sizeof($arr[$i]);$io++) {
                
                if (!in_array($io, $filter)) {
                    // unset($arr[$i][$io]);
                    continue;
                } else {
                    if (!array_key_exists($i, $newArr)){
                        $newArr[$i] = [];
                    }
                    array_push($newArr[$i], $arr[$i][$io]);
                }

            }
        
        }

        return $newArr;
    }


    public function CloneFromTo($from, $to, $needle = []){ 
        for ($i = 0; $i < sizeof($needle); $i++ ) {
            array_push($to, $from[$needle[$i]]);
        }

        return $to;
    }
    public function ToJSON($arr) {

        return json_encode($arr, true);


    }


}