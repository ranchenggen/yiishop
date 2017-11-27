<!-- 顶部导航 start -->
<div class="topnav">
    <div class="topnav_bd w990 bc">
        <div class="topnav_left">

        </div>
        <div class="topnav_right fr">
            <ul>
                <?php if (Yii::$app->user->isGuest){?>
                <li>您好，欢迎来到京西！[<?php echo \yii\helpers\Html::a('登陆啊',\yii\helpers\Url::to(['user/login']))?>] [<a href="/register.html">免费注册</a>] </li>
               <?php  }else{?>
                    <li>欢迎您，会员<?= Yii::$app->user->identity->username;

                        ;?> [<a href="<?php echo \yii\helpers\Url::to(['index/logout'])?>" class="aa" id="aa">退出登陆</a>]</li>
                <?php }?>
                <li class="line">|</li>
                <li>我的订单</li>
                <li class="line">|</li>
                <li>客户服务</li>

            </ul>
        </div>
    </div>
</div>
<!---->
<?php //$js=<<<EOF
//
//$('#aa').click(function(){
//console.log(11111);
//console.dir(11111);
//});
//
//
//
//EOF;
//
//$this->registerJs($js);
//
//?>
<!-- 顶部导航 end -->