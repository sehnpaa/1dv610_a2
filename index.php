<?php

//INCLUDE THE FILES NEEDED...
require_once('view/LoginView.php');
require_once('view/DateTimeView.php');
require_once('view/LayoutView.php');
require_once('controller/Authenticator.php');
require_once('model/LoginModel.php');

//MAKE SURE ERRORS ARE SHOWN... MIGHT WANT TO TURN THIS OFF ON A PUBLIC SERVER
error_reporting(E_ALL);
ini_set('display_errors', 'On');

$loginModel = new LoginModel();

//CREATE OBJECTS OF THE VIEWS
$v = new LoginView($loginModel);
$dtv = new DateTimeView();
$lv = new LayoutView();

$a = new Authenticator($loginModel, $v);

$a->authenticate();
$isLoggedIn = $a->isLoggedIn();

$lv->render($isLoggedIn, $v, $dtv);

