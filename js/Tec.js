
function AutoView(info, Data = null) {


    window.PageStateValue = '';

    window.Deshboardreload = null;

    if (window.Deshboardreload != null) {
        clearInterval(window.Deshboardreload);
    }



    switch (info) {
        case 'Dashboard':      
            window.PageStateValue = 'Dashboard'
            setTimeout(() => {
                MeetsList()
                window.Deshboardreload = setInterval(function () { MeetsList() }, 60000);
            }, 1);
            return;

        case 'SalaryHistory': 
            window.PageStateValue = 'SalaryHistory'
            ShowSalaryHistory();
            return;


        
            // clearInterval(window.Deshboardreload)


    }
        


}



    function MeetsList() {

        $('.View_admin_contxt .contxt').html(`
        
        <div class=" body-tec" style="margin: 0; padding: 0;">
         <div class="ui container">
      <div class="total-info row-- ">

      <div class="col-6 col-md-3">
         <div class="tec-card ">
            
            <div class="tec-card-title">Meets Today</div>
            <div class="tec-card-value">
            <i class="chart bar outline icon teal "></i>
               <h3 id="MeetsToday">0000</h3>
           </div>

           <i class="chart bar outline icon overicon"></i>

            
         </div>
      </div>

      <div class="col-6 col-md-3">
         <div class="tec-card ">
            
            <div class="tec-card-title">Total Meets</div>
            
           <div class="tec-card-value">
            <i class="calendar check icon brown "></i>
               <h3 id="TotalMeets">0000</h3>
           </div>
            
           <i class="calendar check icon overicon"></i>
         </div>

      </div>


      <div class="col-6 col-md-3">
         <div class="tec-card ">
            
            <div class="tec-card-title">Total Salary</div>
            <div class="tec-card-value">
            <i class="money bill alternate outline icon violet "></i>
               <h3 id="TotalSalary">0000</h3>
           </div>
             <i class="money bill alternate outline icon overicon"></i>
            
         </div>
      </div>

      <div class="col-6 col-md-3">
         <div class="tec-card ">
            
            <div class="tec-card-title">Total Stars</div>
            
            <div class="tec-card-value">
            <i class="star icon yellow "></i>
               <h3 id="TotalStars">0000</h3>
           </div>
           <i class="star icon  overicon"></i>
            
         </div>
      </div>

      </div>
      


      <div class="Meet-list">

      

      <div class="row--" style="padding: 20px 20px 20px 40px">
         <h1>Meets </h1>
      </div>

      <div class="ui segment " style="height: 100px;" id="loadingMeetTable">
         <div class="ui active dimmer">
            <div class="ui indeterminate text loader">Preparing Files</div>
         </div>
         <p></p>
         </div>
      <div style="width:100%;display: flex; justify-content: center; align-items: center">
      <table class="ui very basic table" id="meetTable" style="width: 95%" >
  <thead>
    <tr>
      <th>Teacher Name</th>
      <th>Date</th>
      <th>Time</th>
      <th>State</th>
      <th>Actives</th>
    </tr>
  </thead>
  <tbody id="meetTableContent">
 
        
    
  </tbody>
</table>
      </div>


      </div>


      </div>
      
      </div>
      
      `);

        $.ajax({
            url : './ajax/meet.php',
            type: 'post',
            data: {
                req: 'MeetsListToJson',
                Time: moment().format('ha'),
                Date : moment().format('D-M-Y'),
            },
            beforeSend: () => {
                $('.View_admin_contxt').addClass('loading');
                $('#loadingMeetTable').fadeIn();
                $('#meetTable').fadeOut();
    
    
            },
            success: (d) => {

                console.log(d);
            
            d = JSON.parse(d);


            for (ix in d) {

                t = d[ix][2];

                ttz = d[ix][6]; // teacher Time zone
                
                var local_to_teacherLocal = moment.tz(
                    moment().format('ha'),
                    'ha',
                    moment.tz.guess()
                    );

                var local_teacher_now = local_to_teacherLocal.clone().tz(ttz).format('ha');


                $.ajax({
                    url : './ajax/meet.php',
                    type: 'post',
                    data: {
                        req: 'UpdateMeetsState',
                        Time: local_teacher_now,
                        Date : moment().format('D-M-Y'),
                        id:  d[ix][5],
                    },
                    success: d => {
                        console.log(d);

                       
                    }
                    
                })
                
            }
            MeetsListRender()
        }});





        function MeetsListRender() {

       
    $.ajax({
        url : './ajax/meet.php',
        type: 'post',
        data: {
            req: 'MeetsListToJson',
            Time: moment().format('ha'),
            Date : moment().format('D-M-Y'),
        },
        beforeSend: () => {

            $('.View_admin_contxt').addClass('.loading');



        },
        success: (d) => {


                $('.View_admin_contxt').removeClass('loading');


                var State_color = {
                    Missed : '#ff4444',
                    Prograss: "#ffbb33",
                    "Meet Is Avalible" : "#00C851",
                    "preparing a Meet" : "#33b5e5"
    
                }
    
                console.log(d);
                
                d = JSON.parse(d);
    
                info = ``;
    
    
    
                for (i in d) {
                    
                    nameteacher = d[i][0];
    
                    date = d[i][4];
                    
                    t = d[i][2];
                    
                    id = d[i][5];
    
                    ttz = d[i][6]; // teacher Time zone
    
                    var local_t = moment.tz(t, 'ha', ttz);
    
                    var local = local_t.clone().tz(moment.tz.guess()).format('ha');
    
                    t = local;
    
                    state = d[i][1];
    
                    btn = state == 'Meet Is Avalible' || state == 'preparing a Meet'  ? `<a href='#' class="mr-3" style='color: #00C851' onclick=\"CreateMeetRoom('${id}', '${d[i][8]}')\"><i class='paperclip icon d-inline-block' style='font-size:18px'></i> Enter to meet</a>`  :  '';
    
    
                    info += `
    
                    <tr>
                    <td>${nameteacher}</td>
                    <td>${date}</td>
                    <td>${t}</td>
                    <td style='color: ${State_color[state]};'>${state}</td>
                    <td>
                    ${btn}
                    <a href='#' style='color: #ff4444' onclick="CancelMeet('${id}')">Cancel</a>
                    </td>
                  </tr>
                    
                    `;
    
                }
    
                
    
    
                $('#loadingMeetTable').fadeOut();
                $('#meetTableContent').html(' ').append(info);
                $('#meetTable').fadeIn();
    
            },
        });


        $.ajax({
            url : './ajax/meet.php',
            type: 'post',
            data: {
                req: 'FASTINFOTEACHER',
                date : moment().format('D-M-Y'),
            },

            success : (d) => {
                console.log(d);

                d = JSON.parse(d);

                meets_today = d[0];
                meets_total = d[1];
                TotalSalary = d[2];
                TotalStars = d[3];



                $('#MeetsToday').text(meets_today);
                $('#TotalMeets').text(meets_total);
                $('#TotalSalary').text(TotalSalary);
                $('#TotalStars').text(TotalStars);




                

            }
        })
    
    }
}

