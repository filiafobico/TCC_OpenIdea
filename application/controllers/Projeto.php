 <?php
/**
 * Documento de funções da Classe Projeto
 * @author Luis Eduardo Oliveira
 * @version 0.1
 * @package controllers
 * @copyright Copyright (c) 2014 - 2017
 */
class Projeto extends CI_Controller
{
    function __construct(){
        parent::__construct();
        $this->load->model('Crud_model');

        $config['upload_path'] = './arquivos/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png|zip|pdf|odt|docx|text/x-c|text/plain';

        $this->load->library('upload',$config);
    }

/******************************************* Views do Controller Projeto ***********************************************/
    /**
     * View de cadastro de projetos
     * se essa view receber dados de post
     * sera colocado como valor do ideia,
     * no formaulario, a ser criada
     * 
     * @param void
     *
     * @return void
     */
    public function cadastrarProjeto(){
        $this->estaLoggado();

        $data['title'] = "Open Idea";
        $data['sub_title'] = "  | Cadastrar Projeto";
        $this->load->view('util/cabecalhoCadastros', $data);
        
        if($this->input->post() != null){
            $this->load->view('projeto/cadastrarProjeto', $this->input->post());
        }else{ 
            $this->load->view('projeto/cadastrarProjeto');
        }
        $this->load->view('util/rodape');
    }

    /**
     * View de listagem de projetos
     * Lista todos os projetos a partir da id do usuario logado no sistema
     *
     * @see Projeto::ListarProjetos()
     *
     * @param void
     *
     * @return void
     */
    public function projetos(){
        $this->Crud_model->tabela = "projeto";
        $this->estaLoggado();

        $id = $this->session->userdata('id');
        $condicao = "usuario_id=$id";
        $projetos = $this->ListarProjetos('Projetos', $condicao);

        $data['title'] = "Open Idea";
        $data['sub_title'] = " | Lista de Projetos";
        $this->load->view('util/cabecalhoPainel', $data);
        $this->load->view('projeto/painelProjetos', $projetos);
        $this->load->view('util/rodape');
    }

    /**
     * View para ver o projetos e editar
     * Caso quem esteja vendo o projeto seja o dono 
     * ele pode editar o projeto também
     *
     * @see Projeto::estaLoggado()
     *
     * @see Crud_model::GetById()
     *
     * @param void
     *
     * @return void
     */
    public function verProjeto(){
        $this->estaLoggado();

        $this->Crud_model->tabela = "projeto";
        $id = $this->uri->segment("2");
        $projeto = $this->Crud_model->getById($id);

        $title['title'] = "Open Idea";
        $title['sub_title'] = " | Ver Projeto";
        $this->load->view('util/cabecalhoPainel', $title);
        $this->load->view('projeto/editarProjeto', $projeto);
        $this->load->view('util/comentarios');
        $this->load->view('util/rodape');
    }

