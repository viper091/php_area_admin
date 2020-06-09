

    <form class="text-center form-signin" action="/login" method="post">
    <? $this->displayFlashMessage(); ?>        

    <div class="container" >
    <h1 class="h3 mb-3 font-weight-normal">Area Administrativa</h1>
      <label for="username" class="sr-only">username</label>
      <input name='username' type="text" id="username" class="form-control" placeholder="Login" required autofocus>
      <label for="password" class="sr-only">Senha</label>
      <input name='password' type="password" id="password" class="form-control" placeholder="Senha" required>
      <div class="checkbox mb-3">
        </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Acessar</button>
    </div>

    </form>

    <style>
    html,
body {
  height: 100%;
}

body {
  display: -ms-flexbox;
  display: -webkit-box;
  display: flex;
  -ms-flex-align: center;
  -ms-flex-pack: center;
  -webkit-box-align: center;
  align-items: center;
  -webkit-box-pack: center;
  justify-content: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
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
.form-signin input[type="username"] {
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