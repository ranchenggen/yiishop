<?php

namespace backend\controllers;

use backend\models\Brand;
use backend\models\Goods;
use backend\models\GoodsCategory;
use backend\models\GoodsDayCount;
use backend\models\GoodsGallery;
use backend\models\GoodsIntro;
use flyok666\qiniu\Qiniu;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class GoodsController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = Goods::find()->all();

        return $this->render('index',['model'=>$model]);
    }

    public function actionAdd(){


        $model = new Goods();
        $intro= new GoodsIntro();
       // $day=new GoodsDayCount();
        $gallery=new GoodsGallery();
        $model->is_on_sale = 1;
        $model->status = 1;
        $fenlei = GoodsCategory::find()->all();
        $pinpai = Brand::find()->all();
        $option=ArrayHelper::map($fenlei,'id','name');
        $option1=ArrayHelper::map($pinpai,'id','name');
        $request=\Yii::$app->request;

        if ($model->load($request->post()) && $model->validate()){

           $model->inputtime=time();
      // $time=date('YmdHis',$model->inputtime);

           $model->sn=substr("00000".$model->sn,-5);
            $model->save();

       if ($gallery->load($request->post())){

           foreach ($gallery->path as $v){
               $gallery=new GoodsGallery();
               $gallery->goods_id=$model->id;
               $gallery->path=$v;
               $gallery->save();
           }

       }



            if ($intro->load($request->post())){
                $intro->goods_id = $model->id;
                if ($intro->content == null){
                    $intro->content="";
                }
                $intro->save();
            }
            return $this->redirect(['index']);

        }

        return $this->render('add',['model'=>$model,'option'=>$option,'option1'=>$option1,'intro'=>$intro,'gallery'=>$gallery]);



    }


    public function actionEdit($id){

        $gallery=new GoodsGallery();
        $gallerydel=GoodsGallery::findOne(['goods_id'=>$id]);
        $model = Goods::findOne($id);
        if (GoodsIntro::findOne(['goods_id'=>$id]) == null){
            $intro = new GoodsIntro();
        }else{
            $intro= GoodsIntro::findOne(['goods_id'=>$id]);
        }


        // $day=new GoodsDayCount();
        $model->is_on_sale = 1;
        $model->status = 1;
        $fenlei = GoodsCategory::find()->all();
        $pinpai = Brand::find()->all();
        $option=ArrayHelper::map($fenlei,'id','nametext');
        $option1=ArrayHelper::map($pinpai,'id','name');
        $request=\Yii::$app->request;

        if ($model->load($request->post()) && $model->validate()){

            $model->inputtime=time();
        //    $time=date('YmdHis',$model->inputtime);

           // $model->sn="$time".substr("00000".$model->sn,-5);
            $model->save();
//删除原地址，保存新地址
            if ($gallery->load($request->post())){

                if ($gallerydel == null){
                    foreach ($gallery->path as $v){
                        $gallery=new GoodsGallery();
                        $gallery->goods_id=$model->id;
                        $gallery->path=$v;
                        $gallery->save();
                    }
                }else{
                    $gallerydel->deleteall(['goods_id'=>$id]);
                    foreach ($gallery->path as $v){
                        $gallery=new GoodsGallery();
                        $gallery->goods_id=$model->id;
                        $gallery->path=$v;
                        $gallery->save();
                    }
                }


            }


            if ($intro->load($request->post())){
                $intro->goods_id = $model->id;
                if ($intro->content == null){
                    $intro->content="";
                }
                $intro->save();
            }
            return $this->redirect(['index']);

        }
        $goodsGallerys=GoodsGallery::find()->where(['goods_id'=>$id])->all();
        foreach ($goodsGallerys as $v){
            $gallery->imgFlie[]=$v->path;
        }

        return $this->render('edit',['model'=>$model,'option'=>$option,'option1'=>$option1,'intro'=>$intro,'gallery'=>$gallery]);



    }

    public function actionDel($id){
        $book=Goods::findOne($id);
        $galley=GoodsGallery::findOne(['goods_id'=>$id]);
        $intro= GoodsIntro::findOne(['goods_id'=>$id]);
        if ($book){
            if ($galley){
                $galley->deleteall(['goods_id'=>$id]);
            }
            if ($intro){
                 $intro->delete();
            }
            $book->delete();
            $this->redirect(['goods/index']);
        }else{

            exit("没有此商品");
        }
//
//        echo 1111;exit();
    }

     public function actionLook($id){

        $model = Goods::findOne($id);
         $xiangce=GoodsGallery::find()->where(['goods_id'=>$id])->all();
        return $this->render('look',['model'=>$model,'xiangce'=>$xiangce]);

     }



    public function actionUpload(){
//   var_dump($_FILES['file']['tmp_name']);exit();

        $config = [
            'accessKey'=>'yWBUjfOawl7QiHNUWUFFHYPqrUTMFmnMwygS7G7o',
            'secretKey'=>'LGATc5FuxqAe0IIu4Yy0rtwU8NbFiPCF4e4LhRUp',
            'domain'=>'http://oyvprc9sp.bkt.clouddn.com/',
            'bucket'=>'mantouka',
            'area'=>Qiniu::AREA_HUANAN
        ];



        $qiniu = new Qiniu($config);
        $key = time();
        $qiniu->uploadFile($_FILES['file']['tmp_name'],$key);
        $url = $qiniu->getLink($key);
//      exit($url);
        $info=[
            'code'=>0,
            'url'=>$url,
            'attachment'=>$url


        ];
        exit(Json::encode($info));
    }
}
