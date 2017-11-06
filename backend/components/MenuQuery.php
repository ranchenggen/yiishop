<?php

namespace backend\components;
use yii\db\ActiveQuery;
use creocoder\nestedsets\NestedSetsQueryBehavior;
class MenuQuery extends ActiveQuery
{
    public function behaviors() {
        return [
            NestedSetsQueryBehavior::className(),
        ];
    }
}