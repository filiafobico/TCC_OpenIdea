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
                <form method="post" action="<?= base_url('Usuarios-Comunidade') ?>">
            <div class="mdl-grid">                    
               
               <div class="mdl-cell--4-offset"></div>
                
                <div class="mdl-cell mdl-cell--4-col">
                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                        <input class="mdl-textfield__input" type="text" id="login" name="nome">
                        <label class="mdl-textfield__label" for="nome" >Digite parte ou o nome inteiro dx Usuárix</label>
                    </div>
                    <button type="submit" class="mdl-button mdl-js-button mdl-button--raised">Pesquisar</button>
                </div>
                
                <div class="mdl-cell--5-offset"></div>
                </form>
                <div class='mdl-cell mdl-cell--4-col'>
                    <?= $paginacao; ?>
                </div>

                <?php
                foreach ($usuario as $chv) {  ?>
                    <div class="mdl-cell mdl-cell--4-col">
                    <div class="demo-card-wide mdl-card mdl-shadow--2dp">
                    <div class="mdl-card__title" >
                        <h2 class="mdl-card__title-text"><?= $chv->nome ?></h2>
                    </div>
                    <div class="mdl-card__supporting-text">
                        
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a href="<?= base_url('Painel/' . $chv->id) ?>" class="mdl-button mdl-button--raised mdl-js-button mdl-js-ripple-effect">
                            Ver Usuarios
                        </a>
                    </div>
                    
                    <div class="mdl-card__menu">
                         <a href="">
                            <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                                <i class="material-icons">share</i>
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