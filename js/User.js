
     
     
     
function AutoView(info, Data = null) {


    window.PageStateValue = '';

    


    switch (info) {
        case 'Dashboard':
            MeetsList();
            window.PageStateValue = 'Dashboard';
            return;
        case 'Deals':
            Deals();
            window.PageStateValue = 'Deals';
            return;

    }
        


}

     
     
     
     
     
     
     
     
     window.days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
      window.DateMeet = null;
      window.TimeMeet = null;



      var parts = window.location.search.substr(1).split("&");
        var $_GET = {};
        for (var i = 0; i < parts.length; i++) {
            var temp = parts[i].split("=");
            $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
        }


        if ($_GET.q.includes('paymentCancel') == true){

            toastr.warning('Canceled !!');
            


        }

        if ($_GET.q.includes('paymentError') == true){

            toastr.error('The reservation has not been booked')


        }

        if ($_GET.q.includes('paymentSuccess') == true){

            toastr.info('The reservation has been booked')


        }



function Deals() {
    



    $.ajax({
        url : './ajax/meet.php',
        type: 'post',
        data: {
            req: 'GetAllDeals',
        },
        beforeSend: () => {

            $('.View_admin_contxt').addClass('loading');

        },
        success: (d) => {


            d = JSON.parse(d);


            html = `

                <div class="row justify-content-center mb-4" style="flex-der">   

                    <h3 class="d-block">Deals</h3>
                
                </div>

                
                <div class="row justify-content-center mb-4" style="flex-der">   

                    <h3 class="d-block" id="deals-hours">You Have 0 hours</h3>
                
                </div>


                <div class="cards-deals-section"> 
                
            `;

            for (i in d) {


                html += `
                
                <div class="deal-card">

                    <div class="deal-card-title">
                        <img src="./assets/crown.png"/>
                        <span>${d[i]['title']}</span>
                    </div>

                    <div class="deal-card-bottom-bar">
                        <span>${d[i]['info']}</span>
                        <a onclick="BuyDeals('${d[i]['id']}')">Buy now!</a>
                    </div>
                
                </div>

                
                `

            }

            html += '</div>';


            $('.View_admin_contxt').removeClass('loading');



            $('.View_admin_contxt .contxt').html(html);



            $.ajax({
                url : './ajax/meet.php',
                type: 'post',
                data: {
                    req: 'GetDealshours',
                },
                success: (d) => {

                    $('#deals-hours').html(`You Have ${d} hours`);

                    
                }
            })




        }
    })
}

function BuyDeals (id) {
    $.ajax({
        url : './ajax/payment.php',
        type: 'post',
        data: {
            Deal_id: id,
            req: 'GetValidLinkBuyDeals',
        },
        success: (d) => {

            console.log(d);


            if (!d) return;

            window.location.assign(d);


        }
    });

    

}

      
      
function ShowAlert (contxt, style) {

    // if exist
    document.querySelectorAll('alert-cover').forEach(e => e.remove());

    view =  document.createElement('div');
    view.style.display = "none";
    view.style.position = "absolute";
    view.style.top = "0px";
    view.style.left = "0px";
    view.classList = "viewMeet";
    
    cover = document.createElement('div');
    
    view.appendChild(cover);
    
    if (!style) {   
        cover.classList = "alert-cover";
        container = document.createElement('div');
        container.classList = "alert-container";   
        container.innerHTML = contxt;
        cover.appendChild(container);
    } else {
        cover.style = ` background: #fff; width:100vw; height: 100vh; position: fixed; top: 0; left : 0;`;
        cover.innerHTML = contxt;

    } // nothing
    

    document.body.appendChild(view);

    $(view).transition('zoom');
    
} 

function ConverthaToRealTime(ha) {

    if (ha.includes('pm')) {
        v = parseInt(ha.split('pm')[0]);

        return v + 12;

    } else {
        
        v  = parseInt(ha.split('am')[0]);

        return (v == 12) ? v - 12 : v;
    }

}

