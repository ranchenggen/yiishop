<h1>商品详情</h1>

<?=\yii\bootstrap\Html::a('返回',['goods/index'],['class'=>'btn btn-success'])?>


<table class="table">

    <tr >
        <th>商品Id</th>
        <th>商品名</th>
        <th>商品描述</th>
        <th>商品LOGO</th>

    </tr>

    <tr>
        <th><?=$model->id?></th>
        <th><?=$model->name?></th>
        <th><?php

             echo   $model->goodsIntro->content;

            ?></th>
        <th><?=\yii\helpers\Html::img($model->logo,['height'=>40]) ; ?></th>

    </tr>
    <tr>
        <th>相册</th>
    </tr>

<tr>
<td>

            <?php
            //        echo $id;exit();
            foreach ($xiangce as $v){?>

                <?php   echo \yii\bootstrap\Html::img($v->path,['height'=>150]);?>



            <?php } ?>


</td>
</tr>
</table>









