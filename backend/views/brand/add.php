<?php
//表单表开始
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'intro')->textInput();
//echo $form->field($model,'imgFile')->fileInput();
// ActiveForm
echo $form->field($model, 'logo')->widget('manks\FileInput', []);

//// 非 ActiveForm
//echo '<label class="control-label">图片</label>';
//echo \manks\FileInput::widget([
//    'model' => $model,
//    'attribute' => 'logo',
//]);



echo $form->field($model,'sort');
echo $form->field($model,'status')->inline()->radioList(\backend\models\Brand::$statusArray);

echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-success']);



\yii\bootstrap\ActiveForm::end();
?>

