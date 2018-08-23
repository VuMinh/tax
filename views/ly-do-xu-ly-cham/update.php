<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Lydoxulycham */
/* @var $bckt app\models\Lydoxulycham */
$this->title = Yii::t('app','Cập nhật lý do nộp chậm: ') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Lydoxulychams'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="lydoxulycham-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'bckt' => $bckt
    ]) ?>

</div>
