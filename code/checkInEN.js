var button = document.getElementById("button");
var check = document.getElementById("check");
var table = document.getElementById("table");
var info = document.getElementById("info");
var infotext = document.getElementById("infotext");
var status = document.getElementById("status");
var leftPic = document.getElementById("leftPic");
var rightPic = document.getElementById("rightPic");

if(checked == "CheckOut"){
	check.innerHTML = "Press the Button to check in.";
	button.checked =false;
	leftPic.style.display = "block";
	rightPic.style.display = "none";
}

if(checked == "CheckIn") {
	check.innerHTML = "Press the Button to check out.";
	button.checked =true;
	leftPic.style.display = "none";
	rightPic.style.display = "block";
}

function myFunction() {
	if(checked == "CheckOut")	{
	checked = "CheckIn";
	leftPic.style.display = "none";
	rightPic.style.display = "block";
	check.innerHTML = "Press the Button to check out.";
	infotext.innerHTML = "Check in successful! You can now move within the University. Make sure to follow the AHA-Rules and please point out to people who aren't following them. When leaving the University, please press the Button again.";
	table.style.display = "block";
	info.style.display = "block";
	status.style.display = "none";
	}
	else {
	checked = "CheckOut";
	leftPic.style.display = "block";
	rightPic.style.display = "none";
	check.innerHTML = "Press the Button to check in.";
	infotext.innerHTML = "Check out successful! If you're still inside of the University, please leave it immediately, or check in again.";
	table.style.display = "none";
	info.style.display = "block";
	status.style.display = "block";
	}
}