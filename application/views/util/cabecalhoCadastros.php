<!DOCTYPE html>
<html>
<head>
    <title>Open Idea</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>
    <link rel="icon" type="faicon/ico" href="<?= base_url('imagens/favicon.ico')?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://codepen.io/etcpe9/pen/PqyOye.css">
    <script defer src="https://codepen.io/etcpe9/pen/PqyOye.js"></script>

</head>
<style type="text/css">

    .mdl-layout__header .material-icons, .c, .mdl-layout__tab  {
        color: #767777 !important;
    }
    .mdl-layout__header, .mdl-layout__tab-bar{ background: #fff !important;}
    a {
        text-decoration: none;
    }
    
    fieldset[disabled] .mdl-textfield .mdl-textfield__input, .mdl-textfield.is-disabled .mdl-textfield__input {
        color: rgba(0,0,0,.5) !important;
    }
</style>
<body>
<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--fixed-tabs">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <!-- Title -->
            <span class="mdl-layout-title c"><a href="<?= base_url('Painel') ?>"><?= $title ?></a><?= $sub_title ?></span>
            <!-- Add spacer, to align navigation to the right -->
            <div class="mdl-layout-spacer"></div>
            <!-- Navigation. We hide it in small screens. -->
            <nav class="mdl-navigation mdl-layout--large-screen-only">
                <a class="mdl-navigation__link c" href="<?= base_url('Sair')?>">Deslogar</a>
            </nav>
        </div>

            <!-- Tabs -->
    <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
        <a href="<?= base_url('Cadastrar-Ideia')?>" class="mdl-layout__tab <?php if($this->uri->segment("1") == 'Cadastrar-Ideia' || $this->uri->segment("1") == 'Deletar-Ideia') echo 'is-active';?>">Cadastar Ideias</a>
        <a href="<?= base_url('Cadastrar-Projeto')?>" class="mdl-layout__tab <?php if($this->uri->segment("1") == 'Cadastrar-Projeto' || $this->uri->segment("1") == 'Deletar-Projeto') echo 'is-active';?>">Cadastrar Projetos</a>
    </div>
    </header>

    <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">Open Idea</span>
        <nav class="mdl-navigation">
            <a class="mdl-navigation__link" href="<?= base_url('Painel') ?>">Eu, Ideias, Projetos</a>
            <a class="mdl-navigation__link" style="<?php if($this->uri->segment("1") == 'Cadastrar-Ideia' || $this->uri->segment("1") == 'Cadastrar-Projeto') echo 'background: rgba(0,0,0,.2)'?>"  href="<?= base_url('Cadastrar-Ideia') ?>">Criar Ideias e Projetos</a>
            <a class="mdl-navigation__link" href="<?= base_url('Usuarios-Comunidade') ?>">Pessoas, Ideias, Projetos</a>
        </nav>
    </div>