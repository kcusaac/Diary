<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\Alert;
use frontend\modules\notes\components\LogTimes;
use frontend\modules\notes\models\Note;
use frontend\modules\clients\models\Client;
use frontend\models\ClientUser;
use yii\bootstrap\ActiveForm;

$this->title = 'About';
//$this->title = empty(\Yii::$app->profile->name) ? Html::encode(\Yii::$app->profile->username) : Html::encode(\Yii::$app->profile->name);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the About page. You may modify the following file to customize its content:</p>




    <code><?= __FILE__ ?></code>
</div>
