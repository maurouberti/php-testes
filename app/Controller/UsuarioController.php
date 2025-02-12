<?php

namespace App\Controller;

use App\Repository\UsuarioRepository;

class UsuarioController extends Controller
{
  public function home($params)
  {
    $this->response(201);
  }

  public function list($params)
  {
    $db = new UsuarioRepository();
    $data = $db->list($params->pagina);
    return $data === false ? $this->response(400, "Erro ao listar.") : $this->response(200, null, $data);
  }

  public function store($params)
  {
    $db = new UsuarioRepository();
    $saved = $db->new($params->name, $params->email, $params->password);
    return $saved ? $this->response(200, 'Usuário gravado com sucesso.') : $this->response(400, 'Erro ao gravar usuário.');
  }

  public function login($params)
  {
    $db = new UsuarioRepository();
    $valid = $db->validate($params->email, $params->password);
    return $valid ? $this->response(200, 'Usuário autenticado com sucesso.') : $this->response(403, 'E-mail ou senha inválidos.');
  }
}
