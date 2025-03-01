(function ($) {
	
	"use strict";

	$('.owl-show-events').owlCarousel({
		items:4,
		loop:true,
		dots: true,
		nav: true,
		autoplay: true,
		margin:30,
		  responsive:{
			  0:{
				  items:1
			  },
			  600:{
				  items:2
			  },
			  1000:{
				  items:4
			  }
		  }
	  })

	$(function() {
        $("#tabs").tabs();
    });
	

	$('.schedule-filter li').on('click', function() {
        var tsfilter = $(this).data('tsfilter');
        $('.schedule-filter li').removeClass('active');
        $(this).addClass('active');
        if (tsfilter == 'all') {
            $('.schedule-table').removeClass('filtering');
            $('.ts-item').removeClass('show');
        } else {
            $('.schedule-table').addClass('filtering');
        }
        $('.ts-item').each(function() {
            $(this).removeClass('show');
            if ($(this).data('tsmeta') == tsfilter) {
                $(this).addClass('show');
            }
        });
    });


	// Window Resize Mobile Menu Fix
	mobileNav();


	// Scroll animation init
	window.sr = new scrollReveal();
	

	// Menu Dropdown Toggle
	if($('.menu-trigger').length){
		$(".menu-trigger").on('click', function() {	
			$(this).toggleClass('active');
			$('.header-area .nav').slideToggle(200);
		});
	}


	// Page loading animation
	 $(window).on('load', function() {

        $('#js-preloader').addClass('loaded');

    });


	// Window Resize Mobile Menu Fix
	$(window).on('resize', function() {
		mobileNav();
	});


	// Window Resize Mobile Menu Fix
	function mobileNav() {
		var width = $(window).width();
		$('.submenu').on('click', function() {
			if(width < 767) {
				$('.submenu ul').removeClass('active');
				$(this).find('ul').toggleClass('active');
			}
		});
	}


})(window.jQuery);


document.addEventListener("DOMContentLoaded", () => {
	const minusButton = document.querySelector(".minus");
	const plusButton = document.querySelector(".plus");
	const quantityInput = document.querySelector(".qty");
	const ticketPriceElement = document.querySelector("#ticket-price");
	const totalPriceElement = document.querySelector("#total-price");
	const purchaseButton = document.querySelector("#purchase-tickets");
	const ticketsRemainingElement = document.querySelector("#tickets-remaining");

	const ticketPrice = parseFloat(ticketPriceElement.dataset.price);
	const maxTickets = 10;

	// Update total price function
	const updateTotalPrice = () => {
		// console.log(ticketPrice);
		setTimeout(() => {
			const quantity = parseInt(quantityInput.value);
			const total = ticketPrice * quantity;
			ticketPriceElement.textContent = `INR ${total}`;
			totalPriceElement.textContent = `INR ${total.toFixed(2)}`;	
		}, 100);
		
	};

	// Decrease quantity
	minusButton.addEventListener("click", () => {
		let quantity = parseInt(quantityInput.value);
		if (quantity > 1) {
			updateTotalPrice();
		}
	});

	// Increase quantity
	plusButton.addEventListener("click", () => {
		let quantity = parseInt(quantityInput.value);
		console.log(quantity);
		if (quantity < maxTickets) {
			updateTotalPrice();
		} else {
			alert("You can only buy up to 10 tickets.");
		}
	});

	// Handle manual input in quantity field
	quantityInput.addEventListener("input", () => {
		// console.log('in');
		// let quantity = parseInt(quantityInput.value);
		// if (quantity > maxTickets) {
		// 	quantity = maxTickets;
		// 	alert("You can only buy up to 10 tickets.");
		// } else if (quantity < 1 || isNaN(quantity)) {
		// 	quantity = 1;
		// }
		// console.log('tests');
		// quantityInput.value = quantity;
		// updateTotalPrice();
	});

	// Handle purchase button
	purchaseButton.addEventListener("click", (event) => {
		event.preventDefault();
		const quantity = parseInt(quantityInput.value);
		const ticketsRemaining = parseInt(ticketsRemainingElement.textContent.split(" ")[0]);
		if (quantity > ticketsRemaining) {
			alert("Not enough tickets available.");
		} else {
			alert(`You have purchased ${quantity} tickets!`);
			ticketsRemainingElement.textContent = `${ticketsRemaining - quantity} Tickets still available`;
		}
	});
});