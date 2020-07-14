jQuery(document).ready(function($) { 	
 	$('.menu li:has(ul)').click(function(e) {
 		e.preventDefault();
 		if ($(this).hasClass('active')) {
 			$(this).removeClass('active');
 			$(this).children('ul').slideUp(400);
 		} else {
 			$('.menu li ul').slideUp(400);
 			$('.menu li').removeClass('active');
 			/*$(this).addClass('active');*/
 			$(this).toggleClass('active');
 			$(this).children('ul').slideDown(400);
 		}

 	});

 	$('.bt-menu').click(function() {
		 //$('.contenedor-menu .menu').slideToggle();
		 $(".nav-menu").toggleClass('active');
 	});

 	$(window).resize(function(){
 		if ($(document).width() >= 901 ) {
			$(".header").removeClass("active");
			$("body").removeClass("mobile");
 			//$('.contenedor-menu .menu').css('display', 'block');	
 		}
 		if ($(document).width() <= 900 ) {			 
			$(".header").addClass("active");
      		$("body").addClass("mobile");
			//$('.contenedor-menu .menu').css('display', 'none');	
 			$('.menu li ul').slideUp();
 			/* $('.menu li').removeClass('active'); */
 		}

 	});
 	/*obtener valor submenu*/
 	$('.menu li ul li a').click(function() {
 		window.location.href=$(this).attr('href');
 	});
	
	 if ($(document).width() <= 900 ) {
		$(".header").addClass("active");
		$("body").addClass("mobile");
	 }

 });

 