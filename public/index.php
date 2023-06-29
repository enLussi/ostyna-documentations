<?php

use App\Core;

require_once dirname(__DIR__) . '/vendor/autoload_ostyna.php';

return function() {
  return new Core();
};
?>