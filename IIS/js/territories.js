var otherTerritories;

function showDistricCards(){
    $.get("php/myDistrict.php", function(data){
        userTerritories = jQuery.parseJSON(data);
        $.get("php/otherDistrict.php", function(data){
            otherTerritories = jQuery.parseJSON(data);
            $(".col-md-9").html(iterateTerritory(userTerritories, 0) + iterateTerritory(otherTerritories, 1));
        });
    });
}

function iterateTerritory(territory, flag){
    var ret = "";

    for(type in territory){
        ret += generateCard(type, flag);
    }

    return ret;
}

function generateCard(district, flag){
    var DivCard = "<div class='card' style='width: 18rem;'>";
    var DivEnd = "</div>";
    var img = "<img class='card-img-top' src='src/alley.jpg' style='height: 180px; width: 180px;' alt='Card image cap'>";
    var DivCardCont = "<div class='card-body'>";
    var headText = "<h5 class='card-title' style='text-align: center';>";
    var headEnd = "</h5>";
    var list = "<ul class='list-group list-group-flush'>";
    var listEnd = "</ul>";
    var listItemStart = "<li class='list-group-item' style='text-align: center'>";
    var ListItemEnd = "</li>";
    var aEnd = "</a>";
    var header, capacity, treasure, button;

    if(flag === 0){
        header = userTerritories[district].ID_oblast;
        capacity = listItemStart + userTerritories[district].pocet_lidi + "/" + userTerritories[district].kapacita + ListItemEnd;
        treasure = listItemStart + userTerritories[district].dostupne_bohatstvi + " Gold" + ListItemEnd;
        button = "<a href='#" + header + "' class='btn btn-primary leaveBut' style='margin-left: 50px; background-color: red; border-color: grey;'>" + "Leave" + aEnd;
    }
    else{
        header = otherTerritories[district].ID_oblast;
        capacity = listItemStart + otherTerritories[district].pocet_lidi + "/" + otherTerritories[district].kapacita + ListItemEnd;
        treasure = listItemStart + otherTerritories[district].dostupne_bohatstvi + " Gold" + ListItemEnd;
        button = "<a href='#" + header + "' class='btn btn-primary joinBut' style='margin-left: 50px; background-color: green; border-color: grey;'>" + "Join" + aEnd;
    }

    return (DivCard + img + DivCardCont + headText + header + headEnd + list + treasure + capacity + listEnd + button + DivEnd + DivEnd);
}

$(document).on('click','.joinBut',function(){
    $.post("php/joinDistrict.php", { ID_oblast: $(this).attr("href").substr(1) }, function(data){
        if(data === null){
            alert("Unable to join you in territory: "+$(this).attr("href").substr(1));
        }
        else{
            location.href = "http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/menu.php#territories";
            location.reload();
        }
    }); 
});

$(document).on('click','.leaveBut',function(){
    $.post("php/leaveDistrict.php", { ID_oblast: $(this).attr("href").substr(1) }, function(data){
        if(data === null){
            alert("Unable to join you in territory: "+$(this).attr("href").substr(1));
        }
        else{
            location.href = "http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/menu.php#territories";
            location.reload();
        }
    }); 
});