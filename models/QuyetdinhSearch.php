<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Quyetdinh;

/**
 * QuyetdinhSearch represents the model behind the search form about `app\models\Quyetdinh`.
 */
class QuyetdinhSearch extends Quyetdinh
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'noDongKyTruocChuyenSang', 'phatSinhTrongKy'], 'integer'],
            [['soQd', 'ngayQd', 'nienDoKiemTra', 'truongDoanId', 'ngayCongBoQdkt', 'ngayTrinhVbTamDungKt'], 'safe'],
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
        $query = Quyetdinh::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'ngayQd' => $this->ngayQd,
            'noDongKyTruocChuyenSang' => $this->noDongKyTruocChuyenSang,
            'phatSinhTrongKy' => $this->phatSinhTrongKy,
            'ngayCongBoQdkt' => $this->ngayCongBoQdkt,
            'ngayTrinhVbTamDungKt' => $this->ngayTrinhVbTamDungKt,
        ]);

        $query->andFilterWhere(['like', 'soQd', $this->soQd])
            ->andFilterWhere(['like', 'nienDoKiemTra', $this->nienDoKiemTra])
            ->andFilterWhere(['like', 'truongDoanId', $this->truongDoanId]);

        return $dataProvider;
    }
}
