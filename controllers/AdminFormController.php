<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (СкикС)
 * @date 15.05.2015
 */
namespace skeeks\modules\cms\form2\controllers;

use skeeks\cms\modules\admin\controllers\AdminModelEditorController;
use skeeks\modules\cms\form2\models\Form2Form;

/**
 * Class AdminFormController
 * @package skeeks\cms\controllers
 */
class AdminFormController extends AdminModelEditorController
{
    public function init()
    {
        $this->name                     = "Управление формами";
        $this->modelShowAttribute       = "name";
        $this->modelClassName           = Form2Form::className();

        parent::init();
    }

}