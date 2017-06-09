<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\time\TimePicker;
use kartik\date\DatePicker;
use kartik\datecontrol\Module;
use kartik\datecontrol\DateControl;

/* @var $this yii\web\View */
/* @var $model frontend\modules\clients\models\Client */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="client-form">

    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dob')->widget(DateControl::classname(), [
      'type' => 'date',
      'ajaxConversion' => true,
      'autoWidget' => true,
      'widgetClass' => '',
      //'displayFormat' => 'php:d-F-Y',
      'displayFormat' => 'MM/dd/yyyy',
      'saveFormat' => 'php:Y-m-d',
      'saveTimezone' => 'UTC',
      'displayTimezone' => 'Asia/Kolkata',
    /*  'saveOptions' => [
          'label' => 'Input saved as: ',
          'type' => 'text',
          'readonly' => true,
          'class' => 'hint-input text-muted'
      ],*/
      'widgetOptions' => [
          'pluginOptions' => [
              'autoclose' => true,
              'format' => 'MM/dd/yyyy'
          ]
      ]
  ]);


  ?>

    <?= $form->field($model, 'gender')->dropDownList($model->getGenders(),
             ['prompt'=>'- Choose Gender -']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
