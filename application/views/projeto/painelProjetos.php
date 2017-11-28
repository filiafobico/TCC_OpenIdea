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

    <section class="mdl-layout__tab-panel" id="ideias">
    </section>

    <section class="mdl-layout__tab-panel is-active" id="projetos">
        <div class="page-content">
            <div class="mdl-grid">
                <div class="mdl-cell--5-offset-desktop"></div>
                <div class='mdl-cell mdl-cell--4-col'>
                    <?= $paginacao; ?>
                </div>
                <?php
                foreach ($projeto as $chv) { 
                    $this->Crud_model->tabela = 'categoriaProjeto';
                    $chv->categoria_id = $this->Crud_model->GetById($chv->categoria_id);
                ?>

                    <div class="mdl-cell mdl-cell--4-col">
                        <div class="demo-card-wide mdl-card mdl-shadow--2dp">
                        <div class="mdl-card__title" >
                            <h2 class="mdl-card__title-text"><?= $chv->nome ?></h2>
                        </div>
                        <div class="mdl-card__supporting-text">
                            <?= $chv->readme ?>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <a href="<?= base_url('Ver-Projeto/' . $chv->id) ?>" class="mdl-button mdl-button--raised mdl-js-button mdl-js-ripple-effect">
                                Ver Projeto
                            </a>
                            <?= $chv->categoria_id['nome'] ?>
                        </div>
                        
                        <div class="mdl-card__menu">
                             <a href="<?= base_url('Deletar-Projeto/' . $chv->id) ?>">
                                <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                                    <i class="material-icons">delete_forever</i>
                                </button>
                            </a>
                        </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="mdl-cell--5-offset-desktop"></div>
                <div class="mdl-cell mdl-cell--4-col">
                    <?= $paginacao; ?>
                </div>
            </div>
        </div>
    </section>