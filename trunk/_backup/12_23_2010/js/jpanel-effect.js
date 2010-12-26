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
	$('#mask').click(function () {
		HidePanel();
	});	
});

var activePanelHome = 0;
var collapse = false;
var main_panel_active = null;

function resetActiveCollapsePanelHome(){
	activePanelHome = 0;
	collapse = false;
}
function setActivePanelHome(num){
	if (!collapse){activePanelHome = num;}
	else{collapse=false;}
}
function collapseLastActivePanelHome(num){
	if(num!=activePanelHome){
	switch(activePanelHome){
		case 3:{
			$("#header_id_account_panel").toggle("fast");
			$("#header_id_account").toggleClass("active");	
			break;
		}
		case 4:{
			$("#header_id_student_panel").toggle("fast");
			$("#header_id_student").toggleClass("active");	
			break;
		}
		case 5:{
			$("#header_id_faculty_panel").toggle("fast");
			$("#header_id_faculty").toggleClass("active");	
			break;
		}
		case 6:{
			$("#header_id_employee_panel").toggle("fast");
			$("#header_id_employee").toggleClass("active");	
			break;
		}
		case 7:{
			$("#header_id_admin_panel").toggle("fast");
			$("#header_id_admin").toggleClass("active");	
			break;
		}
	}
	}else{activePanelHome=0;collapse=true}
}

function ShowHiddenPanel(permanent,id,source,main_id)
{
	ShowHiddenPanel(permanent,id,source,main_id,null);
}
function ShowHiddenPanel(permanent,id,source,main_id,insert_data){
		//Cancel the link behavior
//		e.preventDefault();
		
		//Get the A tag
//		var id = $(this).attr('href');
		$(main_id).html("");
		if(insert_data==null){
			$.post(source,{code_hidden:id}, function(data) {
				$(main_id).html(data);
			}); 
		}else{
//			var values = "username=" + encodeURI(document.getElementById('username').value ) + "&password=" + encodeURI( document.getElementById('password').value);
			insert_data = "code_hidden=" + encodeURI(id) + insert_data
			var hanres = function(data){
							$(main_id).html(data);
			};
			postAjax(source, insert_data, hanres);
//			$.post(source,{code_hidden:id,plus:insert_data}, function(data) {
//				$(main_id).html(data);
//			}); 
//			$.post(source,{code_hidden:id}, function(data) {
//				$(main_id).html(data);
//			}); 
		}
		main_id_panel = id;

		//Get the screen height and width
		var maskHeight = $(window).height()*5;
		var maskWidth = $(window).width()*5;
		var mask = '#mask';
		if(permanent){
			mask = '#mask_p';	
		}
		//Set heigth and width to mask to fill up the whole screen
		$(mask).css({'width':maskWidth,'height':maskHeight});

		//transition effect		
		document.documentElement.style.overflow = "hidden";
		$(mask).fadeIn(500);	
		$(mask).fadeTo("fast",0.2);
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
        
		//Set the popup window to center
		$(main_id).css('top',  winH/2-$(main_id).height()/2);
		$(main_id).css('left', winW/2-$(main_id).width()/2);
	
		//transition effect
		$(main_id).fadeIn(1000);
		InitCenterPanel(main_id);
}


function CenteredPanel(main_id){
		var winH = $(window).height();
		var winW = $(window).width();
		$(main_id).css('top',  (winH/2.5)-$(main_id).height()/2.5);
		$(main_id).css('left', (winW/2)-$(main_id).width()/2);
}

function HidePanel(){
		StopTheCenterPanel();
		$('.main_panel').hide();
		$('#mask').hide();
		$('#mask_p').hide();
		document.documentElement.style.overflow = "auto";
}

var tS = null
var tR = false
var tD = 100
function InitCenterPanel(main_id)
{
    StopTheCenterPanel();
    StartTheCenterPanel(main_id);
}

function StopTheCenterPanel()
{
    if(tR)
        clearTimeout(tS)
    tR = false
}

function StartTheCenterPanel(main_id)
{
	CenteredPanel(main_id);
    tR = true
    tS = self.setTimeout("StartTheCenterPanel(\""+main_id+"\")", tD)
}
