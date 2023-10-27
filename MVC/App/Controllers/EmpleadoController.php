<?php
require_once(__DIR__.'/../Models/Empleado.php');
class EmpleadoController extends Controller
{
  private $empleadoModel;
  public function __construct(PDO $coneccion){
    $this->empleadoModel=new Empleado($coneccion);
  }
  public function home(){
    $empleados = $this->empleadoModel->getAll();
    echo '<pre>';
    var_dump($empleados);
    echo '</pre>';
  }
}
?>