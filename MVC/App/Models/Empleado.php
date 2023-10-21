<?php
class Empleado extends Orm
{
  public function __construct(PDO $connecion)
  {
    parent::__construct('ID_EMPLEADO','empleado',$connecion);
  }
}
?>