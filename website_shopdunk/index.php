<?php
    session_start();
    require_once "app/controllers/controller.php";
    require_once "app/database/Model.php";
    require_once "app/helpers/Helper.php";
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $area=isset($_GET["area"]) ? $_GET["area"] : 'frontend';
    $controller=isset($_GET["controller"]) ? $_GET["controller"] : 'home';
    $action=isset($_GET["action"]) ? $_GET["action"] : 'index';
    $controller=ucfirst($controller);
    $controller .="Controller";
    $path_controller="controllers/$controller.php";
    $file_controller="mvc/$area/$path_controller";
    if(!$file_controller){
        die("Trang bạn truy cập không tồn tại");
    }
    require_once "$file_controller";
    $obj=new $controller;
    if(!method_exists($obj,$action)){
        die("Không tồn tại phương thức $action trong class $controller");
    }
    $obj->$action();
