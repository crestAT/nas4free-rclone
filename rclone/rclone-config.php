<?php
/* 
    rclone-config.php

    Copyright (c) 2017 - 2018 Andreas Schmidhuber
    All rights reserved.

    Redistribution and use in source and binary forms, with or without
    modification, are permitted provided that the following conditions are met:

    1. Redistributions of source code must retain the above copyright notice, this
       list of conditions and the following disclaimer.
    2. Redistributions in binary form must reproduce the above copyright notice,
       this list of conditions and the following disclaimer in the documentation
       and/or other materials provided with the distribution.

    THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
    ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
    WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
    DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
    ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
    (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
    LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
    ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
    (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
    SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
*/
require("auth.inc");
require("guiconfig.inc");

$appName = "Rclone";
$configName = strtolower($appName);
$configFile = "ext/{$configName}/{$configName}.conf";
require_once("ext/{$configName}/extension-lib.inc");

$domain = strtolower(get_product_name());
$localeOSDirectory = "/usr/local/share/locale";
$localeExtDirectory = "/usr/local/share/locale-{$configName}";
bindtextdomain($domain, $localeExtDirectory);

// Dummy standard message gettext calls for xgettext retrieval!!!
$dummy = gettext("The changes have been applied successfully.");
$dummy = gettext("The configuration has been changed.<br />You must apply the changes in order for them to take effect.");
$dummy = gettext("The following input errors were detected");

if (($configuration = ext_load_config($configFile)) === false) $input_errors[] = sprintf(gettext("Configuration file %s not found!"), "{$configName}.conf");
if (!isset($configuration['rootfolder']) && !is_dir($configuration['rootfolder'] )) $input_errors[] = gettext("Extension installed with fault");

$pgtitle = array(gettext("Extensions"), $configuration['appname']." ".$configuration['version'], gettext("Configuration"));

if (!isset($configuration) || !is_array($configuration)) $configuration = array();

// initialize variables --------------------------------------------------
$logFile = "{$configuration['rootfolder']}/{$configName}.log";
$rcloneCmd = "rclone --config {$configuration['configPath']} --log-file {$logFile}";
$logBackupDate = "{$configuration['rootfolder']}/{$configName}_backup-date.txt";
$backupFailedMsg = "\<font color='red'\>\<b\>".gettext("Last backup failed!")."\<\/b\>\<\/font\>";
exec("{$rcloneCmd} listremotes", $definedRemotes);
// -----------------------------------------------------------------------

function get_backup_info() {
    global $logBackupDate;
	return exec("cat {$logBackupDate}");	
}

function get_process_info() {
    if (exec("pgrep rclone | awk 'BEGIN {ORS=\" \"} {print}'", $pid)) $state = '<a style=" background-color: #00ff00; ">&nbsp;&nbsp;<b>'
		.gettext("running").'</b>&nbsp;&nbsp;</a>'."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PID:&nbsp".$pid[0]; 
    else $state = '<a style=" background-color: #ff0000; ">&nbsp;&nbsp;<b>'.gettext("stopped").'</b>&nbsp;&nbsp;</a>';
	return ($state);
}

if (is_ajax()) {
	$procinfo['info'] = get_process_info();
	$procinfo['backup'] = get_backup_info();
	render_ajax($procinfo);
}

