<!DOCTYPE html>
<html>
<?php

// string this app 22/2/2019
// gmail : qandilafa@gmail.com


include_once './config/db_config.php';
include_once './Class/dashboard.php';
include_once './Class/PageViews.php';


$d = new dashboard();
$d->_Connection($c);
$data = $d->WebInfo();

$description = $data['description'];
$keywords = $data['keywords'];
$WebTitle = $data['WebTitle'];
$WebState = $data['WebState'];
$ico = $data['ico'];

$Views = json_decode($data['Views'], true);

$d->UpdateViews($Views);

$pv = new PageViews;
$pv->_Connection($c);

?>
<head>
  <meta charset="utf-8" />
  <link rel="shortcut icon"  href="<?php echo $ico; ?>" />

  <meta name="description" content="<?php echo $description; ?>">
  <meta name="keywords" content="<?php echo $keywords; ?>">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>
    <?php echo $WebTitle; ?>
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="lib/semantic.min.css">

  <link rel="stylesheet" media="screen" href="css/style.css" />
  <link rel="stylesheet" media="screen" href="css/helper.css" />

  <link rel="stylesheet" href="lib/swiper.min.css">
</head>


<style>
  .swiper-container {
    width: 100%;
    padding-top: 50px;
    padding-bottom: 50px;
  }

  .swiper-slide {
    background-position: center;
    background-size: cover;
    width: 300px;
    height: 400px;
  }
</style>

<body>



  <div class='loading-page col text-center' style='padding-top: calc(50vh - 75px);'>
    <img src='assets/loading.gif'>
  </div>

  <div class="cover_nav_bar">
      <div class="ui small menu own_nav_bar">
      <?php
      

      echo $pv->getMenuLinks();
      ?>

<img style="position: absolute; right: 2%; top: 5%" width=70 height=70 src="<?php  echo $ico; ?>" />
</div>
 
        <div class="mobile-version">
          <i class="ui icon bars" onclick="$('.mobile-version-links').slideToggle('fast'); $(this).toggleClass('arrow').toggleClass('up').toggleClass('bars')"></i>
          <img src="<?php  echo $ico; ?>" />
        </div>
        <div class="mobile-version-links">
        <?php
      

      echo $pv->getMenuLinks();
      ?>
    </div>
        </div>
</div>
  <div class='page-1' id='page-1'>
    <div style='z-index:4;'>
      <div class="ui inverted segment container" style='background:transparent'>
        <div class="ui inverted secondary pointing menu" style='border:none'>
          <div class="ui sidebar inverted vertical menu">

<div class="ui icon top left pointing dropdown button">
  <i class="wrench icon"></i>
  <div class="menu">
    <div class="header">Display Density</div>
    <div class="item">Comfortable</div>
    <div class="item">Cozy</div>
    <div class="item">Compact</div>
    <div class="ui divider"></div>
    <div class="item">Settings</div>
    <div class="item">
      <i class="dropdown icon"></i>
      <span class="text">Upload Settings</span>
      <div class="menu">
        <div class="item">
          <i class="check icon"></i>
          Convert Uploaded Files to PDF
        </div>
        <div class="item">
          <i class="check icon"></i>
          Digitize Text from Uploaded Files
        </div>
      </div>
    </div>
    <div class="item">Manage Apps</div>
    <div class="item">Keyboard Shortcuts</div>
    <div class="item">Help</div>
  </div>
