<?php
/* @var $this yii\web\View */
?>
<h1>用户列表</h1>
<?php

 $id= Yii::$app->user->id;

?>
<?=\yii\bootstrap\Html::a('添加用户',['admin/add'],['class'=>'btn btn-success pull-left'])?>
<?=  \yii\bootstrap\Html::a("修改自己信息",['edit','id'=>$id],['class'=>'btn btn-danger']);?>
<table class="table">
    <tr>
        <th>用户名称</th>
        <th>邮箱</th>
        <th>注册时间</th>
        <th>操作</th>
    </tr>
    <?php foreach ($models as $model):?>

        <tr>
            <td>
                  <?=$model->username?>
            </td>
            <td>

                <?=$model->email?>
            </td>

            <td>
                <?=date('Y-m-d H:i:s',$model->token_create_time)?>

            </td>
            <td>
                <?php

                echo  \yii\bootstrap\Html::a("删除",['del?id='.$model->id],['class'=>'btn btn-danger']);
                ?>
            </td>
        </tr>


    <?php endforeach;?>

</table>
