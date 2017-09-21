<?php

namespace risk\models;

/**
 * This is the ActiveQuery class for [[RmEffect]].
 *
 * @see RmEffect
 */
class RmEffectQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return RmEffect[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RmEffect|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
