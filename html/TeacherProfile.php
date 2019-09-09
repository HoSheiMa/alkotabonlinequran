<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teacher Profile</title>
</head>
<body>
    

    <?php 
    
    if (!isset($_GET['email'])) {
        echo "<script> window.location.assign('/') </script>";
    }

    // echo $_GET['email'];
    
    ?>


<div class="teacher-profile ui container">



<div class="loading">
<h3>loading...</h3>
</div>

<div class="teacher-profile-contxt ">

    <div class="top-s row--" style="margin:0;padding:0;">
        <img class="col col-sm-12 col-md-6 col-lg-4 col-xl-4 " />
        <div class="info col">
            <h2 class="name"></h2>
            <p class="email"></p>
            <p class="info_"></p>
        </div>
    </div>
    <div class="line"></div>
    <h2 class="title">Teacher's CV</h2>
    <div class="teacher-cv">

        <div class="cv-card">

            <img />

        </div>

    </div>

</div>


</div>


    <script src="./js/TeacherProfile.js"></script>
</body>
</html>