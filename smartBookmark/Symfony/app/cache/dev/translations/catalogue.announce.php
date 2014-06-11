<?php

use Symfony\Component\Translation\MessageCatalogue;

$catalogue = new MessageCatalogue('announce', array (
));

$catalogueUkr = new MessageCatalogue('ukr', array (
));
$catalogue->addFallbackCatalogue($catalogueUkr);


return $catalogue;
