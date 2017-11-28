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
  .mdl-layout__header .material-icons, .c {
    color: #767777 !important;
  }
  .mdl-layout__header{ background: #fff;}
  a {
    text-decoration: none;
  }
</style>
<body>
<!-- Always shows a header, even in smaller screens. -->
<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
  <header class="mdl-layout__header">
    <div class="mdl-layout__header-row">
      <!-- Title -->
      <span class="mdl-layout-title c"><a href="<?= base_url('Main') ?>"><?= $title  ?></a></span>
      <!-- Add spacer, to align navigation to the right -->
      <div class="mdl-layout-spacer"></div>
      <!-- Navigation. We hide it in small screens. -->
      <nav class="mdl-navigation mdl-layout--large-screen-only">
        <a class="mdl-navigation__link c" style="<?php if(!isset($_GET['tela']) || (isset($_GET['tela']) && $_GET['tela'] == 'sobre')) echo 'background: rgba(0,0,0,.2)' ?>" href="<?= base_url('Main?tela=sobre#secao1') ?>">Sobre</a>
        <a class="mdl-navigation__link c" style="<?php if(isset($_GET['tela']) && $_GET['tela'] == 'idealizador') echo 'background: rgba(0,0,0,.2)' ?>" href="<?= base_url('Main?tela=idealizador#secao2') ?>">Idealizador</a>
        <a class="mdl-navigation__link c" style="<?php if(isset($_GET['tela']) && $_GET['tela'] == 'desenvolvedor') echo 'background: rgba(0,0,0,.2)' ?>"  href="<?= base_url('Main?tela=desenvolvedor#secao3') ?>">Desenvolvedor</a>
        <a class="mdl-navigation__link c" style="<?php if(isset($_GET['tela']) && $_GET['tela'] == 'entrar') echo 'background: rgba(0,0,0,.2)' ?>" href="<?= base_url('Entrar?tela=entrar') ?>">Entrar</a>
        <a class="mdl-navigation__link c" style="<?php if(isset($_GET['tela']) && $_GET['tela'] == 'inscrever') echo 'background: rgba(0,0,0,.2)' ?>" href="<?= base_url('Inscrever?tela=inscrever') ?>">Cadastrar</a>
      </nav>
    </div>
  </header>
  <div class="mdl-layout__drawer">
    <span class="mdl-layout-title">Open Idea</span>
    <nav class="mdl-navigation">
        <a class="mdl-navigation__link c" style="<?php if(!isset($_GET['tela']) || isset($_GET['tela']) && $_GET['tela'] == 'sobre') echo 'background: rgba(0,0,0,.2)' ?>" href="<?= base_url('Main?tela=sobre#secao1') ?>">Sobre</a>
        <a class="mdl-navigation__link c" style="<?php if(isset($_GET['tela']) && $_GET['tela'] == 'idealizador') echo 'background: rgba(0,0,0,.2)' ?>" href="<?= base_url('Main?tela=idealizador#secao2') ?>">Idealizador</a>
        <a class="mdl-navigation__link c" style="<?php if(isset($_GET['tela']) && $_GET['tela'] == 'desenvolvedor') echo 'background: rgba(0,0,0,.2)' ?>"  href="<?= base_url('Main?tela=desenvolvedor#secao3') ?>">Desenvolvedor</a>
        <a class="mdl-navigation__link c" style="<?php if(isset($_GET['tela']) && $_GET['tela'] == 'entrar') echo 'background: rgba(0,0,0,.2)' ?>" href="<?= base_url('Entrar?tela=entrar') ?>">Entrar</a>
        <a class="mdl-navigation__link c" style="<?php if(isset($_GET['tela']) && $_GET['tela'] == 'inscrever') echo 'background: rgba(0,0,0,.2)' ?>" href="<?= base_url('Inscrever?tela=inscrever') ?>">Cadastrar</a>
      </nav>
  </div>