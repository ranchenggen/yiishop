<?php

namespace backend\controllers;

use backend\models\Brand;
use yii\data\Pagination;
use yii\web\UploadedFile;

class BrandController extends \yii\web\Controller
{



    public function actionIndex()
    {
       // $model=Brand::find()->all();

        //1.总条数
        $count = Brand::find()->count();

        //2.每页显示条数
        $pageSize = 5;

        //创建分页对象
        $page = new Pagination(
            [
                'pageSize' => $pageSize,
                'totalCount' => $count
            ]
        );
        // select * from goods limit 0,3  => limit 3 offset 0
        $model = Brand::find()->limit($page->limit)->offset($page->offset)->all();

//        var_dump($model);exit();

        return $this->render('index',['model'=>$model,'page'=>$page]);
    }
  public  function  actionAdd(){

        $model=new Brand();
      //判断是不是POST提交
      $request = \Yii::$app->request;

//判断是不是POST提交
      if ($request->isPost) {

          //1.接收数据并绑定到Model
          $model->load($request->post());
          $model->imgFile = UploadedFile::getInstance($model, 'imgFile');

          //2.后端验证
          if ($model->validate()) {
//                $model->password=$model->password;
//               var_dump($model->password) ;exit();
              //判断有没有文件上传
              if ($model->imgFile) {

                  // $good->imgFile->extension 文件的后缀
                  $filePath = "images/" . time() . "." . $model->imgFile->extension;
                  //var_dump($filePath);exit;
                  //文件保存
                  $model->imgFile->saveAs($filePath, false);
                  //保存数据
                  $model->logo= $filePath;

              }
//




              $model->save(false);

              return $this->redirect(['index']);
          }


      }


        return $this->render('add',['model'=>$model]);
  }

    public  function  actionEdit($id){

        $model=Brand::findOne($id);
        //判断是不是POST提交
        $request = \Yii::$app->request;

//判断是不是POST提交
        if ($request->isPost) {

            //1.接收数据并绑定到Model
            $model->load($request->post());
            $model->imgFile = UploadedFile::getInstance($model, 'imgFile');

            //2.后端验证
            if ($model->validate()) {
//                $model->password=$model->password;
//               var_dump($model->password) ;exit();
                //判断有没有文件上传
                if ($model->imgFile) {

                    // $good->imgFile->extension 文件的后缀
                    $filePath = "images/" . time() . "." . $model->imgFile->extension;
                    //var_dump($filePath);exit;
                    //文件保存
                    $model->imgFile->saveAs($filePath, false);
                    //保存数据
                    $model->logo= $filePath;

                }
//




                $model->save(false);

                return $this->redirect(['index']);
            }


        }


        return $this->render('add',['model'=>$model]);
    }


    public function actionHuishou(){
        $model=Brand::find()->all();

//        var_dump($model);exit();

        return $this->render('huishou',['model'=>$model]);

    }
    public function  actionDel($id){
        $book=Brand::findOne($id);

        if ($book){
            $book->delete();
            $this->redirect(['brand/index']);
        }else{

            exit("没有此商品");
        }
    }

}
