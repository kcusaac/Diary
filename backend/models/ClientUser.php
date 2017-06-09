<?php

namespace backend\models;

use Yii;
use dektrium\user\models\User;
use dektrium\user\models\Profile;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "clientUser".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $client_id
 *
 * @property Client $client
 * @property User $user
 */
class ClientUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clientUser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'client_id'], 'required'],
            [['user_id', 'client_id'], 'integer'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Client::className(), 'targetAttribute' => ['client_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Profile::className(), 'targetAttribute' => ['user_id' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'client_id' => Yii::t('app', 'Client ID'),
            'ids' => Yii::t('app', 'ids')
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'user_id']);
    }

    public function getClients()
    {
      $this->hasMany(Client::className(), ['id' => 'client_id']);
    }


    public function getIds()
    {
      return $this->user_id . ' ' . $this->client_id;
    }

    /**
     * @inheritdoc
     * @return ClientUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClientUserQuery(get_called_class());
    }

    public function userReturn2()
    {
    // SELECT `customer`.* FROM `customer`
    // LEFT JOIN `order` ON `order`.`customer_id` = `customer`.`id`
    // WHERE `order`.`status` = 1
    //
    // SELECT * FROM `order` WHERE `customer_id` IN (...)
    //$id = \Yii::$app->user->getId();
    $query = ClientUser::find()
    ->select('client.first_name')
    ->leftJoin('user', '`clientUser`.`user_id` = `user`.`id`')
    ->leftJoin('client', '`clientUser`.`client_id` = `client`.`id`')
    //->where(['clientUser.user_id' => $id])
    //->with('orders')
    ->all();
    $dataProvider2 = new ActiveDataProvider([
        'query' => $query,
    ]);
}
}
