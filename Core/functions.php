<?php

function dump($value) {
  echo '<pre>';
  var_dump($value);
  echo '</pre>';
}

function base_path($path) {
  return BASE_PATH . $path;
}

function view($path, $attributes = []) {
  extract($attributes);

  require base_path("views/$path");
}