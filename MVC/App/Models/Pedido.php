<?php
class Pedido extends Orm
{
  public function __construct(PDO $connecion)
  {
    parent::__construct('ID_PEDIDO','pedido',$connecion);
  }
}
?>