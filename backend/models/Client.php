<?php

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "client".
 *
 * @property integer $id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property string $dob
 * @property integer $status
 *
 * @property Note[] $notes
 */
class Client extends \yii\db\ActiveRecord
{
  const PERMISSIONS_M = 'M';
   const PERMISSIONS_F = 'F';
   const PERMISSIONS_O = 'O';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'client';
    }


    /*public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }*/

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'first_name', 'last_name'], 'required'],
            [['created_at', 'updated_at', 'status'], 'integer'],
            [['dob'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 255],
            [['gender'], 'string', 'max' => 10],


        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'first_name' => Yii::t('app', 'First Name'),
            'last_name' => Yii::t('app', 'Last Name'),
            'gender' => Yii::t('app', 'Gender'),
            'dob' => Yii::t('app', 'Dob'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNotes()
    {
        return $this->hasMany(Note::className(), ['client_id' => 'id']);
    }

    public function getClientUser()
    {
        return $this->hasMany(\frontend\models\ClientUser::className(), ['client_id' => 'client_id']);
    }

    public function getGenders() {
      return array (self::PERMISSIONS_M=>'Male',self::PERMISSIONS_F=>'Female',self::PERMISSIONS_O=>'Other');
    }

    public function getGendersLabel($permissions) {
      if ($permissions==self::PERMISSIONS_M) {
        return 'Male';
      }

      if ($permissions==self::PERMISSIONS_F) {
        return 'Female';
      }else {
        return 'Other';
      }
    }

    public function noteReturn2()
    {
    // SELECT `customer`.* FROM `customer`
    // LEFT JOIN `order` ON `order`.`customer_id` = `customer`.`id`
    // WHERE `order`.`status` = 1
    //
    // SELECT * FROM `order` WHERE `customer_id` IN (...)
    $id = \Yii::$app->user->getId();
    $customers = Client::find()
    ->leftJoin('clientUser', '`client`.`id` = `clientUser`.`client_id`')
    ->where(['clientUser.user_id' => $id])
    //->with('orders')
    ->all();

return $customers;
}




public function getfullName()
      {

              return $this->first_name.' '.$this->last_name;
      }


      /*public function beforeSave($insert)
          {
              if (parent::beforeSave($insert)) {
                  $this->status = 1;
                  return true;
              } else {
                  return false;
              }
          }*/


}
