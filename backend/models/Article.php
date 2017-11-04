<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $name
 * @property integer $articlel_id
 * @property string $intro
 * @property integer $status
 * @property integer $sort
 * @property integer $inputtime
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['articlel_id', 'status', 'sort', 'inputtime'], 'integer'],
            [['intro'], 'string'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '文章名',
            'articlel_id' => '文章类别',
            'intro' => '简介',
            'status' => '状态',
            'sort' => '排序',
            'inputtime' => 'Inputtime',
        ];
    }
    public function getArticlel(){

        return $this->hasOne(Articlel::className(),['id'=>'articlel_id']);


    }
    public function getArticlex(){

        return $this->hasOne(Articlex::className(),['article_id'=>'id']);


    }
}
