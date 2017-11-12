<?php

namespace backend\controllers;

use backend\models\AuthItem;

class PermissionController extends \yii\web\Controller
{
    public function actionIndex()
    {
//        $model=AuthItem::find()->all();
//        return $this->render('index',compact('model'));
        $auth=\Yii::$app->authManager;

        $permissions=$auth->getPermissions();
        return $this->render('index',compact('permissions'));
    }

    public function actionAdd(){
        $model=new AuthItem();
        $request = \Yii::$app->request;

        if ($model->load($request->post()) && $model->validate()){

            $auth = \Yii::$app->authManager;
            $permission=$auth->createPermission($model->name);
            $permission->description = $model->description;
            $auth->add($permission);
            \Yii::$app->session->setFlash("success","创建".$model->description."成功");
            return $this->refresh();

//            echo  1111;exit();
        }


        return $this->render('add',['model'=>$model]);


    }


    public function actionEdit($name){
        $model=AuthItem::findOne($name);
        $request = \Yii::$app->request;

        if ($model->load($request->post()) && $model->validate()){

            $auth = \Yii::$app->authManager;
  //          $permission=$auth->createPermission($model->name);
            $permission=$auth->getPermission($model->name);
            if ($permission){

                $permission->description = $model->description;
                $auth->update($model->name,$permission);
                \Yii::$app->session->setFlash("success","创建".$model->description."成功");
                return $this->redirect('index');
            }



//            echo  1111;exit();
        }


        return $this->render('add',['model'=>$model]);


    }


    public function actionDel($name){

        $auth=\Yii::$app->authManager;
        //找到要删除的权限对象
        $permission=$auth->getPermission($name);
        //删除权限
        if ($auth->remove($permission)){
            \Yii::$app->session->setFlash("success","删除".$name."成功");
            return $this->redirect(["index"]);
        }


    }




}
