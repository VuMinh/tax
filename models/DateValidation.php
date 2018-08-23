<?php
/**
 * Created by PhpStorm.
 * User: vietv
 * Date: 4/20/2017
 * Time: 7:58 PM
 */

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the date validation.
 */
class DateValidation extends Model
{
    public $ngayQdThanhTra;
    public $ngayQdTruyThu;
    public $ngayQdKiemTra;
    public $ngayVb;
    public $ngayQdXuPhat;
    public $ngayQdThuHoiHoan;
    public $loaiQd;
    public $soQd;
    public $ngayKyBbkt;
    public $ngayCongBoQdkt;
    public $ngayTrinhVbTamDungKt;
    public $ngayQdXuLy;
    public $ngayTao;
    public $ngayQdkt;
    public $ngayQdxl;
    public $ngayKetLuan;
    public $ngayBaoCao;
    public $soQdxl;
    public $ngayPhatHanhHoaDon;
    public $ngayThayDoiChuSoHuuGanNhat;
    public $ngayThayDoiDiaDiemGanNhat;
    public $ngayBoTron;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['ngayPhatHanhHoaDon','ngayThayDoiChuSoHuuGanNhat','ngayThayDoiDiaDiemGanNhat','ngayBoTron','ngayQdThanhTra','ngayQdTruyThu','ngayQdKiemTra','ngayVb','ngayQdXuPhat','ngayQdThuHoiHoan','ngayKyBbkt','ngayCongBoQdkt','ngayTrinhVbTamDungKt','ngayQdXuLy','ngayTao','ngayQdkt','ngayQdxl','ngayKetLuan','ngayBaoCao'], 'match', 'pattern' => '/(^(0?[1-9]|1[0-9]|2[0-9]|3[0-1])\/(0?[1-9]|1[0-2])\/([0-9]{2}|[0-9]{4})$)|^$/', 'message' => 'Sai định dạng ngày tháng năm.'],
            [['loaiQd'],'integer'],
            [['soQd','soQdxl'],'string'],
            [['loaiQd','soQd'],'required']
        ];
    }

}