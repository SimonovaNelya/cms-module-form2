<?php

use yii\helpers\Html;
use skeeks\cms\modules\admin\widgets\form\ActiveFormUseTab as ActiveForm;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model \skeeks\modules\cms\form2\models\Form2Form */
/* @var $console \skeeks\cms\controllers\AdminUserController */
/* @var $action \skeeks\cms\modules\admin\actions\modelEditor\AdminOneModelEditAction */
$controller = $this->context;
?>
<?=
    \skeeks\modules\cms\form2\cmsWidgets\form2\FormWidget::widget([
        'namespace' => "FormWidget-admin-" . $controller->model->id,
        'form_id'   => $controller->model->id
    ]);
?>
