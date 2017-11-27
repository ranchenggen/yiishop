<?php

namespace backend\controllers;

use backend\models\Admin;
use backend\models\AdminForm;
use yii\helpers\ArrayHelper;

class AdminController extends \yii\web\Controller
{
    public function actionIndex()
    {
       $models=Admin::find()->all();
        return $this->render('index',['models'=>$models]);
    }


    public function actionAdd(){

        $model=new Admin();

        $request=\Yii::$app->request;
        $auth=\Yii::$app->authManager;
        $role=$auth->getRoles();

        $role=ArrayHelper::map($role,"name","name");
//        var_dump($role);exit();
        if ($model->load($request->post())){

//            var_dump($model->email);exit();
            $model->password=\Yii::$app->security->generatePasswordHash($model->password);

            $model->token_create_time=time();//随机字符串
            $model->token=\Yii::$app->security->generateRandomString();
            $model->add_time=time();
            $model->save();
            //找到admin角色
            $roles=$model->role;
            if ($roles){
            foreach ($roles as  $rolea){
                $role=$auth->getRole($rolea);
                //把当前用户对象追加到admin角中
                $auth->assign($role,$model->id);
            }

            }
//
            \Yii::$app->session->setFlash("success",'注册成功');
            // \Yii::$app->user->login($admin,3600*24*7);
            return $this->redirect(['login']);
        }
        return $this->render('add',['model'=>$model,'role'=>$role]);

    }

    public function actionEdit($id){

        $model=Admin::findOne($id);

        $request=\Yii::$app->request;

       $model->password="";
//       var_dump($a);exit();

//        var_dump($model->password);exit();
        if ($model->load($request->post())){

//
            $model->password=\Yii::$app->security->generatePasswordHash($model->password);
            //随机字符串
            $model->token=\Yii::$app->security->generateRandomString();
            $model->token_create_time=time();
            $model->save();

            \Yii::$app->session->setFlash("success",'修改成功');
            // \Yii::$app->user->login($admin,3600*24*7);
            return $this->redirect(['index?id='.$id]);
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

                        $id=$admin->id;
//                        var_dump($id);exit();
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

    public function actionLogout(){
        //var_dump(\Yii::$app->user->identity);
        \Yii::$app->user->logout();
        return $this->redirect(['login']);
    }

    public function actionDel($id){

        $book=Admin::findOne($id);

//        var_dump($idc);exit();

        if ($book){

            $book->delete();
            $this->redirect(['index']);
        }else{

            exit("没有此用户");
        }
//
//        echo 1111;exit();
    }

}
