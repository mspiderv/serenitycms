<!DOCTYPE html>
<html>
    <head>
        <title>{!! $exception->getStatusCode() !!}</title>

        <link href='https://fonts.googleapis.com/css?family=Exo+2:100&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #333;
                display: table;
                font-weight: 100;
                font-family: 'Exo 2', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 48px;
                margin-bottom: 40px;
            }

            .message {
                font-size: 24px;
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">{!! $exception->getStatusCode() !!}</div>
                <div class="message">{!! $exception->getMessage() !!}</div>
            </div>
        </div>
    </body>
</html>
