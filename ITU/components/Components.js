/*****Obdelnik*****/
function createRect() {
    var group = groupInit()
    group.rect(80,80).attr({fill : 'white', stroke : 'black'})

    return group
}

/*****Kruznice*****/
function createCircle() {
    var group = groupInit()
    group.circle(80).attr({fill : 'white', stroke: 'black'})

    return group
}

/*****Event*****/
function createEvent() {
    var group = groupInit()
    var circle = group.circle(80).attr({fill : '#cccccc', stroke: 'black'})
    var text = group.text('Event')
    moveText(circle, text)

    return group
}

/*****Aktivita*****/
function createActivity() {
    var group = groupInit()
    var rect = group.rect(80,80).radius(10).attr({fill: '#e6ffb3', stroke: 'black'})
    var text = group.text('Task')
    moveText(rect, text)

    return group
}

/*****Brana*****/
function createGateway() {
    var group = groupInit()
   // var rect = group.path("M80 76 L120 118 L80 160 L40 118 L80 76 Z").attr({fill: '#ffffe6', stroke: 'black'})
    var rect = group.rect(60,60).attr({fill: '#ffffe6', stroke: 'black'}).rotate(45)
    var text = group.text('Gate')
    moveText(rect, text)

    return group
}

/*****Bazen*****/
function createPool() {
    var group = groupInit()
    var rect = group.rect(100,100).attr({fill: '#cceeff', stroke: 'black'}).radius(10)
    var text = group.text('Pool')
    
    moveText(rect, text)

    return group
}

/*****Data*****/
function createData() {
    var group = groupInit()
    var img = group.image('./components/file.svg',60,80)
    var text = group.text('Data')
    moveText(img, text)

    return group
}

/*****Skupina*****/
function createGroup() {
    var group = groupInit()
    var rect = group.rect(100,100).attr({fill: 'white', stroke: 'black', 'stroke-dasharray': '20,10,5,5,5,10'}).radius(10)
    var text = group.text('Group')
    moveText(rect, text)

    return group
}

/*****Editace textu*****/
function doubleClick() {
    var elem = getText(this)
    if(elem === null){
        return
    }
    var context = elem.node.textContent

    var text = prompt('Edit text:', context)

    if(text == null || text == ''){
        text = context
    }

    var x = elem.cx()
    var y = elem.cy()

    elem.text(text)
    elem.center(x,y)
}

/*****Vraceni textu z groupy*****/
function getText(element) {
    var elem = element.children()
    for(i = 0; i < elem.length; i++){
        if(elem[i].type === 'text'){
            return elem[i]
        }
    }
    return null
}

/*****Docasne propojeni*****/
function createTmpConnection(str) {
    tmpElem = draw.group()

    tmpConnect = currentElem.connectable({
        container: drawContainer,
        markers: drawMarkers,
        marker: 'default',
        targetAttach: 'perifery',
        sourceAttach: 'perifery',
        color: 'black'
    }, tmpElem)

    switch(str){
        case 'seq':
            tmpConnect.marker.attr({
                markerWidth: '4',
                markerHeight: '4',
                refX: '25',
            })
            tmpConnect.connector.attr({'stroke-width': 4})
            break
        case 'msg':
            tmpConnect.marker.attr({
                markerWidth: '4',
                markerHeight: '4',
                refX: '25',
            })
            tmpConnect.connector.attr({'stroke-width': 4, 'stroke-dasharray': '10,10'})
            break
        case 'asoc':
            tmpConnect.marker.attr({
                markerWidth: '0',
                markerHeight: '0',
                refX: '0',
            })
            tmpConnect.connector.attr({'stroke-width': 4, 'stroke-dasharray': '10,10'})
            break
    }
}

/*****Konecne propojeni*****/
function createConnection(element, str){
    if(element !== currentElem){
        var connect = currentElem.connectable({
            container: drawContainer,
            markers: drawMarkers,
            marker: 'default',
            targetAttach: 'perifery',
            sourceAttach: 'center',
            color: 'black'
        }, element)

        switch(str){
            case 'seq':
                connect.marker.attr({
                    markerWidth: '4',
                    markerHeight: '4',
                    refX: '25',
                })
                connect.connector.attr({'stroke-width': 4})
                break
            case 'msg':
                connect.marker.attr({
                    markerWidth: '4',
                    markerHeight: '4',
                    refX: '25',
                })
                connect.connector.attr({'stroke-width': 4, 'stroke-dasharray': '10,10'})
                break
            case 'asoc':
                connect.marker.attr({
                    markerWidth: '0',
                    markerHeight: '0',
                    refX: '0',
                })
                connect.connector.attr({'stroke-width': 4, 'stroke-dasharray': '10,10'})
                break
        }
        
        connect.connector.on('click', function(){
            if(currentConnect !== undefined){
                currentConnect.setConnectorColor('black')
            }
            currentConnect = connect  
            connect.setConnectorColor('red')
        })

        connects.push(connect)
    }

    tmpElem.remove()
    tmpConnect.marker.remove()
    tmpConnect.connector.remove()
    currentMode = MODE.STANDARD
}

/*****GroupInit*****/
function groupInit() {
    var group = draw.group()

    group.draggy()

    group.on('mouseover', highlightElem)
    group.on('mouseout', removeHighlightElem)
    group.on('click', activateElem)
    group.on('dblclick', doubleClick)

    return group
}

/*****zvyrazneni elementu*****/
function highlightElem(e) {
    switch(currentMode){
        case 'connection':
        case 'standard':
            if(this !== currentElem){
                var elem = getGroupElem(this)
                elem.stroke('#00ff00')
            }
            break
        default:
            break
    }
}

/*****zruseni zvyrazneni*****/
function removeHighlightElem(e) {
    switch(currentMode){
        case 'connection':
        case 'standard':
            if(this !== currentElem){
                var elem = getGroupElem(this)
                elem.stroke('black')
            }
            break
        default:
            break
    }
}

/*****aktivace elementu*****/
function activateElem() {
    var elem
    switch(currentMode){
        case 'standard':
            if(currentElem !== undefined){
                var oldElemG = currentElem

                currentElem = this
                elem = getGroupElem(currentElem)

                deactivateElem(oldElemG)
                elem.stroke('blue')
                elem.selectize().resize()

                currentElem.front()
            }
            else{
                currentElem = this
                elem = getGroupElem(currentElem)

                elem.stroke('blue')
                elem.selectize().resize()

                currentElem.front()
            }
            if(currentConnect !== undefined){
                currentConnect.setConnectorColor('black')
            }
            break
        case 'connection':
            createConnection(this, connectType)
            break
    }
}

/*****deaktivace elementu*****/
function deactivateElem(element) {
    var elem = getGroupElem(element)

    elem.selectize(false).resize('stop')
    elem.stroke('black')
    moveText(elem, getText(element))
}

/*****resize textu*****/
function moveText(elem, text){
    if(text === undefined || text === null){
        return
    }

    var x = elem.cx()
    var y = elem.cy()

    var offsetY =  (y / 100) * 70 * 2.2
    
    text.center(x, y + offsetY)
}