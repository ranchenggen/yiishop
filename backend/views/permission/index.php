<?php
/* @var $this yii\web\View */
?>
<h1>权限列表</h1>
<?=\yii\bootstrap\Html::a('添加商品',['permission/add'],['class'=>'btn btn-success pull-left'])?>
<table class="table">
    <tr>
        <th>权限名称</th>
        <th>权限描述</th>
        <th>操作</th>
    </tr>
    <?php foreach ($permissions as $permission):?>

        <tr>
            <td>

                <?php
                echo strpos($permission->name,"/")?"---":"";
                ?><?=$permission->name?>
            </td>
            <td>

                <?=$permission->description?>
            </td>

            <td>

                <?=$permission->description?>
            </td>
            <td>
                <?php
                echo  \yii\bootstrap\Html::a("编辑",['edit','name'=>$permission->name],['class'=>'btn btn-info']);
                echo  \yii\bootstrap\Html::a("删除",['del','name'=>$permission->name],['class'=>'btn btn-danger']);
                ?>
            </td>
        </tr>


    <?php endforeach;?>

</table>