<?php

namespace frontend\models;

use Yii;
use dektrium\user\models\User;
use kartik\helpers\Enum;



/**
 * This is the model class for table "notes".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $note
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class Notes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'note', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
            [['note'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'title' => Yii::t('app', 'Title'),
            'note' => Yii::t('app', 'Note'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     * @return time elapsed from updated_at.
     */
    public function convert()
    {

        if($this->updated_at != NULL){
            $date=Yii::$app->formatter->asDate($this->updated_at, 'php:Y-m-d H:i:s');
              return $date=Enum::timeElapsed($date);
        }

    }

    /**
     * @inheritdoc
     * @return NotesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NotesQuery(get_called_class());
    }


}
