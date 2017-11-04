<?php
/* @var $this yii\web\View */
?>
<h1>文章分类</h1>

<?=\yii\bootstrap\Html::a('添加分类',['articlel/add'],['class'=>'btn btn-success'])?>


<table class="table">

    <tr>
        <th>Id</th>
        <th>类名</th>
        <th>简介</th>
        <th>状态</th>
        <th>排序</th>
        <th>是否是帮助相关分类</th>
        <th>操作</th>
    </tr>

    <?php foreach ($model as $models):?>

            <tr>
                <td><?=$models->id?></td>
                <td><?=$models->name?></td>
                <td><?=$models->intro?></td>
                <td><?=$models->status?></td>
                <td><?=$models->sort?></td>
                <td><?=$models->is_help?></td>


                <td>
                    <?php
                    echo   \yii\bootstrap\Html::a("编辑",['articlel/edit','id'=>$models->id],['class'=>'btn btn-info']);
                    echo   \yii\bootstrap\Html::a("删除",['articlel/del','id'=>$models->id],['class'=>'btn btn-info']);


                    ?>



                </td>

            </tr>

    <?php endforeach;?>
</table>
