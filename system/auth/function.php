<?php

class EvilBot
{

    function get_client_ip()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        }
        if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        }
        if (getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        }
        if (getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        }
        if (getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        }
        if (getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        }
        $ipaddress = explode(",",  $ipaddress);
        if (preg_match("/::1/", $ipaddress[0])) {
            $ipaddress[0] = '8.8.8.8';
        }
        return $ipaddress[0];
    }

    function addToBlockList()
    {
        file_put_contents("blocked.txt", $this->get_client_ip() . PHP_EOL, FILE_APPEND);
    }

    function CheckBlockList()
    {
        $blocklist = explode(PHP_EOL, file_get_contents("blocked.txt"));
        foreach ($blocklist as $value) {
            if (strpos($value, $this->get_client_ip()) !== FALSE) {
                $this->selferror();
            }
        }
    }

    function getBaseUrl()
    {
        $currentPath = $_SERVER['PHP_SELF'];
        $pathInfo = pathinfo($currentPath);
        $hostName = $_SERVER['HTTP_HOST'];
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https' : 'http';
        return $protocol . '://' . $hostName . $pathInfo['dirname'] . "/";
    }

    function selferror()
    {
        http_response_code(404);
        $template = file_get_contents($this->getBaseUrl() . '/system/template/404.html');
        die($template);
    }

    function VisPass($url)
    {
        echo '<html>
        <head>
            <meta http-equiv="refresh" content="0; URL=' . $url . '" />
            <title>&#65279;</title>
        </head>
        </html>';
        exit;
    }
}
