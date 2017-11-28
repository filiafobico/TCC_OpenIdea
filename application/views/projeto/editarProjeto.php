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
            <div class="mdl-cell mdl-cell--4-col">
                <h4>Lista de arquivos cadastrados</h4>

                <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp">
                    <thead>
                        <tr>
                            <th class="mdl-data-table__cell-non-numeric">Arquivos que fazem parte do projeto</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    $query = $this->db->query("SELECT nome, id FROM Arquivos WHERE projeto_id = $id");
                    foreach ($query->result() as $row){ ?>
                    <tr>
                        <td><a target="_blank" href="<?= base_url('arquivos/' . $row->nome ) ?>" > <?= $row->nome ?> </a> </td>
                    
                <?php if($usuario_id == $this->session->userdata('id')){ ?> 
                        <td class="mdl-data-table__cell-non-numeric">
                        <a href="<?= base_url('Deletar-Arquivo/' . $row->id) ?>">
                            <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                                <i class="material-icons">clear</i>
                            </button>
                        </a>
                        <td>
                        </tr>
                <?php } ?>
                <?php } ?>
                </tbody>
                </table>
                
              <?php if($usuario_id == $this->session->userdata('id')) { ?>
                <br>
                <form action="<?= base_url('Deletar-Projeto/' . $this->uri->segment('2')) ?>" method="post">
                  <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent"> Excluir Projeto </button>
                </form>
              <?php } ?>

            </div>
            <div class="mdl-cell mdl-cell--4-col"> 
            <form method="post" action="<?= base_url('Atualizar-Projeto-Banco/' . $id) ?>" enctype="multipart/form-data">
                <h3>Informaços do Projeto</h3>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input class="mdl-textfield__input" type="text" id="login" name="nome" value="<?= $nome ?>" <?php if($usuario_id != $this->session->userdata('id')) echo "disabled"; ?> >
                    <label class="mdl-textfield__label" for="nome" >Nome</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <textarea class="mdl-textfield__input" name="readme" rows="10" cols="40" <?php if($usuario_id != $this->session->userdata('id')) echo "disabled"; ?>><?= $readme ?></textarea>
                    <label class="mdl-textfield__label" for="readme" >Descrição do Projeto</label>
                </div>

                <?php 
                  $query = $this->db->query("SELECT categoria_id FROM projeto WHERE id=$id");
                  $categoria_id = $query->result();
                  $categoria_id = $categoria_id[0]->categoria_id;

                  $query = $this->db->query("SELECT nome FROM categoriaProjeto WHERE id=$categoria_id"); 
                  $catNome = $query->result(); 
                ?>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="text" id="catNome" name="catNome" value="<?= $catNome[0]->nome ?>" disabled>
                  <label class="mdl-textfield__label" for="catNome" >Linguagem</label>
                </div>
                
                <?php if($usuario_id == $this->session->userdata('id')){ ?> 
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--file">
                        <input class="mdl-textfield__input" placeholder="Arquivos pdf, odt, docx, png, jpge, jpg" type="text" id="uploadFile" readonly/>
                        <div class="mdl-button mdl-button--primary mdl-button--icon mdl-button--file">
                          <i class="material-icons">attach_file</i><input type="file" name="arquivo" id="uploadBtn">
                        </div>
                      </div><br>

                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised">
                        <i class="material-icons mdl-list__item-icon">save</i>
                    </button>
                <?php } ?>
            </form>
            </div>
            <div class="mdl-cell mdl-cell--4-col"> 
                <h4> Proprietário do Projeto</h4>
                  <?php
                    $query = $this->db->query("SELECT id, nome FROM usuario WHERE id = $usuario_id");
                    $usuario = $query->result();
                  ?>
                  <ul class="demo-list-icon mdl-list">
                        <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">account_circle</i>
                                <a href="<?= base_url('Painel/' . $usuario[0]->id) ?>">
                                    <?= $usuario[0]->nome ?>
                                </a>                                
                            </span>
                        </li>
                  </ul>
                
                <h4>Ideia que deu origem ao projeto</h4>
                <?php
                    $query = $this->db->query("SELECT id, nome FROM ideia WHERE id = $ideia_id");
                    $ideia = $query->result();

                    $query = $this->db->query("SELECT id, nome FROM usuario WHERE id = $usuario_id");
                    $usuario = $query->result();
                ?>
                <ul class="demo-list-icon mdl-list">
                        <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">folder</i>
                                <a href="<?= base_url('Ver-Ideia/' . $ideia[0]->id) ?>">
                                    <?= $ideia[0]->nome ?>
                                </a>                                
                            </span>
                        </li>
                         <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">account_circle</i>
                                <a href="<?= base_url('Painel/' . $usuario[0]->id) ?>">
                                    <?= $usuario[0]->nome ?>
                                </a>                                
                            </span>
                        </li>
                  </ul>
            </div>
        </div>
    </div>
    <div id="avaliacao"></div>
    
    <script>
document.getElementById("uploadBtn").onchange = function () {
    document.getElementById("uploadFile").value = this.files[0].name;
};
    </script>