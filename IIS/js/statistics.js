var robStats = null;

function showStats(){
    $.get("php/statRob.php", function(data){
        robStats = jQuery.parseJSON(data);
        if(robStats.length !== 0){
            $('.restOf').html('<table class="table stat-table"><thead><tr><th scope="row">#</th><th scope="row">Thief</th><th scope="row">No robberies</th></tr></thead><tbody>' + generateThiefStats() + '</tbody></table>')
        }
    })
}

function generateThiefStats(){
    var ret_string = "";

    for(i = 0; i < robStats.length; i++){
        ret_string += '<tr><td scope="row">' + (i+1) + '</td><td>' + robStats[i].prezdivka + '</td><td>' + robStats[i].pocet_loupezi + '</td></tr>';
    }

    return ret_string;
}