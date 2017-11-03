<?=\yii\bootstrap\Html::a('回到首页',['brand/index'],['class'=>'btn btn-success'])?>


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
        <?php if ($models->status===1 or $models->status===0){?>
            <tr>
                <td><?=$models->id?></td>
                <td><?=$models->name?></td>

                <td><?=\yii\bootstrap\Html::img("@web/".$models->logo,['height'=>40])?></td>
                <td><?=$models->sort?></td>
                <td><?=\backend\models\Brand::$statusArray[$models->status]?></td>

                <td>
                    <?php
                    echo   \yii\bootstrap\Html::a("编辑",['brand/edit','id'=>$models->id],['class'=>'btn btn-info']);
                    if ($models->status===0){
                        echo   \yii\bootstrap\Html::a("删除",['brand/del','id'=>$models->id],['class'=>'btn btn-danger']);
                    }


                    ?>



                </td>

            </tr>
        <?php }?>
    <?php endforeach;?>
</table>