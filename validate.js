/* 
Shravani Raju Pathapati
823370204
CS 545 - Cyndi Chie
Index Assigment 2 
*/

// Last updated text - DATE for each page
function lastModified() {
    var modiDate = new Date(document.lastModified)
    var showAs = (modiDate.getMonth() + 1) + "/" + modiDate.getDate() 
    			+ "/" + modiDate.getFullYear()
    return showAs
}

// Extra Function : Converting 9 seconds to 09 seconds; 9 minutes to 09 minutes & so on..
// To reduce text flickering due to different time sizes
function two_digits(n){
    return n > 9 ? "" + n: "0" + n
}

// Last updated text - TIME for each page
function GetTime() {
    var modiDate = new Date()
    var CurTime = two_digits(modiDate.getHours()) + ":" + two_digits(modiDate.getMinutes()) 
    				+ ":" + two_digits(modiDate.getSeconds())
    return CurTime
}

// Last Updated Date & Time for each page
function updatePage() {
	console.log(document.getElementById('lastUpdated'))

	document.getElementById('lastUpdated').innerHTML = "Last updated on " 
					+ lastModified() + ", at " + GetTime()
}

// Extra Function : Display browser version
function browserProperty(){
	document.getElementById("browserProperties").innerHTML = "Browser Version: " + navigator.appVersion;
}

//function used to caluclate the total attendees
function updateTotal() {
	document.getElementById('total_attendees').value = 0
	
	var id1 = +document.getElementById("attendees_under5").value
	var id2 = +document.getElementById("attendees_5_12").value
	var id3 = +document.getElementById("attendees_13_17").value
	var id4 = +document.getElementById("attendees_over18").value
	
	document.getElementById('total_attendees').value = id1 + id2 + id3 + id4
}

// Extra functionality: Disable right click to prevent page text copy
var message = "Function Disabled!"

function clickIE() {
	if (document.all) {
		alert(message)
		return false
	}
}

function clickNS(e) {
	if (document.layers || (document.getElementById && !document.all)) {
		if (e.which == 2 || e.which == 3) {
			alert(message)
			return false
		}
	}
}
		
if (document.layers) {
	document.captureEvents(Event.MOUSEDOWN)
	document.onmousedown = clickNS
} else {
	document.onmouseup = clickNS
	document.oncontextmenu = clickIE
}

document.oncontextmenu = new Function("return false")


// Background color changes every few seconds
function backgroundColors(){
	setInterval(
	function () {
		var colors_array = ["1569C7",  "2B60DE",  "1F45FC",  "6960EC",  "736AFF", 
		"357EC7",  "368BC1",  "488AC7",  "3090C7",  "659EC7",  "87AFC7",  "95B9C7",  
		"728FCE",  "2B65EC",  "306EFF",  "157DEC",  "1589FF",  "6495ED",  "6698FF",  
		"38ACEC",  "56A5EC",  "5CB3FF",  "3BB9FF",  "79BAEC",  "82CAFA",  "82CAFF",  
		"A0CFEC",  "B7CEEC",  "B4CFEC",  "C2DFFF",  "C6DEFF",  "AFDCEC",  "ADDFFF",  
		"BDEDFF",  "CFECEC",  "E0FFFF",  "EBF4FA",  "F0F8FF",  "F0FFFF",  "CCFFFF",  
		"93FFE8",  "9AFEFF",  "7FFFD4",  "00FFFF",  "7DFDFE",  "57FEFF",  "8EEBEC",  
		"50EBEC",  "4EE2EC",  "81D8D0",  "92C7C7",  "77BFC7",  "78C7C7",  "48CCCD",  
		"43C6DB",  "46C7C7",  "7BCCB5",  "43BFC7",  "C45AEC",  "9172EC",  "9E7BFF", 
		"D462FF",  "E238EC",  "C38EC7",  "C8A2C8",  "E6A9EC",  "E0B0FF",  "C6AEC7", 
		"F9B7FF",  "D2B9D3",  "E9CFEC",  "EBDDE2",  "E3E4FA",  "FDEEF4",  "FFF5EE", 
		"FEFCFF",  "FFFFFF"];

  		var randomColor = colors_array[Math.floor(Math.random()*colors_array.length)];
  		document.body.style.backgroundColor = "#"+randomColor;
  		
	},4500);
}

// // Name function not working properly. cannot find the issue

// // function for capitalising the first letter for first name and last name
// // String.prototype.capitalize = function(){ 
// // 	return this.replace(/\w\S*/g, function (m) { 
// // 		return m.charAt(0).toUpperCase() + m.substr(1).toLowerCase();
// // 	}); 
// // };

// // function setFirstLetterCapital(){
// // 	var fname = document.getElementById("firstname");
// // 	document.getElementById('firstname').value = "First Name is:"
// // 						+ String.prototype.capitalize.call(fname);

// // 	var lname = document.getElementById("lastname");
// // 	document.getElementById('lastname').value = "Last Name is:" 
// // 						+ String.prototype.capitalize.call(fname);
// // }
// String.prototype.capitalize = function(){ return this.toLowerCase().replace( /\b\w/g, function (m) { return m.toUpperCase(); }); };

// function setFirstLetterCapital(){
// var fname=document.getElementById("firstname").innerHTML;
// document.getElementById("firstname").innerHTML = "First Name is:" + String.prototype.capitalize.call(fname);
// var lname=document.getElementById("lastname").innerHTML;
// document.getElementById("lastname").innerHTML = "Last Name is:" + String.prototype.capitalize.call(lname);

// }
// // function setFirstLetterCapital(){
// // 	var fname=document.getElementById('firstname').value
// // 	document.getElementById('firstname').innerHTML = fname.charAt(0).toUpperCase + fname.slice(1)
// // 	// String.prototype.capitalize.call(fname);
// // 	var lname=$('#lastname')
// // 	document.getElementById("lastname").value = lname.charAt(0).toUpperCase + lname.slice(1)
// // 	// String.prototype.capitalize.call(lname);
// // }

// // function setFirstLetterCapital(name){
// // 	var fname=document.getElementById(name).value
// // 	document.getElementById(name).innerHTML = fname.charAt(0).toUpperCase + fname.slice(1)
// // 	// // String.prototype.capitalize.call(fname);
// // 	// var lname=$('#lastname')
// // 	// document.getElementById("lastname").value = lname.charAt(0).toUpperCase + lname.slice(1)
// // 	// // String.prototype.capitalize.call(lname);
// // }
