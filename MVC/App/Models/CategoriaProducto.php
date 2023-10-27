<?php
class CategoriaProducto extends Orm
{
  public function __construct(PDO $connecion)
  {
    parent::__construct('ID_CATEGORIA','categoria_producto',$connecion);
  }
}
?>