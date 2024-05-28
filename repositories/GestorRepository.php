<?php
include_once (__DIR__ . '/../model/Client.php');
include_once (__DIR__ . '/../model/Gestor.php');
include_once (__DIR__ . '/../model/Outdoor.php');
include_once (__DIR__ . './IGestorRepository.php');
include_once (__DIR__ . '/../dbconfig/Dbconfig.php');

class GestorRepository implements IGestorRepository {

    private $db;

    public function __construct() {
        $this->db = Dbconfig::getInstance();
    }

    //Método que insere outdoor na base de dados
    public function registroOutdoor(Outdoor $outdoor) {
        try {
            $stmt = $this->db->prepare("INSERT INTO outdoors (tipo,  provincia, municipio, comuna,preco, estado) VALUES (:tipo, :provincia, :municipio, :comuna, :preco, :estado)");
            $stmt->bindValue(':tipo', $outdoor->getTipoOutdoor());
            $stmt->bindValue(':provincia', $outdoor->getProvinciaO());
            $stmt->bindValue(':municipio', $outdoor->getMunicipioO());
            $stmt->bindValue(':comuna', $outdoor->getComunaO());
            $stmt->bindValue(':preco', $outdoor->getPreco());
            $stmt->bindValue(':estado', $outdoor->getEstado());
            $stmt->execute();

            return true;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return false;
        }
    }

    //Método que lista todos os outdoors criados 
    public function recuperarOutdoors() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM outdoors");
            $stmt->execute();
            $outdoors = $stmt->fetchAll();
            $existe = false;

