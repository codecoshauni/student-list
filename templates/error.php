<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error <?= http_response_code() ?></title>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            background-color: #324251;
            font-weight: bold;
        }

        p {
            width: 100%;
            text-align: center;
            color: #B56969;
        }

        .error {
            margin-top: 50px;
            font-size: 100px
        }

        .cat {
            margin-top: -150px;
            height: 600px;
            background: center center no-repeat url('../img/cat.png');
        }

        .text {
            margin-top: -140px;
            font-size: 50px
        }
    </style>
</head>
<body>
    <p class="error">Oops!</p>
    <div class='cat'></div>
    <p class="text"><?= (http_response_code() == 404) ? 'Page not found' : 'Something went wrong' ?>
        (Error <?= http_response_code() ?>)</p>
</body>
</html>
