<?php
function clean($data) {
  return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

function slugify($text) {
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  $text = strtolower(trim($text, '-'));
  return $text;
}
