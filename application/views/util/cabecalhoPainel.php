<!DOCTYPE html>
<html>
<head>
    <title>Open Idea</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.2.1/material.indigo-pink.min.css">
	<script defer src="https://code.getmdl.io/1.2.1/material.min.js"></script>
    <link rel="icon" type="faicon/ico" href="<?= base_url('imagens/favicon.ico')?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style type="text/css">
    .mdl-layout__header .material-icons, .c, .mdl-layout__tab  {
        color: #767777 !important;
    }
    .mdl-layout__header, .mdl-layout__tab-bar{ 
        background: #fff;
    }
    a {
        text-decoration: none;
    }
    input:disabled, textarea:disabled{
        color: rgba(0,0,0,.7) !important;
    }
</style>
<body>
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header mdl-layout--fixed-tabs">
    <header class="mdl-layout__header">
        <div class="mdl-layout__header-row">
            <!-- Title -->
            <span class="mdl-layout-title c"><a href="<?= base_url('Painel') ?>"><?= $title ?></a><?= $sub_title ?></span>
            <div class="mdl-layout-spacer"></div>
            <nav class="mdl-navigation mdl-layout--large-screen-only">
                <a class="mdl-navigation__link c" href="<?= base_url('Sair')?>">Deslogar</a>
            </nav>
        </div>
        <!-- Tabs -->
        <div class="mdl-layout__tab-bar mdl-js-ripple-effect">
            <a href="<?= base_url('Perfil')?>" class="mdl-layout__tab <?php if($this->uri->segment("1") == 'Inserir' || $this->uri->segment("1") == 'Logar' || $this->uri->segment("1") == 'Perfil'|| $this->uri->segment("1") == 'Painel' || $this->uri->segment("1") == 'Atualizar') echo 'is-active';?>">Meu perfil</a>
            <a href="<?= base_url('Ideias')?>" class="mdl-layout__tab <?php if($this->uri->segment("1") == 'Ideias') echo 'is-active';?>">Minhas Ideias</a>
            <a href="<?= base_url('Projetos')?>" class="mdl-layout__tab <?php if($this->uri->segment("1") == 'Projetos') echo 'is-active' ?>">Meus projetos</a>
        </div>
    </header>
    <div class="mdl-layout__drawer">
        <span class="mdl-layout-title">Open Idea</span>
        <nav class="mdl-navigation">
            <a class="mdl-navigation__link" style="<?php if($this->uri->segment("1") == 'Inserir' || $this->uri->segment("1") == 'Logar' || $this->uri->segment("1") == 'Perfil'|| $this->uri->segment("1") == 'Painel' || $this->uri->segment("1") == 'Atualizar' || $this->uri->segment("1") == 'Ideias' || $this->uri->segment("1") == 'Projetos') echo 'background: rgba(0,0,0,.2)' ?>" href="<?= base_url('Painel') ?>">Eu, Ideias e Projetos</a>
            <a class="mdl-navigation__link" href="<?= base_url('Cadastrar-Ideia') ?>">Criar Ideias e Projetos</a>
            <a class="mdl-navigation__link" style="<?php if(0) echo 'background: rgba(0,0,0,.2)'?>" href="<?= base_url('Usuarios-Comunidade') ?>">Pessoas, Ideias, Projetos</a>
        </nav>
    </div>
