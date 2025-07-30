<div class="card shadow-sm my-3">
    <div class="card-header bg-primary d-flex justify-content-between text-white">
        <h5 class="card-title">Produtos</h5>
        <button class="btn btn-secondary align-self-end" data-bs-toggle="modal" data-bs-target="#modalAddProduct">Adicionar produto</button>
    </div>
    <div class="overlay d-none opacity-0 justify-content-center align-items-center">
      <div class="spinner-border spinner-border-lg" role="status"></div>
    </div>
    <div class="card-body">
        <div class="row" id="product-card">
            <!-- Product items will be dynamically loaded here -->
            <table class="display" id="products">
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Categoria</th>
                        <th>Unidade</th>
                        <th>Preço</th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<!--Modal Add Product -->
<div class="modal fade" id="modalAddProduct" tabindex="-1" aria-labelledby="modalAddProductLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalAddProductLabel">Adicionar produto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="p-4 border rounded shadow-sm">
            <div class="mb-3">
                <label for="descr" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="descr" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Categoria</label>
                <select class="form-select" id="category" required>
                <option value="alimentos">Alimentos</option>
                <option value="bebidas">Bebidas</option>
                <option value="higiene">Higiene</option>
                <option value="outros">Outros</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Preço Unitário (R$)</label>
                <input type="number" step="0.01" class="form-control" id="price" name="preco" required>
            </div>

            <div class="mb-3">
                <label for="unity" class="form-label">Unidade de Medida</label>
                <input type="text" class="form-control" id="unity" name="unidade" placeholder="Ex: kg, L, un" required>
            </div>

            <div class="mb-3">
                <label for="qtd" class="form-label">Quantidade por Unidade</label>
                <input type="number" step="0.01" class="form-control" id="qtd" name="quantidadeMedida" required>
            </div>

            <div class="mb-3">
                <label for="photo" class="form-label">Foto do Produto</label>
                <input type="file" class="form-control" id="photo" name="foto" accept="image/*" required>
            </div>

            <button type="button" onclick="addProduct()" class="btn btn-primary">Cadastrar Produto</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Product -->
<div class="modal fade" id="modalEditProduct" tabindex="-1" aria-labelledby="modalEditProduct" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <input type="hidden" id="productId" />
      <div class="modal-header">
        <h5 class="modal-title"></h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
              <div class="modal-body">
        <form class="p-4 border rounded shadow-sm">
            <div class="mb-3">
                <label for="editDescr" class="form-label">Descrição</label>
                <input type="text" class="form-control" id="editDescr" required>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Categoria</label>
                <select class="form-select" id="editCategory" required>
                <option value="alimentos">Alimentos</option>
                <option value="bebidas">Bebidas</option>
                <option value="higiene">Higiene</option>
                <option value="outros">Outros</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="editPrice" class="form-label">Preço Unitário (R$)</label>
                <input type="number" step="0.01" class="form-control" id="editPrice" name="preco" required>
            </div>

            <div class="mb-3">
                <label for="editUnity" class="form-label">Unidade de Medida</label>
                <input type="text" class="form-control" id="editUnity" name="unidade" placeholder="Ex: kg, L, un" required>
            </div>

            <div class="mb-3">
                <label for="editQtd" class="form-label">Quantidade por Unidade</label>
                <input type="number" step="0.01" class="form-control" id="editQtd" name="quantidadeMedida" required>
            </div>

            <div class="mb-3">
                <label for="editPhoto" class="form-label">Foto do Produto</label>
                <input type="file" class="form-control" id="editPhoto" name="foto" accept="image/*" required>
            </div>

            <button type="button" onclick="editProduct()" class="btn btn-primary">Editar Produto</button>
        </form>
      </div>
      </div>
    </div>
  </div>
</div>

<script type="module" src="./js/shop/pages/products.js?a=<?php echo microtime(true); ?>"></script>

