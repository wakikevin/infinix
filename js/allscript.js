$(document).ready(function(){

	$('.menu-icon').click(function() {
		$('body, html').toggleClass('nav-open');	
	});

	$("select").change(function () { 
       var str = ""; 
       str = $(this).find("option:selected").text(); 
       $(this).parent().find(".out").text(str);
    });

    $("select").each(function(index, el){
        var str = ""; 
        str = $(this).find("option").first().text(); 
        $(this).parent().find(".out").text(str);
    })
	
	$(function() {
	  $('a[href*=#]:not([href=#])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {

		  var target = $(this.hash);
		  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
		  if (target.length) {
			$('html,body').animate({
			  scrollTop: target.offset().top
			}, 1000);
			return false;
		  }
		}
	  });
	});

	$('.page-state li a').click(function() {
		$('.page-state li a').removeClass('current');
		$(this).addClass('current');
	})
});//doc.ready

$(window).scroll(function() {
		$('.homeSlide').each(function(){
		var imagePos = $(this).offset().top;
		
		var topOfWindow = $(window).scrollTop();
			if (imagePos < topOfWindow+400) {
				// alert($(this).attr('id'));
				pagestate($(this).attr('id'));
			}
		});

 			
								
});

function pagestate (id){
	$('.page-state li a').removeClass('current');
	$('.page-state li').find('a[href="#'+id+'"]').addClass('current');

	if(id=='slide-2'){
		var slideAnimate = $('#slide-2').find('.left-wing');
		// if (!slideAnimate.hasClass('slideInLeft')) {
		// 	slideAnimate.addClass('slideInLeft');
		// }
	}else if(id=='slide-3'){

	}else if(id=='slide-4'){

	}else if(id=='slide-5'){

	}else if(id=='slide-6'){

	}
}



