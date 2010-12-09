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
		return false;
	});

	$(".trigger2").click(function(){
		$(".panel2").toggle("fast");
		$(this).toggleClass("active");
		$(".trigger").toggle("fast");
		return false;
	});
});
