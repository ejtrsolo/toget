<?php
use backend\assets\AppAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
Yii::$app->language='es';
dmstr\web\AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php
        $this->head();
        $this->registerCssFile(Yii::$app->request->baseUrl.'/css/page.css');
    ?>
    <link rel="icon" type="image/png" sizes="32x32" href="<?=Yii::$app->homeUrl?>favicon.png">
</head>
<body class="main-page" >

<?php $this->beginBody() ?>

    <?= $content ?>
<!--<a class="designed-by" href='http://www.freepik.es/foto-gratis/larga-carretera-a-traves-del-campo_891622.htm'>Designed by Freepik</a>
<a class="designed-by" href='http://www.freepik.es/foto-gratis/amanecer-en-la-carretera_874693.htm'>Designed by Freepik</a>-->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
