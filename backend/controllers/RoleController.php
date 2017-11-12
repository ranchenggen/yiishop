<?php

namespace backend\controllers;

use backend\models\AuthItem;
use yii\helpers\ArrayHelper;

class RoleController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $auth=\Yii::$app->authManager;
        $roles=$auth->getRoles();
        return $this->render('index',compact('roles'));
    }

    public function actionAdd(){
        $model = new AuthItem();
        $auth=\Yii::$app->authManager;
        $request=\Yii::$app->request;
        if ($model->load($request->post()) && $model->validate()){

            $role = $auth->createRole($model->name);
            $role->description=$model->description;
//            var_dump($model->permissions);exit();
             if ($auth->add($role)){

                 if ($model->permissions){
                     foreach ($model->permissions as $permission){
//                         echo 1111;exit();
                         $auth->addChild($role,$auth->getPermission($permission));

                     }
                 }else{
//                     var_dump($model->permissions);exit();
                 }
             }
            \Yii::$app->session->setFlash("success","创建".$model->description."成功");
            return $this->redirect(['index']);

        }

        $permissions=$auth->getPermissions();
        $permissions=ArrayHelper::map($permissions,"name","description");

        return $this->render('add',compact('model','permissions'));

    }


    public function actionEdit($name){
        $model =AuthItem::findOne($name);
        $auth=\Yii::$app->authManager;

        //通过角色得到角色的所有权限
        $rolePermission=$auth->getPermissionsByRole($name);
        //取数组所有键

        $model->permissions=array_keys($rolePermission);

        $request=\Yii::$app->request;
        if ($model->load($request->post()) && $model->validate()){

            $role = $auth->getRole($model->name);

//            var_dump($model->permissions);exit();
            if ($role) {

                $role->description = $model->description;
                if ($auth->update($model->name, $role)) {
                    //在添加权限之前删除当前角色所有的权限
                    $auth->removeChildren($role);

                    if ($model->permissions) {
                        foreach ($model->permissions as $permission) {
//                         echo 1111;exit();
                            $auth->addChild($role, $auth->getPermission($permission));

                        }
                    }

                }
            }
            \Yii::$app->session->setFlash("success","创建".$model->description."成功");
            return $this->redirect(['index']);

        }

        $permissions=$auth->getPermissions();
        $permissions=ArrayHelper::map($permissions,"name","description");

        return $this->render('add',compact('model','permissions'));

    }

    public function actionDel($name)
    {
        $auth=\Yii::$app->authManager;
        //找到要删除的角色对象
        $role=$auth->getRole($name);
        //删除当前角色所有权限
        $auth->removeChildren($role);
        //删除角色
        if ( $auth->remove($role)){
            \Yii::$app->session->setFlash("success","删除".$name."成功");
            return $this->redirect(["index"]);
        }
    }

}
