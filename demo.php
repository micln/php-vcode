<html>
<head>
    <link rel="stylesheet" href="//cdn.bootcss.com/bootstrap/3.3.4/css/bootstrap.css">
</head>
<body>

<?
session_start();

$flash = '';
if (isset($_GET['vcode'])) {
    if ($_GET['vcode'] === $_SESSION['vcode']) {
        $flash = '验证成功';
    } else{
        $flash = '错误';
    }
}

require_once('vcode.php');
$v = new VCode();
$_SESSION['vcode'] = $v->getCode();
?>

<p><?=$flash;?></p>

<form action="" class="form">
    <?= $v->renderHTML('vcode'); ?>
    <input type="submit">
</form>

</body>
</html>

