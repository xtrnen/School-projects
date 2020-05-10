function showTraining(){
    $.get("php/notOwnedTrainRob.php", function(data){
        freeTrainRob = jQuery.parseJSON(data);
        $.get("php/notOwnedTrainGear.php", function(data){
            freeTrainGear = jQuery.parseJSON(data);
            $(".col-md-9").html(generateTrainingTableBone());
        });
    });
}

function generateTrainingTableBone(){
    var ret_string;

    ret_string = "<div class='container'><h3>" + "Equipment's Training" + "</h3>";
    ret_string += "<table class='table table-fixed'><thread><tr><th class='col-xs-4'>Equipment Type</th><th class='col-xs-4'>Command</th></tr></thread>";
    ret_string += "<tbody>" + generateTrainingTableContent(0) + "</tbody></table></div>";

    ret_string += "<div class='container'><h3>" + "Robbery's Training" + "</h3>";
    ret_string += "<table class='table table-fixed'><thread><tr><th class='col-xs-4'>Robbery</th><th class='col-xs-4'>Command</th></tr></thread>";
    ret_string += "<tbody>" + generateTrainingTableContent(1) + "</tbody></table></div>";

    return ret_string;
}

function generateTrainingTableContent(flag){
    var ret_string = "";
    var td = "<td class='col-xs-4'>";
    
    if(flag === 0){
        if(userTrainGear.length !== 0){
            for(i = 0; i < userTrainGear.length; i++){
                ret_string += "<tr>" + td + userTrainGear[i].ID_vybaveni_typ + "</td>" + td + "<button class='btn btn-secondary' disabled>Attend</button></td></tr>";
            }
        }
        if(freeTrainGear.length !== 0){
            for(i = 0; i < freeTrainGear.length; i++){
                ret_string += "<tr>" + td + freeTrainGear[i].ID_vybaveni_typ + "</td>" + td + "<button class='btn btn-secondary attendGearBut' id='" + freeTrainGear[i].ID_vybaveni_typ + "' enabled>Attend</button></td></tr>";
            }
        }
    }
    else{
        if(userTrainRob.length !== 0){
            for(i = 0; i < userTrainRob.length; i++){
                ret_string += "<tr>" + td + userTrainRob[i].ID_loupez_typ + "</td>" + td + "<button class='btn btn-secondary' disabled>Attend</button></td></tr>";
            }
        }
        if(freeTrainRob.length !== 0){
            for(i = 0; i < freeTrainRob.length; i++){
                ret_string += "<tr>" + td + freeTrainRob[i].ID_loupez_typ + "</td>" + td + "<button class='btn btn-secondary attendRobBut' id='" + freeTrainRob[i].ID_loupez_typ + "' enabled>Attend</button></td></tr>";
            }
        }
    }
    return ret_string;
}

$(document).on('click','.attendGearBut',function(){
    $.post("php/doGearTraining.php", { ID_vybaveni_typ: $(this).attr("id") }, function(data){
        if(data === null){
            alert("Unable to attend training: "+$(this).attr("id"));
        }
        else{
            location.href = "http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/menu.php#training";
            location.reload();
        }
    });
});

$(document).on('click','.attendRobBut',function(){
    $.post("php/doRobTraining.php", { ID_loupez_typ: $(this).attr("id") }, function(data){
        if(data === null){
            alert("Unable to attend training: "+$(this).attr("id"));
        }
        else{
            location.href = "http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/menu.php#training";
            location.reload();
        }
    });
});