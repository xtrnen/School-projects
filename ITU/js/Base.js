var draw = SVG('draw').size('100%', '100%') //generovani zakladni plochy

/**/
const MODE = {
    STANDARD: 'standard',
    ADD: 'add',
    CONNECTION: 'connection',
}

var currentElem = undefined   //aktivni element
var currentConnect = undefined //aktivni propoj
var contextMenu = $('#context-menu')    //odkaz na html kontext menu
var currentMode = MODE.STANDARD //aktualni mod editoru
var newElem = undefined //novy element pro pridani
var tmpElem = undefined //docasny element pro vizualizaci
var tmpConnect = undefined //docasny connect pro vizualizaci
var connectType = 'seq'
var isContext = false
var connects = []

var drawContainer = draw.group()
var drawMarkers = draw.group()

draw.on('click', drawListenClick)
draw.on('mousemove', drawListenMouseMove)

$(document).on('keydown', deleteConnect)

/*Otevre menu pro elementy*/
$(document).on('contextmenu', function(e){
    e.preventDefault()
    
    if(currentElem !== undefined){
        var point = currentElem.point(e.pageX, e.pageY) //pozice mysi

        if(currentElem.inside(point.x, point.y)){   //otevreni menu
            contextMenu.css({
                display: 'block',
                left: e.pageX,
                top: e.pageY,
            });
        
            isContext = true

            return false   
        }
    }
})

/*Vyber elementu z group*/
function getGroupElem(myGroup) {
    var group = myGroup.children()

    for(i = 0; i < group.length; i++){
        if(group[i].type !== 'line' || group[i].type !== 'text'){
            return group[i]
        }
    }
}

/*Naslouchani plochy*/
function drawListenClick(e) {
    switch(currentMode){
        case 'standard':
            standardDrawClick(e)
            break
        case 'add':
            placeElem(e)
            break
        default:
            break
    }
}

/*Naslouchani plochy na pohyb*/
function drawListenMouseMove(e) {
    switch(currentMode){
        case 'add':
        case 'connection':
            elementMouseFollow(e)
            break
        default:
            break
    }
} 

/*Element sleduje mys*/
function elementMouseFollow(e){
    var point = draw.point(e.pageX, e.pageY)

    if(tmpElem !== undefined){
        tmpElem.center(point.x, point.y)
        if(tmpConnect !== undefined)
            tmpConnect.update()
    }
}

/*Usazeni elementu na plose*/
function placeElem(e) {
    var point = draw.point(e.pageX, e.pageY)

    tmpElem.center(point.x, point.y)

    tmpElem = undefined

    currentMode = MODE.STANDARD
}

/*Kliknuti standardniho modu*/
function standardDrawClick(e) {
    if(currentElem !== undefined){
        var elem = getGroupElem(currentElem)
        var point = elem.point(e.pageX, e.pageY)

        if(!elem.inside(point.x, point.y)){
            deactivateElem(currentElem)
            currentElem = undefined

            if(isContext){
                contextMenu.hide()
            }

        }
    }
}

/*Hledani konkretniho connectoru*/
function getConnect(connect){
    var id = connect.node.id

    for(i = 0; i < connects.length; i++){
        if(connects[i].connector.node.id = id){
            return connects[i]
        }
    }
}

/*Zruseni propoje*/
function deleteConnect(e){
    var key = event.keyCode
    
        if(key === 46){
            if(currentElem !== undefined){
                currentElem.remove()
                removeAllConnects(currentElem)
            }
            else{
                if(currentConnect !== undefined){
                    currentConnect.marker.remove()
                    currentConnect.connector.remove()
                    currentConnect = undefined
                }
            }
        }
}

/*vyhleda vsechny spoje s konkretnim objektem*/
function findConnectKey(value){
    var tmp = []
    
    for(var key in connects){
        if(connects[key].source === value){
            tmp.push(connects[key])
        }
    }
    
    return tmp
}

/*Zruseni vsech spojeni s rusenym objektem*/
function removeAllConnects(element){
    var key = findConnectKey(element)
        if(key.length > 0){
            while(key.length !== 0){
                tmp = key.pop()
                tmp.marker.remove()
                tmp.connector.remove()
                if(element === tmp){
                    element = undefined
                }
            }
        }
}