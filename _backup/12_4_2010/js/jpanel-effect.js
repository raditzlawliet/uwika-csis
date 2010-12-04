$(function() {
			$(".submit")
					.click(function() {
						InitializeTimer();  //di html awal
						$("#alert_login").html("Loading ...");
					})
					.throbber();
			$(".submit")
				.click(function() {
					$("#loading").html("Loading stopped!");
					$.throbberHide();
				})
			$("#ajax")
				.click(function() {
					$("#ajax-target").load("demo_content.html");
				})
				.throbber();
			$("#google1").throbber("click");
			$("#google2").throbber({parent: "#throbber-container"});
			$("#div").throbber("dblclick", {image: "throbber_2.gif", wrap: '<div class="throbber"></div>'});
});
	
$(document).ready(function(){
	$("#footer_id_1").hover(function(){
		$("#footer_id_1_subpanel").toggle("fast");
		return false;
	});
	$("#footer_id_2").hover(function(){
		$("#footer_id_2_subpanel").toggle("fast");
		return false;
	});
	$("#footer_id_3").hover(function(){
		$("#footer_id_3_subpanel").toggle("fast");
		return false;
	});
	$("#footer_id_4").hover(function(){
		$("#footer_id_4_subpanel").toggle("fast");
		return false;
	});
	$(".trigger_footer_cancel").click(function(){
		$("#footer_id_1_panel").hide("fast");
		$("#footer_id_2_panel").hide("fast");
		$("#footer_id_3_panel").hide("fast");
		$("#footer_id_4_panel").hide("fast");
		return false;
	});
	
	$("#footer_id_1").click(function(){
		$("#footer_id_1_panel").toggle("fast");
		$("#footer_id_2_panel").hide("fast");
		$("#footer_id_3_panel").hide("fast");
		$("#footer_id_4_panel").hide("fast");
		return false;
	});
	$("#footer_id_2").click(function(){
		$("#footer_id_2_panel").toggle("fast");
		$("#footer_id_1_panel").hide("fast");
		$("#footer_id_3_panel").hide("fast");
		$("#footer_id_4_panel").hide("fast");
		return false;
	});
	$("#footer_id_3").click(function(){
		$("#footer_id_3_panel").toggle("fast");
		$("#footer_id_2_panel").hide("fast");
		$("#footer_id_1_panel").hide("fast");
		$("#footer_id_4_panel").hide("fast");
		return false;
	});
	$("#footer_id_4").click(function(){
		$("#footer_id_4_panel").toggle("fast");
		$("#footer_id_2_panel").hide("fast");
		$("#footer_id_3_panel").hide("fast");
		$("#footer_id_1_panel").hide("fast");
		return false;
	});

	$(".trigger").click(function(){
		$(".panel").toggle("fast");
		$(this).toggleClass("active");
		$(".trigger2").toggle("fast");
//		$(".header_trigger").toggle("fast");
		return false;
	});

	$(".trigger2").click(function(){
		$(".panel2").toggle("fast");
		$(this).toggleClass("active");
		$(".trigger").toggle("fast");
//		$(".header_trigger").toggle("fast");
		return false;
	});
	
	$("#header_id_login").click(function(){
		$("#header_id_login_panel").toggle("fast");
		$(this).toggleClass("active");
//		$(".trigger").toggle("fast");
//		$(".trigger2").toggle("fast");
		return false;
	});
	$(".header_login_cancel").click(function(){
		$("#header_id_login_panel").toggle("fast");
		$(this).toggleClass("active");
		$("#header_id_login").toggleClass("active");
//		$(".trigger").toggle("fast");
//		$(".trigger2").toggle("fast");
		return false;
	});
	$("#header_id_login_jq").click(function(){
		$("#header_id_login_panel_jq").toggle("fast");
		$(this).toggleClass("active");
//		$(".trigger").toggle("fast");
//		$(".trigger2").toggle("fast");
		return false;
	});
	
	
	
});
