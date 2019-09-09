
function see_teacher_profile (TeacherEmail) {


    $.ajax({
        url : './ajax/profile.php',
        type: 'post',
        data : {
            req : 'teacher_profile',
            email: TeacherEmail,
        },
        success : (d) => {
            console.log(d);

            d = JSON.parse(d);

            cv_images = JSON.parse(d['cv_images']);
            cv_innerhtml = ``;
            for (i in cv_images) {
                cv_innerhtml += `
                    <div class="cv-card">
                        <img src="${cv_images[i]}" />
                    </div>
                `;
            }


            $('.teacher-profile .loading').hide();

            $('.teacher-profile .teacher-profile-contxt').css('display', 'flex');

            $('.teacher-profile .teacher-profile-contxt .top-s img').attr('src', `${d['profile_img']}`)
            
            $('.teacher-profile .teacher-profile-contxt .top-s .info .name').text(`${d['name']}`);
            
            $('.teacher-profile .teacher-profile-contxt .top-s .info .email').text(`${d['ID']}`);

            $('.teacher-profile .teacher-profile-contxt .top-s .info .info_').text(`${d['Info']}`);

            $('.teacher-profile .teacher-profile-contxt .teacher-cv').html(`${cv_innerhtml}`);

        }
    });



}


see_teacher_profile(window.location.href.split('email=')[1]);

console.log('Hello world')

