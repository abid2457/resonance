(function ($) {
	
	"use strict";

	$(document).ready(function() {
		if ($('.owl-show-events').length) {
			$('.owl-show-events').owlCarousel({
				items: 4,
				loop: true,
				dots: true,
				nav: true,
				autoplay: true,
				margin: 30,
				responsive: {
					0: {
						items: 1
					},
					600: {
						items: 2
					},
					1000: {
						items: 4
					}
				}
			});
		}
	});
	
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
		// Remove the 'loaded' class after a short delay
		setTimeout(function() {
			$('#js-preloader').addClass('loaded');
		}, 500); //Adjust the delay (1000ms = 1 second) as needed
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


	// Handle purchase button
	// purchaseButton.addEventListener("click", (event) => {
	// 	event.preventDefault();

	// 	// Get event ID from URL
	// 	const urlParams = new URLSearchParams(window.location.search);
	// 	const event_id = urlParams.get("id");
	// 	const ticketsRemainingElement = document.querySelector("#tickets-remaining");
	// 	const ticketsRemaining = parseInt(ticketsRemainingElement.textContent.split(" ")[0]);
	// 	const quantityInput = document.querySelector(".qty"); // Ensure correct quantity selection
	// 	const quantity = parseInt(quantityInput.value);

	// 	if (ticketsRemaining <= 0) {
	// 		Swal.fire({
	// 			icon: 'error',
	// 			title: 'Sold Out!',
	// 			text: 'No tickets available.',
	// 			confirmButtonColor: '#d33'
	// 		});
	// 		return;
	// 	}

	// 	if (!quantity || quantity <= 0 || isNaN(quantity)) {
	// 		Swal.fire({
	// 			icon: 'warning',
	// 			title: 'Invalid Quantity',
	// 			text: 'Please enter a valid number of tickets.',
	// 			confirmButtonColor: '#f39c12'
	// 		});
	// 		return;
	// 	}

	// 	if (quantity > ticketsRemaining) {
	// 		Swal.fire({
	// 			icon: 'warning',
	// 			title: 'Not Enough Tickets',
	// 			text: `Only ${ticketsRemaining} tickets are available.`,
	// 			confirmButtonColor: '#f39c12'
	// 		});
	// 		return;
	// 	}

	// 	Swal.fire({
	// 		title: `Confirm Purchase`,
	// 		text: `Are you sure you want to purchase ${quantity} tickets?`,
	// 		icon: 'question',
	// 		showCancelButton: true,
	// 		confirmButtonText: 'Yes, Purchase!',
	// 		cancelButtonText: 'Cancel',
	// 		confirmButtonColor: '#3085d6',
	// 		cancelButtonColor: '#d33'
	// 	}).then((result) => {
	// 		if (result.isConfirmed) {
	// 			fetch("book_ticket.php", {
	// 				method: "POST",
	// 				headers: {
	// 					"Content-Type": "application/x-www-form-urlencoded"
	// 				},
	// 				body: `event_id=${event_id}&quantity=${quantity}`
	// 			})
	// 			.then(response => response.text())
	// 			.then(data => {
	// 				if (data.includes("Booking successful")) {
	// 					// Extract seat numbers from response
	// 					const seatInfo = data.split(":")[1]?.trim() || "Unknown";
						
	// 					Swal.fire({
	// 						icon: 'success',
	// 						title: 'Booking Confirmed!',
	// 						html: `<strong>Your seats:</strong> ${seatInfo}`,
	// 						confirmButtonColor: '#28a745'
	// 					}).then(() => {
	// 						ticketsRemainingElement.textContent = `${ticketsRemaining - quantity} Tickets still available`;
	// 						window.location.reload(); // Reload page to update availability
	// 					});

	// 				} else {
	// 					Swal.fire({
	// 						icon: 'error',
	// 						title: 'Booking Failed!',
	// 						text: data, // Show error message from backend
	// 						confirmButtonColor: '#d33'
	// 					});
	// 				}
	// 			})
	// 			.catch(error => {
	// 				console.error("Error:", error);
	// 				Swal.fire({
	// 					icon: 'error',
	// 					title: 'Error!',
	// 					text: 'Something went wrong. Please try again later.',
	// 					confirmButtonColor: '#d33'
	// 				});
	// 			});
	// 		}
	// 	});
	// });


	
    const confirmPaymentButton = document.querySelector("#confirm-payment");

    if (confirmPaymentButton) {
        confirmPaymentButton.addEventListener("click", function(event) {
            event.preventDefault();

            // Get event ID from URL
            const urlParams = new URLSearchParams(window.location.search);
            const event_id = urlParams.get("id");
            const ticketsRemainingElement = document.querySelector("#tickets-remaining");
            const ticketsRemaining = parseInt(ticketsRemainingElement.textContent.split(" ")[0]);
            const quantityInput = document.querySelector(".qty"); // Ensure correct quantity selection
            const quantity = parseInt(quantityInput.value);
            const transactionID = document.getElementById("transaction_id").value.trim(); // Get entered UPI Transaction ID

            if (ticketsRemaining <= 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Sold Out!',
                    text: 'No tickets available.',
                    confirmButtonColor: '#d33'
                });
                return;
            }

            if (!quantity || quantity <= 0 || isNaN(quantity)) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Invalid Quantity',
                    text: 'Please enter a valid number of tickets.',
                    confirmButtonColor: '#f39c12'
                });
                return;
            }

            if (quantity > ticketsRemaining) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Not Enough Tickets',
                    text: `Only ${ticketsRemaining} tickets are available.`,
                    confirmButtonColor: '#f39c12'
                });
                return;
            }

            if (!transactionID) {
                Swal.fire({
                    icon: 'error',
                    title: 'Missing Transaction ID',
                    text: 'Please enter your UPI Transaction ID after completing the payment.',
                    confirmButtonColor: '#d33'
                });
                return;
            }

            // Redirect to `upi_payment.php` with transaction details
            window.location.href = `upi_payment.php?event_id=${event_id}&quantity=${quantity}&transaction_id=${transactionID}`;
        });
    }

    // Show SweetAlert Success Message After Redirecting Back
    const urlParams = new URLSearchParams(window.location.search);
    const success = urlParams.get("success");
    const seats = urlParams.get("seats");
	const event_id = urlParams.get("id");


    if (success) {
        Swal.fire({
            icon: 'success',
            title: 'Booking Confirmed!',
            html: `<strong>Your seats:</strong> ${seats}`,
            confirmButtonColor: '#28a745'
        }).then(() => {
            // Remove success parameter from URL after displaying alert
            // window.history.replaceState(null, null, window.location.pathname);

			window.location.href = `ticket-details.php?id=${event_id}`;

        });
    }




});