<?php
class Producto extends Orm
{
  public function __construct(PDO $connecion)
  {
    parent::__construct('ID_PRODUCTO','producto',$connecion);
  }
}
?>