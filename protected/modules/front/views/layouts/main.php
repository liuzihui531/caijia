<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta id="viewport" name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title></title>
        <meta name="description" content="" />
        <meta content="telephone=no" name="format-detection" />
        <meta content="email=no" name="format-detection" />
        <link rel="stylesheet" href="/static/front/css/style.css" />

    </head>
    <body>
        <header class="header">
            <h1><img src="/static/front/img/logo.png" /></h1>
            <div class="back"><a href="#"><img src="/static/front/img/back.png" /></a></div>
        </header>
        <div class="banner"><img src="/static/front/img/banner.jpg" /></div>
        <?php echo $content; ?>

        <footer class="footer">
            <div class="hotLine">客服热线：888-88888888</div>
            <ul class="clearfix">
                <li><a href="#"><img src="/static/front/img/ico_m1.png" /><p>采价系统</p><b>1</b></a></li>
                <li><a href="#"><img src="/static/front/img/ico_m2.png" /><p>通知公告</p></a></li>
                <li><a href="#"><img src="/static/front/img/ico_m3.png" /><p>管理中心</p></a></li>
            </ul>
        </footer>
        <script src="/static/front/js/jquery-2.2.2.min.js"></script>
        <script src="/static/front/js/script.js"></script>
    </body>
</html>