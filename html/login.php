<style>
    .bg-1 {
    background-image:url(./assets/cpg-man-reading-book.jpg);
}
.h-100-vh {
    height: 100vh;
}

.hide-sm {}
.bg-sm {}
@media(max-width: 576px) {
    .hide-sm {
        display: none;
    }
    .bg-sm {
    background-image:url(./assets/cpg-man-reading-book.jpg);
    color :white;
    height: 100vh;
    }

}

</style>


<script>

    function LogIn(el) { 
    $(el).parent().addClass("loading");
    var form = $('#form_')[0];
    form = new FormData(form);
    form.append('req', 'login');
    

    
    $.ajax({
        url : './ajax/LogIn.php',
        data : form,
        type: 'post',
        cache: false,
        contentType: false,
        processData: false,
        success: (d) => {
            console.log(d);
            
            $(el).parent().removeClass("loading").addClass('success')

            // window.location.assign('sections.php?q=login');

                console.log(d)

            if (d == "true") {

                $(el).parent().removeClass("loading").addClass('success')

                $(el).parent().removeClass("loading").removeClass('error')

                setTimeout(() => {
                    window.location.assign('sections.php?q=dashboard');
                }, 600);

            } else {
                $(el).parent().removeClass("loading").removeClass('success')

                $(el).parent().removeClass("loading").addClass('error')
            }

        },
        error :(d) => {
            $(el).parent().removeClass("loading").addClass('error')
        }
    })
 }

 function resetEmail() {

    $.confirm({
    title: '<div class="col text-right">نسيت كلمة السر</div>',
    content: '' +
    '<form action="" class="formName ui form">' +
    '<div class="field text-right">' +
    '<label>سوف تصلك رسالة نصية الي البريد الخاص بك تحتوي  علي رابط فتح لحسابك موقتا لتغير كلمة السر و استرجاعة</label>' +
    '<input type="gmail" placeholder="البريد" class="name ui form-control" required />' +
    '</div>' +
    '</form>',
    buttons: {
        formSubmit: {
            text: 'ارسال',
            btnClass: 'btn-blue',
            action: function (d) {
                var name = this.$content.find('.name').val();
                if(!name){
                    $.alert('بريد خطأ');
                    return false;
                }
                $.ajax({
                  url : './reset/reset_acc.php',
                  type : 'post',
                  data: {
                    email : name,
                  },
                  success : (d) => {
                    state = d.replace(/\s+/g,' ').trim();
                    console.log(state);
                    
                    if (state == 'true') {
                      Swal(
                        'تم المعالجة بنجاح',
                        'تم ارسال الرسالة الي البريد الخاص بك',
                        'success'
                      )
                    } else {
                      Swal({
                        type: 'error',
                        title: 'تم المعالجة بنجاح',
                        text: 'لم ناجد هذا البريد في موقعنا تاكد منه',
                        footer: '<a href="req.php?q=pagecallus">اذا كونت تواجة مشكلة تواصل مع الادمن</a>'
                      })
                    }
                    
                  }
                })
                // $.alert('   تم الارسال الي الموقع لمعالجة البريد و سوف تصلك رساله اذا كان صحيحا اذا لم تصلك رسالة يمكن المحاولة مجددا او التواصل  مع ادمن الموقع');
            }
        },
        'الغاء': function () {
            
        },
    }
});

    
  
  
}

</script>
<div class='row-- p-0 m-0 '>
    <div class='col-6 bg-1 h-100-vh hide-sm' onmouseover="$(this).transition('pulse');">

    </div>

    <div class='col-12 col-sm-6 p-5 bg-sm' >
        <h1 class='p-0 m-0'>Log In</h1>
        <h4 class='p-0 m-0 text-secondary'>We are happy to see you :D</h5>
            <form class="ui form warning" id='form_' onsubmit='return false;'>
                <div class="ui form pt-5 ">



                    <div class="field">
                        <label>Email</label>
                        <input name='email' type='email' placeholder="Email">
                    </div>


                    <div class="field">
                        <label>Password</label>
                        <input name='password' type='password' placeholder="Password">
                    </div>



                    <div class="ui success message">
                        <div class="header">Form Completed</div>
                        <p>completed successfully.</p>
                    </div>

                    <div class="ui error message">
                        <div class="header">Form Faild</div>
                        <p>There is something wrong.</p>
                    </div>

                    <div class="ui warning message active">
                        <div class="header">If forget you password!</div>
                        <ul class="list">
                        <li><a href="#" onclick="resetEmail()">Click</a> to reset your password.</li>
                        </ul>
                    </div>

                    <button type='submit' class="fluid ui button positive" onclick='LogIn(this);return false;'>Log In</button>

                </div>
            </form>
    </div>

</div>