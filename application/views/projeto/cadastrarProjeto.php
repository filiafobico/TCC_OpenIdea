<style>

.mdl-button--file input {
  cursor: pointer;
  height: 100%;
  right: 0;
  opacity: 0;
  position: absolute;
  top: 0;
  width: 300px;
  z-index: 4;
}

.mdl-textfield--file .mdl-textfield__input {
  box-sizing: border-box;
  width: calc(100% - 32px);
}
.mdl-textfield--file .mdl-button--file {
  right: 0;
}
</style>
<main class="mdl-layout__content">
    <div class="page-content">
        <div class="mdl-grid">
            <div class="mdl-cell--4-offset"></div>
            <div class="mdl-cell mdl-cell--3-col">
                <form method="post" action="<?= base_url('Inserir-Projeto-Banco') ?>" enctype="multipart/form-data">
                    <h3>Cadastrar Projeto</h3>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="nome" pattern="^[[A-Za-zÀ-ú0-9., -]{2,30}$" name="nome" required>
                        <label class="mdl-textfield__label" for="nome" >Nome</label>
                        <span class="mdl-textfield__error">Use um nome entre 2 e 30 caracteres</span>
                    </div>
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <textarea class="mdl-textfield__input" name="readme" rows="5" cols="40" required></textarea>
                        <label class="mdl-textfield__label" for="readme" >Descrição do Projeto</label>
                    </div>

                    <?php $query = $this->db->query("SELECT id, nome FROM ideia"); ?>

                    <div class="mdl-select mdl-js-select mdl-select--floating-label">
                    <SELECT class="mdl-select__input" id='ideia_id' name='ideia_id'>

                    <?php 
                        if(isset($ideia_id)){ ?>
                            <option value='<?= $ideia_id ?>'> <?= $nome ?> </option>
                    <?php } ?>

                    <?php 
                      foreach ($query->result() as $row){
                          echo "<option value=". $row->id .">" . $row->nome . "</option>";
                      }?>

                     </SELECT>
                      <label class="mdl-select__label" for="ideia_id">Ideia de Origem</label>
                    </div>

                    <?php $query = $this->db->query("SELECT id, nome FROM categoriaProjeto"); ?>

                        <div class="mdl-select mdl-js-select mdl-select--floating-label">
                        <SELECT class="mdl-select__input" id='categoria_id' name='categoria_id'>

                        <?php 
                        foreach ($query->result() as $row){
                            echo "<option value=". $row->id .">" . $row->nome . "</option>";
                        }?>
                        
                        </SELECT>
                        <label class="mdl-select__label" for="categoria_id">Linguagem</label>
                      </div>

                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--file">
                        <input class="mdl-textfield__input" placeholder="Arquivos pdf, odt, docx, png, jpge, jpg" type="text" id="uploadFile" readonly/>
                        <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
                          <i class="material-icons">attach_file</i><input type="file" name="arquivo" id="uploadBtn" required>
                        </div>
                      </div><br>

                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised">
                        Cadastrar projeto
                    </button>
                </form>
            </div>
        </div>
    </div>
    <script>
document.getElementById("uploadBtn").onchange = function () {
    document.getElementById("uploadFile").value = this.files[0].name;
};
    </script>