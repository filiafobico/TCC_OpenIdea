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
    <div class=" mdl-cell--3-offset"></div>
    <div class="mdl-cell mdl-cell--8-col">
     <form method="post" name="entrar" action="<?= base_url('Inserir')?>">
      <h4>Cadastre-se</h4>
      <p>Ainda não faz parte da comunidade? Então cadastre-se já!</p>
        
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="nome" name="nome" pattern="[A-Za-zÀ-ú0-9., -]{5,}" autofocus>
            <label class="mdl-textfield__label" for="nome">Nome</label>
            <span class="mdl-textfield__error">O nome deve ter no mínimo 10 caracteres</span>
          </div>

          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="email" id="email" name="email">
            <label class="mdl-textfield__label" for="email">Email</label>
          </div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="login" name="login" pattern="^[A-Za-z0-9_\.]{8,}$">
            <label class="mdl-textfield__label" for="login">Login</label>
            <span class="mdl-textfield__error">O login deve ter no mínimo 8 caracteres</span>
          </div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="password" id="senha" name="senha" pattern="^(?=^.{8,}$)(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.*\s).*$">
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
    </div>
