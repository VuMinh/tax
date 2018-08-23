<?php

use yii\db\Migration;

class m170403_183046_ly_do_hoan_thue_data extends Migration
{
    public function up()
    {
        $this->addColumn('{{%lydohoanthue}}', 'group', $this->text());
        $this->batchInsert('{{%lydohoanthue}}', [
            'maLyDoHoanThue', 'lyDoHoanThue', 'ghiChu', 'group'
        ], [
            ['A1', 'CSKD thương mại', '', 'Xuất khẩu'],
            ['A2', 'CSKD khác', '', 'Xuất khẩu'],
            ['A3', 'CSKD mới thành lập từ dự án đầu tư - Hoàn theo TT 92/2010/TT-BTC', '', 'Dự án đầu tư'],
            ['A4', 'CSKD mới thành lập từ dự án đầu tư - Hoàn đầu tư khác', '', 'Dự án đầu tư'],
            ['A5', 'CSKD đang hoạt động có dự án đầu tư - Hoàn theo TT 92/2010/TT-BTC', '', 'Dự án đầu tư'],
            ['A6', 'CSKD đang hoạt động có dự án đầu tư - Hoàn đầu tư khác', '', 'Dự án đầu tư'],
            ['A7', 'Dự án sử dụng nguồn vốn ODA không hoàn lại', '', 'Hoàn thuế GTGT đối với dự án ODA, viện trợ nhân đạo, miễn trừ ngoại giao'],
            ['A8', 'Tổ chức, cá nhân nước ngoài, tổ chức ở Việt Nam sử dụng tiền viện trợ nhân đạo, viện trợ không hoàn lại của nước ngoài mua hàng hóa, dịch vụ có thuế GTGT ở VN để viện trợ không hoàn lại, viện trợ nhân đạo', '', 'Hoàn thuế GTGT đối với dự án ODA, viện trợ nhân đạo, miễn trừ ngoại giao'],
            ['A9', 'Hoàn cho  đối tượng hưởng ưu đãi miễn trừ ngoại giao', '', 'Hoàn thuế GTGT đối với dự án ODA, viện trợ nhân đạo, miễn trừ ngoại giao'],
            ['A10', 'Hoàn thuế GTGT theo điều ước quốc tế mà CHXHCNVN là thành viên (ngoài các trường hợp trên)', '', 'Hoàn thuế GTGT đối với dự án ODA, viện trợ nhân đạo, miễn trừ ngoại giao'],
            ['A11', 'CSKD lũy kế sau ít nhất 12 tháng (04 quý) tính từ tháng (quý) đầu tiên vẫn còn số thuế GTGT đầu vào chưa được khấu trừ (từ tháng  12/2013 - 07/2015)', '', 'CSKD lũy kế sau ít nhất 12 tháng (04 quý) tính từ tháng (quý) đầu tiên vẫn còn số thuế GTGT đầu vào chưa được khấu trừ'],
            ['A12', 'H oàn thuế GTGT đối với CSKD nộp thuế GTGT theo phương pháp khấu trừ thuế khi chuyển đổi sở hữu, chuyển đổi doanh nghiệp, sáp nhập, hợp nhất, chia, tách, giải thể, phá sản, chấm dứt hoạt động', '', 'H oàn thuế GTGT đối với CSKD nộp thuế GTGT theo phương pháp khấu trừ thuế khi chuyển đổi sở hữu, chuyển đổi doanh nghiệp, sáp nhập, hợp nhất, chia, tách, giải thể, phá sản, chấm dứt hoạt động'],
            ['A13', 'Cơ sở kinh doanh có quyết định xử lý hoàn thuế của cơ quan có thẩm quyền theo quy định của pháp luật (ngoài các trường hợp nêu trên)', '', 'Cơ sở kinh doanh có quyết định xử lý hoàn thuế của cơ quan có thẩm quyền theo quy định của pháp luật (ngoài các trường hợp nêu trên)'],
            ['A14', 'Trường hợp khác', '', 'Trường hợp khác'],
            ['B1', ' Hoàn thông qua tổ chức chi trả ', '', ' Thuế TNCN'],
            ['B2', ' Hoàn trực tiếp cho cá nhân ', '', ' Thuế TNCN'],
            ['C1', 'Tổ chức', '', 'Hiệp định tránh đánh thuế hai lần'],
            ['C2', 'Cá nhân', '', 'Hiệp định tránh đánh thuế hai lần'],
            ['D1', 'Hoàn thuế bảo vệ môi trường', '', 'Hoàn thuế bảo vệ môi trường'],
            ['E1', 'Hoàn thuế, phí nộp thừa theo Luật Quản lý thuế ', '', 'Hoàn thuế, phí nộp thừa theo Luật Quản lý thuế'],
            ['E2', 'Thuế, phí nộp thừa', '', 'Hoàn thuế, phí nộp thừa theo Luật Quản lý thuế'],
            ['F', ' Thuế, phí khác', '', ' Thuế, phí khác'],
        ]);
    }

    public function down()
    {
        echo "m170321_162546_ly_do_hoan_thue_data cannot be reverted.\n";

        return false;
    }
}
