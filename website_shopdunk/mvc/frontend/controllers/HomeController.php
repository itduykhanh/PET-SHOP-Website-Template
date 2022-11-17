<?php
class HomeController extends Controller{
    public function index(){
        $this->content=$this->render("mvc/frontend/views/home/home.php");
       require_once 'mvc/frontend/views/layouts/main.php';
    }
    public function contact(){
        $this->content=$this->render("mvc/frontend/views/home/contact.php");
        require_once 'mvc/frontend/views/layouts/main.php';
    }
}
