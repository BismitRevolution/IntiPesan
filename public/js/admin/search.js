function search(field, table, index) {
    var query = document.getElementById(field).value.toLowerCase();
    var table = document.getElementById(table);
    var rows = table.getElementsByTagName("tr");
    for (var i = 0; i < rows.length; i++) {
        var td = rows[i].getElementsByTagName("td")[index];
        if (td) {
            var txtValue = td.textContent || td.innerText;
            if (txtValue.toLowerCase().indexOf(query) > -1) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    }
}

$(document).ready(function() {
    console.log('search loaded');
});
