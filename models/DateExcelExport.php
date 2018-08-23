<?php
/**
 * Created by PhpStorm.
 * User: haiye_000
 * Date: 12-Apr-17
 * Time: 10:33 AM
 */

namespace app\models;

use Yii;
use yii\base\Model;

class DateExcelExport extends Model
{
    public $dateStart;
    public $dateEnd;
    public $day;
    public $month;
    public $year;
    public $doiKiemTra;

    public function rules()
    {
        return [
            [['day', 'month', 'year', 'dateStart', 'dateEnd'], 'safe'],
            [['doiKiemTra'],'string']
        ];
    }

    public function attributeLabels()
    {

        return [
            'month' => Yii::t('app', 'Nhập tháng'),
            'doiKiemTra'=> Yii::t('app', 'Đội kiểm tra')
        ];
    }
}