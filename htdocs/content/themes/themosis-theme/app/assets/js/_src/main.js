function navTriggerClick(){
    //var _this = $(myTarget);
    $("body").toggleClass("navOpen");
}

function sizeMasthead() {
    var _mastHeight = $("#masthead").outerHeight(true);
    var _content = $("#main-content");
    
    _content.css("margin-top",_mastHeight);
}

function handleScroll() {
    var _content = $("#masthead");
    var _speed = 0.5;
    var _newPos = -($(window).scrollTop()*_speed);
    
    _content.css("transform","translateY(" + _newPos + "px)");
    
    //console.log(_newPos);
}

function init(){
    $("#nav-trigger").click(function(e){
        e.preventDefault();
        navTriggerClick();
    });
    
    $(window).resize(function(){
        sizeMasthead();
    }).trigger("resize");
    
    $(window).scroll(function(){
        handleScroll();
    });
}

$("document").ready(function(){
    //doc ready
    init();
});