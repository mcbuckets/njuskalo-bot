<?php

require __DIR__ . '/vendor/autoload.php';

use Src\NjuskaloBot;

CONST SEARCH_URL = "http://iapi.njuskalo.hr/?ctl=browse_ads&sort=new&categoryId=10920&locationId=2619&locationId_level_0=1153&locationId_level_1=1250&locationId_level_2=2619&price%5Bmin%5D=150&price%5Bmax%5D=400&mainAreaFrom=40&mainAreaTo=&adsWithImages=1&flatTypeId=0&floorCountId=0&roomCountId=0&flatFloorIdFrom=0&flatFloorIdTo=0&gardenAreaFrom=&gardenAreaTo=&balconyAreaFrom=&balconyAreaTo=&teraceAreaFrom=&teraceAreaTo=&yearBuiltFrom=&yearBuiltTo=&yearLastRebuildFrom=&yearLastRebuildTo=";
CONST DOMAIN     = "sandboxfbfa1c18612d4c1d8816ec00898ee4ca.mailgun.org";
CONST API_KEY    = "YOUR_API_KEY";
CoNST RECIPIENTS = ['frbarac@gmail.com'];

$bot = new NjuskaloBot();

while(true)
{
    sleep(240);

    $bot->checkForNewApartments();
};