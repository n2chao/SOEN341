/**
* Projet Name : Dynamic Form Processing with PHP
* URL: http://techstream.org/Web-Development/PHP/Dynamic-Form-Processing-with-PHP
*
* Licensed under the MIT license.
* http://www.opensource.org/licenses/mit-license.php
*
* Copyright 2013, Tech Stream
* http://techstream.org
*/

/*Hey guys, with honesty I have modified the addRow() code section from this website so that it fits our project,
however, the deleteRow() I changed it so that users won't have to check the corresponded boxes whenever the user removes the courses.
Which makes it more user-friendly now.*/

function addRow(tableID) {

	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	if(rowCount < 7){
		var row = table.insertRow(rowCount);
		var colCount = table.rows[0].cells.length;
		for(var i=0; i<colCount; i++) {
			var newcell = row.insertCell(i);
			newcell.innerHTML = table.rows[0].cells[i].innerHTML;

		}
	}else{
		alert("You can only add up to 7 courses.");

	}
}

function deleteRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	if(rowCount<=1){
		alert("You must enter at least one course.")
	}else{
		document.getElementById(tableID).deleteRow(0);
		rowCount--;
	}
	/*var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	for(var i=0; i<rowCount; i++) {
	var row = table.rows[i];

	var chkbox = row.cells[0].childNodes[0];


	if(null != chkbox && true == chkbox.checked) {
	if(rowCount <= 1) { 						// limit the user from removing all the fields
	alert("Must enter one course at least.");
	break;
}
table.deleteRow(i);
rowCount--;
i--;
}
}*/
}
