<?php

require 'config.php';
require __DIR__ . '/system/src/SleekDB.php';
require __DIR__ . '/system/auth/function.php';
require __DIR__ . '/system/auth/CrawlerDetect/Fixtures/AbstractProvider.php';
require __DIR__ . '/system/auth/CrawlerDetect/Fixtures/AbstractReff.php';
require __DIR__ . '/system/auth/CrawlerDetect/Fixtures/Crawlers.php';
require __DIR__ . '/system/auth/CrawlerDetect/Fixtures/Exclusions.php';
require __DIR__ . '/system/auth/CrawlerDetect/Fixtures/Headers.php';
require __DIR__ . '/system/auth/CrawlerDetect/Fixtures/Headerspam.php';
require __DIR__ . '/system/auth/CrawlerDetect/Fixtures/SpamReferrers.php';
require __DIR__ . '/system/auth/CrawlerDetect/CrawlerDetect.php';
require __DIR__ . '/system/auth/CrawlerDetect/ReferralSpamDetect.php';
require __DIR__ . '/system/auth/proxycheck.php';
require __DIR__ . '/system/auth/Mobile_Detect.php';

use Jaybizzle\CrawlerDetect\CrawlerDetect;
use Jaybizzle\ReferralSpamDetect\ReferralSpamDetect;

$MD = new Mobile_Detect();
$EB = new EvilBot;
$CD = new CrawlerDetect;
$RS = new ReferralSpamDetect;

$data = dirname(__FILE__) . "/system/data/";
$evilBot = \SleekDB\SleekDB::store('shortlink', $data);
