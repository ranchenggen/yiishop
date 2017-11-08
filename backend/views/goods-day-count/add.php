<?php
//表单表开始
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'day');
echo $form->field($model,'count');


echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-success']);



\yii\bootstrap\ActiveForm::end();
?>
