$(document).ready(() => {
  $(".nav-pills button").each(function() {
    $(this).on("click", function() {
      $(".nav-pills button").removeClass("active");
      $(this).addClass("active");
      loadPage($(this).attr("page"));
    });
  }); 
});

window.Logout = async () => {
  await fetch(`./database/api/logout.php`).finally(reloadPage);
}