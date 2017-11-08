<?php

namespace backend\controllers;

use backend\models\GoodsIntro;

class GoodsIntroController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = GoodsIntro::find()->all();
        return $this->render('index',['model'=>$model]);
    }

}