function CreateMeetRoom(id, s) {
    window.open(`/liveroom?idmeet=${id}&student=${s}`);
}
    
function profile () {

    $('.profile-section').remove();



    

    $('body').append(`
    
    <div class="profile-section">

        <div class="see--loading">
        <span>Loading...</span>
        </div>

        <div class="wrap">
            <div class="close-btn">
                <i onclick="$(this).parent().parent().parent().remove()" class="arrow right icon"></i>
            </div>

            <div class="profile__img">
                <img />
            </div>

            <div class="u-info">
                <span class="name"></span>
                <span class="Email"></span>
               
                    <div class="ui form" style="display:none">
                    <div class="field">
                        <label>New Password</label>
                        <input type="password" id="newPasswordInput" name="New Password" placeholder="New Password">
                    </div>
                    <button class="ui button" type="submit" onclick="NewPassword()" >Change Now</button>

                    </div>
                    <a  style="margin:5px;" onclick="$(this).prev().show(); $(this).remove()">Change Password</a>

                    <form style="display:none" onchange="NewProfileImage(this)">
                        <input id="profile_img_upload" type="file" name="profile_img">
                    </form>
                    <a style="margin:5px;" onclick="$('#profile_img_upload').click();">Change Profile Image</a>
                
                </div>
            </div>
        </div>

    </div>
    
    `);

    $.ajax({
        url: './ajax/profile.php',
        type: 'post',
        data : {
            req : 'Getinfo',
            type: 'user',

        },
        success: d => {
            d = JSON.parse(d);

            var email = d['email'];
            var name = d['name'];
            var profile_img = d['profile_img'];

            $('.wrap .profile__img img').attr('src', profile_img);
            $('.wrap .u-info .name').text(`${name}`);
            $('.wrap .u-info .Email').text(`${email}`);


            $('.see--loading').hide();
            $('.wrap').show();



        }


    });



}

