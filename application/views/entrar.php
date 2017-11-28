<style type="text/css">
  
  .f {
        position:absolute;
        bottom:0;
        width:98%;
    }
</style>
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->
    <div class="mdl-grid">
    <div class=" mdl-cell--4-offset"></div>
    <div class="mdl-cell mdl-cell--4-col">
     <form method="post" name="entrar" action="<?= base_url('Logar') ?>" autocomplete="off">
      <h4>Entrar</h4>
      <p>Já poussui uma conta? Então faça login!</p>
      <div id="textDiv"></div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="login" name="login" autofocus>
            <label class="mdl-textfield__label" for="login">Login</label>
              <span class="mdl-textfield__error">O login deve ter no mínimo 8 caracteres</span>
          </div>
        
        
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="password" id="senha" name="senha" >
            <label class="mdl-textfield__label" for="senha">Senha</label>
              <span class="mdl-textfield__error">A senha de ter no mínimo 8 caracteres e ser formada por letras maiúsculas, minúsculas e números</span>
          </div>
          <div>
            <button type="submit" class="mdl-button mdl-js-button mdl-button--raised">
              Enviar
            </button>
          </div>
        </form>
    </div>
    </div>
<!-- inserir rodapé -->