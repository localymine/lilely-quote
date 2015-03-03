<?php
$this->pageTitle = UserModule::t("Create User") . ' | ' . Yii::app()->name;
?>

<div class="content-header">
    <div class="header-section">
        <h1>
            <i class="gi gi-brush"></i><?php echo UserModule::t("Create User") ?><br/>
            <small>
                <a class="btn btn-sm btn-primary" href="<?php echo Yii::app()->createUrl('user/admin') ?>"><?php echo UserModule::t('Manage Users') ?></a>
                <a class="btn btn-sm btn-primary" href="<?php echo Yii::app()->createUrl('user/profileField/admin') ?>"><?php echo UserModule::t('Manage Profile Field') ?></a>
                <a class="btn btn-sm btn-primary" href="<?php echo Yii::app()->createUrl('user') ?>"><?php echo UserModule::t('List User') ?></a>
            </small>
        </h1>
    </div>
</div>

<?php
	echo $this->renderPartial('_form', array('model'=>$model,'profile'=>$profile));
?>