</div>
          </div>
        </div>
        
      </div>

      <div class='ui container ' style='margin-top:8rem;'>
        <h1 class='ui text-dark' style='font-size: 5rem'>Al-Kotab Online </h1>
        <div class='w-25 bg-dark m-4' style='height:4px;'></div>
        <div class='w-50 w-sm-100'>
          <h4 class='text-dark pb-2' style='width:100%'>
            Studying the Quran Online has been one of the most accommodating and viable strategies that help Muslims
            all
            around the globe about the teaching of the Quran and Islam. The primary motive of our institute is to give
            Quran classes in a simple and adaptable way to children and seniors at their house; it's pretty easier than
            you
            can think. Currently, you and your children can gain the information of Islam at their home in front of
            your
            eyes, so no compelling reason to push your children far away to a mosque to learn Quran with Tajweed.
            Al-Kotab
            Online can assist you in reading the Quran with proper rules of Tajweed and enhance your recitation of
            Quran.
          </h4>
        </div>
        <div class="ui labeled button mt-5 ml-5" tabindex="0">
          <div class="ui bg-dark button text-white">
            <a href='sections.php?q=signup'><i class="heart icon red"></i> Sign Up</a>
          </div>
          <a href='sections.php?q=login' class="ui basic  left pointing label ">
            Log In
          </a>
        </div>

      </div>
    </div>

  </div>
  <div class='ui container'>
    <div class='page-2  ui grid   p-0 m-0'>
      <div class='four  wide columns'>
        <img class='w-sm-90' src='assets/learngit-teaser.gif'>
      </div>
      <div class='four  wide columns w-50 w-sm-90 mb-3' style='margin-top: 6rem'>
        <h3 class='text-dark '>
          WHY CHOOSE AL-KOTAB ONLINE FOR QURAN LEARNING?
        </h3>
        <h5 class='text-grey '>
          We offer you and your family members with services of Quran reading & learning, Quran recitation, and holy
          Quran's understanding through the knowledge and intelligence of our expertly trained holy Quran Teachers.
          Al-Kotab Online has tremendous involvement in Quran Tutoring online, and we are serving students from
          everywhere throughout the world.

        </h5>
      </div>


    </div>
  </div>
  <div class='bg-img'>
    <div class='ui container p-2'>
      <div class="ui two column grid ">
        <div class="column w-sm-95">
          <div class="ui raised segment">
            <a class="ui red ribbon label">Professional and Experienced Teachers</a>
            <p>All our Online Quran Teachers have years of experience of teaching Quran online. Our educators are not
              only known for their knowledge but also for their interpretational skills to pick up encouragement and
              motivation in students to expand the learning of the Quran to an ever increasing extent. Our educators
              are
              qualified to teach the Quran and good in communication skills.
            </p>
            <a class="ui blue ribbon label">24*7 Learn Online </a>
            <p>Al-Kotab Online is available online round the clock. No issues where you live on earth you can have our
              services online at your own convenient time.
            </p>
          </div>
        </div>
        <div class="column w-sm-95">
          <div class="ui segment" style='padding-bottom:2.4rem'>
            <a class="ui orange right ribbon label">One to One</a>
            <p>We are putting forth one to one Quran tuition which implies the instructor will dedicatedly teach one
              student in a session.
            </p>
            <a class="ui teal right ribbon label">Basic Quran Reading </a>
            <p>This course has been set up for children who don't have any earlier Quran training. Our exceptionally
              qualified online Quran mentor instructs the norani Qaida first so they may distinguish compilation of
              words
              effectively. This strategy enables the kids to figure out how to read the Quran in the ideal accent of
              Arabic.
            </p>
          </div>
        </div>

        <div class="column w-sm-95">
          <div class="ui raised segment">
            <a class="ui violet ribbon label">Online Quran Memorization course </a>
            <p>A large number of Muslim parents want to influence the Quran to memorize to their youngsters yet because
              of inaccessibility of skilled tutors they remain deprived of this extraordinary chance. Hence, Al-Kotab
              online is putting forth the total services of online Quran memorization under the supervision of talented
              teachers.

            </p>
            <a class="ui blue ribbon label">Arabic Quran Reading Online </a>
            <p>In this Online Quran Course, the student will get familiar with the proper pronunciation of the Arabic
              alphabets, how to join letters and figure out how to read The Quran. The teacher will guide kids the
              points how to pronounce and where to pronounce the Arabic alphabets effectively. After learning Qaida,
              the student can read The Quran under the instructor's supervision. All our teachers are certified and
              meet all requirements to teach utilizing the Qaaedah Nooranyiah. After taking this course, your child
              will begin reading the Quran with right pronunciation in the Arabic accent.

            </p>
            <a class="ui green ribbon label">Reading Quran with Tajweed </a>
            <p>Reading Quran with Tajweed is mainly obligatory on each Muslim who needs to recite The Holy Quran. Quran
              reading with Tajweed is usually, reading Quran with right and correct pronunciation or in a manner by
              which it has been uncovered.Under this course, the student will get familiar with the fundamental rules
              of Tajweed online and apply it while reading the Quran under the supervision of master Online Quran
              Teacher.

            </p>
          </div>
        </div>
        <div class="column w-sm-95">
          <div class="ui segment" style='padding-bottom:2.4rem'>
            <a class="ui olive right ribbon label">Quran Memorization Online </a>
            <p>Memoizing The Holy Quran is the dream of each Muslim. In any case, our bustling schedule and absence of
              appropriate guidance of a certified teacher is the greatest obstacle in the process of memorization.
              Al-Kotab Online is giving you the chance to retain The Holy Quran online at your home. The most important
              significance of remembering the Quran is the flexible schedule and regularity. Our online Quran
              Memorization educators will help you amid the entire procedure and give you tips to retain the Holy
              Quran.

            </p>
            <a class="ui teal right ribbon label">Online Quran Translation (Tafseer) </a>
            <p>Quran is the timeless speech of Allah (SWT) and to realize what He is advising to us is the most
              outstanding thing in the conduct of a Muslim. Quran and Hadith are the chief starting points of knowledge
              and guidance to all, so it is essential to understand the Quran, the words of Allah (SWT), to live as per
              the directed orders. We are putting forth Online Tafseer Course in English and Urdu (translation and the
              meaning of The Holy Quran).

            </p>
          </div>
        </div>










        <!-- //// -->


        <div class="column w-sm-95">
          <div class="ui raised segment">
            <a class="ui violet ribbon label">About Us</a>
            <p>Al-kotab-online is a leading Quran learning center in Egypt. Knowing and following the divine path is the ultimate goal of living. Intending to make this possible, we brought the ultimate guide for learning the Quran.

