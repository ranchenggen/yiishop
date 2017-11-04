
<h1>文章内容</h1>

<h1><?=$model->name?></h1>
<?=$model->articlex->content?>
<br>

<?=\yii\bootstrap\Html::a('返回',['article/index'],['class'=>'btn btn-success'])?>
