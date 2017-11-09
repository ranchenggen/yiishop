<?php
/* @var $this yii\web\View */
?>
<h1>创建商品表</h1>



<?=\yii\bootstrap\Html::a('添加商品',['goods/add'],['class'=>'btn btn-success pull-left'])?>

<div >

 <form class="form-inline pull-right">
            <input type="text" class="form-control" id="minPrice" name="minPrice" size="8" placeholder="最低价" value="<?=Yii::$app->request->get('minPrice')?>"> -
            <input type="text" class="form-control" id="maxPrice" name="maxPrice"  size="8" placeholder="最高价" value="<?=Yii::$app->request->get('maxPrice')?>">
                <input type="text" class="form-control" id="keyword" name="keyword" placeholder="请输入商品名称或货号" value="<?=Yii::$app->request->get('keyword')?>">
            <button type="submit" class="btn btn-info glyphicon glyphicon-zoom-in"> 搜索</button>
        </form>


<!--    --><?php
//    $searchForm=new \backend\models\GoodsSearchForm();
//    $form=\yii\bootstrap\ActiveForm::begin([
//        'method' => 'get',
//        'options' => ['class'=>"form-inline pull-right"]
//    ]);
//    echo $form->field($searchForm,'minPrice')->label(false)->textInput(['size'=>5,'placeholder'=>"最低价"]);
//    echo "-";
//    echo $form->field($searchForm,'maxPrice')->label(false)->textInput(['size'=>5,'placeholder'=>"最高价"]);
//    echo " ";
//    echo $form->field($searchForm,'keyword')->label(false)->textInput(['size'=>20,'placeholder'=>"关键字"]);
//    echo " ";
//    echo \yii\bootstrap\Html::submitButton("搜索",['class'=>'btn btn-success','style'=>"margin-bottom:8px"]);
//    \yii\bootstrap\ActiveForm::end();
//    ?>

</div>


</div>

<table class="table">

    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>货号</th>
        <th>商品LOGO</th>
        <th>商品分类</th>
        <th>品牌</th>
        <th>市场价格</th>
        <th>本店价格</th>
        <th>库存</th>
        <th>是否上架</th>
        <th>状态</th>
        <th>排序</th>
        <th>录入时间</th>

    </tr>

    <?php foreach ($model as $models):?>

        <tr>
            <td><?=$models->id?></td>
            <td><?=$models->name?></td>
            <td><?=$models->sn?></td>
            <td><?=\yii\helpers\Html::img($models->logo,['height'=>40]) ; ?></td>
            <td><?=$models->goods_category_id?></td>
            <td><?=$models->brand_id?></td>
            <td><?=$models->market_price?></td>
            <td><?=$models->shop_price?></td>
            <td><?=$models->stock?></td>
            <td><?=$models->is_on_sale?></td>
            <td><?=$models->status?></td>
            <td><?=$models->sort?></td>
            <td><?=date('Y-m-d H:i:s',$models->inputtime)?></td>



            <td>
                <?php
                echo   \yii\bootstrap\Html::a("查看",['goods/look','id'=>$models->id],['class'=>'btn btn-info']);
                echo   \yii\bootstrap\Html::a("编辑",['goods/edit','id'=>$models->id],['class'=>'btn btn-warning']);
                echo   \yii\bootstrap\Html::a("删除",['goods/del','id'=>$models->id],['class'=>'btn btn-danger']);


                ?>



            </td>

        </tr>

    <?php endforeach;?>

    <?php



    ?>
</table>
