// (function($){
//     $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
//       if (!$(this).next().hasClass('show')) {
//         $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
//       }
//       var $subMenu = $(this).next(".dropdown-menu");
//       $subMenu.toggleClass('show');

//       $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
//         $('.dropdown-submenu .show').removeClass("show");
//       });
//       return false;
//     });
// })
$('#click').on('click', function(e){
	e.preventDefault();
	Swal.fire(
		'Chúc mừng bạn !',
		'Được sử dụng lifetime các tool của LAR !',
		'success'
		)
});
new WOW().init();
window.addEventListener('scroll', function(e) {
	if( $(window).scrollTop() <= 50) {
		$('.wow').removeClass('animated');
		$('.wow').removeAttr('style');
		new WOW().init();
	}
});


$(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
        $('.scrollup').fadeIn();
    } else {
        $('.scrollup').fadeOut();
    }
});

$('.scrollup').click(function () {
    $("html, body").animate({
        scrollTop: 0
    }, 600);
    return false;
});

// $(document).ready(function() {

//    var url = [location.protocol, '//', location.host, location.pathname].join('');  

//             $('.nav-item.active').removeClass('active');
//             $('.nav-item a[href="' + url  + '"]').parent().addClass('active');
//             $(this).parent().addClass('active').siblings().removeClass('active');


//     });
// $(document).ready(function(){
//  $('navbar-nav a').click(function(){
//    $('navbar-nav a').removeClass('active');
//    $(this).addClass('active');
//    let link=$(this).attr('href');
//    window.location.href=link;
//  });
// });
// $(".navbar li").on("click", function() {
//       $(".navbar li").removeClass("active");
//       $(this).addClass("active");
//     });

// $('.navbar-nav .nav-link').click(function(){
//     $('.navbar-nav .nav-link').removeClass('active');
//     $(this).addClass('active');
// })
// $(document).on('click','ul li a',function(){
//   $(this).addClass('active').siblings().removeClass('active')
// })


// $("#menu_area .navbar-nav .nav-link").on("click", function(){
//    $("menu_area .navbar-nav").find(".active").removeClass("active");
//    $(this).addClass("active");
// });

// $(".navbar li .nav-item").on("click", function(){
//    $(".navbar").find(".active").removeClass("active");
//    $(this).addClass("active");
// });

// $( '#navttc .navbar-nav a' ).on( 'click', function () {
//   $( '#navttc .navbar-nav' ).find( 'li.active' ).removeClass( 'active' );
//   $( this ).parent( 'li' ).addClass( 'active' );
// });


// Get the container element
// var btnContainer = document.getElementById("menu_area");

// // Get all buttons with class="btn" inside the container
// var btns = btnContainer.getElementsByClassName("nav-item");

// // Loop through the buttons and add the active class to the current/clicked button
// for (var i = 0; i < btns.length; i++) {
//   btns[i].addEventListener("click", function() {
//     var current = document.getElementsByClassName("active");
//     current[0].className = current[0].className.replace(" active", "");
//     this.className += " active";
//   });
// }

// // Get the container element
// var btnContainer = document.getElementById("menu_area");

// // Get all buttons with class="btn" inside the container
// var btns = btnContainer.getElementsByClassName("nav-item","nav-link");

// // Loop through the buttons and add the active class to the current/clicked button
// for (var i = 0; i < btns.length; i++) {
//   btns[i].addEventListener("click", function() {
//     var current = document.getElementsByClassName("active");

//     // If there's no active class
//     if (current.length > 0) {
//       current[0].className = current[0].className.replace(" active", "");
//     }

//     // Add the active class to the current/clicked button
//     this.className += " active";
//   });
// }