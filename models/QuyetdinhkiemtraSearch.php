<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Quyetdinhkiemtra;

/**
 * QuyetdinhkiemtraSearch represents the model behind the search form about `app\models\Quyetdinhkiemtra`.
 */
class QuyetdinhkiemtraSearch extends Quyetdinhkiemtra
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'noDongKyTruocChuyenSang', 'phatSinhTrongKy', 'truongDoanId'], 'integer'],
            [['soQdKiemTra', 'ngayQdKiemTra', 'nienDoKiemTra', 'ngayCongBoQdkt', 'ngayTrinhVbTamDungKt'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Quyetdinhkiemtra::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('baocaokiemtras');
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ngayQdKiemTra' => $this->ngayQdKiemTra,
            'noDongKyTruocChuyenSang' => $this->noDongKyTruocChuyenSang,
            'phatSinhTrongKy' => $this->phatSinhTrongKy,
            'truongDoanId' => $this->truongDoanId,
            'ngayCongBoQdkt' => $this->ngayCongBoQdkt,
            'ngayTrinhVbTamDungKt' => $this->ngayTrinhVbTamDungKt,
        ]);

        $query->andFilterWhere(['like', 'soQdKiemTra', $this->soQdKiemTra])
            ->andFilterWhere(['like', 'nienDoKiemTra', $this->nienDoKiemTra])
            ->andFilterWhere(['like', 'nguoinopthue.tenNguoiNop', $this->soQdKiemTra]);

        return $dataProvider;
    }
}