function addMeet (email, me) {
    window.focus_email_teacher = email;
    if (email && me) {
        // existed


    
                $.ajax({
                    url : './ajax/meet.php',
                    type: 'post',
                    data: {
                        req: 'TimefromToJSON',
                        teacher: email,
                        me: me,
                    },
                    success: TimefromToJSON => {

                        // console.log(TimefromToJSON);
                        
                            TimefromToJSON = JSON.parse( TimefromToJSON ) // conver to JSON

                            Salary = TimefromToJSON[3];

                        
                            window.teacherTiimeZone = TimefromToJSON[2]; // to local it to use in other functions
                            
                            ActiveDaysinweek = ``; // for loop to create days of week he/she will be active in!

                            for (i=0; i < TimefromToJSON[1].length; i++) {
                                ActiveDaysinweek += `${window.days[i]}, `;
                            } // loop

                            options = ``;
                            
                            console.log(TimefromToJSON)

                            zoneName = TimefromToJSON[2];

                            var teacherZoneFrom = moment.tz(TimefromToJSON[0][0], 'ha', zoneName);

                            var teacherZoneTo   = moment.tz(TimefromToJSON[0][1], 'ha', zoneName);

                            console.log(teacherZoneFrom.format('ha'), teacherZoneTo.format('ha'))

                            var localZoneFrom = teacherZoneFrom.clone().tz(moment.tz.guess()).format('ha');

                            var localZoneTo = teacherZoneTo.clone().tz(moment.tz.guess()).format('ha');
                          
                            console.log(localZoneFrom, localZoneTo)
                            
                            
                            localZoneFrom = ConverthaToRealTime(localZoneFrom);
                            
                            localZoneTo = ConverthaToRealTime(localZoneTo);

                            console.log(localZoneFrom, localZoneTo)

                            
                            for (i=localZoneFrom; i < localZoneTo; i++) {
                                options = options + `<option value="${i > 12 ? i - 12 : i }${i > 12 ? 'pm' : 'am'}">${i > 12 ? i - 12 : i } ${i > 12 ? 'pm' : 'am'}</option>`
                            }
                            $.ajax({
                                url : './ajax/meet.php',
                                type: 'post',
                                data: {
                                    req :'stateOfBuy',
                                    t: email // teacher
                                },
                                success : (buystate) => {

                                    buystate = buystate.replace(/\s|\n/gim, '');

                                    console.log(buystate);
                                    
                            ShowAlert(`<div class='row--'>
                                <div class='col-sm-12 col-md-6 col-lg-6 col-xl-6'>
                                    <div class="auto-jsCalendar"></div>
                                </div>
                                <div class='col-sm-12 col-md-6 col-lg-6 col-xl-6' style="
                                display: flex;
                                flex-direction: column;
                                justify-content: space-between;
                                ">
                                  <div>
                                  <h4>Please Select Your Date of your meet First and will Show after that avaliable Time for you in this day<span class='state-date-of-meet'></span> 
                                   <br /> <span style='margin-top: 10px'>Teacher avaliable at ${ActiveDaysinweek}</span>
                                  </h4>
                                  <be />
                                  <h4>Choose Time</h4>
                                  <select id="TimeOfMeet" class="ui dropdown">
                                      
                                      ${options}
                                      </select>
                                      </div>

                                      <div>
                                      <button id="sendermeet" onclick="check_the_time_and_date('${email}')" class="fluid positive ui button">
                                      ${buystate == "free" ? 'Book free trial'  : ''}
                                      ${buystate == "deal" ? 'Book buy deal'  : ''}
                                      ${buystate == "buy" ? 'pay ${Salary}$ & Book now' : ''}
                                      
                                      
                                      </button>
                                      <button id="sendermeet" onclick="$('.viewMeet').remove()" class="fluid nagetive ui button" style="margin-top: 6px">Cancel</button>
                                      </div>
                                </div>
                            
                            </div>`)
                            var element = document.querySelector(".auto-jsCalendar");
                            // Create the calendar
                            myjsCalendar = jsCalendar.new(element);
                            
                            myjsCalendar.onDateClick(function(event, date){

                                focus_day = moment(date.toString().split('00:00:00')[0], "ddd MMM D Y ", TimefromToJSON[2]).format('D/M/Y');
                                window.DateMeet = moment(date.toString().split('00:00:00')[0], "ddd MMM D Y ", TimefromToJSON[2]).format('D-M-Y');
                                myjsCalendar.clearselect();
                                myjsCalendar.select([
                                    focus_day,
                                ]);

                            });

                            
                        }
                    })
                    }
                })

            
       

    }
}