function NewPassword() {
    p = $('#newPasswordInput').val();
    $.ajax({
        url: './ajax/profile.php',
        type: 'post',
        data : {
            req : 'NewPassword',
            NewPassword: p,
        },
        success: d => {
              $('.profile-section').fadeOut();
        }
    });

}
function NewProfileImage (form) {
    formData = new FormData(form);
    formData.append('req', 'UploadNewImage');

    console.log(formData);


    $.ajax({
        url: './ajax/profile.php',
        type : 'POST',
        data : formData,
        cache: false,
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
        success : function(data) {
            console.log(data);
           
            $('.profile-section').fadeOut();

            profile();

        }
 });


}
    




function ShowSalaryHistory() {
    $.ajax({
        url: './ajax/profile.php',
        type: 'post',
        beforeSend: () => {
            $('.View_admin_contxt').addClass('loading');
        },

        data: {
            req: 'GetSalaryHistroy',
        },

        success: (d) => {

            console.log(d);
            d = JSON.parse(d);

            d1 = d[0];
            d2 = d[1];
            d1_d2_times = [];


            for (i in d1) {
                Dateofd1 = new Date((d1[i]['DATE']).split("-").reverse().join("-")).getTime();

                d1[i]['time'] = Dateofd1
                d1_d2_times.push(Dateofd1)

            }

            for (i in d2) {
                Dateofd2 = new Date((d2[i]['DATE']).split("-").reverse().join("-")).getTime();

                d2[i]['time'] = Dateofd2
                d1_d2_times.push(Dateofd2)


            }

            labels = []; // [d,d,d,d] 
            line_d1 = {}; // [1,1,2,3]
            line_d2 = {}; // %


            d1_d2_times.sort();


            for (i in d1_d2_times) {

                // if label is exist : will add all salary in one column
                // linke 1-1-2019 : $10, 1-1-2019 : $11, will mix all salary in same day
                // final salary of day : 21$ 

                // why we use this if() in day & month 
                // when create date by javascript we return values like 2-2-2002
                // but in php return 02-02-2002
                // and this deffrants in values make problem in equal values
                // we fix it by add 0 in first if number between 1-9 but if biger we not add nothing
                label_date = new Date(d1_d2_times[i]);
                _month = parseInt(label_date.getMonth()) + 1; 
                _month = `${_month}`.length == 1 ?  "0"+_month : _month;
                _day = `${label_date.getDate()}`.length == 1 ? "0"+label_date.getDate() : label_date.getDate();
                lanel_date_format =  _day + "-" + _month + "-" + label_date.getFullYear();


                if (labels.includes(lanel_date_format) == false) {

                    labels.push(
                        lanel_date_format
                    );
                }

                console.log(lanel_date_format);
                exist_d1 = false;

                for (ii in d1) {
                    console.log('1 before if')
                    console.log(d1[ii]['DATE'] == lanel_date_format, d1[ii]['DATE'],lanel_date_format);
                    if (d1[ii]['DATE'] == lanel_date_format) {
                        console.log('1')


                        if (line_d1[lanel_date_format] != undefined) {
                            console.log('1a')

                            line_d1[lanel_date_format] = parseInt(line_d1[lanel_date_format]) + parseInt(d1[ii]['SalaryUsed']);
                        } else {
                            console.log('1b')

                            // console.log(line_d1)
                            line_d1[lanel_date_format] = parseInt(d1[ii]['SalaryUsed']);
                            // console.log(line_d1)

                        }



                        exist_d1 = true;



                    }
                }
                if (exist_d1 == false && line_d1[lanel_date_format] == undefined) {
                    console.log('d1 exit 0', exist_d1, line_d1[lanel_date_format])
                    line_d1[lanel_date_format] = 0;
                }

                exist_d2 = false;
                for (ii in d2) {
                    if (d2[ii]['DATE'] == lanel_date_format) {
                        // console.log(lanel_date_format, d2[ii], line_d2[lanel_date_format]);

                        if (line_d2[lanel_date_format] != undefined) {
                            console.log('2')

                            line_d2[lanel_date_format] = parseInt(line_d2[lanel_date_format]) + parseInt(d2[ii]['SalaryTaked']);
                        } else {
                            // console.log(line_d1)
                            line_d2[lanel_date_format] = parseInt(d2[ii]['SalaryTaked']);
                            // console.log(line_d1)

                        }



                        exist_d2 = true;



                    }
                }
                if (exist_d2 == false && line_d2[lanel_date_format] == undefined) {
                    line_d2[lanel_date_format] = 0;
                }


            }



            console.log(d1, d2, d1_d2_times);
            console.log(labels, line_d1, line_d2);


            line_1 = [];
            line_2 = [];
            html_ = ``;


            for (i in labels) {
                line_1.push(line_d1[labels[i]]);
                line_2.push(line_d2[labels[i]]);

                html_ += `
                <tr>
                    <td>${labels[i]}</td>
                    <td>${line_d2[labels[i]]}$</td>
                    <td>${line_d1[labels[i]]}$</td>
                </tr>
                `;
            }




            // console.log(labels, line_1, line_2)



            html = `
                <div class="teacher-histroy-section">

                    <div class="text-center">

                        <h3>Your Salary History</h3>

                    </div>
                
                    <canvas id="SalaryHistory"  class="col" style="height:460px !important; max-height: 460px !important"></canvas>

                    <table class="ui selectable celled table">
                        <thead>
                            <tr>
                            <th>Day Date</th>
                            <th>Received From Web</th>
                            <th>Received From Students</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${html_}
                        </tbody>
                        </table>

                </div>

            `
            $('.View_admin_contxt .contxt').html(html);

            new Chart(document.querySelector('#SalaryHistory'), {
                "type": "line",
                "data": {
                    "labels": labels,
                    "datasets": [{
                            "label": "The amount has been disbursed",
                            "data": line_1,
                            "fill": true,
                            "borderColor": "rgb(75, 192, 192, .3)",
                            "lineTension": 0.1
                        },
                        {
                            "label": "The amount has not been disbursed",
                            "data": line_2,
                            "fill": true,
                            "borderColor": "rgb(75, 192, 92, .3)",
                            "lineTension": 0.1
                        }
                    ],

                },
                "options": {
                    "responsive": true,
                    "maintainAspectRatio": false,
                }
            });

            $('.View_admin_contxt').removeClass('loading');


        }
    })
}




AutoView('Dashboard')