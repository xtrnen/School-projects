<?php
include_once "../php/session_control.php";
if(!isset($_SESSION)){
    session_start();
}

if($_SESSION['vudce']!= 1){
    session_destroy();
    header("location: http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/index.php");
}
?>
<!doctype html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style>
        body {
            background-color: #F1F3FA;
        }
        .container{
            border-bottom: 1px solid grey;
            padding: 20px 20px 20px 20px;
        }
        .container:first-child{
        }
        .navItem{
            margin-left: 10px;
        }
        .table-wrapper-scroll-y {
            display: block;
            max-height: 200px;
            overflow-y: auto;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }
    </style>

    <title>Thieves Guild</title>
  </head>
  <body>
  <div class="container">
        <button class="btn btn-primary" id="retBut">Back to profile</button>
    </div>
    <div class="container" id="thieves">
        <h3>Thieves</h3>
        <ul class="nav nav-tabs">
            <li><button type="button" class="btn btn-secondary" id="thiefModalBut" data-toggle="modal" data-target="#modalID">Add thief</button></li>
        </ul>
        <div id="thieves-context">
            <input type="text" id="searchThieves" onkeyup="findThief()" placeholder="Search for nickname.." title="Type in nickname">
            <table class="table table-wrapper-scroll-y" id="thiefTable">
                <thead>
                    <tr>
                        <td scope="col">ID</td>
                        <td scope="col">Nickname</td>
                        <td scope="col">Last name</td>
                        <td scope="col">First name</td>
                        <td scope="col">Age</td>
                        <td scope="col">Status</td>
                        <td scope="col">Bounty</td>
                        <td scope="col">Submit</td>
                    </tr>
                </thead>
                <tbody class="thieves-body">
                </tbody>
            </table>
        </div>
    </div>
    <div class="container" id="robberies">
        <h3>Robberies</h3>
        <ul class="nav nav-tabs">
            <li><button type="button" id="AddCouponBut" class="btn btn-secondary" data-toggle="modal" data-target="#modalID">Add coupon</button></li>
            <li><button type="button" id="AddRobberyType" class="btn btn-secondary" data-toggle="modal" data-target="#modalID" style="margin-left: 20px;">Add robbery type</button></li>
        </ul>
        <div id="robbery-context">
                <input type="text" id="searchRobberies" onkeyup="findRobberyType()" placeholder="Search for robbery type.." title="Type in robbery type">
                <table class="table table-wrapper-scroll-y" id="robberyTable">
                    <thead>
                        <tr>
                            <td scope="col">Robbery type</td>
                            <td scope="col">Difficulty</td>
                            <td scope="col">Details</td>
                        </tr>
                    </thead>
                    <tbody class="robbery-body">
                    </tbody>
                </table>
        </div>
    </div>
    <div class="container" id="equipment">
        <h3>Equipment</h3>
        <ul class="nav nav-tabs">
            <li><button type="button" id="AddEquip" class="btn btn-secondary" data-toggle="modal" data-target="#modalID">Add equipment</button></li>
        </ul>
        <div id="equipment-context">
                <input type="text" id="searchEquip" onkeyup="findEquip()" placeholder="Search for equipment.." title="Type in equipment">
                <table class="table table-wrapper-scroll-y" id="equipTable">
                    <thead>
                        <tr>
                            <td scope="col">Serial Number</td>
                            <td scope="col">Type</td>
                            <td scope="col">Price</td>
                        </tr>
                    </thead>
                    <tbody class="equip-body">
                    </tbody>
                </table>
        </div>
    </div>
    <div class="container" id="weapon">
        <h3>Weapons</h3>
        <ul class="nav nav-tabs">
            <li><button type="button" id="AddWeapon" class="btn btn-secondary" data-toggle="modal" data-target="#modalID">Add weapon</button></li>
        </ul>
        <div id="equipment-context">
                <input type="text" id="searchWeapon" onkeyup="findWeapon()" placeholder="Search for equipment.." title="Type in equipment">
                <table class="table table-wrapper-scroll-y" id="weaponTable">
                    <thead>
                        <tr>
                            <td scope="col">Type</td>
                            <td scope="col">Damage</td>
                            <td scope="col">Worn</td>
                            <td scope="col">Required level</td>
                        </tr>
                    </thead>
                    <tbody class="weapon-body">
                    </tbody>
                </table>
        </div>
    </div>
    <div class="container" id="trap">
            <h3>Traps</h3>
            <ul class="nav nav-tabs">
                <li><button type="button" id="AddTrap" class="btn btn-secondary" data-toggle="modal" data-target="#modalID">Add trap</button></li>
            </ul>
            <div id="equipment-context">
                    <input type="text" id="searchTrap" onkeyup="findTrap()" placeholder="Search for equipment.." title="Type in equipment">
                    <table class="table table-wrapper-scroll-y" id="trapTable">
                        <thead>
                            <tr>
                                <td scope="col">Type</td>
                                <td scope="col">Range</td>
                                <td scope="col">Effect</td>
                                <td scope="col">Required level</td>
                            </tr>
                        </thead>
                        <tbody class="trap-body">
                        </tbody>
                    </table>
            </div>
        </div>
        <div class="container" id="gear">
                <h3>Gear</h3>
                <ul class="nav nav-tabs">
                    <li><button type="button" id="AddGear" class="btn btn-secondary" data-toggle="modal" data-target="#modalID">Add gear</button></li>
                </ul>
                <div id="equipment-context">
                        <input type="text" id="searchGear" onkeyup="findGear()" placeholder="Search for gear.." title="Type in gear">
                        <table class="table table-wrapper-scroll-y" id="gearTable">
                            <thead>
                                <tr>
                                    <td scope="col">Type</td>
                                    <td scope="col">Effect</td>
                                    <td scope="col">Placement</td>
                                    <td scope="col">Required level</td>
                                </tr>
                            </thead>
                            <tbody class="gear-body">
                            </tbody>
                        </table>
                </div>
            </div>
    <div class="container" id="districts">
        <h3>Districts</h3>
        <ul class="nav nav-tabs">
            <li><button type="button" id="AddDistrictBut" class="btn btn-secondary" data-toggle="modal" data-target="#modalID">Add district</button></li>
        </ul>
        <div id="district-context">
                <input type="text" id="searchDistrict" onkeyup="findDistrict()" placeholder="Search for equipment.." title="Type in equipment">
                <table class="table table-wrapper-scroll-y" id="districtTable">
                    <thead>
                        <tr>
                            <td scope="col">District</td>
                            <td scope="col">Capacity</td>
                            <td scope="col">Wealth</td>
                        </tr>
                    </thead>
                    <tbody class="district-body">
                    </tbody>
                </table>
        </div>
    </div>


