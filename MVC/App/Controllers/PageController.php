<?php
class PageController extends Controller
{
  public function home(){
  $this->render('home',[],'site');

  }
  public function productos(){
    $this->render('productos');
  }
  public function nosotros(){
    $this->render('nosotros');
  }
}
