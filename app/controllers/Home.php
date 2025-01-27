<?php
class Home extends Controller {
  public function index() {
    $this->view('home');
  }

  public function edit($a = '', $b = '', $c = '') {
    show("from the edit function");
    $this->view('home');
  }
}
