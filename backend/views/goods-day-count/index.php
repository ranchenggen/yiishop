<?php
/* @var $this yii\web\View */
?>
<h1>创建了商品表</h1>



<?=\yii\bootstrap\Html::a('添加文章',['goods-day-count/add'],['class'=>'btn btn-success'])?>


<table class="table">

    <tr>
        <th>日期</th>
        <th>商品数</th>

    </tr>

    <?php foreach ($model as $models):?>

        <tr>
            <td><?=$models->day?></td>
            <td><?=$models->count?></td>



            <td>
                <?php
                echo   \yii\bootstrap\Html::a("编辑",['goods-day-count/edit','day'=>$models->day],['class'=>'btn btn-info']);
                echo   \yii\bootstrap\Html::a("删除",['goods-day-count/del','day'=>$models->day],['class'=>'btn btn-info']);


                ?>



            </td>

        </tr>

    <?php endforeach;?>
</table>

