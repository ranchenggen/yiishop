<div class="login w990 bc mt10 regist">
    <div class="login_hd">
        <h2>用户注册</h2>
        <b></b>
    </div>


    <div class="login_bd">
        <div class="login_form fl">

            <?php
            $form=\yii\widgets\ActiveForm::begin(
                [
                    'fieldConfig' => [
                        'options'=>['tag'=>'li'],
                        'errorOptions'=>['tag'=>'p'],
                    ]
                ]
            );
            echo "<ul>";
            echo $form->field($model,"username")->textInput(['class'=>'txt'])->label('用户名：');
            echo $form->field($model,"password")->passwordInput(['class'=>'txt']);
            echo $form->field($model,"email")->textInput(['class'=>'txt']);
            echo $form->field($model,"mobile")->textInput(['class'=>'txt']);


           $button='<input type="button" onclick="bindPhoneNum(this)"  id="get_captcha" value="获取验证码" style="height: 25px;padding:3px 8px"/>';
            echo $form->field($model,"yanzheng",['template'=>"{label}\n{input}$button\n{hint}\n{error}",//输出模板
            ])->textInput(['class'=>'txt','style'=>'width:100px','disabled'=>'disabled']);

            echo $form->field($model,'tongyi')->hint("我已阅读并同意《用户注册协议》")->checkbox(['class'=>'chb']);
            echo '<li><label for="">&nbsp;</label>'.\yii\helpers\Html::submitButton('',['class'=>'login_btn']).'</li>';
            echo "</ul>";
            \yii\widgets\ActiveForm::end();
            ?>




        </div>

        <div class="mobile fl">
            <h3>手机快速注册</h3>
            <p>中国大陆手机用户，编辑短信 “<strong>XX</strong>”发送到：</p>
            <p><strong>1069099988</strong></p>
        </div>



    </div>
</div>

<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">

    function bindPhoneNum(){
        var num=$('#user-mobile').val();

        if(!num){
            alert("手机号必填");
            return
        }
        $.get(['sms'],{'num':num});


        //启用输入框
        $('#user-yanzheng').prop('disabled',false);

        var time=30;
        var interval = setInterval(function(){
            time--;
            if(time<=0){
                clearInterval(interval);
                var html = '获取验证码';
                $('#get_captcha').prop('disabled',false);
            } else{
                var html = time + ' 秒后再次获取';
                $('#get_captcha').prop('disabled',true);
            }

            $('#get_captcha').val(html);

        },1000);

    }
</script>