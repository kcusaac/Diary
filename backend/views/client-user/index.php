<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use backend\models\ClientUser;
use yii\helpers\ArrayHelper;
use backend\models\Client;
use dektrium\user\models\User;
use dektrium\user\models\Profile;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ClientUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Client Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Client User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'client_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
<?php

$cu= new ClientUser;
print_r($c=$cu->userReturn2());


 ?>

<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsive'=>true,
    'hover'=>true,
    'striped'=>true,
    'condensed'=>true,
    'perfectScrollbar'=>true,
    'resizableColumns'=>true,
    'resizeStorageKey'=>\Yii::$app->user->getId() . '-' . date("m"),
    'persistResize'=>true,
    
    'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Notes</h3>',
        'type'=>'success',
        'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
        'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        'footer'=>false
    ],
    'pjax'=>true,
    'pjaxSettings'=>[
        'neverTimeout'=>true,
        'beforeGrid'=>'My fancy content before.',
        'afterGrid'=>'My fancy content after.',
    ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

[
            'attribute'=>'User Full Name',
            'width'=>'310px',
            'value'=>function ($model, $key, $index, $widget) {
                //return $model->supplier->company_name;
                return $model->user_id;
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>ArrayHelper::map(Profile::find()->orderBy('name')->asArray()->all(), 'user_id', 'name'),
            'filterWidgetOptions'=>[
                'pluginOptions'=>['allowClear'=>true],
            ],
            'filterInputOptions'=>['placeholder'=>'Any supplier'],
            'group'=>true,  // enable grouping
        ],

            //'id',
            'user_id',
            'ids',
            'client_id',
            [
            'label' => 'User Name',
            'value' => 'profile.name',
        ],

            [
            'label' => 'first Name',
            'value' => 'client.first_name',
        ],



            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>




















<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsive'=>true,
    'hover'=>true,
    'panel' => [
        'heading'=>'<h3 class="panel-title"><i class="glyphicon glyphicon-globe"></i> Notes</h3>',
        'type'=>'success',
        'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Create Country', ['create'], ['class' => 'btn btn-success']),
        'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Reset Grid', ['index'], ['class' => 'btn btn-info']),
        'footer'=>false
    ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'user_id',
            'ids',
            'client_id',
            [
            'label' => 'User Name',
            'value' => 'profile.name',
        ],

            [
            'label' => 'first Name',
            'value' => 'client.first_name',
        ],



            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
