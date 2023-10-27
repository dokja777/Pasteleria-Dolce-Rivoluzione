<?php
require_once(__DIR__.'/../Models/Producto.php');
class ProductoController extends Controller
{
  private $productoModel;
  public function __construct(PDO $coneccion){
    $this->productoModel=new Producto($coneccion);
  }
  public function home(){
    $productos = $this->productoModel->getAll();
    echo '<pre>';
    var_dump($productos);
    echo '</pre>';
  }
}
?>