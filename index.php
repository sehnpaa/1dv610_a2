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
//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$loginModel = new LoginModel();
//CREATE OBJECTS OF THE VIEWS
$v = new LoginView($loginModel);
$dtv = new DateTimeView();
$lv = new LayoutView();

$lc = new LoginController($loginModel, $v);
$lc->authenticate();

$rm = new RegisterModel();
$rv = new RegisterView($rm);
$rc = new RegisterController($rm, $rv);
$rc->run();

$lv->render($loginModel, $rv, $v, $dtv);