By using this valuable online platform, we focus to reach globally to help the one in need. Now students can get the advancement of learning from the best faculty who has excelled in their field. We at al-kotab believe to excel in the learning students need a different set of guidance based on their capabilities.

Hence with this motive, we provide effective learning for kids, beginners and professionals. Our courses are considered as one of the best course as it is updated as per the standards. Our descriptive and detailed course helps the student to relate the teaching with practical situations.

            </p>
            <a class="ui blue ribbon label">Why Choose Al-Kotab Online For Quran Learning?</a>
            <p>We aim to provide quality learning by developing different course structure as per the requirement of learners. Our team is efficiently trained and has more than 7 years of experience in this field. 

Teachers believe in providing one to one session to give full attention to learning. Classes are conducted through the web camera, and that helps the learner to have an interactive session.

            </p>
            <a class="ui green ribbon label">Team of trained and experienced faculty </a>
            <p>Our teachers are professionally trained and have years of experience of teaching Quran. Faculty members not only deliver quality teaching but also motivate and inspire to learn the verses by developing a sense of responsibility among students. They possess all the required skills, including excellent communication and interpersonal skills.



            </p>
          </div>
        </div>
        <div class="column w-sm-95">
          <div class="ui segment" style='padding-bottom:2.4rem'>
            <a class="ui olive right ribbon label">Learn Quran 24*7 online </a>
            <p>Al-Kotab platform is available online 24*7.  Irrespective of boundaries, you can be online every day and learn Quran at your convenience.
 


            </p>
            <a class="ui teal right ribbon label">One-on-one sessions</a>
            <p>Al-Kotab believes in organizing one-on-one Quran tuition, which implies the instructor will dedicatedly teach one student in a session.
