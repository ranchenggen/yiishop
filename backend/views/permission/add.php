<?php
//表单表开始
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'description');


echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-success']);
echo \yii\bootstrap\Html::a('返回',['permission/index'],['class'=>'btn btn-info']);



\yii\bootstrap\ActiveForm::end();
?>

