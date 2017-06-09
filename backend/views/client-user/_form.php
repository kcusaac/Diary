<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\clients\models\Client;
use yii\helpers\ArrayHelper;
use dektrium\user\models\Profile;

/* @var $this yii\web\View */
/* @var $model backend\models\ClientUser */
/* @var $form yii\widgets\ActiveForm */

$client = new Client;
$clients=$client->clientReturn();
?>

<div class="client-user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, "user_id")->dropDownList(
ArrayHelper::map(Profile::find()->asArray()->all(), 'user_id', 'name'),
['prompt' => 'Select Client Name...'])->label('Client Name',['class'=>'label-class']) ?>

    <?= $form->field($model, "client_id")->dropDownList(
ArrayHelper::map($clients, 'id', 'name'),
['prompt' => 'Select Client Name...'])->label('Client Name',['class'=>'label-class']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
