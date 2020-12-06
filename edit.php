<?php
require_once 'autoload.php';

if (isset($_POST['url'])) {
    $update = [
        'url' => $_POST['url']
    ];
    $evilBot->where('slug', '=', $_POST['slug'])->update($update);
    echo 'Updated to: ' . $update['url'];
    exit;
} else {
    $urldata = $evilBot->where('slug', '=', $_GET['slug'])->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <title>Edit - Qclick URL Shortener</title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <div class="login">
        <h1>Edit URL Shortener</h1>
        <form action="?" method="POST">
            <input type="hidden" name="slug" id="slug" value="<?= $_GET['slug'] ?>">
            <label for="old">Destination</label>
            <input type="text" name="old" id="old" readonly value="<?= $urldata[0]['url'] ?>">
            <label for="click">Total Click</label>
            <input type="text" name="click" id="click" readonly value="<?= $urldata[0]['click'] ?>">
            <label for="url">New Destination</label>
            <input type="text" name="url" id="url" placeholder="https://reddit.com">
            <button type="submit" class="btn btn-primary btn-block btn-large" id="create">Update</button>
        </form>
        <p id="response" style="display: none;color:white;text-align:center"></p>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $("#create").click(e => {
            e.preventDefault();
            var url = $("#url").val();
            var slug = $("#slug").val();
            $.post(window.location, {
                url: url,
                slug: slug
            }).done(res => {
                console.log(res);
                $("#response").text(res);
                $("#response").show();
            })
        })
    </script>
</body>

</html>