    /**
     * View para a listagem dos projetos da comunidade
     * Verifica se foi feita uma pesquisa para a listagem,
     * caso tenha sido feita, retorna os resultados a partir da pesquisa
     * caso contrario, retorna todos os projetos
     *
     * @see Projeto::tratarPesquisa()
     *
     * @see Projeto::ListarProjetos()
     *
     * @param void
     *
     * @return void
     */
    public function projetosComunidade(){
        $cond = '1 = 1';

        if($this->input->post()){
            $cond = $this->tratarPesquisa($this->input->post());
        }

        $projetos = $this->ListarProjetos('Projetos-Comunidade', $cond);

        $title['title'] = "Open Idea";
        $title['sub_title'] = " | Projetos da Comunidade";
        $this->load->view('util/comunidadePainel', $title);
        $this->load->view('projeto/comunidadeProjetos', $projetos);
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
    public function comentarProjeto(){
        $data = $this->input->post();
        $this->Crud_model->tabela = 'avaliacaoProjeto';

        if($this->Crud_model->Inserir($data)){
            $mensagem['mensagem'] = "Comentario adicionado com sucesso!";
            redirect(base_url('Ver-Projeto/' . $data['projeto_id'] . '#avaliacao'));
            $this->mensagem($mensagem);
        }
    }

    /**
     * Adiciona um novo projeto no banco
     * verifica se o arquivo foi mandado pelo formulário
     * caso tenha sido mandado, insere o resgistro no banco
     * e retorna a mensagem de sucesso para a tela
     *
     * @see Crud_model::$tabela
     *
     * @see Crud_model::Inserir()
     *
     * @see Projeto::mensagem()
     *
     * @see Projeto::cadastrarProjeto()
     *
     * @param void
     *
     * @return void
     */
    public function inserirProjetobanco(){
        $this->Crud_model->tabela = "projeto";
        // Testa se o arquivo foi upado com sucesso
        if($this->upload->do_upload('arquivo')){
            $projeto = $this->input->post();
            $projeto['usuario_id'] = $this->session->userdata('id');
            $projeto['imagem'] = "../arquivos/imagens/padrao.png";

            $this->Crud_model->Inserir($projeto);

            $arquivo['projeto_id'] = $this->db->insert_id();
            $data = array('upload_data' => $this->upload->data());
            $data = $data['upload_data'];
            $arquivo['nome'] = $data['file_name'];
            $arquivo['endereco'] = $data["file_path"];

            $this->Crud_model->tabela = "Arquivos";

            if($this->Crud_model->Inserir($arquivo)){
                $mensagem['mensagem'] = "Projeto adicionado com sucesso!";
                $this->mensagem($mensagem);
                $this->cadastrarProjeto();
            }
        }else{
            $mensagem['mensagem'] = "Ops, algo deu errado";
            $mensagem['informacao'] = "Tente novamente <br> Dica: Você preencheu todos os campos e selecionou o arquivo do projeto?<br> Selecionou ou arquivo de tipo válido?";
            $this->mensagem($mensagem);
            $this->cadastrarProjeto();
        }
    }

    /**
     * Atualiza registro de projeto
     * adiciona mais um arquivo, caso tenha sido selecionado
     *
     * @see  Crud_model::$tabela
     *
     * @see Crud_model::Atualizar()
     *
     * @see Crud_model::Inserir()
     *
     * @see Projeto::mensagem()
     *
     * @see Projeto::verProjeto()
     *
     * @param void
     *
     * @return void
     */
    public function atualizarProjeto(){
        $data = $this->input->post();
        $id = $this->uri->segment("2"); 

        $this->Crud_model->tabela = "projeto";
        $this->Crud_model->Atualizar($id, $data);

        // Testa se o arquivo foi upado com sucesso
        if($this->upload->do_upload('arquivo')){
            $dataArq = array('upload_data' => $this->upload->data());
            $dataArq = $dataArq['upload_data'];
            
            $arquivo['nome'] = $dataArq['file_name'];
            $arquivo['endereco'] = $dataArq["file_path"];
            $arquivo['projeto_id'] = $id;

            $this->Crud_model->tabela = "Arquivos";
            $arq = $this->Crud_model->Inserir($arquivo);
        }
        $mensagem['mensagem'] = "Projeto atualizado com sucesso!";
        $this->mensagem($mensagem);
        $this->verProjeto();
    }

     /**
      * Configuração para exibição dos projetos e páginação
      *
      * @param $pagina, Pagina de retorno da funcao
      *
      * @param $condicao, define o delimitador das funções 'contaRegistro' e 'Listar'
      *
      * @see Crud_model::contaRegistros()
      *
      * @see Crud_model::Listar()
      *
      * @return mixed Registros do banco para serem listados na tela
     */
    public function ListarProjetos($pagina, $condicao){
        $this->Crud_model->tabela = "projeto";
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

        $projetos['paginacao'] =  $this->pagination->create_links();
        $projetos['projeto'] = $this->Crud_model->Listar($maximo, $inicio, $condicao);

        return $projetos;
    }

    /**
     * Função para deletar arquivo de um projeto
     *
     * @see Crud_model::GetById()
     *
     * @see Crud_model::Excluir()
     *
     * @param void
     *
     * @return void
     */
    public function deletarArquivo(){
        $id = $this->uri->segment("2");
        
        $this->Crud_model->tabela = 'Arquivos';
        $projId = $this->Crud_model->getById($id);
        
        $condicao = "id=$id";
        $this->Crud_model->Excluir($condicao);

        redirect('Ver-Projeto/' . $projId['projeto_id']);
    }

    /**
     * Função para deletar comentário de um projeto
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
        
        $this->Crud_model->tabela = 'avaliacaoProjeto';
        $projId = $this->Crud_model->getById($id);
        
        $condicao = "id=$id";
        $this->Crud_model->Excluir($condicao);

        redirect(base_url('Ver-Projeto/' . $projId['projeto_id']));
    }

    /**
     * Função para deletar registro de projeto
     * exclui os arquivos relacionados ao projeto
     * exclui as avaliacos relacionadas ao projeto
     * por ultimo, exclui o registro do projeto
     *
     * @see Crud_model::Excluir()
     *
     * @see Projeto::cadastrarProjeto()
     *
     * @see Projeto::mensagem()
     *
     * @param void
     *
     * @return void
     */
    public function deletar(){
        $id = $this->uri->segment("2");
        
        $condicao = "projeto_id=$id";
        $this->Crud_model->tabela = 'Arquivos';
        $this->Crud_model->Excluir($condicao);

        $this->Crud_model->tabela = 'avaliacaoProjeto';
        $this->Crud_model->Excluir($condicao);

        $condicao = "id=$id";
        $this->Crud_model->tabela = 'projeto';
        $this->Crud_model->Excluir($condicao);

        $mensagem['mensagem'] = "Projeto apagado com sucesso!";
        $mensagem['informacao'] = "Aproveite para criar um novo projeto";
        $this->cadastrarProjeto();
        $this->mensagem($mensagem);
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
