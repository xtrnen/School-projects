var userData 		= null;
var userTerritories = null;
var userGear 		= null;
var freeGear 		= null;
var userTrainGear 	= null;
var userTrainRob 	= null;
var freeTrainGear 	= null;
var freeTrainRob 	= null;
var coupons			= null;

var isHome 		= true;
var isDistrict 	= false;
var isEquipment = false;
var isTraining 	= false;
var isBurglary 	= false;
var isHistory	= false;
var isStatistics= false;

$(document).ready(function(){
	$.get("php/getBurglar.php", function(data){
		userData = jQuery.parseJSON(data);
		$.get("php/ownedTrainGear.php", function(data){
			userTrainGear = jQuery.parseJSON(data);
			$.get("php/ownedTrainRob.php", function(data){
				userTrainRob = jQuery.parseJSON(data);
				$.get("php/statCoupon.php", function(data){
					coupons = jQuery.parseJSON(data);
					showProfile();	
				});
			});
		});
    });
});
/*Generates home profile*/
function showProfile(){
	showUser();
	if(location.href === "http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/menu.php#territories"){
		if(!isDistrict){
			setActivePage('territory-a');
			showTerritories();
			isDistrict = true;
		}
		else{
			showTerritories();
		}
	}
	else if(location.href === "http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/menu.php#equipment"){
		if(userStatus === true){
			if(!isEquipment){
				setActivePage('equip-a');
				generateEquip();
				isEquipment = true;
			}
		}
	}
	else if(location.href === "http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/menu.php#training"){
		if(userStatus === true){
			if(!isTraining){
				setActivePage('training-a');
				showTraining();
				isTraining = true;
			}
		}
	}
	else if(location.href === "http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/menu.php#burglary"){
		if(userStatus === true){
			if(!isBurglary){
				setActivePage('burglary-a');
				prepareRobbery();
				isBurglary = true;
			}
		}
	}
	else if(location.href === "http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/menu.php#history"){
		if(userStatus === true){
			if(!isHistory){
				setActivePage('history-a');
				showHistory();
				isHistory = true;
			}
		}
	}
	else if(location.href === "http://www.stud.fit.vutbr.cz/~xtrubk00/IIS/menu.php#stats"){
		if(userStatus === true){
			if(!isStatistics){
				setActivePage('stats-a');
				showStats();
				isStatistics = true;
			}
		}
	}
	else{
		showContent();
	}
}
/*Generates content of home page*/
function showContent(){
	if(userStatus){
		$(".col-md-9").html("<h1 style='margin-left: 300px; color: green;'>Welcome to Thieves Guild!</h1><p style='margin-left: 350px'><i>Stealing money for our glorious leader since 2018</i></p><p style='font-size: 20px; margin-left: 250px'>Today have been created " + coupons.pocet + " robbery coupons by our glorious leader.</p>");
	}
	else{
		$(".col-md-9").html("<h1 style='margin-left: 300px; color: red;'>You are dead!</h1>");
	}
}
/*Generates content of user profile*/
function showUser(){
	$(".profile-user-nickname").html(userData.prezdivka);
	$(".profile-user-name").html("<p>"+userData.jmeno+" "+userData.prijmeni+"</p>");
	$(".profile-user-age-status").html(userData.vek+checkStatus(userData.stav));
	$(".profile-user-status").html(userData.stav);
	if(userStatus){
		$(".profile-user-bounty").html("<p style='color: #938200;'>Bounty: "+userData.vypsana_odmena+" gold</p>");
	}
	else{
		$(".profile-user-bounty").html("<p style='color: #938200;'>" + 0 + " gold</p>");
	}
}
/*Show territories*/
function showTerritories(){
	showDistricCards();
}
/*Controls content of user status*/
function checkStatus(status){
	if(status === 'Z'){
		userStatus = true;
		return "<p style='color: green;'>Alive</p>";
	}
	userStatus = false;
	return "<p style='color: red;'>Dead</p>";
}

/*Remove current active page and set new active page*/
function setActivePage(newActive){
	if(isHome){
		$('.home-a').removeClass('active');
		isHome = false;
	}
	else if(isEquipment){
		$('.equip-a').removeClass('active');
		isEquipment = false;
	}
	else if(isDistrict){
		$('.territory-a').removeClass('active');
		isDistrict = false;
	}
	else if(isTraining){
		$('.training-a').removeClass('active');
		isTraining = false;
	}
	else if(isBurglary){
		$('.burglary-a').removeClass('active');
		isBurglary = false;
	}
	else if(isHistory){
		$('.history-a').removeClass('active');
		isHistory = false;
	}
	else if(isStatistics){
		$('.stats-a').removeClass('active');
		isStatistics = false;
	}
	$('.' + newActive).addClass('active');
}

/*Return to home page*/
$(document).ready(function(){
    $('a[href="#home"]').click(function(){
		if(userStatus === true){
			if(!isHome){
				setActivePage('home-a');
				showContent();
				isHome = true;
			}
		}
    }); 
 });

$(document).ready(function(){
    $('a[href="#territories"]').click(function(){
		if(userStatus === true){
			if(!isDistrict){
				setActivePage('territory-a');
				showTerritories();
				isDistrict = true;
			}
			else{
				location.reload();
			}
		}
	}); 
 });

 $(document).ready(function(){
    $('a[href="#equipment"]').click(function(){
		if(userStatus === true){
			if(!isEquipment){
				setActivePage('equip-a');
				generateEquip();
				isEquipment = true;
			}
			else{
				location.reload();
			}
		}
    }); 
 });

 $(document).ready(function(){
    $('a[href="#training"]').click(function(){
       if(userStatus === true){
		   if(!isTraining){
			   setActivePage('training-a');
			   showTraining();
			   isTraining = true;
		   }
		   else{
			location.reload();
		}
	   }
    }); 
 });

 $(document).ready(function(){
    $('a[href="#burglary"]').click(function(){
       if(userStatus === true){
			if(!isBurglary){
				setActivePage('burglary-a');
				prepareRobbery();
				isBurglary = true;
			}
			else{
				location.reload();
			}
	   }
    }); 
 });

 $(document).ready(function(){
    $('a[href="#history"]').click(function(){
       if(userStatus === true){
		   if(!isHistory){
				setActivePage('history-a');
				showHistory();
				isHistory = true;
		   }
		   else{
			   location.reload();
		   }
	   }
    });
 });

 $(document).ready(function(){
    $('a[href="#stats"]').click(function(){
       if(userStatus === true){
		   if(!isStatistics){
				setActivePage('stats-a');
				showStats();
				isStatistics = true;
		   }
		   else{
			   location.reload();
		   }
	   }
    });
 });

 $(document).ready(function(){
    $('a[href="#logout"]').click(function(){
       logOut();
    }); 
 });

function logOut(){
    $.post("php/logout.php");
	location.reload();
}
