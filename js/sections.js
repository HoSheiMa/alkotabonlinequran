window.onload = () => {
 

    $(".loading-page").transition("zoom");

    // $(document).ready(() => {
    //     $("body").niceScroll();

    //     resize();
    // });

    // function resize() {
    //     $("body")
    //         .getNiceScroll()
    //         .resize();

    //     setTimeout(() => {
    //         resize();
    //     }, 600);
    // }

    setTimeout(() => {
        $('.special.cards .image').dimmer({
            on: 'hover'
          });
        $('#view').transition('fade down');


    }, 200);
    $('.ui.dropdown')
          .dropdown();
}


function LogOut () {
    $.ajax({
        url: './ajax/LogIn.php',
        type: 'post',
        data: { req : 'logOut'},
        success : (d) => window.location.reload(),
    })
}

