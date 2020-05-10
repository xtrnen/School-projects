/*****HANDLERY*****/
/*Menu tvoreni zakladnich prvku*/
/*Rectangle*/
$(document).on('click', '#rect-menu', function(){
    currentMode = MODE.ADD
    tmpElem = createRect()
})
/*Circle*/
$(document).on('click', '#circle-menu', function(){
    currentMode = MODE.ADD
    tmpElem = createCircle()
})
/*Menu tvoreni flow prvku*/
/*Event*/
$(document).on('click', '#event-menu', function(){
    currentMode = MODE.ADD
    tmpElem = createEvent()
})
/*Activity*/
$(document).on('click', '#activity-menu', function(){
    currentMode = MODE.ADD
    tmpElem = createActivity()
})
/*Gateway*/
$(document).on('click', '#gateway-menu', function(){
    currentMode = MODE.ADD
    tmpElem = createGateway()
})
/*Menu tvoreni swim prvku*/
/*Pool*/
$(document).on('click', '#pool-menu', function(){
    currentMode = MODE.ADD
    tmpElem = createPool()
})
/*Menu tvoreni artefact prvku*/
/*Data*/
$(document).on('click', '#data-menu', function(){
    currentMode = MODE.ADD
    tmpElem = createData()
})
/*Group*/
$(document).on('click', '#group-menu', function(){
    currentMode = MODE.ADD
    tmpElem = createGroup()
})
/*Context menu*/
/*vytvoreni sekvencniho spojeni*/
$(document).on('click', '#cont-menu-seq', function(){
    currentMode = MODE.CONNECTION
    connectType = 'seq'
    createTmpConnection('seq')
    contextMenu.hide()
})
/*vytvoreni informacniho spojeni*/
$(document).on('click', '#cont-menu-msg', function(){
    currentMode = MODE.CONNECTION
    connectType = 'msg'
    createTmpConnection('msg')
    contextMenu.hide()
})
/*Vytvoreni associacniho spojeni*/
$(document).on('click', '#cont-menu-asoc', function(){
    currentMode = MODE.CONNECTION
    connectType = 'asoc'
    createTmpConnection('asoc')
    contextMenu.hide()
})
/*Zruseni prvku*/
$(document).on('click', '#cont-menu-remove', function(){
    var tmp
    if(currentElem !== undefined){
       // currentElem.remove()
        removeAllConnects(currentElem)
        currentElem.remove()
    }
    contextMenu.hide()
})