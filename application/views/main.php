<style type="text/css">
html { height: 100%; overflow: hidden; }
body {
    margin: 0;
    padding: 0;
    height: 100%;
    overflow-x: hidden;
    overflow-y: scroll;
    perspective: 1px;
}
h1 {
    text-align: center;
    font-size: 400%;
    color: #fff;
    text-shadow: 0 2px 2px #000;
}
#secao1 {
    background: no-repeat;
    background-size: cover;

}
#secao2 {
    transform: translateZ(-10px);
    z-index: -1;
}
#secao3 {
    z-index: -2;
    background-size: cover;
}
.slide {
    position: relative;
    padding: 22% 5%;
    box-sizing: border-box;
    box-shadow: 0 -1px 10px rgba(0, 0, 0, .7);
    transform-style: inherit;
}
p { 
    text-align: center;
    color: #fff;  
    font-size: 30px; 
    text-shadow: 0 2px 2px #000; 

}
</style>
  <main class="mdl-layout__content">
    <div class="page-content">
    <!-- Your content goes here -->
      <section id="secao1" class="slide" style="background-image: url(<?= base_url('imagens/cri.jpg') ?>)">
            <h1>Compartilhe suas ideais com o mundo</h1>
            <p>O Open Idea foi pensado para todos os inovadores de plantão que desejam inovar o mundo em que vivem</p>
            <p>É feito para quem tem ideias inovadoras</p>
            <p>E para quem deseja tirar essas ideias do papel</p>
        </section>
        
        <section id="secao2" class="slide" style="background-image: url(<?= base_url('imagens/dev.jpg') ?>)">
            <p>Mostre toda sua criatividade ao mundo</p>
            <p>Não tenha medo de não saber executar sua ideia, deixe-a para pessoas capacitadas em fazê-la</p>
        </section>
        
        <section id="secao3" class="slide" style="background-image: url(<?= base_url('imagens/ide.jpg') ?>)">
            <p>Encontre um projeto com o qual se identifique</p>
            <p>Desenvolva projetos pensados pelos integrantes da comunidade</p>
        </section>
    </div>
