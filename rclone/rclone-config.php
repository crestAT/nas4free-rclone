<?php
/* 
    rclone-config.php

    Copyright (c) 2017 - 2019 Andreas Schmidhuber
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
$rcloneCmd = "/usr/local/bin/rclone --config '{$configuration['configPath']}' --log-file '{$logFile}'";
$logBackupDate = "{$configuration['rootfolder']}/{$configName}_backup-date.txt";
$backupSuccessMsg = gettext("successfully finished");
$backupFailedMsg = gettext("stopped with error(s)");
exec("{$rcloneCmd} listremotes", $definedRemotes);
$rcName = "";
$rcSource = "";
$rcDestination = "";
$rcMode = "";
$rcFlags = "";
$selectOptions = array("copy", "check", "mount", "move", "sync");
// -----------------------------------------------------------------------

function get_backup_info() {
    global $logBackupDate;
	return exec("cat {$logBackupDate}");	
}

function get_process_info() {
    if (exec("pgrep rclone", $pid)) {
		$state = '<a style=" background-color: #00ff00; ">&nbsp;&nbsp;<b>'.gettext("running").'</b>&nbsp;&nbsp;</a>'."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PID:&nbsp";
		foreach($pid as $p) {
			$parentPID = exec("procstat -h {$p} | awk '{print $2}'");
			if (is_file("/var/run/rclone/{$parentPID}.name")) $state .= "<b>{$p}</b> (".exec("cat /var/run/rclone/{$parentPID}.name").")&nbsp;&nbsp;";
			else $state .= "<b>{$p}</b>&nbsp;&nbsp;"; 
		}
	} 
    else $state = '<a style="color:black; background-color:darkgrey; ">&nbsp;&nbsp;<b>'.gettext("idle").'</b>&nbsp;&nbsp;</a>';
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
			$savemsg .= get_std_save_message(ext_save_config($configFile, $configuration))."<br />";
			$rcloneCmd = "/usr/local/bin/rclone --config '{$configuration['configPath']}' --log-file '{$logFile}'";
			unset($definedRemotes);
			exec("{$rcloneCmd} listremotes", $definedRemotes);
			mwexec("mkdir -p /root/.config/rclone", true);
			mwexec("ln -sf {$configuration['configPath']} /root/.config/rclone/rclone.conf", true);
		}	
	}

	if(isset($_POST['upgrade']) && $_POST['upgrade']) {
		exec("{$rcloneCmd} version --check | awk '/latest\:/ {print $2}' > {$configuration['rootfolder']}/version_rclone.txt");
		$productVersionLatest = exec("cat {$configuration['rootfolder']}/version_rclone.txt");
		if ($configuration['productVersion'] == $productVersionLatest) $savemsg .= sprintf(gettext("Latest %s version %s is already installed."), $appName, $productVersionLatest)."<br />";
		else {
			$return_val = mwexec("fetch -vo {$configuration['rootfolder']}/master.zip {$configuration['currentBinaryUrl']}", false);
			if ($return_val == 0) {
			    $return_val = mwexec("LC_ALL=en_US.UTF-8 tar -xf {$configuration['rootfolder']}/master.zip -C {$configuration['rootfolder']}/bin --strip-components 1", true);
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
		if ($return_val == 0) $savemsg .= sprintf(gettext("Task %s has been %s."), $_POST['execute'], gettext("started successfully"))."<br />";
		else $input_errors[] = sprintf(gettext("Task %s has been %s."), $_POST['execute'], gettext("unsuccessfully started"))."<br />";
		$savemsg .= gettext("The output goes to the log file.")."<br />";
	}

	if (isset($_POST['edit']) && $_POST['edit']) {
		$rcName = $_POST['edit'];
		$rcSource = $configuration['tasks'][$_POST['edit']]['source'];
		$rcDestination = $configuration['tasks'][$_POST['edit']]['destination'];
		$rcMode = $configuration['tasks'][$_POST['edit']]['mode'];
		$rcFlags = $configuration['tasks'][$_POST['edit']]['flags'];
	}

	if (isset($_POST['remove']) && $_POST['remove']) {
		$rcTaskFile = "{$configuration['rootfolder']}/tasks/{$configName}-task-{$_POST['remove']}.sh";
		if (is_file($rcTaskFile)) unlink($rcTaskFile);
		unset($configuration['tasks'][$_POST['remove']]);
		ext_save_config($configFile, $configuration);
		
		if (is_array($config['cron']) && is_array($config['cron']['job']['0'])) {
			$rc_param_count = count($config['cron']['job']);
		    for ($i = 0; $i < $rc_param_count; $i++) if (preg_match("/Rclone task {$_POST['remove']}/", $config['cron']['job'][$i]['desc'])) unset($config['cron']['job'][$i]);
			write_config();
			$retval = 0;
			if (!file_exists($d_sysrebootreqd_path)) {
				config_lock();
				$retval |= rc_update_service("cron");
				config_unlock();
			}
			if ($retval != 0) $input_errors[] = sprintf(gettext("Task %s has been %s."), $_POST['remove'], gettext("unsuccessfully removed from cron"));
		}
		$savemsg .= sprintf(gettext("Task %s has been %s."), $_POST['remove'], gettext("removed"))."<br />";
	}

	if (isset($_POST['about']) && $_POST['about']) foreach($definedRemotes as $dRemote) {
		$execOutput = exec("{$rcloneCmd} about {$dRemote} | awk 'BEGIN {ORS=\" \"} {print $1,$2}'");
		if ($execOutput == "") $execOutput = "n/a";
		$aboutRemotes[] = array($dRemote, $execOutput); 
	}

	if (isset($_POST['executeOnce']) && $_POST['executeOnce']) {
		$execCommand = trim($_POST['rcFlags']);
		if ($execCommand[0] == "-") {
			$input_errors[] = gettext('Execute Single Command')." -> ".gettext("not a valid command").": {$execCommand}";
			$input_errors[] = sprintf(gettext("Use non-interactive commands like %s or %s in the input field %s"), "'tree remote:Remote/Path'", "'lsd remote:Remote/Path'",
				"'".gettext("Additional Parameters")." / ".gettext("Single Command")."'");
		} else if (!empty($execCommand)) exec("{$rcloneCmd} {$execCommand}", $execOutput);
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
		if ($retval == 0) {
			$savemsg .= sprintf(gettext("Task %s has been %s."), $_POST['addCron'], gettext("added to cron"))." ".
				gettext("Default is everyday at 1:00, consider creating your own schedule.")."<br />";
			updatenotify_delete("cronjob");
		} else $input_errors[] = sprintf(gettext("Task %s has been %s."), $_POST['remove'], gettext("unsuccessfully added to cron"));
	}

	if (isset($_POST['add']) && $_POST['add']) {
		$replaceSearch = array("*", "?");
		$replaceReplace = array("\*", "\?");

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
			$shFlags = str_replace($replaceSearch, $replaceReplace, trim($_POST['rcFlags']));	// do it for the shell script
			
			/* create task file */
			if (!is_dir("{$configuration['rootfolder']}/tasks")) mkdir("{$configuration['rootfolder']}/tasks", 0775);
			$rcTaskFile = "{$configuration['rootfolder']}/tasks/{$configName}-task-{$_POST['rcName']}.sh";
			$script = fopen($rcTaskFile, "w");
			$return_val .= ext_save_config($configFile, $configuration);
			if ($return_val == 0) $savemsg .= sprintf(gettext("Task %s has been %s."), $_POST['rcName'], gettext("saved successfully"))."<br />";
			else $input_errors[] = sprintf(gettext("Task %s has been %s."), $_POST['rcName'], gettext("unsuccessfully saved")); 
