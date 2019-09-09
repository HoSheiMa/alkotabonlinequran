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

    function join(el) { 
    $(el).parent().addClass("loading");
    var form = $('#form_')[0];
    form = new FormData(form);
    console.log(form['password']);
    

    
    $.ajax({
        url : './ajax/singup.php',
        data : form,
        type: 'post',
        cache: false,
        contentType: false,
        processData: false,
        success: (d) => {
            console.log(d);
            

            if (d == 'true') {

                $(el).parent().removeClass("loading").addClass('success')
                
                window.location.assign('sections.php?q=login');
            }  else {
                $(el).parent().removeClass("loading").addClass('error')

                

            }

        },
        error :(d) => {
            $(el).parent().removeClass("loading").addClass('error')
        }
    })
 }
</script>
<div class='row-- p-0 m-0 '>
    <div class='col-6 bg-1 h-100-vh hide-sm' onmouseover="$(this).transition('pulse');">

    </div>

    <div class='col-12 col-sm-6 p-5 bg-sm'>
        <h1 class='p-0 m-0'>Sing Up</h1>
        <h4 class='p-0 m-0 text-secondary'>We are happy to join you</h5>
            <form id='form_' onsubmit='return false;'>
                <div class="ui form pt-5 ">

                    <div class="field">
                        <label>Full name</label>
                        <input name='name' type="text" placeholder="Full Name">
                    </div>


                    <div class="field">
                        <label>Email</label>
                        <input name='email' type='email' placeholder="Email">
                    </div>


                    <div class="field">
                        <label>Password</label>
                        <input name='password' type='password' placeholder="Password">
                    </div>
                    <div class="field">
                        <label>Re-password</label>
                        <input name='repassword' type='password' placeholder="Re-password">
                    </div>


                    <div class="ui success message">
                        <div class="header">Form Completed</div>
                        <p>completed successfully.</p>
                    </div>

                    <div class="ui error message">
                        <div class="header">Form Faild</div>
                        <p>There is something wrong.</p>
                    </div>

                    <button type='submit' class="fluid ui button positive" onclick='join(this);return false;'>Join</button>

                </div>
            </form>
    </div>

</div>