<? $this->renderComponent("menu"); ?>
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto ">
      <? if(isset($data_id)) { ?>
        <h3 class="display-4 text-center">Editar cliente</h3>

      <? }else{ ?>
      <h3 class="display-4 text-center">Adicionar cliente</h3>
      <? }?>
      <div class="container">
      <form class=" form-signin" action="/clientes/criar" method="post">
    <? $this->displayFlashMessage(); ?>        

    <div class="container" >
  
      <input name="id" style="display: none" value="<?= $data_id; ?>">

      <label for="name" class="sr">Nome</label>
      <!-- <?= $data_id ?> -->
      <input name='name' type="text" id="name" class="form-control" placeholder="Nome" required autofocus value="<?=$data_name ;?>">
      <label for="birthday" class="sr">Data de nascimento</label>
      <input name='birthday' type="date" id="birthday" class="form-control" placeholder="Data" required autofocus value="<?=($data_birthday)?>">
     
     
      <label for="rg" class="sr">RG</label>
      <input name='rg' type="text" id="rg" class="form-control" placeholder="RG" required autofocus value="<?= $data_rg ?>">
      <label for="cpf" class="sr">CPF</label>
      <input name='cpf' type="text" id="cpf" class="form-control" placeholder="CPF" required autofocus value="<?=$data_cpf ?>">
      <label for="phone_number" class="sr">Telefone</label>
      <input name='phone_number' type="text" id="phone_number" class="form-control" placeholder="Telefone" required autofocus value="<?=$data_phone_number ?>">
   
      <label for="address" class="sr">Enderecos ( separar com ; )</label>
      <input name='address' type="text" id="address" class="form-control" placeholder="" required autofocus  value="<?=$data_address ?>">
   
      <div class="checkbox mb-3">
        </div>
      <button class="btn btn-lg btn-primary btn-md" type="submit">Salvar</button>
    </div>

    </form>
    </div>

</div>

 <style>
   
.form-signin {
  width: 100%;
  max-width: 630px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input {
  margin-bottom: 10px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>