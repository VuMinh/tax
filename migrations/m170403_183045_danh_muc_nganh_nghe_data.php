<?php

use yii\db\Migration;

class m170403_183045_danh_muc_nganh_nghe_data extends Migration
{
    public function up()
    {
        $this->batchInsert('{{%nganhnghe}}', [
            'maNganhNgheKdChinh', 'tenNganhNgheKdChinh', 'ghiChu'
        ], [
            ['SX', 'Sản suất', '',],
            ['TM', 'Thương mại', '',],
            ['XD', 'Xây dựng', '',],
            ['NH', 'Ngân hàng', '',],
            ['QLN', 'Quản lý nợ', '',],
            ['QLQ', 'Quản lý quĩ', '',],
            ['CK', 'Chứng khoán', '',],
            ['BH', 'Bảo Hiểm', '',],
            ['TM.BDS', 'Thương mại BĐS', '',],
            ['DA.BĐS', 'Dự án BĐS', '',],
            ['ĐTTC', 'Đầu tư tài chính', '',],
            ['AU', 'Ăn uống', 'Bao gồm cả các nhà hàng ăn uống',],
            ['TCSK', 'Tổ chức sự kiện', '',],
            ['DV.MS', 'Dịch vụ Matsa', '',],
            ['DV.NN', 'Dịch vụ nhà nghỉ', '',],
            ['KHAC', 'Dịch vụ khác', '',],
        ]);
    }

    public function down()
    {
        echo "m170321_160353_danh_muc_nganh_nghe_data cannot be reverted.\n";

        return false;
    }

}
