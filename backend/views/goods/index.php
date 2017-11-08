<?php
/* @var $this yii\web\View */
?>
<h1>创建了商品表</h1>



<?=\yii\bootstrap\Html::a('添加文章',['goods/add'],['class'=>'btn btn-success'])?>


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
</table>
