<?php
/**
 * Created by PhpStorm.
 * User: thanh
 * Date: 22/6/2016
 * Time: 11:48 AM
 */

namespace app\models;

use Yii;
use yii\base\Model;

class ExportExcel extends Model
{
    public $start;
    public $end;
    public $month;
    public $year;
    public $truongDoan;
    public $truongDoan1;
    public $truongDoan2;
    public $doiKiemTra;
    public $doiKiemTra1;
    public $doiKiemTra2;
    public $doiKiemTra3;
    public $doiKiemTra4;

//    params for new report
    public $truongDoan3;
    public $truongDoan4;
    public $truongDoan5;
    public $truongDoan6;
    public $doiKiemTra5;
    public $doiKiemTra6;
    public $doiKiemTra7;
    public $doiKiemTra8;
    public $day;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start', 'end', 'day'], 'required'],
            [['start', 'end', 'day'], 'match', 'pattern' => '/^(0?[1-9]|1[0-9]|2[0-9]|3[0-1])\/(0?[1-9]|1[0-2])\/([0-9]{2}|[0-9]{4})$/'],
            [['month', 'year'], 'integer'],
            [['truongDoan', 'truongDoan1', 'truongDoan2', 'truongDoan3', 'truongDoan4', 'truongDoan5', 'truongDoan6', 'doiKiemTra', 'doiKiemTra1', 'doiKiemTra2', 'doiKiemTra3', 'doiKiemTra4', 'doiKiemTra5', 'doiKiemTra6', 'doiKiemTra7', 'doiKiemTra8'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'start' => Yii::t('app', 'Start'),
            'end' => Yii::t('app', 'End'),
            'month' => Yii::t('app', 'Month'),
            'year' => Yii::t('app', 'Year'),
            'truongDoan' => Yii::t('app', 'Trưởng Đoàn'),
            'truongDoan1' => Yii::t('app', 'Trưởng Đoàn'),
            'truongDoan2' => Yii::t('app', 'Trưởng Đoàn'),
            'truongDoan3' => Yii::t('app', 'Trưởng Đoàn'),
            'truongDoan4' => Yii::t('app', 'Trưởng Đoàn'),
            'truongDoan5' => Yii::t('app', 'Trưởng Đoàn'),
            'truongDoan6' => Yii::t('app', 'Trưởng Đoàn'),
            'doiKiemTra' => Yii::t('app', 'Đội Kiểm Tra'),
            'doiKiemTra1' => Yii::t('app', 'Đội Kiểm Tra'),
            'doiKiemTra2' => Yii::t('app', 'Đội Kiểm Tra'),
            'doiKiemTra3' => Yii::t('app', 'Đội Kiểm Tra'),
            'doiKiemTra4' => Yii::t('app', 'Đội Kiểm Tra'),
            'doiKiemTra5' => Yii::t('app', 'Đội Kiểm Tra'),
            'doiKiemTra6' => Yii::t('app', 'Đội Kiểm Tra'),
            'doiKiemTra7' => Yii::t('app', 'Đội Kiểm Tra'),
            'doiKiemTra8' => Yii::t('app', 'Đội Kiểm Tra'),

            'day' => Yii::t('app', 'Ngày')

        ];
    }
}