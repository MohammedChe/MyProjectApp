<?php
/**
 * Created by JetBrains PhpStorm.
 * User: MohammedChe
 * Date: 26/01/2012
 * Time: 16:41
 * To change this template use File | Settings | File Templates.
 */



?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MyProjectApp</title>

    <link href="http://code.jquery.com/mobile/latest/jquery.mobile.min.css" rel="stylesheet" type="text/css" />
    <script src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
    <script src="http://code.jquery.com/mobile/latest/jquery.mobile.min.js"></script>

</head>
<body>

<!-- Start of first page -->
<div data-role="page" id="foo">

    <div data-role="header">
        <h1>Foo</h1>
    </div><!-- /header -->

    <div data-role="content">
        <p>I'm first in the source order so I'm shown as the page.</p>
        <p>View internal page called <a href="#bar">bar</a></p>
    </div><!-- /content -->

    <div data-role="footer">
        <h4>Page Footer</h4>
    </div><!-- /footer -->
</div><!-- /page -->


<!-- Start of second page -->
<div data-role="page" id="bar">

    <div data-role="header">
        <h1>Bar</h1>
    </div><!-- /header -->

    <div data-role="content">
        <p>I'm the second in the source order so I'm hidden when the page loads. I'm just shown if a link that references my ID is beeing clicked.</p>
        <p><a href="#foo">Back to foo</a></p>
    </div><!-- /content -->

    <div data-role="footer">
        <h4>Page Footer</h4>
    </div><!-- /footer -->
</div><!-- /page -->
</body>
</html>