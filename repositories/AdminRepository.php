<?php

include_once (__DIR__ . '/../dbconfig/Dbconfig.php');
include_once (__DIR__ . '/../model/User.php');
include_once (__DIR__ . '/../model/Client.php');
include_once (__DIR__ . '/../model/Gestor.php');
include_once (__DIR__ . '/../model/Aluguer.php');
include_once (__DIR__ . '/../model/Paises.php');
include_once (__DIR__ . './IAdminRepository.php');

class AdminRepository implements IAdminRepository {

    private $db;

    public function __construct() {
        $this->db = Dbconfig::getInstance();
    }

    //Método para registro do cliente
    public function registroCliente(Client $client) {
        try {
            $estado = "inativo";

            //inserindo na tabela usuário
            $stmt = $this->db->prepare("INSERT INTO usuarios (tipo, username, passe, estado, email) VALUES (:tipo, :username, :password, :estado, :email)");
            $stmt->bindValue(':tipo', $client->getType());
            $stmt->bindValue(':username', $client->getUsername());
            $stmt->bindValue(':password', $client->getPassword());
            $stmt->bindValue(':estado', $estado);
            $stmt->bindValue(':email', $client->getEmail());
            $stmt->execute();

            //recuperando o id do usuário que foi inserido
            $stmt2 = $this->db->prepare("SELECT idUsuario FROM usuarios WHERE username = :username");
            $stmt2->bindValue(':username', $client->getUsername());
            $stmt2->execute();
            $fk_usuario = $stmt2->fetchColumn();

            //inserindo na tabela cliente
            $stmt3 = $this->db->prepare("INSERT INTO clientes(nome,tipo,atividade,provincia, municipio, comuna,nacionalidade,morada,email,telefone,username,passe,fk_usuarioC, estado) VALUES(:nome, :tipo, :atividade,"
                    . ":provincia, :municipio, :comuna, :nacionalidade,:morada,:email, :telefone, :username, :password, :user, :estado)");
            $stmt3->bindValue(':nome', $client->getNome());
            $stmt3->bindValue(':tipo', $client->getTipo());
            $stmt3->bindValue(':atividade', $client->getAtividade());
            $stmt3->bindValue(':provincia', $client->getProvincia());
            $stmt3->bindValue(':municipio', $client->getMunicipio());
            $stmt3->bindValue(':comuna', $client->getComuna());
            $stmt3->bindValue(':nacionalidade', $client->getNacionalidade());
            $stmt3->bindValue(':morada', $client->getMorada());
            $stmt3->bindValue(':email', $client->getEmail());
            $stmt3->bindValue(':telefone', $client->getTelefone());
            $stmt3->bindValue(':username', $client->getUsername());
            $stmt3->bindValue(':password', $client->getPassword());
            $stmt3->bindValue(':user', $fk_usuario);
            $stmt3->bindValue(':estado', $estado);
            $stmt3->execute();

            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    //verificar cliente com email existente
    public function verificarCliente($email, $username) {
        try {
            $query = $this->db->prepare("SELECT * FROM clientes WHERE email = :email and username = :username");
            $query->bindParam(':email', $email);
            $query->bindParam(':username', $username);
            $query->execute();

            if ($query->rowCount() > 0) {
                return true; // Email já existe na tabela de clientes
            } else {
                return false; // Email não existe na tabela de clientes
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    //recuperar todos os pais 
    public function recuperarPaises() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM paises");
            $stmt->execute();
            $verif = false;
            $result = $stmt->fetchAll();

            foreach ($result as $pais) {
                $paises[] = new Paises($pais['idPaises'], $pais['nomePaises']);
                $verif = true;
            }
            if ($verif) {
                return $paises;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //Método para registro do gestor
    public function registroGestor(Gestor $gestor) {
        try {
            //inserindo na tabela usuarios
            $stmt = $this->db->prepare("INSERT INTO usuarios (tipo, username, passe, estado, email) VALUES (:tipo, :username, :password, :estado, :email)");

            $stmt->bindValue(':tipo', $gestor->getType());
            $stmt->bindValue(':username', $gestor->getUsername());
            $stmt->bindValue(':password', $gestor->getPassword());
            $stmt->bindValue(':estado', $gestor->getEstado());
            $stmt->bindValue(':email', $gestor->getEmail());
            $stmt->execute();

            //recuperando o id do usuário que foi inserido
            $stmt2 = $this->db->prepare("SELECT idUsuario FROM usuarios WHERE username = :username");
            $stmt2->bindValue(':username', $gestor->getUsername());
            $stmt2->execute();
            $fk_usuario = $stmt2->fetchColumn();

            //inserindo na tabela gestores
            $stmt3 = $this->db->prepare("INSERT INTO gestores (nome, provincia, municipio, comuna, morada, email, telefone, username, passe, fk_usuarioG, estado) VALUES (:nome, :provincia, :municipio, :comuna, :morada, :email, :telefone, :username, :password, :user, :estado)");
            $stmt3->bindValue(':nome', $gestor->getNome());
            $stmt3->bindValue(':provincia', $gestor->getProvincia());
            $stmt3->bindValue(':municipio', $gestor->getMunicipio());
            $stmt3->bindValue(':comuna', $gestor->getComuna());
            $stmt3->bindValue(':morada', $gestor->getMorada());
            $stmt3->bindValue(':email', $gestor->getEmail());
            $stmt3->bindValue(':telefone', $gestor->getTelefone());
            $stmt3->bindValue(':username', $gestor->getUsername());
            $stmt3->bindValue(':password', $gestor->getPassword());
            $stmt3->bindValue(':user', $fk_usuario);
            $stmt3->bindValue(':estado', $gestor->getEstado());
            $stmt3->execute();
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    //Método para apagar gestor
    public function apagarGestor($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM gestores WHERE fk_usuarioG = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt1 = $this->db->prepare("DELETE FROM usuarios WHERE idUsuario = :id");
            $stmt1->bindParam(':id', $id);
            $stmt1->execute();
            return true;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            return false;
        }
    }

    //verificar gestor com email existente
    public function verificarGestor($email) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM gestores WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                return true; // Email já existe na tabela de gestor
            } else {
                return false; // Email não existe na tabela de gestor
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    //Método para ativar e desativar contas dos clientes
    public function ativaDesativaConta($username) {
        try {
            $stmt = $this->db->prepare("SELECT estado FROM usuarios WHERE username = :user");
            $stmt->bindParam(':user', $username);
            $stmt->execute();

            $estado = $stmt->fetchColumn();
            if ($estado === "inativo") {
                //alterando o estado do cliente na tabela usuarios (que permite fazer o login)
                $stmt1 = $this->db->prepare("UPDATE usuarios SET estado = 'ativo' WHERE username = :username");
                $stmt1->bindParam(':username', $username);
                $stmt1->execute();

                //alterando o estado do cliente na tabela clientes 
                $stmt2 = $this->db->prepare("UPDATE clientes SET estado = 'ativo' WHERE username = :username");
                $stmt2->bindParam(':username', $username);
                $stmt2->execute();
            } else if ($estado === "ativo") {
                //alterando o estado do cliente na tabela usuarios (que permite fazer o login)
                $stmt1 = $this->db->prepare("UPDATE usuarios SET estado = 'inativo' WHERE username = :username");
                $stmt1->bindParam(':username', $username);
                $stmt1->execute();

                //alterando o estado do cliente na tabela clientes 
                $stmt2 = $this->db->prepare("UPDATE clientes SET estado = 'inativo' WHERE username = :username");
                $stmt2->bindParam(':username', $username);
                $stmt2->execute();
            }
            ?>
            <script> alert("Operação realizada com sucesso!");</script>
            <?php

            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            ?>
            <script> alert("Erro ao ativar ou desativar a conta.");</script>
            <?php

            return false;
        }
    }

    //Método para recuperar todos os clientes criados 
    public function recuperarClientes() {
        try {
            $stmt = $this->db->prepare("SELECT idCliente, nome, username, estado FROM clientes");
            $stmt->execute();

            $clientes = array();
            $res = $stmt->fetchAll();
            foreach ($res as $resultado) {

                $cliente = new Client();
                $cliente->setIdCliente($resultado['idCliente']);
                $cliente->setNome($resultado['nome']);
                $cliente->setUsername($resultado['username']);
                $cliente->setEstadoC($resultado['estado']);
                $clientes[] = $cliente;
            }

            return $clientes;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    //Método para verificar o estado do gestor
    public function verificaEstadoCliente($id) {
        try {
            $stmt = $this->db->prepare("SELECT estado FROM clientes WHERE fk_usuarioC = :id and estado = 'inativo'");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetchColumn();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function recuperarClientebyUsername($username) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM clientes WHERE username = :user");
            $stmt->bindParam(':user', $username);
            $stmt->execute();
            $resultado = $stmt->fetch();

            $cliente = new Client();
            $cliente->setIdCliente($resultado['idCliente']);
            $cliente->setNome($resultado['nome']);
            $cliente->setTipo($resultado['tipo']);
            $cliente->setAtividade($resultado['atividade']);
            $cliente->setProvincia($resultado['provincia']);
            $cliente->setMunicipio($resultado['municipio']);
            $cliente->setComuna($resultado['comuna']);
            $cliente->setNacionalidade($resultado['nacionalidade']);
            $cliente->setMorada($resultado['morada']);
            $cliente->setEmail($resultado['email']);
            $cliente->setTelefone($resultado['telefone']);
            $cliente->setUsername($resultado['username']);
            $cliente->setPassword($resultado['passe']);

            return $cliente;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //Método para retornar o id recebendo o username
    public function recuperarIdUsuariobyUsername($username) {
        try {
            $stmt = $this->db->prepare("SELECT idUsuario FROM usuarios WHERE username = :user");
            $stmt->bindParam(':user', $username);
            $stmt->execute();

            return $stmt->fetchColumn();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    //Método para retornar o id recebendo o username
    public function recuperarGestorbyUsername($username) {
        try {
            $stmt = $this->db->prepare("SELECT idGestor FROM gestores WHERE username = :user");
            $stmt->bindParam(':user', $username);
            $stmt->execute();

            return $stmt->fetchColumn();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    //Método para recuperar todos os gestores criados 
    public function recuperarGestores() {
        try {
            $stmt = $this->db->prepare("SELECT nome, username, email, estado FROM gestores");
            $stmt->execute();

            $gestores = array();
            $res = $stmt->fetchAll();

            foreach ($res as $resultado) {
                $gestor = new Gestor();
                $gestor->setNome($resultado['nome']);
                $gestor->setUsername($resultado['username']);
                $gestor->setEmail($resultado['email']);
                $gestor->setEstado($resultado['estado']);
                $gestores[] = $gestor;
            }

            return $gestores;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
    
    //
    public function recuperarGestoresbyUsername($username) {
        try {
            $stmt = $this->db->prepare("SELECT idGestor FROM gestores WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->excute();
            
            return true;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            return false;
        }
        }
    //Método para trocar o email do admin
    public function trocarEmailAdm(User $user) {
        try {
            $stmt = $this->db->prepare("UPDATE usuarios SET email = :email WHERE username = :user");
            $stmt->bindParam(':email', $user->getEmail());
            $stmt->bindParam(':user', $user->getUsername());
            $stmt->execute();

            return true;
        } catch (Exception $e) {
            $e->getMessage();
            return false;
        }
    }

    //Método para obter o email do administrador 
    public function recuperarEmailAdm() {
        try {
            $stmt = $this->db->prepare("SELECT email FROM usuarios WHERE username = 'admin'");
            $stmt->execute();

            return $stmt->fetchColumn();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    //Método para editar os dados de registo do cliente
    public function editarCliente(Client $client) {
        try {
            $stmt = $this->db->prepare("UPDATE usuarios SET passe = :pass, email = :email WHERE username = :user");
            $stmt->bindValue(':pass', $client->getPassword());
            $stmt->bindValue(':email', $client->getEmail());
            $stmt->bindValue(':user', $client->getUsername());
            $stmt->execute();

            $stmt1 = $this->db->prepare("UPDATE clientes SET nome = :nome ,tipo = :tipo , atividade = :atividade ,provincia = :provincia ,municipio = :municipio,"
                    . " comuna = :comuna, nacionalidade = :nacionalidade, morada = :morada , email = :email, telefone = :telefone, passe = :pass WHERE idCliente = :id");
            $stmt1->bindValue(':nome', $client->getNome());
            $stmt1->bindValue(':tipo', $client->getTipo());
            $stmt1->bindValue(':atividade', $client->getAtividade());
            $stmt1->bindValue(':provincia', $client->getProvincia());
            $stmt1->bindValue(':municipio', $client->getMunicipio());
            $stmt1->bindValue(':comuna', $client->getComuna());
            $stmt1->bindValue(':nacionalidade', $client->getNacionalidade());
            $stmt1->bindValue(':morada', $client->getMorada());
            $stmt1->bindValue(':email', $client->getEmail());
            $stmt1->bindValue(':telefone', $client->getTelefone());
            $stmt1->bindValue(':pass', $client->getPassword());
            $stmt1->bindValue(':id', $client->getIdCliente());
            $stmt1->execute();

            return true;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            return false;
        }
    }

    public function solicitarOutdoor($dataI, $dataF, $pagamento, $fk_outdoor, $fk_cliente) {
        try {
            //Obtendo a chave do gestor
            $controller = new GestorController();
            $fk_gestor = $controller->recuperarGestorBySolic();

            //inserindo na tabela de pedidos
            $stmt1 = $this->db->prepare("INSERT INTO pedidos (dataI, dataF, pagamento, fk_outdoor, fk_cliente, fk_gestor) VALUES (:dataI, :dataF, :pagamento, :outdoor, :cliente, :gestor)");
            $stmt1->bindParam(':dataI', $dataI);
            $stmt1->bindParam(':dataF', $dataF);
            $stmt1->bindParam(':pagamento', $pagamento);
            $stmt1->bindParam(':outdoor', $fk_outdoor);
            $stmt1->bindParam(':cliente', $fk_cliente);
            $stmt1->bindParam(':gestor', $fk_gestor);
            $stmt1->execute();

            //mudando o estado do outdoor
            $stmt2 = $this->db->prepare("UPDATE outdoors SET estado = 'aguardando' WHERE idOutdoor = :id");
            $stmt2->bindParam(':id', $fk_outdoor);
            $stmt2->execute();

            //aumentando o número de solicitações do gestor
            $stmt3 = $this->db->prepare("UPDATE gestores SET contSolic = (contSolic+1) WHERE idGestor = :id");
            $stmt3->bindParam(':id', $fk_gestor);
            $stmt3->execute();

            return true;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            return false;
        }
    }

    public function recuperarIdClienteByUsername($username) {
        try {
            $stmt = $this->db->prepare("SELECT idCliente FROM clientes WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            return $stmt->fetchColumn();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function recuperarSolicitacoesCliente($id) {
        try {
            $stmt = $this->db->prepare("SELECT p.dataI, p.dataF, p.pagamento,
                (SELECT g.nome FROM gestores g WHERE g.idGestor = p.fk_gestor) AS nome_gestor,
                (SELECT o.tipo FROM outdoors o WHERE o.idOutdoor = p.fk_outdoor) AS tipo,
                (SELECT o.provincia FROM outdoors o WHERE o.idOutdoor = p.fk_outdoor) AS provincia,
                (SELECT o.municipio FROM outdoors o WHERE o.idOutdoor = p.fk_outdoor) AS municipio,
                (SELECT o.comuna FROM outdoors o WHERE o.idOutdoor = p.fk_outdoor) AS comuna
                FROM pedidos p,outdoors
                    WHERE p.fk_cliente = :id and estado = 'aguardando';");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $alugueres = array();
            foreach ($resultado as $valor) {
                $aluguer = new Aluguer();
                $aluguer->setDataI($valor['dataI']);
                $aluguer->setDataF($valor['dataF']);
                $aluguer->setPagamento($valor['pagamento']);
                $aluguer->setNome_gestor($valor['nome_gestor']);
                $aluguer->setTipoDeOutdoor($valor['tipo']);
                $aluguer->setProvincia($valor['provincia']);
                $aluguer->setMunicipio($valor['municipio']);
                $aluguer->setComuna($valor['comuna']);
                $alugueres [] = $aluguer;
            }
            return $alugueres;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            return false;
        }
    }

    public function controleNumeroPedidos($id) {
        try {
            //Verificando o número máximo de pedidos de um determinado cliente para acrescer no que ele já tem
            $stmt = $this->db->prepare("SELECT MAX(numeroPedidos) numpedidos FROM pedidos WHERE fk_cliente = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $numeroPedido = $stmt->fetchColumn();

            //Verificando se é o primeiro pedido do cliente
            if ($numeroPedido != 0) {
                $numeroPedido += 1;
            } else {
                $numeroPedido = 1;
            }

            return $numeroPedido;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    //SELECT tipoUsuario FROM usuario WHERE username = :user
    //Método ao auxiliar para verificar se o cliente já fez algum pedido 
    public function verificaPrimeiroPedido($id) {
        try {
            $stmt = $this->db->prepare("SELECT fk_cliente FROM pedidos WHERE fk_cliente = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            if ($stmt->fetchColumn() == NULL) {
                //Não fez pedido 
                return true;
            } else {
                //já fez pedido 
                return false;
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function submeterComprovativo($id) {
        try {
            $stmt = $this->db->prepare("UPDATE outdoors SET estado = 'validando' WHERE idOutdoor = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return true;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            return false;
        }
    }

    public function recuperarEstadoOutdoor($id) {
        try {
            $stmt = $this->db->prepare("SELECT estado FROM outdoors WHERE idOutdoor = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetchColumn();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }
    
    public function recuperarMeusOutdoors($id) {
        try {
            $stmt = $this->db->prepare("SELECT p.dataI, p.dataF, p.pagamento,
                (SELECT g.nome FROM gestores g WHERE g.idGestor = p.fk_gestor) AS nome_gestor,
                (SELECT o.tipo FROM outdoors o WHERE o.idOutdoor = p.fk_outdoor) AS tipo,
                (SELECT o.provincia FROM outdoors o WHERE o.idOutdoor = p.fk_outdoor) AS provincia,
                (SELECT o.municipio FROM outdoors o WHERE o.idOutdoor = p.fk_outdoor) AS municipio,
                (SELECT o.comuna FROM outdoors o WHERE o.idOutdoor = p.fk_outdoor) AS comuna
                FROM pedidos p,outdoors
                    WHERE p.fk_cliente = :id and estado = 'ocupado';");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $alugueres = array();
            foreach ($resultado as $valor) {
                $aluguer = new Aluguer();
                $aluguer->setDataI($valor['dataI']);
                $aluguer->setDataF($valor['dataF']);
                $aluguer->setPagamento($valor['pagamento']);
                $aluguer->setNome_gestor($valor['nome_gestor']);
                $aluguer->setTipoDeOutdoor($valor['tipo']);
                $aluguer->setProvincia($valor['provincia']);
                $aluguer->setMunicipio($valor['municipio']);
                $aluguer->setComuna($valor['comuna']);
                $alugueres [] = $aluguer;
            }
            return $alugueres;
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        }

}
