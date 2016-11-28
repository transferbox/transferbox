<?php
function randomStringGen($length=9, $strength=4) {
  $vowels = 'aeuy';
  $consonants = 'bdghjmnpqrstvz';
  if ($strength & 1) {
    $consonants .= 'BDGHJLMNPQRSTVWXZ';
  }
  if ($strength & 2) {
    $vowels .= "AEUY";
  }
  if ($strength & 4) {
    $consonants .= '23456789';
  }
  if ($strength & 8) {
    $consonants .= '@#$%';
  }

  $randStringReturn = '';
  $alt = time() % 2;
  for ($i = 0; $i < $length; $i++) {
    if ($alt == 1) {
      $randStringReturn .= $consonants[(rand() % strlen($consonants))];
      $alt = 0;
    } else {
      $randStringReturn .= $vowels[(rand() % strlen($vowels))];
      $alt = 1;
    }
  }
  return $randStringReturn;
}
 ?>
