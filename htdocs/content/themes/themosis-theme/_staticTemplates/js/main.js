function navTriggerClick() {
    $("body").toggleClass("navOpen")
}

function sizeMasthead() {
    var n = $("#masthead").outerHeight(!0),
        i = $("#main-content");
    i.css("margin-top", n)
}

function handleScroll() {
    var n = $("#masthead"),
        i = .5,
        t = -($(window).scrollTop() * i);
    n.css("transform", "translateY(" + t + "px)")
}

function init() {
    $("#nav-trigger").click(function(n) {
        n.preventDefault(), navTriggerClick()
    }), $(window).resize(function() {
        sizeMasthead()
    }).trigger("resize"), $(window).scroll(function() {
        handleScroll()
    })
}


(function ($) {
   $(document).ready(function() { 
       
  
   init();
   
   
  
}(jQuery));

