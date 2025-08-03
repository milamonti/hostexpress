export default class Validator {
  static validarCPF(cpf) {
    // Usa a função do CDN
    return window.cpfIsValid(cpf);
  }

  static validarCNPJ(cnpj) {
    // Usa a função do CDN
    return window.cnpjIsValid(cnpj);
  }

  static validarEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
  }

  static validarTelefone(telefone) {
    const re = /^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$/;
    return re.test(telefone);
  }

  static createErrorMsg(field, fieldType) {
    const error = $("<div>").addClass("error-msg").insertAfter(field);
    error.text(`${fieldType} inválido!`);
    $(field).css("border-color", "red");
  }
  
  static clearError(field) {
    const error = $(field).next(".error-msg");
    error.text("");
    $(field).css("border-color", "");
  }
}
