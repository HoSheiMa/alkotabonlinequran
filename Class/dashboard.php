<?php

include_once  __DIR__ . '/helper.php';

class dashboard extends helper{



    public function WebInfo() {
        
        
        $data = $this->GetAll('web', [])[0];

        return $data;
    }


    public function UpdateViews($Views) {

        $date =  Date('d-m-Y');

        $found = false;
        for ($i=0; $i < sizeof($Views); $i++) {

            $arrDate = $Views[$i]['date'];
            

            if ($arrDate == $date) {
                $Views[$i]['Views'] += 1;
                $found= true;

                break;
            }

        }

        if ($found == false) {
            array_push($Views,
                array("date" => $date, "Views" => 1)
            );
        }



        $this->Update('web', [
            ["Views", $this->ToJSON($Views)]
        ]);

    }



}