<?php
class DetallePedido extends Orm
{
  public function __construct(PDO $connecion)
  {
    parent::__construct('ID_D_PEDIDO','detalle_pedido',$connecion);
  }
}
?>