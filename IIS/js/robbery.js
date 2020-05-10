var freePosCoupon   = null;
var freeUnposCoupon = null;
var myDistricts     = null;
var districtThieves = null;

var coupon      = null;
var couponText  = null;
var district    = null;
var thieves     = [];
var spoil       = null;

function prepareRobbery() {
    $.get("php/freePosCoupon.php", function(data){
        freePosCoupon = jQuery.parseJSON(data);
        $.get("php/freeUnposCoupon.php", function(data){
            freeUnposCoupon = jQuery.parseJSON(data);
            if(freePosCoupon.length !== 0){
                $.get("php/myDistrictsForRobbery.php", function(data) {
                    myDistricts = jQuery.parseJSON(data);
                    robberyStructure();
                    generateCouponMenu();
                    generateUnableCouponMenu(); 
                });
            }
            else{
                $('.restOf').html("<h1 style='margin-left: 300px; color: green;'>There is no free coupons for you!</h1><p style='margin-left: 350px'><i>Try later or train yourself in new ways of earning money.</i></p>")
            }
        });
    });
}

function robberyStructure() {
    $('.restOf').html('<div class="container rob-cont"><div class="row"><div class="col"></div><div class="col"><table class="table"><thead><tr><th scope="col">Coupon</th><th scope="col">District</th><th scope="col">Thieves</th><th scope="col">Spoil</th></tr></thead><tbody><tr><td class="coupon-td"></td><td class="district-td"></td><td class="thieves-td"></td><td class="spoil-td"></td></tr></tbody></table></div><div class="col"></div></div></div><div class="container rob-cont"><div class="row"><div class="col free-coupon"></div><div class="col not-coupon"></div></div></div><div class="container rob-cont"><div class="row"><div class="col"><h3 class="row" style="margin-top: 50px; margin-bottom: 50px;">Districts</h3></div><div class="rob-districts col"></div><div class="col"></div></div></div><div class="container rob-cont"><div class="row"><div class="col"><h3 class="row" style="margin-top: 50px; margin-bottom: 50px;">Thieves</h3></div><div class="rob-thieves col"></div><div class="col thieves-button"></div></div></div><div class="container rob-cont"><div class="row"><div class="col"><h3 style="margin-top: 50px; margin-bottom: 50px;">Spoil</h3></div><div class="spoil col"></div><div class="col spoil-button"></div></div></div><div class="container rob-cont><div class="row"><div class="col"></div><div class="rob-confirm col"></div><div class="col"></div></div></div>');
    $('.rob-cont').css("border-bottom", "1px solid grey", "border-radius", "8px");
}

function generateCouponMenu(){
    $('.free-coupon').html('<h3>Available Coupons</h3><div class="btn-group"><button type="button" class="btn btn-secondary coupon-but dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Coupon</button><div class="dropdown-menu">' + generateCouponItem() + '</div></div>');
}

function generateCouponItem() {
    var couponItems = "";

    for(i = 0; i < freePosCoupon.length; i++){
        couponItems += '<a class="dropdown-item coupon-item" href="#' + freePosCoupon[i].ID_poukazka + '">' + freePosCoupon[i].ID_loupez_typ + '</a>';
    }

    return couponItems;    
}

function generateUnableCouponMenu(){
    $('.not-coupon').html('<h3 class="row">Unavailable Coupons</h3><ul class="list-group">' + generateUnableCouponItem() + '</ul>');
}

function generateUnableCouponItem(){
    var UnableCouponItems = "";
    
    if(freeUnposCoupon.length !== 0){
        for(i = 0; i < freeUnposCoupon.length; i++){
            UnableCouponItems += '<li class="list-group-item" style="border-color: red; text-align: center; width: 30%;">' + freeUnposCoupon[i].ID_loupez_typ + '</li>';
        }
    }
    else{
        UnableCouponItems += '<li>No unavailable coupons</li>';
    }

    return UnableCouponItems;
}

function generateDistrictMenu(){
   $('.rob-districts').html('<div class="btn-group row"><button type="button" class="btn btn-secondary district-but dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top: 50px; margin-bottom: 50px;">District</button><div class="dropdown-menu">' + generateDistrictItem() + '</div></div>');
}

function generateDistrictItem(){
    var DistrictItem = "";

    for(i = 0; i < myDistricts.length; i++){
        DistrictItem += '<a class="dropdown-item district-item" href="#' + myDistricts[i].ID_oblast + '">' + myDistricts[i].ID_oblast + '</a>';
    }

    return DistrictItem;
}

