<?php

class LayoutView {
  
  public function render(\model\LoginModel $m, RegisterView $regView, LoginView $v, DateTimeView $dtv) {
    echo '<!DOCTYPE html>
      <html>
        <head>
          <meta charset="utf-8">
          <title>Login Example</title>
        </head>
        <body>
          <h1>Assignment 2</h1>
          <a href="?">Back to login</a>
          ' . $this->renderIsLoggedIn($m->isLoggedIn()) . '
          
          <div class="container">
              ' . $regView->response() . '
              ' . $v->response($m->isLoggedIn()) . '
              
              ' . $dtv->show() . '
          </div>
         </body>
      </html>
    ';
  }
  
  private function renderIsLoggedIn($isLoggedIn) {
    if ($isLoggedIn) {
      return '<h2>Logged in</h2>';
    }
    else {
	    return '<a href=\'?register\'>Register a new user</a>
		    <h2>Not logged in</h2>';
    }
  }
}
