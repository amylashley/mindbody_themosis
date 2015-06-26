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

function formLabel() {
    $("form.label-placeholders").each(function(){
    
        $(this).find("input[type='text'], input[type='email']").focus(function(){
            $(this).closest( "fieldset" ).find("label").fadeOut("fast");
        });
        
        $(this).find("input[type='text'], input[type='email']").blur(function(){
            var _label = $(this).closest( "fieldset" ).find("label").text();
            
            if($(this).val() === "" || $(this).val() === _label) {
                $(this).closest( "fieldset" ).find("label").fadeIn("fast");
            }
        });
    
    });
    
    $("#input-areaCode").keyup(function(){
        if($(this).val().length >= 3){
            $("#input-phone1").focus();    
        }
    });
    
    $("#input-phone1").keyup(function(){
        if($(this).val().length >= 3){
            $("#input-phone2").focus();    
        }
    });
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
    
    $(".chosen-select").chosen({width: "100%",disable_search_threshold: 20});
    formLabel();
}

$("document").ready(function(){
    //doc ready
    init();
});