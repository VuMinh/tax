<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "{{%hanhvivipham}}".
 *
 * @property integer $id
 * @property string $hanhViViPham
 * @property string $ghiChu
 */
class Hanhvivipham extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%hanhvivipham}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hanhViViPham', 'ghiChu'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'hanhViViPham' => Yii::t('app', 'Hanh Vi Vi Pham'),
            'ghiChu' => Yii::t('app', 'Ghi Chu'),
        ];
    }
}
