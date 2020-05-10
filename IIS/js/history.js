var myHistory   = null;

function showHistory() {
    $.get('php/myRob.php', function(data) {
        myHistory = jQuery.parseJSON(data);
        if(myHistory.length !== 0){
            generateHistory();
        }
        else if(myHistory === null){
            alert("MISTAKE");
        }
        else{
            $(".col-md-9").html("<h1 style='margin-left: 300px; color: green;'>You have no records!</h1><p style='margin-left: 350px'><i>Try robbery, or our glorious leader will be furious!</i></p>");
        }
    });
}

function generateHistory() {
    var HistoryItems = generateHistoryItems();
    $('.col-md-9').html('<table class="table history-table"><thead><tr><th scope="col">#</th><th scope="col">District</th><th scope="col">Action</th><th scope="col">Spoil</th></tr></thead><tbody>' + HistoryItems + '</tbody></table>');
    $('.history-table').css('background-color', '#ffff99');
}

function generateHistoryItems() {
    var Items = "<tr>";

    for(i = 0; i < myHistory.length; i++){
        Items += '<th scope="row">' + (i+1) + '</th><th>' + myHistory[i].ID_oblast + '</th><th>' + myHistory[i].ID_loupez_typ + '</th><th>' + myHistory[i].korist + '</th></tr>';
    }

    return Items;
}