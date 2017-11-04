<?php

namespace backend\controllers;

use backend\models\Articlel;

class ArticlelController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model=Articlel::find()->all();
        return $this->render('index',['model'=>$model]);
    }

    public function actionAdd(){
        $model=new Articlel();
        $request = \Yii::$app->request;
        if ($model->load($request->post()) && $model->validate()){

            $model->save();
            return $this->redirect(['index']);

        }

        return $this->render('add',['model'=>$model]);
    }


    public function actionEdit($id){
        $model=Articlel::findOne($id);
        $request = \Yii::$app->request;
        if ($model->load($request->post()) && $model->validate()){

            $model->save();
            return $this->redirect(['index']);

        }

        return $this->render('add',['model'=>$model]);
    }

    public function  actionDel($id){
        $book=Articlel::findOne($id);

        if ($book){
            $book->delete();
            $this->redirect(['articlel/index']);
        }else{

            exit("没有此类型");
        }
    }

}
