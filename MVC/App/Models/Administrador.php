<?php
class Administrador extends Orm
{
  public function __construct(PDO $connecion)
  {
    parent::__construct('ID_ADMIN','admin',$connecion);
  }
}
?>