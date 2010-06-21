<?php

	$tbg_response->setTitle(__('Manage projects - %project% - editions, components and releases', array('%project%' => $theProject->getName())));
	
?>
<table style="table-layout: fixed; width: 100%" cellpadding=0 cellspacing=0>
<tr>
<?php include_component('leftmenu', array('selected_section' => 10)); ?>
<td valign="top">
	<?php include_template('configuration/project_header', array('theProject' => $theProject, 'mode' => 3)); ?>
	<table style="width: 750px; margin-top: 10px;" cellpadding=0 cellspacing=0>
		<tr>
			<td style="width: auto; padding-right: 5px; vertical-align: top;">
				<div class="config_header nobg"><?php echo tbg_helpBrowserHelper('setup_editions', image_tag('help.png', array('style' => "float: right;"))); ?><b><?php echo __('Editions'); ?></b></div>
			<?php if ($theProject->isEditionsEnabled()): ?>
				<div style="padding: 0px 0px 5px 3px;"><?php echo __('Click an edition name to edit its information and settings, as well as manage builds for that edition'); ?>.</div>
				<div class="faded_medium" id="no_editions" style="padding: 5px;<?php if (count($theProject->getEditions()) > 0): ?> display: none;<?php endif; ?>"><?php echo __('There are no editions'); ?></div>
				<table cellpadding=0 cellspacing=0 style="width: 100%;">
					<tbody id="edition_table">
					<?php foreach ($theProject->getEditions() as $edition): ?>
						<?php include_template('editionbox', array('theProject' => $theProject, 'edition' => $edition)); ?>
					<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				<div style="padding: 2px 5px 5px 5px;" class="faded_medium"><?php echo __('This project does not use editions'); ?>.<br><?php echo __('Editions can be enabled in project settings'); ?>.</div>
			<?php endif; ?>
			</td>
			<td style="width: 375px; padding-right: 5px; vertical-align: top;">
				<div class="config_header nobg"><?php echo tbg_helpBrowserHelper('setup_components', image_tag('help.png', array('style' => "float: right;"))); ?><b><?php echo __('Components'); ?></b></div>
			<?php if ($theProject->isComponentsEnabled()): ?>
				<div style="padding: 0px 0px 5px 3px;"><?php echo __('This is a list of all the components available for this project'); ?>.</div>	
				<div class="faded_medium" id="no_components" style="padding: 5px;<?php if (count($theProject->getComponents()) > 0): ?> display: none;<?php endif; ?>"><?php echo __('There are no components'); ?></div>
				<table cellpadding=0 cellspacing=0 style="width: 100%;">
					<tbody id="component_table">
					<?php foreach ($theProject->getComponents() as $component): ?>
						<?php include_template('componentbox', array('component' => $component)); ?>
					<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				<div style="padding: 2px 5px 5px 5px;" class="faded_medium"><?php echo __('This project does not use components'); ?>.<br><?php echo __('Components can be enabled in project settings'); ?>.</div>
			<?php endif; ?>
			</td>
		</tr>
		<?php if ($access_level == configurationActions::ACCESS_FULL): ?>
			<tr>
				<td style="padding-right: 5px;">
				<?php if ($theProject->isEditionsEnabled()): ?>
					<form accept-charset="<?php echo TBGContext::getI18n()->getCharset(); ?>" action="<?php echo make_url('configure_projects_add_edition', array('project_id' => $theProject->getID())); ?>" method="post" id="add_edition_form" onsubmit="addEdition('<?php echo make_url('configure_projects_add_edition', array('project_id' => $theProject->getID())); ?>');return false;">
						<div class="rounded_box lightgrey">
							<b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
							<div class="xboxcontent" style="vertical-align: middle; padding: 5px; font-size: 12px;">
								<input type="submit" value="<?php echo __('Add'); ?>" style="float: right;">
								<label for="edition_name"><?php echo __('Add an edition'); ?></label>
								<input type="text" id="edition_name" name="e_name" style="width: 175px;">
							</div>
							<b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>
						</div>
						<table cellpadding=0 cellspacing=0 style="display: none; margin-left: 5px; width: 300px;" id="edition_add_indicator">
							<tr>
								<td style="width: 20px; padding: 2px;"><?php echo image_tag('spinning_20.gif'); ?></td>
								<td style="padding: 0px; text-align: left;"><?php echo __('Adding edition, please wait'); ?>...</td>
							</tr>
						</table>
					</form>
				<?php endif; ?>
				</td>
				<td style="padding-right: 5px;">
				<?php if ($theProject->isComponentsEnabled()): ?>
					<form accept-charset="<?php echo TBGContext::getI18n()->getCharset(); ?>" action="<?php echo make_url('configure_projects_add_component', array('project_id' => $theProject->getID())); ?>" method="post" id="add_component_form" onsubmit="addComponent('<?php echo make_url('configure_projects_add_component', array('project_id' => $theProject->getID())); ?>');return false;">
						<div class="rounded_box lightgrey">
							<b class="xtop"><b class="xb1"></b><b class="xb2"></b><b class="xb3"></b><b class="xb4"></b></b>
							<div class="xboxcontent" style="vertical-align: middle; padding: 5px; font-size: 12px;">
								<input type="submit" value="<?php echo __('Add'); ?>" style="float: right;">
								<label for="component_name"><?php echo __('Add a component'); ?></label>
								<input type="text" id="component_name" name="c_name" style="width: 175px;">
							</div>
							<b class="xbottom"><b class="xb4"></b><b class="xb3"></b><b class="xb2"></b><b class="xb1"></b></b>
						</div>
						<table cellpadding=0 cellspacing=0 style="display: none; margin-left: 5px; width: 300px;" id="component_add_indicator">
							<tr>
								<td style="width: 20px; padding: 2px;"><?php echo image_tag('spinning_20.gif'); ?></td>
								<td style="padding: 0px; text-align: left;"><?php echo __('Adding component, please wait'); ?>...</td>
							</tr>
						</table>
					</form>
				<?php endif; ?>
				</td>
			</tr>
		<?php endif; ?>
		<tr>
			<td colspan="2" style="padding-right: 5px; padding-top: 10px;">	
			<div class="config_header nobg" style="margin-top: 10px;"><?php echo tbg_helpBrowserHelper('setup_releases', image_tag('help.png', array('style' => "float: right;"))); ?><b><?php echo __('Releases'); ?></b></div>
			<?php if ($theProject->isBuildsEnabled()): ?>
				<?php include_template('builds', array('parent' => $theProject, 'access_level' => $access_level)); ?>
			<?php else: ?>
				<div style="padding: 2px 5px 5px 5px;" class="faded_medium"><?php echo __('This project does not use releases'); ?>.<br><?php echo __('Releases can be enabled in project settings'); ?>.</div>
			<?php endif; ?>
			</td>
		</tr>
	</table>
</td>
</tr>
</table>