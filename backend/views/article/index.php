<?php
/* @var $this yii\web\View */
?>
<h1>文章管理</h1>

<?=\yii\bootstrap\Html::a('添加文章',['article/add'],['class'=>'btn btn-success'])?>


<table class="table">

    <tr>
        <th>Id</th>
        <th>文章名</th>
        <th>文章分类</th>
        <th>简介</th>
        <th>状态</th>
        <th>排序</th>
        <th>录入时间</th>
        <th>操作</th>
    </tr>

    <?php foreach ($model as $models):?>

        <tr>
            <td><?=$models->id?></td>
            <td><?=$models->name?></td>
            <td><?=$models->articlel->name?></td>
            <td><?=$models->intro?></td>
            <td><?=$models->status?></td>
            <td><?=$models->sort?></td>
            <td><?=date('Y-m-d H:i:s',$models->inputtime)?></td>


            <td>
                <?php
                echo   \yii\bootstrap\Html::a("查看",['article/sel','id'=>$models->id],['class'=>'btn btn-info']);
                echo   \yii\bootstrap\Html::a("编辑",['article/edit','id'=>$models->id],['class'=>'btn btn-info']);
                echo   \yii\bootstrap\Html::a("删除",['article/del','id'=>$models->id],['class'=>'btn btn-info']);


                ?>



            </td>

        </tr>

    <?php endforeach;?>
</table>