            foreach ($outdoors as $outdoor) {
                //$idOutdoor, $tipoOutdoor, $preco, $estado, $provincia, $municipio, $comuna
                $result [] = new Outdoor($outdoor['idOutdoor'], $outdoor['tipo'], $outdoor['preco'], $outdoor['estado'], $outdoor['provincia'], $outdoor['municipio'], $outdoor['comuna']);
                $existe = true;
            }
            if ($existe) {
                return $result;
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    //Método que lista todos os outdoors criados 
    public function recuperarOutdoorsDisp() {
        try {
            $stmt = $this->db->prepare("SELECT * FROM outdoors WHERE estado='disponivel'");
            $stmt->execute();

            $outdoors = array();
            $res = $stmt->fetchAll();
            foreach ($res as $resultado) {

                $outdoor = new Outdoor();
                $outdoor->setIdOutdoor($resultado['idOutdoor']);
                $outdoor->setTipoOutdoor($resultado['tipo']);
                $outdoor->setProvinciaO($resultado['provincia']);
                $outdoor->setMunicipioO($resultado['municipio']);
                $outdoor->setComunaO($resultado['comuna']);
                $outdoor->setPreco($resultado['preco']);
                $outdoor->setEstado($resultado['estado']);
                $outdoors[] = $outdoor;
            }

            return $outdoors;
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public function apagarOutdoor($id) {
        try {
            $stmt = $this->db->prepare("DELETE FROM outdoors WHERE idOutdoor = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function editarOutdoor(Outdoor $outdoor) {
        try {
            $stmt = $this->db->prepare("UPDATE outdoors SET tipo = :tipo,  provincia = :provincia, municipio = :municipio, comuna = :comuna, preco = :preco, estado = :estado WHERE idOutdoor = :id");
            $stmt->bindValue(':tipo', $outdoor->getTipoOutdoor());
            $stmt->bindValue(':provincia', $outdoor->getProvinciaO());
            $stmt->bindValue(':municipio', $outdoor->getMunicipioO());
            $stmt->bindValue(':comuna', $outdoor->getComunaO());
            $stmt->bindValue(':preco', $outdoor->getPreco());
            $stmt->bindValue(':estado', $outdoor->getEstado());
            $stmt->bindValue(':id', $outdoor->getIdOutdoor());
            $stmt->execute();
            ?>
            <script> alert("Edição feita com sucesso! - <?php echo $outdoor->getIdOutdoor(); ?>");</script>
            <?php
            return true;
        } catch (Exception $e) {
            echo $e->getMessage();
            ?>
            <script> alert("Erro na edição do outdoor!");</script>
            <?php
            return false;
        }
    }

    public function recuperarOutdoorbyId($id) {
        try {
            $stmt = $this->db->prepare("SELECT * FROM outdoors WHERE idOutdoor = :idOutdoor");
            $stmt->bindParam(':idOutdoor', $id);
            $stmt->execute();
            $resultado = $stmt->fetch();

            $outdoor = new Outdoor();
            $outdoor->setIdOutdoor($resultado['idOutdoor']);
            $outdoor->setTipoOutdoor($resultado['tipo']);
            $outdoor->setProvinciaO($resultado['provincia']);
            $outdoor->setMunicipioO($resultado['municipio']);
            $outdoor->setComunaO($resultado['comuna']);
            $outdoor->setPreco($resultado['preco']);
            $outdoor->setEstado($resultado['estado']);

            return $outdoor;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //Método para verificar o estado do gestor
    public function verificaEstadoGestor($id) {
        try {
            $stmt = $this->db->prepare("SELECT estado FROM gestores WHERE fk_usuarioG = :id and estado = 'inativo'");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetchColumn();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function trocarPass($password, $id) {
        try {
            $stmt = $this->db->prepare("UPDATE gestores SET passe = :pass, estado = 'ativo' WHERE fk_usuarioG = :id");
            $stmt->bindParam(':pass', $password);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt1 = $this->db->prepare("UPDATE usuarios SET passe = :pass, estado = 'ativo' WHERE idUsuario = :id");
            $stmt1->bindParam(':pass', $password);
            $stmt1->bindParam(':id', $id);
            $stmt1->execute();

            return true;
        } catch (Exception $e) {
            $e->getMessage();
            return false;
        }
    }

    public function recuperarGestorBySolic() {
        try {
            $stmt = $this->db->prepare("SELECT idGestor FROM gestores WHERE contSolic = (SELECT MIN(contSolic) FROM gestores)");
            $stmt->execute();

            $ids = array();
            while ($resultado = $stmt->fetch()) {
                $ids[] = $resultado['idGestor'];
            }

            return $ids[array_rand($ids)];
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function recuperarNumeroSolic($id) {
        try {
            $stmt = $this->db->prepare("SELECT contSolic FROM gestores WHERE idGestor = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetch();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function incrementarNumeroSolic($fk_gestor) {
        try {
            //aumentando o número de solicitações do gestor
            $stmt = $this->db->prepare("UPDATE gestores SET contSolic = (contSolic+1) WHERE idGestor = :id");
            $stmt->bindParam(':id', $fk_gestor);
            $stmt->execute();
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function validarPagamento($id) {
        try {
            $stmt = $this->db->prepare("UPDATE outdoors SET estado = 'ocupado' WHERE idOutdoor = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            return true;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            return false;
        }
    }

    public function negarPagamento($id) {
        try {
            $stmt = $this->db->prepare("UPDATE outdoors SET estado = 'disponivel' WHERE idOutdoor = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return true;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            return false;
        }
    }
   
    public function recuperarMeusPedidos($id) {
        try {
            $stmt = $this->db->prepare("SELECT p.dataI, p.dataF, p.pagamento,
                (SELECT o.tipo FROM outdoors o WHERE o.idOutdoor = p.fk_outdoor) AS tipo,
                (SELECT o.provincia FROM outdoors o WHERE o.idOutdoor = p.fk_outdoor) AS provincia,
                (SELECT o.municipio FROM outdoors o WHERE o.idOutdoor = p.fk_outdoor) AS municipio,
                (SELECT o.comuna FROM outdoors o WHERE o.idOutdoor = p.fk_outdoor) AS comuna
                FROM pedidos p,outdoors
                    WHERE p.fk_gestor = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resultado = $stmt->fetchAll();
            $alugueres = array();
            foreach ($resultado as $valor) {
                $aluguer = new Aluguer();
                $aluguer->setDataI($valor['dataI']);
                $aluguer->setDataF($valor['dataF']);
                $aluguer->setPagamento($valor['pagamento']);
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
