import { showAlert } from "../utils";

$(document).ready(() => {
  $(".nav-pills button").each(function() {
    $(this).on("click", function() {
      $(".nav-pills button").removeClass("active");
      loadPage($(this).attr("page"));
    });
  }); 
});

/**
 * Função de logout que executa um fetch
 * em um arquivo PHP e reinicia a página
 */
window.Logout = async () => {
  const response = await fetch("./database/api/logout.php")
  .then((res) => res.json());
  
  if(!response.success) {
    showAlert("error", "Erro!", response.message);
    return;
  }
  reloadPage();
}
