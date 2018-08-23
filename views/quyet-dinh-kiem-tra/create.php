<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Quyetdinhkiemtra */

$this->title = Yii::t('app', 'Create Quyetdinhkiemtra');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Quyetdinhkiemtras'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="quyetdinhkiemtra-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
