<?php


namespace App\TraitHelpers;

use Keygen;

trait Generate
{
  public function generateCode($length = 4, $format = 'strtoupper')
  {
    return Keygen::bytes()->generate(
      function ($key) use ($length) {
        $random = Keygen::numeric()->generate();
        return substr(md5($key . $random . strrev($key)), mt_rand(0, 8), $length);
      },
      function ($key) {
        return $key;
      },
      $format
    );
  }

  protected function generateWordCode($length = 4)
  {
    $seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZABCDEFGHIJKLMNOPQRSTUVWXYZ');
    shuffle($seed);
    $rand = '';
    $randArr = array_rand($seed, $length);
    if (!is_array($randArr)) {
      $randArr = [$randArr];
    }
    foreach ($randArr as $k) $rand .= $seed[$k];
    return $rand;
    foreach (array_rand($seed, $length) as $k) $rand .= $seed[$k];
    return $rand;
  }

  protected function generateNumberCode($length = 4)
  {
    $seed = str_split('012345678901234567890123456789012345678901234567890123456789012345678901234567890123456789');
    shuffle($seed);
    $rand = '';
    foreach (array_rand($seed, $length) as $k) $rand .= $seed[$k];
    return $rand;
  }

  protected function generateNumericKey($length)
  {
    // prefixes the key with a random integer between 1 - 9 (inclusive)
    return Keygen::numeric($length)->prefix(mt_rand(1, 9))->generate(true);
  }

  public function generateID()
  {
    $id = $this->generateNumericKey(5);

    // Ensure ID does not exist
    // Generate new one if ID already exists

    return $id;
  }

  public function generateCode44()
  {
    return Keygen::bytes()->generate(
      function ($key) {
        // Generate a random numeric key
        $random = Keygen::numeric()->generate();

        // Manipulate the random bytes with the numeric key
        return substr(md5($key . $random . strrev($key)), mt_rand(0, 8), 20);
      },
      function ($key) {
        // Add a (-) after every fourth character in the key
        return join('-', str_split($key, 4));
      },
      'strtoupper'
    );
  }
}
