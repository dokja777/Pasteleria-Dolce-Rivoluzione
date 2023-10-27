<?php
class PageController extends Controller
{
  public function __construct(PDO $coneccion){

  }
  public function home(){
  $this->render('home',[],'site');

  }
  public function productos(){
    $this->render('productos',[],'site');
  }
  public function nosotros(){
    $this->render('nosotros',[],'site');
  }
}
