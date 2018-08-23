<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Baocaothanhtra */
/* @var $quyetdinhtruythu app\models\Quyetdinhtruythu */
/* @var $nguoinopthue app\models\Nguoinopthue */
/* @var $quyetdinhttra app\models\Quyetdinhthanhtra */
/* @var $lichsunopthanhtra app\models\Lichsunopthanhtra */
/* @var $datevalidation app\models\DateValidation */

$this->title = Yii::t('app', 'Create Baocaothanhtra');
$this->params['breadcrumbs'][] = ['label' => 'Baocaothanhtras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="baocaothanhtra-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'quyetdinhtruythu' => $quyetdinhtruythu,
        'nguoinopthue' => $nguoinopthue,
        'quyetdinhttra' => $quyetdinhttra,
        'lichsunopthanhtra' => $lichsunopthanhtra,
        'datevalidation' => $datevalidation,
    ]) ?>

</div>
