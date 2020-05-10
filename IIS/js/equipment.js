function generateEquip() {
    $.get("php/freeGear.php", function(data){
        freeGear = jQuery.parseJSON(data);
        $.get("php/ownedGear.php", function(data){
			userGear = jQuery.parseJSON(data);
            $(".col-md-9").empty();
            $(".col-md-9").html(generateMyTableHTML("My Equipment")).append(generateMyTableHTML("Free Equipment"));
            generateTableContent(true);
            generateTableContent(false);
        });
    });
}

function generateMyTableHTML(header) {
    var htmlTable = "<div class='container'><h3>" + header + "</h3><div class='table-wrapper-scroll-y'><table class='table' style='display: block; max-height: 200px; overflow-y: auto; -ms-overflow-style: -ms-autohiding-scrollbar;'><thread><tr><th class='col-xs-4 serialNumber'>Serial number</th><th class='col-xs-4 equipType'>Type</th><th class='col-xs-4 equipPrice'>Price</th><th class='col-xs-4 equipCom'>Command</th></tr></thread><tbody class='tableBody'></tbody></table></div></div>";
    return htmlTable;
}

function generateTableContent(flag){
    var ret_string = "<tr>";
    var td = "<td class='col-xs-4'>";
    var tdEnd = "</td>";
    var tmp;

    if(flag){
        tmp = userGear;
        for(var object in tmp){
            ret_string += td + tmp[object].ID_vyrobni_cislo + tdEnd + td + tmp[object].ID_vybaveni_typ + tdEnd + td + tmp[object].cena + tdEnd + td + "<button class='btn btn-secondary offGearBut' id='" + tmp[object].ID_vyrobni_cislo + "'>OFF</button>" + tdEnd + "</tr>";
        }
    }
    else{
        tmp = freeGear;
        for(var object in tmp){
            ret_string += td + tmp[object].ID_vyrobni_cislo + tdEnd + td + tmp[object].ID_vybaveni_typ + tdEnd + td + tmp[object].cena + tdEnd + td + "<button class='btn btn-secondary getGearBut' id='" + tmp[object].ID_vyrobni_cislo + " '" + checkFreeGear(tmp[object].ID_vybaveni_typ) + ">ON</button>" + tdEnd + "</tr>";
        }
    }

    if(flag){
        $(".tableBody").first().html(ret_string);
    }
    else{
        $(".tableBody").last().html(ret_string);
    }
}

function getTrainingGear(){
    var trainingArray = [];
    for(i = 0; i < userTrainGear.length; i++){
        trainingArray[i] = userTrainGear[i].ID_vybaveni_typ;
    }
    return trainingArray;
}

function checkFreeGear(typ){
    var training = getTrainingGear();
    for(i = 0; i < training.length; i++){
        if(training[i] === typ){
            return "";
        }
    }
    return "disabled";
}

$(document).on('click','.getGearBut',function(){
    $.post("php/takeGear.php", { ID_vyrobni_cislo: $(this).attr("id") }, function(data){
        if(data === null){
            alert("Unable to get gear: "+$(this).attr("id"));
        }
        else{
            location.href = "http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/menu.php#equipment";
            location.reload();
        }
    });
});

$(document).on('click','.offGearBut',function(){
    $.post("php/leaveGear.php", { ID_vyrobni_cislo: $(this).attr("id") }, function(data){
        if(data === null){
            alert("Unable to take off gear: "+$(this).attr("id"));
        }
        else{
            location.href = "http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/menu.php#equipment";
            location.reload();
        }
    });
});