if ($_POST) {
	if (isset($_POST['save']) && $_POST['save']) {
	    unset($input_errors);
		$configuration['configPath'] = trim($_POST['configPath']);
		if ($configuration['configPath'] == "") $input_errors[] = sprintf(gettext("Parameter %s must not be empty!"), gettext("Configuration File"));
		else {
			$savemsg .= get_std_save_message(ext_save_config($configFile, $configuration)).$dbClientMsg."<br />";
			$rcloneCmd = "rclone --config {$configuration['configPath']} --log-file {$logFile}";
		}	
	}

	if(isset($_POST['upgrade']) && $_POST['upgrade']) {
		exec("{$rcloneCmd} version --check | awk '/latest\:/ {print $2}' > {$configuration['rootfolder']}/version_rclone.txt");
		$productVersionLatest = exec("cat {$configuration['rootfolder']}/version_rclone.txt");
		if ($configuration['productVersion'] == $productVersionLatest) $savemsg .= sprintf(gettext("Latest %s version %s is already installed."), $appName, $productVersionLatest)."<br />";
		else {
			$return_val = mwexec("fetch -vo {$configuration['rootfolder']}/master.zip {$configuration['currentBinaryUrl']}", false);
			if ($return_val == 0) {
			    $return_val = mwexec("tar -xf {$configuration['rootfolder']}/master.zip -C {$configuration['rootfolder']}/bin --strip-components 1", true);
			    if ($return_val == 0) {
			        exec("rm {$configuration['rootfolder']}/master.zip");
			        exec("chown root:wheel {$configuration['rootfolder']}/bin/*");
					$configuration['productVersion'] = exec("{$configuration['rootfolder']}/bin/rclone version --check | awk '/yours\:/ {print $2}'");
					ext_save_config($configFile, $configuration);
			        $savemsg .= sprintf(gettext("Update to version %s completed!"), $configuration['productVersion']);
			    } else {
			        $input_errors[] = sprintf(gettext("Archive file %s not found, installation aborted!"), "master.zip corrupt /");
			        return;
			    }
			} else {
			    $input_errors[] = sprintf(gettext("Archive file %s not found, installation aborted!"), $configuration['currentBinaryUrl']);
			    return;
			}
		}
	}

	if (isset($_POST['execute']) && $_POST['execute']) {
		$rcTaskFile = "{$configuration['rootfolder']}/tasks/{$configName}-task-{$_POST['execute']}.sh";
		$return_val = mwexec("nohup {$rcTaskFile} >/dev/null 2>&1 &", true);
		if ($return_val == 0)
			$savemsg .= sprintf(gettext("Task %s has been %s."), $_POST['execute'], gettext("started successfully"))."<br />";
		else $input_errors[] = sprintf(gettext("Task %s has been %s."), $_POST['execute'], gettext("unsuccessfully started"))."<br />";
	}

	if (isset($_POST['remove']) && $_POST['remove']) {
		$rcTaskFile = "{$configuration['rootfolder']}/tasks/{$configName}-task-{$_POST['remove']}.sh";
		if (is_file($rcTaskFile)) unlink($rcTaskFile);
		unset($configuration['tasks'][$_POST['remove']]);
		$savemsg .= sprintf(gettext("Task %s has been %s."), $_POST['remove'], gettext("removed"))."<br />";
		$savemsg .= get_std_save_message(ext_save_config($configFile, $configuration))."<br />";
	}

	if (isset($_POST['addCron']) && $_POST['addCron']) {
		$rcTaskFile = "{$configuration['rootfolder']}/tasks/{$configName}-task-{$_POST['addCron']}.sh";

		if (!is_array($config['cron'])) $config['cron'] = [];
        $cronjob = array();
        $a_cronjob = &$config['cron']['job'];

    	$cronjob['enable'] = true;
    	$cronjob['uuid'] = uuid();
    	$cronjob['desc'] = "Rclone task {$_POST['addCron']}";
    	$cronjob['minute'] = 0;
    	$cronjob['hour'] = 1;
    	$cronjob['day'] = true;
    	$cronjob['month'] = true;
    	$cronjob['weekday'] = true;
    	$cronjob['all_mins'] = 0;
    	$cronjob['all_hours'] = 0;
    	$cronjob['all_days'] = 1;
    	$cronjob['all_months'] = 1;
    	$cronjob['all_weekdays'] = 1;
    	$cronjob['who'] = 'root';
    	$cronjob['command'] = $rcTaskFile;

		$a_cronjob[] = $cronjob;
		$mode = UPDATENOTIFY_MODE_NEW;
		updatenotify_set("cronjob", $mode, $cronjob['uuid']);
		write_config();

		$retval = 0;
		if (!file_exists($d_sysrebootreqd_path)) {
			config_lock();
			$retval |= rc_update_service("cron");
			config_unlock();
		}
		$savemsg .= get_std_save_message($retval)."<br />";
		if ($retval == 0) {
			$savemsg .= sprintf(gettext("Task %s has been %s."), $_POST['addCron'], gettext("added to cron"))."<br />";
			updatenotify_delete("cronjob");
		} 
	}

	if (isset($_POST['add']) && $_POST['add']) {
		$_POST['rcName'] = str_replace(" ", "", $_POST['rcName']);
		$_POST['rcSource'] = trim($_POST['rcSource']);
		$_POST['rcDestination'] = trim($_POST['rcDestination']);

		if (($_POST['rcName'] == "") || ($_POST['rcSource'] == "") || ($_POST['rcDestination'] == "")) {
			$input_errors[] = sprintf(gettext("Parameter %s and/or %s must not be empty!"), gettext("Task Name").", ".gettext("Source"), gettext("Destination"));
		} else {
			$configuration['tasks'][$_POST['rcName']]['source'] = $_POST['rcSource'];
			$configuration['tasks'][$_POST['rcName']]['destination'] = $_POST['rcDestination'];
			$configuration['tasks'][$_POST['rcName']]['mode'] = $_POST['rcMode'];
			$configuration['tasks'][$_POST['rcName']]['flags'] = trim($_POST['rcFlags']);

			/* create task file */
			if (!is_dir("{$configuration['rootfolder']}/tasks")) mkdir("{$configuration['rootfolder']}/tasks", 0775);
			$rcTaskFile = "{$configuration['rootfolder']}/tasks/{$configName}-task-{$_POST['rcName']}.sh";
			$script = fopen($rcTaskFile, "w");
			$savemsg .= get_std_save_message(ext_save_config($configFile, $configuration))."<br />";
			fwrite($script, 
"#!/bin/sh
# WARNING: THIS IS AN AUTOMATICALLY CREATED SCRIPT, DO NOT CHANGE THE CONTENT!
# Command for cron usage: {$rcTaskFile}
logger {$appName} task {$_POST['rcName']} started
{$rcloneCmd} {$_POST['rcFlags']} {$_POST['rcMode']} {$_POST['rcSource']} {$_POST['rcDestination']}
if [ $? == 0 ]; then
	logger '{$appName} task {$_POST['rcName']} successfully finished'
	date > {$logBackupDate}
else
	logger '{$appName} task {$_POST['rcName']} stopped with error(s)'
	echo {$backupFailedMsg} > {$logBackupDate}
fi
");
			fclose($script);
			chmod($rcTaskFile, 0755);
#			$savemsg .= sprintf(gettext("Command for cron usage: %s"), $rcTaskFile).".<br />";
		}
	}
}

$pconfig['configPath'] = !empty($configuration['configPath']) ? $configuration['configPath'] : "{$configuration['rootfolder']}/rclone.conf";

// version checks for extension and binary - just once per day
if (($message = ext_check_version("{$configuration['rootfolder']}/version_server.txt", "{$configName}", $configuration['version'], gettext("Maintenance"))) !== false) $savemsg .= $message;
$test_filename = "{$configuration['rootfolder']}/version_rclone.txt";
if (!is_file($test_filename) || filemtime($test_filename) < time() - 86400) {	// test if file exists or is older than 24 hours
	exec("{$rcloneCmd} version --check | awk '/latest\:/ {print $2}' > {$test_filename}");
	$productVersionLatest = exec("cat {$test_filename}");
	if ($configuration['productVersion'] != $productVersionLatest) $savemsg .= sprintf(
			gettext("New %s version %s available, push '%s' button to install the new version!"), 
			$appName, $productVersionLatest, gettext("Upgrade")
		)."<br />";
}

bindtextdomain($domain, $localeOSDirectory);
include("fbegin.inc");
bindtextdomain($domain, $localeExtDirectory);
?>
<script type="text/javascript">//<![CDATA[
$(document).ready(function(){
	var gui = new GUI;
	gui.recall(0, 2000, '<?php echo $configName; ?>-config.php', null, function(data) { 
		$('#procinfo').html(data.info);
		$('#procinfo_backup').html(data.backup);
	});
});
//]]>
</script>

<form action="<?php echo $configName; ?>-config.php" method="post" name="iform" id="iform" onsubmit="spinner()">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr><td class="tabnavtbl">
		<ul id="tabnav">
			<li class="tabact"><a href="<?php echo $configName; ?>-config.php"><span><?=gettext("Configuration");?></span></a></li>
			<li class="tabinact"><a href="<?php echo $configName; ?>-update_extension.php"><span><?=gettext("Maintenance");?></span></a></li>
		</ul>
	</td></tr>
    <tr><td class="tabcont">
        <?php if (!empty($input_errors)) print_input_errors($input_errors);?>
        <?php if (!empty($savemsg)) print_info_box($savemsg);?>

		<!-- Status -->
        <table width="100%" border="0" cellpadding="6" cellspacing="0">
            <?php 
				html_titleline(gettext("Status"));
            	html_text("installation_directory", gettext("Installation directory"), sprintf(gettext("The extension is installed in %s"), $configuration['rootfolder']));
				html_text("productversion", "{$appName} ".gettext("Version"), $configuration['productVersion'], false);
			?>
            <tr>
				<td class="vncell"><?=gettext("Status");?></td>
				<td class="vtable"><span id="procinfo"><?=get_process_info()?></span></td>
            </tr>
            <tr>
				<td class="vncell"><?=gettext("Last Backup");?></td>
				<td class="vtable"><span id="procinfo_backup"><?=get_backup_info()?></span></td>
            </tr>
            <?php
            	html_text("remotes", gettext("Defined Remotes"), "<b>".exec("{$rcloneCmd} listremotes | awk 'BEGIN {ORS=\" \"} {print}'")."</b>");
				html_filechooser("configPath", gettext("Configuration File"), $pconfig['configPath'], sprintf(gettext("Path and file name for the %s configuration file."), $appName), $pconfig['configPath'], true, 60);
			?>
		</table>
        <div id="submit">
			<input id="save" name="save" type="submit" class="formbtn" value="<?=gettext("Save");?>"/>
			<input name="upgrade" type="submit" class="formbtn" title="<?=sprintf(gettext("Upgrade %s"), $appName);?>" value="<?=gettext("Upgrade");?>" />
        </div>

		<!-- Add task -->
		<table width="100%" border="0" cellpadding="6" cellspacing="0">
            <?php
				html_separator();
				html_titleline(gettext("Add Task"));
			?>
		</table>
		<table width="100%" border="0" cellpadding="6" cellspacing="0">
			<tr>
				<td width="15%" class="listhdrlr"><?=gettext("Task Name");?></td>
				<td width="20%" class="listhdrr"><?=gettext("Source");?></td>
				<td width="20%" class="listhdrr"><?=gettext("Destination");?></td>
				<td width="10%" class="listhdrc"><?=gettext("Mode");?></td>
				<td width="40%" class="listhdrr"><?=gettext("Additional Parameters");?></td>
				<td width="1%" class="listhdrc" nowrap="nowrap"><?=gettext("Action");?></td>
			</tr>
			<?php 
#foreach($definedRemotes as $dRemote) html_text("remote", $dRemote, exec("{$rcloneCmd} about {$dRemote} | awk 'BEGIN {ORS=\" \"} {print $1,$2}'"));
#foreach($configuration['tasks'] as $key => $cTask) html_text("task", $key, "{$cTask['mode']} {$cTask['source']} {$cTask['destination']} {$cTask['flags']}");
				echo "<tr>";
				echo "<td class='listlr'><input name='rcName' style='width:98%;' title='".gettext('Task Name')."' placeholder='Name' /></td>";
				echo "<td class='listr'><span style='width:98%; white-space:nowrap;'>";
					echo "<input name='rcSource' type='text' class='formfld' id='rcSource' style='width:85%;' value='/mnt' />&nbsp;";
					echo "<input name='rcSourcebrowsebtn' type='button' class='formbtn' id='rcSourcebrowsebtn' onclick='rcSourceifield = form.rcSource; 
						filechooser = window.open(&quot;filechooser.php?p=&quot;+encodeURIComponent(rcSourceifield.value)+&quot;&amp;sd=/mnt&quot;, &quot;filechooser&quot;, 
						&quot;scrollbars=yes,toolbar=no,menubar=no,statusbar=no,width=550,height=300&quot;); filechooser.ifield = rcSourceifield; 
						window.ifield = rcSourceifield;' value='...' />";
				echo "</span></td>";
				echo "<td class='listr'><input name='rcDestination' style='width:98%;' title='".gettext('Destination')."' placeholder='remote:destination' /></td>";
				echo "<td class='listr'><select name='rcMode' style='width:98%;' >";
					echo "<option value='copy'>copy</option>";
					echo "<option value='move'>move</option>";
					echo "<option value='sync'>sync</option>";
				echo "</select></td>";
				echo "<td class='listr' nowrap='nowrap'><input name='rcFlags' style='width:98%;' title='".gettext('Additional Parameters')."' value='' /></td>";
				echo "<td class='listrc' nowrap='nowrap'><input name='add' type='submit' class='formbtn' title='".gettext('Add Task')."' value='".gettext('Add')."' />";
				echo "</td>";
				echo "</tr>";
		?>
		</table>
        <div id="remarks">
            <?php html_remark("note", gettext("Note"), 
				sprintf(gettext("Please check the %s documentation")."</a>.", "<a href='https://rclone.org/docs/' target='_blank'>".$appName));?>
        </div><br />

		<!-- Task list -->
		<table width="100%" border="0" cellpadding="6" cellspacing="0">
			<tr>
				<td class="listhdrlr"><?=gettext("Task Name");?></td>
				<td class="listhdrr"><?=gettext("Source");?></td>
				<td class="listhdrr"><?=gettext("Destination");?></td>
				<td class="listhdrc"><?=gettext("Mode");?></td>
				<td class="listhdrr" nowrap="nowrap"><?=gettext("Additional Parameters");?></td>
				<td width="5%" class="listhdrc" nowrap="nowrap"><?=gettext("Action");?></td>
			</tr>
			<?php
				ksort($configuration['tasks'], SORT_NATURAL | SORT_FLAG_CASE);
				foreach($configuration['tasks'] as $key => $cTask) {
					echo "<tr>";
					echo "<td class='listlr'>{$key}</td>";
					echo "<td class='listr'>{$cTask['source']}</td>";
					echo "<td class='listr'>{$cTask['destination']}</td>";
					echo "<td class='listrc'>{$cTask['mode']}</td>";
					echo "<td class='listr'>{$cTask['flags']}</td>";
					echo "<td class='listrc' nowrap='nowrap'>
						<button name='execute' type='submit' class='formbtn' title='".gettext('Execute task')."' value='{$key}'>".gettext('Execute')."</button>
						<button name='addCron' type='submit' class='formbtn' title='".gettext('Add task to cron')."' value='{$key}'>".gettext('Add')."</button>
						<button name='remove' type='submit' class='formbtn' title='".gettext('Remove task')."' value='{$key}' 
							onclick=\"return confirm('".gettext('Do you really want to remove the task?')."')\">".gettext('Remove')."</button>
					</td>";
					echo "</tr>";
				}
			?>
		</table>
	</td></tr>
	</table>
	<?php include("formend.inc");?>
</form>
<?php include("fend.inc");?>