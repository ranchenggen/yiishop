<?php
//表单表开始
$form=\yii\bootstrap\ActiveForm::begin();
echo $form->field($model,'name');
echo $form->field($model,'sn');
echo $form->field($model, 'logo')->widget('manks\FileInput', []);
echo $form->field($gallery, 'path')->widget('manks\FileInput', [
    'clientOptions' => [
        'pick' => [
            'multiple' => true,
        ],
    ],
]);
echo $form->field($gallery, 'imgFlie')->widget('manks\FileInput', [
    'clientOptions' => [
        'pick' => [
            'multiple' => true,
        ],

    ],
]);
echo $form->field($model,'goods_category_id')->dropDownList($option);
//echo $form->field($model,'name')->dropDownList($);
echo $form->field($model,'brand_id')->dropDownList($option1);
echo $form->field($model,'market_price');
echo $form->field($model,'shop_price');
echo $form->field($model,'stock');
echo $form->field($model,'is_on_sale')->inline()->radioList([
    '1'=>"是",'0'=>"否"
]);
echo $form->field($model,'status')->inline()->radioList([
    '1'=>"正常",'0'=>"隐藏"
]);
echo $form->field($model,'sort');
echo $form->field($intro,'content')->textarea();
//echo $form->field($model,'inputtime')->hiddenInput();


echo \yii\bootstrap\Html::submitButton("提交",['class'=>'btn btn-success']);



\yii\bootstrap\ActiveForm::end();
?>
