<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <!--    <title>CLB YÊU XUẤT NHẬP KHẨU HÀ NỘI - Đào tạo nghiệp vụ Xuất Nhập Khẩu-Logistics</title>-->
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico"/>
    <!--    --><?php //include_stylesheets() ?>
    <!--    --><?php //include_javascripts() ?>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=2.0, user-scalable=yes">
    <meta http-equiv="Content-Language" content=""/>
    <link href="favicon.png" rel="shortcut icon"/>
    <meta http-equiv="REFRESH" content="5400"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>
<body>
<?php include_component('moduleMenu', 'header'); ?>

<section id="advertisement">
    <div class="container">
        <img src="images/shop/advertisement.jpg" alt=""/>
    </div>
</section>

<?php echo $sf_content; ?>

<?php include_partial('moduleMenu/footer'); ?>


<script src="js/jquery.js"></script>
<script src="js/price-range.js"></script>
<script src="js/jquery.scrollUp.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.prettyPhoto.js"></script>
<script src="js/main.js"></script>
</body>
</html>