<?php
class Cliente extends Orm
{
  public function __construct(PDO $connecion)
  {
    parent::__construct('ID_CLIENTE','cliente',$connecion);
  }
}
?>