<div class="modal fade" id="modalID" tabindex="-1" role="dialog" aria-labelledby="headerlabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="headerlabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" crossorigin="anonymous"></script>

    <script>
var thieves = null;
var districts = null;
var robberies = null;
var equipment = null;
var weapons = null;
var traps = null;
var gear = null;

    $(document).ready(function(){
        $.get("getBurglars.php", function(data){
            thieves = jQuery.parseJSON(data);
            $.get("getRobberyTypes.php", function(data){
                robberies = jQuery.parseJSON(data);
                $.get("getEquipment.php", function(data){
                    equipment = jQuery.parseJSON(data);
                    $.get("getWeapons.php", function(data){
                        weapons = jQuery.parseJSON(data);
                        $.get("getTraps.php", function(data){
                            traps = jQuery.parseJSON(data);
                            $.get("getGears.php", function(data){
                                gear = jQuery.parseJSON(data);
                                $.get("getRegions.php", function(data){
                                    districts = jQuery.parseJSON(data);
                                    $('.thieves-body').html(generateThievesItem(thieves));
                                    $('.robbery-body').html(generateRobberyItem(robberies));
                                    $('.equip-body').html(generateEquipItem(equipment));
                                    $('.weapon-body').html(generateWeaponItem(weapons));
                                    $('.trap-body').html(generateTrapItem(traps));
                                    $('.gear-body').html(generateGearItem(gear));
                                    $('.district-body').html(generateDistrictItem(districts));
                                })
                            })
                        })
                    })
                });
            });
        });
    });

