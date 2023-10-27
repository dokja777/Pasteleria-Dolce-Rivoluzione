<?php
require_once(__DIR__.'/../Models/Administrador.php');
class AdministradorController extends Controller
{
  private $administradorModel;
  public function __construct(PDO $coneccion){
    $this->administradorModel=new Administrador($coneccion);
  }
  public function home(){
    $administradores = $this->administradorModel->getAll();
    echo '<pre>';
    var_dump($administradores);
    echo '</pre>';
  }
}
?>