function generateThievesMenu(){
    $.post("php/getAliveBurglarsInDistrictWithTraining.php", {ID_rajon: district, ID_loupez_typ: couponText}, function(data){
        districtThieves = jQuery.parseJSON(data);    
        $('.rob-thieves').html('<ul class="list-group thieves-menu"  style="margin-top: 50px; margin-bottom: 50px;">' + generateThievesItem() + '</ul></div>');
        $('.thieves-button').html('<button class="btn btn-secondary call-thieves" style="margin-top: 50px; margin-bottom: 50px;">Call Thieves</button>');
    });
}

function generateThievesItem(){
    var ThievesItem = "";

    if(districtThieves.length !== 0){
        for(i = 0; i < districtThieves.length; i++){
            ThievesItem += '<li class="list-group-item form-group form-check"><input type="checkbox" class="form-check-input" id="' + districtThieves[i].ID_rodne_cislo + '"><label class="form-check-label" for="' + districtThieves[i].ID_rodne_cislo + '"><p style="padding-left: 50px;">' + districtThieves[i].prezdivka + '</p></label></li>';
        }
    }
    else{
        ThievesItem += '<li>No thieves available in District</li>';
    }

    return ThievesItem;
}

function generateSpoilForm(){
    $('.spoil').html('<div class="form-group" style="margin-top: 50px; margin-bottom: 50px;"><input type="number" class="form-control" id="spoil-input" name="quantity" min="1" max="' + getDistrictValue() + '" aria-describedby="spoilHelp" placeholder="Enter spoil value"><small id="spoilHelp" class="form-text text-muted">Input value must be between 1 and ' + getDistrictValue() + '.</small></div>');
    $('.spoil-button').html('<button class="btn btn-secondary spoil-but" style="margin-top: 50px; margin-bottom: 50px;">Submit</button>');
}

function generateConfirmButt(){
    $('.rob-confirm').html("<button type='button' class='btn btn-primary btn-sm btn-lg rob-confirm-but' style='margin-top: 50px; margin-bottom: 50px;'>LET'S GO TO WORK!!!</button>");
}

function getDistrictValue() {
    for(i = 0; i < myDistricts.length; i++){
        if(myDistricts[i].ID_oblast === district){
            return myDistricts[i].dostupne_bohatstvi;
        }
    }
}

function clearTable(){
    $('.district-td').empty();
    $('.thieves-td').empty();
    $('.spoil-td').empty();

    $('.rob-thieves').empty();
    $('.thieves-button').empty();
    
    $('.spoil').empty();
    $('.spoil-button').empty();

    $('.rob-confirm').empty();
}

function clearOnDistrict() {
    $('.thieves-td').empty();
    $('.spoil-td').empty();

    $('.rob-thieves').empty();
    $('.spoil').empty();
    $('.rob-confirm').empty();
}

function clearOnThieves() {
    $('.spoil-td').empty();

    $('.spoil').empty();
    $('.rob-confirm').empty();
}

function thievesArray(){

}

$(document).on('click','.dropdown-item',function(){
    if($(this).attr('class').split(' ')[1] === "coupon-item"){
        $('.coupon-td').text($(this).text());
        coupon = $(this).attr('href').substr(1);
        couponText = $(this).text();
        clearTable();
        generateDistrictMenu();
    }
    else if($(this).attr('class').split(' ')[1] === "district-item"){
        $('.district-td').text($(this).text());
        district = $(this).text();
        clearOnDistrict();
        generateThievesMenu();
    }        
});

$(document).on('click', '.call-thieves', function(){
    var noThieves = 0;
    thieves = [];

    clearOnThieves();

    $('.form-check-input').each(function() {
        if($(this).is(':checked')){
            thieves.push($(this).attr('id'));
            noThieves++;
        }
    });
    
    $('.thieves-td').text(noThieves);
    generateSpoilForm();
});

$(document).on('click', '.spoil-but', function() {
    if($('#spoil-input').val() < 1 || $('#spoil-input').val() > parseInt(getDistrictValue(), 10)){
        $('#spoil-input').css("border-color","red");
    }
    else{
        $('.spoil-td').text($('#spoil-input').val());
        spoil = parseInt($('#spoil-input').val(), 10);
        generateConfirmButt();
    }
});

$(document).on('click', '.rob-confirm-but', function() {
    $.post("php/letsSteal.php", {ID_poukazka: coupon, ID_oblast: district, korist: spoil, ID_loupez_typ: couponText, zlodejove: thieves}, function(data) {
        if(data === "ok"){
            $('restOf').empty();
            alert("Succesfull robbery! Our glorious leader will be pleased!");
            location.href === "http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/menu.php?quantity=#home";
            location.reload();
        }
        else{
            alert("Robbery wasn't successfull! Our glorious leader won't be pleased!");
            location.href === "http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/menu.php?quantity=#home";
            location.reload();
        }
    });
});

$(document).on('mouseover', '#spoil-input', function() {
    $('#spoil-input').css("border-color","");
});