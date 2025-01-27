<?php
function show($object) {
  echo "<pre>";
  print_r($object);
  echo "<pre/>";
}

function redirect($path) {
  header("Location: ".ROOT."/".$path);
  //die ensures that the script of the page that we were in before stops and doesn't affect the new page.
  die;
}

function server_name() {
  echo $_SERVER['SERVER_NAME'];
}