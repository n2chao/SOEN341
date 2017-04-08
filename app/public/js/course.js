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

//inspired by https://maxoffsky.com/code-blog/laravel-shop-tutorial-3-implementing-smart-search/
jQuery(document).ready(function($){		//wrap jquery to prevent bug
	selectizeRow = function(id){
		$('#' + id).selectize({
			valueField: 'code',			//value when item is selected
			labelField: 'code',			//not used if custom render function is defined
			searchField: ['code'],		//what to analyze when filtering
			maxItems: 1,
			maxOptions: 10,
			create: false,
			onItemAdd: function(value, $item){
				//set course description once selected
				document.getElementById(id+"_description").innerHTML=this.options[value].name;
			},
			load: function(query, callback) {
				if (!query.length) return callback();
				$.ajax({
					url: '/search',		//see web.php
					type: 'GET',
					dataType: 'json',
					data: {
						q: query
					},
					error: function(response) {
						callback();
					},
					success: function(response) {
						callback(response.data);
					}
				});
			},
		});
	}

	addRow = function(tableID){
		var table = document.getElementById(tableID);
		var rowCount = table.rows.length;
		if(rowCount < 7){
			var row = table.insertRow(rowCount);
			var courseCell = row.insertCell(0);
			var removeCell = row.insertCell(1);
			courseCell.innerHTML = '<input id="course_name_'+rowCount+'" type="text" style="width: 190px;" placeholder="i.e. SOEN341" name="add_course_ids['+rowCount+']">';
			removeCell.innerHTML = '<p id="course_name_'+rowCount+'_description"></p>';
			removeCell.align = "right";	//align css
		}else{
			alert("You can only add up to 7 courses.");
		}
		selectizeRow("course_name_"+rowCount);
	}

	deleteRow = function(tableID) {
		var table = document.getElementById(tableID);
		var rowCount = table.rows.length;
		if(rowCount<=1){
			alert("You must enter at least one course.")
		}else{
			document.getElementById(tableID).deleteRow(rowCount-1);
			rowCount--;
		}
	}
	//selectize first input when document ready
	$(document).ready(selectizeRow("course_name_0"));
});
