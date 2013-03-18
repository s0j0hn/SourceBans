<?php
/* @var $this AdminController */
/* @var $demosize string */
/* @var $total_admins integer */
/* @var $total_archived_protests integer */
/* @var $total_archived_submissions integer */
/* @var $total_bans integer */
/* @var $total_blocks integer */
/* @var $total_protests integer */
/* @var $total_servers integer */
/* @var $total_submissions integer */
?>
          <h3><?php echo Yii::t('sourcebans', 'Please select an option to administer.') ?></h3>
<?php $this->widget('zii.widgets.CMenu', array(
	'id' => 'admin',
	'items' => array(
		array(
			'label' => Yii::t('sourcebans', 'Admins'),
			'url' => array('admin/admins'),
			'visible' => Yii::app()->user->data->hasPermission('ADD_ADMINS', 'DELETE_ADMINS', 'EDIT_ADMINS', 'LIST_ADMINS'),
		),
		array(
			'label' => Yii::t('sourcebans', 'Bans'),
			'url' => array('admin/bans'),
			'visible' => Yii::app()->user->data->hasPermission('ADD_BANS', 'IMPORT_BANS', 'BAN_PROTESTS', 'BAN_SUBMISSIONS'),
		),
		array(
			'label' => Yii::t('sourcebans', 'Groups'),
			'url' => array('admin/groups'),
			'visible' => Yii::app()->user->data->hasPermission('ADD_GROUPS', 'DELETE_GROUPS', 'EDIT_GROUPS', 'LIST_GROUPS'),
		),
		array(
			'label' => Yii::t('sourcebans', 'Servers'),
			'url' => array('admin/servers'),
			'visible' => Yii::app()->user->data->hasPermission('ADD_SERVERS', 'DELETE_SERVERS', 'EDIT_SERVERS', 'LIST_SERVERS'),
		),
		array(
			'label' => Yii::t('sourcebans', 'Games'),
			'url' => array('admin/games'),
			'visible' => Yii::app()->user->data->hasPermission('ADD_GAMES', 'DELETE_GAMES', 'EDIT_GAMES', 'LIST_GAMES'),
		),
		array(
			'label' => Yii::t('sourcebans', 'Settings'),
			'url' => array('admin/settings'),
			'visible' => Yii::app()->user->data->hasPermission('SETTINGS'),
		),
	),
)) ?>
          <table width="100%" cellpadding="3" cellspacing="0">
            <tr>
              <td width="33%" align="center"><h3><?php echo Yii::t('sourcebans', 'Version Information') ?></h3></td>
              <td width="33%" align="center"><h3><?php echo Yii::t('sourcebans', 'Admin Information') ?></h3></td>
              <td width="33%" align="center"><h3><?php echo Yii::t('sourcebans', 'Ban Information') ?></h3></td>
            </tr>
            <tr>
              <td><?php echo Yii::t('sourcebans', 'Latest release') ?>: <strong id="relver"><?php echo Yii::t('sourcebans', 'Please wait') ?>...</strong></td>
              <td><?php echo Yii::t('sourcebans', 'Total admins') ?>: <strong><?php echo $total_admins ?></strong></td>
              <td><?php echo Yii::t('sourcebans', 'Total bans') ?>: <strong><?php echo $total_bans ?></strong></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td><?php echo Yii::t('sourcebans', 'Connection blocks') ?>: <strong><?php echo $total_blocks ?></strong></td>
            </tr>
            <tr>
              <td id="versionmsg"><?php echo Yii::t('sourcebans', 'Please wait') ?>...</td>
              <td>&nbsp;</td>
              <td><?php echo Yii::t('sourcebans', 'Total demo size') ?>: <strong><?php echo $demosize ?></strong></td>
            </tr>
            <tr>
              <td width="33%" align="center"><h3><?php echo Yii::t('sourcebans', 'Server Information') ?></h3></td>
              <td width="33%" align="center"><h3><?php echo Yii::t('sourcebans', 'Protest Information') ?></h3></td>
              <td width="33%" align="center"><h3><?php echo Yii::t('sourcebans', 'Submission Information') ?></h3></td>
            </tr>
            <tr>
              <td><?php echo Yii::t('sourcebans', 'Total servers') ?>: <strong><?php echo $total_servers ?></strong></td>
              <td><?php echo Yii::t('sourcebans', 'Total protests') ?>: <strong><?php echo $total_protests ?></strong></td>
              <td><?php echo Yii::t('sourcebans', 'Total submissions') ?>: <strong><?php echo $total_submissions ?></strong></td>
            </tr>
            <tr>
              <td>&nbsp;</td>
              <td><?php echo Yii::t('sourcebans', 'Archived protests') ?>: <strong><?php echo $total_archived_protests ?></strong></td>
              <td><?php echo Yii::t('sourcebans', 'Archived submissions') ?>: <strong><?php echo $total_archived_submissions ?></strong></td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
            </tr>
          </table>

<?php Yii::app()->clientScript->registerScript('admin_index', '
  $.getJSON("' . $this->createUrl('admin/version') . '", function(data) {
    if(data.error) {
      $("#relver").text("' . Yii::t('sourcebans', 'Error') . '").addClass("text-error");
      $("#versionmsg").text(data.error).addClass("text-error");
      return;
    }
    if(data.update) {
      $("#versionmsg").text("' . Yii::t('sourcebans', 'A new release is available.') . '").addClass("text-error");
    }
    else {
      $("#versionmsg").text("' . Yii::t('sourcebans', 'You have the latest release.') . '").addClass("text-success");
    }
    
    $("#relver").text(data.version);
    $("#versionmsg").css("font-weight", "bold");
  });
') ?>