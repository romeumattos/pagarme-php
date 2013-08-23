<?php

function authorizeFromEnv()
{
  $apiKey = getenv('PAGARME_API_KEY');
  if (!$apiKey)
    $apiKey = "vbNY7x1rxHTNQRfYGAZzdjhcUwxUQO";
  PagarMe::setApiKey($apiKey);
}

$ok = @include_once(dirname(__FILE__).'/simpletest/autorun.php');
if (!$ok) {
  $ok = @include_once(dirname(__FILE__).'/../vendor/vierbergenlars/simpletest/autorun.php');
}
if (!$ok) {
  echo "MISSING DEPENDENCY: The PagarMe API test cases depend on SimpleTest. ".
       "Download it at <http://www.simpletest.org/>, and either install it ".
       "in your PHP include_path or put it in the test/ directory.\n";
  exit(1);
}

// Throw an exception on any error
function exception_error_handler($errno, $errstr, $errfile, $errline) {
  throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}
set_error_handler('exception_error_handler');
// error_reporting(E_ALL | E_STRICT);

require_once(dirname(__FILE__) . '/../lib/Pagarme.php');
require_once(dirname(__FILE__) . '/PagarMe/TestCase.php');
require_once(dirname(__FILE__) . '/PagarMe/Transaction.php');
require_once(dirname(__FILE__) . '/PagarMe/Plan.php');
require_once(dirname(__FILE__) . '/PagarMe/Subscription.php');


?>
