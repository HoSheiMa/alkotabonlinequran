<?php
class Forms extends meet {

    public function Table ($nameteacher, $state, $t, $day, $date, $id){
        return "
        <tr>
        <td>$nameteacher</td>
        <td>$date</td>
        <td>$t</td>
        <td style='color: #ffbb33'>$state</td>
        <td>
        <a href='#' style='color: #ff4444'>Cancel</a>
        </td>
      </tr>
      ";
    }

    public function SmallSizeTeacher ($c, $name, $img, $info, $star, $email, $me) {
  
        $string =  $this->IsFreetrial($c, $email) == true  ? 'Book a meeting,one free trial' : 'Book a meeting';

        $string =  $this->IshaveHoursDeal($c) == true  ? 'Book a meeting by deal' : 'Book a meeting';

        return "<div class='col col-sm-12 col-md-6 col-lg-4 col-xl-3 mb-3 justify-content-md-center'>
                    <div class='ui special cards'>
            <div class='card'>
                <div class='blurring dimmable image'>
                <div class='ui dimmer'>
                    <div class='content'>
                    <div class='center'>
                        <div onclick='addMeet(`$email`, `$me`)' class='ui inverted button' style='min-width:104px;margin-bottom: 6px;'>Book a meeting</div>
                        <div onclick='window.location.assign(`sections.php?q=TeacherProfile?email=$email`)' class='ui inverted button' style='min-width:140px'>Show Profile</div>
                    </div>
                    </div>
                </div>
                <img src='$img'>
                </div>
                <div class='content'>
                <a class='header'>$name</a>
                <div class='meta'>
                    <span class='date' style='
                    overflow: hidden;
                    white-space:nowrap;
                    text-overflow:ellipsis;
                    width: 100%;
                    display:inline-block;
                '>$info</span>
                </div>
                </div>
                <div class='extra content'>
                <a>
                    <i class='star icon'></i>
                    $star Star
                </a>

                <a style='margin-left: 10px' onclick='addMeet(`$email`, `$me`)'>
                    <i class='eye icon'></i>
                    $string
                </a>
                </div>
            </div>
            </div>
        
        </div>";
    }

}