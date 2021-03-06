<?php
use models\User;
use components\UrlManager;

$modelName = $model->getClassName(false);

$this->title = 'Settings - ' . \CW::$app->user->identity->username . ' - ' . \CW::$app->params['siteName'];
?>
<script>
$(function() {
    var $categories = document.getElementsByName('<?= $modelName ?>[categories][]');

    var $imgInp = $('#img-inp');
    var $title = $('#title');

    function getCheckedCategoriesCount() {
        var c = 0;

        for (var i in $categories) {
            if ($categories[i].checked) {
                c++;
            }
        }

        return c;
    }

    $('#f1').on('submit', function() {
        var status = true;

        if (0 >= getCheckedCategoriesCount()) {
            status = false;
        }
        if (0 >= $title.val().length) {
            status = false;
        }

        return status;
    });
});
</script>

<div style="width : 700px; margin : auto; position: relative; border : 0px solid gray; ">
    <div class="start-page-cont" style="width : 250px; float: left; margin-top: 75px;">
        <ul class="edit-opt-cont">
            <li <?= $settingType === User::SETTINGS_PROFILE ? 'class="setting-selected"' : ''?>><a class="edit-opt-link" href="<?= UrlManager::to(['user/settings', 't' => User::SETTINGS_PROFILE]) ?>">Profile</a></li>
            <li <?= $settingType === User::SETTINGS_PICTURE ? 'class="setting-selected"' : ''?>><a class="edit-opt-link" href="<?= UrlManager::to(['user/settings', 't' => User::SETTINGS_PICTURE]) ?>">Picture</a></li>
            <li <?= $settingType === User::SETTINGS_PASSWORD ? 'class="setting-selected"' : ''?>><a class="edit-opt-link" href="<?= UrlManager::to(['user/settings', 't' => User::SETTINGS_PASSWORD]) ?>">Password</a></li>
        </ul>
    </div>
    <div style="margin : 10px; float: left; width : 400px">
        <?php if ($success) : ?>
        <div class="success" style="margin-top: 65px;">
            <i class="fa fa-check-circle"></i>
            <span class="success-msg">Profile successfully updated.</span>
        </div>
        <?php else : ?>
        <?php
        if ('password' === $settingType) {
            echo $this->render('_changePasswordForm');
        } else if ('picture' === $settingType) {
            echo $this->render('_changePorilePicture', [
                'modelName' => $modelName
            ]);
        } else {
            echo $this->render('_generalSettings', [
                'categories' => $categories,
                'model' => $model,
                'modelName' => $modelName,
            ]);
        } ?>
        <?php endif; ?>
    </div>
</div>
