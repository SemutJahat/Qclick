<?php
require_once 'autoload.php';

if ($_SERVER['HTTP_HOST'] != $config['maindomain']) {
    $EB->selferror();
}

if (isset($_POST['url'])) {
    if (!empty($_POST['cslug'])) {
        $slug = $_POST['cslug'];
    } else {
        $slug = uniqid();
    }

    $NewUrl = [
        "url" => $_POST['url'],
        "slug" => $slug,
        "click" => 0
    ];
    $result = $evilBot->insert($NewUrl);
    echo 'https://' . $_SERVER['HTTP_HOST'] . '/r/' . $NewUrl['slug'];
    exit;
} elseif (isset($_GET['domain'])) {
    echo json_encode($config['listdomain']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Qclick URL Shortener</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <div class="login">
        <h1>Qclick URL Shortener</h1>
        <form action="?" method="POST">
            <label for="url">Long URL</label>
            <input type="text" name="url" id="url" placeholder="https://reddit.com">
            <label for="cslug">Custom Slug</label>
            <input type="text" name="cslug" id="cslug" placeholder="reddit">
            <button type="submit" class="btn btn-primary btn-block btn-large" id="create">Create</button>
        </form>
        <p id="response" style="display: none;color:white;text-align:center"></p>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $("#create").click(e => {
            e.preventDefault();
            var url = $("#url").val();
            var cslug = $("#cslug").val();
            $.post(window.location, {
                url: url,
                cslug: cslug
            }).done(res => {
                console.log(res);
                $("#response").text(res);
                $("#response").show();
            })
        })
    </script>
</body>

</html>