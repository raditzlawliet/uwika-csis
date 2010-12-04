//
//function createXmlHttpRequest() {
//	var xmlHttp = false;
//	if (window.ActiveXObject) {
//		xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
//	} else {
//		xmlHttp = new XMLHttpRequest();
//	}
//	if (!xmlHttp) {
//		alert("Ops sorry We found some error!!");
//	}
//	return xmlHttp;
//}
//
//function postAjax(source, values, respons, hanres, xmlHttp) {
//  if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0) {
//	obj = respons;
//	xmlHttp.open("POST", source, true);
//	xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//	xmlHttp.setRequestHeader("Content-length", values.length);
//	xmlHttp.setRequestHeader("Connection", "close");
//	xmlHttp.onreadystatechange = hanres;
//	xmlHttp.send(values);
////	alert('source : '+source+' values : '+values+' respons : '+respons+' hanres :  '+hanres+' xml :	 '+xmlHttp);
//  } else {
//	setTimeout('postAjax(source, values, respons, hanres, xmpHttp)', 100000);
//  }
//}
function postAjax(source, values, respons, hanres){
	obj = respons;
	$.ajax({type: "POST", url: source, data: values,async: true, success:hanres, timeout:10000}); 
}