function MeetsList() {



    
   


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


        }
    });

        



}


function MeetsListRender(){

    $('.View_admin_contxt .contxt').html('');




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

            console.log(d);
            
            d = JSON.parse(d);

            var State_color = {
                Missed : '#ff4444',
                Prograss: "#ffbb33",
                "Meet Is Avalible" : "#00C851",
                "preparing a Meet" : "#33b5e5"
                
            }

            
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

                btn = state == 'Meet Is Avalible'  ? `<a href='#' class='mr-3' style='color: #00C851;' onclick=\"EnterMeet('${id}')\"><i class='paperclip icon d-inline-block' style='font-size:18px'></i>Enter meet </a>`  :  '';


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

            


            $('.View_admin_contxt').removeClass('.loading');
            $('.View_admin_contxt .contxt').append(`
            


                    <div class="row--" style="padding: 20px 20px 20px 40px">
                    <h1>Meets </h1>
                </div>
                <div style="width:100%;display: flex; justify-content: center; align-items: center">
                <table class="ui  basic table" id="meetTable" style="width: 95%" >
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
            
                ${info}
            
            </tbody>
        </table>
                </div>


            
            `);


            
    $.ajax({
        url : './ajax/meet.php',
        type: 'post',
        data: {
            req: 'GetAllTeacher',
        },
        success: (d) => {
            html = `

              <div class="row--" style="padding: 20px 20px 20px 40px">
         <h1>Active Teachers </h1>
      </div>
            <div class="row--" style="padding: 20px">
            ${d}
            </div>
            `;

            $('.View_admin_contxt .contxt').append(`${html}`);


            $('.special.cards .image').dimmer({
                on: 'hover'
              });

        }
    });

        },
    });

}

function EnterMeet(id) {

    $.ajax({
        url: './ajax/meet.php',
        type: 'post',
        data : {
            req: 'GetRoomUrl',
            idRoom: id,
        },
        success: (d) => {
            console.log(d);
            window.open(d);
        }
    })

}



function CancelMeet (id) {

    $.ajax({
        url : './ajax/meet.php',
        type: 'post',
        data: {
            req: 'CancelMeet',
            id : id,
        },
        beforeSend: () => {

            $('#loadingMeetTable').fadeIn();
            $('#meetTable').fadeOut();


        },
        success : (d) => {
            MeetsList();

        }
    });

}



function check_the_time_and_date(emailT) {

    // convert this local time to teacher local time to me in one date :D 
    var timefromlocaltoteacher = moment.tz($('#TimeOfMeet').val(), 'ha', moment.tz.guess());

    window.TimeOfdate  = timefromlocaltoteacher.clone().tz(window.teacherTiimeZone).format('ha');

    $.ajax({
        
        url : './ajax/meet.php',
        type: 'post',
        data: {
            teacher: emailT, // teacher email !! id
            req: 'IsAvalibaleTimeForMeet',
            TimZone: window.teacherTiimeZone,
            Date: window.DateMeet,
            Time: window.TimeOfdate,
        },
        beforeSend: () => {

            $('#sendermeet').addClass('loading').attr('onclick', 'return false');



        },
        success: (d) => {

            d = d.replace(/\s+/g,' ').trim();
            console.log(d)


            if (d == "0") {
                $('#sendermeet').removeClass('loading').attr('onclick',`check_the_time_and_date('${window.focus_email_teacher}')`);
                $('.state-date-of-meet').html('<br /> this time is not avalible. please choose any time else').css('color', '#ff4444')

            } else if (d == "2" /** goto payment*/) {


                $.ajax({
                    url :'./ajax/payment.php',
                    type :'post',
                    data : {
                        req : 'ReturnValidLinkPayment',
                    },
                    success : (link) => {

                        console.log(link)

                        if (link) {

                            if (!link.includes('error')) {

                                window.location.assign(link);
                            } else {
                                console.log(link);
                            }

                        }

                    }
                });

            } else {
                $('.viewMeet').remove();
                toastr.info('The reservation has been booked')
                toastr.warning('laoding...')
                MeetsList();

            }

        },

    })



    
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


setTimeout(() => {
    AutoView('Dashboard');
    setInterval(function () {


        if (window.PageStateValue == "Dashboard") {
           AutoView('Dashboard')    
        }
    
    }, 60000);
}, 1)



