<main class="mdl-layout__content">
        <div class="page-content">
        <form method="post" action="<?= base_url('Inserir-Ideia-Banco') ?>">
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--4-col"></div>
            <div class="mdl-cell mdl-cell--3-col">
            <h3>Cadastrar Ideia</h3>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <input class="mdl-textfield__input" type="text" id="ideia" name="nome" pattern="^[[A-Za-zÀ-ú0-9., -]{2,30}$" autofocus>
                <label class="mdl-textfield__label" for="nome" >Nome</label>
                <span class="mdl-textfield__error">Use um título entre 2 e 30 caracteres</span>
              </div>
              <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <textarea class="mdl-textfield__input" name="descricao" rows="10" cols="40"></textarea>
                <label class="mdl-textfield__label" for="Descrição" >Descrição</label>
              </div>

              <?php $query = $this->db->query("SELECT id, nome FROM categoriaIdeia"); ?>

              <div class="mdl-select mdl-js-select mdl-select--floating-label">
                <select class="mdl-select__input" id='categoria_id' name='categoria_id'>

                  <?php 
                  foreach ($query->result() as $row) {
                      echo "<option value=". $row->id .">" . $row->nome . "</option>";
                  }?>
                </select>
                 <label class="mdl-select__label" for="categoria_id">Plataforma</label>
              </div>

                        
              <button type="submit" class="mdl-button mdl-js-button mdl-button--raised">Cadastrar ideia</button>
            </div>
        </div>
        </form>
    </div>