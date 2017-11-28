<?php
/**
 * Documento de funções da Classe Ideia
 * @author Luis Eduardo Oliveira
 * @version 0.1
 * @package controllers
 * @copyright Copyright (c) 2014 - 2017
 */
class Ideia extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Crud_model');
        $this->Crud_model->tabela = "ideia";
    }

    /**
     * Mostra a view para cadastro de ideias
     *
     * @see Ideia::estaLoggado()        Verifica se o usuário está loggado
     *
     * @param void
     *
     * @return void
     */
    public function cadastrarIdeia(){
        $this->estaLoggado();

        $data['title'] = "Open Idea";
        $data['sub_title'] = " | Cadastrar Ideia";
        $this->load->view('util/cabecalhoCadastros', $data);
        $this->load->view('ideia/cadastrarIdeia');
        $this->load->view('util/rodape');
    }

    /**
     * Lista todas as ideias a partir da id do usuario logado no sistema
     *
     * @see Ideia::estaLoggado()        Verifica se o usuário está loggado
     *
     * @see Ideia::ListarIdeias()       Função que cria a páginação e a listagem dos resultados
     *
     * @param void
     *
     * @return void
     */
    public function ideias(){
        $this->estaLoggado();

        $id = $this->session->userdata('id');
        $condicao = "usuario_id=$id";
        $ideias = $this->ListarIdeias('Ideias', $condicao);

        $data['title'] = "Open Idea";
        $data['sub_title'] = " | Lista de Ideias";
        $this->load->view('util/cabecalhoPainel', $data);
        $this->load->view('ideia/painelIdeias', $ideias);
        $this->load->view('util/rodape');
    }
    
    /**
     * View para ver a ideia e editar caso quem esteja vendo a ideia seja o dono pode editar a ideia também
     *
     * @see Crud_model::GetById()       Retorna um registro do BD a partir de um id
     *
     * @param int $id Id da ideia que sera visualizada
     *
     * @return void
     */
    public function verIdeia($id = 0){
        $this->estaLoggado();

        $id = $this->uri->segment("2");
        $ideia = $this->Crud_model->getById($id);

        $title['title'] = "Open Idea";
        $title['sub_title'] = " | Ver Ideia";
        $this->load->view('util/cabecalhoPainel', $title);
        $this->load->view('ideia/editarIdeia', $ideia);
        $this->load->view('util/comentarios');
        $this->load->view('util/rodape');
    }

    /**
     * Página de a listagem dos ideias da comunidade
     * Verifica se foi feita uma pesquisa para a listagem,
     * caso tenha sido feita, retorna os resultados a partir da pesquisa
     * caso contrario, retorna todas as ideias
     *
     * @see Ideia::tratarPesquisa()         Caso exista entrada por post, essa função trata do que foi recebido e cria uma string para consulta no BD
     *
     * @see Ideia::ListarIdeias()           Função chamada após a criação da string de pesquisa no BD
     *
     * @param void
     *
     * @return void
    */
    public function ideiasComunidade(){
        $cond = '1 = 1';

        if($this->input->post()){
            $cond = $this->tratarPesquisa($this->input->post());
        }

        $ideias = $this->ListarIdeias('Ideias-Comunidade', $cond);

        $title['title'] = "Open Idea";
        $title['sub_title'] = " | Ideias da Comunidade";
        $this->load->view('util/comunidadePainel', $title);
        $this->load->view('ideia/comunidadeIdeias', $ideias);
        $this->load->view('util/rodape');
    }

    /**
     * Cria a view para a mensagem de feedback
     *
     * @param array $mensagem Array contendo a mensagem principal e ou uma informação adicional para o feedback
     *
     * @return void
     */
    public function mensagem($mensagem){
        $this->load->view('util/alert', $mensagem);
    }

    /**
     * Funcao para tratar o que é recebido do formulário dos projetos da comunidade
     * Cria a query de acordo com as opções selecionadas no formulário
     *
     * @param string $condicao
     *
     * @return string $cond String da condição de pesquisa na clausula Where
     */
    public function tratarPesquisa($condicao){
        $cond = "";

        if ($condicao['nome'] == '') {
            if(!isset($condicao['categoria_id'])){
                return 0;
            }else{
                unset($condicao['nome']);
            }

        }else{
            $cond = "nome LIKE '%". $condicao['nome'] ."%'";
        }

        if (isset($condicao['categoria_id'])) {
            if($cond != ""){
                 $cond .= " or ";
            }
            $cond .= "categoria_id = ";
            foreach ($condicao['categoria_id'] as $i => $cat) {
                $cond .= $cat;
                if($i < sizeof($condicao['categoria_id'])-1){
                    $cond .= " or categoria_id = ";
                }
            }
        }
            return $cond;
    }

    /**
     * Insere a avaliação no banco de dados
     * Recebe os valores a partir do post da view que chamou essa funcão
     *
     * @see Crud_model::$tabela         Define a tabela que será manipulada
     *
     * @see Crud_model::Inserir()
     *
     * @param void
     *
     * @return void
     */
    public function comentarIdeia(){
        $data = $this->input->post();
        $id = $this->uri->segment("2");
        $this->Crud_model->tabela = 'avaliacaoIdeia';

        if($this->Crud_model->Inserir($data)){
            $mensagem['mensagem'] = "Comentario adicionado com sucesso!";
            redirect(base_url('Ver-Ideia/' . $id));
            $this->mensagem($mensagem);
        }
    }
    /**
     * Função para inserção de nova ideia
     * Recebe os valores atravez do post da página que chamou essa função
     *
     * @see Crud_model::Inserir()
     *
     * @see Ideia::mensagem()
     *
     * @see Ideia::cadastrarIdeia()
     *
     * @param void
     *
     * @return void
     *
     */
    public function inserirIdeiaBanco(){
        $data = $this->input->post();
        
        $data['usuario_id'] = $this->session->userdata('id');
        $data['imagem'] = "../arquivos/imagens/padrao.png";

        if($this->Crud_model->Inserir($data)){
            $mensagem['mensagem'] = "Ideia adicionada com sucesso!";
            $this->mensagem($mensagem);
            $this->cadastrarIdeia();
        }
    }

    /**
     * Função para atualizar registro de ideia
     * Recebe os valores através do post da página que chamou essa função
     *
     * @see Crud_model::Atualizar()
     *
     * @see Ideia::mensagem()
     *
     * @see Ideia::mensagem()
     *
     * @see Ideia::verIdeia()
     *
     * @param void
     *
     * @return void
    */
    public function atualizar(){
        $data = $this->input->post();
        $id = $this->uri->segment("2"); 
        $this->Crud_model->Atualizar($id, $data);
        
        $mensagem['mensagem'] = "Ideia atualizado com sucesso!";
        $this->mensagem($mensagem);
        $this->verIdeia();
    }

    /**
     * Função para deletar comentário de uma ideia
     *
     * @see Crud_model::GetById()
     *
     * @see Crud_model::Excluir()
     *
     * @param void
     *
     * @return void
    */
    public function deletarAvaliacao(){
        $id = $this->uri->segment("2");
        
        $this->Crud_model->tabela = 'avaliacaoIdeia';
        $ideiaId = $this->Crud_model->getById($id);
        
        $condicao = "id=$id";
        $this->Crud_model->Excluir($condicao);

        redirect(base_url('Ver-Ideia/' . $ideiaId['ideia_id']));
    }

    /**
     * Função para deletar registro de ideia exclui as avaliacos relacionadas a ideia
     * e exclui o registro da ideia
     *
     * @see Crud_model::$tabela
     *
     * @see Crud_model::GetByCon()
     *
     * @see Crud_model::GetById()
     *
     * @see Ideia::cadastrarIdeia()
     *
     * @see Ideia::mensagem()
     *
     * @param void
     *
     * @return void
    */
    public function deletar(){
        $id = $this->uri->segment("2");

        // Verificar se algum projeto usa essa ideia
        $this->Crud_model->tabela = 'projeto';
        $condicao = 'ideia_id = ' .$id;
        $res = $this->Crud_model->GetByCon($condicao);
        if(!$res){
            $condicao = "ideia_id=$id";
            $this->Crud_model->tabela = 'avaliacaoIdeia';
            $this->Crud_model->Excluir($condicao);
    
            $condicao = "id=$id";
            $this->Crud_model->tabela = 'ideia';
            $this->Crud_model->Excluir($condicao);
            
            $mensagem['mensagem'] = "Ideia apagado com sucesso!";
            $mensagem['informacao'] = "Aproveite para registrar uma nova ideia";
            $this->cadastrarIdeia();
            $this->mensagem($mensagem);
        }else{
            $mensagem['mensagem'] = "Ideia não pode ser apagada";
            $mensagem['informacao'] = "A ideia é usada por um ou mais projetos </br> Em vez disso, crie uma nova idea";
            $this->cadastrarIdeia();
            $this->mensagem($mensagem);
        }
    }

    /**
     * Configuração para exibição das ideias e páginação
     * @param string $pagina a pagina que será a base da url da paginação
     *
     * @param string $condicao define o delimitador das funções 'contaRegistro' e 'Listar'
     *
     * @see Crud_model::contaRegistros()
     *
     * @see Crud_model::Listar()
     *
     * @return mixed Registros do banco para serem listados na tela
     */
    public function ListarIdeias($pagina, $condicao){

        $this->load->library('pagination');
        $maximo = 12;
        $inicio = (!$this->uri->segment("2")) ? 0 : $this->uri->segment("2");

        $config['base_url'] = '/CodeIgniter/exemplos-livro-ci/OpenIdea/' . $pagina;
        $config['use_page_numbers'] = False;

        $config['total_rows'] = $this->Crud_model->contaRegistros($condicao);
        $config['per_page'] = $maximo;

        $config['full_tag_open'] = "<nav><ul class='pagination'>";
        $config['full_tag_close'] = "<ul></nav>";
        $config['first_link'] = "Primeira";
        $config['first_tag_open'] = "<li>";
        $config['first_tag_close'] = "</li>";
        $config['last_link'] = "Última";
        $config['last_tag_open'] = "<li>";
        $config['last_tag_close'] = "</li>";
        $config['next_link'] = "Próxima";
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_link'] = "Anterior";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tag_close'] = "</li>";
        $config['cur_tag_open'] = "<li class='active'><a href='#'>";
        $config['cur_tag_close'] = "</a></li>";
        $config['num_tag_open'] = "<li>";
        $config['num_tag_close'] = "</li>";

        $this->pagination->initialize($config);

        $ideias['paginacao'] =  $this->pagination->create_links();

        $ideias['ideia'] = $this->Crud_model->Listar($maximo, $inicio, $condicao);

        return $ideias;
    }

    /**
     * Verifica se o usuário está loggado
     * caso nao esteja, retorna uma mensagem de erro
     * e manda para a pagina de login
     *
     * @see Ideia::mensagem()
     *
     * @param void
     *
     * @return void
     */
    public function estaLoggado(){
        if(!$this->session->userdata('logado')){
            $mensagem['mensagem'] = "Usuárix não está logado!";
            $mensagem['informacao'] = "Login ou senha incorretos";
            redirect('Entrar');
            $this->mensagem($mensagem);
        }
    }
}
