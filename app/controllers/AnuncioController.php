<?php
class AnuncioController {
    public function listar() {
        $filtros = [];
        if (isset($_GET['marca'])) $filtros['marca'] = $_GET['marca'];
        if (isset($_GET['modelo'])) $filtros['modelo'] = $_GET['modelo'];
        if (isset($_GET['cidade'])) $filtros['cidade'] = $_GET['cidade'];

        $anuncios = Anuncio::getAll($filtros);
        Response::json(['success' => true, 'data' => $anuncios]);
    }

    public function listarMeus() {
        Session::requireAuth();
        $idUsuario = Session::get('user_id');
        $anuncios = Anuncio::getByUsuario($idUsuario);
        Response::json(['success' => true, 'data' => $anuncios]);
    }

    public function detalhes($id) {
        $anuncio = Anuncio::getById($id);
        if ($anuncio) {
            Response::json(['success' => true, 'data' => $anuncio]);
        } else {
            Response::json(['success' => false, 'message' => 'Anúncio não encontrado'], 404);
        }
    }

    public function marcas() {
        Response::json(['success' => true, 'data' => Anuncio::getMarcas()]);
    }

    public function modelos() {
        $marca = isset($_GET['marca']) ? $_GET['marca'] : null;
        Response::json(['success' => true, 'data' => Anuncio::getModelos($marca)]);
    }

    public function cidades() {
        $modelo = isset($_GET['modelo']) ? $_GET['modelo'] : null;
        Response::json(['success' => true, 'data' => Anuncio::getCidades($modelo)]);
    }

    public function criar() {
        Session::requireAuth();

        // O formulário usa multipart/form-data por causa das imagens
        // Então os dados estarão em $_POST
        if (empty($_POST['marca']) || empty($_POST['modelo'])) {
            Response::json(['success' => false, 'message' => 'Preencha todos os campos obrigatórios.'], 400);
        }

        if (empty($_FILES['fotos']['name'][0]) || count(array_filter($_FILES['fotos']['name'])) < 3) {
            Response::json(['success' => false, 'message' => 'Envie pelo menos 3 fotos do veículo.'], 400);
        }

        $idUsuario = Session::get('user_id');
        
        $db = Database::getConnection();
        $db->beginTransaction();

        try {
            $idAnuncio = Anuncio::create($_POST, $idUsuario);

            // Upload de imagens
            $uploadDir = __DIR__ . '/../../public/uploads/veiculos/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            foreach ($_FILES['fotos']['tmp_name'] as $key => $tmp_name) {
                if ($_FILES['fotos']['error'][$key] == 0) {
                    $ext = pathinfo($_FILES['fotos']['name'][$key], PATHINFO_EXTENSION);
                    $nomeArquivo = uniqid('foto_') . '.' . $ext;
                    move_uploaded_file($tmp_name, $uploadDir . $nomeArquivo);
                    Foto::create($idAnuncio, $nomeArquivo);
                }
            }

            $db->commit();
            Response::json(['success' => true, 'message' => 'Anúncio criado com sucesso!']);
        } catch (Exception $e) {
            $db->rollBack();
            Response::json(['success' => false, 'message' => 'Erro ao criar anúncio: ' . $e->getMessage()], 500);
        }
    }

    public function excluir($id) {
        Session::requireAuth();
        $idUsuario = Session::get('user_id');

        // Busca fotos para deletar do disco (simplificado)
        $anuncio = Anuncio::getById($id);
        if ($anuncio && $anuncio['IdAnunciante'] == $idUsuario) {
            $sucesso = Anuncio::delete($id, $idUsuario);
            if ($sucesso) {
                Response::json(['success' => true, 'message' => 'Anúncio deletado.']);
            }
        }
        Response::json(['success' => false, 'message' => 'Erro ao deletar anúncio.'], 400);
    }
}
?>
