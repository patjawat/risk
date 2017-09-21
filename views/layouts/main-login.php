
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\modules\hosxp\models\OpdUser;
// use cenotia\components\modal\RemoteModal;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
\edgardmessias\assets\nprogress\NProgressAsset::register($this);
$bundle = yiister\gentelella\assets\Asset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <?= Html::csrfMetaTags() ?>
    <title><?php echo  Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="login" style="padding-top:200px;background-color:#d2d6de;">
<?php $this->beginBody(); ?>
<?=$content;?>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
