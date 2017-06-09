<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\helpers\Enum;
use yii\data\Pagination;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\NotesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Notes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Notes'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        //'pagination' => $pagination,


        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'user_id',
            'title',

            //'note:ntext',
            /*[
                'attribute' => 'updated_at',
                //'format' =>  ['date', 'php:Y-m-d g:i a'],
                'filter' => false,
            ],

            [
                'attribute' => 'created_at',
                'format' =>  ['date', 'php:Y-m-d g:i a'],
                'filter' => false,
            ],*/

            [
      'label' => 'Updated',
      'value' => function ($model) {
          return $model->convert();
      }
    ],




            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

<?php
echo $date=Yii::$app->formatter->asDate('1496968553', 'php:Y-m-d H:i:s');
echo "<br />";
$originalDate = "1496942638";
echo $newDate = date("Y-m-d H:i:s", strtotime($originalDate));
echo "<br />";
echo 'Human Friendly: ' . Enum::timeElapsed($date,false);
 ?>
