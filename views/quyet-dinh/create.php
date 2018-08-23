<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Quyetdinh */

$this->title = Yii::t('app', 'Create Quyetdinh');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Quyetdinhs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quyetdinh-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