function findThief() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchThieves");
  filter = input.value.toUpperCase();
  table = document.getElementById("thiefTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
/*W3 school*/
function findRobberyType() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchRobberies");
  filter = input.value.toUpperCase();
  table = document.getElementById("robberyTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function findEquip() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchEquip");
  filter = input.value.toUpperCase();
  table = document.getElementById("equipTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function findWeapon() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchWeapon");
  filter = input.value.toUpperCase();
  table = document.getElementById("weaponTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function findTrap() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchTrap");
  filter = input.value.toUpperCase();
  table = document.getElementById("trapTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function findGear() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchGear");
  filter = input.value.toUpperCase();
  table = document.getElementById("gearTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function findDistrict() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchDistrict");
  filter = input.value.toUpperCase();
  table = document.getElementById("districtTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

$(document).on('click', '.thievesItem', function(){
    var item = $(this).attr('id');
    console.log($('#in'+item).val());
});

$(document).on('click', '.robberyItem', function(){
    var item = $(this).attr('id');
    console.log($('#in'+item).val());
});

$('#thiefModalBut').on('click',function(){
    $('.modal-body').html('<form class="needs-validation thief-form-modal" novalidate><div class="form-group col"><label for="thiefID">Personal Identification Number</label><input style="border: 1px solid gold;" class="form-control" id="thiefID" placeholder="Enter ID" required></div><div class="form-group col"><label for="thiefPassword">Password</label><input style="border: 1px solid gold;" type="password" class="form-control" id="thiefPassword" placeholder="Password" required></div><div class="form-group col"><label for="thiefStatus">Status</label><select style="border: 1px solid gold;" id="thiefStatus" class="form-control" required><option value="Z" selected>Alive</option><option value="M">Dead</option></select></div><div><label for="bounty">Bounty</label><input style="border: 1px solid gold;" type="number" class="form-control" id="bounty" required></div><div><label for="nickname">Nickname</label><input style="border: 1px solid gold;" type="text" class="form-control" id="nickname" placeholder="Enter Nickname" required></div><div><label for="age">Age</label><input style="border: 1px solid gold;" type="number" class="form-control" id="age" min="1" required></div><div><label for="first-name">First name</label><input type="name" class="form-control" id="first-name" placeholder="Enter thief first name"></div><div><label for="last-name">Last name</label><input type="name" class="form-control" id="last-name" placeholder="Enter thiefs last name"></div><div class="form-check"><input class="form-check-input" type="checkbox" value="" id="adminFlag"><label style="border: 1px solid gold;" class="form-check-label" for="adminFlag">Admin</label></div></form><button class="btn btn-primary" id="thievesConfirm">Submit</button>'
    ,function(){
        $('#modalID').modal({show:true});
    });
});

$('#AddCouponBut').on('click',function(){
    $.get("getRobberyTypes.php", function(data){
            var ret_string = ""
            var rob = jQuery.parseJSON(data);

            for(i = 0; i < rob.length; i++){
                ret_string += '<option>'+rob[i].ID_loupez_typ+'</option>';
            }

            $('.modal-body').html('<form class="needs-validation" novalidate><div class="form-group"><label for="CouponID">Type of robbery</label><select style="border: 1px solid gold;" id="CouponID" class="form-control coupon-modal" required>'+ret_string+'</select></div></form><button class="btn btn-primary" id="CouponsConfirm">Submit</button>'
            ,function(){
                $('#modalID').modal({show:true});
            });
    });
});

$('#AddRobberyType').on('click',function(){
    $('.modal-body').html('<form class="needs-validation" novalidate><div class="form-group"><label for="robberyID">Type of robbery</label><input placeholder="Input type of robbery" type="text" value="" style="border: 1px solid gold;" class="form-control robbery-type-in" id="robberyID" required></div><div class="form-group"><label for="difficulityID">Difficulity</label><input style="border: 1px solid gold;" type="number" class="form-control" id="difficulityID" min="1" required></div><div class="form-group"><label for="detailsID">Details</label><input type="text" class="form-control" id="difficulityID"></div></form><button class="btn btn-primary" id="RobberiesConfirm">Submit</button>'
    ,function(){
        $('#modalID').modal({show:true});
    });
});

$('#AddEquip').on('click',function(){
    $.get("getGearTypes.php", function(data){
        var ret_string = "";
        var gears = jQuery.parseJSON(data);

        for(i = 0; i < gears.length; i++){
            ret_string += '<option>'+gears[i].ID_vybaveni_typ+'</option>';
        }

        $('.modal-body').html('<form class="needs-validation" novalidate><div class="form-group"><label for="equipID">Serial number</label><input style="border: 1px solid gold;" type="number" class="form-control" id="equipID" placeholder="Enter Serial Number" min="1" required></div><div class="form-group"><label for="EquipTypeID">Type of equipment</label><select style="border: 1px solid gold;" id="EquipTypeID" class="form-control" required>'+ret_string+'</select></div><div class="form-group"><label for="PriceID">Price</label><input style="border: 1px solid gold;" type="number" class="form-control" id="PriceID" min="1" required></div></form><button class="btn btn-primary" id="EquipConfirm">Submit</button>'
        ,function(){
        $('#modalID').modal({show:true});
    });
    })
});

$('#AddWeapon').on('click',function(){
    $('.modal-body').html('<form class="needs-validation" novalidate><div class="form-group"><label for="weaponID">Name of weapon</label><input style="border: 1px solid gold;" type="text" class="form-control" id="weaponID" placeholder="Enter name of weapon" required></div><div class="form-group"><label for="damageID">Damage</label><input style="border: 1px solid gold;" type="number" class="form-control" id="damageID" min="1" required></div><div class="form-group"><label for="wearID">Wear</label><input style="border: 1px solid gold;" type="text" class="form-control" id="wearID" required></div><div class="form-group"><label for="levelID">Required level</label><input style="border: 1px solid gold;" type="number" class="form-control" id="levelID" min="0" required></div></form><button class="btn btn-primary" id="WeaponsConfirm">Submit</button>'
        ,function(){
        $('#modalID').modal({show:true});
    });
});

$('#AddTrap').on('click',function(){
    $('.modal-body').html('<form class="needs-validation" novalidate><div class="form-group"><label for="trapID">Name of trap</label><input type="text" class="form-control" id="trapID" placeholder="Enter trap name" style="border: 1px solid gold;" required></div><div class="form-group"><label for="rangeID">Range</label><input type="number" class="form-control" id="rangeID" min="1" style="border: 1px solid gold;" required></div><div class="form-group"><label for="effectID">Effect</label><input type="text" class="form-control" id="effectID"></div><div class="form-group"><label for="levelID">Required level</label><input type="number" class="form-control" id="levelID" min="0" style="border: 1px solid gold;" required></div></form><button class="btn btn-primary" id="TrapConfirm">Submit</button>'
        ,function(){
        $('#modalID').modal({show:true});
    });
});

$('#AddGear').on('click',function(){
    $('.modal-body').html('<form class="needs-validation" novalidate><div class="form-group"><label for="gearID">Name of gear</label><input type="text" class="form-control" id="gearID" placeholder="Enter gear name" style="border: 1px solid gold;" required></div><div class="form-group"><label for="PlacementID">Placement</label><input type="texxt" class="form-control" id="PlacementID"></div><div class="form-group"><label for="EffectID">Effect</label><input type="text" class="form-control" id="EffectID"></div><div class="form-group"><label for="levelID">Required level</label><input type="number" class="form-control" id="levelID" min="0" style="border: 1px solid gold;" required></div></form><button class="btn btn-primary" id="GearConfirm">Submit</button>'
        ,function(){
        $('#modalID').modal({show:true});
    });
});

$('#AddDistrictBut').on('click',function(){
    $('.modal-body').html('<form class="needs-validation" novalidate><div class="form-group"><label for="districtID">District name</label><input type="text" class="form-control" id="districtID" placeholder="Enter district name" style="border: 1px solid gold;" required></div><div class="form-group"><label for="districtCap">Capacity</label><input type="number" class="form-control" id="districtCap" min="1" placeholder="Number" style="border: 1px solid gold;" required></div><div class="form-group"><label for="districtWealth">Wealth</label><input type="number" class="form-control" id="districtWealth" min="1" style="border: 1px solid gold;" required></div></form><button class="btn btn-primary" id="DistrictsConfirm">Submit</button>'
        ,function(){
        $('#modalID').modal({show:true});
    });
});

function generateThievesItem(thieves) {
    var ret_string = "";

    for(i = 0; i < thieves.length; i++){
        ret_string += '<tr><form class="thief-form"><td>' + thieves[i].ID_rodne_cislo + '</td><td>' + thieves[i].prezdivka + '</td><td>' + thieves[i].jmeno + '</td><td>' + thieves[i].prijmeni + '</td><td><input id="age' + thieves[i].ID_rodne_cislo + '" type="number" min="1" value="' + thieves[i].vek + '"></td><td><select id="status' + thieves[i].ID_rodne_cislo + '" size="1">' + statusSelect(thieves[i].stav) + '</select></td><td><input id="' + thieves[i].ID_rodne_cislo + '" class="bounty" type="number" min="0" value="' + thieves[i].vypsana_odmena + '"></td><td><button class="thievesItem" id="' + thieves[i].ID_rodne_cislo + '" >Submit</button></td></form></tr>'
    }

    return ret_string;
}

function generateRobberyItem(robberies) {
    var ret_string = "";

    for(i = 0; i < robberies.length; i++){
        ret_string += '<tr><td>' + robberies[i].ID_loupez_typ + '</td><td><input id="diff' + robberies[i].ID_loupez_typ + '" class="diff" type="text" value="' + robberies[i].mira_obtiznosti + '"></td><td><input id="' + robberies[i].ID_loupez_typ + '" class="details" type="text" value="' + robberies[i].detaily + '"></td><td><button class="robberyItem" id="' + robberies[i].ID_loupez_typ + '">Submit</button></td></tr>'
    }

    return ret_string;
}

function generateEquipItem(equipment) {
    var ret_string = "";

    if(equipment !== null){
        for(i = 0; i < equipment.length; i++){
            ret_string += '<tr><td>' + equipment[i].ID_vyrobni_cislo + '</td><td id="equipType' + equipment[i].ID_vyrobni_cislo + '">' + equipment[i].ID_vybaveni_typ + '</td><td><input id="' + equipment[i].ID_vyrobni_cislo + '" class="price" type="number" min="1" value="' + equipment[i].cena + '"></td><td><button class="equipmentItem" id="' + equipment[i].ID_vyrobni_cislo + '">Submit</button></td></tr>';
        }
    }

    return ret_string;
}

function generateWeaponItem(weapons){
    var ret_string = "";

    if(weapons !== null){
        for(i = 0; i < weapons.length; i++){
            ret_string += '<tr><td>' + weapons[i].ID_vybaveni_typ + '</td><td><input id="dmg' + weapons[i].ID_vybaveni_typ + '" class="dmg" type="number" min="1" value="' + weapons[i].poskozeni + '"></td><td><input id="wear' + weapons[i].ID_vybaveni_typ + '" class="wear" type="number" min="1" value="' + weapons[i].opotrebeni + '"></td><td><input id="level' + weapons[i].ID_vybaveni_typ + '" class="level" type="number" min="1" value="' + weapons[i].potrebna_uroven + '"></td><td><button class="weaponItem" id="' + weapons[i].ID_vybaveni_typ + '">Submit</button></td></tr>';
        }
    }

    return ret_string;
}

function generateTrapItem(traps){
    var ret_string = "";

    if(traps !== null){
        for(i = 0; i < traps.length; i++){
            ret_string += '<tr><td>' + traps[i].ID_vybaveni_typ + '</td><td><input id="range' + traps[i].ID_vybaveni_typ + '" class="range" type="number" min="1" value="' + traps[i].rozsah + '"></td><td><input id="effect' + traps[i].ID_vybaveni_typ + '" class="effect" type="text" value="' + traps[i].ucinek + '"></td><td><input id="level' + traps[i].ID_vybaveni_typ + '" class="level" type="number" min="1" value="' + traps[i].potrebna_uroven + '"></td><td><button class="trapItem" id="' + traps[i].ID_vybaveni_typ + '">Submit</button></td></tr>';
        }
    }

    return ret_string;
}

function generateGearItem(gear){
    var ret_string = "";

    if(gear !== null){
        for(i = 0; i < gear.length; i++){
            ret_string += '<tr><td>' + gear[i].ID_vybaveni_typ + '</td><td><input id="effect' + gear[i].ID_vybaveni_typ + '" class="effect" type="text" value="' + gear[i].efekt + '"></td><td><input id="placement' + gear[i].ID_vybaveni_typ + '" class="placement" type="text" value="' + gear[i].umisteni + '"></td><td><input id="level' + gear[i].ID_vybaveni_typ + '" class="level" type="number" min="1" value="' + gear[i].potrebna_uroven + '"></td><td><button class="gearItem" id="' + gear[i].ID_vybaveni_typ + '">Submit</button></td></tr>';
        }
    }

    return ret_string;
}

function generateDistrictItem(district){
    var ret_string = "";

    if(district !== null){
        for(i = 0; i < district.length; i++){
            ret_string += '<tr><td>' + district[i].ID_oblast + '</td><td><input id="capacity' + district[i].ID_oblast + '" class="capacity" type="number" min="1" value="' + district[i].kapacita + '"></td><td><input id="wealth' + district[i].ID_oblast + '" class="wealth" type="number" min="0" value="' + district[i].dostupne_bohatstvi + '"></td><td><button class="districtItem" id="' + district[i].ID_oblast + '">Submit</button></td></tr>';
        }
    }

    return ret_string;
}

function statusSelect(status) {
    if(status === "Z"){
        return '<option value="Z" selected>Alive</option><option value="M">Dead</option>';
    }
    else {
        return '<option value="Z">Alive</option><option value="M" selected>Dead</option>';
    }
}

$(document).on('click', '#thievesConfirm', function(){
    var check;
    if($('#adminFlag:checked').prop("checked")){
        check = 1;
    }
    else{
        check = 0;
    }
    
    $.post("addBurglar.php", { ID_rodne_cislo: $('#thiefID').val(), heslo: $('#thiefPassword').val(), vudce: check, jmeno: $('#first-name').val(), prijmeni: $('#last-name').val(), prezdivka: $('#nickname').val(), vek: $('#age').val(), stav: $('#thiefStatus').val(), vypsana_odmena: $('#bounty').val() }, function(data){
        if(data === "ok"){
            location.reload();
        }
        else{
            alert("Missing or invalid "+data);
        }
    })
});

$(document).on('click', '#DistrictsConfirm', function(){
    $.post("addDistrict.php", { ID_oblast: $('#districtID').val(), kapacita: $('#districtCap').val(), dostupne_bohatstvi: $('#districtWealth').val() }, function(data){
        if(data === "ok"){
            location.reload();
        }
        else{
            alert("Missing or invalid "+data);
        }
    })
});

$(document).on('click', '#CouponsConfirm', function(){
    $.post("addCoupon.php", { ID_loupez_typ: $('#CouponID').val() }, function(data){
        if(data === "ok"){
            location.reload();
        }
        else{
            alert("Missing or invalid "+data);
        }
    });
});

$(document).on('click', '#RobberiesConfirm', function(){
    $.post("addRobberyType.php", { ID_loupez_typ: $('#robberyID').val(), detaily: $('#detailsID').val(), mira_obtiznosti: $('#difficulityID').val() }, function(data){
        if(data === "ok"){
            location.reload();
        }
        else{
            alert("Missing or invalid "+data);
        }
    })
});

$(document).on('click', '#WeaponsConfirm', function(){ /*poskozeni*/
    $.post("addWeapon.php", { ID_vybaveni_typ: $('#weaponID').val(), poskozeni: $('#damageID').val(), opotrebeni: $('#wearID').val(), potrebna_uroven: $('#levelID').val() }, function(data){
        if(data === "ok"){
            location.reload();
        }
        else{
            alert("Missing or invalid "+data);
        }
    })
});

$(document).on('click', '#TrapConfirm', function(){
    $.post("addTrap.php", { ID_vybaveni_typ: $('#trapID').val(), ucinek: $('#effectID').val(), rozsah: $('#rangeID').val(), potrebna_uroven: $('#levelID').val() }, function(data){
        if(data === "ok"){
            location.reload();
        }
        else{
            alert("Missing or invalid "+data);
        }
    })
});

$(document).on('click', '#EquipConfirm', function(){
    $.post("addEquipment.php", { ID_vyrobni_cislo: $('#equipID').val(), ID_vybaveni_typ: $('#EquipTypeID').val(), cena: $('#PriceID').val() }, function(data){
        if(data === "ok"){
            location.reload();
        }
        else{
            alert("Missing or invalid "+data);
        }
    })
});

$(document).on('click', '#GearConfirm', function(){
    $.post("addGear.php", { ID_vybaveni_typ: $('#gearID').val(), efekt: $('#EffectID').val(), umisteni: $('#PlacementID').val(), potrebna_uroven: $('#levelID').val() }, function(data){
        if(data === "ok"){
            location.reload();
        }
        else{
            alert("Missing or invalid "+data);
        }
    })
});

$(document).on('click', '.thievesItem', function(){
    var id = $(this).attr('id');
    var age = $('#age'+id).val();
    var status = $('#status'+id).val();
    var bounty = $('#'+id).val();

    $.post("updateBurglar.php", { ID_rodne_cislo:  id, vek: age, stav: status, vypsana_odmena: bounty }, function(data){
        if(data === "ok"){
            location.reload();
        }
        else{
            alert("Missing or invalid "+data);
        }
    })
});

$(document).on('click', '.robberyItem', function(){
    var id = $(this).attr('id');
    var dif = $('#diff'+id).val();
    var details = $('#'+id).val();

    $.post("updateRobberyType.php", { ID_loupez_typ: id, detaily: details, mira_obtiznosti: dif }, function(data){
        if(data === "ok"){
            location.reload();
        }
        else{
            alert("Missing or invalid "+data);
        }
    })
})

$(document).on('click', '.equipmentItem', function(){
    var id = $(this).attr('id');
    var typ = $('#equipType'+id).val();
    var price = $('#'+id).val();

    $.post("updateEquipment.php", { ID_vyrobni_cislo: id, ID_vybaveni_typ: typ, cena: price }, function(data){
        if(data === "ok"){
            location.reload();
        }
        else{
            alert("Missing or invalid "+data);
        }
    })
})

$(document).on('click', '.weaponItem', function(){
    var id = $(this).attr('id');
    var dmg = $('#dmg'+id).val();
    var wear = $('#wear'+id).val();
    var level = $('#level'+id).val();

    $.post("updateWeapon.php", { ID_vybaveni_typ: id, poskozeni: dmg, opotrebeni: wear, potrebna_uroven: level }, function(data){
        if(data === "ok"){
            location.reload();
        }
        else{
            alert("Missing or invalid "+data);
        }
    })
})

$(document).on('click', '.trapItem', function(){
    var id = $(this).attr('id');
    var effect = $('#effect'+id).val();
    var range = $('#range'+id).val();
    var level = $('#level'+id).val();

    $.post("updateTrap.php", { ID_vybaveni_typ: id, ucinek: effect, rozsah: range, potrebna_uroven: level }, function(data){
        if(data === "ok"){
            location.reload();
        }
        else{
            alert("Missing or invalid "+data);
        }
    })
})

$(document).on('click', '.gearItem', function(){
    var id = $(this).attr('id');
    var effect = $('#effect'+id).val();
    var placement = $('#placement'+id).val();
    var level = $('#level'+id).val();

    $.post("updateGear.php", { ID_vybaveni_typ: id, efekt: effect, umisteni: placement, potrebna_uroven: level }, function(data){
        if(data === "ok"){
            location.reload();
        }
        else{
            alert("Missing or invalid "+data);
        }
    })
})

$(document).on('click', '.districtItem', function(){
    var id = $(this).attr('id');
    var capacity = $('#capacity'+id).val();
    var wealth = $('#wealth'+id).val();

    $.post("updateDistrict.php", { ID_oblast: id, kapacita: capacity, dostupne_bohatstvi: wealth }, function(data){
        if(data === "ok"){
            location.reload();
        }
        else{
            alert("Missing or invalid "+data);
        }
    })
})

$(document).on('click', '#retBut', function(){
    location.replace('http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/menuAdmin.php');
})

        </script>
  </body>
</html>