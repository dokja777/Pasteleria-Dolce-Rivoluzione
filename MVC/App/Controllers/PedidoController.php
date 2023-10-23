<?php
require_once(__DIR__.'/../Models/Pedido.php');
class PedidoController extends Controller
{
  private $pedidoModel;
  public function __construct(PDO $coneccion){
    $this->pedidoModel=new Pedido($coneccion);
  }
  public function home(){
    $this->render('pedido',[],'site');
  }
  public function new(){}
  public function table(){
    $res = new Result();

    $pedidos = $this->pedidoModel->getAll();

    $res->success=true;
    $res->result=$pedidos;

    echo json_encode($res);
  }
}
?>