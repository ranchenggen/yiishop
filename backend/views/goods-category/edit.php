<?php
/**
 * Created by PhpStorm.
 * User: kk
 * Date: 2017/11/5
 * Time: 19:01
 */$form = \yii\bootstrap\ActiveForm::begin();
echo $form->field($model, 'name');

echo $form->field($model, 'intro')->textarea();
echo \yii\bootstrap\Html::submitButton("提交", ['class' => 'btn btn-success']);
\yii\bootstrap\ActiveForm::end();