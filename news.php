<?php
include_once 'db.php';
?>
<?php
/* Pagination is a technique to divide content into several pages.
 Here we can assign each page a separate URL. By Clicking that URL or Page Number,
 user can view this Page. For every page we assign a incremental
 Page number */



$start=0;
$limit=2;
// limit=1,2;
// limit=2,2;

$t=mysqli_query($MySQLi_CON,"select * from bloodnews ORDER BY posttime  DESC ");
$total=mysqli_num_rows($t);



if(isset($_GET['id']))
{
    $id=$_GET['id'];
    $start=($id-1)*$limit;
    //$start=2*1;
    //$start=2;
}
else
{
    $id=1;
}
$page=ceil($total/$limit);

$query=mysqli_query($MySQLi_CON,"select * from bloodnews ORDER BY posttime DESC limit $start,$limit");
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <meta name="description" content="">
    <title>নিউজ</title>
    <link rel="stylesheet" href="assets/css/material.css">
    <link rel="stylesheet" href="assets/css/tether.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/socicon.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/dropdown/css/style.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/add.css" type="text/css">
</head>
<body>
<section id="ext_menu-s">

    <nav class="navbar navbar-dropdown navbar-fixed-top">
        <div class="container">

            <div class="mbr-table">
                <div class="mbr-table-cell">

                    <div class="navbar-brand">
                        <a href="index" class="navbar-logo"><img src="assets/images/logo.png" alt="Mobirise"></a>
                        <a class="navbar-caption" href="index.html">HEMATO</a>
                    </div>

                </div>
                <div class="mbr-table-cell">

                    <button class="navbar-toggler pull-xs-right hidden-md-up" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="hamburger-icon"></div>
                    </button>

                    <ul class="nav-dropdown collapse pull-xs-right nav navbar-nav navbar-toggleable-sm" id="exCollapsingNavbar">
                        <li class="nav-item"><a class="nav-link link" href="index">হোম</a></li>
                        <li class="nav-item"><a class="nav-link link" href="user/login">লগিন</a></li>
                        <li class="nav-item"><a class="nav-link link" href="user/register">রেজিস্টার</a></li>
                        <li class="nav-item"><a class="nav-link link" href="camps">ক্যাম্পেইন</a></li><li class="nav-item"><a class="nav-link link" href="search">সার্চ</a></li>
                        <li class="nav-item"><a class="nav-link link" href="about">আমাদের সম্পর্কে</a></li>
                        <li class="nav-item"><a class="nav-link link" href="news">নিউজ</a></li>
                    </ul>
                    <button hidden="" class="navbar-toggler navbar-close" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar">
                        <div class="close-icon"></div>
                    </button>

                </div>
            </div>

        </div>
    </nav>

