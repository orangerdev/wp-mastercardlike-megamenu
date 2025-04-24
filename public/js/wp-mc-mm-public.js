(function ($) {
	"use strict";

	const clearActive = () => {
		$(".nav-item").removeClass("active");
		$(".sub-menu").removeClass("sub-menu-visible");
		$(".header-background").removeClass("active");
	};

	function isMobileView() {
		return window.innerWidth < 800;
	}

	const clearActiveMenu = () => {
		// remove class menu-active under .sub-menu-level-1
		$(".sub-menu-level-1 .menu-active").removeClass("menu-active");
		// remove class link-active under .sub-menu-level-1
		$(".sub-menu-level-1 .link-active").removeClass("link-active");
		// remove class active under .nav-item
		$(".nav-item").removeClass("active");
		// remove class active under .header-background
		$(".header-background").removeClass("active");
		// remove class header-background-active under .header-container
		$(".header-container").removeClass("header-background-active");
		// remove class hidden-background under .header-background
		$(".header-background").addClass("hidden-background");
	};

	$(".parent-item.has-child > .link-container").on("click", function (e) {
		console.log("click 1");
		if (isMobileView()) return;

		e.preventDefault();

		console.log("click 2");
		var target = $(this).parent().data("target");

		clearActive();

		$(this).parent().toggleClass("active");

		// disable scroll
		$("body").css("overflow", "hidden");

		$(".header-container").removeClass("header-search-active");
		$(".header-container").addClass("header-background-active");
		$(".header-background").addClass("hidden-background");

		$("." + target).removeClass("hidden-background");
	});

	let isHovered = false;

	$(".sub-menu-container .link-container").on("mouseenter", function () {
		if (isMobileView()) return;

		const target = $(this).data("target");

		// find closest parent with class .sub-menu,
		$(this).parent().parent().find(".menu-active").removeClass("menu-active");

		$(this).parent().parent().find(".link-active").removeClass("link-active");

		$(this).parent().addClass("link-active");
		$("." + target).addClass("menu-active");
	});

	$(".parent-item > .link-container .indicator").on("click", function (e) {
		if (!isMobileView()) return;

		$(this).parent().parent().parent().find(".active").removeClass("active");

		$(this).parent().parent().addClass("active");

		e.preventDefault();
	});

	$(".sub-menu-container .indicator").on("click", function () {
		if (!isMobileView()) return;

		const target = $(this).parent().data("target");

		console.log(target);
		$(this)
			.parent()
			.parent()
			.parent()
			.find(".link-active")
			.removeClass("link-active");

		$(this)
			.parent()
			.parent()
			.parent()
			.find(".menu-active")
			.removeClass("menu-active");

		$(this).parent().parent().addClass("link-active");
		$("." + target).addClass("menu-active");
	});

	$(".close-submenu").on("click", function (e) {
		e.preventDefault();
		clearActiveMenu();
		$(".header-container").removeClass("header-search-active");
		// enable scroll
		$("body").css("overflow", "auto");
	});

	$(".display-search").on("click", function (e) {
		console.log("display-search");
		e.preventDefault();
		clearActiveMenu();
		$(".header-container").toggleClass("header-search-active");

		if ($(".header-container").hasClass("header-search-active")) {
			$("body").css("overflow", "hidden");
		} else {
			$("body").css("overflow", "auto");
		}
	});

	$(".open-mobile-menu").on("click", function (e) {
		e.preventDefault();
		$(".header-container").addClass("header-mobile-menu-active");
	});

	$(".close-mobile-menu").on("click", function (e) {
		e.preventDefault();
		$(".header-container").removeClass("header-mobile-menu-active");
	});

	//if click outside .sub-menu then remove class menu-active under .sub-menu-level-1
	$(document).on("click", function (e) {
		if (!$(e.target).closest(".sub-menu-level-1").length) {
			$(".sub-menu-level-1 .menu-active").removeClass("menu-active");
		}
	});
})(jQuery);
