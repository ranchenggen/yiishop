<?php
//表单表开始
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'intro')->textarea();
echo $form->field($model,'sort');
echo $form->field($model,'name')->inline()->radioList(
    ["1"=>"是",'0'=>'否']
);
echo $form->field($model,'status')->inline()->radioList( ["1"=>"显示",'0'=>'隐藏']);


echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-success']);



\yii\bootstrap\ActiveForm::end();
?>
