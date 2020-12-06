<?php
function proxycheck_function($Visitor_IP)
{
    $API_Key = "38667z-i299a5-4ga4b2-2gn424";
    $VPN = "1";
    $TLS = "1";
    $TAG = "1";
    $Custom_Tag = "";

    if ($TLS == 1) {
        $Transport_Type_String = "https://";
    } else {
        $Transport_Type_String = "http://";
    }

    if ($TAG == 1 && $Custom_Tag == "") {
        $Post_Field = "tag=" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    } else if ($TAG == 1 && $Custom_Tag != "") {
        $Post_Field = "tag=" . $Custom_Tag;
    } else {
        $Post_Field = "";
    }

    $ch = curl_init($Transport_Type_String . 'proxycheck.io/v2/' . $Visitor_IP . '?key=' . $API_Key . '&vpn=' . $VPN);

    $curl_options = array(
        CURLOPT_CONNECTTIMEOUT => 30,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $Post_Field,
        CURLOPT_RETURNTRANSFER => true
    );

    curl_setopt_array($ch, $curl_options);
    $API_JSON_Result = curl_exec($ch);
    curl_close($ch);

    $Decoded_JSON = json_decode($API_JSON_Result);
    if (isset($Decoded_JSON->$Visitor_IP->proxy) && $Decoded_JSON->$Visitor_IP->proxy == "yes") {
        return true;
    } else {
        return false;
    }
}
