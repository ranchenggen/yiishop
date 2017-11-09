<?php

namespace backend\controllers;

use backend\models\Admin;
use backend\models\AdminForm;

class AdminController extends \yii\web\Controller
{
    public function actionIndex()
    {
       $model=new Admin();
        return $this->render('index',['model'=>$model]);
    }


    public function actionAdd(){

        $model=new Admin();

        $request=\Yii::$app->request;

        if ($model->load($request->post())){

//            var_dump($model->email);exit();
$model->password=\Yii::$app->security->generatePasswordHash($model->password);
            //随机字符串
            $model->token=\Yii::$app->security->generateRandomString();
            $model->token_create_time=time();
            $model->save();
//            var_dump($model->getErrors());exit();
            \Yii::$app->session->setFlash("success",'注册成功');
            // \Yii::$app->user->login($admin,3600*24*7);
            return $this->redirect(['login']);
        }
        return $this->render('add',['model'=>$model]);

    }

    public function actionLogin(){
        $model=new AdminForm();
        $request=\Yii::$app->request;
        if ($request->isPost){
            //数据绑定
            $model->load($request->post());
            if ($model->validate()){
                //根据用户名把用户对象查出来
                $admin=Admin::findOne(['username'=>$model->username]);
                if ($admin){
                    //存在 判断密码
                    if (\Yii::$app->security->validatePassword($model->password,$admin->password)){
                        //执行登录
                        \Yii::$app->user->login($admin,$model->rememberMe?3600*24*7:0);
                        //跳转
                        return $this->redirect(['index']);
                    }else{
                        //密码错误
                        $model->addError("password","密码错误");
                    }
                }else{
                    //不存在 提示没用用户名
                    $model->addError("username","用户名不存在");
                }
            }
        }


        return $this->render('login',['model'=>$model]);
    }

}
