function deleteRow(r, tableID) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById(tableID).deleteRow(i);
    checkEmpty(tableID);
}

function checkEmpty(tableID) {
  mytable     = document.getElementById(tableID);
  mytablebody = mytable.getElementsByTagName("tbody")[0];
  firstrow       = mytablebody.getElementsByTagName("tr")[0];

  if(firstrow == null){
    var div = document.getElementById('ifMatchesEmpty');
    div.innerHTML = div.innerHTML + 'No matches to display.';
  }
}