# --stats-one-line
			fwrite($script, 
"#!/bin/sh
# WARNING: THIS IS AN AUTOMATICALLY CREATED SCRIPT, DO NOT CHANGE THE CONTENT!
# Command for cron usage: {$rcTaskFile}
PID=$$
mkdir -p /var/run/rclone
echo {$_POST['rcName']} > /var/run/rclone/\$PID.name
logger '{$appName} task {$_POST['rcName']} started with PID = '\$PID
{$rcloneCmd} {$shFlags} {$_POST['rcMode']} '{$_POST['rcSource']}' '{$_POST['rcDestination']}'
if [ $? == 0 ]; then
	logger '{$appName} task {$_POST['rcName']} successfully finished'
	echo '{$_POST['rcName']} {$backupSuccessMsg}' `date` > {$logBackupDate}
else
	logger '{$appName} task {$_POST['rcName']} stopped with error(s)'
	echo '<font color='red'><b>{$_POST['rcName']} {$backupFailedMsg}</b></font>' `date` > {$logBackupDate}
fi
rm /var/run/rclone/\$PID.name
");
			fclose($script);
			chmod($rcTaskFile, 0755);
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
<style style="text/css">
	.hoverTable tr:hover td {background-color:#CCCCCC;}
</style>

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
            	html_text("installation_directory", gettext("Installation Directory"), sprintf(gettext("The extension is installed in %s"), $configuration['rootfolder']));
				html_text("productversion", "{$appName} ".gettext("Version"), $configuration['productVersion'], false);
			?>
            <tr>
				<td class="vncell"><?=gettext("Status");?></td>
				<td class="vtable"><span id="procinfo"><?=get_process_info()?></span></td>
            </tr>
            <tr>
				<td class="vncell"><?=gettext("Last Run");?></td>
				<td class="vtable"><span id="procinfo_backup"><?=get_backup_info()?></span></td>
            </tr>
            <?php
            	if (empty($definedRemotes)) $aboutButton = "";
            	else $aboutButton = "&nbsp;&nbsp;&nbsp;<button name='about' type='submit' class='formbtn' title='".
					gettext('Execute the about command for all defined remotes, please be patient as this can take a while!')."' value='about'>".gettext('About')."</button>";
 
            	html_text("remotes", gettext("Defined Remotes"), "<b>".exec("{$rcloneCmd} listremotes | awk 'BEGIN {ORS=\" \"} {print}'")."</b>{$aboutButton}");
				if (isset($_POST['about']) && $_POST['about']) foreach($aboutRemotes as $aRemote)
					html_text("remote", "&#9495;&#9473;&#9473;&nbsp;{$aRemote[0]}", $aRemote[1]);
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
				html_titleline(gettext("Add Task")." / ".gettext("Execute Single Command"));
			?>
		</table>
		<table width="100%" border="0" cellpadding="6" cellspacing="0">
			<tr>
				<td width="15%" class="listhdrlr"><?=gettext("Task Name");?></td>
				<td width="20%" class="listhdrr"><?=gettext("Source");?></td>
				<td width="20%" class="listhdrr"><?=gettext("Destination");?></td>
				<td width="10%" class="listhdrc"><?=gettext("Command");?></td>
				<td width="40%" class="listhdrr"><?=gettext("Additional Parameters")." / ".gettext("Single Command");?></td>
				<td width="1%" class="listhdrc" nowrap="nowrap"><?=gettext("Action");?></td>
			</tr>
			<?php 
				echo "<tr>";
				echo "<td class='listlr'><input name='rcName' style='width:98%;' title='".gettext('Task Name')."' placeholder='".gettext('Name')."' value='{$rcName}' /></td>";
				/* source */
				echo "<td class='listr'><span style='width:98%; white-space:nowrap;'>";
					echo "<input name='rcSource' type='text' class='formfld' id='rcSource' style='width:calc(100% - 33px);' 
						title='".gettext('Local path (use browser button) or remote:path')."' 
						placeholder='".gettext('Local path (use browser button) or remote:path')."' value='{$rcSource}' />&nbsp;";
					echo "<input name='rcSourcebrowsebtn' type='button' class='formbtn' id='rcSourcebrowsebtn' onclick='rcSourceifield = form.rcSource; 
						filechooser = window.open(&quot;filechooser.php?p=&quot;+encodeURIComponent(rcSourceifield.value)+&quot;&amp;sd=/mnt&quot;, &quot;filechooser&quot;, 
						&quot;scrollbars=yes,toolbar=no,menubar=no,statusbar=no,width=550,height=300&quot;); filechooser.ifield = rcSourceifield; 
						window.ifield = rcSourceifield;' value='...' />";
				echo "</span></td>";
				/* destination */
				echo "<td class='listr'><span style='width:98%; white-space:nowrap;'>";
					echo "<input name='rcDestination' type='text' class='formfld' id='rcDestination' style='width:calc(100% - 33px);' 
						title='".gettext('Local path (use browser button) or remote:path')."' 
						placeholder='".gettext('Local path (use browser button) or remote:path')."' value='{$rcDestination}' />&nbsp;";
					echo "<input name='rcDestinationbrowsebtn' type='button' class='formbtn' id='rcDestinationbrowsebtn' onclick='rcDestinationifield = form.rcDestination;
						filechooser = window.open(&quot;filechooser.php?p=&quot;+encodeURIComponent(rcDestinationifield.value)+&quot;&amp;sd=/mnt&quot;, &quot;filechooser&quot;,
						&quot;scrollbars=yes,toolbar=no,menubar=no,statusbar=no,width=550,height=300&quot;); filechooser.ifield = rcDestinationifield;
						window.ifield = rcDestinationifield;' value='...' />";
				echo "</span></td>";

				echo "<td class='listr'><select name='rcMode' style='width:99%;' >";
					foreach($selectOptions as $sOption) 
						if ($sOption == $rcMode) echo "<option value='{$sOption}' selected='selected'>{$sOption}</option>";
						else echo "<option value='{$sOption}'>{$sOption}</option>"; 					
				echo "</select></td>";
				echo "<td class='listr' nowrap='nowrap'><input name='rcFlags' style='width:99%;' 
					title='".sprintf(gettext('e.g. %s or command: %s'), "--exclude *.log --no-update-modtime", "lsd remote:Remote/Path")."' 
					placeholder='".sprintf(gettext('e.g. %s or command: %s'), "--exclude *.log --no-update-modtime", "lsd remote:Remote/Path")."' 
					value='{$rcFlags}' /></td>";
				echo "<td class='listrc' nowrap='nowrap'>
					<button name='executeOnce' type='submit' class='formbtn' title='".gettext('Execute Single Command')."' value='executeOnce'><img src='images/right.png' height='10' width='10'></button>
					<button name='add' type='submit' class='formbtn' title='".gettext('Save task')."' value='add'><img src='images/add.png' height='10' width='10'></button>";
				echo "</td>";
				echo "</tr>";
		?>
		</table>
        <div id="remarks">
			<?php		/* executeOnce */
			if (isset($_POST['executeOnce']) && $_POST['executeOnce'] && is_array($execOutput)) {
				echo gettext("Command Output").": <b>{$execCommand}</b><br /><br />";
				echo "<textarea style='width: 100%;' id='content' name='content' class='listcontent' cols='1' rows='20' readonly='readonly'>";
				foreach ($execOutput as $line) echo $line.PHP_EOL;
				echo "</textarea>";
			} else {	/* remark */
				html_remark("note", gettext("Note"),
				sprintf(gettext("For rclone CLI usage always use the additional parameters %s and %s"), "<b>--config {$pconfig['configPath']}</b>", "<b>--log-file {$configuration['rootfolder']}/rclone.log</b>")."<br />".
				gettext("For the rclone <b>mount</b> command it is necessary to add <b>fuse_load=YES</b> to <b>loader.conf</b> and <b>fusefs_enable=YES</b> to <b>rc.conf</b> and to restart the server.")."<br />".
				sprintf(gettext("For further information please check the %s documentation")."</a>.", "<a href='https://rclone.org/docs/' target='_blank'>".$appName)
				);
			}
			?>
        </div>

		<!-- Task list -->
		<table width="100%" border="0" cellpadding="6" cellspacing="0">
           <?php
				html_separator();
				html_titleline(gettext("Task List"));
			?>
 		</table>
		<table class="hoverTable" width="100%" border="0" cellpadding="6" cellspacing="0">
			<tr>
				<td class="listhdrlr" nowrap='nowrap'><?=gettext("Task Name");?></td>
				<td class="listhdrr"><?=gettext("Source");?></td>
				<td class="listhdrr"><?=gettext("Destination");?></td>
				<td class="listhdrc"><?=gettext("Command");?></td>
				<td class="listhdrr" nowrap="nowrap"><?=gettext("Additional Parameters");?></td>
				<td width="5%" class="listhdrc" nowrap="nowrap"><?=gettext("Action");?></td>
			</tr>
			<?php
				if (is_array($configuration['tasks'])) {
					ksort($configuration['tasks'], SORT_NATURAL | SORT_FLAG_CASE);
					foreach($configuration['tasks'] as $key => $cTask) {
						echo "<tr>";
						echo "<td class='listlr'>{$key}</td>";
						echo "<td class='listr'>{$cTask['source']}</td>";
						echo "<td class='listr'>{$cTask['destination']}</td>";
						echo "<td class='listrc'>{$cTask['mode']}</td>";
						echo "<td class='listr'>{$cTask['flags']}</td>";
						echo "<td class='listrc' nowrap='nowrap'>
							<button name='execute' type='submit' class='formbtn' title='".gettext('Execute task')."' value='{$key}'><img src='images/right.png' height='10' width='10'></button>
							<button name='addCron' type='submit' class='formbtn' title='".gettext('Add task to cron')."' value='{$key}'><img src='images/maintain.png' height='10' width='10'></button>
							<button name='edit' type='submit' class='formbtn' title='".gettext('Edit task')."' value='{$key}'><img src='images/edit.png' height='10' width='10'></button>
							<button name='remove' type='submit' class='formbtn' style='color:red' title='".gettext('Remove task')."' value='{$key}'
								onclick=\"return confirm('".sprintf(gettext('Do you really want to remove the task %s?'), $key)."')\"><img style='color:red' src='images/delete.png' height='10' width='10'></button>
						</td>";
						echo "</tr>";
					}
				} 
			?>
		</table>
	</td></tr>
	</table>
	<?php include("formend.inc");?>
</form>
<?php include("fend.inc");?>
