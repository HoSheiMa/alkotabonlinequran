
<?php


include 'Class/LOGIN_SESSION.php';



$_ = new LOGIN_SESSION();




if ($_->IsLogin() == false) {
    echo "<script>window.location.assign('./index.php')</script>";
}

$_->_Connection($c);

$_data = $_->GetInfo();








?>


<div class="row-- bg-dark p-0 m-0" style="height: 60px">

   <div class="col p-3 ">
      <h2 class="text-white">Dashboard</h2>
   </div>
    <div class="col p-4 m-0 text-right">
    <button class="mr-5 bg-transparent border-0">
        <i class="bell outline outline icon text-white"></i>
    </button>
    
            <div class="ui dropdown">
        <div class="text text-white"><?php echo $_data['name']; ?></div>
        <i class="dropdown icon text-white"></i>
        <div class="menu">
            <div class="item" onclick="profile()">Profile</div>
            <div class="item">
            <span class="description">Setting for your email</span>
            Setting
            </div>
            <div class="item" onclick="LogOut()"> 
            <span class="description">quit email</span>
            Log Out
            </div>
        </div>
        </div>
    </div>


</div>

<?php

include 'content.php';



?>