Courses Offered by Al-Kotab Online
            </p>
            
            <a class="ui yellow right ribbon label">Quran for professionals</a>
            <p>To master the teaching technique, we have designed a special course, which mainly focuses on building up professionalism among the learners.
            </p>


            <a class="ui teal right ribbon label">Basic Quran Reading</a>
            <p>This course is entitled to beginners, who have no prior knowledge about the Quran. Faculty members pay special attention to these students as; generally, they are between the age group of 4- 14 years. They are made to learn the basics and the ideal accent of reciting holy Quran.</p>
           
            <a class="ui green right ribbon label">Quran learning for kids</a>
            <p>This course is designed for the kids between the age group of 4- 15 years. This course has visual lessons to make the learning interesting.</p>
      
          </div>
        </div>


        <!--  -->
        

        <div class="column w-sm-95">
          <div class="ui raised segment">
            <a class="ui violet ribbon label">Online Quran learning for beginners
</a>
            <p>This course is designed for people having little or no prior knowledge about the Quran. In the initial months, they are made to learn the basics and words, and once they master the basics, then they begin with the advanced lesson.

            </p>
            <a class="ui blue ribbon label">Mission
</a>
            <p>The mission of our organization is to convey the message of Allah by spreading the teachings globally. The ultimate goal is to teach the learning of Quran and spread the importance of learning to the young generation. Quran is the
 
 The ultimate guide for happy living and this is only possible when the generation understands the importance of following the divine path. We focus on framing structure for every course to make the learning specific and exciting as per the different requirements.
 
 The tools of Quran memorization are the course build up to make students learn the techniques quickly and also strong by delivering the right teaching and making the learners respects the values and knowledge. We developed the teaching on online platform to make it easy for the kids and female learners who can't leave their house for learning.
 </p>
            
          </div>
        </div>
        <div class="column w-sm-95">
          <div class="ui segment" style='padding-bottom:2.4rem'>
            <a class="ui olive right ribbon label">Vision</a>
            <p>The structure of this course is to make students familiar with the rules of Tajweed and also to apply them while reading the Quran. It is challenging to recite the holy Quran with correct rules and pronunciation. Therefore the primary purpose of this course is to master the art of reciting by following all the rules. This course is completed by one of the most experienced faculty.

            </p>
            <a class="ui teal right ribbon label">ambitions & wishes
</a>
            <p>
            We wish to make the Arabic language one of the most widely spoken languages and to create awareness all around the globe for its identity and uniqueness.
We want Al- Kotab, as one of the best Arabic and Quran learning platforms by means of bringing the emerging theoretical concept and practical learning together in Islamic educational system.

            </p>


        
          </div>
        </div>


        <!--  -->
        <div class="column w-sm-95">
          <div class="ui raised segment">
            <a class="ui violet ribbon label">Arabic class</a>
            <p>From beginners to advanced level, this course is designed to prepare students to know everything about the Arabic language, i.e. reading, writing, reciting expressions and use of correct grammar. The course is designed in such a manner that helps students to revise on regular intervals.

            </p>
            <a class="ui blue ribbon label">Online Quran Memorization course</a>
            <p>It gives immense pleasure to the parents seeing their kids memorizing the verses from the Quran. But due to lack of practice, they tend to forget the pronunciation and accent of Arabic. We focus on regular revision and correct use of Quran memorization tools for your kids. Our service has efficiently benefitted thousands of students, and they fluently recite without any errors.
</p>
            <a class="ui green ribbon label">Arabic Quran Reading Online
</a>
            <p>

            The focus of this course is to make the students familiar with the common pronunciation techniques and is given knowledge of joining of letter to frame words and sentences. Proper guidance is also given for learning Qaida. After
 
 Completing this course, students can recite and write without any mistakes under faculty supervision.
 

            </p>
          </div>
        </div>
        <div class="column w-sm-95">
          <div class="ui segment" style='padding-bottom:2.4rem'>
            <a class="ui olive right ribbon label">Quran reading with Tajweed</a>
            <p>The structure of this course is to make students familiar with the rules of Tajweed and also to apply them while reading the Quran. It is challenging to recite the holy Quran with correct rules and pronunciation. Therefore the primary purpose of this course is to master the art of reciting by following all the rules. This course is completed by one of the most experienced faculty.

            </p>
            <a class="ui teal right ribbon label">Quran Memorization Online
