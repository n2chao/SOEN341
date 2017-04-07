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
			searchField: ['code'],		//what to analyze when filtering?
			maxOptions: 10,
			create: false,
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
			var newcell = row.insertCell(0);
			newcell.innerHTML = '<tr><td><div class="col-md-6"> <select id="course_name_'+rowCount+'" type="text" placeholder="i.e SOEN341" class="form-control" name="add_course_ids['+rowCount+']"> </div> <input type="button" value="Remove" onClick="deleteRow(\'dataTable\')" class="btn btn-primary btn-xs"  /></td></tr>'
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
