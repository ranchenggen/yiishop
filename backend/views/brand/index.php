<?=\yii\bootstrap\Html::a('添加商品',['brand/add'],['class'=>'btn btn-success'])?>
<?=\yii\bootstrap\Html::a('回收站',['brand/huishou'],['class'=>'btn btn-success'])?>

<table class="table">

    <tr>
        <th>Id</th>
        <th>品牌名</th>
         <th>图片</th>
        <th>排序</th>
        <th>状态</th>

        <th>操作</th>
    </tr>

    <?php foreach ($model as $models):?>
        <?php if ($models->status===2){?>
        <tr>
            <td><?=$models->id?></td>
            <td><?=$models->name?></td>

            <td><?=\yii\bootstrap\Html::img($models->image,['height'=>40])?></td>
            <td><?=$models->sort?></td>
            <td><?=\backend\models\Brand::$statusArray[$models->status]?></td>

            <td>
                <?php
                echo   \yii\bootstrap\Html::a("编辑",['brand/edit','id'=>$models->id],['class'=>'btn btn-info']);


                ?>



            </td>

        </tr>
    <?php }?>
    <?php endforeach;?>
</table>


<?php

echo \yii\widgets\LinkPager::widget([

    'pagination' => $page
]);
?>
