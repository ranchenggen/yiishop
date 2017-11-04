<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "articlex".
 *
 * @property integer $article
 * @property string $content
 */
class Articlex extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'articlex';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [

            [['content'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'article_id' => '文章id',
            'content' => '内容',
        ];
    }
}
