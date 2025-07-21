$(document).ready(() => {
    $(".nav-pills button").each(function() {
        $(this).on("click", function() {
            if(!$(this).hasClass("active")) {
                $(".nav-pills button").removeClass("active");
                $(".nav-pills button").removeAttr("aria-current");
                $(this).addClass("active");
                $(this).attr("aria-current", "page");
                LoadPage($(this).attr("page"));
            }
        });
    });
    
});