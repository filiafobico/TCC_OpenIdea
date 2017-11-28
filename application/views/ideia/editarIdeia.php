<main class="mdl-layout__content">
        <div class="page-content">
        <div class="mdl-grid">
            <div class="mdl-cell mdl-cell--4-col">
              <h4> Proprietário da Ideia</h4>
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
              <form action="<?= base_url('Cadastrar-Projeto')?>" method="post">
                  <input type="hidden" name="ideia_id" value="<?= $this->uri->segment('2') ?>">
                  <input type="hidden" name="nome" value="<?= $nome ?>">
                  <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--primary"> Criar Projeto a partir dessa ideia </button>
              </form>
              <?php if($usuario_id == $this->session->userdata('id')) { ?>
                <br>
                <form action="<?= base_url('Deletar-Ideia/' . $this->uri->segment('2')) ?>" method="post">
                  <button type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-button--accent"> Excluir ideia </button>
                </form>
              <?php } ?>
            </div>
            <div class="mdl-cell mdl-cell--4-col">
            <form method="post" action="<?= base_url('Atualizar-Ideia-Banco/' . $id) ?>">
              <h3>Informaços da ideia</h3>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  
                  <input class="mdl-textfield__input" type="text" id="login" name="nome" value="<?= $nome ?>"  <?php if($usuario_id != $this->session->userdata('id')) echo "disabled"; ?> >
                  <label class="mdl-textfield__label" for="nome" >nome</label>
                </div>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <textarea class="mdl-textfield__input" name="descricao" rows="10" cols="40" <?php if($usuario_id != $this->session->userdata('id')) echo "disabled"; ?> ><?= $descricao ?></textarea>
                  <label class="mdl-textfield__label" for="Descrição" >Descrição</label>
                </div>
                <?php 
                  $query = $this->db->query("SELECT categoria_id FROM ideia WHERE id=$id");
                  $categoria_id = $query->result();
                  $categoria_id = $categoria_id[0]->categoria_id;

                  $query = $this->db->query("SELECT nome FROM categoriaIdeia WHERE id=$categoria_id"); 
                  $catNome = $query->result(); 
                ?>
                <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                  <input class="mdl-textfield__input" type="text" id="catNome" name="catNome" value="<?= $catNome[0]->nome ?>" disabled>
                  <label class="mdl-textfield__label" for="catNome" >Plataforma</label>
                </div>
                
                <?php if($usuario_id == $this->session->userdata('id')) { ?>
                  <button type="submit" class="mdl-button mdl-js-button mdl-button--raised"> Atualizar informações </button>
                <?php } ?>
              </form>
            </div>
            <div class="mdl-cell mdl-cell--4-col">
              <h4> Projetos que desenvolvem essa ideia</h4>
                <?php
                  $query = $this->db->query("SELECT * FROM projeto WHERE ideia_id = $id");
                  foreach ($query->result() as $projeto)
                  {
                    $query = $this->db->query("SELECT id, nome FROM usuario WHERE id = $projeto->usuario_id");
                    $usuario = $query->result();
                    ?>
                    <ul class="mdl-list">
                        <li class="mdl-list__item">
                            <span class="mdl-list__item-primary-content">
                                <i class="material-icons mdl-list__item-icon">folder</i>
                                <a href="<?= base_url('Ver-Projeto/' . $projeto->id) ?>">
                                    <?= $projeto->nome ?>
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
                  <?php }?>                
            </div>
        </div>
        <div class="md-grid">
          <div class="mdl-cell mdl-cell--8-col">
            
          </div>
        </div>
    </div>