</section>
<section class="mbr-section mbr-after-navbar" id="msg-box3-v" style="background-color: #dddddd; padding-top: 60px; padding-bottom: 10px;">

    <div class="container">

        <div class="blog-header">
            <h1 class="blog-title text-lg-center">HEMATO BLOG </h1>
            <p class="lead blog-description text-lg-center" >The Official Blog of HEMATO.</p>
        </div>

        <div class="row">

            <div class="col-sm-8 blog-main">

                <div class="blog-post">
                    <form method="post" name="frm">
                        <table class='table table-bordered ' style="border-style: none; ">

                            <?php
                            $res = $MySQLi_CON->query("SELECT * FROM bloodnews ORDER BY posttime DESC ");
                            $count2 = $res->num_rows;

                            if($count2 > 0)
                            {
                                while ($ft = mysqli_fetch_array($query))
                                {
                                    ?>
                                    <tr >
                                        <td style="border-style: none;">
                                            <span><h2 class="blog-post-title"><?= $ft['1'] ?></h2></span>
                                            <p class="blog-post-meta">লিখেছেন <a href="#" class="a-red"> <?= $ft['2'] ?> </a> on <span style="font-style: oblique;"><?= $ft['3'] ?></span></p>
                                            <span style="padding-left: 30px;"><img class="img-responsive" src="assets/images/news/<?= $ft['4'] ?>" style="width: auto; height: 220px;"/></span><br>
                                            <span style="font-style: oblique; padding-left: 40px; text-align: center;" ><?= $ft['5'] ?> </span><br>
                                            <?= $ft['6'] ?> <div class="collapse" id="news<?= $ft['0'] ?>">
                                                <?= $ft['7'] ?></div>
                                            <script type="text/javascript">
                                                function changeText(id){
                                                    if(id.innerHTML == "Read More"){
                                                        id.innerHTML = "Read Less";
                                                    }else{
                                                        id.innerHTML = "Read More";
                                                    }
                                                }
                                            </script>
                                            <a class="a-red" data-toggle="collapse"  href="#news<?= $ft['0'] ?>" onclick="changeText(this)">আরো পড়ুন</a>
                                            <hr>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }


                            else
                            {
                                ?>
                                <tr>
                                    <td colspan="3" style="border-style: none;" > কিছু পাওয়া যায়নি ...</td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <ul style="list-style-type: none; overflow: hidden; background-color: rgb(190, 22, 22)">
                            <?php if($id > 1) {?> <li style="float: left;"><a href="?id=<?php echo ($id-1) ?>" style="display: block; color: #94ada8; text-align: center; padding: 14px 16px;">আগের</a></li><?php }?>
                            <?php
                            for($i=1;$i <= $page;$i++){
                                ?>
                                <li style="float: left;"><a href="?id=<?php echo $i ?>" style="display: block; color: #94ada8; text-align: center; padding: 14px 16px;"><?php echo $i;?></a></li>
                                <?php
                            }
                            ?>
                            <?php if($id!=$page)
                                //3!=4
                            {?>
                                <li style="float: left;"><a href="?id=<?php echo ($id+1); ?>" style="display: block; color: #94ada8; text-align: center; padding: 14px 16px;">পরের</a></li>
                            <?php }?>
                        </ul>
                    </form>


                </div><!-- /.blog-post -->


            </div><!-- /.blog-main -->

            <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
                <div class="sidebar-module sidebar-module-inset">
                    <h4>সম্পর্কে</h4>
                    <p>রক্ত আমাদের শরীরের অন্যতম গুরুত্বপূর্ণ উপাদান যা আমাদের জীবন ধারণের জন্য অতীব  প্রয়োজনীয় । এটি বিভিন্ন অবস্থার অসংখ্য মানুষের জীবন বাচায়।
                        রক্তের প্রয়োজনীয়তা অপিরিসীম।প্রতিদিন প্রায় ৩৯০০০ RED BLOOD CELL Unit প্রয়োজন হয়। প্রতি বছর ২৯ মিলিয়নেরও বেশী রক্ত এক ব্যাক্তির দেহ থেকে অন্য ব্যাক্তির দেহে পরিবর্তন করা হয়। রক্ত দাতার সংখ্যা বৃদ্বি পেলেও জ্রুরি মূহুর্তে রক্ত সরবরাহ কম থাকে।এর প্রধাণ কারন তথ্য ও প্রবেশাধীকার এর অভাব। আমরা বিশ্বাস করি HEMATO রক্ত প্রদান কারী ও গ্রহীতার সাথে সংযোগ স্থাপন করে এসব সমস্যা মোকাবেলা করতে সাহায্য করবে। </p>
                </div>
                <div class="sidebar-module">
                    <h4>আর্কাইভস</h4>
                    <ol class="list-unstyled">
                        <li><a href="#" class="a-red">ডিসেম্বর ২০১৬</a></li>
                        <li><a href="#" class="a-red">জানুয়ারি ২০১৭</a></li>
                        <li><a href="#" class="a-red">ফেব্রুয়ারি ২০১৭</a></li>
                        <li><a href="#" class="a-red">মার্চ ২০১৭</a></li>
                        <li><a href="#" class="a-red">এপ্রিল ২০১৭</a></li>
                    </ol>
                </div>
                <div class="sidebar-module">
                    <h4>আমরা আছি..</h4>
                    <ol class="list-unstyled">
                        <li><a href="#" class="a-red">GitHub</a></li>
                        <li><a href="#" class="a-red">Twitter</a></li>
                        <li><a href="#" class="a-red">Facebook</a></li>
                        <li><a href="#" class="a-red">Telegram</a></li>
                        <li><a href="#" class="a-red">Linkedin</a></li>
                        <li><a href="#" class="a-red">Pininterest</a></li>
                        <li><a href="#" class="a-red">BitBucket</a></li>
                    </ol>
                </div>
            </div><!-- /.blog-sidebar -->

        </div><!-- /.row -->

    </div><!-- /.container -->

</section>

<section class="mbr-section mbr-section-md-padding mbr-footer footer1" id="contacts1-r" style="background-color: rgb(190, 22, 22); padding-top: 60px; padding-bottom: 30px;">

    <div class="container">
        <div class="row">
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <div><img src="assets/images/logo.png"></div>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <p><strong>ঠিকানা</strong><br>30300<br>Moi University, Eldoret</p>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <p><strong>যোগাযোগ</strong><br>
                    Email: support@#<br>
                    Phone: +245 710 301 320<br></p>
            </div>
            <div class="mbr-footer-content col-xs-12 col-md-3">
                <p></p><p><strong>লিংকস</strong><br>
                    <a href="user/request" class="text-white">রিকুয়েস্ট পাঠান</a><br><a href="user/viewrequests" class="text-white">রিকুয়েস্ট দেখুন</a><br><a href="camps" class="text-white">ক্যাম্পেইন</a><br><a href="about" class="text-white">আমাদের সম্পর্কে</a><br><a href="contact" class="text-white">আমাদের সাথে যোগাযোগ করুন</a></p><p></p>
            </div>

        </div>

</section>

<footer class="mbr-small-footer mbr-section mbr-section-nopadding" id="footer1-5" style="background-color: rgb(190, 22, 22); padding-top: 1.75rem; padding-bottom: 1.75rem;">

    <div class="container">
        <p class="text-xs-center">&copy; <?php 
$copyYear = 2016; 
$curYear = date('Y'); 
echo $copyYear . (($copyYear != $curYear) ? '-' . $curYear : '');
?> | <a class="text-white" href="#">HEMATO</a></p>
    </div>
    </div>
</footer>


<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/tether.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/SmoothScroll.js"></script>
<script src="assets/js/jquery.viewportchecker.js"></script>
<script src="assets/dropdown/js/script.min.js"></script>
<script src="assets/js/jquery.touchSwipe.min.js"></script>
<script src="assets/js/script.js"></script>
<input name="animation" type="hidden">
<div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i class="mbr-arrow-up-icon"></i></a></div>
</body>
</html>
