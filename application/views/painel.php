
  <main class="mdl-layout__content">
    <section class="mdl-layout__tab-panel is-active" id="perfil">
      <div class="page-content">
      <div  class="mdl-grid">
        <div class="mdl-cell mdl-cell--3-col">
            <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
            <thead>
                <tr>
                    <th></th>
                    <th class="mdl-data-table__cell-non-numeric">Lista de Ideias</th>
                </tr>
            </thead>
            <tbody>
          <?php
            $query = $this->db->query("SELECT id, nome FROM ideia WHERE usuario_id = $id");
            $ideias = $query->result();

            foreach ($ideias as $ideia) { ?>
            <tr>
              <td class="mdl-data-table__cell-non-numeric" ><i class="material-icons mdl-list__item-icon">folder</i></td>              
              <td class="mdl-data-table__cell-non-numeric" ><a href="<?= base_url('Ver-Ideia/' . $ideia->id) ?>"><?= $ideia->nome ?></a></td>
            </tr>
          <?php } ?>
          </tbody>
          </table>
        </div>
        <div>
          <img src="<?= base_url('imagens/padrao.png') ?>" width="100px">
        </div>
        <div class="mdl-cell mdl-cell--6-col">
        <form method="post" action="<?= base_url('Atualizar') ?>">
        <h3>Informações Pessoais</h3>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="login" name="nome" value='<?= $nome ?>' <?php if($this->uri->segment("2") != null && $this->uri->segment("2") != $this->session->userdata('id')) echo "disabled"; ?>>
            <label class="mdl-textfield__label" for="nome" >Nome</label>
          </div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="email" id="login" name="email" value='<?= $email ?>' <?php if($this->uri->segment("2") != null && $this->uri->segment("2") != $this->session->userdata('id')) echo "disabled"; ?>>
            <label class="mdl-textfield__label" for="email" >Email</label>
          </div>
          
          <?php if($id == $this->session->userdata('id') || $this->uri->segment("2") == $this->session->userdata('id')) { ?>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="login" name="login" value='<?= $login ?>' >
            <label class="mdl-textfield__label" for="login" >Login</label>
          </div>
          <?php } ?>

          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="login" name="facebook" value='<?= $facebook ?>' <?php if($this->uri->segment("2") != null && $this->uri->segment("2") != $this->session->userdata('id')) echo "disabled"; ?>>
            <label class="mdl-textfield__label" for="facebook" >Facebook</label>
          </div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="login" name="github" value='<?= $github ?>' <?php if($this->uri->segment("2") != null && $this->uri->segment("2") != $this->session->userdata('id')) echo "disabled"; ?>>
            <label class="mdl-textfield__label" for="github" >Github</label>
          </div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="login" name="tweeter" value='<?= $tweeter ?>' <?php if($this->uri->segment("2") != null && $this->uri->segment("2") != $this->session->userdata('id')) echo "disabled"; ?>>
            <label class="mdl-textfield__label" for="tweeter" >Tweeter</label>
          </div>

          <?php if($id == $this->session->userdata('id') || $this->uri->segment("2") == $this->session->userdata('id')) { ?>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="login" name="senha">
            <label class="mdl-textfield__label" for="senha" >Senha</label>
          </div>
          <button type="submit" class="mdl-button mdl-js-button mdl-button--raised">
              Atualizar dados
            </button>
          <?php } ?>
          </form>
        </div>
        <div class="mdl-cell mdl-cell--2-col">
          <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
            <thead>
                <tr>
                    <th class="mdl-data-table__cell-non-numeric">Lista de Projetos</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
          <?php
            $query = $this->db->query("SELECT id, nome FROM projeto WHERE usuario_id = $id");
            $projetos = $query->result();

            foreach ($projetos as $projeto) {
          ?>
            <tr>
              <td class="mdl-data-table__cell-non-numeric" ><a href="<?= base_url('Ver-Projeto/' . $projeto->id) ?>"><?= $projeto->nome ?></a></td>              
              <td class="mdl-data-table__cell-non-numeric" ><i class="material-icons mdl-list__item-icon">folder</i></td>
            </tr>
          <?php } ?>
          </tbody>
          </table>
        </div>
      </div>
      </div>
    </section>

    <section class="mdl-layout__tab-panel" id="ideias">
      <div class="page-content">
      <div class="mdl-grid">
        </div>
      </div>
    </section>

    <section class="mdl-layout__tab-panel" id="projetos">
      <div class="page-content">
      <div class="mdl-grid">

      </div>
      </div>
    </section>