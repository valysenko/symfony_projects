<?php

use Symfony\Component\Translation\MessageCatalogue;

$catalogue = new MessageCatalogue('scrape', array (
));

$catalogueUkr = new MessageCatalogue('ukr', array (
));
$catalogue->addFallbackCatalogue($catalogueUkr);


return $catalogue;
