<?php

namespace backend\controllers;

use backend\models\Article;
use backend\models\Articlel;
use backend\models\Articlex;
use phpDocumentor\Reflection\Types\Array_;
use yii\helpers\ArrayHelper;

class ArticleController extends \yii\web\Controller
{
    public function actionIndex()
    {

        $model=Article::find()->all();
        return $this->render('index',['model'=>$model]);
    }

    public function actionAdd(){


        $model=new Article();
        $content=new Articlex();
        $articlel=Articlel::find()->all();
        $option=ArrayHelper::map($articlel,'id','name');
        $request=\Yii::$app->request;

    //绑定$model
        if ($model->load($request->post()) && $model->validate()){
//绑定时间
            $model->inputtime=time();
            $model->save();

       //绑定内容
            if ($content->load($request->post())){
        //绑定   article_id
                $content->article_id=$model->id;
                $content->save();
            }

            return $this->redirect(['index']);

        }



        return $this->render('add', ['model' => $model,'option'=>$option,'content'=>$content]);

    }


    public function actionEdit($id){



        $content=Articlex::findOne($id);
        $model=Article::findOne($id);
//        var_dump($content);exit();
        $articlel=Articlel::find()->all();
        $option=ArrayHelper::map($articlel,'id','name');
        $request=\Yii::$app->request;

        //绑定$model
        if ($model->load($request->post()) && $model->validate()){

            $model->save();

            //绑定内容
            if ($content->load($request->post())){
                //绑定   article_id
                $content->article_id=$model->id;
                $content->save();
            }

            return $this->redirect(['index']);

        }



        return $this->render('add', ['model' => $model,'option'=>$option,'content'=>$content]);

    }


    public function  actionDel($id){
        $book=Article::findOne($id);
        $content=Articlex::findOne($id);

        if ($book){
            $book->delete();
            if ($content){
                $content->delete();
            }


            $this->redirect(['article/index']);
        }else{

            exit("没有此商品");
        }
    }
    public function actionSel($id){
        $model=Article::findOne($id);

        return $this->render('sel',['model'=>$model]);


    }

}