</a>
            <p>This course is designed to make the process of memorizing the Quran easy. For every age group, we have a set of techniques, which needs to be followed to learn the verses and remember them. We have experimented the methods and then implemented them to follow. Therefore we keep our words by saying this, we believe in excelling, whatever we are doing.


            </p>
            
            <a class="ui yellow right ribbon label">Online Quran translation (Tafseer)
</a>
            <p>Quran is the sayings and teachings of Allah that mankind need to follow to have a good living on this planet. While following the Islamic culture, it is essential to know the values behind these teachings. To make this learning grow in this generation, we have included Online Quran translation course. This course is a translation from Urdu to English and vice versa. By this course, it becomes easy for students to understand the verses
</p>


        
          </div>
        </div>


      </div>
    </div>
  </div>

  <div class='ui container'>


    <div class='small-page-3 p-0 m-0  row-- text-center'>
      <div class='col-sm-12 col-md-6 col-lg-3 col-xl-3'>
        <img src='assets/success.gif' class='w-sm-100'>
      </div>
      <div class='col-sm-12 col-md-6 col-lg-6 col-xl-6 text-center pt-0 pt-sm-5'>

        <h2 style='margin-left:7rem;' class='text-blue-0 ml-0  ml-sm-5 mt-0 mt-sm-5'>So, without wasting time let’s
          begin your journey to learn Quran with Al-Kotab Online.
        </h2>
        <div class="ui buttons mt-4">
          <button class="ui primary  button">Sing Up</button>
          <div class="or"></div>
          <button class="ui  primary button">Log In</button>
        </div>
      </div>
    </div>
  </div>


  <div class='bg-img'>
    <div class='ui container' style='height:auto;'>

      <h2 class="ui center aligned icon header text-white">
        <i class="circular users icon "></i>
        Best Teachers
      </h2>
      <div class="swiper-container">
        <div class="swiper-wrapper">


          <div class="swiper-slide">
            <div class="ui special cards">
              <div class="card">
                <div class="blurring dimmable image">
                  <div class="ui dimmer">
                    <div class="content">
                      <div class="center">
                        <div class="ui inverted button">Add Friend</div>
                      </div>
                    </div>
                  </div>
                  <img src="assets/men.jpg">
                </div>
                <div class="content">
                  <a class="header">Team Fu</a>
                  <div class="meta">
                    <span class="date">Created in Sep 2014</span>
                  </div>
                </div>
                <div class="extra content">
                  <a>
                    <i class="users icon"></i>
                    2 Members
                  </a>
                </div>
              </div>
            </div>

          </div>

          <div class="swiper-slide">
            <div class="ui special cards">
              <div class="card">
                <div class="blurring dimmable image">
                  <div class="ui dimmer">
                    <div class="content">
                      <div class="center">
                        <div class="ui inverted button">Add Friend</div>
                      </div>
                    </div>
                  </div>
                  <img src="assets/men.jpg">
                </div>
                <div class="content">
                  <a class="header">Team Fu</a>
                  <div class="meta">
                    <span class="date">Created in Sep 2014</span>
                  </div>
                </div>
                <div class="extra content">
                  <a>
                    <i class="users icon"></i>
                    2 Members
                  </a>
                </div>
              </div>
            </div>

          </div>


          <div class="swiper-slide">
            <div class="ui special cards">
              <div class="card">
                <div class="blurring dimmable image">
                  <div class="ui dimmer">
                    <div class="content">
                      <div class="center">
                        <div class="ui inverted button">Add Friend</div>
                      </div>
                    </div>
                  </div>
                  <img src="assets/men.jpg">
                </div>
                <div class="content">
                  <a class="header">Team Fu</a>
                  <div class="meta">
                    <span class="date">Created in Sep 2014</span>
                  </div>
                </div>
                <div class="extra content">
                  <a>
                    <i class="users icon"></i>
                    2 Members
                  </a>
                </div>
              </div>
            </div>

          </div>


          <div class="swiper-slide">
            <div class="ui special cards">
              <div class="card">
                <div class="blurring dimmable image">
                  <div class="ui dimmer">
                    <div class="content">
                      <div class="center">
                        <div class="ui inverted button">Add Friend</div>
                      </div>
                    </div>
                  </div>
                  <img src="assets/men.jpg">
                </div>
                <div class="content">
                  <a class="header">Team Fu</a>
                  <div class="meta">
                    <span class="date">Created in Sep 2014</span>
                  </div>
                </div>
                <div class="extra content">
                  <a>
                    <i class="users icon"></i>
                    2 Members
                  </a>
                </div>
              </div>
            </div>

          </div>

          <div class="swiper-slide">
            <div class="ui special cards">
              <div class="card">
                <div class="blurring dimmable image">
                  <div class="ui dimmer">
                    <div class="content">
                      <div class="center">
                        <div class="ui inverted button">Add Friend</div>
                      </div>
                    </div>
                  </div>
                  <img src="assets/men.jpg">
                </div>
                <div class="content">
                  <a class="header">Team Fu</a>
                  <div class="meta">
                    <span class="date">Created in Sep 2014</span>
                  </div>
                </div>
                <div class="extra content">
                  <a>
                    <i class="users icon"></i>
                    2 Members
                  </a>
                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>
      </div>


    </div>
  </div>
  <div class='bottom-web-bg border-0'>
    <div class='ui container bottom-web'>


      <div class='row--'>
        <div class='col-8 p-5 text-white'>
          <h3>About Web</h3>
          <h5>

            Studying the Quran Online has been one of the most accommodating and viable strategies that help Muslims
            all
            around the globe about the teaching of the Quran and Islam. The primary motive of our institute is to give
            Quran classes in a simple and adaptable way to children and seniors at their house; it's pretty easier than
            you can think. Currently, you and your children can gain the information of Islam at their home in front of
            your eyes, so no compelling reason to push your children far away to a mosque to learn Quran with Tajweed.
            Al-Kotab Online can assist you in reading the Quran with proper rules of Tajweed and enhance your
            recitation
            of Quran.
          </h5>


        </div>
        <div class='col-4 pt-5 text-white'>
          <h3>Group Links</h3>
          <a class='ml-0 ml-sm-3' href='#'>link Title</a>
          <br />
          <a class='ml-0 ml-sm-3' href='#'>link Title</a>
          <br />
          <a class='ml-0 ml-sm-3' href='#'>link Title</a>
          <br />
          <a class='ml-0 ml-sm-3' href='#'>link Title</a>
          <br />
          <a class='ml-0 ml-sm-3' href='#'>link Title</a>
          <br />
          <a class='ml-0 ml-sm-3' href='#'>link Title</a>
          <br />
          <a class='ml-0 ml-sm-3' href='#'>link Title</a>

        </div>
      </div>
      <div class='col text-center'>

        <div class=' bg-danger mb-3' style='width: 100% ; height: 1px;'> </div>
      </div>

      <div class='row-- m-1'>

        <div class='col text-center'>
          <button class="ui circular facebook icon button">
            <i class="facebook icon"></i>
          </button>
          <button class="ui circular twitter icon button">
            <i class="twitter icon"></i>
          </button>
          <button class="ui circular linkedin icon button">
            <i class="linkedin icon"></i>
          </button>
          <button class="ui circular google plus icon button">
            <i class="google plus icon"></i>
          </button>

        </div>
      </div>


    </div>
  </div>

  
  <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script src="lib/semantic.min.js"></script>
  <script src='lib/jquery.nicescroll.iframehelper.min.js'></script>
  <script src='lib/jquery.nicescroll.min.js'></script>

  <script src='lib/swiper.min.js'></script>

  <script src="lib/particles.min.js"></script>


<script src="js/helper.js"></script>
  <script src="js/script.js"></script>
</body>

</html>