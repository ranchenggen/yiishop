<?php

namespace backend\controllers;

use backend\models\Goods;
use backend\models\GoodsDayCount;

class GoodsDayCountController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model =GoodsDayCount::find()->all();

        return $this->render('index',['model'=>$model]);
    }
    public function actionAdd(){

        $model = new GoodsDayCount();
        $request=\Yii::$app->request;

        if ($model->load($request->post()) && $model->validate()){
            $model->save();
            return $this->redirect(['index']);

        }

        return $this->render('add',['model'=>$model]);



    }

    public function actionEdit($day){

        $model =GoodsDayCount::findOne($day);
        $request=\Yii::$app->request;

        if ($model->load($request->post()) && $model->validate()){
            $model->save();
            return $this->redirect(['index']);

        }

        return $this->render('add',['model'=>$model]);



    }



    public function  actionDel($day){
        $book=GoodsDayCount::findOne($day);


        if ($book){
            $book->delete();



            $this->redirect(['goods-day-count/index']);
        }else{

            exit("没有此商品");
        }
    }

}
