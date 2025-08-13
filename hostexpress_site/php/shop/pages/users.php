<div class="card shadow-sm my-3">
  <div class="card-header bg-primary d-flex justify-content-between text-white">
    <h5 class="card-title">Usuários</h5>
    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalAddUser">Adicionar usuário</button>
  </div>
  <div class="card-body">
    <form class="row g-3 mb-3">
      <div class="col-md-2">
        <label class="form-label">Nome</label>
        <input type="text" class="form-control" placeholder="Nome">
      </div>
      <div class="col-md-2">
        <label class="form-label">E-mail</label>
        <input type="email" class="form-control" placeholder="E-mail">
      </div>
      <div class="col-md-2">
        <label class="form-label">Telefone</label>
        <input type="text" class="form-control" placeholder="Telefone">
      </div>
      <div class="col-md-2">
        <label class="form-label">Cidade</label>
        <input type="text" class="form-control" placeholder="Cidade">
      </div>
      <div class="col-md-2 d-flex align-items-end">
        <button type="button" class="btn btn-primary me-2">Filtrar</button>
        <a href="#" class="text-decoration-none">Pesquisa avançada</a>
      </div>
    </form>
    <table class="table table-striped table-hover">
      <thead class="table-light">
        <tr>
          <th>Nome</th>
          <th>E-mail</th>
          <th>Telefone</th>
          <th>Cidade</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan="6" class="text-center text-muted">Nenhuma informação</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

<div class="modal fade" id="modalAddUser" tabindex="-1" aria-labelledby="modalAddUserLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalAddUserLabel">Adicionar usuário</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <form class="p-3 border rounded">
            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">E-mail</label>
                <input type="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Telefone</label>
                <input type="text" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Cidade</label>
                <input type="text" class="form-control" required>

            </div>
            <button type="button" class="btn btn-primary">Cadastrar Usuário</button>
        </form>
      </div>
    </div>
  </div>
</div>
