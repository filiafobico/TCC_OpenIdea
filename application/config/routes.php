<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'main';

$route['Entrar'] = 'main/entrar';
$route['Inscrever'] = 'main/inscrever';
$route['Painel'] = 'Main/painel';
$route['Painel/(:num)'] = 'Main/painel/$1';
$route['Perfil'] = 'Main/painel';

$route['Atualizar'] = 'Main/atualizaDados';
$route['Inserir'] = 'Main/adicionarUsuario';
$route['Logar'] = 'Main/logarEntrar';
$route['Sair'] = 'Main/deslogar';

$route['Ideias'] = 'Ideia/ideias';
$route['Ideias/(:num)'] = 'Ideia/ideias/$1';
$route['Deletar-Ideia/(:num)'] = 'Ideia/deletar/$1';
$route['Ver-Ideia/(:num)'] = 'Ideia/verIdeia/$1';
$route['Cadastrar-Ideia'] = 'Ideia/cadastrarIdeia';
$route['Inserir-Ideia-Banco'] = 'Ideia/inserirIdeiaBanco';
$route['Atualizar-Ideia-Banco/(:num)'] = 'Ideia/atualizar/$1';

$route['Projetos'] = 'Projeto/projetos';
$route['Projetos/(:num)'] = 'Projeto/projetos/$1';
$route['Ver-Projeto/(:num)'] = 'Projeto/verProjeto/$1';
$route['Deletar-Projeto/(:num)'] = 'Projeto/deletar/$1';
$route['Cadastrar-Projeto'] = 'Projeto/cadastrarProjeto';
$route['Inserir-Projeto-Banco'] = 'Projeto/inserirProjetoBanco';
$route['Atualizar-Projeto-Banco/(:num)'] = 'Projeto/atualizarProjeto/$1';

$route['Ideias-Comunidade'] = 'Ideia/ideiasComunidade';
$route['Ideias-Comunidade/(:num)'] = 'Ideia/ideiasComunidade/$1'; 

$route['Projetos-Comunidade'] = 'Projeto/projetosComunidade';
$route['Projetos-Comunidade/(:num)'] = 'Projeto/projetosComunidade/$1';

$route['Usuarios-Comunidade'] = 'Main/usuarioComunidade';
$route['Usuarios-Comunidade/(:num)'] = 'Main/usuarioComunidade/$1';

$route['Comentar-Ideia/(:num)'] = 'Ideia/comentarIdeia/$1';
$route['Comentar-Projeto/(:num)'] = 'Projeto/comentarProjeto/$1';

$route['Deletar-Arquivo/(:num)'] = 'Projeto/deletarArquivo/$1';

$route['Deletar-Avaliacao-Projeto/(:num)'] = 'Projeto/deletarAvaliacao/$1';
$route['Deletar-Avaliacao-Ideia/(:num)'] = 'Ideia/deletarAvaliacao/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
