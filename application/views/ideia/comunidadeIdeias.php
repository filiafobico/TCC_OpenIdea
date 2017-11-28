<style>
    .demo-card-wide.mdl-card {
        width: 426px;
    }
    .demo-card-wide > .mdl-card__title {
        color: #fff;
        height: 176px;
        background: #4F5155;
    }
    .demo-card-wide > .mdl-card__menu {
        color: #fff;
    }
    li {
        display: inline;
        margin: 1px;
    }
    nav {
        align: center;
    }
</style>

<main class="mdl-layout__content">
    <section class="mdl-layout__tab-panel " id="perfil">
    </section>

    <section class="mdl-layout__tab-panel is-active" id="ideias">
        <div class="page-content">
        <form method="post" action="<?= base_url('Ideias-Comunidade') ?>">
            <div class="mdl-grid">                    
               
               <div class="mdl-cell--3-offset"></div>

                <div class="mdl-cell mdl-cell--1-col">
                    <?php
                        $query = $this->db->query("SELECT id, nome FROM categoriaIdeia");

                        foreach ($query->result() as $row){ ?>
                            <label class="mdl-checkbox mdl-js-checkbox" for="<?= $row->nome ?>">
                              <input type="checkbox" name="categoria_id[]" id="<?= $row->nome ?>" class="mdl-checkbox__input" value="<?= $row->id ?>">
                              <span class="mdl-checkbox__label"><?= $row->nome ?></span>
                            </label>  

                       <?php } ?>
                </div>
                
                <div class="mdl-cell mdl-cell--4-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="login" name="nome">
                        <label class="mdl-textfield__label" for="nome" >Digite parte ou o nome inteiro da ideia</label>
                    </div>
                </div>
                <div class="mdl-cell mdl-cell--1-col">
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised">Pesquisar</button>
                </div>
                
                <div class="mdl-cell--5-offset"></div>
                </form>
                <div class='mdl-cell mdl-cell--4-col'>
                    <?= $paginacao ?>
                </div>

                <?php foreach($ideia as $chv) { 
                    $this->Crud_model->tabela = 'categoriaIdeia';
                    $chv->categoria_id = $this->Crud_model->GetById($chv->categoria_id);
                ?>
                    
                    <div class='mdl-cell mdl-cell--4-col'>
                    <div class='demo-card-wide mdl-card mdl-shadow--2dp'>
                    <div class='mdl-card__title'>
                        <h2 class='mdl-card__title-text'>
                        <?= $chv->nome ?>
                        </h2>
                    </div>
                    <div class='mdl-card__supporting-text'>
                        <?= $chv->descricao ?>
                    </div>
                    <div class='mdl-card__actions mdl-card--border'>
                        <a href="<?= base_url('Ver-Ideia/' . $chv->id) ?>" class='mdl-button mdl-button--raised mdl-js-button mdl-js-ripple-effect'>
                            Ver Ideia 
                        </a>
                        <?= $chv->categoria_id['nome'] ?>
                    </div>
                    
                    <div class='mdl-card__menu'>
                        <a href="" >
                        <button class='mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect'>
                            <i class='material-icons'>share</i>
                        </button>
                        </a>
                    </div>
                    </div>
                    </div>
                    <?php } ?>
                
                <div class="mdl-cell--5-offset-desktop"></div>
                <div class='mdl-cell mdl-cell--4-col'>
                    <?= $paginacao ?>
                </div>
            </div>
        
        </div>
    </section>
    
    <section class="mdl-layout__tab-panel" id="projetos">
    </section>