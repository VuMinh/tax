<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ketquakttaitrusonnt */
/* @var $nguoinopthue app\models\Nguoinopthue */
/* @var $datevalidation app\models\DateValidation */

$this->title = Yii::t('app','Cập nhật kết quả kiểm tra tại người nộp thuế: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ketquakttaitrusonnts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ketquakttaitrusonnt-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'nguoinopthue' => $nguoinopthue,
        'datevalidation' => $datevalidation
    ]) ?>

</div>
