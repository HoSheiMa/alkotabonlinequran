<!-- 



// get time from to other zone 

moment("1", "h").tz("America/New_York").format("h")



// get name of local zone 
var timezone = moment.tz.guess();

// get time of local zone
var now = moment();
console.log(now.format()); 

// function convert from local zone to other
function toTimeZone(time, zone) {
     var format = 'YYYY/MM/DD HH:mm:ss a';
    return moment(time, format).tz(zone)(format);
}


-->



<?php

include 'config/db_config.php';
// include 'Class/Teacher.php';
// include 'Class/Forms.php';
include 'Class/meet.php'; // meet class include teacher class
include 'Class/Admin.php';

$per = new Admin();
$per->_Connection($c);



if ($_->IsAdmin() == true) {
    
   // admin
   ?>

   <div class="options_bar">
      
      
      <div class="bar bar-off">

         <div class="dashboardlogo">

            <img src="assets/dashboardlogo.png" />

            
         </div>
      

         <?php

            if ($per->hasPermission('Dashboard')) {
               ?>


         
         <div class="bar_option" onclick="AutoView('Dashboard');$(this).parent().toggleClass('bar-off');$('.slider .icon').toggleClass('left').toggleClass('right')">
            <div class="bar_option_icon">
               <i class="chart area icon"></i>
            </div>
            <div class="bar_option_title">
               <span>Dashboard</span>
            </div>
         </div>
         
         <?php
            }
            
            ?>



<?php

if ($per->hasPermission('Students')) {
   ?>
         
         <div class="bar_option" onclick="AutoView('users');$(this).parent().toggleClass('bar-off');$('.slider .icon').toggleClass('left').toggleClass('right')">
            <div class="bar_option_icon">
               <i class="users icon"></i>
            </div>
            <div class="bar_option_title">
               <span>Students</span>
            </div>
         </div>


         <?php
            }
            
            ?>

<?php

if ($per->hasPermission('Teachers')) {
   ?>

         <div class="bar_option" onclick="AutoView('Teachers');$(this).parent().toggleClass('bar-off');$('.slider .icon').toggleClass('left').toggleClass('right')">
            <div class="bar_option_icon">
               <i class="users icon"></i>
            </div>
            <div class="bar_option_title">
               <span>Teachers</span>
            </div>
         </div>

         <?php
            }
            
            ?>

<?php

if ($per->hasPermission('Meets')) {
   ?>

         <div class="bar_option" onclick="AutoView('Meets');$(this).parent().toggleClass('bar-off');$('.slider .icon').toggleClass('left').toggleClass('right')">
            <div class="bar_option_icon">
               <i class="file video icon"></i>
            </div>
            <div class="bar_option_title">
               <span>Meets</span>
            </div>
         </div>

         <?php
            }
            
            ?>



<?php
if ($per->hasPermission('Admins-Access')) {
   ?>

         <div class="bar_option" onclick="AutoView('Admins');$(this).parent().toggleClass('bar-off');$('.slider .icon').toggleClass('left').toggleClass('right')">
            <div class="bar_option_icon">
               <i class="universal access icon"></i>
            </div>
            <div class="bar_option_title">
               <span>Admins Access</span>
            </div>
         </div>

         <?php
            }
            
            ?>


<?php
if ($per->hasPermission('money-Cashing')) {
   ?>

         <div class="bar_option" onclick="AutoView('moneyCashing');$(this).parent().toggleClass('bar-off');$('.slider .icon').toggleClass('left').toggleClass('right')">
            <div class="bar_option_icon">
               <i class="money bill alternate outline icon"></i>
            </div>
            <div class="bar_option_title">
               <span>Money cashing</span>
            </div>
         </div>

         <?php
            }
            
            ?>



<?php
if ($per->hasPermission('Deals')) {
   ?>

         <div class="bar_option" onclick="AutoView('Deals');$(this).parent().toggleClass('bar-off');$('.slider .icon').toggleClass('left').toggleClass('right')">
            <div class="bar_option_icon">
               <i class="tags icon"></i>
            </div>
            <div class="bar_option_title">
               <span>Deals</span>
            </div>
         </div>

         <?php
            }
            
            
            ?>

<?php
if ($per->hasPermission('Links')) {
   ?>

         <div class="bar_option" onclick="AutoView('Links');$(this).parent().toggleClass('bar-off');$('.slider .icon').toggleClass('left').toggleClass('right')">
            <div class="bar_option_icon">
               <i class="linkify icon"></i>
            </div>
            <div class="bar_option_title">
               <span>Links</span>
            </div>
         </div>

         <?php
            }
            
            
            ?>



      </div>

      <div class="slider" onclick="$(this).prev().toggleClass('bar-off');$($(this).children()[0]).toggleClass('left').toggleClass('right')">
         <i class="chevron right icon"></i>
      </div>

   </div>

   <div class="View_admin_contxt">
      <i class="notched circle loading icon"></i>
      <div class="contxt">

      </div>
   </div>
   
   

   <script src="js/adminScripts.js"></script>
   
   
   <?php
    
} else{
   // non admin
   


   // toucher
   if ($_->IsToucher() == true) {

      
      ?>


<div class="options_bar">
      
      
      <div class="bar bar-off">

         <div class="dashboardlogo">

            <img src="assets/dashboardlogo.png" />

            
         </div>
      
         <div class="bar_option" onclick="AutoView('Dashboard');$(this).parent().toggleClass('bar-off');$('.slider .icon').toggleClass('left').toggleClass('right')">
            <div class="bar_option_icon">
               <i class="users icon"></i>
            </div>
            <div class="bar_option_title">
               <span>Dashboard</span>
            </div>
         </div>

         <div class="bar_option" onclick="AutoView('SalaryHistory');$(this).parent().toggleClass('bar-off');$('.slider .icon').toggleClass('left').toggleClass('right')">
            <div class="bar_option_icon">
               <i class="money bill alternate outline  icon"></i>
            </div>
            <div class="bar_option_title">
               <span>Salary History</span>
            </div>
         </div>


      </div>

      <div class="slider" onclick="$(this).prev().toggleClass('bar-off');$($(this).children()[0]).toggleClass('left').toggleClass('right')">
         <i class="chevron right icon"></i>
      </div>

   </div>


   <div class="View_admin_contxt">
      <i class="notched circle loading icon"></i>
      <div class="contxt">


      

      
      </div>
   </div>

   <script src='js/Tec.js'></script>







<?php
   } else {
      // noraml user
      ?>

<div class="options_bar">
      
      
      <div class="bar bar-off">

         <div class="dashboardlogo">

            <img src="assets/dashboardlogo.png" />

            
         </div>
      
         <div class="bar_option" onclick="AutoView('Dashboard');$(this).parent().toggleClass('bar-off');$('.slider .icon').toggleClass('left').toggleClass('right')">
            <div class="bar_option_icon">
               <i class="users icon"></i>
            </div>
            <div class="bar_option_title">
               <span>Dashboard</span>
            </div>
         </div>


         <div class="bar_option" onclick="AutoView('Deals');$(this).parent().toggleClass('bar-off');$('.slider .icon').toggleClass('left').toggleClass('right')">
            <div class="bar_option_icon">
               <i class="tags icon"></i>
            </div>
            <div class="bar_option_title">
               <span>Deals</span>
            </div>
         </div>


      </div>

      <div class="slider" onclick="$(this).prev().toggleClass('bar-off');$($(this).children()[0]).toggleClass('left').toggleClass('right')">
         <i class="chevron right icon"></i>
      </div>

   </div>




   <div class="View_admin_contxt">
      <i class="notched circle loading icon"></i>
      <div class="contxt">


      

      
      </div>
   </div>



      



      <script src='js/User.js'></script>

      

   <?php
   }
    
}