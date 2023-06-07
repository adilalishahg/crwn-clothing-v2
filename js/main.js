$('.mobile__button p').click(function(){
	$('.mobile-nav').find('.mobile__nav').slideToggle(200);
});

var isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ? true : false;
if(!isMobile) {
	$('body').addClass('is__desktop');
	//alert('is desktop'); 
} else {
	$('body').addClass('is__device'); 
	//alert('is device');
}

//remove p tags that surounded the shortcodes
$('p:empty').remove();

//remove p tag around image tag
$("p > img").unwrap();

//remove p tag around iframe tag
$("p > iframe").unwrap();

//remove p tag around button
$("p > a.button").unwrap();

//remove p tag around faux h5
$("p > .faux-h5").unwrap();

//removes width and height attributes from images
$('img').each(function(){ 
	$(this).removeAttr('width');
	$(this).removeAttr('height');
});

$('.homesection').each(function() {
	$(this).click(function() {
		//alert('es clicked ye');
		$(this).toggleClass('active');
		$(this).next('.homehidden').toggleClass('active').slideToggle(200);
	});
});

$('.homesection2').each(function() {
	$(this).click(function() {
		//alert('es clicked ye');
		$(this).toggleClass('active');
		$(this).next('.homehidden').toggleClass('active').slideToggle(200);
	});
});


// Select all links with hashes
$('a[href*="#"]')
  // Remove links that don't actually link to anything
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    // On-page links
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      // Figure out element to scroll to
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      // Does a scroll target exist?
      if (target.length) {
        // Only prevent default if animation is actually gonna happen
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          // Callback after animation
          // Must change focus!
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });
  
  $('.mobile__nav ul li.menu-item-has-children').each(function() {
	$(this).children().first().click(function(e) {
		e.preventDefault();
		$(this).next('ul').slideToggle(200);
	});
});



$(function() {
        $(".button1").click(function() {
            $(".tab1").toggleClass('active').slideToggle(200);
        });
    });
	
	$(function() {
        $(".button2").click(function() {
            $(".tab2").toggleClass('active').slideToggle(200);
        });
    });
	
	$(function() {
        $(".button3").click(function() {
            $(".tab3").toggleClass('active').slideToggle(200);
        });
    });
	
	$(function() {
        $(".button4").click(function() {
            $(".tab4").toggleClass('active').slideToggle(200);
        });
    });
	
	$(function() {
        $(".button5").click(function() {
            $(".tab5").toggleClass('active').slideToggle(200);
        });
    });