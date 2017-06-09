<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Notes;
use frontend\models\NotesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;

/**
 * NotesController implements the CRUD actions for Notes model.
 */
class NotesController extends Controller
{
    /**
     * @inheritdoc
     */
  /*  public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }*/

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                        'class' => \yii\filters\AccessControl::className(),
                        'only' => ['index','create', 'create_geo','create_place_google','update','view','slug'],
                        'rules' => [
                            // allow authenticated users
                            [
                                'allow' => true,
                                'roles' => ['@'],
                            ],
                            // everything else is denied
                        ],
                    ],
        ];
    }

    /**
     * Lists all Notes models.
     * @return mixed
     */
    public function actionIndex()
    {

$id = \Yii::$app->user->getId();

    /*  $query = Notes::find()->where(['user_id'=>$id]);
    	$countQuery = clone $query;

    	$pages = new Pagination(['totalCount' => $countQuery->count()]);

    	$dataProvider = new ActiveDataProvider([
    		'query' => $query,

    	]);
    	 return $this->render('index', [
             'dataProvider' => $dataProvider,
             'pages' => $pages,
        ]);*/


        $searchModel = new NotesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        //add pagination
        $dataProvider->query->where(['notes.user_id'=>$id]);
        $dataProvider->pagination = [
        'pageSize' => 10,
        ];


        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,

        ]);

        /*$query = Notes::find()->where([ 'user_id' => $id ]);

        $dataProvider = new ActiveDataProvider([
                    'query' => $query,
                    'pagination' => [ 'pageSize' => 10 ],
                ]);*/

/*        $searchModel = new NotesSearch();


      $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
   $dataProvider->sort = ['defaultOrder' => ['id'=>SORT_ASC, 'id'=>SORT_ASC]];
   //$dataProvider->query->where('employee.role <> \'regular\'');
  $dataProvider->query->where(['notes.user_id'=>$id]);
//$dataProvider->pagination->pageSize=5;
$pagination = new Pagination(['totalCount' => $dataProvider->query->where(['notes.user_id'=>$id])->count(), 'pageSize'=>10]);
      /*$id = \Yii::$app->user->getId();
        $searchModel = new NotesSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $Property=Notes::find()
           ->where(['user_id' => $id]);
$dataProvider = $dataProvider = new ActiveDataProvider([
      'query' => $Property,
      'searchModel' => search(Yii::$app->request->queryParams)
 ]);*/


 /*$dataProvider->sort->attributes['notes'] = [
        // The tables are the ones our relation are configured to
        // in my case they are prefixed with "tbl_"
        'asc' => ['tbl_notes.id' => SORT_ASC],
        'desc' => ['tbl_notes.id' => SORT_DESC],
    ];*/


      /*  return $this->render('index', [
            //'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            //'pagination'=>$pagination,
        ]);*/
    }

    /**
     * Displays a single Notes model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Notes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
      $id = \Yii::$app->user->getId();
        $model = new Notes();

        if ($model->load(Yii::$app->request->post())) {
          // logged in user id added to note entry

          $model->created_at = time();
          $model->updated_at = time();
          $model->user_id=$id;

           if ($model->save()) {
             return $this->redirect(['view', 'id' => $model->id]);
           }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Notes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
          $model->updated_at = time();
           if ($model->save()) {
             return $this->redirect(['view', 'id' => $model->id]);
           }
        }
            return $this->render('update', [
                'model' => $model,
            ]);
        }


    /**
     * Deletes an existing Notes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Notes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
