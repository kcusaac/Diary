<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[ClientUser]].
 *
 * @see ClientUser
 */
class ClientUserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ClientUser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ClientUser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
