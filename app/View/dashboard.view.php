    <? $this->renderComponent("menu"); ?>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
      <h1 class="display-4">Clientes</h1>

      <div class="container">
      <div class="card-deck mb-3 text-center">
      <table class="table">
  <thead>
    <tr>

      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Data de nascimento</th>
      <th scope="col">cpf</th>
      <th scope="col">RG</th>
      <th scope="col">Telefone</th>
      <th scope="col"></th>
      <th scope="col"></th>

    </tr>
  </thead>
  <tbody>
    <? $this->renderClients(); ?>
</tbody>
</table>

    </div>
  <a href="/clientes/criar" class="btn btn-success btn-md" role="button" aria-disabled="true">Adicionar</a> 
    </div>
</div>