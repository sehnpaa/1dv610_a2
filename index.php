<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('controller/LoginController.php');
require_once('model/LoginModel.php');
require_once('model/RegisterModel.php');
require_once('view/RegisterView.php');
require_once('controller/RegisterController.php');
require_once('controller/PostHandler.php');
//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$loginModel = new \model\LoginModel();
//CREATE OBJECTS OF THE VIEWS
$v = new \view\LoginView($loginModel);
$dtv = new \view\DateTimeView();
$lv = new \view\LayoutView();

$postHandler = new \controller\PostHandler();

$lc = new \controller\LoginController($loginModel, $v, $postHandler);
$lc->run();

$rm = new \model\RegisterModel();
$rv = new \view\RegisterView($rm);
$rc = new \controller\RegisterController($rm, $rv, $lc, $postHandler);
$rc->run();

$lv->render($loginModel, $rv, $v, $dtv);

