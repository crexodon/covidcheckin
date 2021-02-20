var button = document.getElementById("button");
var check = document.getElementById("check");
var table = document.getElementById("table");
var info = document.getElementById("info");
var infotext = document.getElementById("infotext");
var status = document.getElementById("status");
var leftPic = document.getElementById("leftPic");
var rightPic = document.getElementById("rightPic");

if(checked == "CheckOut"){
	check.innerHTML = "Zum Einchecken Button betätigen.";
	button.checked =false;
	leftPic.style.display = "block";
	rightPic.style.display = "none";
}

if(checked == "CheckIn") {
	check.innerHTML = "Zum Auschecken Button betätigen.";
	button.checked =true;
	leftPic.style.display = "none";
	rightPic.style.display = "block";
}

function myFunction() {
	if(checked == "CheckOut")	{
	checked = "CheckIn";
	leftPic.style.display = "none";
	rightPic.style.display = "block";
	check.innerHTML = "Zum Auschecken Button betätigen.";	
	infotext.innerHTML = "Sie wurden erfolgreich eingecheckt und können sich nun im Gebäude bewegen! Berücksichtigen Sie bitte die AHA Regeln und weisen Sie Leute, die diese nicht berücksichtigen darauf hin. Beim Verlassen bitte den Check out Button drücken.";
	table.style.display = "block";
	info.style.display = "block";
	status.style.display = "none";
	}
	else {
	checked = "CheckOut";
	leftPic.style.display = "block";
	rightPic.style.display = "none";
	check.innerHTML = "Zum Einchecken Button betätigen.";
	infotext.innerHTML = "Sie wurden erfolgreich ausgecheckt! Falls Sie sich noch in einem Hochschulgebäude befinden, verlassen Sie dieses bitte, oder checken Sie erneut ein.";
	table.style.display = "none";
	info.style.display = "block";
	status.style.display = "block";
	}
}