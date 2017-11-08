<?php
namespace backend\controllers;
use backend\models\GoodsCategory;
use yii\helpers\Json;
class GoodsCategoryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $cates=GoodsCategory::find()->orderBy('tree,lft')->all();
        return $this->render('index',['cates'=>$cates]);
    }
    /**
     * 添加商品分类
     */
    public function actionAdd()
{
    $model=new GoodsCategory();
    //判断是不是Post提交
    $request=\Yii::$app->request;
    if ($request->isPost){
        //数据绑定
        $model->load($request->post());
        if ($model->validate()){
            //判断父亲Id是不是0 如果是0创建根目录
            if ($model->parent_id==0){

                $model->makeRoot();
            }else{
                //创建子分类
                //1.把父节点找到
                $cateParent=GoodsCategory::findOne(['id'=>$model->parent_id]);
                //2. 把当前节点对象添加到父类对象中
                $model->prependTo($cateParent);
            }
            \Yii::$app->session->setFlash("success",'添加目录成功');
            return $this->refresh();
        }
    }
    //得到所有的分类
    $cates=GoodsCategory::find()->asArray()->all();
    $cates[]=['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];
    $cates=Json::encode($cates);
    // var_dump($cates);exit;
    //显示视图
    return $this->render("add",['model'=>$model,'cates'=>$cates]);
}

    public function actionEdit($id)
    {
        $model=GoodsCategory::findOne($id);
        //判断是不是Post提交
        $request=\Yii::$app->request;

        if ($request->isPost){

            //数据绑定
            $model->load($request->post());

            if ($model->validate()){

                try{
                    //判断父亲Id是不是0 如果是0创建根目录

                    if ($model->parent_id==0){
                        //创建根目录
                        /* $cate=new GoodsCategory();
                         $cate->name="家电";
                         $cate->parent_id=0;
                         $cate->makeRoot();*/
                        // $model->makeRoot();
                        $model->save();
                    }else{

                        //创建子分类

                        //1.把父节点找到
                        $cateParent=GoodsCategory::findOne(['id'=>$model->parent_id]);

                        //2. 把当前节点对象添加到父类对象中

                        $model->prependTo($cateParent);

                    }
                }catch (\yii\db\Exception $e){
                    //  var_dump($e->getMessage());exit;
                    \Yii::$app->session->setFlash("danger",$e->getMessage());
                    return $this->refresh();

                }

                \Yii::$app->session->setFlash("success",'修改目录成功');

            }

        }
        //得到所有的分类
        $cates=GoodsCategory::find()->asArray()->all();
        $cates[]=['id'=>0,'parent_id'=>0,'name'=>'顶级分类'];
        $cates=Json::encode($cates);


        // var_dump($cates);exit;

        //显示视图
        return $this->render("add",['model'=>$model,'cates'=>$cates]);

    }


    public function  actionDel($id){
        $book=GoodsCategory::findOne($id);
   $panduan=GoodsCategory::findOne(['parent_id'=>$id]);
        if ($book){
           if ($panduan){
               exit("改分类有子类无法删除");
           }else{

               $book->deleteWithChildren();
               $this->redirect(['goods-category/index']);
           }

        }else{

            exit("没有该分类");
        }
    }

    public function  actionDel1($id){
        $book=GoodsCategory::findOne($id);

        if ($book){


                $book->deleteWithChildren();
                $this->redirect(['goods-category/index']);


        }else{

            exit("没有该分类");
        }
    }
//    public function actionTest()
//    {
//        $cate=new GoodsCategory();
//        $cate->name="家电";
//        $cate->parent_id=0;
//        $cate->makeRoot();
//        var_dump($cate->getErrors());
//    }
//    public function actionTest2()
//    {
//        //创建儿子分类
//        $cate=new GoodsCategory();
//        $cate->name="冰箱";
//        $cate->parent_id=1;
//        //找出家电分类对象
//        //把儿子分类加入家电分类
//        $cateParent=GoodsCategory::findOne(['id'=>$cate->parent_id]);
//        $cate->prependTo($cateParent);
//    }

}