<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Documento de funções da Classe Main
 * @author Luis Eduardo Oliveira
 * @version 0.1
 * @package controllers
 * @copyright Copyright (c) 2014 - 2017
 */
class Main extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Crud_model');
    }

    /**
     * Cria a view para a página index
     *
     * @param void
     *
     * @return void
    */
	public function index()
	{
		$data['title'] = "Open Idea";
		$this->load->view('util/cabecalho', $data);
		$this->load->view('main');
		$this->load->view('util/rodape');
	}

    /**
     * Cria a view para a pagina Entrar
     *
     * @param void
     *
     * @return void
     */
    public function entrar(){
        $data['title'] = "Open Idea";
        $data['sub_title'] = " | Entrar";
        $this->load->view('util/cabecalho', $data);
        $this->load->view('entrar');
        $this->load->view('util/rodape');

    }

    /**
     * Cria a view para a pagina Inscrever
     *
     * @param void
     *
     * @return void
     */
    public function inscrever(){
        $data['title'] = "Open Idea";
        $this->load->view('util/cabecalho', $data);
        $this->load->view('inscrever');
        $this->load->view('util/rodape');
    }

    /**
     * Cria a view para a pagina Painel
     * de acordo com o id passado na uri, se estiver disponível
     * ou com os dados da sessão
     *
     * @see Crud_model::$tabela
     *
     * @see Crud_model::GetById()
     *
     * @param void
     *
     * @return void
     */
    public function painel(){
        $this->estaLoggado();

        if($usuario = $this->uri->segment("2")){
            $this->Crud_model->tabela = "usuario";
            $usuario = $this->Crud_model->GetById($usuario);
        }else{
            $usuario = $this->session->userdata();
        }

        $data['title'] = "Open Idea";
        $data['sub_title'] = " | Painel do usuário";
        $this->load->view('util/cabecalhoPainel', $data);
        $this->load->view('painel', $usuario);     
        $this->load->view('util/rodape');
    }

    /**
     * View para a listagem dos projetos da comunidade
     * Verifica se foi feita uma pesquisa para a listagem,
     * caso tenha sido feita, retorna os resultados a partir da pesquisa
     * caso contrario, retorna todos os projetos
     *
     * @see Main::ListarUsuarios()
     *
     * @param void
     *
     * @return void
    */
    public function usuarioComunidade(){
        if($this->input->post()){
            $condicao = $this->input->post();
            $condicao = "nome LIKE '%". $condicao['nome'] ."%'";

            $usuarios = $this->ListarUsuarios('Usuarios-Comunidade', $condicao);
        }else{
            $usuarios = $this->ListarUsuarios('Usuarios-Comunidade', '1 = 1');
        }

        $title['title'] = "Open Idea";
        $title['sub_title'] = " | Usuarios da Comunidade";
        $this->load->view('util/comunidadePainel', $title);
        $this->load->view('comunidadeUsuarios', $usuarios);
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
     * Configuração para exibição dos projetos e páginação
     *
     * @see Crud_model::$tabela
     *
     * @see Crud_model::GetByCon()
     *
     * @see Crud_model::GetById()
     *
     * @see Main::cadastrarIdeia()
     *
     * @see Main::mensagem()
     *
     * @param $pagina, Pagina de retorno da funcao
     *
     * @param $condicao, define o delimitador das funções 'contaRegistro' e 'Listar'
     *
     * @return mixed Registros do banco para serem listados na tela
     */
    public function ListarUsuarios($pagina, $condicao){
        $this->Crud_model->tabela = "usuario";
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

        $usuarios['paginacao'] =  $this->pagination->create_links();
        $usuarios['usuario'] = $this->Crud_model->Listar($maximo, $inicio, $condicao);

        return $usuarios;
    }

    /**
     * Adiciona um novo usuário ao banco de dados
     * e cria os valores da sessao
     * retorna mensagem de sucesso ou erro 
     * dependendo se tudo ocorreu bem
     *
     * @see Main::mensagem()
     *
     * @see Crud_model::Inserir()
     *
     * @see Crud_model::GetById()
     *
     * @param void
     *
     * @return void
     */
    public function adicionarUsuario(){
        $this->Crud_model->tabela = "usuario";
        $data = $this->input->post();

       if($data != null){ 
            $data['senha'] = md5($data['senha']);
            $imagem = "padrao.png";
   
           if($this->Crud_model->Inserir($data)){
               $usuarioId = $this->db->insert_id();
               $usuarioDados = $this->Crud_model->GetById($usuarioId);
               $this->defineSessao($usuarioDados);
            
               $mensagem['mensagem'] = "Seja bem vindx!";
               $mensagem['informacao'] = "Usuário cadastrado com sucesso";
               $this->painel();
               $this->mensagem($mensagem); 
           }
        }else{
           $mensagem['mensagem'] = "Ocorreu um erro";
           $mensagem['informacao'] = "Por favor, tente novamente";
           $this->entrar();
           $this->mensagem($mensagem);
        }
    }

    /**
     * Faz login de alguém que entrou com uma conta já existente
     * Verifica se o usuario existe no banco de dados
     * se sim, cria a sessao e direciona para a pagina principal
     * se nao, retorna uma mensagem de erro
     *
     * @see Crud_model::GetByLoginSenha()
     *
     * @see Main::defineSessao()
     *
     * @see Main::mensagem()
     *
     * @see Main::painel()
     *
     * @see Main::entrar()
     *
     * @param void
     *
     * @return void
     */

    public function logarEntrar(){
        $this->Crud_model->tabela = "usuario";
        $usuario = $this->input->post();
        $senha = md5($usuario['senha']);

        // Consulta no banco se o usuário existe
        $usuarioDados = $this->Crud_model->GetByLoginSenha($usuario['login'], $senha);

        if($usuarioDados != false) {
            $this->defineSessao($usuarioDados);
            
            $mensagem['mensagem'] = "Seja bem vindx!";
            $this->mensagem($mensagem);
            $this->painel();
        }else{
                $mensagem['mensagem'] = "Usuarix não cadastrado no banco de dados!";
                $mensagem['informacao'] = "Login ou senha incorretos";
                $this->mensagem($mensagem);
                $this->entrar();
        }
    }

    /**
     * Atualiza os dados do usuário
     * filtra os valores recebidos do formulário
     * e atualiza apenas os valores que foram
     * selecionados no formulário
     *
     * @see Crud_model::Atualizar()
     *
     * @see Main::mensagem()
     *
     * @see Main::painel()
     *
     * @see Main::atualizaSessao()
     *
     * @param void
     *
     * @return void
     */
    public function atualizaDados(){
        $this->Crud_model->tabela = "usuario";

        $usuario = $this->input->post();
        $id = $this->session->userdata('id');
        $usuario = array_filter($usuario);

        if(isset($usuario['senha'])){
            $usuario['senha'] = md5($usuario['senha']);
        }
        // Atualiza dados no banco de dados
        if($this->Crud_model->Atualizar($id, $usuario)){
            // Atualiza dados da sessão
            $this->atualizaSessao($usuario);
            $mensagem['mensagem'] = "Dados atualizados com sucesso!";
            $this->mensagem($mensagem);
            $this->painel();
        }
    }

    /**
     * Atualiza dados da sessão do usuário
     *
     * @param $dados, dados do usuario que serão atualizados na sessão
     */
    public function atualizaSessao($dados){
        if(isset($dados['nome'])     != null) $this->session->set_userdata('nome',     $dados['nome']);
        if(isset($dados['login'])    != null) $this->session->set_userdata('login',    $dados['login']);
        if(isset($dados['email'])    != null) $this->session->set_userdata('email',    $dados['email']);
        if(isset($dados['github'])   != null) $this->session->set_userdata('github',   $dados['github']);
        if(isset($dados['tweeter'])  != null) $this->session->set_userdata('tweeter',  $dados['tweeter']);
        if(isset($dados['facebook']) != null) $this->session->set_userdata('facebook', $dados['facebook']);
        if(isset($dados['imagem'])   != null) $this->session->set_userdata('imagem',   $dados['imagem']);
    }

    /**
     * Cria e define as variáveis de sessão do usuário
     *
     * @param $usuarioDados, dados do usuario que serão adicionados na sessão
     */
    public function defineSessao($usuarioDados){
        $this->session->set_userdata('logado', true);
        $this->session->set_userdata('id', $usuarioDados['id']);
        $this->session->set_userdata('nome', $usuarioDados['nome']);
        $this->session->set_userdata('login', $usuarioDados['login']);
        $this->session->set_userdata('email', $usuarioDados['email']);
        $this->session->set_userdata('github', $usuarioDados['github']);
        $this->session->set_userdata('tweeter', $usuarioDados['tweeter']);
        $this->session->set_userdata('facebook', $usuarioDados['facebook']);
        $this->session->set_userdata('imagem', $usuarioDados['imagem']);
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
            redirect('Entrar');
            $this->mensagem($mensagem);
        }
    }

    /**
     * Destroi a sessão e redireciona
     * para a página principal
     *
     * @param void
     *
     * @return void
     */
    public function deslogar(){
        $this->session->sess_destroy();
        redirect('Main');
    }
}
    