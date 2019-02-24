<?php
/**
 * Front end for quick and dirty tool looking up words in a dictionary file.
 * See: service.php, dict.txt
 */
$config = json_decode(file_get_contents('./config.json'));

?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="./styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(function() {
            $('#letters').keyup(function () {
                let letters = this.value.replace(/\s/g,'');
                if (letters.length >= <?= $config->min_word_length ?>) {
                    $.ajax({
                        method: "GET",
                        url: "/words/service.php",
                        data: { 'letters' : letters, 'results' : <?= $config->max_results ?> }
                    })
                    .done(function (resp) {
                        $('#response').html(resp.join('<br />'));
                    });
                }
            });
        });
    </script>

</head>
<body>

<h1><?= $config->title ?></h1>
<p>
    <textarea id="letters" rows="7" cols="45"></textarea>
</p>
<div id="response"></div>

</body>
</html>


