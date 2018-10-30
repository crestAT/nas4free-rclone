<?php
/** Adminer Editor - Compact database editor
* @link https://www.adminer.org/
* @author Jakub Vrana, https://www.vrana.cz/
* @copyright 2009 Jakub Vrana
* @license https://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
* @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License, version 2 (one or other)
* @version 4.6.3
*/error_reporting(6135);$nc=!preg_match('~^(unsafe_raw)?$~',ini_get("filter.default"));if($nc||ini_get("filter.default_flags")){foreach(array('_GET','_POST','_COOKIE','_SERVER')as$X){$Cg=filter_input_array(constant("INPUT$X"),FILTER_UNSAFE_RAW);if($Cg)$$X=$Cg;}}if(function_exists("mb_internal_encoding"))mb_internal_encoding("8bit");function
connection(){global$i;return$i;}function
adminer(){global$b;return$b;}function
version(){global$ca;return$ca;}function
idf_unescape($v){$wd=substr($v,-1);return
str_replace($wd.$wd,$wd,substr($v,1,-1));}function
escape_string($X){return
substr(q($X),1,-1);}function
number($X){return
preg_replace('~[^0-9]+~','',$X);}function
number_type(){return'((?<!o)int(?!er)|numeric|real|float|double|decimal|money)';}function
remove_slashes($Le,$nc=false){if(get_magic_quotes_gpc()){while(list($z,$X)=each($Le)){foreach($X
as$md=>$W){unset($Le[$z][$md]);if(is_array($W)){$Le[$z][stripslashes($md)]=$W;$Le[]=&$Le[$z][stripslashes($md)];}else$Le[$z][stripslashes($md)]=($nc?$W:stripslashes($W));}}}}function
bracket_escape($v,$Ha=false){static$og=array(':'=>':1',']'=>':2','['=>':3','"'=>':4');return
strtr($v,($Ha?array_flip($og):$og));}function
min_version($Og,$Hd="",$j=null){global$i;if(!$j)$j=$i;$wf=$j->server_info;if($Hd&&preg_match('~([\d.]+)-MariaDB~',$wf,$B)){$wf=$B[1];$Og=$Hd;}return(version_compare($wf,$Og)>=0);}function
charset($i){return(min_version("5.5.3",0,$i)?"utf8mb4":"utf8");}function
script($Ef,$ng="\n"){return"<script".nonce().">$Ef</script>$ng";}function
script_src($Hg){return"<script src='".h($Hg)."'".nonce()."></script>\n";}function
nonce(){return' nonce="'.get_nonce().'"';}function
target_blank(){return' target="_blank" rel="noreferrer noopener"';}function
h($Q){return
str_replace("\0","&#0;",htmlspecialchars($Q,ENT_QUOTES,'utf-8'));}function
nl_br($Q){return
str_replace("\n","<br>",$Q);}function
checkbox($C,$Y,$Wa,$sd="",$ie="",$d="",$td=""){$J="<input type='checkbox' name='$C' value='".h($Y)."'".($Wa?" checked":"").($td?" aria-labelledby='$td'":"").">".($ie?script("qsl('input').onclick = function () { $ie };",""):"");return($sd!=""||$d?"<label".($d?" class='$d'":"").">$J".h($sd)."</label>":$J);}function
optionlist($D,$qf=null,$Kg=false){$J="";foreach($D
as$md=>$W){$ne=array($md=>$W);if(is_array($W)){$J.='<optgroup label="'.h($md).'">';$ne=$W;}foreach($ne
as$z=>$X)$J.='<option'.($Kg||is_string($z)?' value="'.h($z).'"':'').(($Kg||is_string($z)?(string)$z:$X)===$qf?' selected':'').'>'.h($X);if(is_array($W))$J.='</optgroup>';}return$J;}function
html_select($C,$D,$Y="",$he=true,$td=""){if($he)return"<select name='".h($C)."'".($td?" aria-labelledby='$td'":"").">".optionlist($D,$Y)."</select>".(is_string($he)?script("qsl('select').onchange = function () { $he };",""):"");$J="";foreach($D
as$z=>$X)$J.="<label><input type='radio' name='".h($C)."' value='".h($z)."'".($z==$Y?" checked":"").">".h($X)."</label>";return$J;}function
select_input($Da,$D,$Y="",$he="",$Ce=""){$Xf=($D?"select":"input");return"<$Xf$Da".($D?"><option value=''>$Ce".optionlist($D,$Y,true)."</select>":" size='10' value='".h($Y)."' placeholder='$Ce'>").($he?script("qsl('$Xf').onchange = $he;",""):"");}function
confirm($Pd="",$rf="qsl('input')"){return
script("$rf.onclick = function () { return confirm('".($Pd?js_escape($Pd):lang(0))."'); };","");}function
print_fieldset($u,$yd,$Rg=false){echo"<fieldset><legend>","<a href='#fieldset-$u'>$yd</a>",script("qsl('a').onclick = partial(toggle, 'fieldset-$u');",""),"</legend>","<div id='fieldset-$u'".($Rg?"":" class='hidden'").">\n";}function
bold($Pa,$d=""){return($Pa?" class='active $d'":($d?" class='$d'":""));}function
odd($J=' class="odd"'){static$t=0;if(!$J)$t=-1;return($t++%2?$J:'');}function
js_escape($Q){return
addcslashes($Q,"\r\n'\\/");}function
json_row($z,$X=null){static$oc=true;if($oc)echo"{";if($z!=""){echo($oc?"":",")."\n\t\"".addcslashes($z,"\r\n\t\"\\/").'": '.($X!==null?'"'.addcslashes($X,"\r\n\"\\/").'"':'null');$oc=false;}else{echo"\n}\n";$oc=true;}}function
ini_bool($dd){$X=ini_get($dd);return(preg_match('~^(on|true|yes)$~i',$X)||(int)$X);}function
sid(){static$J;if($J===null)$J=(SID&&!($_COOKIE&&ini_bool("session.use_cookies")));return$J;}function
set_password($Ng,$O,$V,$G){$_SESSION["pwds"][$Ng][$O][$V]=($_COOKIE["adminer_key"]&&is_string($G)?array(encrypt_string($G,$_COOKIE["adminer_key"])):$G);}function
get_password(){$J=get_session("pwds");if(is_array($J))$J=($_COOKIE["adminer_key"]?decrypt_string($J[0],$_COOKIE["adminer_key"]):false);return$J;}function
q($Q){global$i;return$i->quote($Q);}function
get_vals($H,$f=0){global$i;$J=array();$I=$i->query($H);if(is_object($I)){while($K=$I->fetch_row())$J[]=$K[$f];}return$J;}function
get_key_vals($H,$j=null,$zf=true){global$i;if(!is_object($j))$j=$i;$J=array();$I=$j->query($H);if(is_object($I)){while($K=$I->fetch_row()){if($zf)$J[$K[0]]=$K[1];else$J[]=$K[0];}}return$J;}function
get_rows($H,$j=null,$o="<p class='error'>"){global$i;$jb=(is_object($j)?$j:$i);$J=array();$I=$jb->query($H);if(is_object($I)){while($K=$I->fetch_assoc())$J[]=$K;}elseif(!$I&&!is_object($j)&&$o&&defined("PAGE_HEADER"))echo$o.error()."\n";return$J;}function
unique_array($K,$x){foreach($x
as$w){if(preg_match("~PRIMARY|UNIQUE~",$w["type"])){$J=array();foreach($w["columns"]as$z){if(!isset($K[$z]))continue
2;$J[$z]=$K[$z];}return$J;}}}function
escape_key($z){if(preg_match('(^([\w(]+)('.str_replace("_",".*",preg_quote(idf_escape("_"))).')([ \w)]+)$)',$z,$B))return$B[1].idf_escape(idf_unescape($B[2])).$B[3];return
idf_escape($z);}function
where($Z,$q=array()){global$i,$y;$J=array();foreach((array)$Z["where"]as$z=>$X){$z=bracket_escape($z,1);$f=escape_key($z);$J[]=$f.($y=="sql"&&preg_match('~^[0-9]*\.[0-9]*$~',$X)?" LIKE ".q(addcslashes($X,"%_\\")):($y=="mssql"?" LIKE ".q(preg_replace('~[_%[]~','[\0]',$X)):" = ".unconvert_field($q[$z],q($X))));if($y=="sql"&&preg_match('~char|text~',$q[$z]["type"])&&preg_match("~[^ -@]~",$X))$J[]="$f = ".q($X)." COLLATE ".charset($i)."_bin";}foreach((array)$Z["null"]as$z)$J[]=escape_key($z)." IS NULL";return
implode(" AND ",$J);}function
where_check($X,$q=array()){parse_str($X,$Ua);remove_slashes(array(&$Ua));return
where($Ua,$q);}function
where_link($t,$f,$Y,$ke="="){return"&where%5B$t%5D%5Bcol%5D=".urlencode($f)."&where%5B$t%5D%5Bop%5D=".urlencode(($Y!==null?$ke:"IS NULL"))."&where%5B$t%5D%5Bval%5D=".urlencode($Y);}function
convert_fields($g,$q,$M=array()){$J="";foreach($g
as$z=>$X){if($M&&!in_array(idf_escape($z),$M))continue;$_a=convert_field($q[$z]);if($_a)$J.=", $_a AS ".idf_escape($z);}return$J;}function
cookie($C,$Y,$Ad=2592000){global$aa;return
header("Set-Cookie: $C=".urlencode($Y).($Ad?"; expires=".gmdate("D, d M Y H:i:s",time()+$Ad)." GMT":"")."; path=".preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]).($aa?"; secure":"")."; HttpOnly; SameSite=lax",false);}function
restart_session(){if(!ini_bool("session.use_cookies"))session_start();}function
stop_session($tc=false){if(!ini_bool("session.use_cookies")||($tc&&@ini_set("session.use_cookies",false)!==false))session_write_close();}function&get_session($z){return$_SESSION[$z][DRIVER][SERVER][$_GET["username"]];}function
set_session($z,$X){$_SESSION[$z][DRIVER][SERVER][$_GET["username"]]=$X;}function
auth_url($Ng,$O,$V,$m=null){global$Gb;preg_match('~([^?]*)\??(.*)~',remove_from_uri(implode("|",array_keys($Gb))."|username|".($m!==null?"db|":"").session_name()),$B);return"$B[1]?".(sid()?SID."&":"").($Ng!="server"||$O!=""?urlencode($Ng)."=".urlencode($O)."&":"")."username=".urlencode($V).($m!=""?"&db=".urlencode($m):"").($B[2]?"&$B[2]":"");}function
is_ajax(){return($_SERVER["HTTP_X_REQUESTED_WITH"]=="XMLHttpRequest");}function
redirect($Cd,$Pd=null){if($Pd!==null){restart_session();$_SESSION["messages"][preg_replace('~^[^?]*~','',($Cd!==null?$Cd:$_SERVER["REQUEST_URI"]))][]=$Pd;}if($Cd!==null){if($Cd=="")$Cd=".";header("Location: $Cd");exit;}}function
query_redirect($H,$Cd,$Pd,$We=true,$Zb=true,$gc=false,$dg=""){global$i,$o,$b;if($Zb){$Kf=microtime(true);$gc=!$i->query($H);$dg=format_time($Kf);}$Hf="";if($H)$Hf=$b->messageQuery($H,$dg,$gc);if($gc){$o=error().$Hf.script("messagesPrint();");return
false;}if($We)redirect($Cd,$Pd.$Hf);return
true;}function
queries($H){global$i;static$Pe=array();static$Kf;if(!$Kf)$Kf=microtime(true);if($H===null)return
array(implode("\n",$Pe),format_time($Kf));$Pe[]=(preg_match('~;$~',$H)?"DELIMITER ;;\n$H;\nDELIMITER ":$H).";";return$i->query($H);}function
apply_queries($H,$T,$Wb='table'){foreach($T
as$R){if(!queries("$H ".$Wb($R)))return
false;}return
true;}function
queries_redirect($Cd,$Pd,$We){list($Pe,$dg)=queries(null);return
query_redirect($Pe,$Cd,$Pd,$We,false,!$We,$dg);}function
format_time($Kf){return
lang(1,max(0,microtime(true)-$Kf));}function
remove_from_uri($ve=""){return
substr(preg_replace("~(?<=[?&])($ve".(SID?"":"|".session_name()).")=[^&]*&~",'',"$_SERVER[REQUEST_URI]&"),0,-1);}function
pagination($E,$tb){return" ".($E==$tb?$E+1:'<a href="'.h(remove_from_uri("page").($E?"&page=$E".($_GET["next"]?"&next=".urlencode($_GET["next"]):""):"")).'">'.($E+1)."</a>");}function
get_file($z,$xb=false){$lc=$_FILES[$z];if(!$lc)return
null;foreach($lc
as$z=>$X)$lc[$z]=(array)$X;$J='';foreach($lc["error"]as$z=>$o){if($o)return$o;$C=$lc["name"][$z];$kg=$lc["tmp_name"][$z];$lb=file_get_contents($xb&&preg_match('~\.gz$~',$C)?"compress.zlib://$kg":$kg);if($xb){$Kf=substr($lb,0,3);if(function_exists("iconv")&&preg_match("~^\xFE\xFF|^\xFF\xFE~",$Kf,$Xe))$lb=iconv("utf-16","utf-8",$lb);elseif($Kf=="\xEF\xBB\xBF")$lb=substr($lb,3);$J.=$lb."\n\n";}else$J.=$lb;}return$J;}function
upload_error($o){$Md=($o==UPLOAD_ERR_INI_SIZE?ini_get("upload_max_filesize"):0);return($o?lang(2).($Md?" ".lang(3,$Md):""):lang(4));}function
repeat_pattern($Ae,$zd){return
str_repeat("$Ae{0,65535}",$zd/65535)."$Ae{0,".($zd%65535)."}";}function
is_utf8($X){return(preg_match('~~u',$X)&&!preg_match('~[\0-\x8\xB\xC\xE-\x1F]~',$X));}function
shorten_utf8($Q,$zd=80,$Rf=""){if(!preg_match("(^(".repeat_pattern("[\t\r\n -\x{10FFFF}]",$zd).")($)?)u",$Q,$B))preg_match("(^(".repeat_pattern("[\t\r\n -~]",$zd).")($)?)",$Q,$B);return
h($B[1]).$Rf.(isset($B[2])?"":"<i>...</i>");}function
format_number($X){return
strtr(number_format($X,0,".",lang(5)),preg_split('~~u',lang(6),-1,PREG_SPLIT_NO_EMPTY));}function
friendly_url($X){return
preg_replace('~[^a-z0-9_]~i','-',$X);}function
hidden_fields($Le,$Uc=array()){$J=false;while(list($z,$X)=each($Le)){if(!in_array($z,$Uc)){if(is_array($X)){foreach($X
as$md=>$W)$Le[$z."[$md]"]=$W;}else{$J=true;echo'<input type="hidden" name="'.h($z).'" value="'.h($X).'">';}}}return$J;}function
hidden_fields_get(){echo(sid()?'<input type="hidden" name="'.session_name().'" value="'.h(session_id()).'">':''),(SERVER!==null?'<input type="hidden" name="'.DRIVER.'" value="'.h(SERVER).'">':""),'<input type="hidden" name="username" value="'.h($_GET["username"]).'">';}function
table_status1($R,$hc=false){$J=table_status($R,$hc);return($J?$J:array("Name"=>$R));}function
column_foreign_keys($R){global$b;$J=array();foreach($b->foreignKeys($R)as$xc){foreach($xc["source"]as$X)$J[$X][]=$xc;}return$J;}function
enum_input($U,$Da,$p,$Y,$Rb=null){global$b;preg_match_all("~'((?:[^']|'')*)'~",$p["length"],$Jd);$J=($Rb!==null?"<label><input type='$U'$Da value='$Rb'".((is_array($Y)?in_array($Rb,$Y):$Y===0)?" checked":"")."><i>".lang(7)."</i></label>":"");foreach($Jd[1]as$t=>$X){$X=stripcslashes(str_replace("''","'",$X));$Wa=(is_int($Y)?$Y==$t+1:(is_array($Y)?in_array($t+1,$Y):$Y===$X));$J.=" <label><input type='$U'$Da value='".($t+1)."'".($Wa?' checked':'').'>'.h($b->editVal($X,$p)).'</label>';}return$J;}function
input($p,$Y,$s){global$yg,$b,$y;$C=h(bracket_escape($p["field"]));echo"<td class='function'>";if(is_array($Y)&&!$s){$ya=array($Y);if(version_compare(PHP_VERSION,5.4)>=0)$ya[]=JSON_PRETTY_PRINT;$Y=call_user_func_array('json_encode',$ya);$s="json";}$cf=($y=="mssql"&&$p["auto_increment"]);if($cf&&!$_POST["save"])$s=null;$Cc=(isset($_GET["select"])||$cf?array("orig"=>lang(8)):array())+$b->editFunctions($p);$Da=" name='fields[$C]'";if($p["type"]=="enum")echo
h($Cc[""])."<td>".$b->editInput($_GET["edit"],$p,$Da,$Y);else{$Jc=(in_array($s,$Cc)||isset($Cc[$s]));echo(count($Cc)>1?"<select name='function[$C]'>".optionlist($Cc,$s===null||$Jc?$s:"")."</select>".on_help("getTarget(event).value.replace(/^SQL\$/, '')",1).script("qsl('select').onchange = functionChange;",""):h(reset($Cc))).'<td>';$fd=$b->editInput($_GET["edit"],$p,$Da,$Y);if($fd!="")echo$fd;elseif(preg_match('~bool~',$p["type"]))echo"<input type='hidden'$Da value='0'>"."<input type='checkbox'".(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?" checked='checked'":"")."$Da value='1'>";elseif($p["type"]=="set"){preg_match_all("~'((?:[^']|'')*)'~",$p["length"],$Jd);foreach($Jd[1]as$t=>$X){$X=stripcslashes(str_replace("''","'",$X));$Wa=(is_int($Y)?($Y>>$t)&1:in_array($X,explode(",",$Y),true));echo" <label><input type='checkbox' name='fields[$C][$t]' value='".(1<<$t)."'".($Wa?' checked':'').">".h($b->editVal($X,$p)).'</label>';}}elseif(preg_match('~blob|bytea|raw|file~',$p["type"])&&ini_bool("file_uploads"))echo"<input type='file' name='fields-$C'>";elseif(($ag=preg_match('~text|lob~',$p["type"]))||preg_match("~\n~",$Y)){if($ag&&$y!="sqlite")$Da.=" cols='50' rows='12'";else{$L=min(12,substr_count($Y,"\n")+1);$Da.=" cols='30' rows='$L'".($L==1?" style='height: 1.2em;'":"");}echo"<textarea$Da>".h($Y).'</textarea>';}elseif($s=="json"||preg_match('~^jsonb?$~',$p["type"]))echo"<textarea$Da cols='50' rows='12' class='jush-js'>".h($Y).'</textarea>';else{$Od=(!preg_match('~int~',$p["type"])&&preg_match('~^(\d+)(,(\d+))?$~',$p["length"],$B)?((preg_match("~binary~",$p["type"])?2:1)*$B[1]+($B[3]?1:0)+($B[2]&&!$p["unsigned"]?1:0)):($yg[$p["type"]]?$yg[$p["type"]]+($p["unsigned"]?0:1):0));if($y=='sql'&&min_version(5.6)&&preg_match('~time~',$p["type"]))$Od+=7;echo"<input".((!$Jc||$s==="")&&preg_match('~(?<!o)int(?!er)~',$p["type"])&&!preg_match('~\[\]~',$p["full_type"])?" type='number'":"")." value='".h($Y)."'".($Od?" data-maxlength='$Od'":"").(preg_match('~char|binary~',$p["type"])&&$Od>20?" size='40'":"")."$Da>";}echo$b->editHint($_GET["edit"],$p,$Y);$oc=0;foreach($Cc
as$z=>$X){if($z===""||!$X)break;$oc++;}if($oc)echo
script("mixin(qsl('td'), {onchange: partial(skipOriginal, $oc), oninput: function () { this.onchange(); }});");}}function
process_input($p){global$b,$n;$v=bracket_escape($p["field"]);$s=$_POST["function"][$v];$Y=$_POST["fields"][$v];if($p["type"]=="enum"){if($Y==-1)return
false;if($Y=="")return"NULL";return+$Y;}if($p["auto_increment"]&&$Y=="")return
null;if($s=="orig")return($p["on_update"]=="CURRENT_TIMESTAMP"?idf_escape($p["field"]):false);if($s=="NULL")return"NULL";if($p["type"]=="set")return
array_sum((array)$Y);if($s=="json"){$s="";$Y=json_decode($Y,true);if(!is_array($Y))return
false;return$Y;}if(preg_match('~blob|bytea|raw|file~',$p["type"])&&ini_bool("file_uploads")){$lc=get_file("fields-$v");if(!is_string($lc))return
false;return$n->quoteBinary($lc);}return$b->processInput($p,$Y,$s);}function
fields_from_edit(){global$n;$J=array();foreach((array)$_POST["field_keys"]as$z=>$X){if($X!=""){$X=bracket_escape($X);$_POST["function"][$X]=$_POST["field_funs"][$z];$_POST["fields"][$X]=$_POST["field_vals"][$z];}}foreach((array)$_POST["fields"]as$z=>$X){$C=bracket_escape($z,1);$J[$C]=array("field"=>$C,"privileges"=>array("insert"=>1,"update"=>1),"null"=>1,"auto_increment"=>($z==$n->primary),);}return$J;}function
search_tables(){global$b,$i;$_GET["where"][0]["val"]=$_POST["query"];$tf="<ul>\n";foreach(table_status('',true)as$R=>$S){$C=$b->tableName($S);if(isset($S["Engine"])&&$C!=""&&(!$_POST["tables"]||in_array($R,$_POST["tables"]))){$I=$i->query("SELECT".limit("1 FROM ".table($R)," WHERE ".implode(" AND ",$b->selectSearchProcess(fields($R),array())),1));if(!$I||$I->fetch_row()){$Je="<a href='".h(ME."select=".urlencode($R)."&where[0][op]=".urlencode($_GET["where"][0]["op"])."&where[0][val]=".urlencode($_GET["where"][0]["val"]))."'>$C</a>";echo"$tf<li>".($I?$Je:"<p class='error'>$Je: ".error())."\n";$tf="";}}}echo($tf?"<p class='message'>".lang(9):"</ul>")."\n";}function
dump_headers($Sc,$Ud=false){global$b;$J=$b->dumpHeaders($Sc,$Ud);$se=$_POST["output"];if($se!="text")header("Content-Disposition: attachment; filename=".$b->dumpFilename($Sc).".$J".($se!="file"&&!preg_match('~[^0-9a-z]~',$se)?".$se":""));session_write_close();ob_flush();flush();return$J;}function
dump_csv($K){foreach($K
as$z=>$X){if(preg_match("~[\"\n,;\t]~",$X)||$X==="")$K[$z]='"'.str_replace('"','""',$X).'"';}echo
implode(($_POST["format"]=="csv"?",":($_POST["format"]=="tsv"?"\t":";")),$K)."\r\n";}function
apply_sql_function($s,$f){return($s?($s=="unixepoch"?"DATETIME($f, '$s')":($s=="count distinct"?"COUNT(DISTINCT ":strtoupper("$s("))."$f)"):$f);}function
get_temp_dir(){$J=ini_get("upload_tmp_dir");if(!$J){if(function_exists('sys_get_temp_dir'))$J=sys_get_temp_dir();else{$r=@tempnam("","");if(!$r)return
false;$J=dirname($r);unlink($r);}}return$J;}function
file_open_lock($r){$Ac=@fopen($r,"r+");if(!$Ac){$Ac=@fopen($r,"w");if(!$Ac)return;chmod($r,0660);}flock($Ac,LOCK_EX);return$Ac;}function
file_write_unlock($Ac,$ub){rewind($Ac);fwrite($Ac,$ub);ftruncate($Ac,strlen($ub));flock($Ac,LOCK_UN);fclose($Ac);}function
password_file($ob){$r=get_temp_dir()."/adminer.key";$J=@file_get_contents($r);if($J||!$ob)return$J;$Ac=@fopen($r,"w");if($Ac){chmod($r,0660);$J=rand_string();fwrite($Ac,$J);fclose($Ac);}return$J;}function
rand_string(){return
md5(uniqid(mt_rand(),true));}function
select_value($X,$A,$p,$bg){global$b;if(is_array($X)){$J="";foreach($X
as$md=>$W)$J.="<tr>".($X!=array_values($X)?"<th>".h($md):"")."<td>".select_value($W,$A,$p,$bg);return"<table cellspacing='0'>$J</table>";}if(!$A)$A=$b->selectLink($X,$p);if($A===null){if(is_mail($X))$A="mailto:$X";if(is_url($X))$A=$X;}$J=$b->editVal($X,$p);if($J!==null){if(!is_utf8($J))$J="\0";elseif($bg!=""&&is_shortable($p))$J=shorten_utf8($J,max(0,+$bg));else$J=h($J);}return$b->selectVal($J,$A,$p,$X);}function
is_mail($Ob){$Aa='[-a-z0-9!#$%&\'*+/=?^_`{|}~]';$Fb='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';$Ae="$Aa+(\\.$Aa+)*@($Fb?\\.)+$Fb";return
is_string($Ob)&&preg_match("(^$Ae(,\\s*$Ae)*\$)i",$Ob);}function
is_url($Q){$Fb='[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';return
preg_match("~^(https?)://($Fb?\\.)+$Fb(:\\d+)?(/.*)?(\\?.*)?(#.*)?\$~i",$Q);}function
is_shortable($p){return
preg_match('~char|text|json|lob|geometry|point|linestring|polygon|string|bytea~',$p["type"]);}function
count_rows($R,$Z,$kd,$Dc){global$y;$H=" FROM ".table($R).($Z?" WHERE ".implode(" AND ",$Z):"");return($kd&&($y=="sql"||count($Dc)==1)?"SELECT COUNT(DISTINCT ".implode(", ",$Dc).")$H":"SELECT COUNT(*)".($kd?" FROM (SELECT 1$H GROUP BY ".implode(", ",$Dc).") x":$H));}function
slow_query($H){global$b,$mg,$n;$m=$b->database();$eg=$b->queryTimeout();$Bf=$n->slowQuery($H,$eg);if(!$Bf&&support("kill")&&is_object($j=connect())&&($m==""||$j->select_db($m))){$rd=$j->result(connection_id());echo'<script',nonce(),'>
var timeout = setTimeout(function () {
	ajax(\'',js_escape(ME),'script=kill\', function () {
	}, \'kill=',$rd,'&token=',$mg,'\');
}, ',1000*$eg,');
</script>
';}else$j=null;ob_flush();flush();$J=@get_key_vals(($Bf?$Bf:$H),$j,false);if($j){echo
script("clearTimeout(timeout);");ob_flush();flush();}return$J;}function
get_token(){$Se=rand(1,1e6);return($Se^$_SESSION["token"]).":$Se";}function
verify_token(){list($mg,$Se)=explode(":",$_POST["token"]);return($Se^$_SESSION["token"])==$mg;}function
lzw_decompress($Ma){$Db=256;$Na=8;$bb=array();$ef=0;$ff=0;for($t=0;$t<strlen($Ma);$t++){$ef=($ef<<8)+ord($Ma[$t]);$ff+=8;if($ff>=$Na){$ff-=$Na;$bb[]=$ef>>$ff;$ef&=(1<<$ff)-1;$Db++;if($Db>>$Na)$Na++;}}$Cb=range("\0","\xFF");$J="";foreach($bb
as$t=>$ab){$Nb=$Cb[$ab];if(!isset($Nb))$Nb=$ah.$ah[0];$J.=$Nb;if($t)$Cb[]=$ah.$Nb[0];$ah=$Nb;}return$J;}function
on_help($gb,$_f=0){return
script("mixin(qsl('select, input'), {onmouseover: function (event) { helpMouseover.call(this, event, $gb, $_f) }, onmouseout: helpMouseout});","");}function
edit_form($a,$q,$K,$Fg){global$b,$y,$mg,$o;$Vf=$b->tableName(table_status1($a,true));page_header(($Fg?lang(10):lang(11)),$o,array("select"=>array($a,$Vf)),$Vf);if($K===false)echo"<p class='error'>".lang(12)."\n";echo'<form action="" method="post" enctype="multipart/form-data" id="form">
';if(!$q)echo"<p class='error'>".lang(13)."\n";else{echo"<table cellspacing='0'>".script("qsl('table').onkeydown = editingKeydown;");foreach($q
as$C=>$p){echo"<tr><th>".$b->fieldName($p);$yb=$_GET["set"][bracket_escape($C)];if($yb===null){$yb=$p["default"];if($p["type"]=="bit"&&preg_match("~^b'([01]*)'\$~",$yb,$Xe))$yb=$Xe[1];}$Y=($K!==null?($K[$C]!=""&&$y=="sql"&&preg_match("~enum|set~",$p["type"])?(is_array($K[$C])?array_sum($K[$C]):+$K[$C]):$K[$C]):(!$Fg&&$p["auto_increment"]?"":(isset($_GET["select"])?false:$yb)));if(!$_POST["save"]&&is_string($Y))$Y=$b->editVal($Y,$p);$s=($_POST["save"]?(string)$_POST["function"][$C]:($Fg&&$p["on_update"]=="CURRENT_TIMESTAMP"?"now":($Y===false?null:($Y!==null?'':'NULL'))));if(preg_match("~time~",$p["type"])&&$Y=="CURRENT_TIMESTAMP"){$Y="";$s="now";}input($p,$Y,$s);echo"\n";}if(!support("table"))echo"<tr>"."<th><input name='field_keys[]'>".script("qsl('input').oninput = fieldChange;")."<td class='function'>".html_select("field_funs[]",$b->editFunctions(array("null"=>isset($_GET["select"]))))."<td><input name='field_vals[]'>"."\n";echo"</table>\n";}echo"<p>\n";if($q){echo"<input type='submit' value='".lang(14)."'>\n";if(!isset($_GET["select"])){echo"<input type='submit' name='insert' value='".($Fg?lang(15):lang(16))."' title='Ctrl+Shift+Enter'>\n",($Fg?script("qsl('input').onclick = function () { return !ajaxForm(this.form, '".lang(17)."...', this); };"):"");}}echo($Fg?"<input type='submit' name='delete' value='".lang(18)."'>".confirm()."\n":($_POST||!$q?"":script("focus(qsa('td', qs('#form'))[1].firstChild);")));if(isset($_GET["select"]))hidden_fields(array("check"=>(array)$_POST["check"],"clone"=>$_POST["clone"],"all"=>$_POST["all"]));echo'<input type="hidden" name="referer" value="',h(isset($_POST["referer"])?$_POST["referer"]:$_SERVER["HTTP_REFERER"]),'">
<input type="hidden" name="save" value="1">
<input type="hidden" name="token" value="',$mg,'">
</form>
';}if(isset($_GET["file"])){if($_SERVER["HTTP_IF_MODIFIED_SINCE"]){header("HTTP/1.1 304 Not Modified");exit;}header("Expires: ".gmdate("D, d M Y H:i:s",time()+365*24*60*60)." GMT");header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");header("Cache-Control: immutable");if($_GET["file"]=="favicon.ico"){header("Content-Type: image/x-icon");echo
lzw_decompress("\0\0\0` \0„\0\n @\0´C„è\"\0`EãQ¸àÿ‡?ÀtvM'”JdÁd\\Œb0\0Ä\"™ÀfÓˆ¤îs5›ÏçÑAXPaJ“0„¥‘8„#RŠT©‘z`ˆ#.©ÇcíXÃşÈ€?À-\0¡Im? .«M¶€\0È¯(Ì‰ıÀ/(%Œ\0");}elseif($_GET["file"]=="default.css"){header("Content-Type: text/css; charset=utf-8");echo
lzw_decompress("\n1Ì‡“ÙŒŞl7œ‡B1„4vb0˜Ífs‘¼ên2BÌÑ±Ù˜Şn:‡#(¼b.\rDc)ÈÈa7E„‘¤Âl¦Ã±”èi1Ìs˜´ç-4™‡fÓ	ÈÎi7†³é†„ŒFÃ©”vt2‚Ó!–r0Ïãã£t~½U'3M€ÉW„B¦'cÍPÂ:6T\rc£A¾zr_îWK¶\r-¼VNFS%~Ãc²Ùí&›\\^ÊrÀ›­æu‚ÅÃôÙ‹4'7k¶è¯ÂãQÔæhš'g\rFB\ryT7SS¥PĞ1=Ç¤cIèÊ:d”ºm>£S8L†Jœt.M¢Š	Ï‹`'C¡¼ÛĞ889¤È QØıŒî2#8Ğ­£’˜6mú²†ğjˆ¢h«<…Œ°«Œ9/ë˜ç:Jê)Ê‚¤\0d>!\0Z‡ˆvì»në¾ğ¼o(Úó¥ÉkÔ7½sàù>Œî†!ĞR\"*nSı\0@P\"Áè’(‹#[¶¥£@g¹oü­’znş9k¤8†nš™ª1´I*ˆô=Ín²¤ª¸è0«c(ö;¾Ã Ğè!°üë*cì÷>Î¬E7DñLJ© 1Èä·ã`Â8(áÕ3M¨ó\"Ç39é?Ee=Ò¬ü~ù¾²ôÅîÓ¸7;ÉCÄÁ›ÍE\rd!)Âa*¯5ajo\0ª#`Ê38¶\0Êí]“eŒêˆÆ2¤	mk×øe]…Á­AZsÕStZ•Z!)BR¨G+Î#Jv2(ã öîc…4<¸#sB¯0éú‚6YL\r²=£…¿[×73Æğ<Ô:£Šbx”ßJ=	m_ ¾ÏÅfªlÙ×t‹åIªƒHÚ3x*€›á6`t6¾Ã%UÔLòeÙ‚˜<´\0ÉAQ<P<:š#u/¤:T\\> Ë-…xJˆÍQH\nj¡L+jİzğó°7£•«`İğ³\nkƒƒ'“NÓvX>îC-TË©¶œ¸†4*L”%Cj>7ß¨ŠŞ¨­õ™`ù®œ;yØûÆqÁrÊ3#¨Ù} :#ní\rã½^Å=CåAÜ¸İÆs&8£K&»ô*0ÑÒtİSÉÔÅ=¾[×ó:\\]ÃEİŒ/Oà>^]ØÃ¸Â<èØ÷gZÔV†éqº³ŠŒù ñËx\\­è•ö¹ßŞº´„\"J \\Ã®ˆû##Á¡½D†Îx6êœÚ5xÊÜ€¸¶†¨\rHøl ‹ñø°bú r¼7áÔ6†àöj|Á‰ô¢Û–*ôFAquvyO’½WeM‹Ö÷‰D.Fáö:RĞ\$-¡Ş¶µT!ìDS`°8D˜~ŸàA`(Çemƒ¦òı¢T@O1@º†X¦â“\nLpğ–‘PäşÁÓÂm«yf¸£)	‰«ÂˆÚGSEI‰¥xC(s(a?\$`tE¨n„ñ±­,÷Õ \$a‹U>,èĞ’\$ZñkDm,G\0å \\iú£%Ê¹¢ n¬¥¥±·ìİÜgÉ„b	y`’òÔ†ËWì· ä——¡_CÀÄT\niÏH%ÕdaÀÖiÍ7íAt°,Á®J†X4nˆ‘”ˆ0oÍ¹»9g\nzm‹M%`É'Iü€Ğ-èò©Ğ7:pğ3pÇQ—rEDš¤×ì àb2]…PF ı¥É>eÉú†3j\n€ß°t!Á?4ftK;£Ê\rÎĞ¸­!àoŠu?ÓúPhÒ0uIC}'~ÅÈ2‡vşQ¨ÒÎ8)ìÀ†7ìDIù=§éy&•¢eaàs*hÉ•jlAÄ(ê›\"Ä\\Óêm^i‘®M)‚°^ƒ	|~Õl¨¶#!YÍf81RS Áµ!‡†è62PÆC‘ôl&íûäxd!Œ| è9°`Ö_OYí=ğÑGà[EÉ-eLñCvT¬ )Ä@j-5¨¶œpSg».’G=”ĞZEÒö\$\0¢Ñ†KjíU§µ\$ ‚ÀG'IäP©Â~ûÚğ ;ÚhNÛG%*áRjñ‰X[œXPf^Á±|æèT!µ*NğğĞ†¸\rU¢Œ^q1V!ÃùUz,ÃI|7°7†r,¾¡¬7”èŞÄ¾BÖùÈ;é+÷¨©ß•ˆAÚpÍÎ½Ç^€¡~Ø¼W!3PŠI8]“½vÓJ’Áfñq£|,êè9Wøf`\0áq”ZÎp}[Jdhy­•NêµY|ï™Cy,ª<s A{eÍQÔŸòhd„ìÇ‡ ÌB4;ks&ƒ¬ñÄİÇaŞøÅûé”Ø;Ë¹}çSŒËJ…ïÍ)÷=dìÔ|ÎÌ®NdÒ·Iç*8µ¢dlÃÑ“E6~Ï¨F¦•Æ±X`˜M\rÊ/Ô%B/VÀIåN&;êùã0ÅUC cT&.E+ç•óƒÀ°Š›éÜ@²0`;ÅàËGè5ä±ÁŞ¦j'™›˜öàÆ»Yâ+¶‰QZ-iôœyvƒ–I™5Úó,O|­PÖ]FÛáòÓùñ\0üË2™49Í¢™¢n/Ï‡]Ø³&¦ªI^®=Ól©qfIÆÊ= Ö]x1GRü&¦e·7©º)Šó'ªÆ:B²B±>a¦z‡-¥‰Ñ2.¯ö¬¸bzø´Ü#„¥¼ñ“ÄUá“ÆL7-¼w¿tç3Éµñ’ôe§ŠöDä§\$²#÷±¤jÕ@ÕG—8Î “7púÜğR YCÁĞ~ÁÈ:À@ÆÖEU‰JÜÙ;67v]–J'ØÜäq1Ï³éElôQĞ†i¾ÍÃÎñ„/íÿ{k<àÖ¡MÜpoì}ĞèrÁ¢qŒØìcÕÃ¤™_mÒwï¾^ºu–´ÅùÚüù½«¶Çlnş”™	ı_‘~·Gønèæ‹Ö{kÜßwãŞù\rj~—K“\0Ïİü¦¾-îúÏ¢B€;œà›öb`}ÁCC,”¹-¶‹LĞ8\r,‡¿klıÇŒòn}-5Š3u›gm¸òÅ¸À*ß/äôÊùÏî×ô`Ë`½#xä+B?#öÛN;OR\r¨èø¯\$÷ÎúöÉkòÿÏ™\01\0kó\0Ğ8ôÍaèé/t úû#(&Ìl&­ù¥p¸Ïì‚…şâÎiM{¯zp*Ö-g¨Âèv‰Å6œkë	åˆğœd¬Ø‹¬Ü×ÄA`");}elseif($_GET["file"]=="functions.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("f:›ŒgCI¼Ü\n8œÅ3)°Ë7œ…†81ĞÊx:\nOg#)Ğêr7\n\"†è´`ø|2ÌgSi–H)N¦S‘ä§\r‡\"0¹Ä@ä)Ÿ`(\$s6O!ÓèœV/=Œ' T4æ=„˜iS˜6IO“ÊerÙxî9*Åº°ºn3\rÑ‰vƒCÁ`õšİ2G%¨YãæáşŸ1™Ífô¹ÑÈ‚l¤Ã1‘\ny£*pC\r\$ÌnTª•3=\\‚r9O\"ã	Ààl<Š\rÇ\\€³I,—s\nA¤Æeh+Mâ‹!q0™ıf»`(¹N{c–—+wËñÁY£–pÙ§3Š3ú˜+I¦Ôj¹ºıÏk·²n¸qÜƒzi#^rØÀº´‹3èâÏ[èºo;®Ë(‹Ğ6#ÀÒ\":cz>ß£C2vÑCXÊ<P˜Ãc*5\nº¨è·/üP97ñ|F»°c0ƒ³¨°ä!ƒæ…!¨œƒ!‰Ã\nZ%ÃÄ‡#CHÌ!¨Òr8ç\$¥¡ì¯,ÈRÜ”2…Èã^0·á@¤2Œâ(ğ88P/‚à¸İ„á\\Á\$La\\å;càH„áHX„•\nÊƒtœ‡á8A<ÏsZô*ƒ;IĞÎ3¡Á@Ò2<Š¢¬!A8G<Ôj¿-Kƒ({*\r’Åa1‡¡èN4Tc\"\\Ò!=1^•ğİM9O³:†;jŒŠ\rãXÒàL#HÎ7ƒ#Tİª/-´‹£pÊ;B Â‹\n¿2!ƒ¥Ít]apÎİî\0RÛCËv¬MÂI,\rö§\0Hv°İ?kTŞ4£Š¼óuÙ±Ø;&’ò+&ƒ›ğ•µ\rÈXbu4İ¡i88Â2Bä/âƒ–4ƒ¡€N8AÜA)52íúøËåÎ2ˆ¨sã8ç“5¤¥¡pçWC@è:˜t…ã¾´Öešh\"#8_˜æcp^ãˆâI]OHşÔ:zdÈ3g£(„ˆ×Ã–k¸î“\\6´˜2ÚÚ–÷¹iÃä7²˜Ï]\rÃxO¾nºpè<¡ÁpïQ®UĞn‹ò|@çËó#G3ğÁ8bA¨Ê6ô2Ÿ67%#¸\\8\rıš2Èc\ræİŸk®‚.(’	’-—J;î›Ñó ÈéLãÏ ƒ¼Wâøã§“Ñ¥É¤â–÷·nû Ò§»æıMÎÀ9ZĞs]êz®¯¬ëy^[¯ì4-ºU\0ta ¶62^•˜.`¤‚â.Cßjÿ[á„ % Q\0`dëM8¿¦¼ËÛ\$O0`4²êÎ\n\0a\rA„<†@Ÿƒ›Š\r!À:ØBAŸ9Ù?h>¤Çº š~ÌŒ—6ÈˆhÜ=Ë-œA7XäÀÖ‡\\¼\r‘Q<èš§q’'!XÎ“2úT °!ŒD\r§Ò,K´\"ç%˜HÖqR\r„Ì ¢îC =í‚ æäÈ<c”\n#<€5Mø êEƒœyŒ¡”“‡°úo\"°cJKL2ù&£ØeRœÀWĞAÎTwÊÑ‘;åJˆâá\\`)5¦ÔŞœBòqhT3§àR	¸'\r+\":‚8¤ÀtV“Aß+]ŒÉS72Èğ¤YˆFƒ¼Z85àc,æô¶JÁ±/+S¸nBpoWÅdÖ\"§Qû¦a­ZKpèŞ§y\$›’ĞÏõ4I¢@L'@‰xCÑdfé~}Q*”ÒºAµàQ’\"BÛ*2\0œ.ÑÕkF©\"\r”‘° Øoƒ\\ëÔ¢™ÚVijY¦¥MÊôO‚\$Šˆ2ÒThH´¤ª0XHª5~kL©‰…T*:~P©”2¦tÒÂàB\0ıY…ÀÈÁœŸj†vDĞs.Ğ9“s¸¹Ì¤ÆP¥*xª•b¤o“õÿ¢PÜ\$¹W/“*ÃÉz';¦Ñ\$*ùÛÙédâmíÃƒÄ'b\rÑn%ÅÄ47Wì-Ÿ’àöÕ ¶K´µ³@<ÅgæÃ¨bBÑÿ[7§\\’|€VdR£¿6leQÌ`(Ô¢,Ñd˜å¹8\r¥]S:?š1¹`îÍYÀ`ÜAåÒ“%¾ÒZkQ”sMš*Ñ×È{`¯J*w¶×ÓŠ>îÕ¾ôDÏû›>ïeÓ¾·\"åt+poüü–ö¶ÅW\$ãÜÍûQá”@Èƒ3t`¶†˜¶-k7gæä ]ÓÊlî´EÀ¹^dW>nvÀtölzPH¨—FvWõV\nÕh;¢”BáD°Ø³/ö:J³İ\\Ê+ %¥ñ–÷îá]úúÑŠ½£wa×İ«¸‡ñ=¼X®ò†›Nû/ŒĞw“Jñ_[át)5ô½ùQR2l-:›Y9Ó&l R;¯u#S	ı ht kÏE!lØúÔ>SH€ÀX<,ğO¸YyĞƒ%L–]\0	‚Ó^ßdwĞ3í,Sc¡Qt˜e=‘M:4üÿÔ2]”êPîTÃsÕn:©ºu>î/Ÿdœ¼ Şí´a‹'%è“íİÁqÒ¨&@ÖË•ÁîŒ–H·Gâ@w8pñÀœÁÎ¤Z\n«Ø{¶[²t2„Ãàa–´>	´wŒJî^+u~ÃoøåÂµXkÕ¦BZkË±ÃX=ÈË0>ªt¯¢lÅƒ)Wb€Ü¦øõ'ÃAÒ,áím†Y—,‹A’ÁñŠeï#V¹ñ+n1I©ÎÊÁE+[âüïØ[¯û-RšmK9Ç¹~ã‹÷L€-3O˜ÊÁ`_0súËL;›°¸Âà]6õ¥|¤‡hÿVÇT:Š‚ŞerMÎÉaõ\$~e‘9¥>ááãˆÁĞ”Á\rÕÊ\\”ÁôJ1Ãš¼ÁĞ%¢=0{ö	ŸÌç|Ş—tÚ¼“=¾Âó€Qç|\0?õã[g@u?É|Äö4İ*‚µc-7Ñ4\ri'^ÙÑå¿n;œú»ù‰Š¦(»á¦Ï{KÇhñnfµïÚZÏ}l³èêçÅ]\rä”şpJ>Ñ,gp{Ÿ;Î\0µ½u)ÚÕsèN‘'ıÊçãHÙøC9M5ğê*ø`êk’ã¬ öş©AhYÂ©*–©ªŠjJ˜Ç…PN+^ D°*¸«Ã€îĞ€DªÚPäì€LQ`O&–£\0Ø}\$…Â6Zn>²Ë0Û ÜeÀ\n€š	…trp!hV¤'PyĞ^‰*|r%|\nr\r#°„@w®»íĞT.Rvâ8ìjâ\nmB¥ïÄp¨Ï úY0¨Ï¢ëm\0è@P\r8ÀY\rGØİd’	ÀQGP%EÎ/@]\rÀÊÀ{\0ÌQÔàÀbR M\rFÙç|¢è%0SDr§ÂÈ f/–àÂÜ\":Ümo²ŞƒÂ%ß@æ3H¦x\0Âl\0ÌÅÚ	‘€W ßåÚ\nç8\r\0}®@DÉñ`#±t‚ä.€jEoDrÇ¢lbÀØÙåtìf4¸0€À¤%Ñ0’åÒkªz2\rñŸ îW@Â’ç%\r\n~1€‚X ¤ÙñºD2!°ôO‚*‡¤²{0<E¦‹k*më0Ä±şÖÎ|\r\næ^iÀ ¨³!.§r ò §ˆüÌöèîfñòÄ¬Àù+:ïÅ‹JúB5\$LÜèòP½ìÒLÄ‚«à¶ Z@ºìêÌ`^PğL%5%jp‘HâWÀğonøökA#&ö’8Ùò<K6Ì/–ù²Ì¢ÌíäúòXWe+&›%ÄÑ²c&rjíñ'%Òx‚²°¾ÅnK¥2û2Ö¶‹làê*á.ürÍÎ¢‰‚‚*Ğ\r+jpBgê{ ²0ë%1(ªŠîZ‹`Q#±Ôân*hò òv¢BâÏğÀ\\F\n‚WÅr f\$ó93äG4%d b”:JZ!“,€‰_ ûf%2€Ë6s*F€Ñ¨Òº³EQ½q~²`tsÖÒ€‘’‰(`Ú\rÀš®#€R©¬°±R®ró¶XêŞ:R›)òA*3¿\$lË*Î½:\"XlÌÔtbKİ-„ÂšÒO>Rõ-¥d¡Ç=¤ò\$Sô\$å2ÀŠ}7Sf¹â[Œ}\"@È] [6S|SE_>¥q-ä@z`í;´0±óÆ»ËÁCÑ*¯¦[ÀÒÀ{D°ŞjC\nfås–Pò6'€èÈ• QE“’æN\\%rño÷7oúG+dW4A*€Ğ#TqEÎf•¾%ùD´Zæ3–§2.ì‰ÅRkâ€z@¶@»E³D¢`CÂV!CæäÅ•\0±ÔÛIş)38M3Â@Ù3L‡âZB³1F@Läh~G³1MÄÑÑ6ñ‚Ó4äXÑ”ò}ÆfŠË¢IN€ó34ğÀXÔBtd³8\nbtNãàQb;ÍÜ‘D‚ÕL\0Ô¯\"\n‚ßäVÑÍ6ÑÀ]UõcVf„ñÅD`‡Mñ6ÓO44sJ•‹555“\\x	Î<5[FÜßµy7m÷)@SV­ÈÄ#êx‚Õ8 Õ¸Ñ‹¬£`·\\`İ-Šv2²ıÕp¥œ·+v§€ûU«­LêxY.¤‰›\0005(@òğ´â°µ[U@#µVJuX4íu_ï\"JO(Dtı_	5s½^ õ¡ƒ ÑÅÄ5·^»^Và¾Iêæ\rg&] ¨\r\"ZCI¥6µÊ#µÎ\r©¨Ü“‡³]7´ qÕ0Ùó6}o¾’—`uš€ab(ñXÓD fıMÖN)ıVÕUUFĞ¾ø“=jSWiÅ\"\\B1ÄØE0¶ µamPÀí&<¥O_L–ò‘Â.c1Z* ÀR\$åh¶ùmvı[v>İ­íp•ˆŠ(åË0ğ˜°œcP£om\0R´ıp÷&‹w+KQs6†}5[söJ£Õô2µù/€úàO òV*)ËRµ.Du33–F\rÂ;­ãv4ÙµşHù	_!ô­2Œµkª¦»+ª»%ğ:É_,ÔeoèÏF¨ÌAJ¶OÈ\"%¬\n‹k5`z %|Ã%ÄÎ«g|ÀÏ}l¶v2n7Ê~\0Î	¨YRHúË@Öír’­xN-Jp\0ğ¼‚å‹f#€Û@Ë€mvÔx…˜\r–ü–2WMO/°\nD¯Û7Ï}2ğ’òäVWãWèêwÉ€7å€ñËHÆk„¨ğ]¸\$ÔMz\\òe.føRZØa†Bä¹µ QdÍKZ“àvtÀØ€w4¯\0æZ@à	÷ôBc;Îb–ã>ÚBş	3mÍn\nëo ÏJ3”ækŒ(Ü£‚\"àyG\$:\rØÅ†èİ“G6€É²J¥çyÑñQö\\Qú÷if÷­Şø©(ïm)/r“\$ùJÅ/HÌ]*òò½ó‡g¹ZOD÷Ñ¬Šƒ]1Îg22˜¿±—ˆï«fÉ=HT…ˆ]NÂ&¦ÀÄM\0Ö[8x‡È®Eæ–â8&LÖVmœvÀ±ª”j„×˜ÇFåÄ\\™–	™š&sá@Q™ \\\"òb€°	àÄ\rBsšIwœ	œYÉœÂN š7ÇC/&Ù«`¨\n\nÃ™[k˜¹´*A– ñTÏV*UZtz{Š.‚çy˜S‰ š#É3¢ipzW@yC\nKT»˜1@|„z#äü€_CJz(Bº,VÔ(Kº_¡ºdO—©€Pà@X…tƒĞ…¦ºc;úWZzW¥_Ù \0ŞŠÂCFøxR  	à¦\n…„àº°PÆA¡è&šš é›,ÖpfV|@N¨\"¾\$€[…i’Š­•¢àğ¦´àZ¥\0Zd\\\"…|¢W`ºÆ]ºÌtzĞo\$â\0[°èŞ±ueçë±É™¬bhU-¡‚,€r ãLk8§ Ö«†V&Úal§ØëàdíŒ×2;	 '-¡¶Jyu—›a©µİ\0 ÷¨•a£{s¶[9V\0´‡F«‘R ÂVB0S;Dº>L4º&‡ZHO1…\0ÊwgÊºS¥tK¤¨R…z¦¨Úi¼Ú+½3õw­§z’X¢]¨(G\$°¨¯ªD+°tÕ¹á(#ª”©™oc”:	ÀàY6¼\0–è&¹¼	@¦	àœü)ÂÒ!›‡´¦w€»œ# tĞxºNDóÀ•Äš)êõC£ÊFZÂpÀÄa—Ä*FÄb¹	¯ƒÍ¼ÀŒ£ãÄ£ù¤åçSi/S¼!‡€zéUH*Î4ºë¤ËÙ0ùKÀ-¸/“­À-k`°nÜLiÊJë~ÂwàJn¾Ã\"í`Ó=ìØV¶3OÄ¯8tä>µûvoëâE.®ƒRz`Ş‹p·P œÔE\\ÙÍÉ§Î3LçlïÑ¥s]T‘‡‡oV¯ñ€\n ¤	*‚\r¼@7)¦ÊDüm0Wİ5Ó€ßÓÇ°¨wİÔb”Èİ|	Ç¼JV¼èÀœ\"‚ur\rä&N0NöB¨d¦ËdĞ8îDğ¨€_Í«×^Tö®H#]„dá+úv€~ÀU,ĞPR%ñ‡…ùÉÒßxÔÕÁfAÁ»CÁümÀƒ»Í¸·¹’ÛcÃÇyÅœD)ú›ÕuHà÷ßpşpª^u\0èéˆ°²Œ}¡{Ñ¡Å\rgäsÇQM¤Y‡2j\r—|0\0X×â@qÍŒ•I`ö»5F6±NÖşV@Ó”sEïp’õ¬#\rşP¾T÷–DeW†Ø¼ñ›­ãÛz!Ã»ç:üDMV(¢©~X¸9£\0å£@˜¿­40N¬Ü½~”QĞ[TÜÄeşqSv\"Õ\"hã\0R-ühZ³d—ñ…ÀÜF5´PèÓ`³9ÂD&xs9WÖ—5Er@oÌwkb“1ğİPO-OşOxlHöD6/Ö¿­méŞ ¾²3¥7T¨KÈ~54¬	ñp#µI”>YIN\\5€Ø‚NÓƒ­‡—õMûòpr&œGíxMÈsqŒ€—ø.Fÿ–Í8§Cs± h€e5ÄüÒİğ°±ò*àbø)SÚª¾†Ì­Ùeú0É-Xú {ú5|±i–Ö¢a‚ãÈ•6z‚Ş½ƒ/Y‰³ÿÛM¦ Æƒì Ê\nR*8r oø @7¡8BfåzùKÃr‚¹øA\$Ë°	p‘\0?…ÿ d¨kÃ|45}ÀAÿÃ€ØÉ¶óW¿ñJÀ2k Gi\0\"¡€Àd€èí8‘\0 >móÂó `8¯wÙ7Éo4âcGhœ±QĞ(í€¨Ö8@\$<\0p¤Ò0³÷˜L¦eX+„Ja€{ëBÒà´h¶Ø8èCy„òêP2ºÓ®Ÿ*ÓEHê2½ÅİDqS‡Û˜ïpŒ0ÙI‚²ƒk½`ŞûSí\nâÂ›:éùBœ7Ûàèğ{-™ÂôĞ`î€õğ…6¸A W¡Ü–\rşp†W#ôä¡?¹ş¢{\0Ğßô¼ØÎcD œ[<„Ğfà--špÔŒ´*B„]„nW°²^ R70\rã+N¨GN³\$(\0±#+yó@Ş@iD(8@\rÀhÊÕHˆHe¢¥ĞÌzzÀ{1é…À°h„ÙW1F°Who&aÉœŞd6¡½İjw˜èÉü»¥Â`h{v`REİ\nj†£å`êÜ·¾ÔÇÆ*Üˆ°Ê¸}ªY¡ñ	\rY‡H¶6¥#\0ğ¥å»†êŞa¼Á Q¨HEl4ıd¤ÜípëÚ#™†¨ƒ¡¨oÓbr+_)\r`‚Ğ!Ğ|dQ•>ª¹=QÊ¡€âÎ¶×EOB'‘>ôPì®ôÓ¶Ø A\rnK‚iµä 	ŠÁô„	ˆ%<	Ão;‚S„@ã!	²x’à:ˆ†İA‘+\\1d\$ùjOœÉ7š%Æ	å/Šœ¶’gu„z*°G‚Hê5\"8–‚,Ÿ]raq¨«î/ h‹ø#Ãõ­\$ /tnÍö8yºİ-®O‚ı˜H±bÔ­<âZ×!©œ…1¡ì`É.(uo›À…­|`GËSèÔBaM	Ú‚9ÆîD@£õ1‰B€tDĞøÊ¡@?o©(H–‚qC¯¶8E¼TcncRÃ‚6©N%¼rHj¾à2G\0‰a´¤q ™rÁÇz9b>(PãŸxèÇ<÷)ôx#Å8óèª¹t³ˆÕh„2vÇñWo2UëÎÎt³˜+=Àl#êóÏjşD¥	0¤å‹›&R£cè\$•*Ì‘-Z`àÀ\rŠê;Ë|Aùpà=1Ô	1í•íÆˆ¨bEv(^€X¥P2=\0}‚W‘ˆ÷G¾<°šÊG¡¹‘øøR#PƒHÜ®r9	£ƒYû´!’LB¤‘‘4€NC„ZˆîIC´‘ÔMLm¢Â,Áf@eY x›BS(Ó+Ø<4YŒ)-Ø\rz?\$à€Ü\"\"º 6ªEù\r)z‘’Ä@È‘¢’r„¤*åƒæJÈìœ‹Àˆ%\$ùeıJû˜‹\0Aå\$Ú°/5ÕÑB0Sô¤œxº“IºQ)ó•<¦¬4YS‘&‘{Š¼bã+IG=>¡\rPY`Z¸D•`¦”U²¢ªF1€Šø4d8X(ÃÀ°úC%`ãœ­0ËI\$ƒ7WÂpÇ,™œAcÀ–é&ÔŒép\$:è–r@ï\"{\0004ÛBà1‰\rG¢ó\nCÁ1A‹-P.äv%ôUXI‘D<)ô¿Ó­&Y‚G`İ©WË\n Ç(0}âÖò= æ]ÄÃ1™‹qcTæ*@%ÜÊv\\ Äê˜2,Õ0Ît‰\"@ğTÁ©\rP}“/dÌ@àÛ6‹bKòÌÄœè¹‰-¢<³‰{Fæi3gÁÜ)ó˜´Ğ–ä8äfd·ãÕL\$1¦‚ù§…ÁŠ:\"Ù`ÀÂŠÉ­©MÂ35´Ïæ%1¦4Mel¡óÂ&Nê¡q#¨o‰Nİ´@QCŸ­êOÜF(v'#badV–± –\$‚±‘LgBëœ¢NÇ‘¬)ä§íY»\0§à¦y]KPrí”ğ¬¥@¾¦sï‰ZĞ‡fVI¹\0¼µIdšb@&Ñ8ÕÅM®umtË¦àÆê·7Áq3u h\n¦ğ 4‚M6k‘<ÔÄ‚=`D\\C“^!Ç°:ğ0˜y!¡—°½“Š›Š)ZX(Q!äãç(„~ÉàÈN¶DŒ¹ÒÊD{");}elseif($_GET["file"]=="jush.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress('');}else{header("Content-Type: image/gif");switch($_GET["file"]){case"plus.gif":echo'';break;case"cross.gif":echo'';break;case"up.gif":echo'';break;case"down.gif":echo'';break;case"arrow.gif":echo'';break;}}exit;}if($_GET["script"]=="version"){$Ac=file_open_lock(get_temp_dir()."/adminer.version");if($Ac)file_write_unlock($Ac,serialize(array("signature"=>$_POST["signature"],"version"=>$_POST["version"])));exit;}global$b,$i,$n,$Gb,$Lb,$Tb,$o,$Cc,$Gc,$aa,$ed,$y,$ba,$vd,$ge,$Be,$Of,$Kc,$mg,$qg,$yg,$Eg,$ca;if(!$_SERVER["REQUEST_URI"])$_SERVER["REQUEST_URI"]=$_SERVER["ORIG_PATH_INFO"];if(!strpos($_SERVER["REQUEST_URI"],'?')&&$_SERVER["QUERY_STRING"]!="")$_SERVER["REQUEST_URI"].="?$_SERVER[QUERY_STRING]";if($_SERVER["HTTP_X_FORWARDED_PREFIX"])$_SERVER["REQUEST_URI"]=$_SERVER["HTTP_X_FORWARDED_PREFIX"].$_SERVER["REQUEST_URI"];$aa=($_SERVER["HTTPS"]&&strcasecmp($_SERVER["HTTPS"],"off"))||ini_bool("session.cookie_secure");@ini_set("session.use_trans_sid",false);if(!defined("SID")){session_cache_limiter("");session_name("adminer_sid");$F=array(0,preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]),"",$aa);if(version_compare(PHP_VERSION,'5.2.0')>=0)$F[]=true;call_user_func_array('session_set_cookie_params',$F);session_start();}remove_slashes(array(&$_GET,&$_POST,&$_COOKIE),$nc);if(get_magic_quotes_runtime())set_magic_quotes_runtime(false);@set_time_limit(0);@ini_set("zend.ze1_compatibility_mode",false);@ini_set("precision",15);$vd=array('en'=>'English','ar'=>'Ø§Ù„Ø¹Ø±Ø¨ÙŠØ©','bg'=>'Ğ‘ÑŠĞ»Ğ³Ğ°Ñ€ÑĞºĞ¸','bn'=>'à¦¬à¦¾à¦‚à¦²à¦¾','bs'=>'Bosanski','ca'=>'CatalÃ ','cs'=>'ÄŒeÅ¡tina','da'=>'Dansk','de'=>'Deutsch','el'=>'Î•Î»Î»Î·Î½Î¹ÎºÎ¬','es'=>'EspaÃ±ol','et'=>'Eesti','fa'=>'ÙØ§Ø±Ø³ÛŒ','fi'=>'Suomi','fr'=>'FranÃ§ais','gl'=>'Galego','he'=>'×¢×‘×¨×™×ª','hu'=>'Magyar','id'=>'Bahasa Indonesia','it'=>'Italiano','ja'=>'æ—¥æœ¬èª','ko'=>'í•œêµ­ì–´','lt'=>'LietuviÅ³','ms'=>'Bahasa Melayu','nl'=>'Nederlands','no'=>'Norsk','pl'=>'Polski','pt'=>'PortuguÃªs','pt-br'=>'PortuguÃªs (Brazil)','ro'=>'Limba RomÃ¢nÄƒ','ru'=>'Ğ ÑƒÑÑĞºĞ¸Ğ¹','sk'=>'SlovenÄina','sl'=>'Slovenski','sr'=>'Ğ¡Ñ€Ğ¿ÑĞºĞ¸','ta'=>'à®¤â€Œà®®à®¿à®´à¯','th'=>'à¸ à¸²à¸©à¸²à¹„à¸—à¸¢','tr'=>'TÃ¼rkÃ§e','uk'=>'Ğ£ĞºÑ€Ğ°Ñ—Ğ½ÑÑŒĞºĞ°','vi'=>'Tiáº¿ng Viá»‡t','zh'=>'ç®€ä½“ä¸­æ–‡','zh-tw'=>'ç¹é«”ä¸­æ–‡',);function
get_lang(){global$ba;return$ba;}function
lang($v,$ce=null){if(is_string($v)){$Ee=array_search($v,get_translations("en"));if($Ee!==false)$v=$Ee;}global$ba,$qg;$pg=($qg[$v]?$qg[$v]:$v);if(is_array($pg)){$Ee=($ce==1?0:($ba=='cs'||$ba=='sk'?($ce&&$ce<5?1:2):($ba=='fr'?(!$ce?0:1):($ba=='pl'?($ce%10>1&&$ce%10<5&&$ce/10%10!=1?1:2):($ba=='sl'?($ce%100==1?0:($ce%100==2?1:($ce%100==3||$ce%100==4?2:3))):($ba=='lt'?($ce%10==1&&$ce%100!=11?0:($ce%10>1&&$ce/10%10!=1?1:2)):($ba=='bs'||$ba=='ru'||$ba=='sr'||$ba=='uk'?($ce%10==1&&$ce%100!=11?0:($ce%10>1&&$ce%10<5&&$ce/10%10!=1?1:2)):1)))))));$pg=$pg[$Ee];}$ya=func_get_args();array_shift($ya);$zc=str_replace("%d","%s",$pg);if($zc!=$pg)$ya[0]=format_number($ce);return
vsprintf($zc,$ya);}function
switch_lang(){global$ba,$vd;echo"<form action='' method='post'>\n<div id='lang'>",lang(19).": ".html_select("lang",$vd,$ba,"this.form.submit();")," <input type='submit' value='".lang(20)."' class='hidden'>\n","<input type='hidden' name='token' value='".get_token()."'>\n";echo"</div>\n</form>\n";}if(isset($_POST["lang"])&&verify_token()){cookie("adminer_lang",$_POST["lang"]);$_SESSION["lang"]=$_POST["lang"];$_SESSION["translations"]=array();redirect(remove_from_uri());}$ba="en";if(isset($vd[$_COOKIE["adminer_lang"]])){cookie("adminer_lang",$_COOKIE["adminer_lang"]);$ba=$_COOKIE["adminer_lang"];}elseif(isset($vd[$_SESSION["lang"]]))$ba=$_SESSION["lang"];else{$qa=array();preg_match_all('~([-a-z]+)(;q=([0-9.]+))?~',str_replace("_","-",strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"])),$Jd,PREG_SET_ORDER);foreach($Jd
as$B)$qa[$B[1]]=(isset($B[3])?$B[3]:1);arsort($qa);foreach($qa
as$z=>$Oe){if(isset($vd[$z])){$ba=$z;break;}$z=preg_replace('~-.*~','',$z);if(!isset($qa[$z])&&isset($vd[$z])){$ba=$z;break;}}}$qg=$_SESSION["translations"];if($_SESSION["translations_version"]!=2877580429){$qg=array();$_SESSION["translations_version"]=2877580429;}function
get_translations($ud){switch($ud){case"en":$h="A9D“yÔ@s:ÀGà¡(¸ffƒ‚Š¦ã	ˆÙ:ÄS°Şa2\"1¦..L'ƒI´êm‘#Çs,†KƒšOP#IÌ@%9¥i4Èo2ÏÆó €Ë,9%ÀPÀb2£a¸àr\n2›NCÈ(Şr4™Í1C`(:Ebç9AÈi:‰&ã™”åy·ˆFó½ĞY‚ˆ\r´\n– 8ZÔS=\$Aœ†¤`Ñ=ËÜŒ²‚0Ê\nÒãdFé	ŒŞn:ZÎ°)­ãQ¦ÕÈmwÛø€İO¼êmfpQËÎ‚‰†qœêaÊÄ¯±#q®–w7SX3” ‰œŠ˜o¢\n>Z—M„ziÃÄs;ÙÌ’‚„_Å:øõğ#|@è46ƒÃ:¾\r-z| (j*œ¨Œ0¦:-hæé/Ì¸ò8)+r^1/Ğ›¾Î·,ºZÓˆKXÂ9,¢pÊ:>#Öã(Ş6ÅqCŠ´Iú|³©È¢,(y ¸,	%b{K²ğ³Âƒ’)BƒßŒPŞµ\rÒªü6¹’2šK‹pÊ;„ÂÂ†\$#òÎ!,Û7Ã#Ì2¥A b„œøµ,N1\0S˜<ğÔ=RZÛ#b×Ğ(½%&…³LÌÚÔ£Ô2Òâè¸Ğ‘£a	Šr4³9)ÔÈÂ“1OAHÈ<ÄN)ËY\$ÉóÕWÊúØ%¸\$	Ğš&‡B˜¦cÍ¬<‹´ÈÚŒ’Í[K)¬Úâ\rƒÄÄïàÌ3\r‹[G@Lhå-è*ò*\rèÔÀ7(Úø:Œc’9ŒÃ¨ØLØXËÅ	ÏY»+Z~­“;^_Õ!‚àøJù…Âë¡ˆM.ÍaŠÃ«:Ã/c°Ãv¤\"¦)Ì¸Ş5ÈÁpAVµŒ¼\0’,é†NµÉ2İìƒàç‚`É@¨Åº©ğÍ?.@ Œ™bı…µĞ É\n‡‰Ğ€ŒÁèD AòŠ6.hxŒ!óIÀ®Ê8\r(É…£´Ç‘aØ‚P•*0«İ§Ë^ù¿gÛ+´mCEN8aĞ^üè\\kÎêÎ3…ò7KHÃòíc˜|\$¬H½T:n{¬tFøŞ³y4½²üÃdP:~ó¦=Ogpü©°äzÑ>`V¦4—;¤Ø?Z¸å\$#ÌÎZf=§äD·‰{ş„ch{ôÄ4æl3\"ÈòêŞoÒşhg¤õ—òj€H\n-º¤A@\$ˆ€’&dI(f¼ß½cšÎŒ’2 ÔÒRŠa1&dÔ”3fMkö6à6bTK	q0e¡µ>Sû\nŒ\$\$§2âÀ‰¬,Øñ–·êà’0\"ƒrByÕÓA?æ€€‡fTI\"kmuw>Sş®C<qlŸã*Ô—Ê·-0 '…0¨y>\nDÕ€âŒxå‰Äû¾÷nØI)ÎFqã—rõŒi(11œÃ2G‰\"AŸ…˜IQ“\$a*@³˜n‹Ê/…«¥â_¡i&,Ÿ,SÈqÑ\\,/RÉZËPÊ®Hââ—A&Y\$h­åû/…øÎ½`š¥š¶–Ïˆ3*Iš¯&|²XFâi®¹­.‚\r€®4†ÆÒÙ\$lÈ68@]ØiËô¼ ’pK£ÎbAT*`Zé®.ç4”+š&<¶%°–+Óa&ÚÄ™)¦TÀg¢DÑÉ˜/«‚C~JgŒóMŒ9°#XpÀT{\r’1î^B©ã6©ŒµÎ‡{HWìl°Ù´™3< ªâ)hR„¬tiYQA\\4òp@HBåM”<;Ğê«%Â’& (!‘ã~“CÄ%/TTà¨ ä¡#Áqe&…¡0¨h©Mªqx¿/Ò©t	á.lèZµwuä×°\\";break;case"ar":$h="ÙC¶P‚Â²†l*„\r”,&\nÙA¶í„ø(J.™„0Se\\¶\r…ŒbÙ@¶0´,\nQ,l)ÅÀ¦Âµ°¬†Aòéj_1CĞM…«e€¢S™\ng@ŸOgë¨ô’XÙDMë)˜°0Œ†cA¨Øn8Çe*y#au4¡ ´Ir*;rSÁUµdJ	}‰ÎÑ*zªU@¦ŠX;ai1l(nóÕòıÃ[Óy™dŞu'c(€ÜoF“±¤Øe3™Nb¦ êp2NšS¡ Ó³:LZúz¶PØ\\bæ¼uÄ.•[¶Q`u	!Š­Jyµˆ&2¶(gTÍÔSÑšMÆxì5g5¸K®K¦Â¦àØ÷á—0Ê€(ª7\rm8î7(ä9\rã’f\"7NÂ9´£ ŞÙ4Ãxè¶ã„xæ;Á#\"¸¿…Š´¥2É°W\"J\nî¦¬Bê'hkÀÅ«b¦Diâ\\@ªêÊp¬•êyf ­’9ÊÚV¨?‘TXW¡‰¡FÃÇ{â¹3)\"ªW9Ï|Á¨eRhU±¬Òªû1ÆÁPˆ>¨ê„\"o{ì\"7î^¥¶pL\n7OM*˜OÔÊ<7cpæ4ôRflN°SJ²‚›DÅ‹ï#Åô³ğ‡Jrª >³J­ÓHsŞœ:îšã•ÊÃ°ÃUlK¦‰Ö,nÈR„*hı¡ª¬›ºÈ’,2 …B€ÌÃËd4àPH…á gj†)¥”›kR<ñ‘Jº\"É£\r/hùPš&ÒÓ¨RØ‘3ÂûÅ—K!TÕöRN•ó°Æ'ÈÏYI«²ƒËx:²[IÏl~È!U9H>ª}á=ëÌœßën2)vF<ê1êäQa@	¢ht)Š`PÔ5ãhÚ‹ct0‹µúÚ[_Óz?rb\0Pä:\r€S<Ğ#“J7ŒÃ0Øõ¹4VÈJ•õT­U·ôX“È@P¨7µhÂ7!\0ëE£ÆÙc0ê6`Ş3½C˜XÚ[HÂ3Œ/PAÁ¶@Úõ­ØP9…*zN†–A\0†)ŠB2ª#é*ˆê¡uL†ÄÒaŒ*ô’„¿‹dLT¦Z	+ëê3Všæ@êv2’Æ¯«g;±4Pf3OÃ­õ„ÉÃĞ6ö1Ñ´XÉàÂĞéÃ0z)}	P£Ô3‡xÂbÌÂ\0„ßÉÂå;b®C!iN€õòÂõOÕ½^®„&a5›°äjPò K!C‡\0ÒÓ‘Õzá¡ì½°Ğ p`è‚ğïÁpaymQ ÎÃ(n…\n\"¨µŞàsÁ\$6‡^aHt|¯>poCzÈ6°ø0†³JPâlÏ47B~Éñ×fT”Ÿ¶ºcEÂ.}¥Œ’fA¥!ñ(Ğ@ÍstF”8 gˆ¡ÂÈ!š!†ÜÜ“tnÍáFƒzm#	0à8!CHa\rÍ£dr_‹qU\$¬)¬eş»Xb¤4>‹OÙƒ!®²H¹”ƒ%H›%A\rF¼ØÈøÍ¡¨5F°×\0Ê²ÓG6fı\n¡yİƒ¼·)í „t¿ ºròH‚,%^M¥Q.(kô‡;Ò¶,ŸaÔ\$\$Nj*òPÊ)G>G-H«§=\$ŠÒ3Uä*¿4øLÂI&|@Ò²\r:Bº!ãfÓƒˆu6H\\3 €ÚòaÍ€æöÈVì„\$¼C¦ÅGØ ¬ˆlÇ\n<)…BDf#®X†s©:²‹Ú‘Š%‚bp§Q%%ÒŠMóŸI–HØET¶J’¤N¼£‡¤¡o¢ºx[f;¥\n (ÙèÛ;j†Á¾®ƒHgL(„À@¥¨ 5¯\\#@¡U§ãƒ†¨mÁĞJFĞ1¤ALmN“a`OÕzÀsbÅÙ©ÓôuŸñA¯K\n¾WD`D×‘7_Ö’Dô[7li¯r~m”X@ã…&a: Ø\nÃSa­B G®¤U–0ú †ÌÚbA3Õ„6¼d/Ü\n¡P#ĞpŸŞ„ö=uô)õíbWë… ‡¼[Ô‚:³9#sE±zÔ{¦PLA6ÖÚö71©Ñæ%I!Š#¥Ì–²›\$W²…¸ GU**ĞDBÒåèŠâ‘MPäª	•QÃ ”\"ƒ@V„OŒšRS4ÙsV.e8¾¢>_lºã½‰Æå;˜I8e5ñ’[¤Å>+¯:Â¾¸ºŒ)OVÒ1oÖ¢ªó\0PÑ4»8äê%|>ªkıõ°,\0";break;case"bg":$h="ĞP´\r›EÑ@4°!Awh Z(&‚Ô~\n‹†faÌĞNÅ`Ñ‚şDˆ…4ĞÕü\"Ğ]4\r;Ae2”­a°µ€¢„œ.aÂèúrpº’@×“ˆ|.W.X4òå«FPµ”Ìâ“Ø\$ªhRàsÉÜÊ}@¨Ğ—pÙĞ”æB¢4”sE²Î¢7fŠ&EŠ, Ói•X\nFC1 Ôl7còØMEo)_G×ÒèÎ_<‡GÓ­}†Íœ,kë†ŠqPX”}F³+9¤¬7i†£Zè´šiíQ¡³_a·–—ZŠË*¨n^¹ÉÕS¦Ü9¾ÿ£YŸVÚ¨~³]ĞX\\Ró‰6±õÔ}±jâ}	¬lê4v±ø=ˆè†3	´\0ù@D|ÜÂ¤‰³[€’ª’^]#ğs.Õ3d\0*ÃXÜ7ãp@2CŞ9(‚ Â:#Â9Œ¡\0È7Œ£˜Aˆèê8\\z8Fc˜ïŒ‹ŠŒä—m XúÂÉ4™;¦rÔ'HS†˜¹2Ë6A>éÂ¦”6Ëÿ5	êÜ¸®kJ¾®&êªj½\"Kºüª°Ùß9‰{.äÎ-Ê^ä:‰*U?Š+*>SÁ3z>J&SKêŸ&©›ŞhR‰»’Ö&³:ŠãÉ’>I¬J–ªLãHƒHç‘ªÜEq8İZVÑÕs[Œ£Àè2Ã˜Ò7Ø«ŠùÎ­j¶/ËhŠC¨ù?CÕ´KTÖQ	¡k¦hL¦X7&‰\n¯=¨ÕpƒK*Âi¼Y-Šú±UËD02!­RÒ‰!-ùE_êÚ>ı#ğ˜H…¡ g††¨ùD¾	\"±x´\$Ò©SŠ£è:Úºw£Ğ8°JóÊn¸6ú¼˜²Ğ–@\"…£hÂ4ˆù<‰âKŸkB9¢i3Yğl¢¨/©Ä'%”Š–•ÑJª¯(2ì¥+n©ÁvÙ%úÒ\\Ë4ü’éšã^bÊíÈhR8th(Äææ€” P¶®³Ûèº´Åç\0Ùİ9““šJšs¾²cîõD6ƒ•˜'ÓÌ¼ŸÍò²ebÚïiJÎäğ¤ûÄ!øºT†©nÓ=ª8	“jÉKì¯>h§në!¬FãÉıÅ Ë‹÷ÊŞÎ8A¨4ËF­ëÖÿN¦i§Z¯uëÏeCv³:ä÷0'xí÷å§ƒğxx+¾“xé'Såy‹´ƒ÷Sê±*¼¸ş.ŸL‰ú\\ÊI˜‰!¤Å&ˆâhˆj×|ğ¦’%¥Û;Z:\n°è¹„:nÓÚMåAïšƒ´§‹Š5hXïAF¨^ˆ;³\$æ`¢@ĞQ\n:Êä:¬`ÜÁ\0A´4†äP“ÃÈXÁ‘\0xA\0hA”3ĞD[>Fêì:CĞÎxaË(¿ (6VËcXKô‡‹\0vë\nôx\$İ÷•8¶, Tîd›“Å,ºßúow¤‰9Ær‚ßÉ³'\"#Ä˜—AhĞ80tÁxw’@¸0Ã¸zŠr+à½bIÅ„±2Èñ<9ƒçBÕJ¢X‹iå££M	ÕlÇèŸòÊ|›/xªÍ§“6iH\\ƒZË ãƒx©Z4`<X¤‘²pÍQİ!²Ò\n›r¦~\n³H= *#PÂâªÈİÀ@‘¨pEÌ9ĞÊ¿fXaÉ0ÆC˜f³˜6ğÏgi P4j¬çp q.\"èªC`s9‡ç¦-6S+ªf‰•ç.˜%ãuRå¸tB€H\nY¿Õ™Í  ¸—˜üh+Gk (!¬ˆ}8\"µ\rà€8 Ò™àeó¾¢\$\$t¬‘ØoG´B~‡yŞı¤ƒvÍE/œe·Òj\n&.Üı”Î’¢\n)OR˜KcÇEÍ\\^Ñİ,µ§î€Š»›!©,ºˆô`Ó‰«hğP¶Ñ\">\$\rë°‚®Y¬6ƒ*mMYáLO‰J®ózW+±R‡2Z'‚uB•0=4¡cì^ÖËŠ<Æ´»Ú­:\n³L¨¾òs«qµ˜×ÒB»¥„{íU±w0^Y g”Ÿ'»NS›ÅVæ	H4ošièšh	D”‡tŸ\n)^T·	Æ\"@Ú15¤ée××ÒÂ˜Q	…œº²hq…¸ ÁR• I¨öIyKJSİ6“¾—Ü«0N~Ö\r*û×À½æ©ÚÜ¤jVáqÁí	3a8V—”TLØiäáj­ë|\\éÀİ±âcŸªû^¸CÒ)6RÍ AE`Ïc¼ónbøM²b¹d¦‹=km¬!¹Ø\nËéÓ&+Àï¯KPWŠNµ	¦ÏË3O[šÒªi­6_SO3Í,ÑËÅq:\0ª0-b&VRÍ\n#P8ÂÑ~áô¡€”;À¦Ü^ãõùÛ0±È­šµà=w-Sö{nÒlÛzBâ¾TK%’ÒDyÓKD\\Fî`*glƒß+d/Ædh{°\n‡O\"á¶(šÊ\"õ­k1¥Ä¾¢t´AûYÇød{ÌW…áÃq2²ÜŒÈÕ%Çqm™)«vÜsI>;Gf²¡B¢-RÎmø\r>ófÅÚ#¶É„¬82šZzÖÍv8İu[ô!E|äÓ\rÊ©H…L}4­Á“m§[í‹xíò±âÓÖ®õ´£Ä÷Ğ6KÍ•:mG²u)\\qŒ¼ã€";break;case"bn":$h="àS)\nt]\0_ˆ 	XD)L¨„@Ğ4l5€ÁBQpÌÌ 9‚ \n¸ú\0‡€,¡ÈhªSEÀ0èb™a%‡. ÑH¶\0¬‡.bÓÅ2n‡‡DÒe*’D¦M¨ŠÉ,OJÃ°„v§˜©”Ñ…\$:IK“Êg5U4¡Lœ	Nd!u>Ï&¶ËÔöå„Òa\\­@'Jx¬ÉS¤Ñí4ĞP²D§±©êêzê¦.SÉõE<ùOS«éékbÊOÌafêhb\0§Bïğør¦ª)—öªå²QŒÁWğ²ëE‹{K§ÔPP~Í9\\§ël*‹_W	ãŞ7ôâÉ¼ê 4NÆQ¸Ş 8'cI°Êg2œÄO9Ôàd0<‡CA§ä:#Üº¸%3–©5Š!n€nJµmk”Åü©,qŸÁî«@á­‹œ(n+Lİ9ˆx£¡ÎkŠIÁĞ2ÁL\0I¡Î#VÜ¦ì#`¬æ¬‡B›Ä4Ã:Ğ ª,X‘¶í2À§§Î,(_)ìã7*¬\n£pÖóãp@2CŞ9.¢#ó\0Œ#›È2\rï‹Ê7‰ì8Móèá:c¼Ş2@LŠÚ ÜS6Ê\\4ÙGÊ‚\0Û/n:&Ú.Ht½·Ä¼/­”0˜¸2î´”ÉTgPEtÌ¥LÕ,L5HÁ§­ÄLŒ¶G«ãjß%±ŒÒR±t¹ºÈÁ-IÔ04=XK¶\$Gf·Jzº·R\$a`(„ªçÙ+b0ÖÈˆÿ@/râùMóXİv¼”íãNŒ£Ãô7cHß~Q(L¬\$±Œ>–Ä(]x€WË}ÁYT¶ºğW5b£oôH¢*|NKÕ…DJ”ª®3 !ØşCmGêõh·e4“Ú5¶Z@£c%=kàHKC-¹´9r/ˆóA l¦ ´mœ¢N)ò\"‘J:k^H¶[qŠñ#¯\né‘	Û‘JW7D]ív¾c°­Êğ‹É\0EïK	«ërÜY)ù-dÖö­Ñ™“ö4S—BVaŠ¸¥ÙgèrÜĞpKPP€dtN_…1ÊÙË8»2ƒoÖJ5hRgÚòSs•bUÏ”İ£Ñô¸G+°&YM·¶ıs¶§ÑÍ\$\$	Ğš&‡B˜¦pÚcW´5ª~ÃKìMÑºh;¼mGÇ»8Ø:@SºïŒ#“È7ŒÃ0Ù&´J£Ò²ÍHÇ\0%‚™†¸Ğ¨Ï8m!¸<‚\0ê¿¨cgÄ9†`ê\0l\rá&0X|Ã”\r!œ0¤ÀA	œÈmIÔı€æ\nTI[T\"œD`@Â˜RË\rE¸ƒzSK2¯R¢¸•¾Tféú/\n¥•\nhVš•8…tÂED@ÔÁnxÑ,§CÂ™f^!Õ~¤Ğ@C\$*\rÉ²†5ş¿C\"l\0ğ0äè\".@ˆ'…æ`g€¼0ƒçômÔÛe6ìEÚ¼4TˆHqVBİá<GZQàüˆÄÙ”ÀgŸAJ\$@ÆÔê~ƒ‘èPŠ93¥òKòQÎ:†ˆïC@tÀ9ƒ ^Ã¼ÁÁ†4¿„à›Ã8/¡ºe/©–¿Wø/AÌÚpm™aÒAÈUŞ&Ñü\rìèúN\0ÂÏ iPI²F°ÜõYnSr€¨®wÈ)™+/*.E3Ş…ÍX¾ˆ«FI%ódc\"ñä!@/ğ@ÏlG8&ÈÄ¦Ó:!šT'è% ´ƒPq5Qø|ÃAäa†m\0Ç,¦Øi!°9¨“¤ùÔtü*1eM6Äv‰³:@\$¦†,ùf%•F¶ÄO¼ó\0 ¹;ÑLqÃcHµ“	ú~bÊpC_ñ®†HæyÏIë=§¼2³¥\0ƒ¡ò?Éí>Ó84ëj‰3Îî\$†/y…1p§Ã\"º”MaDU. ®„­`–ƒ*3İ»b°ˆÈ ÊH€C&Ìgá«ˆŠ™`çCŒT@³¦õ—:Ú˜ŒÂ*d.o¡Ã\\@‰…*æê€J(~S‚I'x@ÒÎ2}NÁºrÓäüƒˆu>)ô3&àÛæ,k•'òeÒè4©EsPgÁD¬„¢P\rƒÂğ\0Â¡½EáEËä[*Ú@óñ\n3Rl-êµsáòÛUR‹;1d5YU#ÜÊ!‘LîÛœe+nÎÄ¡Jï¾—@¸6|ÄÔ1Î˜Q	€€3V°@{#¨F\n•³ Ó5Ô'º—X&ÃÆœS1q›bC’\0xÑY\"zÙ<—uù€d6jQG“U\\™z½i ¦(YFÔe6ƒ¬WR¹e(ÏRÑ¬ÄQiPZêó&Jµ%9Ì©r™ò®i796:e*jßö€ 9â¨<`ß`laû†0Ö(tuÔÎéVyÁ8ÃHf³¨º„l\\c\"}¢p5P¨h8^Qºã\$ÒëŸT†RË`„»ŒÜ)Ú5Vsl!EÏ|¿(læb°Hí»‡o+·šø¯ì4ÚŒÁaØÖ÷dæ=Ê}P7,ÅW7(„İKcxÎª¿#5±M¯áA7Pj*ƒ¡ÛVcmµùƒDt¸wìRa,Iä|‘Oñ×h3İ-¸¯ÑÉŠ(€â¢\"•“Õi+‡\nY´Â°0\n¨)Á3³ Ú›Óºs\\’bH+…Y™…u/]ÙB\$mÅ¿Ds Ë“’¢­g'Wiı´wf×í\$†SİC+n÷0©XéğUaJÙçªA…»M‰¶Š#ÏÊËq—­Ü²Wä;„Ûö^…Ò'ê1&»—_ñBñÅ³v&\0";break;case"bs":$h="D0ˆ\r†‘Ìèe‚šLçS‘¸Ò?	EÃ34S6MÆ¨AÂt7ÁÍpˆtp@u9œ¦Ãx¸N0šÆV\"d7Æódpİ™ÀØˆÓLüAH¡a)Ì….€RL¦¸	ºp7Áæ£L¸X\nFC1 Ôl7AG‘„ôn7‚ç(UÂlŒ§¡ĞÂb•˜eÄ“Ñ´Ó>4‚Š¦Ó)Òy½ˆFYÁÛ\n,›Î¢A†f ¸-†“±¤Øe3™NwÓ|œáH„\r]øÅ§—Ì43®XÕİ£w³ÏA!“D‰–6eào7ÜY>9‚àqÃ\$ÑĞİiMÆpVÅtb¨q\$«Ù¤Ö\n%Üö‡LITÜk¸ÍÂ)Èä¹ªúş0hèŞÕ4	\n\n:\nÀä:4P æ;®c\"\\&§ƒHÚ\ro’4 á¸xÈĞ@‹ó,ª\nl©E‰šjÑ+)¸—\nŠšøCÈr†5 ¢°Ò¯/û~¨°Ú;.ˆã¼®Èjâ&²f)|0B8Ê7±ƒ¤›,¢şÓÅ­Zæş'íº¦Ä£”Êş8Ü9#|æ—	› *²f!\"Ò81âè9ÇÄl:âÉâbr¢ª€P¡/²ÀP¨¶J3F53ÒÀœ7²È,UF„±8Ä˜€MBTcRıSTU%9,#ÀR¬¨\\u¸b—QìjÚ3ËLÖŒã\"9G.nbc,­¨pÇ,#XÆÃË\"şş±\"(ØFJü	ã\"_%ƒµº%ƒÓ(\rïJî®\"1<:Å‰]¸¬[ÊZ®¬£+ğ]VFƒ•è„^ÖéClÚ°í#ã-ÿSŞw­·ƒD)6~¥ Pæ0ÜB@	¢ht)Š`PÉ\r£h\\-9hò.°cÕ®ºFŠBF\r’ó0Í'ŒÃ2«7/êf9\\53I\ríhÚ)<æ:ŒcT9ŒÃ¨Ø\rã:Š9…‹èå¨Œ6Šâ¿u;7¨8P9…)pœ2²Ò³¼‚b˜¤#C‘5¹GßŒ;)_k‚vË˜Ú:¥ÂªR2½*4ML2ÑÃ:ûµ|LÜ”(£8@ Œ›[û°Œs´èîÍÁâ42c0z)¡|œ'ï£Æã|—\nÃ\rÜ‚µV¤D„OCZ3°ÒîNÂÓ˜È›¿°ˆç	Â³€à4²p°AÕ3o^4ƒ à9‡Ax^;ıv9ÑAræ3…îwã8¹Ó¤ìö˜|\$£ƒNcptwé7¥ĞĞ‰` iäŒâ¡TšyV€(\\¹°ÔJZèu&¨€‚€ÈHk3lÉà'B8åˆ@agÑ;\0îišÙ€4GõÍÄNC1MÌ%ªµv²ÖÉc^?p¼ÙĞĞBÙŒìœãè]Ã™./Eğœ€Â£Bs‚#ÇîAè@•Èph@\$‰,\$¨ƒ Â4K‚v*Ğ­ÎÀ“FiM9©^EÌ:³h‚Pw%ÜÊ7&èï…ñŞ@Äè0åÎZyé9ÏEtèÓÃaU	3ÈÂzsƒLb+ôÁ0@ĞÙ½;Ê‘5ÅÊECË<¥— Cr'6QüÉ‡êj€f?èmĞ>È\$Ã,@±?‡Ë#•éA=Ä(ğ¦¬i[ˆ`¶¢<A`‰\\D0z4œR‘6UD!&E¢àA›ènÄ(†B¤êUŠ;Ø*gĞÏ¢ævfÖyûA„±3ÕPB\0S\n!1ÄiØHF\n‘˜\"t4ƒ‚ q\rà&nTù\$Á¤=tÄOéE”ŒÂ¸#ŸJ½!Mä˜”»áBsŒº§9Ú•Â”¬CÁ0LÀÆÏiùtY¬:¢)òI¤E@Y¬d!¥àØ\nŞ1îE\0‚vÉŞ„!%\$:Ç9Æ\0 C Q(BÉ³…P¨h8M–Y2\\©ŞÌ”•MØ70ôNöH\rG¯r&”0²«ëÑ3¯Œe¹À¨2QÈ\r\$fr@¾­pØO)…'Ç@7Ìâ< Ñßi3¼ÄÖ*\\bOŠƒ>•p½Â;#KIñ›S“±&™J¾WLQCD\ne\r†¥Ú(fÉ~Q¡Vİ\" ÂiŠÍK^w)€ÒÙ’µ¬ä¯¤,1”7dÊ­VdyÈÑq” ›óNÃÑŠ½=/Hˆ;¤3fØÀ´õ%e’ÀR2Š¼“yKèi\0";break;case"ca":$h="E9j˜€æe3NCğP”\\33AD“iÀŞs9šLFÃ(€Âd5MÇC	È@e6Æ“¡àÊr‰†´Òdš`gƒI¶hp—›L§9¡’Q*–K¤Ì5LŒ œÈS,¦W-—ˆ\rÆù<òe4&\"ÀPÀb2£a¸àr\n1e€£yÈÒg4›Œ&ÀQ:¸h4ˆ\rC„à ’M†¡’Xa‰› ç+âûÀàÄ\\>RñÊLK&ó®ÂvÖÄ±ØÓ3ĞñÃ©Âpt0Y\$lË1\"Pò ƒ„ådøé\$ŒÄš`o9>UÃ^yÅ==äÎ\n)ínÔ+OoŸŠ§M|°õ*›u³¹ºNr9]xé†ƒ{d­ˆ3j‹P(àÿcºê2&\"›: £ƒ:…\0êö\rrh‘(¨ê8‚Œ£ÃpÉ\r#{\$¨j¢¬¤«#Ri*úÂ˜ˆhû´¡B Ò8BDÂƒªJ4²ãhÄÊn{øè°K« !/28,\$£Ã #Œ¯@Ê:.Îj0·Ñ`@º¤ëÔÊ¨Ìé4ÙÄèÌU¦Pê¿&ˆ®bë\$À ç#.ÀP‡Ló´<²HÜ4ŒcJhÅ Ê2a–o\$4ÒZ‚0ÎĞèË´©@Ê¡9Á(ÈCËpÔÕEU1â¶¨^u¸cA%ì(š20ØƒÃzR6\rƒxÆ	ã’Œ½&FZ›SâÇFÒ”²9kÅ6…üµ\r·0e•e¸ P‚Œ¨«qu\$	9B(Ü×2˜NÍ;WÄVŒk«)q£ÉsQp}0oµûG_õ>pH59\\·<è’²@	¢ht)Š`PÈ2ãhÚ‹c\\0‹¶Öy¯Pu&“\0Ñ´©*:7ŒÃ4;NÂ){]\0Nz‡€ÔîÈ\nƒz¸Ÿ\rÃÌ4É¶½\$31A’¼2PÌÁ«#8Â¼¸ÏµZ›\rĞØÊaJc¨nĞ@!Šb´È;ˆåšÆw½“(ã2ê6±R;¥ÅTêyLâl¦Ÿ¹á£ZÅ\$Ğ£¼#&Ø—Ã:b2£\$Áâh42ƒ0z*!}\0¯O`Ü3‡xÂ&)\"ŒS›L®HäşlK¯	´Ñœ8[Nêì`&¿ÍÂM£uâxÃ/Õ0]o^4ƒ à9‡Ax^;ır?Ñ¦¨Î»_¤LíNCp_Øaò(…•w.í3#tÕ8tja…ºœd¦Ôé#Gì,:PÏa	0%\09¡PACb~HNıü§@¨èa`Ëts^JCƒp¡*pÂ²kDa®,pŞØ!i,\r\"`ÂPŒÙ”Yç°½§DraÓƒøx&\\Á“a¡#+©ÅnP \rè!'”b\n\n\nˆ)@Ô‹(³|‹vÁœÙš³ZkÈCŞ5eÔ:TjVƒz/k\$;½äqÒ‰­ñ¿tèÃ	¢XÄ°“’’¶’Œ¡5'dö˜R*‹AŠfQRDXLBI&’5ªt¤Ct	7`€ÊAbJÈmtˆ¼•“tİƒÉ?æê? ³bïM‘8ŒÀ€(ğ¦2”>ÄøŒ@ÎñÌ.IïS•¦Q²+…æQÀF£Ê+İ…aÙ™´TJÈKÇ[¨š)XaO±µY\$|*‚î˜Q	… ğ0TŒ*qS“Ôd f—*D9‚`xÙ4Oæ±j5àN¨¥*£\$yƒ,\$<a\r SÔˆÍ2^I)E#’–zÑƒ4`@i%fˆÉYÌTštæŸÂ ©éQ#NÙ&î˜`+˜*2~ÔéØ²^¹Y§:¢‡ Z²IˆFÕ\n XbÚA\0U\nƒ„ÒÀLs·¥‡DŠÇÊŒ«Lò5Lı…Ñ“íC«µ=¯&€¡ÊŠêğ)[lĞ’µâhbL[Ó¨å“4³µÀTÜ1lÑ&½ãzâ£Çid†)Óíjh“Uºt£,ha–È«Ÿ¢dçå8“&ÜÈËq\\NøP1k@œ.d\n\$XrĞ¡˜ª`“kÁ¯FQV*{^ÒhSbÆà2(%’´(x¡ê&º “ ÕéEfé¥¯+  aq *±\"5ês-\rr@";break;case"cs":$h="O8Œ'c!Ô~\n‹†faÌN2œ\ræC2i6á¦Q¸Âh90Ô'Hi¼êb7œ…À¢i„ği6È†æ´A;Í†Y¢„@v2›\r&³yÎHs“JGQª8%9¥e:L¦:e2ËèÇZt¬@\nFC1 Ôl7APèÉ4TÚØªùÍ¾j\nb¯dWeH€èa1M†³Ì¬«šN€¢´eŠ¾Å^/Jà‚-{ÂJâpßlPÌDÜÒle2bçcèu:F¯ø×\rÈbÊ»ŒP€Ã77šàLDn¯[?j1F¤»7ã÷»ó¶òI61T7r©¬Ù{‘FÁE3i„õ­¼Ç“^0òbbâ©îp@c4{Ì2²&·\0¶£ƒr\"‰¢JZœ\r(æŒ¥b€ä¢¦£k€:ºCPè)Ëz˜=\n Ü1µc(Ö*\nšª99*Ó^®¯ÀÊ:4ƒĞÆ2¹î“Yƒ˜Öa¯£ ò8 QˆF&°XÂ?­|\$ß¸ƒ\n!\r)èäÓ<i©ŠRB8Ê7±xä4Æ‚ĞÂ5¢¥ô/jºPà'#dÎ¬Âãpô§Í0×¼c+è0²ŠÔ¶#”jÈFê\$AHÈ(\"ÃHĞï”#›z9Æ‚ äÖ;ëèáFÑé´.âsVğ¢MÄÈ„\0Ä0ÂÀHKTÕp°óWV`è¹CÜ7PÁpHXA‹İGµ@Ö2DIĞÒ;O(°Ã@Bb`Èˆ#\\f÷›Ğ\"…¯*0	ö`æšm\rF-@ÚÒ1weĞ7¿7%Ít±bò6‘\rÑ%R2Ü#\n07ĞØ<ß·¾†UîN\nŒ0¸Mö_Ğ^\0b8%Äì•é\\.bô8	¢ht)Š`PÈ\r¡p¶9fƒ»n[Î»üMÔ”£3Ã0Ì¡@J˜ËKè÷µ;H²7‘Z¡;A\0Û]Ò\$5£šç~¦ôå!O´Á`@=kü>\\6ßâ#l¢Ø6ÀN¨'Úé«8:Î·«kÔñCP»É¬ÌíÇ]Û^©mñö¹:íª¸.÷®¢ú^Àšğ[/´qVÛÆ³Hğš»8Ö¦)ÁpArŒ®Òw3ŒÉHÚÁSÄÏµ%w/5¿´É¼14”z4;8»)¬?‰«	±·è”(Ü¦¡\0‚2mĞ—±ú@2ŒÁèD¨Aõ6LÈ£ƒI¡à^0‡Èë¨a—©ÈÕ£tŞÀC²?J}t¶'Ö£—IÚLêQã!Z„›K‰A®œ¢’E@Í3”A)ŸÀ(~ÁáAÉò>`Ğ¢İ@¼‡x\\–›İhà¸”†p^Ã˜/Nñÿà^ùÃ˜>	!´8´º‘Z~OÑ©\"ò&S\nƒb02\"šÒ0FŠ12¯òÀÕŞiKƒRk/d1?‚HN	Ò \$­l£5TVd\r(0\0@0ÅĞs}Âlí%Ş€#d5†§PÛœÄ\"¢„ã4\"c¸º\"¨4’²ò^ã\nGi+.Ô¨D(d‚¡Ô8F&ãc8‘œgP~\0P	@I©8+H´‚@ ÕDƒR£/F(g•Ïâ?’•n+Ğ’x± «·KC¤a&FÉM£Ä“‹`)…9„DƒÎ#¬<¤¼Î7³5©\"S¦3“¢jì‚ÔDp€Àä\$ƒyU!©³'DŒzÓ hˆ«‘\$ŒP¥SÛ†D	±ôFkÜ1F\$3\r¬=@í.P¼¾}=È“â€`ÏP	áL*(_çÄGSé—›ôìÚ'ÑAM]šô:ÿÃ0iáÔáˆÙBa k‹=ˆ2VŠ\n;u!L(„ÂJIÊ°m.f= ?Fç¨m\ró|`©-\rù0@¦ÅÓ¶ÆG£H)h4|™Rû7áÌò‡¦\0~Ô]u1õà1W£}Rƒ¨a(Aêaêè©ƒ	P¯+¤Ÿ›‚y`')«(FˆÒ0#_…\n{f,Y…¯Óª³Í¥b\n¦ĞZ&*Â˜Å§³†•ZÂÚGªÓ!A: Ø\nÎñCµ):ªRjq\n#b©MTŸ„f™ÃÔ_\rÆ)U„Pî×96Œ¢ô’<Äv,åv`d*…@ŒAÁ+œµªgX×kmÃaL2ö*ØÃï}·O–½‹‚ë}æµlwêÜÍr&EH¹pnœsf`šÀ\nWHÈ©B·)M!ŒEızÊBŒˆK#—FÎšBü3U-á½!4*™ÈšdC˜xÄ‡C5WÉ:;'l›SR\r	áR‡Ş°OC‰Ùv¶ì ¿‚~şY¨DJ Ë>Ã(ˆ•¦U3\nÍˆ¼àÈÕÀOOs¤¸\0 –F\\Bß¬D<ØƒÊÈ¥ô¸ÿŒJ	øAPÀa1DÁ˜WSzƒ€";break;case"da":$h="E9‡QÌÒk5™NCğP”\\33AAD³©¸ÜeAá\"©ÀØo0™#cI°\\\n&˜MpciÔÚ :IM’¤Js:0×#‘”ØsŒB„S™\nNF’™MÂ,¬Ó8…P£FY8€0Œ†cA¨Øn8‚†óh(Şr4™Í&ã	°I7éS	Š|l…IÊFS%¦o7l51Ór¥œ°‹È(‰6˜n7ˆôé13š/”)‰°@a:0˜ì\n•º]—ƒtœe²ëåæó8€Íg:`ğ¢	íöåh¸‚¶B\r¤gºĞ›°•ÀÛ)Ş0Å3Ëh\n!¦pQTÜk7Îô¸WXå'\"h.¦Şe9ˆ<:œtá¸=‡3½œÈ“».Ø@;)CbÒœ)ŠXÂˆ¤bDŸ¡MBˆ£©*ZHÀ¾	8¦:'«ˆÊì;Møè<øœ—9ã“Ğ\rî#j˜ŒÂÖÂEBpÊ:Ñ Öæ¬‘ºĞÇ)ëªğ¡¾+<!#\n#ˆ€ÉC(ğšÈ0ß(¤âbšÅKÛ|…-näß­ƒ°Ü‰éü	*×ŠS\"‹Í\n>µLbpòĞ¶º2î2!,ù?&£˜5 R.5A l„ @ P¦;ƒ@ì³k#4ŸºmÂÿ+\r£K\$2C\$àŠÌ Øî¡k\"’B0åDŠ•2|\nËàĞÂÎš•ĞJefÏ(èP3ã`0¦è-‡eÑC¨\$	Ğš&‡B˜¦z^-˜e-Ës”¢íyW6£#Ô\rà,è ÂÒã0ÍUª”²ESKj:Æ\" ßÍãÊ9(£Æøc0êÏNkXæ&–0Œö‚–µ¨såJ7©¨P9…)8ª3#c|Ğˆb˜¤#«¥…¡^7MvLøÛN{[48°\\»,e¨*\r’VÛHÃª¸„É‘¡XÀÇ) É!\0ĞŒÁèD¢AğÉ)´èxŒ!ô5ˆ\r2šæ¡`ƒbt»49Î£Ğ0ÏMhË“¥*€äs(ÊÿFêb¼ïq¸\\lÉ³\r¸à9‡Ax^;ôrC¬<ë8Î©]d¥JCp_³ağ’6£Í‚•,mûŒ9ëE¨I€Ï´#:tÒ¤MK ²]Şæ9ö(+ìücZÛÆˆÀç½¼‹:“éˆÀÂ1¦2˜@;¦Sê1çè|ùË¶ˆbX£i}ƒ ĞLÑ'<3zîÃImdœ¸‚8°iAå\0Ã—6ŒğÈ«^'èË™°@@P¬Á2„\n\n )rDÀ’¼¡L‡œıiL‹¾„ºLiÕ\r0D¼\$ø}Ã‘¹#'Äù™óVx‹ã*eŒ¸¿æq“ào#Áä9³Ä<yÉA*%„¸Ï§¶‰ğtL& 7°³Ûé¢Õ8hP™o\"!åz(\$|ƒyôXp\0§›ÀÊC©ğ4!˜ëö¬ê sd|ö¿èú~‹“ˆ‹P|'…0¨@T+Œ¤*3™µ–Ó\r(A´Ñ†rD‚ˆŠî„»”%0AIÉ;'¨A¤G”É gªİô§ĞAÑK#¤|”–N0S\n!0 ÔA\0F\nA—p¨as„ &\0R‰8E\r¤]<¾ÉªÔœS’M	TTgTã©6s IÖ*y}ë–‡\"²ÖjÆ\"ä8OÀÓ?œ°\nhp6°ÖƒYù\\®ıŠ`ä_^#È4P¼2M–†R\ra{FzŠšPÒ¨TÀáš†PÎwÓ*]Ÿ	ğÅ\nc\nÃL×ˆ3Áf,Zjc	R§Ib„„³\$Fi½UäbUš£X††4ˆ|3ÙNH€Q{&rô¿›ÒüŠ’ü~Kn-UÑ=#œ‹ŠJ_`aoB˜ø¢šÖ»Ë‚ª9gB	!öºsA>#ôú¯@ÓÙ¼1d&€ÓòŠ‚±mæ%‘ôÆI\\@0ÎŞÍ	_*›\r'©²µBê®Â”ÅEUF©“H@";break;case"de":$h="S4›Œ‚”@s4˜ÍSü%ÌĞpQ ß\n6L†Sp€ìo‘'C)¤@f2š\r†s)Î0a–…À¢i„ği6˜M‚ddêb’\$RCIœäÃ[0ÓğcIÌè œÈS:–y7§a”ót\$Ğt™ˆCˆÈf4†ãÈ(Øe†‰ç*,t\n%ÉMĞb¡„Äe6[æ@¢”Âr¿šd†àQfa¯&7‹Ôªn9°Ô‡CÑ–g/ÑÁ¯* )aRA`€êm+G;æ=DYĞë:¦ÖQÌùÂK\n†c\n|j÷']ä²C‚ÿ‡ÄâÁ\\¾<,å:ô\rÙ¨U;IzÈd£¾g#‡7%ÿ_,äaäa#‡\\ç„Î\n£pÖ7\rãº:†Cxäª\$kğÂÚ6#zZ@Šxæ:„§xæ;ÁC\"f!1J*£nªªÅ.2:¨ºÏÛ8âQZ®¦,…\$	˜´î£0èí0£søÎHØÌ€ÇKäZõ‹C\nTõ¨m{ÇìS€³C'¬ã¤9\r`P2ãlÂº±ªš¿-ê€æAIàİ8 Ñ„ë£Ã„\$šf&GXŠÙSõ#Frğ¡Dè	ƒxÎ€TxçÃh;Úï1“\0ê†(I89¤cÒˆCÊH„µe\\–CPÂ/tÀHÁ i^†.Øêä1‹øØ­J*å\$¯lc\n£#ÈÜÿˆ-èÒFµ2:Î¨­\">Æ¡jj4€P­l0££†3ÀP‚7\rÕ§6ˆ#\\4!-3X„\rÆ¯Éeï|¬‚7\$ç€¥¨V™SõI‰@t&‰¡Ğ¦)K\0ÚcVD5¶Ëİ°û5)±ƒeÔí«H:÷e½³è`ì¸Ş³PØ±‚Ót;+SŠ3\réXØ7Â­.7¢²¹pAHh0áÙ(cHĞBh\n ‰¨øƒ@ˆRx€§#`\\èHöŠƒhúHÏ¥é´²¨êv«k\n¶7ë®;°N{ù²Ñ&Ò4mcvÚ™ˆb˜¤# ß}9ã;#—(¼Jƒ6H0\r£ª3\$ÛIãèş7w¶1ßIzÀ÷]¤%n¼™Š9é®R€Œá\0‚2\r¨\nÖŒtÓ„àÂĞİaèD¨„AğÈ\$~@xŒ!ó>ÅZC8æ25«†'É@ÜÖÙ:Ï\\½ö%ÜF‰æMO0rªiN) @‰,~'ê½pĞöA_À9ƒ ^Ã¼Äiæ—´‚ƒ8/#`½>§õ®{Û`ø\$†Ğà[ÓQñ8Dqñ¾RÌ]*r50†€ŞFÍjVBg9•šSÍÈ '+™ ¨SŒ‹é\$æDê…\0hS%ª\0ÌD¦RÂÖ³D+d½<nÃ9\$Er²ş\"#ÅMD0†c¨AÖc‹a™Õ–Óã`trƒ*„ÔÃhä(#(ó—èr:F(†ãH@Jq:XånG—³b©O†DÎ2x­,’:rUy‘ĞPTAL)Äy<&€å	{/ (˜à]!o%„\r\r)'œĞ©»0(2¢\$\0´Üú9%)ı³ğÊBHnO„?ÖbNI»muÄø eŞ’‘;zşXdKør^åÑ¬“&®èáÑ^\"Ø…˜0®G<86sšmy¦WM\\´#¯.ªFGÙO4Eıùr0VŠS_ D´ƒE©(LÂ€O\naP™vdt\"IF\rå)«—r¡tŒÄ#”r’RÓ£ÔgaÈ£Š2wá»¤4“ş#ÄõY Iaœ:ŸxÔ`Í\0k)¹f¹\rJ¨É\n!2’ªbM\0F\n@Ğ‘rTF!á o²ªKCaƒ•;€ğ¹\rÓŸÕIÑ©¤l@¢½Ë&Tõä;×º®W’)°&]TÄaaRKty”ô†{¿\n’\r&š7&¶jüœ¢ê\r€¬%¬wh\rÉ°0§bU¢„'Q	\$ŒÅ:•6¨TÀ´X~£!&kòÆXK\r\\æ*9+m¾â-£2fÌíz²\$tœ\\”tí™Hw2|ê—ÕŒœIA*`D¼ÉŒ1@H\n/Ç™n jHÍO=g\\ÄZÕ‘èÕB#ªZ„­jï¬”E\r9ÛZLáäT¬œŒ´)ZÜ«-ÌH’&bZCiÔ%ˆ®‡5W‚ìœ`Ø€Ì¤f»™I,ì­—&ÛK7W\0xºÍxÆBÜfá–È€ävï±é·°X–è&ÕøÁ\0";break;case"el":$h="ÎJ³•ìô=ÎZˆ &rÍœ¿g¡Yè{=;	EÃ30€æ\ng%!åè‚F¯’3–,åÌ™i”¬`Ìôd’L½•I¥s…«9e'…A×ó¨›='‡‹¤\nH|™xÎVÃeH56Ï@TĞ‘:ºhÎ§Ïg;B¥=\\EPTD\r‘d‡.g2©MF2AÙV2iì¢q+–‰Nd*S:™d™[h÷Ú²ÒG%ˆÖÊÊ..YJ¥#!˜Ğj62Ö>h\n¬QQ34dÎ%Y_Èìı\\RkÉ_®šU¬[\n•ÉOWÕx¤:ñXÈ +˜\\­g´©+¶[JæŞyó\"Šİô‚Eb“w1uXK;rÒÊàh›ÔŞs3ŠD6%ü±œ®…ï`şY”J¶F((zlÜ¦&sÒÂ’/¡œ´•Ğ2®‰/%ºA¶[ï7°œ[¤ÏJXë¦	ÃÄ‘®KÚº‘¸mëŠ•!iBdABpT20Œ:º%±#š†ºq\\¾5)ªÂ”¢*@I¡‰âªÀ\$Ğ¤·‘¬6ï>Îr¸™Ï¼gfyª/.JŒ®?ˆ*ÃXÜ7ãp@2CŞ9)B Â:#Â9Œ¡\0È7Œ£˜A5ˆğê8\n8Oc˜ï9ŒŒ)A\"‰\\=.‘ÈQ®èZä§¾Pä¾ªÚ*¨Šô\0ª¹‹\\N—J«(ì*k[Â°ëbÜÆ(lŠ²Ê1Q#\nM)Æ¥™äl–Ìh¤ÊªÂFtŠ.KM@\$ºË@Jyn”ÅÑ¼™/Jîò`•¼ğ3N¡•Š¶B¡òÛzö,/ƒƒHç<“ëNsxİ~_ÔŒ£Àè2Ã˜Ò7á¬)6Tª¼`€8&tR®8Ø«ñ‹¦«Úg6vv+h“N…ÓXµ¸¹Gd¥,s{3Äâ¾œSğÚM—‘¹Š¯š«4L¡Î}*gË.J2ó…:^›§Ğ)ş–5\rj\\A j„ÀÂp)lûÚ\\\$É'jª F©k£†¹ªı½µ\$\rm©x ®9%NS\$¹p|¡hÚ0#dcU\$ÂÌ§¹&v_x'ú§ª+ÿŠ ª¹-jC/Æ\r•NYt|+²j:gMÅñ½VgÖp¼-;0¤ŠRg/Ò©Rg!Ñ‰“~2DJ\$ùn¬¥à^-¤iï¬.ğJÏ³Ï\"\\‘±Ï¯8˜C`è9\$“ª…Ê=\n¾]Oú-g©Æeµ;·dK|JŸÜÇÜù ¯Ôó3ô¦Æ\nÉ;CnÍW:Å‰Ñ)7¯h×+¶(n\nññ*Šı˜ U #÷B\$X=óêiYÊ³{ÌhºXußzÿtpLÖ;`[ºz%™%*èÊÑ‘2ÇXÔÁ¢L7¦â³æf†á\$&AĞ¥ŠS‡¡yùÉ×’+*YV\$Hø£tŠII-aL)`\\ÎÏ!Kª™h¡M\nã”\$Ñ\\”ÆUÄ-\\ôÂ²Â ¢ï-È¸¥@ĞSJ‚Ì:°àÜÁ\0A´4†äá	CaÁ‘8\0xA\0hA”3ĞD`>Oì:IĞÎxaÆK¢	OIy¶.eF\"˜JÛº%jb_Dè:Å4,‹DC3ìŠI1de+)½‘\\ÊOc+\n7ÊyS*åh\"\rĞ:\0æx/óÌ7'S€.Naœ°ÉúÂ˜cb\0¾W‡0|ßRR+T'Ô¹,ó÷.%ÒC9WÃÔRD§¸½¶âlƒ…dÌÜû*\$WáY;4qø¤˜cÎ!R¡gÚÀú&‡ó *§á½œ:pAeùæ+‡0G;Ğ#“èarÕˆ\0îã]HbO¡Á8I0äC+L!™…‡%Ãa˜:ºØÃ<©Á¤:€A[Sêû«\0€1Ê¹H¥¨a\rÌÂ›3kÉ1À¥OÄÉŸ•jH!+)ë…*¤«HQ¯§DN·±lİ©„K‘wXUid€H\n\0€ R÷ÏHjèåt’²ÒwË9å(!±	=Råµo\rà€8 ÒœheõfŞ(¥¾”oPµê³‡z²oÊ¢Y™tP¿’bD‰\\U2\$%S\n)L‘Ü\"…İµ*r¢\\XªE³g0­‘Hh©…êR‡ÙkQB¬=nô“)3nË¤ÌE‹ÀáĞèc_)%H€ıÇ\$Y4Oé¬@&\"h@¸õcI¦“3ŞO)ü¦‰¥uÌQ÷Ë¶}è”0'®”áb¤¹2v¢¿Ø^Â€O\naR7³RNu1*£´ª¡•u7|sGø`b´<dôb‚ŠÏo©ÌFÊÜ3cç{°©åº°à“õfUæ7TíÉº3eKx \naD&^b¨\"A\0F\n–e!òc†‘Ñy¤\$8ı>ü0ªÊßf•şåªw/ƒEJí#@WöÑ¬*Y[æóH=\$ÑÚKğs+l¢ÔRÓ¦ÈFÍša,xdvHYø(úèABÛ˜!U”Cm¦iäy¨¼6°EO[’=sĞñ%jZûViC¹9	“.VÁï7ÎXc\r¤1†¼T©èÚ¬,¹,¸—;«”…í\"§Í\nĞÓòyÁV10X”+Ø2TÊ9Ìh•®©Â}´b\n%íP¨h8)@‘¦XcµŒôhÖhmØ5.JŸÖH[‚³\nwèùŒµd¹àı+DâÛ>¨úü\$œ\0åE!\\¡|\n(3AL…ÔgL\$Ë•L¦Ú,ù\$\0áS:^QqÓ\"œœÓ=İ[sô‰Ä-PY¾Š·:9È\$Û•n}ÕÌ÷o@Í¿tXıÆaE4x-¥lÕ£h¦I©¹:)™c[©ÜÉ7\"­/A&°å‰,€©‹ÅÓü]:HÎ&®^è›EH<Ä€ÎPŒğŞ‚Ec±Å[|1}†öócãsÃ9bxÄ‰Í8\"Ñ 1ğçÇßrÑtõ§G—FÎ~,¥å]ÛÑw<EH”åÊY‹m‡2º€Öoäó5»¼¤Íe1\n";break;case"es":$h="Â_‘NgF„@s2™Î§#xü%ÌĞpQ8Ş 2œÄyÌÒb6D“lpät0œ£Á¤Æh4âàQY(6˜Xk¹¶\nx’EÌ’)tÂe	Nd)¤\nˆr—Ìbæè¹–2Í\0¡€Äd3\rFÃqÀän4›¡U@Q¼äi3ÚL&È­V®t2›„‰„ç4&›Ì†“1¤Ç)Lç(N\"-»ŞDËŒMçQ Âv‘U#vó±¦BgŒŞâçSÃx½Ì#WÉĞu”ë@­¾æR <ˆfóqÒÓ¸•prƒqß¼än£3t\"O¿B7›À(§Ÿ´™æ¦É%ËvIÁ›ç ¢©ÏU7ê‡{Ñ”å9Mšó	Šü‘9ÍJ¨: íbMğæ;­Ã\"h(-Á\0ÌÏ­Á`@:¡¸Ü0„\n@6/Ì‚ğê.#R¥)°ÊŠ©8â¬4«	 †0¨pØ*\r(â4¡°«Cœ\$É\\.9¹**a—CkìB0Ê—ÃĞ· P„óHÂ“”Ş¯PÊ:F[*ˆ‘ƒú„\nPA¯3:E5B3R­£Î#0&F	@æš¹ksÙ\"%20†âLúw*‰ƒzâ7:\ròTá¸£•XÊ¢pê2¨òÓ+09á(ÈCÊğÓÕDŒCÍP¶¨^uxbPnk4˜eç9©*‰ã”jÄOhÒîˆ#Ç\\W@SË1*rÓB ÊÄÈ+ ŒƒPëmOb(ÜÒ±(Ëi¥‹ÍÈçÕ%?sŒ-25u\r1¢:š2\$	@t&‰¡Ğ¦)C È£h^-Œ8hÂ.B´`Ü<ƒÓHDcKœ\r“2Í¥¬dÖ3Ï Ü¬»Ï³Jç7bíI%HB=\\Ñ‚ ŞŒ#sƒoÈ–R29ŒÃªX6QKHçLÂ3Ş+ÒÓ4Óö0Ü:¯@æ¦™°ÖÉb˜¤#:ƒ²\nò]\0­Kƒ´9\\wªU¢Gmz;Œ©`Ì·\rº™å9u	.X¬iR†T¨¦ø*3ÏŠ5»¥PÃÂ[š“íRò†•àĞÆÁèD¥Aõx×¼!à^0‡É ¦ŒÙ‹Ó2½˜ÃH0šdäcŞÿ@®@Ğn§Lo‚jü¼%PHçÁ¬€à4±pAÎ³½D4ƒ à9‡Ax^;ütiË?+pÎ¯?`ñ:D£p_Ñağ’’¤2S‹Õu“J4’ƒ¢SSî(–¶HĞAö',œâŸ ÊŒ‘%¨Ï#L±ÜDi™?2ÖCADgâ\0îi‰d#gÙÈ\$¥>C3Ì@¬ùç´†ÑKÔ'€&Å_”p©Ü^¡°Ìó<pS™yoÊ0'¾‡ôDQ*  \rè‚\0PRIH „Á‡28Z	(V¬¹8\r!¦!'(–àèF‘ƒÆ\rè¹´@îr‰¡íH¤\\<‚ò.Ş\0„AŒŒ‘rÒpÏºO%4<HÃkû„g'×5~I\"\"0ä•¹‡±ØÒ÷@•;¤\"C«ú6 ’&Y—H„ÓcL`qRä\r	ÀÚå#è‡É¸(PI¨Aá<)…D:¡9#ËØ¶rPÁp KNĞ=t„N	Ñ<Md¶XÂDˆëÔ’DÆPœ#ˆaHR’YlÑÿC4g9z5Õ@\\\0S\n!1À&…È0T‹3|‘ÊBO&)ê ì¨ûE4Ha+<¨mv\0ª>e‰é‚0†{QâHzjhÇØ”RUÌşNá†J–®âV¹éÉ§p{€†˜`+‘-&DİAjh4”¢ã–JZ!4ÑÊ¡„	\nšxU\nƒ‚0ƒ-DÑR™JaEbâì§Õº”GŠ-MW¹u)ÔFš6HVSñ7óÀÚ%S`Ã0y`¤fF+iİI›¨aYh™=†ÚTaL9»\n§òHÄ„^QCÇ)[ÏÄ¤Œ˜e.a¥‹(ø}«Ê‰ ¶Y‘âP­•j<A@‚¨´ª’éA²	ÍÃ†şúSõÑNW:_]YM€/‘Z4D6nÂ(x‹‡»˜€„†,Ì×qKÌ½XTö:U¤êqpÕrTâ‘ø";break;case"et":$h="K0œÄóa”È 5šMÆC)°~\n‹†faÌF0šM†‘\ry9›&!¤Û\n2ˆIIÙ†µ“cf±p(ša5œæ3#t¤ÍœÎ§S‘Ö%9¦±ˆÔpË‚šN‡S\$ÔX\nFC1 Ôl7AGHñ Ò\n7œ&xTŒØ\n*LPÚ| ¨Ôê³jÂ\n)šNfS™Òÿ9àÍf\\U}:¤“RÉ¼ê 4NÒ“q¾Uj;FŒ¦| €é:œ/ÇIIÒÍÃ ³RœË7…Ãí°˜a¨Ã½a©˜±¶†t“áp­Æ÷Aßš¸'#<{ËĞ›Œà¢]§†îa½È	×ÀU7ó§sp€Êr9Zf¤CÆ)2ô¹Ó¤WR•Oèà€cºÒ½Š	êö±jx²¿©Ò2¡nóv)\nZ€Ş£~2§,X÷#j*D(Ò2<pÂß,…â<1E`Pœ:£Ô  Îâ†88#(ìç!jD0´`P„¶Œ#+%ãÖ	èéJAH#Œ£xÚñ‹Rş\"0K’ KKÜ7LÉJSCÜ<5ƒrt7ÎÉ¨™F¢’œ4òr7ÃrL³Á/Š	ƒzØŠ°L%8-ã¬ƒËèjFL¨@Ò9\rC* ƒÃÊÔˆÈè³, ÎA l¥hBxèLĞ2ÀIc\0´ÄkP(\r4úÿ4ƒ²2@PŠ¥nP—#!£¥2¦HMŒ›Ê4zÚ¤ÊI`*”õ@:‡PÂö7#ÈôX\$	Ğš&‡B˜¦*£h\\-8ò.ÉéxÆ’üj6L S*ËÉ©HŞ3ÈÚzÚ=ìÜFÑéqH67Ë€ŞÏ\r¬`òAjÆ1°ƒ˜Ì:‹Å…acL9dãÎŒ½¨UÜâ¡O0ÊaKh7Æ™*¦b˜¤#fĞÙ¥C|TÃ4\0ì´¹@êİ)¬¡·Ãffë%)xÜ°ª4NÌ½(Í5(ÈPÎ8JP9fÃğ!“ˆxßÊ3¡ÏÌÙU»Aà^0‡ØÃ4äolğI<ªj0SÛ³-šÊ‡°RHÊš¦ì+Ş•@’Âì<ú1ÃqĞ:ƒ€æáxïã…É&Ğ9ËHÎÂ„é\nNãp_Åağ’6,¾7œ—)9KípŞƒ´î*p”ªISß’§¿-;Ï_ÜÍ\$ˆ¼çÃ¯ª¨ÛÉHaj­Í‡r4ÌK›îMÌ9%òC1¬N,©––^Ì]#>€Æ¸Ó+ò*Rø n†>\0ÒLƒ™5¥@§—¢ğFP d;ÆŒ¢BJÓ:4dpÓ¬üAÂ€H\n½	¡W\\aR¡HhÀ(!§‚{\0Û±¦3ÁÀĞ#HAĞ»Ç80wvëI²ÒáƒZ»1Ì\":ÂpN™)<%§.w8’ ¦½;„ÔÏiB(Å&èR‚I&XRŒƒ±qÃ¿1ñk­ååÁÔ)›1ƒ’pŞB“P Â˜T±±`–JïÈ£Y\$ÈşÈ'˜#ûTcÊü…ÈW8BØQ%ÄÀÿH9zÖSxp\rÀ˜5Î¤Œf1”=ĞŞşMú4náL(„À@Z„à€#H†Â\"ÛÜX‘lşÉ”¼Ea«ÌGÍ´Ã6‚:-[Y»mÀ(*µù{=›Sl*r%©õB›ÜÙ¦-†„ËI±/\rGš®¥BŠ×j¨lGéĞ9\\qÎJ)i‰„6°ÖLÈáƒŒ4¥Î K>\n¡P#ĞpšÛñ%;DÕí JªÙùj/Èœ¹Ò8dˆÜö¨z€Ï¢,_8iÁä¶à¥¤4jÈôãBşØèêâ8´€ÁR\$E+æ9,X„§©®¦Iø>¥ıF’Fì£*¿\rqèíšbuÂ¡ÁBdÍt•7¼¸‘b¨Ã—HB[fOHœÓâÏOP9gWDè„(æ!0*Y#'G(¸—2Ş‘Xu/•x„ğÒB@";break;case"fa":$h="ÙB¶ğÂ™²†6Pí…›aTÛF6í„ø(J.™„0SeØSÄ›aQ\n’ª\$6ÔMa+XÄ!(A²„„¡¢Ètí^.§2•[\"S¶•-…\\J§ƒÒ)Cfh§›!(iª2o	D6›\n¾sRXÄ¨\0Sm`Û˜¬›k6ÚÑ¶µm­›kvÚá¶¹6Ò	¼C!ZáQ˜dJÉŠ°X¬‘+<NCiWÇQ»Mb\"´ÀÄí*Ì5o#™dìv\\¬Â%ZAôüö#—°g+­…¥>m±c‘ùƒ[—ŸPõvræsö\r¦ZUÍÄs³½/ÒêH´r–Âæ%†)˜NÆ“qŸGXU°+)6\r‡*«’<ª7\rcpŞ;Á\0Ê9Cxä ƒè0ŒCæ2„ Ş2a:#c¨à8APàá	c¼2+d\"ı„‚”™%e’_!ŒyÇ!m›‹*¹TÚ¤%BrÙ ©ò„9«jº²„­S&³%hiTå-%¢ªÇ,:É¤%È@¥5ÉQbü<Ì³^‡&	Ù\\ğªˆzĞÉë\" Ã7‰2”ç¡JŠ&Y¹â Ò9Âd(¡„T7P43CPƒ(ğ:£pæ4ô”RÊHR@Í7Lóx–¤hìn¨²ú–Ë¾©‹;»¦ò¤ÌœÇYIìÒG'¤³2B°%vıT®	^Ÿ\"Ã#ÉO@HKc>¶C“Õ¤;æ»@PH…¡ gl†¬còÉêXÌiN +L!LÂt\n;ú²×ì	rë‰ÚBUKQô€“#±¤¤§¦ó~XÆÑqR¦‹M3¿¶“®°–Ì›\0l—É²ÃÓW;\\†ª%Šß+Ä,—°‰ÄêŸÙVc<€dõF@âJÉû;Ñ°\$	Ğš&‡B˜¦cÎŒ<‹¡hÚ6…£ É~Íƒ\\¥xˆ9ƒc`Ù\$¥¬›«¨<™%I\nìˆæÉæ°Ìm®Ö±VÛ~\"®¬õ#@£ÉK¸ÚFWŠDF(VcúA&ÄPó‘•I+Å[4‡7N{@\\Ö‹.:ÔÔx¾AoLşø£oü\rrp¼=‡Ä´I+õÆ·œzºäB¦)Á\0è7tê‚<×Z(¡ÁwF°ìµ½^†—)–qØY²fïÒ\"%RK©8¥bKšö Ğ0ÀÈÍC´›Ú# Úö@á`@1Ò´˜É„àÂ\rÊ3¡†Ğµ`g€¼0ƒâ¶Ò³FŠy¢ÓnWÑp\r€•w†³^1‘U	@Ø’Ô`XAo¦ ÈA‚Ê™«‡\$)Iá+rÂoT\";~/Íú¿wò tÌğ^â\0./™ô ´Áz‘‰*=H©5*ßĞsÌa}#‚JÈ\n™€pSV\"ê0ØkÇ\0ÎµBB®Ñ„X.NI€§RD[)F…C–:˜6ÄÍX2¾h‰6{HP0†8\0¥A\0w\r!°6\0Ä…‚{áÈ6†UŒC2Ht1†40Ã0u‘¡°7†sÙ\"CHt\rØ4!E%_[ö}áº\0Ø’#j|8lAİzªW.!	€ë,èÁ	¡T—iaº\0œn'qÄ8VJAC/8°š³(–Ù4Öx¦Åˆ\0†¥CpeĞÛğ@i=j3ÉiŞˆPÊCA½KiHä±ÊK©¡â¸´øÅc˜0’ú‚3”¼‰`)®-¦VªLÊÊ8n„s3h•*^eo\n\n\"ÈcL\$É7fõ;\0’FƒÈo¨T4¬d6FÔŠÆ•Séûê†àfA!µòDIÓ&åSºr‘	ÊÉôˆç­2K3EöPÈ[!ÅD´ÚBÇ@Xê£U%	€¨ºXÄR1dÇë‘ôÌI)<au1QÄ”²ÒIØ„s+‡ÑOVró\rŠnlsXı{ZRQ^'L(„Ê¾M–\r(˜äÔç8‚¤Ğƒ‰×Ë*xl›k0¸§%È¼ëŒóÌWÏD€:â ^¼ŒJşÖª“&ßXqöFÔ CV•ë	ã¤lÙÚÅJAù!¢vÅ–,¶»m.9¹%1ßÛÅÍL;nyT’[EÒmn&¬: Ø\nêXia­SG(ØW!x?l²¤`ª0-Ş;œO\r9\$´Æbæ9;şi­-†´÷5W~IÕz=j\$­!,#N/qùX‰ÈíRµDTğºt3§Ô6:§0í}?Õ|•áRÎ)oj¦İªVÉm-u+•x¬òãe›TyUHNJÏ2ûs±¹P'A²M&,l’h+N|bmÆ<¤ÜL¿”ñ¤ÀöPX²Ø¯™‚?z˜V­\"DŒáøJM¸•šLei>ç9š´aU]3¿1«Ì›­íÈ°ÆSxrì9ä¶XEÈ";break;case"fi":$h="O6N†³x€ìa9L#ğP”\\33`¢¡¤Êd7œÎ†ó€ÊiƒÍ&Hé°Ã\$:GNaØÊl4›eğp(¦u:œ&è”²`t:DH´b4o‚Aùà”æBšÅbñ˜Üv?Kš…€¡€Äd3\rFÃqÀät<š\rL5 *Xk:œ§+dìÊnd“©°êj0ÍI§ZA¬Âa\r';e²ó K­jI©Nw}“G¤ø\r,Òk2h«©ØÓ@Æ©(vÃ¥²†a¾p1IõÜİˆ*mMÛqzaÇM¸C^ÂmÅÊv†Èî;¾˜cšã„å‡ƒòù¦èğP‘F±¸´ÀK¶u¶Ò©¸Ön7ç—3‘¼å5\"p&#T@Œ£˜@øˆ’â8>Ğ*V9c»ì2&¯AHõ5ÃPŞ”§aœ¤ÃÔÛ£Xæä¶j’Œ©iã82¡Pcf&®n(Ó@;ÒÔŒšx´#ƒN	Ãªdú€P Ò½0|0³ì@„µ)Ó¸¼\nÑŠã(Ş™‰Ó\"1oÛ:§)c’<ÛŒSûCPÊ<‹¼F¦i¨˜: SˆÙ¯##Nû\r1´'GI)¥èÂÛ¼ãHäÀ£ ê		cdÈæ<µÃ]H(.âîÄ\n£¬F¡¢ÊÊ†Œxì:!-Z”Õì@Ö<¹Œr>¨\\uøcJ5[ÏÓÉc”&CÍ<õUŠPóp‘&Ct|2Ub²XÓº©°[#T˜¶\rÊØÉBÓr±#Mœ2 LMÈ1Á*%r\rfmp(4¢5Ãeç8¨È]XŞå Ñ|ßj Ó\\8<àÀPÜõR‚@t&‰¡Ğ¦)C€à8¡p¶;e°º[Iûü”1dº –3Éƒ¸¨‰4\\šŠ	b]Q´{aIê3v4X@6©‰J<8-Š`Üä£sE©Dn’Ø÷Sí‚‚äSiÒĞ-`@¤£ìêql<Zue§²í2¸/Êeƒ±Zjy¨\rÚËªš¶±­4h“Ôì3E!1cÎÍM={VØ4íÔşïCUk‘­nÉæñ­ïyer¦k²x!ŠbŒ ï‡ÁÇ…^Tö…4O4æ^rj*Ïc=Çl}TS«£C¨Ò¨\\DÓeLŒá\0‚2sëÔ1Î‰æˆèĞ9£0z)Á|Œ6ê Ü3‡xÂ&¢O›À ¨8Ü¹\\Y4NY°©„ÛÉ›Á0Gõ8‡ ZÔL7…]¦sRHI‰ı‚Õò‚Îú_Xh(À9ƒ ^Ã¼)ÄîŸsìÁyw†)Á9’˜ß`sÁQšRı_ºm©p7§â\$]Êe4\r’%*u2¦Ã±lDO<?¥BFÊ\nE%aZC¦)É”\"‹”ÆQ\n` î`6\0ÄArOT„‘xÊ ja\0‡0Ì_A{èf5‡@ĞPã\$&@€1¾…°àZhlN¦>@˜t>nÕ1Ê	¦Æ4ğPQ  \n (!É,ˆ\"™â\0 §“4V#‚ùPk˜Rd[	¨CjÁ–3½‚†AC‘s”3Çdƒ¢1h\rÆS˜|H¹5\nÎxÃÍ: r„©‡D\"]Ê'Bk7¤ÎLCius¦/—CT®\r;v¡,şv¤B±M¤Ô%ÂX¸G]¹ÙCÈyp+éí=ÂìNjeõš±IAÑ¯NË¹§Q2rH€O\naP³	Ø['sµ\nˆÛæ`GPÃk§ê2‡)òGS!\rÁ˜4†rrH¤D*eŸ²ÂE@	=4£Ï 0¢áE*‘¤#@ bjFø ÄR:ugïS\r—“^JJŠ©OÄğ°BˆNëI­n‡ÏÃ\\¥j©èšÊŞğ8o\r	ùæ’çP•R@\$%Ø+	(ê¨®KÀê—yr—C`+6ğ‘±Ùñ>[0è‰\0ÅDMTÑÚ7¡%`Ì…P¨ëÁÄC0…\rªÀA0¤ò]Ï	XªÙ„kªí*&À¿bA>M9B äüÄ3Db	aw®Ä¢`ë—‚E8fÃ¨\$(j®ÙÅ0èp£#]hMa´ŠœõºkMÓ±ú\$®./ŸûäbjI)QdÙ‡©3MYU)EâÛi…om½u1Ì¶ä¤P–Êeİšs@…C	\$\$p¥æ¼Ø¢Chl@PRÁE¶ç5\$xÈƒIl";break;case"fr":$h="ÃE§1iØŞu9ˆfS‘ĞÂi7\n¢‘\0ü%ÌÂ˜(’m8Îg3IˆØeæ™¾IÄcIŒĞi†DÃ‚i6L¦Ä°Ã22@æsY¼2:JeS™\ntL”M&Óƒ‚  ˆPs±†LeCˆÈf4†ãÈ(ìi¤‚¥Æ“<B\n LgSt¢gMæCLÒ7Øj“–?ƒ7Y3™ÔÙ:NŠĞxI¸Na;OB†'„™,f“¤&Bu®›L§K¡†  õØ^ó\rf“Îˆ¦ì­ôç½9¹g!uz¢c7›‘¬Ã'Œíöz\\Î®îÁ‘Éåk§ÚnñóM<ü®ëµÒ3Œ0¾ŒğÜ3» Pªí›*ÃXÜ7ìÊ±º€Pˆ0°írP2\rêT¨³£‚B†µpæ;¥Ã#D2ªNÕ°\$®;	©C(ğ2#K²„ªŠº²¦+ŠòŠç­\0P†4&\\Â£¢ ò8)Qj€ùÂ‘C¢'\rãhÄÊ£°šëD¬2Bü4Ë€P¤Î£êìœ²É¬IÄ%*,á¨%ÊğÜä*hLû=ÆÑÂIªïš˜dKÁ+@Qpç*·\0S¨©1\nG20#¤Äí1©¬)>í>í«U²Ö!Š\níL’ÀêÔ&62o°è‹Œ“àÆ€HK^õûv ãH¾ j„ ÍC*l†Zî‹L–CòøŞa— P¨9+‰ÚXÚS•ıH\nu½¬ğÌ+¢!¸w Ê6BS ¦:MØ(\r&P…¡.Â¼h0òÇØat‘Œ#:PÎŒœı…2au…^áô%A;U±R:bÃ(İŒ#št¡àóûî\$	Ğš&‡B˜¦\rCP^6¡x¶0èºÀ?*b`Ø%.ÈÜÉáû¢Ñ¡±UEÌ)s^¾0©Ğ¦†54¨ˆÉ»ŒmuÜcxà©!ZVÇäI²¦ab½ˆam[~AuœÚ:¥##=câl»=3°°ª.Ù°\ryRîH'ºÖÎòÔÍÛîÿ†¼\nƒx×“¦)Ï:Ë©.¨­EMS5“aZ:²—\r¬òÊ§LfƒM\0CqIJ3O¨B 3„ÉÎŞ[–Â’)*èx¨Ì„J DCû¶ÿ‡xÂk\\•I!F™¹k½‹Vƒj3u=“UïËïqöÔÁ(5ªlÔlûLØ©:¯]0½§¸\ràp`è‚ğïÁpayä@œ’àÎÙ4 Fì™C†à^÷C˜>#áÁ\\\n•tjŸ+ç&\$ô6§G¦SØa&†eL“#*”U­ùü\"tRP]‘û;f¥ æú”CÄbk©U‡tTBO 9¥{ˆ]3¡‚0Ìg‰ˆo/¦f+)â|˜ˆàa7D(Ê”•@QÙQÒ„håU–Æ¬Ô€0HÌ©ø÷	HHP	@T<K™#!  ªCLWÌ`s\$!¸’œ”ŒÚ—Qÿ'Á¼Ö.BîIØ’½[¤\$ù·ˆJ\n¨šA?u@ªWƒmq¡Õ¦?ä–Œ«(„°:†ÖĞ{‰O9ä¤ÉÀ3%¯ˆè®‡PÏÊê=]¤?CJiÍI«€l\\7‡–,qRù•2ñ©£@àŠHKÎz1¹v¬LÕk²	ˆ¤PˆÒ›€ \n<)…B|XÛ8gMø¤² @šÅHdÈ6Ò\$+I^4ƒÍY®ş(¡=uiY´'°Èßy=l\$Ñ\0P¹r¦dPP4FÖGe#ƒ`oƒDÀÂ\nHŠY[&L(„ÄBWB0T‘‡š\"”¾ŒVä&&wÊÒeÃ“]B!0«urş +\"’25.Hk‰İ]0µ]V**_ùŒ&Œf´Õè\\ş!ÍbbÄBgÀ’tÃkµmbŒ‹Ó¨XËdU±ü2£[ëˆe\$è!– Ø\nÃnÈÎ•Ù	HÍÅ5´4VÈ˜ê¶RŠÑMFÄ7†“RÈFS˜,˜ìC8Ÿ\0U\nƒŠş¯P(g0µºÂW\n¢CeíŠ¸)1>[ŠX	mÈ’Dê’\"HTÌÏ\$ñQ±#\n- LUrTKÀ[aRÍ›>áI{ª£\"¬5â@êJŠ„\néñT\$0Z#saí1\n7i~Ğ!C“=a±¨©—ÂÒä’FI\$2«¥ÿ?o)“ŒÊ¦£8g~;l2à5€Ër±1]µ­wªL A@s)œ¯(ô·L}Õ%çFö-•²æyJ0æÁqH™Š@PV(ôÖ•ÛÌ~‘h";break;case"gl":$h="E9jÌÊg:œãğP”\\33AADãy¸@ÃTˆó™¤Äl2ˆ\r&ØÙÈèa9\râ1¤Æh2šaBàQ<A'6˜XkY¶x‘ÊÌ’l¾c\nNFÓIĞÒd•Æ1\0”æBšM¨³	”¬İh,Ğ@\nFC1 Ôl7AF#‚º\n7œ4uÖ&e7B\rÆƒŞb7˜f„S%6P\n\$› ×£•ÿÃ]EFS™ÔÙ'¨M\"‘c¦r5z;däjQ…0˜Î‡[©¤õ(°Àp°% Â\n#Ê˜ş	Ë‡)ƒA`çY•‡'7T8N6âBiÉR¹°hGcKÀáz&ğQ\nòrÇ“;ùTç*›uó¼Z•\n9M†=Ó’¨4Êøè‚£‚Kæ9ëÈÈš\nÊX0Ğêä¬\nákğÒ²CI†Y²J¨æ¬¥‰r¸¤*Ä4¬‰ †0¨mø¨4£pê†–Ê{Z‰\\.ê\r/ œÌ\rªR8?i:Â\rË~!;	DŠ\nC*†(ß\$ƒ‘†V·â\$`0£é\n¬•%,ĞDÓdâ±Dê+OSt9Lbš¼Otˆòh¬ÃJ£`BÃ+dÇŠ\nRsFŒjP@1¢´sA#\rğªÂI#pèò£ @1-(RÔõK8# R¾7A j„p¼°¸ÆÇ¢ª¢\r¦®4ÜÊ‰“˜ïˆ#ÇD€P¦2¤tŠ¾²¢*rÕIƒ( ³µÈ ŒƒÄ3QÏ‚(ÜÔ±õ`Ëm‹\rÖ4Æƒx]UÔ×xÂÕC¬Ø¨OÏ)B@	¢ht)Š`PÈ2ãhÚ‹c,0‹¶•©GYè«páİ\0S>Ê´i»MLQªGZZc“R¨2´Š^Ü ÈîWn§(íë»ÌĞ©¤9D_•…‰EŸ*B¯ÓÌ«S)ƒpëQ\"%õ`4AŸªšUh¹íE¤è˜•éÕf£©Éb Ş5éÂ¦)Ú0ì‘ğ\\][¹Zª›:U?j –/#k=+^ÀVe(ÂéšÚ¶P‹•*Fš\nŒ#åŒĞ²:À„&¢¥h¹B:¡¥!ã\n43c0z*Á|¨/ªsã}Fƒ­0:„›9Êè©,'\n¥-*áì»<Q”PıêÓ»|x×ã'„7»ß](v=˜Ğ:ƒ€æáxï÷…Ñ§Nü¯#8^À~ğû;\rÁhÁğI\$Š¤;Ç|J>*Ã¦´zš•H%\$¥&|YVúrŒ­PÄÓŒá'%&1£‡á0x¦Ék‚\0îj—Œ‚„¥¥§Š)ÈxJU†c<g;¸¦†‚o\nzIRæl¡ª%èÃ%Dy:¹R&zĞÉ„*h**?·*‡B€H\n7 tiAV&äŞ4`FÉÙ\$ÈŠ©GtÉ¹+ ÕxlÙâ@O6\$î–‘”L0=}¡ĞPÜaaïK¨cĞõƒdk;\rÜP·–\0bÃÃÏ)æ¯\$„•IùAlªü’#õ\$SQò'D”†d(„ƒuT&•E¦Ù‹ş^…~›¢’S–{+hD’·Lv³>™AÁGE¨BaC„©/©1ÂÆ\0Â£@g+ÑÃ†sÑ3%’Y{ÆİÁÅ¶%%Ì»rQ¸ÍÂÀì†Ú	%¤ ôL”I/\\po(ph:ÂRR†QIF+ €)…˜Ùg1â&á„œ“²VßŒ(F\n‘ŒëÊÒL]ZTÌM—¨\0ŠŞZ‹à9-¢.\"hhi(´ªf©õŞÏœi‘2iÈÀ†7.ÃyV&‹º–ª8n¦—ª÷¨”İq!ĞÂªDŸQi„6°ÆŞCdFnOt‚J`z.9ô²Jâ˜q¤†k’•0cJ*õ’¤X*…@ŒAÁ\rTÄ´6RGJ¯fª.WòòhQ¢*\$eÇ\"BA–«[ÃÓ©…p%Æ>©Y˜ÑÒÂÔ6'a>%£eOtóo!œ0‡©”U-4ş\"Õ†Óâ›K  «Ååà+XJIğ¡F¹%£;|xP›FüÌòƒhLéŸ®Jb†UG^‘M}_e1«#‚A[	ô<Fc+\0¯2½jü”²ZÓá¾OPÃÙpaâ3\rÅ‡ ";break;case"he":$h="×J5Ò\rtè‚×U@ Éºa®•k¥Çà¡(¸ffÁPº‰®œƒª Ğ<=¯RÁ”\rtÛ]S€FÒRdœ~kÉT-tË^q ¦`Òz\0§2nI&”A¨-yZV\r%ÏS ¡`(`1ÆƒQ°Üp9ª'“˜ÜâKµ&cu4ü£ÄQ¸õª š§K*u\rÎ×u—I¯ĞŒ4÷ MHã–©|õ’œBjsŒ¼Â=5–â.ó¤-ËóuF¦}ŠƒD 3‰~G=¬“`1:µFÆ9´kí¨˜)\\÷‰ˆN5ºô½³¤˜Ç%ğ (ªn5›çsp€Êr9ÎBàQÂt0˜Œ'3(€Èo2œÄ£¤dêp8x¾§YÌîñ\"O¤©{Jé!\ryR… îi&›£ˆJ º\nÒ”'*®”Ã*Ê¶¢-Â Ó¯HÚvˆ&j¸\nÔA\n7t®.|—£Ä¢6†'©\\h-,JökÅ(;’†Æ)ˆˆ4oHØö©aÄï\rÒt ùJrˆÊ<ƒ(Ü9#|¿2‹[W!£Ëƒ‚× ±[¨—DËZvœGPŒB†1r„¹³Â†k”Íz{	1†»¡“48£\$„ÆM\n6 A b„0£nk TÇl9-ğıÃ°)šğºJaÀnk–š¢€D­¡Ò6ª±\$‚6’¡”,×Ğ3T+S%é.ŠQÈâ šÕÉ¯Z U½FÁÙ1	*¥¨òö\$	Ğš&‡B˜¦cÍÔ<‹¡hÚ6…£ ÉPÖITˆ8°øä:\rŒ{&…H“\"û\\µOPJV„”èÚz½5‚zšÅIZw‡°lê[|§p:V–Û\$¨X©0x ÕtF É­K!ä	´¡ˆs›iai5òNälM”»\$ÎBƒ%è\"ÀÏs¼D„2T\n@¹³­šÀğ4…!ahÂ2\r£HÜïä‘ö‰¢x0„@ä2ŒÁèD¥„Aò`„±dèxŒ!ô„Í­:pÄ (\rZÒg¨Å;O¸‹“Î.3_i6h:v‡7´4ˆ…lûN×¶„C@è:˜t…ã¿Lkzî¾ñ¼C8_/uòä½0LA~Ş9îZJJÄP‰ÙG»ï9NdœasÿÜä–“O¤~' [P˜pií¯ç0P:¥ø0¨4=£Æ:L.èî4ƒ`@1=£ƒ¾3<ChËG#4º9>ÃÆøc0êúƒ`oíx>pè=©5ù\0ÆÚÃ\"^|„64]3½âŒ×Û… \n (\0PRÁI¦Tì!¦&¾øÚğg!¼\0äC³è¡ùÃSô|’aó\rçÖ\n@îüĞ‡I©¤¸”òØÉ™CÅl5¼ŸÉÂ0r¤—­G kËR<È0† RV›2 dˆ¥˜dÚPLg[,İFg˜B\\kÍ€/ólOIkeOäî(¸£šH,*N¤áçŠ\"LÖ¢×‘‘¥Š³â\"ÖB€O\naR1‘ÂJCŒDky&`µ­\$­L”nr4X@lm0jk˜ò:«ÚbX%­6‰Z‚¤%\$ÄKE‡mŒ²	M©ĞÄ°ƒ‰ê‰0dàæ°×¨’f“*0Lk¨„/)Æ¹§10€´äB™c–Qòp÷¶ÉÍ%/Œ9> VŸÎi=P+HÔümÌY¶/¬å—ÆdSÚ2xÅ¬ÎÆYJM\0u˜ƒ…˜ØÓQc0Ë/BÖÂ‘£(‹Ù˜”J\r@SŒ®2G@¿˜Ìb¥¥¨!7 ´ZÚ+Š(©\$–½£‘ %êñiJ\"9@ÍÑ#Æ!œ¯‰ØÆL#–FD8ˆTºjÄ™†VDšnÕ®ÒH‚™%îtÓ”ò®ÕŠIŠ„¼–8Ã”®qN¹jm\$å2¤IB×´ëY‰2CŸ.,H€";break;case"hu":$h="B4†ó˜€Äe7Œ£ğP”\\33\r¬5	ÌŞd8NF0Q8Êm¦C|€Ìe6kiL Ò 0ˆÑCT¤\\\n ÄŒ'ƒLMBl4Áfj¬MRr2X)\no9¡ÍD©±†©:OF“\\Ü@\nFC1 Ôl7AL5å æ\nL”“LtÒn1ÁeJ°Ã7)£F³)Î\n!aOL5ÑÊíx‚›L¦sT¢ÃV\r–*DAq2QÇ™¹dŞu'c-LŞ 8'cI³'…ëÎ§!†³!4Pd&é–nM„J•6şA»•«ÁpØ<W>do6N›è¡ÌÂ\næõº\"a«}Åc1Å=]ÜÎ\n*JÎUn\\tó(;‰1º(6B¨Ü5Ãxî73ãä7I¸ˆß8ãZ’7*”9·c„¥àæ;Áƒ\"nı¿¯ûÌ˜ĞR¥ £XÒ¬L«çŠzdš\rè¬«jèÀ¥mcŞ#%\rTJŸ˜eš^•£€ê·ÈÚˆ¢D<cHÈÎ±º(Ù-âCÿ\$Mğ#Œ©*’Ù;â\"‚â6Ñ`A3ãtàÖ©“˜å9£Â²7cHß@&âb‚íÇìäÂFräˆ6HÃÓı\$`P””0ÒK”*ãƒ¢£kèÂCĞ@9\"’™†M\rI\n®¬À(Èƒ&ƒ YVŠ%m\\U¨û­ğ(ÁpHXÁˆ%®#?^”#ĞìGğ`Ä˜©ræÅ¾£\\«#£Àb–-cmq	m›şş Ní@£jQãÉM>6ˆÎ<B¼‰óGe­ƒeîú×-áyG)@×‚Œ`][ÖxUâÚ³ãf^`Ø–(ÏáxÆˆb@PÚ‚\\RL’€t6ÊbØó™\"è\\6…Ã#à0NØØ’IKÓ5ãZ7ŒÃ2€…0SXÇ]/¥<úŠƒ{_x´a\0ë@£ÆÂc0ëçã:î9…‰ä<¦=å.ê]f6®ãª²aJna‘#ì«´u‚b˜¤#&Õ‚3	Qf^!Y¼£’b0Ô×#æ0ÃQ¬~®Y¡]©:)¸¨Õ@jé'½Á\0‚Ğ®èÖÒ1Ğt\nç=‡‰ˆĞ¤ÁèD¦AòI;pxŒ!ó­c\$…)M°Õ/›K*Û9Õ%Lƒ¼…ĞÕË8ïä`ØCÑ\0åŠ€Ò¤DArÔ÷ğĞ:ƒ€æáxïı…×¶èBjà¼„@DüB\nƒîü9ƒà’C¶yáÑã¼”ädŒÑ7\$èÂ^lÓX9(Ø6¼ÇœB\nHe@¨7†À ƒr+!œ¹s²Vc¢%\r„àÒq›&â¨0@Íª9{„d9dd•˜aÏ5æÀØ› olÈ\"\$£€kNñ’öÒC`s&á8»——D‹ÈÒ2]§Ö6>¾ØÉWZFpÏ¶NÛˆô@\$ŞŒ#‘Ö1‡2>MÂƒ!QÖ3`l¡¶†ŠÍ\r3Ò\np±0\rŒü;—&öß[ø©p&Y/c|Ññ9^\$ğŸ\"VŒê™JA¼¥)ÂV_hNH\$¡¹™3>`Œ tH°›„’\"M8 ‰h×!r¬ÌÑÂ)Ä:˜R”Y uïüEôÙü8	ÃGLcÉ\rdÂA„ğ¦	½€…Â,álÌ!ÎqESJâ”QŠAÊz €;ğ…²æŠ)ÈƒŸò¬fNëh‘Œ0 ƒvÏ×´ôA¤3‚\0¦Ba26¦´ÚŒ\$5VdöN”¨?8	( ‘Íø#jJp¶U±’“š~gAYÆe’§šzÉ¡¤İ\\Tøô]ÊËôbuUWÔ\n®sŠJ5cõX£ÕŠÃ\$¡ós 4†9ç‰\r\r“v\r²y¦›b/&á•‘\$Rãq\n¡P#Ğp]¤Ó\rÁª+2,é¢?õMØø=,‘?²ŠâËY{dËù#ä„‘Ó”\\ßÉúì;púz²ú•\r5à’W@B\\\nJpP†0Ò¦š‹:§év)6\r=.\nŒdàĞĞè·ŒY—¦	G£•<È˜³\$•,½¬áB´ÃÒ…\rô…“”‰¤„\0PL¼v(÷ƒz€±ØYÊTa‰`ætÈ) 4Gj¿»ºwìâ²¸\0³-’Ë*ÂÍ‡¥@úPØ\nôÕ1‘U–³O1µË€5­pÜ|¡};á<Ã3ğàZïµø§J*åğÊ";break;case"id":$h="A7\"É„Öi7ÁBQpÌÌ 9‚Š†˜¬A8N‚i”Üg:ÇÌæ@€Äe9Ì'1p(„e9˜NRiD¨ç0Çâæ“Iê*70#d@%9¥²ùL¬@tŠA¨P)l´`1ÆƒQ°Üp9Íç3||+6bUµt0ÉÍ’Òœ†¡f)šNf“…×©ÀÌS+Ô´²o:ˆ\r±”@n7ˆ#IØÒl2™æü‰Ôá:c†‹Õ>ã˜ºM±“p*ó«œÅö4Sq¨ë›7hAŸ]ªÖl¨7»İ÷c'Êöû£»½'¬D…\$•óHò4äU7òz äo9KH‘«Œ¯d7æò³xáèÆNg3¿ È–ºC“¦\$sºáŒ**J˜ŒHÊ5mÜ½¨éb\\š©Ïª’­Ë èÊ,ÂR<ÒğÏ¹¨\0Î•\"IÌO¸A\0îƒA©rÂBS»Â8Ê7£°úÔ\"/M;¤@@HĞ¬’™É(ñ	/k,,õŒË€ä£ Ò:=\0P¡Erµ	©Xê5SKê‹D£Úœ£Òàİ!\$Éê…Œ‰4¾æ)€ÈA b„Bq/#‰Êê5¢¨äÛ¯Îºàˆ¢h12ãHĞ×£Ê6O[)£ ëT	ƒV4ÀMh—Z5Sâ!RÔé äÅ¯cbvƒ²ƒjZñº\"@t&‰¡Ğ¦)BØói\"èZ6¡hÈ2TJJĞ9£d>0ìJdÇ\rã0Ì´Ã*è”1²Ø—S©’\$7²3›t\$/¨Æ1¦˜ÍW„`Ş3¡˜X§CÊ„‘¡\"Ï£jÛŒ¡@æ¥¢ Ş5£Á\0†)ŠB2¶\"	 \\Vö-øÚá\0Ìô\rµ}h¥¥.deêô¢L[Â›æi›ªŞ„É‹]£–1ÊÈ¢PˆÑSÁèD¤Aóá.ã8xŒ!õß\n1cõ…Ø0=#7à£–ÍÍ\nfı?ô–< Êÿêš¶±­\r è8aĞ^üh\\¡é‰@\\ôáz=ËJhôª7úØæ	-[0Ü›Ë'H#@ß>ÌA‰?)EôTÖ¤n`4±SÒo\r#6:41ÃÆ¨,±“/a\$ì’Q¢£³èÃ,êwö\0ıàv\r„(#¼¾’´lrb„L2vƒL°„©Ş*İ.}Ü×x(	‚pKÕs”NAH,ùEYWkÇi´É™S.f[ù’?ÜÒŸ2„0woä´ ¡6üJ‘1\rÑV”c0Ú–øu\r¨()rœœĞª…Oí˜¥âzOÉË+@(\rÖP©-	\$<<˜‚vŸ`°s#Î°ÒuLC©0#a˜ó†Ö’ÒÈCS|%1°h”Sâi’nK¹TÀ@xS\n…<”V|M	‰éeŠ•;ÅÀP‹‰N\$8“µLÊ,A¸3’@€¡H0Ñ1›<ÁŠBOÌÄ)…˜Ì x 2Ä#GôNSéÀ?Á™ER ¼’vO!,\$¼bÎ£ìNæQ_JÒwÓĞi%¡Y†”‘+	[;KÇ¾ZÅ\\½É£Å/Ôj\r€®.†ÆEIÈ&(™Â8êŞKä´#I–j„I£(!T*`Z&KPKÄ~c§Óe	¼ÀX\$îQ4\0Ü‘bËxÓ\$Û80yFåR’•<ÁGÕ;¶¢“RE]ÑTxPK²k#ˆ˜:˜2JŒ¸aw„\"]\0 ˜äˆm=¼öRêa<ÍñÒ(«è7biØS^“=Ş¬u=ËÑ®Tá•ã·ğ?Ôñ~}¡Ìû¥·CUTi„6EÀÙSº\n©Ñm:óàïÒ`@‘s";break;case"it":$h="S4˜Î§#xü%ÌÂ˜(†a9@L&Ó)¸èo¦Á˜Òl2ˆ\rÆóp‚\"u9˜Í1qp(˜aŒšb†ã™¦I!6˜NsYÌf7ÈXj\0”æB–’c‘éŠH 2ÍNgC,¶Z0Œ†cA¨Øn8‚ÇS|\\oˆ™Í&ã€NŒ&(Ü‚ZM7™\r1ã„Išb2“M¾¢s:Û\$Æ“9†ZY7Dƒ	ÚC#\"'j	¢ ‹ˆ§!†© 4NzØS¶¯ÛfÊ  1É–³®Ïc0ÚÎx-T«E%¶ šü­¬Î\n\"›&V»ñ3½Nwâ©¸×#;ÉpPC”´‰¦¹Î¤&C~~Ft†hÎÂts;Ú’ŞÔÃ˜#Cbš¨ª‰¢l7\r*(æ¤©j\n ©4ëQ†P%¢›”ç\r(*\r#„#ĞCvŒ­£`N:Àª¢Ş:¢ˆˆó®MºĞ¿N¤\\)±P2è¤.¿SZ¨ÁĞ¨-ƒ›\"Èò(Ê<@©ªI¥ÍTT\"¯H¸äìÅ0Ğ û¿#È1B*İ¯£Ô\r	ƒzÔ’r7LğĞœ²ÈÂ62¦k0J2òª3ıAª PóD¤`PH…á gH†(s¾¬ëÜ8°ĞŸ1:’¨Ú•ÃBÔ›µóİN¶:jrÅëğ3³Ã¢Ì ÀC+İ¯ãs8¿PÃ-\\0£á×_®Au@XUz9c-2ª(Òv7B@	¢ht)Š`PÈ2ãhÚ‹cÍÔ<‹ P¬Õ7®ô=@\r3\n69@S É\"	Ş3Î”é\n°L´¶\"°ØŞŒNcËÄc3¨àÙ78Ac@9aÃµØÉ-\rQÓ0P9…)h¨7h¨@!ŠbŒ§\$­“¤öÁqh&b`ˆŒmLÇ;,\$b2àÈèŞÆ-ÊKˆbV¾TÊ;ÍXÍ#¥p@ Œ™#iÉª49â`4Z@z(Á|ö-ØÜ3‡xÂ`‰ÜÖ†/£\$P0ãCÌ‹\"C’j˜¤SÀŞ»§J¦Èû's\r˜<CÛK÷²ìûHÍµ°à9‡Ax^;ôu«¯<«@Î¢½d ŠÊCp_¶ağ’6	ûºîğPA\rËA†9mŒúÎCè‹%¢bBáïI\$>2Ï,ÃÁ\$+š>•ÚZŸ²1·jxî£‹£2Ájã’)@#7øâ8*bóxAñƒCQç¢iÆå“:Ñ\r‰Q„%‚Ipm'\rÂbvÉò¹Ağé\0 ñÌ9#N\n\n0)&!Ìù €ÄPIhC\$‰Ñğ5£BfƒIœ\$y@AÀèjÍQN>”7‡pÊ~Èt\0\rÉ¨¶À‚ÍƒIeD\r ’úîK9\n™RĞöQbg_¨(¤°òdIŠ€=ä0Š¨ó[Jœ@„t‚Ö¶×K\\T,¸1±s†j!Éö3Ñ,7ÄÔHˆÕü	áL*3¥HiXÑı‘‡ŸbÛ>&-¥[C‰!ä0ª´ˆ•Ù¸yF‰Ü†õª	„'à€)…˜P\nlÁR¼¥\0L¡³Çˆö2&KNŠ|Léèé2CLâÎƒº˜r¡Z`äÜfDÁO¡½\"œ#ˆKù0lV†Â•\"Y“(‹8°RŒYˆ_Ü%9ÀÈJ,ã˜N–„eˆËÎPlqÔ€†³âqÁ6Šï²Òò^Ü+¨86’ƒàù™\0U\nƒ„nKÓs%ª´“	p}BÊ£†1¬gqH\n£\$zÉ\"ä]0&,”¢ä‹ÁzÁåqXÊ@R8gÊ¬ÂĞjtDš-bÅ®Tj_h#¿ åò-Æ¢¦F(iy²™@PiiiºmZ§8%ôŞ_¦á2/ÆÇ‰·:Óò€£«,Å†t2ªIà‡ä9‹ªÆ\r«]'ƒ¥ø!©zd]I\r/±l¹—Rı!ë²§5<˜4µlÀ";break;case"ja":$h="åW'İ\nc—ƒ/ É˜2-Ş¼O‚„¢á™˜@çS¤N4UÆ‚PÇÔ‘Å\\}%QGqÈB\r[^G0e<	ƒ&ãé0S™8€r©&±Øü…#AÉPKY}t œÈQº\$‚›Iƒ+ÜªÔÃ•8¨ƒB0¤é<†Ìh5\rÇSRº9P¨:¢aKI ĞT\n\n>ŠœYgn4\nê·T:Shiê1zR‚ xL&ˆ±Îg`¢É¼ê 4NÆQ¸Ş 8'cI°Êg2œÄMyÔàd05‡CA§tt0˜¶ÂàS‘~­¦9¼ş†¦s­“=”×O¡\\‡£İõë• õF“qò‰E:S*LÒ¡\0èU'¹«Õû(TB¨Ü5µÃ¸Ü£ä7N`ˆà¹#æÖƒ{rÖã @9·Ã„\ræ;Áƒ#˜ƒˆ14°„ZWÄYBr—…©ÌT Dz“âQºè1ƒ2<@Š€æª#Ê²Á\$aÌK¥\$	Vè«ËÄ“)é,C«d¹ÊDê¡L¿E²`€G9|Tœ¤ñ’¥„Â’å)ÌL±Èá «±Tª&äVA‘á_4+S’6AùT\$4B8UN3˜ˆã9-´”A@İNµŠ@9Sã(ğá\rÃ˜Ò7Õ±=—(áG¬È3M±ÊHª¡#ZQKùDª‰yX*åšzXáÎME2²9gZyi%\ns“et_“‡1H\"C A?*õ¸òÜMp!pHßAªzR‡9hQ9¥Ùvs„}i¼‘¶B/\$Y+tGI\\ÄSõJYEZò[•Ç)]…Òğt –ŠsåÙÈ]“äš£)Ò@.qCvİä+‡)D–w—é¶Ğéh‰ÎG—ÒÌ_)ÏSâ{>S#Ğ¶<ìÈº\r£h\\2Š¥w†£õøØ:M#L#“X7ŒÃ0Øö±:—e]–Ú?n¥\$Ï‡Šƒ{^6Œ#pòµhê1ŒmÈæ3£`@6\rã;Ø9…ØåÇŒ#8Âö@Kw\r¯`êá˜Ræ…Ás²Ub˜¤#VÔb8Y±„ÊCº>|ë39!2)#âœ”#ü=n*50t3T#­\\ö„ÉÖĞOB1ÖpÉ„àÂÔnÃ0z*!}\nÔc£ØÁà/ ù¿²TGÅ¹(o@£8'ÏLjìASõ–éH‚]rG˜óƒÒz€(&¡#„ªsDh•€à[²&~/Ì4?Wî tÌğ^â\0./¾ ÔÁxe\rÑ%UÄ¥\\¬{ø`ø\$†ĞàmƒlJ©ø²qzî7€Æ³XQ	q¤7HÄ	p,“áy•ªÚip\"\$dPá¬!ÿ+\0@Í«šF°8 —À¢Êî!š¡·&åaS˜sNqÏ yq\rØh5Ì0Å@áŒZ\r!„63˜ŒQš5Fèå¥gd,Äğ(€ ÔÑ’4FÈàt#¢\"\n‰&rØA@eğD)™â±\$Óó–Ìº4a\rX>™ÿÍÙ¯6&ÌÚ›pÊ»ğr†èã!„5+àwœîÑÛ;‡t¤ÉsƒZ%äW&ÔŞ9Dx¯˜²ÔUâ€P™²¼d\$Ès'RL:± Q-0±	÷Š©‰0åD A-’ÅŒ~I’,[˜d\r+¸×!¤&£Å7MØ8‡Sr†ƒ2\r¯–\">•Pq\"T§sˆNPÎÔBn`P	áL*ÆÖLUñƒ(\$Ô@“qCK§&~GÊbOBêŒ‹ ‘ŞH¸@ˆµ>:@­M”f„UT…ë½!zqüÒšpÆã\\„W\rñ\rº\0ÄC8 \naD&\0Í9A´~a*éLLVCî¦œS¤6‚MZ\rc+‰r.a\$‡)ğ>D¥–J+h×å¢lZa,´-kÌ\"%EpÛL\$‡1–32×kv»­µ¶÷İ\0 †Ü`+mì1†µ@ß˜v•”ÚpÆHÂC30#Y\0ÚøÔ‹u(*…@ŒAÂ¢}”¨öœÇVÙ&Z\$pN¬ª&X®(\"\$p¿6Á`JÅ§cLqBlbeÜ\$»÷…Œ‰—’( éÂˆçáÎd‘”Rï¨»O‡Ì‰“!d}9„ËëbB\0+D7şU[lRôŸqjc‹Ğ¨ÇÂ@s	á8ĞÙé¦ÚBNu¢çÎZD|°,L­DıÀÊŞıå›üÚªôu`	*Ö¤çVdFn†‹7UÈ4y;€É€";break;case"ko":$h="ìE©©dHÚ•L@¥’ØŠZºÑh‡Rå?	EÃ30Ø´D¨Äc±:¼“!#Ét+­Bœu¤Ódª‚<ˆLJĞĞøŒN\$¤H¤’iBvrìZÌˆ2Xê\\,S™\n…%“É–‘å\nÑØVAá*zc±*ŠD‘ú°0Œ†cA¨Øn8È¡´R`ìM¤iëóµXZ:×	JÔêÓ>€Ğ]¨åÃ±N‘¿ —µô,Š	v%çqU°Y7Dƒ	ØÊ 7Ä‘¤ìi6LæS˜€é²:œ†¦¼èh4ïN†æ‚ìP +ê[ÿG§bu,æİ”#±êô“Ê^ÇhA?“IRéòÙ(êX E=i¤ÜgÌ«z	Ëú[*KŒÉXvEH*Ã[b;Á\0Ê9Cxä ˆ#˜0mxÈ7·€Ş:›‚8BQ\0ác¼\$22KÙ„¨È12Jºa X/…*RP\n± ÑN„ÁH©jºˆĞ¬I^\\#ÄñÇ­lˆu•Œ©<H40	ÙÀ…J¾ö:¤bv“ªşDsÿ!¾\"ÿ&²Ó‘ÖB DS*M‘‡jœƒM Tn±PPˆä¹ÌBPpİDµê¥9Qc(ğâÃ˜Ò7Ó*	ÖU)q:¿½gY(J¤!aL3´u”Ó±rBo‰ÖYAq+¥çQnÊ“µÜŠ@E¬P'a8^%É›_XÚVÓåKÎS‘‰‰I£##ÎX1’iÛ=CËx6 PH…¡ gv†´dédL®U	‰@ê’§Y@V:²!*^Íè¿…ÚAÔgYSp—’¹fÄR„¾V0dfj¯å•ò[)‰±ˆx™ÖA–àKoaØ„w’±\$¦Ò2\nDL;«=8’e±#é¶<éÈº£hZ2’¹X+UMV6ƒ“NÔ„ä×ã0Ì6>Ã+B&”í^×ë3ºM`P¨7¶ChÂ7!\0ëL£ÆŞc0ê6`Ş3¾Ã˜Xß[ÈÂ3Œ/°AÉea\0Úû®(P9….{	O—gY ™ˆb˜¤# Ä6@–sÎ€¡O>M”…PEÈR\$OmŒ©+·î\"£Y·£5:ÓO¸@ Œœ¸İñc9Mx@-^¾3¡¨Ğİ:>Ã8xŒ!öÎÊ©É×le×=ÏŞ¤ÅÄÜ!R.lPÁÅRˆœ9¢”VƒƒÀp\r-}=w²Ûİ\rĞ:\0æx/ğlšÙPšà¼2†èH¥á*šS€½ï0|Chp7!¶‡GÎúT\\48á½o÷,CY¯\r(™·gƒ£ëµ±tÂşİËş(/×†Æùà æáÂ#^{ÆPÑoÍ\0‘}oğÁ8Gâl[8æø4ğæa  p2†Â™’FhÕ£“@h’¡¦\n (#\$hxÁ\0(*€¤øTğ;È˜tD%\0%¦Yñg‘)X!©ÇŸß)¾6FĞÛƒtVò\$AĞŞœ”<ˆ#û†òÁÏI¡Tè]÷!mµ`¯ÂLNdª9 äÌ¤¦BïÉŒÌ'¬R‹Â<HÈ¼ lÌ¥R€’&¤Ö/’hS 7øâ\n	\$t<µÀÈVñ±Dd7CÓoZøq¦ñd\"^\\yêPãÂXôáÌt–Èœİ” Â˜T<íMªª©*yÄ!k…m?ÓJdh›T\\J¨¦”ò£8Hğ¤;©4up‹ÔXì’â3©Æ¬'4QwmlÕ6îŞ¡oƒÍt ÒÁ\0S\n!0i\\\r»ÙÁRF·u¼aŠ%rsö¢k™zZŠ‚&ˆ#ô(äÛ”lÙi­Tv|‰\0aBZnQöl¤«md¤©/™±<!kS4›Å•ÒŠá\\¬İ4Á\r¬†ÀVÛ c\rj1½íçÜªrĞğ4†fóÊF©áµä\"¼äĞhU\nƒ…ô§y÷°‹xˆšŞ|Nƒ&2ÁcbRá¯Œ%…‰ÒM‡a81Öõ+Û9g•!úğuA\0w	”2Æa÷ˆü+5Ú2à(&T%¼P’B×’ó>[²Œ\nñdJâOˆŞ½”úùglY	²·H3\na”ÜÅy`Ä…©ûJì¡˜2vRTT¸Y#-Á×E)R!‹Ñ{[õ^bÌõø_êğ™S.";break;case"lt":$h="T4šÎFHü%ÌÂ˜(œe8NÇ“Y¼@ÄWšÌ¦Ã¡¤@f‚\râàQ4Âk9šM¦aÔçÅŒ‡“!¦^-	Nd)!Ba—›Œ¦S9êlt:›ÍF €0Œ†cA¨Øn8‚©Ui0‚ç#IœÒn–P!ÌD¼@l2›‘³Kg\$)L†=&:\nb+ uÃÍül·F0j´²o:ˆ\r#(€İ8YÆ›œË/:E§İÌ@t4M´æÂHI®Ì'S9¾ÿ°Pì¶›hñ¤å§b&NqÑÊõ|‰J˜ˆPVãuµâo¢êü^<k49`¢Ÿ\$Üg,—#H(—,1XIÛ3&ğU7òçsp€Êr9Xä„C	ÓX 2¯k>Ë6ÈcF8,c @ˆc˜î±Œ‰#Ö:½®ÃLÍ®.X@º”0XØ¶#£rêY§#šzŸ¥ê\"Œá©*ZH*©Cü†ŠÃäĞ´#RìÓ(‹Ê)h\"¼°<¯ãı\r·ãb	 ¡¢ ì2C+ü³¦Ï\nÎ5ÉHh2ãl¤²)`Pˆ›5‹„J,o²ĞÖ²©ÔĞßÍÃ(ğ¹ÉHß:¤‚›–Å €Rò½m\nÈ—Q¬nÛ)KP§%ñŠ_\réª(,‰HÔ:»ëø  4#²]Ò£M.ï¥KT&¥¥ìPÂ®-A(È=.Ê€ÕÕ‚3 •¥_X‹°<³àS.ˆZv8jæŒªâ*¿³c˜ê9OÈÒ¿<¢bUYFƒ*9¥hh‚:<tÊ\"tU”1š¤B\näÅ»D¸J\r.<¸o+~FiÍ_%C’`\\ßëµû-è%œ‚`øIfáŒ8f	g1 RöôÚ‚@	¢ht)Š`P¶<åÈº£hZ2—É+¸ƒ\"“/DHj9j1ìŒlÊã0Ì6,ã,òûÉô®eKS:ş*\rè²V7!1ic>9ŒÃ¨Ø·ë4ê4ã–ªä,ğÛëZ«8ê¹…˜S	JVòRï¨\0†)ŠB3N7£KDLCÜ™ÂÌªS…8ƒ2Æ6é~m.®-RößÈ1»–’	F)V—¿ºc¿2£r’†(ã/!<,›â—ñÍú\\³Œá\0‚2mªå²sºR2>á\0yŠ0Ì„IĞD=«DB3‡xÂhô·\"W\"•R¥õˆÎ¶%7UñÑq0Ú¸Ë6cRF’ÓB°ğ87ËÕÕá²^74ƒ àÁĞ/áŞàÂî(rÅŒ3‚òã“™qNÁ¸¼æ‚HmÁœG¢ôÓ:^5\nE¿‚VFÚ\nİ©—èõU;\",5‡•ÂiÖ™Nxâ…FÓŠ/\rT0†2:Á\0w3|1XVŠ^Uá„33~ÖÒ\rk­|‘6(’vCA§ˆd00¥à@Î3À<„±ÖrÚÅ`Ú \r!¤7–¸Şe–ğ C]ó!Øf’Òê;\n (!èäˆ‘Ø('MÌ4îP¢3´„¦d4™³:^Z	%æ¨Ë ¢XHƒ»ö!ÍÔ›;B=%fr\0É³€òë±¾0Œ’’VKIyp\r!‘G–\0ÚÑ`l…m„bMŸ—i\\ì¦×XHXy2²] DËŠ¯5¨ãêgĞPf?!µÛ@‡u‹Œg\$Sb1¢\"g‰ Px%ìÚ\0 Â˜T•ŒÜ¸˜Ğ@Ã©+—§ÆfÏ·(¦*ù\rd`#cÒºÉ©5 †˜Š†àÌY\\ñj‰ëºf(!²'F:i†7Õ Øo€ô5XYşBa3†TÍ±PŒ\$+†Uä©#xRGçiÜ’ù&Êã3.QÀ%ØŞH‰(õ2£Tğæ›–kZhÎx’vìÀUªªUˆ˜©º¤Âë	Ô©á¥ƒÖj¾ŞkI‹c!\rrÀVÚ c\ri ú±PìK&ü%rÔ35S²Oiœ&%È*&¶ @B F á5;Ú\$É%qªÇLÂ˜®š|#ÄbÎ‘ÖfŠâ;´„lÿ7B0ÔÒë?«”âäFß%R!¦Â€ª/‹`j%DX:WğäSğy+‰F’ø¶qc-…í¶œS_MåÖ %p6œĞ…¹ÊàÍÊ·LXÔ‹›A2•*÷ q¥aı,7²eõîK”bUA•i¥Ybl‰yÆMxÿ.ëP(UW8_26b1z<ÄŠó—ğŠJ)êîƒ8dµ•š(Vy•³õ[bæ‡Ä¼Ø½pºÜ/jª«(K«äx‡–";break;case"ms":$h="A7\"„æt4ÁBQpÌÌ 9‚‰§S	Ğ@n0šMb4dØ 3˜d&Áp(§=G#Âi„Ös4›N¦ÑäÂn3ˆ†“–0r5ÍÄ°Âh	Nd))WFÎçSQÔÉ%†Ìh5\rÇQ¬Şs7ÎPca¤T4Ñ fª\$RH\n*˜¨ñ(1Ô×A7[î0!èäi9É`J„ºXe6œ¦é±¤@k2â!Ó)ÜÃBÉ/ØùÆBk4›²×C%ØA©4ÉJs.g‘¡@Ñ	´Å“œoF‰6ÓsB–œïØ”èe9NyCJ|yã`J#h(…GƒuHù>©TÜk7Îû¾ÈŞr’‘\"¦ÑÌË:7™Nqs|[”8z,‚c˜î÷ªî*Œ<âŒ¤h¨êŞ7Î„¥)©Z¦ªÁ\"˜èÃ­BR|Ä ‰ğÎ3¼€Pœ7·ÏzŞ0°ãZİ%¼ÔÆp¤›Œê\nâÀˆã,Xç0àPˆÄ>ƒcî¥x@ŸI2[÷'Iƒ(ğçÉ‚ÒÄ¤Ò€äŒB*v:EÂsz4PŒB[æ(Ãb(À‰ƒzrä¯ÀTë;¯¨Û0 €P’ç¦Œ0ê…ŒŒ(òç!-1QoĞ›LhÖˆZtØjqÈÆ¨ÀZ–Í‚›¤ÉBBˆ)zÜ(\r+kˆ\"³”å\"ÕCÔ2Òâcz8\r2ûW\rÃ¤aDIõÈ@çÁéĞÒ4&öSà>Ê\rŒ3Õ¢@t&‰¡Ğ¦)BØós\"íN6…£ ÈV•²tùCd?X (ìİ'#xÌ3-£pÊ’Š*Œ›N“³/ƒ\"ƒ’ŞèN0šôê#sHä1¸Lûv6aSÂ7„')\nF\"ªŒ/S‚DË(­ìk©4HÚØ‰(¨7³\rØ†)ŠB54ª-àĞ\rœjY1ƒ\n÷Çm\0Ë(Ã;c=aLÄå¥'£’è›fÎ‚b¨)‚ÌXÈ8œMir„ Œ™9d˜³7‰Ç­’Ñ‡ˆĞ9£0z)A}³Œ‚Zã|Ù?Lµ £Î«\$:d‰„OTüÈ/KjK7YYV®İ¶R[gàÜ„åÉè›ÈA½ï»øĞ:ƒ€æáxïİ…Ê&ÜèÏxÎ§Ş\$®ŸKCp_ÀaóÆŒ0Gq‚&4-Î3ØØÀ:–p´¤-Ûì˜D£”åi%È@ÌÀfÃCî0ŒhBÒõª>ı#3ŞgHaÇ<9\0êÃúa˜:‘÷0j_Ài…\"	Ÿt\"g£|p«\$¸†Ä¸\\’7äà›’c{ß( \n (Vš\n\nP)ZE ³†~ĞPÙV`‡^¡cvf\"…ĞØÍ:@Ô²Ò'¤ıø+^~¡¹B-\r”hHnàBqå!\\†PÄ´Ì²ÔQ,‚%%çàÑY3?':Ä0‚Q dÜÆ4öÚBÖ}-¹e#`¼Ì8 mş¹hé\\“¯{Éœİ›â›Â€O\naQÔ>§¼ÄÒ0h,2†5js¡>hL„F²*szÊ6¥%.²ƒzJ‹„P‹‚4J•«E\n!2!“’z„`*¹’æX#HZ\r¤B˜IÈË&–MÉ*ƒ2¡h“²\n@ƒlMšDÒ-­#0rMAªš*&MÒvÇ¢j5êj9¯Ë¢\\h|6°Æ[C„&¨£g²FÌãn Hf\\™ÂË\$Y4M&”³#@ª0-–udI9ƒLÉLÕxj´Ê¬5Ñ%¬µ³ª­È\nláÔè¬s…€S8=4Jh Ÿæ>9øFM|âj…8Eå¦¼ÖUC'e©WePZÑ’ÅM¡•É\"„f²r:-!fQb\"‚ÄVÉµŠKĞ\rPFE*sR-&”‰ïGë]Nù‡\"%åÈ+óTÀ";break;case"nl":$h="W2™N‚¨€ÑŒ¦³)È~\n‹†faÌO7Mæs)°Òj5ˆFS™ĞÂn2†X!ÀØo0™¦áp(ša<M§Sl¨Şe2³tŠI&”Ìç#y¼é+Nb)Ì…5!Qäò“q¦;å9¬Ô`1ÆƒQ°Üp9 &pQ¼äi3šMĞ`(¢É¤fË”ĞY;ÃM`¢¤şÃ@™ß°¹ªÈ\n,›à¦ƒ	ÚXn7ˆs±¦å©4'S’‡,:*R£	Šå5'œt)<_u¼¢ÌÄã”ÈåFÄœ¡†íöìÃ'5Æ‘¸Ã>2ããœÂvõt+CNñş6D©Ï¾ßÌG#©§U7ô~	Ê˜rš‘({S	ÎX2'ê›@m`à» cƒú9ë°Èš½OcÜ.Náãc¶™(ğ¢jğæ*ƒš°­%\n2Jç c’2DÌb’²O[Ú†JPÊ™ËĞÒa•hl8:#‚HÉ\$Ì#\"ı‰ä:À¼Œ:ô01p@,	š,' NK¿ãj»Œ Pˆ©6«”J.Ò|Ò–*³c8ÃÑ\0Ò±F\"b>’²\"(È4µC”k	G›¬0 P®0Œc@éÁÀP’7%ã;¶Ã£ÃR(çÈäÄ6€Pœ¯£º¢•Ñ!*R1)XU\$Ul<Èí\0¡hH×Aˆ-'îZêâ+è§!¬Š³#9@P‚1‘%ÚB(Z6Ê‹è¬Ş£3’8JCR…K¼#’±¹•€ËkÛ.=,I’iW¥7]°Ó*n%át&£pê	@t&‰¡Ğ¦)C Ék¡h¶5bPºÉK#r¦ÿ.V…’æ\rƒ¥Ì ®¢X7ŒÃ2<½¦¢šâB­JÒìkCl\rÃÊ	‹£Æ’c0ê6ªô9º8öl0Œò¢Š½*‰HÚ½©XP9…-Å:Ïã8@!ŠbŒŸ9apAr¤£¨êã èÌ»'hò6\nèËR¦¹pé˜8MCx3Áìc8øª{[:Ä4è@ Œšzö9:#ğ4¸Á\0xëpÌ„J¨D@µ£N‡xÂnµ3ü9Ä)cfâ%ò2h/ûs=¸nU*¢À¥›Ã›Ï<ÔA®,:<¬w±rh7-ÌQÃ£táxïé…É†…Ë°Î¦~ä?-Nãp_Ìağ’6¥Ã,Ä7G5ÌMˆŞ”µA°†Tíš&c¦RÏö'å+†U´LòB!\$|ÃB ;áŒÂgôœb%!„3³YÓ<gÍ¡SÆlITj –4\\¼–ŠÅF%üá'WÀ™a¡E(-d–\0v\$ˆ©FàÄsÎ8(*­T2Ä^Öß'ÆˆÒc JP8r…LÙ 8 ay‰o¤b—‡rFÎù3ÌXš“rrNÉêœI+¹P\"F‹sşld44Ö´UI¨I\"äÍ' \"ñşE&ÄÙ¢àâJ8 Å0¸‡®qÍ‰Âd¼ÿB“f‚ˆá5\n<)…@Zk‰1Q5\$°¥”Øô¹CYriˆr>’øAä<¨:ì‘w(úFÎ’p*n87#ĞÎÙÊ^&¬€4.k	y1‚ˆ¼\0¦Bd’ŠÇ4pŒ\"[*/¡?™&˜H«+{\nITKÓÆ3}	3µNÇ~ÿ§cêN&ª5öøMU‚€}P@“Ïcúÿ—¢§}ENz†YîMB\r€®X¡0ŞéÂñ!N‚dB‰Q,\$ixË„i¶NÉ,iT*`Z{Oêv€“+àQb¾rE¢qAu	2´i!7ËNéé+HMX>HL¤3¥ŒÁã\"_˜iÁåg2j.LÕR#³%#Ò3 Ñ¼Áh%è‚*Ìrl'´|–Q³¨ë©Q˜ÃÂ`Ó‹±ÿ?`*¿¾‚ƒHJeÅ'ÀÉrk&P’3òLPÈ…6#õ™UUQÚfš¥Ğ^\"ÈEÇ1óÅš¬s8RÌıÄsüc\r©AJÎœÀ‚’Šo9`";break;case"no":$h="E9‡QÌÒk5™NCğP”\\33AAD³©¸ÜeAá\"a„ætŒÎ˜Òl‰¦\\Úu6ˆ’xéÒA%“ÇØkƒ‘ÈÊl9Æ!B)Ì…)#IÌ¦á–ZiÂ¨q£,¤@\nFC1 Ôl7AGCy´o9Læ“q„Ø\n\$›Œô¹‘„Å?6B¥%#)’Õ\nÌ³hÌZárºŒ&KĞ(‰6˜nW˜úmj4`éqƒ–e>¹ä¶\rKM7'Ğ*\\^ëw6^MÒ’a„Ï>mvò>Œät á4Â	õúç¸İjÍûŞ	ÓL‹Ôw;iñËy›`N-1¬B9{ÅSq¬Üo;Ó!G+D¤ˆa:]£Ñƒ!¼Ë¢óógY£œ8#Ã˜î´‰H¬Ö‹R>OÖÔìœ6Lb€Í¨ƒš¥)‰2,û¥\"˜èĞ8îü…ƒÈàÀ	É€ÚÀ=ë @å¦CHÈï­†LÜ	Ìè;!Nğ2¬¬ÒÇ*²óÆh\n—%#\n,›&£Â@7 Ã|°Ú*	¬¾8ÈRØ3ÄÏ¶Ãp(@0#rå·«dÔ(!LŠ.79Ãc–¶Bpòâ1hhÉ)\0Ğc\nûCPÂ\"ãHÁxH bÀ§nğĞ;-èÚÌ¨£ÿ0˜ÖÅ<£(\$2C\$¹P8Ù2¡hà7£àPŒÅB Ò›'õªú¼Œó#ÔĞJmw¨-HèPôËgËÈ*–2ZtƒMW‰Ğš&‡B˜¦zb-´×iJÓ¶5n>|,Dc(Z™hĞ-À²7 ƒ”3ÕšªÀ¡R¬&N\0ëS\nƒxŞNÓú*ıŒcî9ŒÃ¨ØOrÀXÏÏí°Â¶0ª%6­˜˜ÊaJR*ŒãÈØ¿.A\0†)ŠB5ö7¡*`ZYtä‚cPÊÈ°hÈÏ§6`Pª:OVLÆH\rˆò„0iH¨42Ik}‰ Ùè‚2f¸å“ŒrÒÆ !àÂ\r	ğÌ„J(D>«jf¹xÂ%&05¹Ø˜Øv{ĞHÏë3Š,İBÛ©Z¢9WShåk <w!i„¶ñ½oƒBl8aĞ^ıÈ\\Åí«ÒĞ3…ê_ƒ+)rÈÜï£˜|\$£‚óÏWÃÂzÈÆlòÌÒ8zšvÕ±üêÉ)vïÆ©Ñqbcí5cV:Œ”:RìLÌ\"1¦rĞ@É¢#¬9=°ä‹ÔaËe1àæÈ\$-e2\0@ĞLŸĞs(¼3ŠùCInCF¹”Æ&‘±?(0º!#XAC¡;X`(€ a<)Bæ¸PRSH\nüje,¹¹fÒÑm°Ó\nA}s‡øÑ\0@~P‰±=õ›³–vÖÓ“™Lm¦æ’Ñ)%e<—“\$|M‰%'áÑ4ÀŞÃŸ”rMp¥¹d§PÉ)	\$D<°B¢¸o?KnEb|C©÷9Á˜öÖïb	™)=hs)š@È½^€g{¥¦4æ ë\0u(\$SŸRcs'/@>¢{\n‹£÷C ´5¥¢LÃ©ŠŒíÈ¿çÛ	 ¬ÉÂ<MÉ\$.’”€…0¢i&dp¡»„`¨šqyª¡ğI(İå›)eìÅ—B†ÎÁ [¡Jz¢6eª(‘)Osàs“‘)Q\nûhPˆJÓZ´0¡¿zDIHCDa°†´BáÃ.Œ8¿6zDjgkU)&ÉöšwŞÈÄ¬\n¡P#…öC9å\rìğ3Ğ¥bAfşQ:€PÊCKËt%ÍR©¹>&ÀÙ\0 ‹Jsmh¦0Â;2Ûp\n8¥üëÄqíd¦ÊUˆiM:Û¥(~>:pÓ<ÎšEòÑz×”¼`aH\n ÇH\$ò0OØl>3éfÔ\n=N°V-ÁS´ôš‚)-Wfü¸T¥S %«w••N]`¨]‹Å]²Z¬\$T@";break;case"pl":$h="C=D£)Ìèeb¦Ä)ÜÒe7ÁBQpÌÌ 9‚Šæs‘„İ…›\r&³¨€Äyb âù”Úob¯\$Gs(¸M0šÎg“i„Øn0ˆ!ÆSa®`›b!ä29)ÒV%9¦Å	®Y 4Á¥°I°€0Œ†cA¨Øn8‚X1”b2„£i¦<\n!GjÇC\rÀÙ6\"™'C©¨D7™8kÌä@r2ÑFFÌï6ÆÕ§éŞZÅB’³.Æj4ˆ æ­UöˆiŒ'\nÍÊév7v;=¨ƒSF7&ã®A¥<éØ‰ŞĞçrÔèñZÊ–pÜók'“¼z\n*œÎº\0Q+—5Æ&(yÈõà7ÍÆü÷är7œ¦ÄC\rğÄ0c+D7 ©`Ş:#ØàüÁ„\09ïÈÈ©¿{–<eàò¤ m(Ü2ŒéZäüNxÊ÷! t*\nšªÃ-ò´‡«€P¨È Ï¢Ü*#‚°j3<‘Œ Pœ:±;’=Cì;ú µ#õ\0/J€9I¢š¤B8Ê7É# ä»0êÊú6@J€@ü¸ê\0Å4EƒœÖ9N.8ğƒÃ˜Ò7Ï)°˜¬¸@SÁ¿/c ¾ˆûÒ\$@	HŞİƒxÎãON[š0®®ZøÖ@#˜ÕK	Ï¢È2C\"&2\$ÌXè„µCş58Ue]U2£¸¾=)hÁpHWÁˆ)C¨ÖÅC8È=!ê0Ø¡½\"œÂSúê:H†ù¡2äc¦4Z#dŒ0±C¸Ç\"Æéí°Ù%&!)QM€®”i\r{iJ<§Õ-Æ0Ü¡p~_ÏœY€àw*kƒ7éán>‘&È::÷‰@t&‰¡Ğ¦)P˜Úo»î.B€ßp<·\r“Ê‚ èLÖ3É>›\nq:h9=T&Ã6M2•¥£«ÜŒcB92£A£>ğÂ#æªãAoœ‡Jxªêâ^\r¤ŒšZ®2éÈó“©kÅ­¬;¨ş·®ê›¶Á>Q)ËV„8êámjÚ˜éˆ~ã¨n›îïIk;Ö¸9î£ÿ±%«šƒÂpÃ¢l'!ìàÂ‡”pî)ÃZ b˜¤#Á\0§Ì¸İ^\$0Ãƒ3ò6£`Â÷!|Æ›^ûÆ)·Â~‡¿vc–’ o=PûÊ@ Œ›<O½Äêc©ğ±2ŠĞÈÁèD¨AóF¾9DÈxŒ!ö€‚JVÔkk‰M£)@Ò…Û&¤h0“¸R\nPh€%3’•j‡Ñ	B0İ»WÒXe} ˆ4@è˜:à¼;ÂĞ\\ºñú?!œ‡\0ØÃ*w\"	é>÷ŞÁñ²\r!¶â aS÷%	0Ü¼œ(e)Á‘•¸_Qùtğ¥BXPbÑ)kÜÀ€‡H2kLH:À0ÿ\rHw@\$lB!Œ:'°ÜP—(l\$È†'|’J¨!™ ÆÈ(sÏ«©\$­ £R“(9©„Ì€dˆåØ630^ŒxoD¡éÊÆô†(»]|¹Ê™W+QLs¨`—“f]”úónox¯9\\H«ç.Gü=EŸ0ÁAP-¾4 ƒFu„ÉØc@¯\$¤D	£x¡È:+T0g	M©ÊÌ2	Ii£HEH³ôŒéLèiu\$¨š3)hò›Ò•¬ü%'\0áIÉ;'¤ş(\$¤ A•/à€-ç¦sÓ‰6	D ^ù¨êĞŠşŒLèÕ‘„ÄŸr{Å½¥0Ú|ƒI¬)É¬ùúAXJ\"\$óY·Lö¢íBĞm+t`7†%>&Jrİ)Tù©ÀêÕ§œ\$èÛR!Ä( 8˜4©2:ÃÈj«dU*©!\n©©\naD&8RaGhÀw#ğ¥FtšÅÄ`¨œ¬U	N! ¹ÈåH{'AHÈ¡\"æùKá)Cˆ© òM¬b¥±ñ„A9àÖa	ğiS¶ÌXÓ&š­œ@s<›TGè;„TˆIµÕk`Â­•¦0VÖ×Çæ\0cíÒµ&Á\r1ÀVÊ©5‡vÃÔ¨®IÈP98î”’lÌMˆ­1Â–ÃRIĞál/„9> (ÎB F à›[›5jl°‘ZEep-)²4AR–	},;ya÷¹	Nkáÿ°×Q¹Sùî€›Š#Iâ†\":‡*dµ?Æ¼ØÕcÉBÃ,Áj>Æ<#N[®šÔ\nªÖ3âHqÍ1¨`¹Ûh¸j½Ì©0Aä%#bäË’²¦¬|pÑn\ntœ \0«öùê=’´¡ö\"YßÀ†NûÛ3&ríÁ2Æí&G»F“B!›*«P\"“¬‚N\0[ñb¬{–€ƒ¾V Ùe¨šÒıÃB65Ï	j†šPrñ”Ìvº\\œ à";break;case"pt":$h="T2›DŒÊr:OFø(J.™„0Q9†£7ˆj‘ÀŞs9°Õ§c)°@e7&‚2f4˜ÍSIÈŞ.&Ó	¸Ñ6°Ô'ƒI¶2d—ÌfsXÌl@%9§jTÒl 7Eã&Z!Î8†Ìh5\rÇQØÂz4›ÁFó‘¤Îi7M‘ZÔ»	&))„ç8&›Ì†™X\n\$›py­ò1~4× \"‘–ï^Î&ó¨€Ğa’V#'¬¨Ù2œÄHÉÔàd0ÂvfŒÎÏ¯œÎ²ÍÁÈÂâK\$ğSy¸éxáË`†\\[\rOZãôx¼»ÆNë-Ò&À¢¢ğgM”[Æ<“‹7ÏES<ªn5›çstœä›IÀˆÜ°l0Ê)\r‹T:\"m²<„#¬0æ;®ƒ\"p(.\0ÌÔC#«&©äÃ/ÈK\$a–°R ©ªª`@5(LÃ4œcÈš)ÈÒ6Qº`7\r*Cd8\$­«õ¡jCŒ‹CjPå§ã”r!/\nê¹\nN ÊãŒ¯ˆÊñ%r‹2ßÀê‚\\–¥BÙC3R¹k‹\$œ	ŒËŠ¬[i%ÌPD:ÈãL’º<‰CNô¹Ò³Œ& +¥å Œš}‰ÃxìŒË¬ûh‡\0Ä<¡ HKPÔhJ(<¶ Sô¨^u˜b\n	°Æ:ÑÀPâá•ú\rƒ{½‰ã”n¼¸ÓÈÚ4¡ P‚ë;šJ2Œs³\"…©àÒ½ˆ’ø‚®rä Êä \"¥)[S¤öòL”%Q²oST(Ão¶W¢W!'ÎºG\"@	¢ht)Š`PÈ2ãhÚ‹c,0‹´K_l¹®Sq!CcÄ4m*Yã0Ìõİ)Å¬9%RRrƒÙöb&Ø¤(Âr7¨	èó2C¨Æƒ\$0ê“X«»\$6c–_oêğ§Ô9­2…˜Rœ\nƒxÖ”¦)Áğ;(OZeêğCK Û£¥‹‹T·IÎpË—gê9f±²1¾0nˆ9¦éËNü6C4;:Ã8@ Œ™ª¦pŒ”ƒa‡ˆ ĞÎŒÁèD¨Aò¼¹üˆxŒ!öø/ªààšğZd\rC“eÆû¿&°Ûü\"B–RıÙ³°°AÎ´İD4ƒ à9‡Ax^;ûtmË@+ Î¥\0ñ:NÁF9‡ÂHÚ85ûÈéÕõ³xA'‰ıBÚ~c¿³A’'\0OI@t'›»RC)\$ FÄÁ#[Œ;Š@á„1œóšºß\$Æwà¡Ï9´'Ñš@oiPahƒvÏªN ¯&\0’°ÙH±—\rÅ9’†r\\‚rŠD\$Ü/×Ç‘B\n\n ( Ô`¢( @’r¼ŒLXs#É\0’ÄhsWL<æÌÕšÕ¾lO6Fôı Âô±C¹Ô'¾˜ĞÂµ»gm)0“€¢pÎt|w¥¡”XˆÌsë#ğuÀ-ƒ\"Êá1l\0!‚Z†ÔÙÒD04Á’DƒÉ¤A	³pÜıÍá²3«¯!¢l@œ£Ü…çô1¬T>ıMèp`Mí\\ğ¦SFäñ:¯`@Ò´§o`.†@êBÉq¾'„øŒÊ Ã&ÛÑ”fvÈs˜‰€gW‘Üë™tVÉ%?¦Ùb£i´‹° \naD&!¨Î¨ ÁR&“ÕBQb{ü•ÎïD”êz+g­À¶ºg¨Só1F0˜¯bqBMj;¦R‡/ fÃfLtY|?È}©\0AñÀW-CJÂŸ)8€Ägf‰nX¤¶]%bNŸƒ-X¨°×¿4<ƒ ãS\n¡P#ĞpIÃs„1nDœ/:§ˆÍ\0.‘A{Õj h#\\Š!ÚÒœ¬]fìmm @NŒ lG&\$Å†`òÃ–Ád½Púäµ 8\n(ÕÖŠœ`ª¡CÓ(X…à5Ñ+c©á, …é¿’ÄğçqF§àÁ\0 ™f*™è\n	¥#‘†.™EK†Å£ÕÃ˜úÍzŸ«Õb’ÕzE³!!’•¬U˜zCÄO=ÕŠ«ƒb¯Ó9-cò,¼›*àaH¥Ï®T>¬'Àæ°‘z-¨›€";break;case"pt-br":$h="V7˜Øj¡ĞÊmÌ§(1èÂ?	EÃ30€æ\n'0Ôfñ\rR 8Îg6´ìe6¦ã±¤ÂrG%ç©¤ìoŠ†i„ÜhXjÁ¤Û2LSI´pá6šN†šLv>%9§\$\\Ön 7F£†Z)Î\r9†Ìh5\rÇQØÂz4›ÁFó‘¤Îi7M‘‹ªË„&)A„ç9\"™*RğQ\$Üs…šNXHŞÓfƒˆF[ı˜å\"œ–MçQ Ã'°S¯²ÓfÊs‚Ç§!†\r4gà¸½¬ä§‚»føæÎLªo7TÍÇY|«%Š7RA\\¾i”A€Ì_f³¦Ÿ·¯ÀÁDIA—›\$äóĞQTç”*›fãyÜÜ•M8äœˆóÇ;ÊKnØˆ³v¡‰9ëàÈœŠà@35ğĞêÌªz7­ÂÈƒ2æk«\nÚº¦„R†Ï4	È†0Œ‰XÂ\r)qŒÌ¨‘\$	Ct9ªú½#%ĞÚ…¤O\\ç(”v!0Rò\nC,rã+æ÷/±ØˆÏ¸ò°˜¦ĞÄÚ„\\55ÄéXæ¼²éÈ˜Ï±H»\"©/¬‘-/BšV×B+£+3b`Ş¿¿êxäÉZŒ\rêüºÒ¼«ĞJ2òƒ4ıCQ¶àPóT¿€PH…á gX† P ÓŒc­&Œh…„bÁBxå°4jŒ© P‚a”ë¶öŒsÃ(\"…©èÒÁ½–rF:º+ĞƒJ–²•20ÛpØŞ4¥Ib\\¤…Õ-AuÛmÀÌ¾'—Ğ¤±àPÂ3ß€P\$Bhš\nb˜2xÚ6…âØÃ‹Œ\"í¦ÚÚ®ƒªŞà\0PØòMSX—»ÃxÌ3\rŒ\0Êã!ij’å]ŒØ¨7¨)ğó²ã¨Æ…\$c0ê”ØT€æ £–wİû8Ô\n‹¦ƒ˜RœæãZVb˜¤#;éb‡–ŞÎ—<wu'¡¥ëËb»Iî^ó¤­íBĞÉS\$Şë\rsõ}CÓ¸Ü3„É©!z@ÆèNñÊ`-kF3¡°ÊKéáà^0‡Ù‚FÂ¬ƒƒ5:D!\rÃ©†Š:Œ¡l@şn¶æ&±È2`8Bp­ÃtÍ.rËÊC@è:˜t…ã¿¤GD¾ázWíDîèü°æ	#hàÚî#§=ĞN-Ä:(\0éœëNüIR”³Œİ¯ÿ\"f+Gá”ØsŞkLZÛ2kĞƒ¼CS:\0€;­²Rc(r_jM/\0ÂÒgæÜ9´&ˆ£Ú|~\0ïtB^–%Á±€‘“:šu2éàŒ(tDäQ)†{È©…\0r1Q€RJ‹232AÌ†âlJ±ĞR°Dô›’@lÖÙ¶T(Ü#øƒLÂéxœŸdCaZÀfÆU	9\n'PèÇ„r\nD(Ñ\0ïGÌ‘ÁRHh˜<7©&p›“\0Âˆ³í¤T<š´HUa%oÈà›ƒF¯Ë24ä!Ã=hXÃÂDÀá;ÀÎÜÂ€O\naQ%4rOSº8#+–^èd¤8˜œ5(P	‹'“\rÊIóFTË²\$§A †uu–‰E¬–OGşnÖ8š¡ˆ¿\0¦BbŒ t\0Œ\"A>T%?iT|år\$è\rbÌƒHŸ\r:î^äÚÄ²qATİ#‹íxã¨ËHt	ôNt×E	áHdåS,ÂH ùî˜KÖ’½æÔ¿iM`!ò†ÀW,CJ¿\"Á¼19š]–»%îE/0Z°‰ÈFaµ Ø0ÓÂ¨TÀ´/dœ\$TÑ5Şwä9¥kØÑPsL‘ ÚıŸöaCS\nG‰\"Näœ”™†8µ¤° 'f06#°šÌf,<2†3FÈSrK†69À QOyõ*ta”¬\0Î±“¨IZ@X\0Ó¬;Õ\0¾' ß:Š=>7¦((äpzU±CRìa‹¦FQ‹Ò]Ia÷ÍCTõ[¬Êv²UÊ\$EÔ3 Á5„²THx‰FQòİ36üq&\"q^Ìi¼öÅÕÔüÕú#±İz\0";break;case"ro":$h="S:›†VBlÒ 9šLçS¡ˆƒÁBQpÌÍ¢	´@p:\$\"¸Üc‡œŒf˜ÒÈLšL§#©²>e„LÎÓ1p(/˜Ìæ¢i„ğiL†ÓIÌ@-	NdùéÆe9%´	‘È@n™hõ˜|ôX\nFC1 Ôl7AFsy°o9B&ã\rÙ†7FÔ°É82`uøÙÎZ:LFSa–zE2`xHx(’n9ÌÌ¹Äg’If;ÌÌÓ=,›ãfƒî¾oŞNÆœ©° :n§N,èh¦ğ2YYéNû;Ò¹ÆÎê ˜AÌføìë×2ær'-KŸ£ë û!†{Ğù:<íÙ¸Î\nd& g-ğ(˜¤0`P‚ŞŒ Pª7\rcpŞ;°)˜ä¼'¢#É-@2\ríü­1Ã€à¼+C„*9ëÀÈˆË¨Ş„ ¨:Ã/a6¡îÂò2¡Ä´J©E\nâ„›,Jhèë°ãPÂ¿#Jh¼ÂéÂV9#÷ŠƒJA(0ñèŞ\r,+‚¼´Ñ¡9P“\"õ òøÚ.ÒÈàÁ/q¸) „ÛÊ#Œ£xÚ2lÒ¦¹iÂ¤/Òø1G4=CÇc,zîiëş¬À¬Ã4¼L¬BpÌ8(Fë¨ÂÏ C“:&\rã<nœ	šŠ7RR;J¿´\rbºœANûJŒ”D­@6„Å Pò¬PP¡pHÚAˆ!¡é\r^»¯(éDÛş¦Ç 0(¦Ê¶¢(\ré„×vJĞxÜ4¥\r(ˆœ\r•8¡Z¦‰ô„ò#ŒŠ`ÅKÍÉˆ)lVÈaNMŒ¢·p £c6àb0¶&÷\rj×R¨ê6B@	¢ht)Š`PÉ£h\\-9Èò.ºW£6ôCe6(İ_DÃ0Ø½²ÙèäÍJ˜¼€P¨7·˜ó4¨Æ«c˜Ì¡•kàcšØÃWF1&ï a@æ§¢¦)Î\0Ş5ÒA‘¡#*O\nÍ'Ğä¢ª±nı©³A\0ÆÓëêÂz*6BÅFHKì*^˜9mÜzÃ«ÁâX4<ƒ0z*A}/’ûìã}ËïêB„ 1ò9„œÅmxÎ„:ã³¯Ó]¸2\rÆ5êz&Â¯Ú?Ä£•‚±xÏ\$NuAX2õÁĞ:ƒ€æáxïù…ÊR™ZArğ3…ô—úá	;€½Ø0|Sy•Oä	Ü;¢¢S“ùÇ\rëàÖøß‘\n²*ĞÒ°^\n9P!”1RdóQ.Vá{7.	ÂUKçpsxMŒ™7N)?¬ÂÑr­…±“fÊÑŒ68ç‚:”Ÿµ\r%õJšdt¦\$&QX¬³kÜl:ëÜ1sp¤Qé8C«…[\0PT›¢×;ŠÑ+·—Cº7”ß,>ƒ¡N9(lÆÊÏ	=#Iı¥Õ@ÒÕ^a„¢\$¿b¹‹çì«iÉÉIC(¥%ÒJ®Mj\\)¨}{ÆbÃŠË>\0¸=€Ô^Hx‹‡“dõ„4!º\n‚œyˆu‹¤µ‘çBıÉœLo¡²¡crQ¾zå`0†¢†xS\n’eX#Úy% Tb+!é±B>Qj´Bì\"'´Ì^\\t–‰ê¡ºb\\BÒ¢-¤ÌHêNÑüUh®J\r£ àÙJSÃpO,)…˜VÑÉ»%*91òoDbf'ârÓÉà\nW’\$”¨Á	c–+ÈÑ‡ æYiQ€¥‰—ÊúdV¥:\n3Tâ•ÇÊx«Ã\n‡¦,lø3Nm?(L4’âWV4§5r¤Ë1v2ÆÃmTªÓÒ¬š¥tk›ª\r€®j/€ÖMÔ@ Åô7´ubªZ5q¬&f±¤rC¬±‡(Ä*…@ŒAÂŠ;fdûÕŒ¥:Áoñ±‹Xû\"Èé20º+ÙŞHã>0ÓÒÆ£&]‚mb,È¬ËZTâx_¨´4€£Âf–ØV®•Úº˜²]Tëâø©ç©É‘É¼˜Ê%8%€6B`@0…]{ª«à‡Œ!v¥«ªÁ¬,âªuXR£°\nT‘ ¾\0¢j›•;W+G=^sMHšÁ«Uœò,[åY¥Mµ]fUa†E®ÙU¡Ñ¯êE èC’‘¶SÚeØÕŒ‘”§2 ®ÛU4ÏÎ¹Á€";break;case"ru":$h="ĞI4QbŠ\r ²h-Z(KA{‚„¢á™˜@s4°˜\$hĞX4móEÑFyAg‚ÊÚ†Š\nQBKW2)RöA@Âapz\0]NKWRi›Ay-]Ê!Ğ&‚æ	­èp¤CE#©¢êµyl²Ÿ\n@N'R)û‰\0”	Nd*;AEJ’K¤–©îF°Ç\$ĞVŠ&…'AAæ0¤@\nFC1 Ôl7c+ü&\"IšIĞ·˜ü>Ä¹Œ¤¥K,q¡Ï´Í.ÄÈu’9¢ê †ì¼LÒ¾¢,&²NsDšM‘‘˜ŞŞe!_Ìé‹Z­ÕG*„r;i¬«9Xƒàpdû‘‘÷'ËŒ6ky«}÷VÍì\nêP¤¢†Ø»N’3\0\$¤,°:)ºfó(nB>ä\$e´\n›«mz”û¸ËËÃ!0<=›–”ÁìS<¡lP…*ôEÁióä¦–°;î´(P1 W¥j¡tæ¬EŒB¨Ü5Ãxî7(ä9\rã’\"# Â1#˜ÊƒxÊ9„hè‹£€á*Ìã„º9ò¨Èº“\nc³\n*JÒ\\ÇiT\$°ÉSè[ ³ŠÚ,¢D;Hdnú*Ë’êR-eÚ:hBÅª€Â0ÈS<Y1i«şå¸îfŒ®ï£8šºE<ÃÉv¶;A S»J\nşŒ’•“sA<Éxh‘õâˆä&„:Â±Ã•lDÆ9†&†¹=HíX¢ Ò9Ëcd¾¹¬¢7[¶üÉq\\(ğ:£pæ4÷sÿV×51pŒ¸ã„â@\$2L)Ö#Ì¼ª\$bd÷×Èj£bšıeRà­Kñ#\$óœ–¼1;G¼\nsY¬î¥båc½èĞ¹(ÈÕ§I¨•e‹ëõ—åfƒY™1/}ŒXdL`¡pHèAŠ3‡Y\nd†ôÕävl¼—‰U¬ÏG&„˜Põ.3jjèØÕ®/Ä(©#+A V¤Av’ïÖ*šÕjŸaªè¥Ñ×¢¢¯¶J¥4h§+í^Eèğ\ru_Z\$Š¨‘Ğ0óã¥\0¸æ®ÎQƒ)åğ\\šrÅÈOÏ¿)rÏw1ójrAÏô<z÷ÉU°[à†õY†Ní©Ê?y>YO3\\áÑ ¤“4\0P£(ùhuÅà\\-¯EŸª.È™´\rƒ å\"6Ö\nÅW\$o›ù`´p•ç!G³>8±yEÔÖ®¥@/\\Œl˜¶”lÍªô9\n¬ûœtú\r#¯%M!ÚªTŒÓéL=Ç\$‚,¤xw#ºkåLAœ±ìóQ‚é¨?x&õŸÑB#ÊÉÿ%\0¨‹€§'ñ`Û˜iyr‡\"•X\"P`™á‚¥†Á–kÈ|&Â.Çé	³®„îÍıÂ³•a”UĞœÃCúPÔ7pé½¨ b\\@dq’·Vë¤ITLõ\r6%>XQR4ÅŒ!…0¤l3„‡Ê1g&í£Ãƒ'\$”†,1J‘^Q\$¬ºgW¡\\rğÂGboó(€ ¨\nKL™qUŞƒ8 !6†Ü”` kÅw†D¤àa 9PÌAr@ù0®@é-ƒ8<á„*5Kã¬>äÑ³PO ¸PG8¯9sÃ—‚Q­cÃãŠÇJd¢nÄº”•X-^‡)ˆ éE9EÓn˜3bÌpD tÌğ^è€.2Ò[% \\•C8/]´iu®ÕŞ¼A|É`øh/’ SSÔî!3Jj?siˆs—/ú¤i.PHùÜ/èH?–ŞÅÉ(,íé,ù¾SgB“¤Ó¸\\t¦*\"9ÿ;ƒı)ƒB_!g¯@ÃHl\r€€1%ğà”¥`r\r¡••†Ì»’ha1‡0Ìkl\rá[UğÒ@ °	}nV¹u1eğn™á„62êuO*G\$ê1¨ò«œä ÇeÕ Äü†¢š²OÒÊ ÆJz§%\rD>wY\0 ¹’×Œ·«“BÁğ@iÕ„2†zÙoÓbd[i”7¦{^ƒ½l±ä5Ó^Á šškÖò+r¥PO}ÆV\n]Ué%3ÇÑëG&rıÉ	Kœ¸°Wñv‰a>Šîá¨¡ ³c'õ*Í/HjO‰İ%BŒ¢S£´ÜDb}RDdJ”É@b•b6§äÑÒyÄ4T3’%D°ì!MxÔ\$³–²Ü9N|Hpã+ğ>°yM“dJv„4ô~GjÂV0ŠŒ9Xö\rİ\0P	áL*O£„àbÌ8iÑùÆŠ\\Tò	MÈó#NV£j.€'ÒPÛ€	B}¼§¡kckü^Hy9½†´ˆbšr\r‘ø%D~Ò¯Ë\\@©Œ•Ğ¸ä)œÕ‹á%û¼8ÖdéÁ\0S\n!2@¸RªO  ÁP(,®È/ONíaF²:xCaA@cÏ²\"Cr2%Ékš0d¥şRto«††°;}CÇğíõ¹u×Nì“ˆÅÀö°éëT¬¢`›ô]]l=j\r×#}oñ~²Ø®Ãhá}¨YËòĞël¯Qq·“‘Û÷ñ¨É¬WªµĞO‚Zl¬Şğlc@TÇ••š”.+¸DG6üFX/Ú\":™·»M©î©¥W{…&¥sŞõS\$:§C* Ó/ş|Œ¤\"A‚\0ª\$\08N»Qˆ9ÈÉmúus’kº÷@À5ıåík˜—¶aÍÌvâjD;wÜ¿?1–€³Õ.pœ†³Áe\"î2#İÚPfà–›¼p@—ù2Ü™'u/MM¦ÍÌÄçéÂ–*_|ïS#æ\0Y¯çVÄƒßª«e®Ó©…ïÃ:asO›îÊN‚„*øŸcBâ0a½„KI. Ä³«\$b\$z¾a,MWaù’bK4J:ÆÜôŞ’6âœ±¥X‹‰)ä0ßiK?MÓ¥-xH¦5é„Ïàôö[G=ë\$dMÌñ©nûjm—Ë¢òáØyÌŒnå¤”°,ºáû~yØåVëø±Ç®jŞøá¤JªhbqÒ";break;case"sk":$h="N0›ÏFPü%ÌÂ˜(¦Ã]ç(a„@n2œ\ræC	ÈÒl7ÅÌ&ƒ‘…Š¥‰¦Á¤ÚÃP›\rÑhÑØŞl2›¦±•ˆ¾5›ÎrxdB\$r:ˆ\rFQ\0”æB”Ãâ18¹”Ë-9´¹H€0Œ†cA¨Øn8‚)èÉDÍ&sLêb\nb¯M&}0èa1gæ³Ì¤«k02pQZ@Å_bÔ·‹Õò0 _0’’É¾’hÄÓ\rÒY§83™Nb¤„êp/ÆƒN®şbœa±ùaWw’M\ræ¹+o;I”³ÁCv˜Í\0­ñ¿!À‹·ôF\"<Âlb¨XjØv&êg¦0•ì<šñ§“—zn5èÎæá”ä9\"iHˆ0¶ãæ¦ƒ{T‹ã¢×£C”8@Ã˜î‰Œ‰H¡\0oÚ>ód¥«z’=\nÜ1¹HÊ5©£š¢£*Š»j­+€P¤2¤ï`Æ2ºŒƒÆä¶Iøæ5˜eKX<Èbæ6 Pˆ˜+Pú,ã@ÀP„º¦’à)ÅÌ`2ãhÊ:32³jÀ'ˆA¦mÂ˜§Nh¤ğ«¶Cpæ4óòR- I˜Û'£ ÒÖ@P ÏHElˆŸÀPÕ\$r<4\r‰„ş¢r¨¨994ì”ÒÓ”òsBs£MØ×*„£ @1 ƒ ZÖõÈó]ÖÕÀÔÖÀPòÕMÁpHYÁ‹æ4'ëã”\rc\$^7§éëåBM‘uÆ	‰u#XÆ½¾c„¥kˆ¡kÖB|?Œ²¤‹JÃq,Ô:SO@4I×²…*1‚o9Şò¢t^©µ°Ëy(ø\\áC`Ó†`ã\nu%W˜æ60¸Ân£xîéb/î(¹	Kd’T°	¢ht)Š`T26…ÂÛşÿ‹·mŞ¢’Äª6M€S:¤£ª`Ş3ØÒ0¨¿Éí{U%\r>ÉŠƒzBõÃÈ@:ÏÃ¨Çc˜Ì:@ºOÁcX9lÃÏŠ¿‹®Z6®£«daJR'#7ÖÖ8iÈ@!ŠbŒ3ÃDc2&6î@=4nJS®SºõV¦-c(Ä2Ó‰ìB+ØÈ5©H¨Ğ?\r_4Š³øÜ3„ÉÀ#–íOÃM´Šˆ²H2ŒÁèD§Aô™8xŒ!ö±¶Ğàí&O¾0îÕGJ¬©•aCÜÿB0¥)_ØŠB›l.9bCÀàC’%r4<÷¢ƒ@tÀ9ƒ ^Ã¼Åñâà\\DÃ8/'0h<'Ôş A{Ó`ø\$†ĞàNPnmî§%şÛŒ¬5”Åìód'!ÑïÁóøêaK†nô½«pòQ	©7')%Û‚˜CÙP €;‘öâêáÀrwi©[ÌÌĞ{k5M¹¸7 Şİ\"¢‹\r²'TÔ[P¨½†Äde‘—@èğ8•`NEÈ/r´\"×2Å1 È„NCbõ–G¸ú+cùã\0 §8`Ô	Š'SNMJ¶B!ĞÕ›Tƒù ğ	V¸”	ŸR’+¬¦8XËïEè\0ãD¶ zÉi/&-•Ø-Ášæi6'®5«ÆåÑĞ§…–²„üJq)	\$,<™é\nò¥y'*Ø:CW\0Cˆu5H83 >ğ ©®81’%r5(h¶\nÖ4xIâ”I	((ğ¦\$+J›¤ğ¨´Ò	8\"N~mMÂ™z\r)(¨30êqfxjœğ5‡D†Ù§NœÁ6xNËáÁVåÌ0¢%N&(‹`¨nVÄºU‚o=SLêTYG2s ¬Õ¹7;!äõ2ì†ª±@\"ÄI*ZNøiRF¯ÕUdSÅd;&î%ŠR¯‰Ö2(¾¬’æ¡8yÄbj†›`+\rlhüÑbE3Tè­8Å»RÒ&’c€hGèŒ=B“\$JB1)p¬«xl¨TÀ´ÔVFÏ9)˜50‰¬I\$Äàz-ª‹±–7m•l³æİ†oY=N„ÖÖáIH×q ¸ÌÄC\0`ŠI}ÄbGÖ`ˆp­T&0&Û\0Ì“«YY5åÀ+GÁJHÒq¯\$¦(Æ/×?\nJI²Xd†0èÙˆĞu:èŒ«4Q|1'%!2œ+`ÚDĞBJ¸0¾r›	øJ¤i)¢V'×Ì“'’O “ä¯Î&XaÙLWŠJ\nÅ\nkä2ÅJ‚Y ~f0\"¿ëj¡,«ZkT4Š0ëÍ½ØI„é][®`Ò¨RÅ©8Ãß3€\nk( ";break;case"sl":$h="S:D‘–ib#L&ãHü%ÌÂ˜(6›à¦Ñ¸Âl7±WÆ“¡¤@d0\rğY”]0šÆXI¨Â ™›\r&³yÌé'”ÊÌ²Ñª%9¥äJ²nnÌSé‰†^ #!˜Ğj6 ¨!„ôn7‚£F“9¦<l‹I†”Ù/*ÁL†QZ¨v¾¤Çc”øÒc—–MçQ Ã3›àg#N\0Øe3™Nb	P€êp”@s†ƒNnæbËËÊfƒ”.ù«ÖÃèé†Pl5MBÖz67Q ­†»fnœ_îT9÷n3‚‰'£QŠ¡¾Œ§©Ø(ªp]/…Sq®ĞwäNG(Õ.St0œàFC~k#?9çü)ùÃâ9èĞÈ—Š`æ4¡c<ı¼MÊ¨é¸Ş2\$ğšRÁ÷%Jp@©*‰²^Á;ô1!¸Ö¹\r#‚øb”,0J`è:£¢øBÜ0H`& ©„#Œ£xÚ2ƒ’!*èËÃLÚ4Aòš+R¬°< #t7ÌMS¶\r¯~2Èú5ÄÏP4ÅL”2R@æP(Ò›0¤ğ*5£R<ÉÏì|h'\rğÊ2Œ’Xè‡Âƒb:!-+KŒ4Í65\$´ğAKTh<³@RĞ°\\•xbé:èJø5¨Ã’x8ˆÒKBBd’F‚ Êà(Î“¨õ/‚(Z6Œ#Jà'Œ€P´ÛM‘¤üğ<³À ”-ÂùoÏhZŠ£Âƒ-Ÿh®àMÈ6!iº©\r]7]¤«]ÉíàÙl•5,^ÉĞ]|Ü¨`ÑsŞ˜¡iQ©xô”\r@P\$Bhš\nb˜¡p¶õ½bí”º²ˆ,:% PÙ&LS *#0Ì*\rTš2ÈÎí©@\$Ï*\rì• 7,ôÄ:Œc49ŒÃ¨Ø\$lÅIº(Ã¶¥ÿ4ÃªaLG6.ÔÎ\rék!ŠbŒû¯q4C246éÒ\0@ë PxÖÖ#)@&ã¨æ8g\n<—ŠŒsÊÍîÒïè\r\"·=PPÇ2@ã#Ô‰»X2ŒÁèD¤Aóè\$£pÎã}3&ØCÀ–^„\nÁ|nQ«EDgˆ\n^&¾(ºÿp/ÅËÖáĞ±¨/J\r è8aĞ^ÿ\\ÛkP\\á|õL|Æ7ı8æ	#hàËÉcpéØvRõ\$›h@¢Bzšp)õ	 Ãx¼–9<*Œ’d”Ã8o!)eÆ‚C%L€€;­&]`8rr)-\nÌòˆ£HiO5¦´ö¢m!(t`ğè0Â’Á\0c/P(4‘ğæKÂ7§ĞĞ¡‚,T›<<‚VºíÄ\$\0@\n\n@)#¤™C‡`Şny/i¨B(gH9–3\nA“Ã6iO¸ #ä€;©ÆNTP2g=¥\"2bLÉ©:èÉ†!XÌnxi`ç‚H;b\n|‰-Å;×~£I¡\nT	l—„’&LY'\r(P´„…!Ôx ¡Ä:™¢~arÏ•.ÃÃÉò4qàÿ—Ù	Ñ<dÑ6-¢nxS\nÀ-40ÔuÔ¼Š20L¸²†Hù&<\"Q\"<r‘”[Cl¶T†5ÌgÉ¶PP3‚\0¦B` ËHn‚¤^!hQ²¥ÂJPAÈ™‡)¤Rc\r'PÊCàİCÔ“¶'¨L©I\n.ŸKÒ’) ;ú<j”{ù(Ç £0•D	\nt¥Òµä\\éu!I‹â™‘ºk\$H¢şB”½I–OC-*’,–¯úˆ“h\ni46°×2M©8/E ŸE°êoÈYF%á~@7OáA´\n¡P#Ğp–s›/n¸¼Fi2¡êj0†w00«]…õ@^kş½’PÇQ€M\$6A/ÖaL9.±6¥°‹al3c€dj¤›:(JK‘t.Éà&¡0ÒƒÉd6ÄÆ\rÔğ‹´ OáÍ€ª¾¤'\$„\nÛ¬‚8ÎÙ S8ŠR’İoŒäı«dô’’ğ˜ç‘ ¥\0¹¬¡\\Î‰\0006+XÛhË° 5¡é§5'eëâ½4ª+ Ò¯u˜0çÑÂ ‚Y !‹\0éÆdKb‘(IV¶ºo2‹~d=±\rşÑ/û|ƒÄ¦†È’‡\0";break;case"sr":$h="ĞJ4‚í ¸4P-Ak	@ÁÚ6Š\r¢€h/`ãğP”\\33`¦‚†h¦¡ĞE¤¢¾†Cš©\\fÑLJâ°¦‚şe_¤‰ÙDåeh¦àRÆ‚ù ·hQæ	™”jQŸÍĞñ*µ1a1˜CV³9Ôæ%9¨P	u6ccšUãPùíº/œAèBÀPÀb2£a¸às\$_ÅàTù²úI0Œ.\"uÌZîH‘™-á0ÕƒAcYXZç5åV\$Q´4«YŒiq—ÌÂc9m:¡MçQ Âv2ˆ\rÆñÀäi;M†S9”æ :q§!„éÁ:\r<ó¡„ÅËµÉ«èx­b¾˜’xš>Dšq„M«÷|];Ù´RT‰R×Ò”=q0ø!/kVÖ è‚NÚ)\nSü)·ãHÜ3¤<Å‰ÓšÚÆ¨2EÒH•2	»è×Š£pÖáãp@2CŞ9(B#¬ï#›‚2\rîs„7‰¦8Frác¼f2-dâš“²EâšD°ÌN·¡+1 –³¥ê§ˆ\"¬…&,ën² kBÖ€«ëÂÅ4 Š;XM ‰ò`ú&	Épµ”I‘u2QÜÈ§sÖ²>èk%;+\ry H±SÊI6!,¥ª,RÆÕ¶”ÆŒ#Lq NSFl\$„šd§@ä0¼–\0Pˆí»ÎX@´œ^7V®\rq]W(ğëÃ˜Ò7Ø«Z•+-íE4ı\"M»×AJ´*´²ÏƒT‡\$ŠR&ËŠHOÕéÌÍTó¾S­Êúİ\n#l¥Ğ…ÄŒˆ#>ó¡€Mñ}(³-ı|³Ø\n^ó\$’âH¹A j ­w#óW#égt3ì’€‚cikühôı¼õMÖ›C\$5ĞH&f]ÜĞ«Î³íc\"’¨(]:­ÄDÊ’ÒÚ†”\"*£qÃ	=¿d©„6¯ª}şº²*â‚,eŞ¬CRÂòºNÉâ\r6 Av k/jhºkºşË¡,H‚+¶lËikµjû)­)işå ìK6ñ¤­ª3¥ \$	Ğš&‡B˜¦’`Ú6…ÂØóÏ\"ëE›à¹Õ1FK‰Ş\rƒ äÜ·a\0Â98#xÌ3\rÊğ©Ää‹è’İa„\nƒ{ˆ6Œ#pò¶(ê1Œnpæ3£`@6\rã<\$9…€ååŒ#8Ã	%ş6ÂC«®aJÖ¢,s=O9Á\"¦)ÒœZkø²ì‚ÒÙ7n­`Æ•…²4D#&„TµŠ2xOb+¯íá›r„\rò*9á™]UŒ„Á\0A 7#ºÖBÆˆÀÀÂo] f ˆ´ |àtBAœğÂ‹[(CKĞˆšÂ\"Í£†DÅ¼²6wºOWzçC-Ô6D¨`1B	¨äë‡#Š’Pr_+8—h“!l/\rÆ†€è€s@¼‡xìƒ#wHÑ†p^CtXrc,€_\r˜>	!´8°Û ¤=‡êÜçÈó²×ÉÑ 5œÒ‘‘ƒÈ„¡¸:\$ÖLÚ¢¬IäP‹,²b|]AˆiüAB @â©<‰\rìAƒ‚C:Y\0€;œ§¬pFp9HõòC4]HOAé=G¬öÒ.˜§dèƒ‚Ã3É\0ÒC`s-fa”ÄÀ[Lêâ]Àº—ÒÛlxDaS¥Òn!A\0P	BwOdÊœccÊ\0ò“äºP‚È„³ˆqAÊ9•|¤@äyÛGét=€ïGy2~H4š›ST[T¦”¯¡â2–I­4f1m™Òk—Ò‘=ğ§•!¢U† \r€ª“ŠqJ(¬?EøİSP\n	\$„<»ÈWÉÃH(è7I“´sİ q§9 †ddaz„±xìÈ	ÆöÔİ¤IæÓ#gUR‚ˆ !<)…IôêLá3kõAu¥‰ì‚©¡)€DÕÔOf¶ª”úwå*«“Qd©Ij¡Pè§ØD¥efq^–“zşŸÔUU’…İÀÆò^d\rñåÙ\0ÄC8 \naD&\0ÍFÉ…á*PG’¾CLŒH¯–¶ÖòDŒ4=4£µºDŠ€±UäF‚Kw…ß2FşkÌ(oAqW~—X†ÒGWÊõ\\÷z%(Æ6LİIm-®ı†Şİ¥¬¿ëC7¼}/Ú	»÷ø·`Dplq4‰¤Äàlı´%Ø†KgzÖİI€(#\\€Û’È|¨¸*…@ŒAÂ»…}	”%ÿh)Á<©ÉSVù~qDnù™?3å‘Í‘2¥Æß ÕL‰“•\r).†”§JÂ¼¶¥»¥¦flÅ³’\nE@PM“¤3“]\\k•«ph4\\FĞæ(5l±j^9^œLËwfùƒ‘¼Ë¦!ÊF5z§µœVâšğ3©H¼µ+e§”Ò£Iİ¶0bÊ±ˆäÚY%b42«Ê(|ò‹´ÊC/Æ«Kx\$‹\ri¢×š±\na”åÌ8¤èjP±§ h!j`-ÍD)í1‹²µO,ÙmÀù.ÄæfÏOI\"}g€’\n\rpÂ„É*\$‰ğ";break;case"ta":$h="àW* øiÀ¯FÁ\\Hd_†«•Ğô+ÁBQpÌÌ 9‚¢Ğt\\U„«¤êô@‚W¡à(<É\\±”@1	| @(:œ\r†ó	S.WA•èhtå]†R&Êùœñ\\µÌéÓI`ºD®JÉ\$Ôé:º®TÏ X’³`«*ªÉúrj1k€,êÕ…z@%9«Ò5|–Udƒß jä¦¸ˆ¯CˆÈf4†ãÍ~ùL›âg²Éù”Úp:E5ûe&­Ö@.•î¬£ƒËqu­¢»ƒW[•è¬\"¿+@ñm´î\0µ«,-ô­Ò»[Ü×‹&ó¨€Ğa;Dãx€àr4&Ã)œÊs<´!„éâ:\r?¡„Äö8\nRl‰¬Êü¬Î[zR.ì<›ªË\nú¤8N\"ÀÑ0íêä†AN¬*ÚÃ…q`½Ã	&°BÎá%0dB•‘ªBÊ³­(BÖ¶nK‚æ*Îªä9QÜÄB›À4Ã:¾ä”ÂNr\$ƒÂÅ¢¯‘)2¬ª0©\n*Ã[È;Á\0Ê9Cxä¯³ü0oÈ7½ïŞ:\$\ná5O„à9óPÈàEÈŠ ˆ¯ŒR’ƒ´äZÄ©’\0éBnzŞéAêÄ¥¬J<>ãpæ4ãr€K)T¶±Bğ|%(D‹ëFF¸“\r,t©]T–jrõ¹°¢«DÉø¦:=KW-D4:\0´•È©]_¢4¤bçÂ-Ê,«W¨B¾G \rÃz‹Ä6ìO&ËrÌ¤Ê²pŞİñÕŠ€I‰´GÄÎ=´´:2½éF6JrùZÒ{<¹­î„CM,ös|Ÿ8Ê7£-ÕB#öÿ=‹ûá5LÃv8ñSÙ<2Ô-ERTN6ˆ¶iJéáÍ„J5ÊR²ÚUìD”8òÚ­hg·ìl\n³ˆåe®	?XÇJRR¥BÙ²JÉd—KªÒd[aß¥¶¨ßõ‘]¬‘v¡Yß[5Õ†ÁµM)WV+„£\$e}æ Nó½¥˜{ìhÌ/xòA j„Ÿ «îmÛè2§,6Š›MÄºÛ°\"7œ³ÓşŞı+¾Å\n^ÕêÜµ'R.\0§ôRŸ@Ş•*±<ºµıë[î|uhZÛn	píÙ]qm0Îw\\œ7gÃ«ïQW¹àx^'hµŞ?º².8G±!vığ÷Ñ¢àÄ>z»|÷¸úSf{ÅÅö7wŞˆ_ÀŒ8Ùï%B\0ÖQÑÍA \$ šAĞS\n`(2@^Ch/aæºåP‰¶¨y³óz¢JAJQ­\0006,€vÎèaGˆ7†`Ì@e8(ˆ‹B¬æ×XÉœğ´³<îÙó\r…«Ä@ŞyCha\rÁäUDCc=áÌ3PØ\ngIÌåg) GFşR@u>à 9‚’¼Â˜RÅ Ù˜e^á_×QnÉ‡›Òhç’ÈÉ„)—àÍ!£IÏL§8D¦‹Áh}hiµÉõiäbï%\$áW:D´”qH3åä·¥Âm+\"”*ˆ>U§ãNúa>™UF’A\0A‘à7&xÚÕ*£‰œÀÂw¡Øf ˆÀ |œÙtIœğÂ»í\rô9Õ¥#Ö”D9lÑ±*Ñ,‹{1DE`®Â&×2t2«¶fĞìÔE”á58päy“úMé”\0ÓÔÕšá¢lÍ°Ğ p`è‚ğïIÁqE™‰œ& ÎÙU0e,­R‚ù¸ÁğI4ç±Š†àé9g;Tü†öô|ªa\rgˆ4§ÔÏfm>22uÀ‡Ğh*“jJ„\$ùõ–c0A¥ğ›P¼‰A^\n ñÇ8•( ç®3†#Ä<ÄLU½ÍC“ÌaŒq–3Æ˜é\\ÏÉñ­„€0±P@èÃ*œA„68†¥ØJ¡P‡7¤¤¥TçXŞãr\0PP	@¤U‰\\UİÍ°Aî¥K6g³-9€´g^GÕ,Í­óŒøSÎzOYí­é=‡ è|ÚvOP¡‡{–°dµ°&| ö_V‘HV•ô[ËLWM¡^OÁW9È	) 32A¦µ·Õû¾+§Ñ®lˆ].Ö2­ºÓ-èÖE.	8oMÅí‰2fOÉ²v‹à+0“²^I!F„ÂíŒ2)²`¿)â^»ŠrñVu\r[è[ğ\r´¿—„¶dLW‚I'p@ÒŞ\"xN!º£Ÿ£áÃˆu=éà3&Û2f\\A¡çå•Xò†œlUÑOÇ¸à BÎöQ¼óÊëí‘€ Â˜TÂÈ‡\0Ï)­3Ì¯3“Bàq]_Q8P˜Òª°†*òT³æb`õ`i¤@7`ÒÃ¨r>Ì³ÑpËpÏ\r£@‹J^¡1‹«L7Æ-EÒ„Q+è Z0¢†c§ªk„`©k\"Óz\r&>G\\‰‘‰L¥‰aÛÀ#~\"Se“r¦‘|gÚ\n’Zò<›á„—Z¹‚2ëà¬XÎ«‚¾Yà¾œåµ6ÎÀ]` \$ŸpÛhĞ<.J»lıµ²d‰^oê£^ìæwŸ'ôÒ¸=Ò¾çª×§šÁ~e#oëíİ¸²İä šN_/‰¿›+_B?¬€Ø\nÃ@a¬W®¬¦B¸µ£Í*i^×&¡Ìdñ]£ªe\n¡P#ĞpÈf†6I;ÉúflTu*æ–ÍNqŞÉï¹5¥ÎİíGUÛı}ïËOÛ’K­‹²ƒÎ¥_\\İ~UëùzóÆã§W4:t¹ÓJ}ïŞû#q@“€0›6ëí.BÂc¯IL0w]œ§(yüÙ™›pÃ?;HÑ‚o%äå~[Ä~‰¦-¶\\’'fuÛaäxR1H2†Í4Zbëş3ˆº;ö»{	g®üêğÌß*È„mfé@¨ªÊ¾ı[öÁŠ¦û¥É\rŠ7f-­ ¯ÍAÉ!Ş5MÀ+ãYÆĞs'Ám•|Ù½RM:‚êËµ¥w>ËS)yç¾®YÎ§UüËTé¯¼áÂŸÑçÜ2\$¸Rù÷C(s5¦ş•nŠõ/HèN¼ÍÏPŸˆ”éÈô/îQØÄÍŞ¿T\"'¨sâÎ1¤(…§0”.£eÂ7'Vı°ıÇş[ÉBS„QìàK†‘ODJ ";break;case"th":$h="à\\! ˆMÀ¹@À0tD\0†Â \nX:&\0§€*à\n8Ş\0­	EÃ30‚/\0ZB (^\0µAàK…2\0ª•À&«‰bâ8¸KGàn‚ŒÄà	I”?J\\£)«Šbå.˜®)ˆ\\ò—S§®\"•¼s\0CÙWJ¤¶_6\\+eV¸6r¸JÃ©5kÒá´]ë³8õÄ@%9«9ªæ4·®fv2° #!˜Ğj65˜Æ:ïi\\ (µzÊ³y¾W eÂj‡\0MLrS«‚{q\0¼×§Ú|\\Iq	¾në[­Rã|¸”é¦›©7;ZÁá4	=j„¸´Ş.óùê°Y7Dƒ	ØÊ 7Ä‘¤ìi6LæS˜€èù£€È0xè4\r/èè0ŒOËÚ¶í‘p—²\0@«-±p¢BP¤,ã»JQpXD1’™«jCb¹2ÂÎ±;èó¤…—\$3€¸\$\rü6¹ÃĞ¼J±¶+šçº.º6»”Qó„Ÿ¨1ÚÚå`P¦ö#pÎ¬¢ª²P.åJVİ!ëó\0ğ0@Pª7\roˆî7(ä9\rã’°\"@`Â9½ã Şş>xèpá8Ïã„î9óˆÉ»iúØƒ+ÅÌÂ¿¶)Ã¤Œ6MJÔŸ¥1lY\$ºO*U @¤ÅÅ,ÇÓ£šœ8nƒx\\5²T(¢6/\n5’Œ8ç» ©BNÍH\\I1rlãH¼àÃ”ÄY;rò|¬¨ÕŒIMä&€‹3I £hğ§¤Ë_ÈQÒB1£·,Ûnm1,µÈ;›,«dƒµE„;˜€&iüdÇà(UZÙb­§©!N’ P‰ÁÍ|N3hİŒ½ìF89cc(ñÃ˜Ò7å0{ÉRÉIéF¬Ü6S’í¹³•wÜ¨ìqp\\NM'1İR²Ÿ×påapÔ:5õ…Lií`³ºIüIKH‚¿Z c#Û‘Si©h,~­CN³*©œ£#¸VK·™/µÛ¬Œ‰3•\r%Êˆ<¿€Sâ¨^|8b¬ MŠ»]ß6úé;hÓ¥iõ‹³d01q¯-²ss­sòT8J+*gKn+´ê»¹£xt²ÂÅÃ¿c9©Û*¬á±q¤»»>ê)ÖJ®ôuRáÌE¥«¼öüÏtƒ‘•L›»u_;v±üÆSÙîúº®ØÄH\$	Ğš&‡B˜§xIÊì)c3ÕvˆP^-µeÁj]“>.))á@4Z‹Å(\n\rĞ9\0£Ğzƒr=á¼3`Ø•C)Å9¢,¡-Å¤ØaY{‰)Ş·®†ÈT\rçÈ6†ÜA\0ue!Ô1†3øÃ0u\r€€6ğÎ•C˜,?ÁÊÎR¨ ‰ •¼†ÔªP((`¦\r0FàÁÎúºVdõS0¦‚3z:¥Áë¤£`m\n©{Iï,rw©¼:H±Í¶\nmÕÊ„h®%@!9¿[„ıÍ¬”4G: ^o|¬CØšèfc¡Õ•%`@C\$N\rÉº!6XÊƒ\"n\0ğ0¸\$è\"1\0ˆ'¦>¨g€¼0ƒâ°á»+M…%^ø¸@Şñ±ê¦?¹5 KQ-MQ³HÑL„s-ñò;£¸ò‚jw@¬‘C5¢“hx¦	(¹G)CD§•! :@àÁĞ/áŞzàÃ&`ÂrN!œ†Pİ?Y<şeL°Ê æ‚Hmä6Ïàé,å«¡¨7·“ş!hk=á¥B¦è[&Ãpt|+ÔÕ²§J«CW&K‰½.¤hh=á„1ËX¹ø‡aˆ÷‡İ\$ƒ•\ro!„3Mµ\r!´Ş‡0îÃôÙNP9ş¦J\0000ĞĞ@ç-\r!„6+÷‰4LyÏCQ­V¹•`§	Õ_:ÊÍÍÖEF«Û‚'en4…\0\0(1\0¥T¿2à¬	é;n‡qr&*Vp‘¡3*¥\\6Y&é¬±?ÇÈúcğ~ƒ+yPaÈ:ÔŸSı\\‡¡ŞÌ ø\n‹#yPŒgJ2ÇÈÏPytv²¼¥•luUÑÎ–:–JªÄE…t¶c„l–gG4íºéˆÜy9[‰¸¸è…ÕñX	\$”<@Ky>)ı<ê,‚ì!Ôş'ğÌœl—Ÿm’ yıUáêxªV}C»L˜íBâsÕøéFºJÔ\ršel®“ÚS/±¦[—4…*’gtm¶\nId\0K7¤†J.¨-DVì¹àâ§bËsş!Œn+:[l®yáv\nÅh4H¬¨O=ŞpºĞ°ß=Á¥A¤3ÒĞ¢\0f²à€ûÊPŒ+Ä.o!¦…(H•{¯‚€MÇ¹94t×Õ­‘hAfHÅ°Üâ[*9Î²÷9¦e˜K\0—²&á/ózØäaõdtŒl‹Îedì<õS››‘ãÃ™ñ­µçYˆ–3‘	 ¨Â–\r€¬1ÁpÆğñ\09ñbœfrTÊÛ5¥`#d°Û%ı<‰I°*…@ŒAÃ“×+ˆ˜ŞÚMSˆ¹èã›fF”YÕª¿—{Ü\n\nÜvg|íœ¨U‹›T4†`ó¡¹ÈmÊ4*WwpÒ°t=Ñ0õ\rÓ8\\h¡03Ób–Téáq¯Uêvw¨Ns>šBã5¡l·ÊY~ŒÁ	j¥ÿŠŠ±X	˜ş&§ò@WòÄ¬«´hØÒÁplMÔ70NÙ¬	×è—a% Ê~i­™+(QĞAÃb,ÊÎ;îÔ¬•İ‚976>é&»µ³¹h]xlá9ƒËwîójI\\.yxNÄ ";break;case"tr":$h="E6šMÂ	Îi=ÁBQpÌÌ 9‚ˆ†ó™äÂ 3°ÖÆã!”äi6`'“yÈ\\\nb,P!Ú= 2ÀÌ‘H°€Äo<N‡XƒbnŸ§Â)Ì…'‰ÅbæÓ)ØÇ:GX‰ùœ@\nFC1 Ôl7ASv*|%4š F`(¨a1\râ	!®Ã^¦2Q×|%˜O3ã¥Ğßv§‡K…Ês¼ŒfSd†˜kXjyaäÊt5ÁÏXlFó:´Ú‰i–£x½²Æ\\õFša6ˆ3ú¬²]7›F	¸Óº¿™AE=é”É 4É\\¹KªK:åL&àQTÜk7Îğ8ñÊKH0ãFºfe9ˆ<8S™Ôàp’áNÃ™ŞJ2\$ê(@:NØèŸ\rƒ\n„ŸŒÚl4£î0@5»0J€Ÿ©	¢/‰Š¦©ã¢„îS°íBã†:/’B¹l-ĞPÒ45¡\n6»iA`ĞƒH ª`P2ê`éƒHæÆµĞJİ\rÒ‚ˆøÊpÊ<C£rài8™'C±z\$Ø/m Ò1ÈQ<,ŸEEˆ(AC|#BJÊÄ¦.8Ğô¨3¸³>Âq‘bÔ„£\"lÁ€ME-JšİÏìbé„°\\”Øc!¸`PĞÍã º#Èë– ­ƒ1 -JR²²ÎXÊÍ¯¡kğ9±’24#É‹Tà«ë’éˆõú:éÑã-tŠ1Œ‚7e¤x]GQCYgWvŠ3i¥ãe¬,£HÚç¹b˜t\"Ğæˆ‹cÍä<‹¡hÂ0…£8Î\nÉz![”àPÙ%F¦£÷:|²§Ãš}I8¦:ÃªŸ‚éğ×…¬Ø3Ãõ„zv9­ÈÂÍÇ°Ü‘>:,8A\"}kÑâ#ˆ4h¸æà¸a:5¸c–]58ØŒ€#È3Fb˜¤#!\0ÔÏØp@#\$£k2èSí\$â~O”Ñk,Ÿ9&~Ù;y±b“ˆ#\"—èĞ¤Q¹*xz|ÑÔ‰d:²ì\\ZİZx‹Ê3¡ŠÏ^úX¬« Â8G”³^^,¬‹\"ã}²ìíÈçæ*Œì2¡`@6/ Íhz*1<ó9ºJ¡Ê3qÎ2Õ—œr\r×\\C®´À“‚‡;G˜qbÌ³igq¼\"4ƒ à9‡Ax^;ıuµ»£ÁrJ3…éã.&2øÜòC˜})‰Ÿ`Å]#¦BhTí»ğÙƒ«(7\$u^R¦qÌùÅd¡±=bÜ‰2>V„‰Ù\$.„×2A3\n˜6r`GÛi®=m©¶Ò.É Khebš±£ñÚD¡ÈÍ¶BYC¢y\$&L5Ä2P(n@ï\\º‘#àĞÉ/ a@\$‘b\n/ Dt‚‚ŠÕU›TÄ}”â TŠ lnå†2ØÆ ²‹*hZ%Ÿ#cJx.XO¡g:EÈA,%Ä~\nÎÒáèriĞ€6Â\$	a8i\$ä¤•9L!d,Œ‹ª×¡° ,0X®&ncµvä\rF‚=’\n‰qè“˜£3`x n¯°9x¸´–\0r§Dö´’lOxyd.yŸ¸–‰;„eà<—ƒ0xS\n†´ge%ÃÉÇdE²g¹¢¢EĞ‚lST‘äJAu!ŠA4qÓ4”­Ä À`Œ\"±\$\r“É’)©5{F\naD&:â•(f¨¼9&z*s~}X©OA¤\rRãˆc‘Fˆ“šcD’FñKR2/‘”Š+“(t´riRQLö–›£A&²Ø”F²Rx#P)XBTòº2F„ô'â1—{p¦„\"k‚K\r€®%—õ\r4’T*`Z˜oˆ%ê°ôà©>ƒéBÓÚ;(ûk”­Éœ-šˆ¡Œ-wœQ½JfæK‰s=¯dÙ®€ˆš\r‘Ê(#ä‚YRA’ÈÀ‰„úş©ÑU'L¬ë0Qõ0ÖüõÛÒoCH0§ö@È™\$—.“X¾›xŸN’1™J¹·–âğê–\"¸QõCÔ%´gë©„VÖ1t°Ş²wŒr½K«tÉL‰8áïØ‚åk}º÷˜7ÒÃ	n3É/ÚÚ@ä";break;case"uk":$h="ĞI4‚É ¿h-`­ì&ÑKÁBQpÌÌ 9‚š	Ørñ ¾h-š¸-}[´¹Zõ¢‚•H`Rø¢„˜®dbèÒrbºh d±éZí¢Œ†Gà‹Hü¢ƒ Í\rõMs6@Se+ÈƒE6œJçTd€Jsh\$g\$æG†­fÉj> ”CˆÈf4†ãÌj¾¯SdRêBû\rh¡åSEÕ6\rVG!TI´ÂV±‘ÌĞÔ{Z‚L•¬éòÊ”i%QÏB×ØÜvUXh£ÚÊZ<,›Î¢A„ìeâÈÒv4›¦s)Ì@tåNC	Ót4zÇC	‹¥kK´4\\L+U0\\F½>¿kCß5ˆAø™2@ƒ\$M›à¬4é‹TA¥ŠJ\\G¾ORú¾èò‚¶	‹.©%\nKş§B›Œ4Ã;\\’µ\r'¬²TÏSX5¢¨Ü5¹C¸Ü£ä7Iàˆî¼£æäƒ{ªäã¢0íä”8HC˜ï‹Y\"Õ–Š:’F\n*Xˆ#.h2¬B²Ù)¤7)¢ä¦©‹ŠQ\$¹¢D&jÊÆ,ÃšÖ¶¬Kzº¡%Ë»J˜·‘A Q\$¨B22;`Õ Ñˆ ¨ÑN™¨Râ4J2lòæ›2Rí?\n7ÉÔËTE/dô™Ñ&‡\$óØA+Êì\"<O+¥>„äp7WÎBÏ`V\0Ê<;Ãpæ4örÖP ôå øš\r2¨	„ÌT8—ÒŒ™ìš²(Äb4QÕ„Úø]	‰x·)¤a®¯dÒºÌÌT«C)] ¢c\"Ğ,IxáPvÏaøy\\ñd_S\"4—ÀPH…Á g’†7«D5eÒ4XË\n8Zİ¡(Õ©3\\E*ÚE­l™Oh|h•ÔF©æ\nÍ÷¡hÚ0º-u0ZA­Jš’?ên]¢N\r¯%rÊéNëÖÄ¯k…A´)j•ˆ?L¶¦¦£É&ƒ…ÀJÒÕí*NÃ¶KÒÍˆ°÷‹üª4;»s¼ï{B•¿7|b†¤û…«\r·Ü>ê‡1‹ZSiFoY˜th½GOj(Ò˜ZÜAxuÉÛº<]¥C¢ZˆC`è9N†0N@Ş3Ãd@2Úpz²ƒUİÕç\nƒ{—§ÃÈ@:ÙÃ¨Æ1º£˜Ì:\0Ø7Œñ\0ç0ø~ğÂ3ê¼AÁ„l@:»Á@æ\nKYšr*¤ºÖÂ˜RÆu­9À\\Aã.‰à£Ep#â+…”hˆ’	X·-dGdJßSm‚„ÕÑb„šsˆğ*Tfuƒ2Â«=‚\0‚ĞnG)„1­È „â<ÌAg@ù\"¬@èˆ8<á„=ü®˜*dS¸É4¸TDbaEÈ!,Á†Ú]RúaRŠ`6%É…”.\\dÀÍ”ô2å ƒ'5!å’”šRJˆà<\0ÒòR¬J‰¢'E\0Ğ p`è‚ğï'Ápaˆ=£ÀÎÃ(n•2T¬õ¢âˆsÁ\$6‡¤eHt‹Qq`KƒÀØQØ!„5œ€Ò“ÑËÜ—1x¨—A.ÜZÉS!¬…”÷záÉI]pˆC@ĞrcŠëDs¢úCÈæ‡)pÂƒfÉ-ñ¾WÎú_[íFó˜ğy¾F¸HKÒCb~`FlÛŸÇDÓÌÜ]Ã@ßÒ’›Å¸ \n (Ú“Á³UéğpS ñ')Îer&r©5„tw*\">5'&hbJ¸A ¸“À†´bâ‹\\åœÓtN˜eaI49C¬x’BJ¡¬;Ô¨CÛ¡Lk´‡‰b–äĞ˜²\"8òÖ¨)Á¹>ÅÙ}B‰¡{ˆ(¥¿CzHë¡½Rq¸ÿ):vRM˜…šá@÷äctgKÄª5–`o—jw+°]>“À’EÃÉÂ4°£”’’n˜'„ë<âNªJÈì6ÃéG–Ià•4\rõ¤9ıTÔ=Mµ­äÄC‰!S2¬¦‹ğ¨å	áL*34K«†=,ü—2È,–®-Ç*„Ï¸û¦,ÖíÅĞ/d®\nû4¤D9n’S.° %Äà© t^4MÎ8h1†nvŸ\\¢01Î˜Q	€€3T€@t\"`F\nCÚ @eªNÂöªÖ„rqÑëUZ©¢j¸êT˜á;œ#öíƒ)ÌJhiQ[Œx¨_bÌFPV<kÆ	‰\n’²İÒVo—z—›ââàœ³ŸÆâÆ6|vè²-ÉG%0x_“r1Ê9Ê?Œ¡‹a……A\rá†ÀV¤ ªdºå¥±TÔƒ·•ÌŒLĞò)¢Ï€ ƒƒl;IS§£pª0-\"ÙÄBO‚¹7N]böÒ¦ñ‡W+y¹Fó¤]¾“ZúX¥i‡/¦ÑSnÆ¬TÜj*ïqÖ—7ÚeH¦­;ŸM­\$Šà’k~Ò/ºü6&‚àß¢ÀBlÀ\r!˜<˜òN]HCa·„¹€Ò,—Áº%7\r*ôJÍbô •2˜˜a§+lMÓ@ºÆm¦nIµ)=Y×¢t\$! şn\\ÙÅÅ€ ˜ğmG‰ oî£‘Ğ)©\\çt¾F«I±šfåÅø0}S³h(ëè—°[MÓ&¬ÒLÒáò-CÉÃ\na”éN*”¸1vÜ*(J×\rNíÄßÑœS®f¶C-lµ}ßÕâ.îÅ4b>±‘¥ÒM[5¨Şr”¬*D";break;case"vi":$h="Bp®”&á†³‚š *ó(J.™„0Q,ĞÃZŒâ¤)vƒ@Tf™\nípj£pº*ÃV˜ÍÃC`á]¦ÌrY<•#\$b\$L2–€@%9¥ÅIÄô×ŒÆÎ“„œ§4Ë…€¡€Äd3\rFÃqÀät9N1 QŠE3Ú¡±hÄj[—J;±ºŠo—ç\nÓ(©Ubµ´da¬®ÆIÂ¾Ri¦Då\0\0A)÷XŞ8@q:g!ÏC½_#yÃÌ¸™6:‚¶ëÑÚ‹Ì.—òŠšíK;×.ğ›­Àƒ}FÊÍ¼S06ÂÁ½†¡Œ÷\\İÅv¯ëàÄN5°ªn5›çx!”är7œ¥ÄC	ĞÂ1#˜Êõã(æÍã¢&:ƒóæ;¿#\"\\! %:8!KÚHÈ+°Úœ0RĞ7±®úwC(\$F]“áÒ]“+°æ0¡Ò9©jjP ˜eî„Fdš²c@êœãJ*Ì#ìÓŠX„\n\npEÉš44…K\nÁd‹Âñ”È@3Êè&È!\0Úï3ZŒì0ß9Ê¤ŒHƒLn1\r?!\0Ê7?ôwBTXÊ<”8æ4Åäø0Ë(œT43ãJV« %hàÃSï*lœ°ù‡Î¢mC)è	RÜ˜„ˆA¯°íDòƒ, ÖõÍB”Eñ*iT\$“E0Ã1PJ2/#Í\"aHÇM¢ˆZvøkR˜Öà—ìRôRÁCpTÏ&DÜ°EÑ^”­G^§ÚI `P¢Ó2´hî¬Uk+¨i’pDĞÃhÂ4“N]Õ3;'I)ÁO<µ`Uj˜S#Y†T1B>6‡ZêmxÈO1[#P+	¢ht)Š`P¶<èƒÈº£hZ2€P±„½l«.ÌCbĞ#{40PŞ3Ãc¶2¥ÓaC3aÅÙOf;ÅèÏÎk†Z¢xš8¢¤Š|î½ C¾Íæ­[46E¡`@‹”s2:õpŠÆêÍYá8a—PPÜÊŒ;,Ûs§¦´(b¦)Û¨ÓÃq4³a¥3šH1J5—EXê—dr;¶ÁCÄP3©cE05Àã5\n:Òk°‚2\r»åÃt¨Ò2>Á\0x¡èÌ„J@D‘CúíŒáà^0‡Ép¡šÔ©Q@é»Jjw HPé~:uÍ`W\rtJh¡Hê¸]\nÕ`‡U›0pçU0ZõÃÚ{ :@àÁĞ/áŞàÂóp.?!œ¨xJ¤’”\rÀ½î‡0|aÏQ\$È¢>÷ÌúLêø‚–¨r–BE®I’2ò«ÈšRh¡à 0ÂÃ¤*İŠÂò€ÃöxÁÈ6†U C2‘Q¡Ì:†0Çƒ0uŠÁ°7¦‚	é4@hŞ.VºõtQ!±KB¢â\$CEèÅ£Têháw=¡n‚‚€H\nÑt¢<%Èâ3HDÈ7£´.ŠpeŠIĞàƒIÚP!/9\$ÓòAQî6x¼RÛÀ oE½Ó<Ğ‚œj¢Qk¸]!¢8°J’ÍÀ€;“œÅÅ\nMõ·|Z¸.ÇŸ§–%1'ü\"\$H‚ƒvdÛ’\\HykG­éË(’™k5@ítÔ dÁÓyo6P¨Ò:¡È,l@RQ¡X~Ú“b3\$…BXÂ€O\naPÓ‡Vşá	Ì`n&’%ÌL!£.&ääœR{8·¥³\"‹¡K%†¬S ¡À’fq\0‘Üîn†@8¸tUâ5.€\n•`Œ\$™Ïp°çÉĞÆ1…	'Äöj\$I»\"	µß÷qXäÛ¬up:VtÚtLIH%ÎELRı	 aiè]‰Tè¥ ´Ej¤ºß‡mü´%xrHI„G¤˜”WXŒ›ß«mˆâèX˜Ô”¬ˆ U\nƒŠÜ«\\Â§¬È™:\"Í«~›dx†¡WZ`='(ÂÍ2ötÌ¥vAD:©ˆI€U‘0¡U—×(‚®U¯5ìœWëVlh»fl¢›VœÔ+…ÀµíQZ©ƒfœÕ -%¦œğ  …¹K¨GI@æ@É'V:.Ähn:á†«N%F]6möÖ+t¬×\"æ]ˆóÛ‘”§)¥EVlÙT<:˜¬¿¶ìÂK§bf­Å_Âà";break;case"zh":$h="ä^¨ês•\\šr¤îõâ|%ÌÂ:\$\nr.®„ö2Šr/d²È»[8Ğ S™8€r©!T¡\\¸s¦’I4¢b§r¬ñ•Ğ€Js!Kd²u´eåV¦©ÅDªX,#!˜Ğj6 §:¥t\nr£“îU:.Z²PË‘.…\rVWd^%äŒµ’r¡T²Ô¼*°s#UÕ`QdŞu'c(€ÜoF“±¤Øe3™Nb¦`êp2N™S¡ Ó£:LYñta~¨&6ÛŠ‹•r¶s®Ôükó{¾¹6ûòÙÍÀ©c(¸Ê2ªòf“qĞˆP:S*@S¡^­t*…êıÎ”TŠ¦ã^\\înNG#yËj\"5MÂ9²£ ŞÑ2Ãxèm8àşÁc„9ïèÈÚ¼Åº\0÷>A~Lœ…Ñ6s%IÊX’¨ËŠ:®ºM(ìbx¦¥¹dæ*Œb KœåaLŒ–K#às¹ÎX—g)<·Ì<vÂ©q>så±ÒK–ˆÁtFCÄÙÊDË!zH¸\$âĞC”*r“eñÊ^”@Pˆ×¶LúŒÑ¿¯Èİ:²ª8A<ÏÃ(ğÕÃ˜Ò7Ğ­¬¾K®‹Œ½/‡)3GHr*F­ys”\nÈLÉ%é*İœÄasÔ}F’)v]I¬C‡ŒvtI`òÑL¸!pHØAªZH‡9i8¤åÙÌB(eés—¥rZG0Ñò‘„Ù,œ¤QP€LÇI\0DœÄYS!ª tEr˜–“¥)ĞC»Évt”MÓÄB^g)HÜÔğKZ¨\$\ráy'Ñ¶‚s‘Õj¨	@t&‰¡Ğ¦)BØó‘\"è\\6¡pÈ2W5ÑuV,M¬6ƒ“Ç„äÊã0Ì6;ƒ+j—)äQCI>'1fT\$£Ö*\rìÀÚ0ÃÈ@:Ğ£¨Æ1´C˜Ì:\0Ø7Œîàæ4ƒ–¬0Œã¸mø8@6»ƒ«VaN†ÂÉ¤@@!ŠbŒ\$å!ÎD‘Š±ÒC‘µf‚Ñ§)JÆZ^š@H„…ÂO±‚£\$ú4c4ò:ĞÎè@ Œ› ÜımCĞ@,v3¡Ğ4ö:;ƒ8xŒ!ój)ë´;ñ–Pñ)!’á^[ñ|i,XU(»‰°V930œ*9V´à4çp¿gÚ¿r4ƒ à9‡Ax^;ÿpÃÔè/óúÁxe\rĞAÀ%¢{º`ø\$†ĞàgÃl\râ§væMhoV¦•¹†ÖeCJ?MMÕ†àèñŞJˆVÂüB‘B.Ç@¢d\$WòìKñ•!àB îg›b2¡Àı: åU¨aÏ}5¦¸Úó`lM‘·ÃóZiA•a†‚\0Æú`i!°9´2à\\‘\"&E¼¸‰ÅĞ%z¥Täè\0iDé¬GÃSàCAG!‚\$Æ5êáãÁ4†`ÍÃ<h*µAáÈ:3^‚P\\claŞH·³\"(‡¬ÈÆl!^q.&ÈÀ“RnND\";Â¸Z«#Ê²¢ˆO.@Ì`I\"aåœ@Ò­Lº@º\ršãFÎÃˆu4H,3ÀÚéßã«|¶EæÆ\"Ä—BF…E\nATOå„u	áL*G“)	\\¡åH³‘Ğ€²î^ˆ©~Ÿ‡H…ZkTr‰<.Å!Œ1Æ@1µF¯Ã{ûg €1Î˜Q	€€3Hğ@g]¨F\n‘áª+PÓƒpš“Y£(‹C<ˆRBár9ÄÙ‹.ï0s	±h«)µ8§D²PiÊ1.íÈëÔ‚\n#Äº_U¢ôXQ&#d+5\r€¬1´\0ÆÓùøv¡Ú1Í)ÜàĞiÍZ›PGƒk¤Aq	¸€ª0-	é×Lcºm[‘t0rŠñxtLaN#‚õ—.‘Ry—±uA6´Ö¶Z&JzÚ-Y%Qq\"¼¼)’{a²9¤I‹áÌ#’Šõ9B¸s	Asd(€†0&QjOê@ *Ş¿·‚ËEµ\"u8Ê¢#‰h‰s¸à‰1Ì'“5\"0ì†S?\$‰h…=0)›!Ë=…°æ´EŠ‡2ÈYBŠ{-eynÚ±´§ À´Á*\0";break;case"zh-tw":$h="ä^¨ê%Ó•\\šr¥ÑÎõâ|%ÌÎu:HçB(\\Ë4«‘pŠr –neRQÌ¡D8Ğ S•\nt*.tÒI&”G‘N”ÊAÊ¤S¹V÷:	t%9Sy:\"<r«STâ ,#!˜Ğj61uL\0¼–£“îU:.–²I9“ˆ—BÍæK&]\nDªXç[ªÅ}-,°r¨“ÖûÎöŒ¿‹&ó¨€Ğa;Dãx€àr4&Ã)œÊs3§SÂtÍ\rAĞÂbÒ¥¨E•E1»ŞÔ£Êg:åxç]#0,'}Ã¼b1Qä\\y\0çV¡E<Á¤Üg–¢SÅ )ĞªOLP\0¨ıÎ”«MÆ¼áÜÜ 2œFó–èˆ×¶ãæÍƒ{NÍã @9µƒƒùæ;¿ƒ#ttn©z÷>¡ÊDéql®±Ê@g1&Z%Ä)ÌT'9jB\nC\"¦%)nàªj«\"¨’èñdöCo{@§IBO¤òÜs¥Ä€¥’å*äOœÄÉt’Ä›Øä\$d€¨¹lY»\nr—%ò\0JB#hÛ´‘«Pş?tèÍ)ñ>Œ£Ã`7cHßB7Pù.½ªÎ[Wœ¤Ê¬r—™ĞL¡Ç)^C kAÎL—iqJ¥–ÁÈ\\´ıBBÔn‹O%RM•ÈxÈCË`aH<´àS8ˆ\\v8j¥’â„·…Ùvs„|Ès—µ©ÌGG)tGIâ|ƒ¥¤Z:^“—	\\ED=ÂMÔ%i te­¢[=…ñtåSØ\\Zdº¬—ºZW‡)]%±İ5„áq­n¡7¥ì]–Ì‰ÎG—Ê¢¬\$	Ğš&‡B˜¦cÎT<‹¡pÚ6…Ã Éu]„™º®ëÈ6ƒ“\$ÊäÍ\rã0Ì6;Ã+tr…Òä¨RH½A…a‚ ŞÎ£Ü<„­:ŒcN9ŒÃ¨Ø\rƒxÎïacR9kƒÎ0»ÁêÖãk¼:×uëtŒ#D©šF‚¦)ÍHŞ5Œ£rıgIFº4ùy0¦áÊKÑ¹ŸDıUª2\"£.ùµ4ğ:Ğ®ø@ Œ›ĞÜüíÃBŒÈ@,¶†3¡Ğ,ô:;Ã8xŒ!ót)ìt3ïGIGJèaÈr\\£ÑÕŒˆ›6“=	Bƒ•o@N‡w}èÑßø#@è:˜t…ã¿üƒ±i'ôşp^ã`:‚qªC‚÷„ÁğI\r¡ÀÒ×[ÍNÀ‚ Ş­ÍT.1»!òÖ]˜n=è¨p@9EúI t\n!V9D«¢>”4 ÂŞD.æ³†#4ËªPY[†ÌùP[`lAÍ²6fĞÚ›¬C6F¦ °Ã\0c}ğ\\4†ØÛùEH°B¢ä`Œ„!Œ.B%h‹´Ş9„ ¯Â<Z8@ „kE¨½£2\"\nA&D!¨wgKŠ3Æ€ÑCL­Ğpr† Ú „›Hw¨X‹Æ§á0†# VÈ²Vy…²Izä¸˜'0®©@\\9\"ˆMK€'å³¸ô2«Ç(ŠÚW„ÌË@¥[™Ä€Ãt 6f¡¡‡êiĞPf?aµ×À'fù“Œ-¥ÅÉ:„M1º\n<)…@@ÎÀ™'âªa—áÌ.ÙB•eÚ|a%‡BH™*\r¸Bb+H1˜²¼É™PÆÖšì\rğ «€ÒÁ\0S\n!0cFf½ÁP(4²İ š„´–q ³òfOéæ/UYuhõ!¬7<G‘†‹!Ì&Å¡ÑV*ÍÎÊ÷¨«ŒUK§ÂºfÆğ‰Ü=§â=ˆƒ/EˆéâşF3ĞØ\nÃHa­?wz£4ß’A¶†Ì×L+A“ÁÇX‚¢3v>áT*`ZË¶šg}D°á¤cx1ìj5Ç¬ÍY½;ŸåF\0 ›]kºá%@C\n Põ„ôÿjøt‰q8:	…QÇ4ö¤kf+Ó£FB@r/¡È/Åtx&D&Q¶ò\"\0W\0¼•Â(	K“_Ã¬¬nˆæ\"9Û±Ì'—M’\"0í†SI%æŒÜQ‹Ò[cÚ¥ï²\nY¹ô.…XæY«<óPK8_5ã—„\\À¨ò\\* ¨";break;}$qg=array();foreach(explode("\n",lzw_decompress($h))as$X)$qg[]=(strpos($X,"\t")?explode("\t",$X):$X);return$qg;}if(!$qg){$qg=get_translations($ba);$_SESSION["translations"]=$qg;}if(extension_loaded('pdo')){class
Min_PDO
extends
PDO{var$_result,$server_info,$affected_rows,$errno,$error;function
__construct(){global$b;$Ee=array_search("SQL",$b->operators);if($Ee!==false)unset($b->operators[$Ee]);}function
dsn($Jb,$V,$G,$D=array()){try{parent::__construct($Jb,$V,$G,$D);}catch(Exception$Xb){auth_error(h($Xb->getMessage()));}$this->setAttribute(13,array('Min_PDOStatement'));$this->server_info=@$this->getAttribute(4);}function
query($H,$zg=false){$I=parent::query($H);$this->error="";if(!$I){list(,$this->errno,$this->error)=$this->errorInfo();if(!$this->error)$this->error=lang(21);return
false;}$this->store_result($I);return$I;}function
multi_query($H){return$this->_result=$this->query($H);}function
store_result($I=null){if(!$I){$I=$this->_result;if(!$I)return
false;}if($I->columnCount()){$I->num_rows=$I->rowCount();return$I;}$this->affected_rows=$I->rowCount();return
true;}function
next_result(){if(!$this->_result)return
false;$this->_result->_offset=0;return@$this->_result->nextRowset();}function
result($H,$p=0){$I=$this->query($H);if(!$I)return
false;$K=$I->fetch();return$K[$p];}}class
Min_PDOStatement
extends
PDOStatement{var$_offset=0,$num_rows;function
fetch_assoc(){return$this->fetch(2);}function
fetch_row(){return$this->fetch(3);}function
fetch_field(){$K=(object)$this->getColumnMeta($this->_offset++);$K->orgtable=$K->table;$K->orgname=$K->name;$K->charsetnr=(in_array("blob",(array)$K->flags)?63:0);return$K;}}}$Gb=array();class
Min_SQL{var$_conn;function
__construct($i){$this->_conn=$i;}function
select($R,$M,$Z,$Dc,$oe=array(),$_=1,$E=0,$Je=false){global$b,$y;$kd=(count($Dc)<count($M));$H=$b->selectQueryBuild($M,$Z,$Dc,$oe,$_,$E);if(!$H)$H="SELECT".limit(($_GET["page"]!="last"&&$_!=""&&$Dc&&$kd&&$y=="sql"?"SQL_CALC_FOUND_ROWS ":"").implode(", ",$M)."\nFROM ".table($R),($Z?"\nWHERE ".implode(" AND ",$Z):"").($Dc&&$kd?"\nGROUP BY ".implode(", ",$Dc):"").($oe?"\nORDER BY ".implode(", ",$oe):""),($_!=""?+$_:null),($E?$_*$E:0),"\n");$Kf=microtime(true);$J=$this->_conn->query($H);if($Je)echo$b->selectQuery($H,$Kf,!$J);return$J;}function
delete($R,$Qe,$_=0){$H="FROM ".table($R);return
queries("DELETE".($_?limit1($R,$H,$Qe):" $H$Qe"));}function
update($R,$P,$Qe,$_=0,$N="\n"){$Mg=array();foreach($P
as$z=>$X)$Mg[]="$z = $X";$H=table($R)." SET$N".implode(",$N",$Mg);return
queries("UPDATE".($_?limit1($R,$H,$Qe,$N):" $H$Qe"));}function
insert($R,$P){return
queries("INSERT INTO ".table($R).($P?" (".implode(", ",array_keys($P)).")\nVALUES (".implode(", ",$P).")":" DEFAULT VALUES"));}function
insertUpdate($R,$L,$He){return
false;}function
begin(){return
queries("BEGIN");}function
commit(){return
queries("COMMIT");}function
rollback(){return
queries("ROLLBACK");}function
slowQuery($H,$eg){}function
convertSearch($v,$X,$p){return$v;}function
value($X,$p){return(method_exists($this->_conn,'value')?$this->_conn->value($X,$p):(is_resource($X)?stream_get_contents($X):$X));}function
quoteBinary($kf){return
q($kf);}function
warnings(){return'';}function
tableHelp($C){}}$Gb["sqlite"]="SQLite 3";$Gb["sqlite2"]="SQLite 2";if(isset($_GET["sqlite"])||isset($_GET["sqlite2"])){$Fe=array((isset($_GET["sqlite"])?"SQLite3":"SQLite"),"PDO_SQLite");define("DRIVER",(isset($_GET["sqlite"])?"sqlite":"sqlite2"));if(class_exists(isset($_GET["sqlite"])?"SQLite3":"SQLiteDatabase")){if(isset($_GET["sqlite"])){class
Min_SQLite{var$extension="SQLite3",$server_info,$affected_rows,$errno,$error,$_link;function
__construct($r){$this->_link=new
SQLite3($r);$Og=$this->_link->version();$this->server_info=$Og["versionString"];}function
query($H){$I=@$this->_link->query($H);$this->error="";if(!$I){$this->errno=$this->_link->lastErrorCode();$this->error=$this->_link->lastErrorMsg();return
false;}elseif($I->numColumns())return
new
Min_Result($I);$this->affected_rows=$this->_link->changes();return
true;}function
quote($Q){return(is_utf8($Q)?"'".$this->_link->escapeString($Q)."'":"x'".reset(unpack('H*',$Q))."'");}function
store_result(){return$this->_result;}function
result($H,$p=0){$I=$this->query($H);if(!is_object($I))return
false;$K=$I->_result->fetchArray();return$K[$p];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($I){$this->_result=$I;}function
fetch_assoc(){return$this->_result->fetchArray(SQLITE3_ASSOC);}function
fetch_row(){return$this->_result->fetchArray(SQLITE3_NUM);}function
fetch_field(){$f=$this->_offset++;$U=$this->_result->columnType($f);return(object)array("name"=>$this->_result->columnName($f),"type"=>$U,"charsetnr"=>($U==SQLITE3_BLOB?63:0),);}function
__desctruct(){return$this->_result->finalize();}}}else{class
Min_SQLite{var$extension="SQLite",$server_info,$affected_rows,$error,$_link;function
__construct($r){$this->server_info=sqlite_libversion();$this->_link=new
SQLiteDatabase($r);}function
query($H,$zg=false){$Sd=($zg?"unbufferedQuery":"query");$I=@$this->_link->$Sd($H,SQLITE_BOTH,$o);$this->error="";if(!$I){$this->error=$o;return
false;}elseif($I===true){$this->affected_rows=$this->changes();return
true;}return
new
Min_Result($I);}function
quote($Q){return"'".sqlite_escape_string($Q)."'";}function
store_result(){return$this->_result;}function
result($H,$p=0){$I=$this->query($H);if(!is_object($I))return
false;$K=$I->_result->fetch();return$K[$p];}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($I){$this->_result=$I;if(method_exists($I,'numRows'))$this->num_rows=$I->numRows();}function
fetch_assoc(){$K=$this->_result->fetch(SQLITE_ASSOC);if(!$K)return
false;$J=array();foreach($K
as$z=>$X)$J[($z[0]=='"'?idf_unescape($z):$z)]=$X;return$J;}function
fetch_row(){return$this->_result->fetch(SQLITE_NUM);}function
fetch_field(){$C=$this->_result->fieldName($this->_offset++);$Ae='(\[.*]|"(?:[^"]|"")*"|(.+))';if(preg_match("~^($Ae\\.)?$Ae\$~",$C,$B)){$R=($B[3]!=""?$B[3]:idf_unescape($B[2]));$C=($B[5]!=""?$B[5]:idf_unescape($B[4]));}return(object)array("name"=>$C,"orgname"=>$C,"orgtable"=>$R,);}}}}elseif(extension_loaded("pdo_sqlite")){class
Min_SQLite
extends
Min_PDO{var$extension="PDO_SQLite";function
__construct($r){$this->dsn(DRIVER.":$r","","");}}}if(class_exists("Min_SQLite")){class
Min_DB
extends
Min_SQLite{function
__construct(){parent::__construct(":memory:");$this->query("PRAGMA foreign_keys = 1");}function
select_db($r){if(is_readable($r)&&$this->query("ATTACH ".$this->quote(preg_match("~(^[/\\\\]|:)~",$r)?$r:dirname($_SERVER["SCRIPT_FILENAME"])."/$r")." AS a")){parent::__construct($r);$this->query("PRAGMA foreign_keys = 1");return
true;}return
false;}function
multi_query($H){return$this->_result=$this->query($H);}function
next_result(){return
false;}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($R,$L,$He){$Mg=array();foreach($L
as$P)$Mg[]="(".implode(", ",$P).")";return
queries("REPLACE INTO ".table($R)." (".implode(", ",array_keys(reset($L))).") VALUES\n".implode(",\n",$Mg));}function
tableHelp($C){if($C=="sqlite_sequence")return"fileformat2.html#seqtab";if($C=="sqlite_master")return"fileformat2.html#$C";}}function
idf_escape($v){return'"'.str_replace('"','""',$v).'"';}function
table($v){return
idf_escape($v);}function
connect(){global$b;list(,,$G)=$b->credentials();if($G!="")return
lang(22);return
new
Min_DB;}function
get_databases(){return
array();}function
limit($H,$Z,$_,$ee=0,$N=" "){return" $H$Z".($_!==null?$N."LIMIT $_".($ee?" OFFSET $ee":""):"");}function
limit1($R,$H,$Z,$N="\n"){global$i;return(preg_match('~^INTO~',$H)||$i->result("SELECT sqlite_compileoption_used('ENABLE_UPDATE_DELETE_LIMIT')")?limit($H,$Z,1,0,$N):" $H WHERE rowid = (SELECT rowid FROM ".table($R).$Z.$N."LIMIT 1)");}function
db_collation($m,$db){global$i;return$i->result("PRAGMA encoding");}function
engines(){return
array();}function
logged_user(){return
get_current_user();}function
tables_list(){return
get_key_vals("SELECT name, type FROM sqlite_master WHERE type IN ('table', 'view') ORDER BY (name = 'sqlite_sequence'), name");}function
count_tables($l){return
array();}function
table_status($C=""){global$i;$J=array();foreach(get_rows("SELECT name AS Name, type AS Engine, 'rowid' AS Oid, '' AS Auto_increment FROM sqlite_master WHERE type IN ('table', 'view') ".($C!=""?"AND name = ".q($C):"ORDER BY name"))as$K){$K["Rows"]=$i->result("SELECT COUNT(*) FROM ".idf_escape($K["Name"]));$J[$K["Name"]]=$K;}foreach(get_rows("SELECT * FROM sqlite_sequence",null,"")as$K)$J[$K["name"]]["Auto_increment"]=$K["seq"];return($C!=""?$J[$C]:$J);}function
is_view($S){return$S["Engine"]=="view";}function
fk_support($S){global$i;return!$i->result("SELECT sqlite_compileoption_used('OMIT_FOREIGN_KEY')");}function
fields($R){global$i;$J=array();$He="";foreach(get_rows("PRAGMA table_info(".table($R).")")as$K){$C=$K["name"];$U=strtolower($K["type"]);$yb=$K["dflt_value"];$J[$C]=array("field"=>$C,"type"=>(preg_match('~int~i',$U)?"integer":(preg_match('~char|clob|text~i',$U)?"text":(preg_match('~blob~i',$U)?"blob":(preg_match('~real|floa|doub~i',$U)?"real":"numeric")))),"full_type"=>$U,"default"=>(preg_match("~'(.*)'~",$yb,$B)?str_replace("''","'",$B[1]):($yb=="NULL"?null:$yb)),"null"=>!$K["notnull"],"privileges"=>array("select"=>1,"insert"=>1,"update"=>1),"primary"=>$K["pk"],);if($K["pk"]){if($He!="")$J[$He]["auto_increment"]=false;elseif(preg_match('~^integer$~i',$U))$J[$C]["auto_increment"]=true;$He=$C;}}$Hf=$i->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($R));preg_match_all('~(("[^"]*+")+|[a-z0-9_]+)\s+text\s+COLLATE\s+(\'[^\']+\'|\S+)~i',$Hf,$Jd,PREG_SET_ORDER);foreach($Jd
as$B){$C=str_replace('""','"',preg_replace('~^"|"$~','',$B[1]));if($J[$C])$J[$C]["collation"]=trim($B[3],"'");}return$J;}function
indexes($R,$j=null){global$i;if(!is_object($j))$j=$i;$J=array();$Hf=$j->result("SELECT sql FROM sqlite_master WHERE type = 'table' AND name = ".q($R));if(preg_match('~\bPRIMARY\s+KEY\s*\((([^)"]+|"[^"]*"|`[^`]*`)++)~i',$Hf,$B)){$J[""]=array("type"=>"PRIMARY","columns"=>array(),"lengths"=>array(),"descs"=>array());preg_match_all('~((("[^"]*+")+|(?:`[^`]*+`)+)|(\S+))(\s+(ASC|DESC))?(,\s*|$)~i',$B[1],$Jd,PREG_SET_ORDER);foreach($Jd
as$B){$J[""]["columns"][]=idf_unescape($B[2]).$B[4];$J[""]["descs"][]=(preg_match('~DESC~i',$B[5])?'1':null);}}if(!$J){foreach(fields($R)as$C=>$p){if($p["primary"])$J[""]=array("type"=>"PRIMARY","columns"=>array($C),"lengths"=>array(),"descs"=>array(null));}}$If=get_key_vals("SELECT name, sql FROM sqlite_master WHERE type = 'index' AND tbl_name = ".q($R),$j);foreach(get_rows("PRAGMA index_list(".table($R).")",$j)as$K){$C=$K["name"];$w=array("type"=>($K["unique"]?"UNIQUE":"INDEX"));$w["lengths"]=array();$w["descs"]=array();foreach(get_rows("PRAGMA index_info(".idf_escape($C).")",$j)as$jf){$w["columns"][]=$jf["name"];$w["descs"][]=null;}if(preg_match('~^CREATE( UNIQUE)? INDEX '.preg_quote(idf_escape($C).' ON '.idf_escape($R),'~').' \((.*)\)$~i',$If[$C],$Xe)){preg_match_all('/("[^"]*+")+( DESC)?/',$Xe[2],$Jd);foreach($Jd[2]as$z=>$X){if($X)$w["descs"][$z]='1';}}if(!$J[""]||$w["type"]!="UNIQUE"||$w["columns"]!=$J[""]["columns"]||$w["descs"]!=$J[""]["descs"]||!preg_match("~^sqlite_~",$C))$J[$C]=$w;}return$J;}function
foreign_keys($R){$J=array();foreach(get_rows("PRAGMA foreign_key_list(".table($R).")")as$K){$xc=&$J[$K["id"]];if(!$xc)$xc=$K;$xc["source"][]=$K["from"];$xc["target"][]=$K["to"];}return$J;}function
view($C){global$i;return
array("select"=>preg_replace('~^(?:[^`"[]+|`[^`]*`|"[^"]*")* AS\s+~iU','',$i->result("SELECT sql FROM sqlite_master WHERE name = ".q($C))));}function
collations(){return(isset($_GET["create"])?get_vals("PRAGMA collation_list",1):array());}function
information_schema($m){return
false;}function
error(){global$i;return
h($i->error);}function
check_sqlite_name($C){global$i;$ec="db|sdb|sqlite";if(!preg_match("~^[^\\0]*\\.($ec)\$~",$C)){$i->error=lang(23,str_replace("|",", ",$ec));return
false;}return
true;}function
create_database($m,$e){global$i;if(file_exists($m)){$i->error=lang(24);return
false;}if(!check_sqlite_name($m))return
false;try{$A=new
Min_SQLite($m);}catch(Exception$Xb){$i->error=$Xb->getMessage();return
false;}$A->query('PRAGMA encoding = "UTF-8"');$A->query('CREATE TABLE adminer (i)');$A->query('DROP TABLE adminer');return
true;}function
drop_databases($l){global$i;$i->__construct(":memory:");foreach($l
as$m){if(!@unlink($m)){$i->error=lang(24);return
false;}}return
true;}function
rename_database($C,$e){global$i;if(!check_sqlite_name($C))return
false;$i->__construct(":memory:");$i->error=lang(24);return@rename(DB,$C);}function
auto_increment(){return" PRIMARY KEY".(DRIVER=="sqlite"?" AUTOINCREMENT":"");}function
alter_table($R,$C,$q,$uc,$hb,$Sb,$e,$Fa,$ye){$Jg=($R==""||$uc);foreach($q
as$p){if($p[0]!=""||!$p[1]||$p[2]){$Jg=true;break;}}$c=array();$re=array();foreach($q
as$p){if($p[1]){$c[]=($Jg?$p[1]:"ADD ".implode($p[1]));if($p[0]!="")$re[$p[0]]=$p[1][0];}}if(!$Jg){foreach($c
as$X){if(!queries("ALTER TABLE ".table($R)." $X"))return
false;}if($R!=$C&&!queries("ALTER TABLE ".table($R)." RENAME TO ".table($C)))return
false;}elseif(!recreate_table($R,$C,$c,$re,$uc))return
false;if($Fa)queries("UPDATE sqlite_sequence SET seq = $Fa WHERE name = ".q($C));return
true;}function
recreate_table($R,$C,$q,$re,$uc,$x=array()){if($R!=""){if(!$q){foreach(fields($R)as$z=>$p){if($x)$p["auto_increment"]=0;$q[]=process_field($p,$p);$re[$z]=idf_escape($z);}}$Ie=false;foreach($q
as$p){if($p[6])$Ie=true;}$Ib=array();foreach($x
as$z=>$X){if($X[2]=="DROP"){$Ib[$X[1]]=true;unset($x[$z]);}}foreach(indexes($R)as$pd=>$w){$g=array();foreach($w["columns"]as$z=>$f){if(!$re[$f])continue
2;$g[]=$re[$f].($w["descs"][$z]?" DESC":"");}if(!$Ib[$pd]){if($w["type"]!="PRIMARY"||!$Ie)$x[]=array($w["type"],$pd,$g);}}foreach($x
as$z=>$X){if($X[0]=="PRIMARY"){unset($x[$z]);$uc[]="  PRIMARY KEY (".implode(", ",$X[2]).")";}}foreach(foreign_keys($R)as$pd=>$xc){foreach($xc["source"]as$z=>$f){if(!$re[$f])continue
2;$xc["source"][$z]=idf_unescape($re[$f]);}if(!isset($uc[" $pd"]))$uc[]=" ".format_foreign_key($xc);}queries("BEGIN");}foreach($q
as$z=>$p)$q[$z]="  ".implode($p);$q=array_merge($q,array_filter($uc));if(!queries("CREATE TABLE ".table($R!=""?"adminer_$C":$C)." (\n".implode(",\n",$q)."\n)"))return
false;if($R!=""){if($re&&!queries("INSERT INTO ".table("adminer_$C")." (".implode(", ",$re).") SELECT ".implode(", ",array_map('idf_escape',array_keys($re)))." FROM ".table($R)))return
false;$wg=array();foreach(triggers($R)as$ug=>$fg){$tg=trigger($ug);$wg[]="CREATE TRIGGER ".idf_escape($ug)." ".implode(" ",$fg)." ON ".table($C)."\n$tg[Statement]";}if(!queries("DROP TABLE ".table($R)))return
false;queries("ALTER TABLE ".table("adminer_$C")." RENAME TO ".table($C));if(!alter_indexes($C,$x))return
false;foreach($wg
as$tg){if(!queries($tg))return
false;}queries("COMMIT");}return
true;}function
index_sql($R,$U,$C,$g){return"CREATE $U ".($U!="INDEX"?"INDEX ":"").idf_escape($C!=""?$C:uniqid($R."_"))." ON ".table($R)." $g";}function
alter_indexes($R,$c){foreach($c
as$He){if($He[0]=="PRIMARY")return
recreate_table($R,$R,array(),array(),array(),$c);}foreach(array_reverse($c)as$X){if(!queries($X[2]=="DROP"?"DROP INDEX ".idf_escape($X[1]):index_sql($R,$X[0],$X[1],"(".implode(", ",$X[2]).")")))return
false;}return
true;}function
truncate_tables($T){return
apply_queries("DELETE FROM",$T);}function
drop_views($Qg){return
apply_queries("DROP VIEW",$Qg);}function
drop_tables($T){return
apply_queries("DROP TABLE",$T);}function
move_tables($T,$Qg,$Yf){return
false;}function
trigger($C){global$i;if($C=="")return
array("Statement"=>"BEGIN\n\t;\nEND");$v='(?:[^`"\s]+|`[^`]*`|"[^"]*")+';$vg=trigger_options();preg_match("~^CREATE\\s+TRIGGER\\s*$v\\s*(".implode("|",$vg["Timing"]).")\\s+([a-z]+)(?:\\s+OF\\s+($v))?\\s+ON\\s*$v\\s*(?:FOR\\s+EACH\\s+ROW\\s)?(.*)~is",$i->result("SELECT sql FROM sqlite_master WHERE type = 'trigger' AND name = ".q($C)),$B);$de=$B[3];return
array("Timing"=>strtoupper($B[1]),"Event"=>strtoupper($B[2]).($de?" OF":""),"Of"=>($de[0]=='`'||$de[0]=='"'?idf_unescape($de):$de),"Trigger"=>$C,"Statement"=>$B[4],);}function
triggers($R){$J=array();$vg=trigger_options();foreach(get_rows("SELECT * FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($R))as$K){preg_match('~^CREATE\s+TRIGGER\s*(?:[^`"\s]+|`[^`]*`|"[^"]*")+\s*('.implode("|",$vg["Timing"]).')\s*(.*)\s+ON\b~iU',$K["sql"],$B);$J[$K["name"]]=array($B[1],$B[2]);}return$J;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","UPDATE OF","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
begin(){return
queries("BEGIN");}function
last_id(){global$i;return$i->result("SELECT LAST_INSERT_ROWID()");}function
explain($i,$H){return$i->query("EXPLAIN QUERY PLAN $H");}function
found_rows($S,$Z){}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($mf){return
true;}function
create_sql($R,$Fa,$Pf){global$i;$J=$i->result("SELECT sql FROM sqlite_master WHERE type IN ('table', 'view') AND name = ".q($R));foreach(indexes($R)as$C=>$w){if($C=='')continue;$J.=";\n\n".index_sql($R,$w['type'],$C,"(".implode(", ",array_map('idf_escape',$w['columns'])).")");}return$J;}function
truncate_sql($R){return"DELETE FROM ".table($R);}function
use_sql($k){}function
trigger_sql($R){return
implode(get_vals("SELECT sql || ';;\n' FROM sqlite_master WHERE type = 'trigger' AND tbl_name = ".q($R)));}function
show_variables(){global$i;$J=array();foreach(array("auto_vacuum","cache_size","count_changes","default_cache_size","empty_result_callbacks","encoding","foreign_keys","full_column_names","fullfsync","journal_mode","journal_size_limit","legacy_file_format","locking_mode","page_size","max_page_count","read_uncommitted","recursive_triggers","reverse_unordered_selects","secure_delete","short_column_names","synchronous","temp_store","temp_store_directory","schema_version","integrity_check","quick_check")as$z)$J[$z]=$i->result("PRAGMA $z");return$J;}function
show_status(){$J=array();foreach(get_vals("PRAGMA compile_options")as$me){list($z,$X)=explode("=",$me,2);$J[$z]=$X;}return$J;}function
convert_field($p){}function
unconvert_field($p,$J){return$J;}function
support($ic){return
preg_match('~^(columns|database|drop_col|dump|indexes|move_col|sql|status|table|trigger|variables|view|view_trigger)$~',$ic);}$y="sqlite";$yg=array("integer"=>0,"real"=>0,"numeric"=>0,"text"=>0,"blob"=>0);$Of=array_keys($yg);$Eg=array();$le=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL","SQL");$Cc=array("hex","length","lower","round","unixepoch","upper");$Gc=array("avg","count","count distinct","group_concat","max","min","sum");$Lb=array(array(),array("integer|real|numeric"=>"+/-","text"=>"||",));}$Gb["pgsql"]="PostgreSQL";if(isset($_GET["pgsql"])){$Fe=array("PgSQL","PDO_PgSQL");define("DRIVER","pgsql");if(extension_loaded("pgsql")){class
Min_DB{var$extension="PgSQL",$_link,$_result,$_string,$_database=true,$server_info,$affected_rows,$error,$timeout;function
_error($Vb,$o){if(ini_bool("html_errors"))$o=html_entity_decode(strip_tags($o));$o=preg_replace('~^[^:]*: ~','',$o);$this->error=$o;}function
connect($O,$V,$G){global$b;$m=$b->database();set_error_handler(array($this,'_error'));$this->_string="host='".str_replace(":","' port='",addcslashes($O,"'\\"))."' user='".addcslashes($V,"'\\")."' password='".addcslashes($G,"'\\")."'";$this->_link=@pg_connect("$this->_string dbname='".($m!=""?addcslashes($m,"'\\"):"postgres")."'",PGSQL_CONNECT_FORCE_NEW);if(!$this->_link&&$m!=""){$this->_database=false;$this->_link=@pg_connect("$this->_string dbname='postgres'",PGSQL_CONNECT_FORCE_NEW);}restore_error_handler();if($this->_link){$Og=pg_version($this->_link);$this->server_info=$Og["server"];pg_set_client_encoding($this->_link,"UTF8");}return(bool)$this->_link;}function
quote($Q){return"'".pg_escape_string($this->_link,$Q)."'";}function
value($X,$p){return($p["type"]=="bytea"?pg_unescape_bytea($X):$X);}function
quoteBinary($Q){return"'".pg_escape_bytea($this->_link,$Q)."'";}function
select_db($k){global$b;if($k==$b->database())return$this->_database;$J=@pg_connect("$this->_string dbname='".addcslashes($k,"'\\")."'",PGSQL_CONNECT_FORCE_NEW);if($J)$this->_link=$J;return$J;}function
close(){$this->_link=@pg_connect("$this->_string dbname='postgres'");}function
query($H,$zg=false){$I=@pg_query($this->_link,$H);$this->error="";if(!$I){$this->error=pg_last_error($this->_link);$J=false;}elseif(!pg_num_fields($I)){$this->affected_rows=pg_affected_rows($I);$J=true;}else$J=new
Min_Result($I);if($this->timeout){$this->timeout=0;$this->query("RESET statement_timeout");}return$J;}function
multi_query($H){return$this->_result=$this->query($H);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($H,$p=0){$I=$this->query($H);if(!$I||!$I->num_rows)return
false;return
pg_fetch_result($I->_result,0,$p);}function
warnings(){return
h(pg_last_notice($this->_link));}}class
Min_Result{var$_result,$_offset=0,$num_rows;function
__construct($I){$this->_result=$I;$this->num_rows=pg_num_rows($I);}function
fetch_assoc(){return
pg_fetch_assoc($this->_result);}function
fetch_row(){return
pg_fetch_row($this->_result);}function
fetch_field(){$f=$this->_offset++;$J=new
stdClass;if(function_exists('pg_field_table'))$J->orgtable=pg_field_table($this->_result,$f);$J->name=pg_field_name($this->_result,$f);$J->orgname=$J->name;$J->type=pg_field_type($this->_result,$f);$J->charsetnr=($J->type=="bytea"?63:0);return$J;}function
__destruct(){pg_free_result($this->_result);}}}elseif(extension_loaded("pdo_pgsql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_PgSQL",$timeout;function
connect($O,$V,$G){global$b;$m=$b->database();$Q="pgsql:host='".str_replace(":","' port='",addcslashes($O,"'\\"))."' options='-c client_encoding=utf8'";$this->dsn("$Q dbname='".($m!=""?addcslashes($m,"'\\"):"postgres")."'",$V,$G);return
true;}function
select_db($k){global$b;return($b->database()==$k);}function
quoteBinary($kf){return
q($kf);}function
query($H,$zg=false){$J=parent::query($H,$zg);if($this->timeout){$this->timeout=0;parent::query("RESET statement_timeout");}return$J;}function
warnings(){return'';}function
close(){}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($R,$L,$He){global$i;foreach($L
as$P){$Fg=array();$Z=array();foreach($P
as$z=>$X){$Fg[]="$z = $X";if(isset($He[idf_unescape($z)]))$Z[]="$z = $X";}if(!(($Z&&queries("UPDATE ".table($R)." SET ".implode(", ",$Fg)." WHERE ".implode(" AND ",$Z))&&$i->affected_rows)||queries("INSERT INTO ".table($R)." (".implode(", ",array_keys($P)).") VALUES (".implode(", ",$P).")")))return
false;}return
true;}function
slowQuery($H,$eg){$this->_conn->query("SET statement_timeout = ".(1000*$eg));$this->_conn->timeout=1000*$eg;return$H;}function
convertSearch($v,$X,$p){return(preg_match('~char|text'.(!preg_match('~LIKE~',$X["op"])?'|date|time(stamp)?|boolean|uuid|'.number_type():'').'~',$p["type"])?$v:"CAST($v AS text)");}function
quoteBinary($kf){return$this->_conn->quoteBinary($kf);}function
warnings(){return$this->_conn->warnings();}function
tableHelp($C){$Bd=array("information_schema"=>"infoschema","pg_catalog"=>"catalog",);$A=$Bd[$_GET["ns"]];if($A)return"$A-".str_replace("_","-",$C).".html";}}function
idf_escape($v){return'"'.str_replace('"','""',$v).'"';}function
table($v){return
idf_escape($v);}function
connect(){global$b,$yg,$Of;$i=new
Min_DB;$qb=$b->credentials();if($i->connect($qb[0],$qb[1],$qb[2])){if(min_version(9,0,$i)){$i->query("SET application_name = 'Adminer'");if(min_version(9.2,0,$i)){$Of[lang(25)][]="json";$yg["json"]=4294967295;if(min_version(9.4,0,$i)){$Of[lang(25)][]="jsonb";$yg["jsonb"]=4294967295;}}}return$i;}return$i->error;}function
get_databases(){return
get_vals("SELECT datname FROM pg_database WHERE has_database_privilege(datname, 'CONNECT') ORDER BY datname");}function
limit($H,$Z,$_,$ee=0,$N=" "){return" $H$Z".($_!==null?$N."LIMIT $_".($ee?" OFFSET $ee":""):"");}function
limit1($R,$H,$Z,$N="\n"){return(preg_match('~^INTO~',$H)?limit($H,$Z,1,0,$N):" $H".(is_view(table_status1($R))?$Z:" WHERE ctid = (SELECT ctid FROM ".table($R).$Z.$N."LIMIT 1)"));}function
db_collation($m,$db){global$i;return$i->result("SHOW LC_COLLATE");}function
engines(){return
array();}function
logged_user(){global$i;return$i->result("SELECT user");}function
tables_list(){$H="SELECT table_name, table_type FROM information_schema.tables WHERE table_schema = current_schema()";if(support('materializedview'))$H.="
UNION ALL
SELECT matviewname, 'MATERIALIZED VIEW'
FROM pg_matviews
WHERE schemaname = current_schema()";$H.="
ORDER BY 1";return
get_key_vals($H);}function
count_tables($l){return
array();}function
table_status($C=""){$J=array();foreach(get_rows("SELECT c.relname AS \"Name\", CASE c.relkind WHEN 'r' THEN 'table' WHEN 'm' THEN 'materialized view' ELSE 'view' END AS \"Engine\", pg_relation_size(c.oid) AS \"Data_length\", pg_total_relation_size(c.oid) - pg_relation_size(c.oid) AS \"Index_length\", obj_description(c.oid, 'pg_class') AS \"Comment\", CASE WHEN c.relhasoids THEN 'oid' ELSE '' END AS \"Oid\", c.reltuples as \"Rows\", n.nspname
FROM pg_class c
JOIN pg_namespace n ON(n.nspname = current_schema() AND n.oid = c.relnamespace)
WHERE relkind IN ('r', 'm', 'v', 'f')
".($C!=""?"AND relname = ".q($C):"ORDER BY relname"))as$K)$J[$K["Name"]]=$K;return($C!=""?$J[$C]:$J);}function
is_view($S){return
in_array($S["Engine"],array("view","materialized view"));}function
fk_support($S){return
true;}function
fields($R){$J=array();$xa=array('timestamp without time zone'=>'timestamp','timestamp with time zone'=>'timestamptz',);foreach(get_rows("SELECT a.attname AS field, format_type(a.atttypid, a.atttypmod) AS full_type, d.adsrc AS default, a.attnotnull::int, col_description(c.oid, a.attnum) AS comment
FROM pg_class c
JOIN pg_namespace n ON c.relnamespace = n.oid
JOIN pg_attribute a ON c.oid = a.attrelid
LEFT JOIN pg_attrdef d ON c.oid = d.adrelid AND a.attnum = d.adnum
WHERE c.relname = ".q($R)."
AND n.nspname = current_schema()
AND NOT a.attisdropped
AND a.attnum > 0
ORDER BY a.attnum")as$K){preg_match('~([^([]+)(\((.*)\))?([a-z ]+)?((\[[0-9]*])*)$~',$K["full_type"],$B);list(,$U,$zd,$K["length"],$sa,$za)=$B;$K["length"].=$za;$Va=$U.$sa;if(isset($xa[$Va])){$K["type"]=$xa[$Va];$K["full_type"]=$K["type"].$zd.$za;}else{$K["type"]=$U;$K["full_type"]=$K["type"].$zd.$sa.$za;}$K["null"]=!$K["attnotnull"];$K["auto_increment"]=preg_match('~^nextval\(~i',$K["default"]);$K["privileges"]=array("insert"=>1,"select"=>1,"update"=>1);if(preg_match('~(.+)::[^)]+(.*)~',$K["default"],$B))$K["default"]=($B[1]=="NULL"?null:(($B[1][0]=="'"?idf_unescape($B[1]):$B[1]).$B[2]));$J[$K["field"]]=$K;}return$J;}function
indexes($R,$j=null){global$i;if(!is_object($j))$j=$i;$J=array();$Wf=$j->result("SELECT oid FROM pg_class WHERE relnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema()) AND relname = ".q($R));$g=get_key_vals("SELECT attnum, attname FROM pg_attribute WHERE attrelid = $Wf AND attnum > 0",$j);foreach(get_rows("SELECT relname, indisunique::int, indisprimary::int, indkey, indoption , (indpred IS NOT NULL)::int as indispartial FROM pg_index i, pg_class ci WHERE i.indrelid = $Wf AND ci.oid = i.indexrelid",$j)as$K){$Ye=$K["relname"];$J[$Ye]["type"]=($K["indispartial"]?"INDEX":($K["indisprimary"]?"PRIMARY":($K["indisunique"]?"UNIQUE":"INDEX")));$J[$Ye]["columns"]=array();foreach(explode(" ",$K["indkey"])as$ad)$J[$Ye]["columns"][]=$g[$ad];$J[$Ye]["descs"]=array();foreach(explode(" ",$K["indoption"])as$bd)$J[$Ye]["descs"][]=($bd&1?'1':null);$J[$Ye]["lengths"]=array();}return$J;}function
foreign_keys($R){global$ge;$J=array();foreach(get_rows("SELECT conname, condeferrable::int AS deferrable, pg_get_constraintdef(oid) AS definition
FROM pg_constraint
WHERE conrelid = (SELECT pc.oid FROM pg_class AS pc INNER JOIN pg_namespace AS pn ON (pn.oid = pc.relnamespace) WHERE pc.relname = ".q($R)." AND pn.nspname = current_schema())
AND contype = 'f'::char
ORDER BY conkey, conname")as$K){if(preg_match('~FOREIGN KEY\s*\((.+)\)\s*REFERENCES (.+)\((.+)\)(.*)$~iA',$K['definition'],$B)){$K['source']=array_map('trim',explode(',',$B[1]));if(preg_match('~^(("([^"]|"")+"|[^"]+)\.)?"?("([^"]|"")+"|[^"]+)$~',$B[2],$Id)){$K['ns']=str_replace('""','"',preg_replace('~^"(.+)"$~','\1',$Id[2]));$K['table']=str_replace('""','"',preg_replace('~^"(.+)"$~','\1',$Id[4]));}$K['target']=array_map('trim',explode(',',$B[3]));$K['on_delete']=(preg_match("~ON DELETE ($ge)~",$B[4],$Id)?$Id[1]:'NO ACTION');$K['on_update']=(preg_match("~ON UPDATE ($ge)~",$B[4],$Id)?$Id[1]:'NO ACTION');$J[$K['conname']]=$K;}}return$J;}function
view($C){global$i;return
array("select"=>trim($i->result("SELECT view_definition
FROM information_schema.views
WHERE table_schema = current_schema() AND table_name = ".q($C))));}function
collations(){return
array();}function
information_schema($m){return($m=="information_schema");}function
error(){global$i;$J=h($i->error);if(preg_match('~^(.*\n)?([^\n]*)\n( *)\^(\n.*)?$~s',$J,$B))$J=$B[1].preg_replace('~((?:[^&]|&[^;]*;){'.strlen($B[3]).'})(.*)~','\1<b>\2</b>',$B[2]).$B[4];return
nl_br($J);}function
create_database($m,$e){return
queries("CREATE DATABASE ".idf_escape($m).($e?" ENCODING ".idf_escape($e):""));}function
drop_databases($l){global$i;$i->close();return
apply_queries("DROP DATABASE",$l,'idf_escape');}function
rename_database($C,$e){return
queries("ALTER DATABASE ".idf_escape(DB)." RENAME TO ".idf_escape($C));}function
auto_increment(){return"";}function
alter_table($R,$C,$q,$uc,$hb,$Sb,$e,$Fa,$ye){$c=array();$Pe=array();foreach($q
as$p){$f=idf_escape($p[0]);$X=$p[1];if(!$X)$c[]="DROP $f";else{$Lg=$X[5];unset($X[5]);if(isset($X[6])&&$p[0]=="")$X[1]=($X[1]=="bigint"?" big":" ")."serial";if($p[0]=="")$c[]=($R!=""?"ADD ":"  ").implode($X);else{if($f!=$X[0])$Pe[]="ALTER TABLE ".table($R)." RENAME $f TO $X[0]";$c[]="ALTER $f TYPE$X[1]";if(!$X[6]){$c[]="ALTER $f ".($X[3]?"SET$X[3]":"DROP DEFAULT");$c[]="ALTER $f ".($X[2]==" NULL"?"DROP NOT":"SET").$X[2];}}if($p[0]!=""||$Lg!="")$Pe[]="COMMENT ON COLUMN ".table($R).".$X[0] IS ".($Lg!=""?substr($Lg,9):"''");}}$c=array_merge($c,$uc);if($R=="")array_unshift($Pe,"CREATE TABLE ".table($C)." (\n".implode(",\n",$c)."\n)");elseif($c)array_unshift($Pe,"ALTER TABLE ".table($R)."\n".implode(",\n",$c));if($R!=""&&$R!=$C)$Pe[]="ALTER TABLE ".table($R)." RENAME TO ".table($C);if($R!=""||$hb!="")$Pe[]="COMMENT ON TABLE ".table($C)." IS ".q($hb);if($Fa!=""){}foreach($Pe
as$H){if(!queries($H))return
false;}return
true;}function
alter_indexes($R,$c){$ob=array();$Hb=array();$Pe=array();foreach($c
as$X){if($X[0]!="INDEX")$ob[]=($X[2]=="DROP"?"\nDROP CONSTRAINT ".idf_escape($X[1]):"\nADD".($X[1]!=""?" CONSTRAINT ".idf_escape($X[1]):"")." $X[0] ".($X[0]=="PRIMARY"?"KEY ":"")."(".implode(", ",$X[2]).")");elseif($X[2]=="DROP")$Hb[]=idf_escape($X[1]);else$Pe[]="CREATE INDEX ".idf_escape($X[1]!=""?$X[1]:uniqid($R."_"))." ON ".table($R)." (".implode(", ",$X[2]).")";}if($ob)array_unshift($Pe,"ALTER TABLE ".table($R).implode(",",$ob));if($Hb)array_unshift($Pe,"DROP INDEX ".implode(", ",$Hb));foreach($Pe
as$H){if(!queries($H))return
false;}return
true;}function
truncate_tables($T){return
queries("TRUNCATE ".implode(", ",array_map('table',$T)));return
true;}function
drop_views($Qg){return
drop_tables($Qg);}function
drop_tables($T){foreach($T
as$R){$Mf=table_status($R);if(!queries("DROP ".strtoupper($Mf["Engine"])." ".table($R)))return
false;}return
true;}function
move_tables($T,$Qg,$Yf){foreach(array_merge($T,$Qg)as$R){$Mf=table_status($R);if(!queries("ALTER ".strtoupper($Mf["Engine"])." ".table($R)." SET SCHEMA ".idf_escape($Yf)))return
false;}return
true;}function
trigger($C,$R=null){if($C=="")return
array("Statement"=>"EXECUTE PROCEDURE ()");if($R===null)$R=$_GET['trigger'];$L=get_rows('SELECT t.trigger_name AS "Trigger", t.action_timing AS "Timing", (SELECT STRING_AGG(event_manipulation, \' OR \') FROM information_schema.triggers WHERE event_object_table = t.event_object_table AND trigger_name = t.trigger_name ) AS "Events", t.event_manipulation AS "Event", \'FOR EACH \' || t.action_orientation AS "Type", t.action_statement AS "Statement" FROM information_schema.triggers t WHERE t.event_object_table = '.q($R).' AND t.trigger_name = '.q($C));return
reset($L);}function
triggers($R){$J=array();foreach(get_rows("SELECT * FROM information_schema.triggers WHERE event_object_table = ".q($R))as$K)$J[$K["trigger_name"]]=array($K["action_timing"],$K["event_manipulation"]);return$J;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW","FOR EACH STATEMENT"),);}function
routine($C,$U){$L=get_rows('SELECT routine_definition AS definition, LOWER(external_language) AS language, *
FROM information_schema.routines
WHERE routine_schema = current_schema() AND specific_name = '.q($C));$J=$L[0];$J["returns"]=array("type"=>$J["type_udt_name"]);$J["fields"]=get_rows('SELECT parameter_name AS field, data_type AS type, character_maximum_length AS length, parameter_mode AS inout
FROM information_schema.parameters
WHERE specific_schema = current_schema() AND specific_name = '.q($C).'
ORDER BY ordinal_position');return$J;}function
routines(){return
get_rows('SELECT specific_name AS "SPECIFIC_NAME", routine_type AS "ROUTINE_TYPE", routine_name AS "ROUTINE_NAME", type_udt_name AS "DTD_IDENTIFIER"
FROM information_schema.routines
WHERE routine_schema = current_schema()
ORDER BY SPECIFIC_NAME');}function
routine_languages(){return
get_vals("SELECT LOWER(lanname) FROM pg_catalog.pg_language");}function
routine_id($C,$K){$J=array();foreach($K["fields"]as$p)$J[]=$p["type"];return
idf_escape($C)."(".implode(", ",$J).")";}function
last_id(){return
0;}function
explain($i,$H){return$i->query("EXPLAIN $H");}function
found_rows($S,$Z){global$i;if(preg_match("~ rows=([0-9]+)~",$i->result("EXPLAIN SELECT * FROM ".idf_escape($S["Name"]).($Z?" WHERE ".implode(" AND ",$Z):"")),$Xe))return$Xe[1];return
false;}function
types(){return
get_vals("SELECT typname
FROM pg_type
WHERE typnamespace = (SELECT oid FROM pg_namespace WHERE nspname = current_schema())
AND typtype IN ('b','d','e')
AND typelem = 0");}function
schemas(){return
get_vals("SELECT nspname FROM pg_namespace ORDER BY nspname");}function
get_schema(){global$i;return$i->result("SELECT current_schema()");}function
set_schema($lf){global$i,$yg,$Of;$J=$i->query("SET search_path TO ".idf_escape($lf));foreach(types()as$U){if(!isset($yg[$U])){$yg[$U]=0;$Of[lang(26)][]=$U;}}return$J;}function
create_sql($R,$Fa,$Pf){global$i;$J='';$hf=array();$vf=array();$Mf=table_status($R);$q=fields($R);$x=indexes($R);ksort($x);$rc=foreign_keys($R);ksort($rc);if(!$Mf||empty($q))return
false;$J="CREATE TABLE ".idf_escape($Mf['nspname']).".".idf_escape($Mf['Name'])." (\n    ";foreach($q
as$jc=>$p){$xe=idf_escape($p['field']).' '.$p['full_type'].default_value($p).($p['attnotnull']?" NOT NULL":"");$hf[]=$xe;if(preg_match('~nextval\(\'([^\']+)\'\)~',$p['default'],$Jd)){$uf=$Jd[1];$Gf=reset(get_rows(min_version(10)?"SELECT *, cache_size AS cache_value FROM pg_sequences WHERE schemaname = current_schema() AND sequencename = ".q($uf):"SELECT * FROM $uf"));$vf[]=($Pf=="DROP+CREATE"?"DROP SEQUENCE IF EXISTS $uf;\n":"")."CREATE SEQUENCE $uf INCREMENT $Gf[increment_by] MINVALUE $Gf[min_value] MAXVALUE $Gf[max_value] START ".($Fa?$Gf['last_value']:1)." CACHE $Gf[cache_value];";}}if(!empty($vf))$J=implode("\n\n",$vf)."\n\n$J";foreach($x
as$Vc=>$w){switch($w['type']){case'UNIQUE':$hf[]="CONSTRAINT ".idf_escape($Vc)." UNIQUE (".implode(', ',array_map('idf_escape',$w['columns'])).")";break;case'PRIMARY':$hf[]="CONSTRAINT ".idf_escape($Vc)." PRIMARY KEY (".implode(', ',array_map('idf_escape',$w['columns'])).")";break;}}foreach($rc
as$qc=>$pc)$hf[]="CONSTRAINT ".idf_escape($qc)." $pc[definition] ".($pc['deferrable']?'DEFERRABLE':'NOT DEFERRABLE');$J.=implode(",\n    ",$hf)."\n) WITH (oids = ".($Mf['Oid']?'true':'false').");";foreach($x
as$Vc=>$w){if($w['type']=='INDEX')$J.="\n\nCREATE INDEX ".idf_escape($Vc)." ON ".idf_escape($Mf['nspname']).".".idf_escape($Mf['Name'])." USING btree (".implode(', ',array_map('idf_escape',$w['columns'])).");";}if($Mf['Comment'])$J.="\n\nCOMMENT ON TABLE ".idf_escape($Mf['nspname']).".".idf_escape($Mf['Name'])." IS ".q($Mf['Comment']).";";foreach($q
as$jc=>$p){if($p['comment'])$J.="\n\nCOMMENT ON COLUMN ".idf_escape($Mf['nspname']).".".idf_escape($Mf['Name']).".".idf_escape($jc)." IS ".q($p['comment']).";";}return
rtrim($J,';');}function
truncate_sql($R){return"TRUNCATE ".table($R);}function
trigger_sql($R){$Mf=table_status($R);$J="";foreach(triggers($R)as$sg=>$rg){$tg=trigger($sg,$Mf['Name']);$J.="\nCREATE TRIGGER ".idf_escape($tg['Trigger'])." $tg[Timing] $tg[Events] ON ".idf_escape($Mf["nspname"]).".".idf_escape($Mf['Name'])." $tg[Type] $tg[Statement];;\n";}return$J;}function
use_sql($k){return"\connect ".idf_escape($k);}function
show_variables(){return
get_key_vals("SHOW ALL");}function
process_list(){return
get_rows("SELECT * FROM pg_stat_activity ORDER BY ".(min_version(9.2)?"pid":"procpid"));}function
show_status(){}function
convert_field($p){}function
unconvert_field($p,$J){return$J;}function
support($ic){return
preg_match('~^(database|table|columns|sql|indexes|comment|view|'.(min_version(9.3)?'materializedview|':'').'scheme|routine|processlist|sequence|trigger|type|variables|drop_col|kill|dump)$~',$ic);}function
kill_process($X){return
queries("SELECT pg_terminate_backend(".number($X).")");}function
connection_id(){return"SELECT pg_backend_pid()";}function
max_connections(){global$i;return$i->result("SHOW max_connections");}$y="pgsql";$yg=array();$Of=array();foreach(array(lang(27)=>array("smallint"=>5,"integer"=>10,"bigint"=>19,"boolean"=>1,"numeric"=>0,"real"=>7,"double precision"=>16,"money"=>20),lang(28)=>array("date"=>13,"time"=>17,"timestamp"=>20,"timestamptz"=>21,"interval"=>0),lang(25)=>array("character"=>0,"character varying"=>0,"text"=>0,"tsquery"=>0,"tsvector"=>0,"uuid"=>0,"xml"=>0),lang(29)=>array("bit"=>0,"bit varying"=>0,"bytea"=>0),lang(30)=>array("cidr"=>43,"inet"=>43,"macaddr"=>17,"txid_snapshot"=>0),lang(31)=>array("box"=>0,"circle"=>0,"line"=>0,"lseg"=>0,"path"=>0,"point"=>0,"polygon"=>0),)as$z=>$X){$yg+=$X;$Of[$z]=array_keys($X);}$Eg=array();$le=array("=","<",">","<=",">=","!=","~","!~","LIKE","LIKE %%","ILIKE","ILIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL");$Cc=array("char_length","lower","round","to_hex","to_timestamp","upper");$Gc=array("avg","count","count distinct","max","min","sum");$Lb=array(array("char"=>"md5","date|time"=>"now",),array(number_type()=>"+/-","date|time"=>"+ interval/- interval","char|text"=>"||",));}$Gb["oracle"]="Oracle (beta)";if(isset($_GET["oracle"])){$Fe=array("OCI8","PDO_OCI");define("DRIVER","oracle");if(extension_loaded("oci8")){class
Min_DB{var$extension="oci8",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_error($Vb,$o){if(ini_bool("html_errors"))$o=html_entity_decode(strip_tags($o));$o=preg_replace('~^[^:]*: ~','',$o);$this->error=$o;}function
connect($O,$V,$G){$this->_link=@oci_new_connect($V,$G,$O,"AL32UTF8");if($this->_link){$this->server_info=oci_server_version($this->_link);return
true;}$o=oci_error();$this->error=$o["message"];return
false;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}function
select_db($k){return
true;}function
query($H,$zg=false){$I=oci_parse($this->_link,$H);$this->error="";if(!$I){$o=oci_error($this->_link);$this->errno=$o["code"];$this->error=$o["message"];return
false;}set_error_handler(array($this,'_error'));$J=@oci_execute($I);restore_error_handler();if($J){if(oci_num_fields($I))return
new
Min_Result($I);$this->affected_rows=oci_num_rows($I);}return$J;}function
multi_query($H){return$this->_result=$this->query($H);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($H,$p=1){$I=$this->query($H);if(!is_object($I)||!oci_fetch($I->_result))return
false;return
oci_result($I->_result,$p);}}class
Min_Result{var$_result,$_offset=1,$num_rows;function
__construct($I){$this->_result=$I;}function
_convert($K){foreach((array)$K
as$z=>$X){if(is_a($X,'OCI-Lob'))$K[$z]=$X->load();}return$K;}function
fetch_assoc(){return$this->_convert(oci_fetch_assoc($this->_result));}function
fetch_row(){return$this->_convert(oci_fetch_row($this->_result));}function
fetch_field(){$f=$this->_offset++;$J=new
stdClass;$J->name=oci_field_name($this->_result,$f);$J->orgname=$J->name;$J->type=oci_field_type($this->_result,$f);$J->charsetnr=(preg_match("~raw|blob|bfile~",$J->type)?63:0);return$J;}function
__destruct(){oci_free_statement($this->_result);}}}elseif(extension_loaded("pdo_oci")){class
Min_DB
extends
Min_PDO{var$extension="PDO_OCI";function
connect($O,$V,$G){$this->dsn("oci:dbname=//$O;charset=AL32UTF8",$V,$G);return
true;}function
select_db($k){return
true;}}}class
Min_Driver
extends
Min_SQL{function
begin(){return
true;}}function
idf_escape($v){return'"'.str_replace('"','""',$v).'"';}function
table($v){return
idf_escape($v);}function
connect(){global$b;$i=new
Min_DB;$qb=$b->credentials();if($i->connect($qb[0],$qb[1],$qb[2]))return$i;return$i->error;}function
get_databases(){return
get_vals("SELECT tablespace_name FROM user_tablespaces");}function
limit($H,$Z,$_,$ee=0,$N=" "){return($ee?" * FROM (SELECT t.*, rownum AS rnum FROM (SELECT $H$Z) t WHERE rownum <= ".($_+$ee).") WHERE rnum > $ee":($_!==null?" * FROM (SELECT $H$Z) WHERE rownum <= ".($_+$ee):" $H$Z"));}function
limit1($R,$H,$Z,$N="\n"){return" $H$Z";}function
db_collation($m,$db){global$i;return$i->result("SELECT value FROM nls_database_parameters WHERE parameter = 'NLS_CHARACTERSET'");}function
engines(){return
array();}function
logged_user(){global$i;return$i->result("SELECT USER FROM DUAL");}function
tables_list(){return
get_key_vals("SELECT table_name, 'table' FROM all_tables WHERE tablespace_name = ".q(DB)."
UNION SELECT view_name, 'view' FROM user_views
ORDER BY 1");}function
count_tables($l){return
array();}function
table_status($C=""){$J=array();$nf=q($C);foreach(get_rows('SELECT table_name "Name", \'table\' "Engine", avg_row_len * num_rows "Data_length", num_rows "Rows" FROM all_tables WHERE tablespace_name = '.q(DB).($C!=""?" AND table_name = $nf":"")."
UNION SELECT view_name, 'view', 0, 0 FROM user_views".($C!=""?" WHERE view_name = $nf":"")."
ORDER BY 1")as$K){if($C!="")return$K;$J[$K["Name"]]=$K;}return$J;}function
is_view($S){return$S["Engine"]=="view";}function
fk_support($S){return
true;}function
fields($R){$J=array();foreach(get_rows("SELECT * FROM all_tab_columns WHERE table_name = ".q($R)." ORDER BY column_id")as$K){$U=$K["DATA_TYPE"];$zd="$K[DATA_PRECISION],$K[DATA_SCALE]";if($zd==",")$zd=$K["DATA_LENGTH"];$J[$K["COLUMN_NAME"]]=array("field"=>$K["COLUMN_NAME"],"full_type"=>$U.($zd?"($zd)":""),"type"=>strtolower($U),"length"=>$zd,"default"=>$K["DATA_DEFAULT"],"null"=>($K["NULLABLE"]=="Y"),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);}return$J;}function
indexes($R,$j=null){$J=array();foreach(get_rows("SELECT uic.*, uc.constraint_type
FROM user_ind_columns uic
LEFT JOIN user_constraints uc ON uic.index_name = uc.constraint_name AND uic.table_name = uc.table_name
WHERE uic.table_name = ".q($R)."
ORDER BY uc.constraint_type, uic.column_position",$j)as$K){$Vc=$K["INDEX_NAME"];$J[$Vc]["type"]=($K["CONSTRAINT_TYPE"]=="P"?"PRIMARY":($K["CONSTRAINT_TYPE"]=="U"?"UNIQUE":"INDEX"));$J[$Vc]["columns"][]=$K["COLUMN_NAME"];$J[$Vc]["lengths"][]=($K["CHAR_LENGTH"]&&$K["CHAR_LENGTH"]!=$K["COLUMN_LENGTH"]?$K["CHAR_LENGTH"]:null);$J[$Vc]["descs"][]=($K["DESCEND"]?'1':null);}return$J;}function
view($C){$L=get_rows('SELECT text "select" FROM user_views WHERE view_name = '.q($C));return
reset($L);}function
collations(){return
array();}function
information_schema($m){return
false;}function
error(){global$i;return
h($i->error);}function
explain($i,$H){$i->query("EXPLAIN PLAN FOR $H");return$i->query("SELECT * FROM plan_table");}function
found_rows($S,$Z){}function
alter_table($R,$C,$q,$uc,$hb,$Sb,$e,$Fa,$ye){$c=$Hb=array();foreach($q
as$p){$X=$p[1];if($X&&$p[0]!=""&&idf_escape($p[0])!=$X[0])queries("ALTER TABLE ".table($R)." RENAME COLUMN ".idf_escape($p[0])." TO $X[0]");if($X)$c[]=($R!=""?($p[0]!=""?"MODIFY (":"ADD ("):"  ").implode($X).($R!=""?")":"");else$Hb[]=idf_escape($p[0]);}if($R=="")return
queries("CREATE TABLE ".table($C)." (\n".implode(",\n",$c)."\n)");return(!$c||queries("ALTER TABLE ".table($R)."\n".implode("\n",$c)))&&(!$Hb||queries("ALTER TABLE ".table($R)." DROP (".implode(", ",$Hb).")"))&&($R==$C||queries("ALTER TABLE ".table($R)." RENAME TO ".table($C)));}function
foreign_keys($R){$J=array();$H="SELECT c_list.CONSTRAINT_NAME as NAME,
c_src.COLUMN_NAME as SRC_COLUMN,
c_dest.OWNER as DEST_DB,
c_dest.TABLE_NAME as DEST_TABLE,
c_dest.COLUMN_NAME as DEST_COLUMN,
c_list.DELETE_RULE as ON_DELETE
FROM ALL_CONSTRAINTS c_list, ALL_CONS_COLUMNS c_src, ALL_CONS_COLUMNS c_dest
WHERE c_list.CONSTRAINT_NAME = c_src.CONSTRAINT_NAME
AND c_list.R_CONSTRAINT_NAME = c_dest.CONSTRAINT_NAME
AND c_list.CONSTRAINT_TYPE = 'R'
AND c_src.TABLE_NAME = ".q($R);foreach(get_rows($H)as$K)$J[$K['NAME']]=array("db"=>$K['DEST_DB'],"table"=>$K['DEST_TABLE'],"source"=>array($K['SRC_COLUMN']),"target"=>array($K['DEST_COLUMN']),"on_delete"=>$K['ON_DELETE'],"on_update"=>null,);return$J;}function
truncate_tables($T){return
apply_queries("TRUNCATE TABLE",$T);}function
drop_views($Qg){return
apply_queries("DROP VIEW",$Qg);}function
drop_tables($T){return
apply_queries("DROP TABLE",$T);}function
last_id(){return
0;}function
schemas(){return
get_vals("SELECT DISTINCT owner FROM dba_segments WHERE owner IN (SELECT username FROM dba_users WHERE default_tablespace NOT IN ('SYSTEM','SYSAUX'))");}function
get_schema(){global$i;return$i->result("SELECT sys_context('USERENV', 'SESSION_USER') FROM dual");}function
set_schema($mf){global$i;return$i->query("ALTER SESSION SET CURRENT_SCHEMA = ".idf_escape($mf));}function
show_variables(){return
get_key_vals('SELECT name, display_value FROM v$parameter');}function
process_list(){return
get_rows('SELECT sess.process AS "process", sess.username AS "user", sess.schemaname AS "schema", sess.status AS "status", sess.wait_class AS "wait_class", sess.seconds_in_wait AS "seconds_in_wait", sql.sql_text AS "sql_text", sess.machine AS "machine", sess.port AS "port"
FROM v$session sess LEFT OUTER JOIN v$sql sql
ON sql.sql_id = sess.sql_id
WHERE sess.type = \'USER\'
ORDER BY PROCESS
');}function
show_status(){$L=get_rows('SELECT * FROM v$instance');return
reset($L);}function
convert_field($p){}function
unconvert_field($p,$J){return$J;}function
support($ic){return
preg_match('~^(columns|database|drop_col|indexes|processlist|scheme|sql|status|table|variables|view|view_trigger)$~',$ic);}$y="oracle";$yg=array();$Of=array();foreach(array(lang(27)=>array("number"=>38,"binary_float"=>12,"binary_double"=>21),lang(28)=>array("date"=>10,"timestamp"=>29,"interval year"=>12,"interval day"=>28),lang(25)=>array("char"=>2000,"varchar2"=>4000,"nchar"=>2000,"nvarchar2"=>4000,"clob"=>4294967295,"nclob"=>4294967295),lang(29)=>array("raw"=>2000,"long raw"=>2147483648,"blob"=>4294967295,"bfile"=>4294967296),)as$z=>$X){$yg+=$X;$Of[$z]=array_keys($X);}$Eg=array();$le=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL");$Cc=array("length","lower","round","upper");$Gc=array("avg","count","count distinct","max","min","sum");$Lb=array(array("date"=>"current_date","timestamp"=>"current_timestamp",),array("number|float|double"=>"+/-","date|timestamp"=>"+ interval/- interval","char|clob"=>"||",));}$Gb["mssql"]="MS SQL (beta)";if(isset($_GET["mssql"])){$Fe=array("SQLSRV","MSSQL","PDO_DBLIB");define("DRIVER","mssql");if(extension_loaded("sqlsrv")){class
Min_DB{var$extension="sqlsrv",$_link,$_result,$server_info,$affected_rows,$errno,$error;function
_get_error(){$this->error="";foreach(sqlsrv_errors()as$o){$this->errno=$o["code"];$this->error.="$o[message]\n";}$this->error=rtrim($this->error);}function
connect($O,$V,$G){$this->_link=@sqlsrv_connect(preg_replace('~:~',',',$O),array("UID"=>$V,"PWD"=>$G,"CharacterSet"=>"UTF-8"));if($this->_link){$cd=sqlsrv_server_info($this->_link);$this->server_info=$cd['SQLServerVersion'];}else$this->_get_error();return(bool)$this->_link;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}function
select_db($k){return$this->query("USE ".idf_escape($k));}function
query($H,$zg=false){$I=sqlsrv_query($this->_link,$H);$this->error="";if(!$I){$this->_get_error();return
false;}return$this->store_result($I);}function
multi_query($H){$this->_result=sqlsrv_query($this->_link,$H);$this->error="";if(!$this->_result){$this->_get_error();return
false;}return
true;}function
store_result($I=null){if(!$I)$I=$this->_result;if(!$I)return
false;if(sqlsrv_field_metadata($I))return
new
Min_Result($I);$this->affected_rows=sqlsrv_rows_affected($I);return
true;}function
next_result(){return$this->_result?sqlsrv_next_result($this->_result):null;}function
result($H,$p=0){$I=$this->query($H);if(!is_object($I))return
false;$K=$I->fetch_row();return$K[$p];}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($I){$this->_result=$I;}function
_convert($K){foreach((array)$K
as$z=>$X){if(is_a($X,'DateTime'))$K[$z]=$X->format("Y-m-d H:i:s");}return$K;}function
fetch_assoc(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_ASSOC));}function
fetch_row(){return$this->_convert(sqlsrv_fetch_array($this->_result,SQLSRV_FETCH_NUMERIC));}function
fetch_field(){if(!$this->_fields)$this->_fields=sqlsrv_field_metadata($this->_result);$p=$this->_fields[$this->_offset++];$J=new
stdClass;$J->name=$p["Name"];$J->orgname=$p["Name"];$J->type=($p["Type"]==1?254:0);return$J;}function
seek($ee){for($t=0;$t<$ee;$t++)sqlsrv_fetch($this->_result);}function
__destruct(){sqlsrv_free_stmt($this->_result);}}}elseif(extension_loaded("mssql")){class
Min_DB{var$extension="MSSQL",$_link,$_result,$server_info,$affected_rows,$error;function
connect($O,$V,$G){$this->_link=@mssql_connect($O,$V,$G);if($this->_link){$I=$this->query("SELECT SERVERPROPERTY('ProductLevel'), SERVERPROPERTY('Edition')");if($I){$K=$I->fetch_row();$this->server_info=$this->result("sp_server_info 2",2)." [$K[0]] $K[1]";}}else$this->error=mssql_get_last_message();return(bool)$this->_link;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}function
select_db($k){return
mssql_select_db($k);}function
query($H,$zg=false){$I=@mssql_query($H,$this->_link);$this->error="";if(!$I){$this->error=mssql_get_last_message();return
false;}if($I===true){$this->affected_rows=mssql_rows_affected($this->_link);return
true;}return
new
Min_Result($I);}function
multi_query($H){return$this->_result=$this->query($H);}function
store_result(){return$this->_result;}function
next_result(){return
mssql_next_result($this->_result->_result);}function
result($H,$p=0){$I=$this->query($H);if(!is_object($I))return
false;return
mssql_result($I->_result,0,$p);}}class
Min_Result{var$_result,$_offset=0,$_fields,$num_rows;function
__construct($I){$this->_result=$I;$this->num_rows=mssql_num_rows($I);}function
fetch_assoc(){return
mssql_fetch_assoc($this->_result);}function
fetch_row(){return
mssql_fetch_row($this->_result);}function
num_rows(){return
mssql_num_rows($this->_result);}function
fetch_field(){$J=mssql_fetch_field($this->_result);$J->orgtable=$J->table;$J->orgname=$J->name;return$J;}function
seek($ee){mssql_data_seek($this->_result,$ee);}function
__destruct(){mssql_free_result($this->_result);}}}elseif(extension_loaded("pdo_dblib")){class
Min_DB
extends
Min_PDO{var$extension="PDO_DBLIB";function
connect($O,$V,$G){$this->dsn("dblib:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$O)),$V,$G);return
true;}function
select_db($k){return$this->query("USE ".idf_escape($k));}}}class
Min_Driver
extends
Min_SQL{function
insertUpdate($R,$L,$He){foreach($L
as$P){$Fg=array();$Z=array();foreach($P
as$z=>$X){$Fg[]="$z = $X";if(isset($He[idf_unescape($z)]))$Z[]="$z = $X";}if(!queries("MERGE ".table($R)." USING (VALUES(".implode(", ",$P).")) AS source (c".implode(", c",range(1,count($P))).") ON ".implode(" AND ",$Z)." WHEN MATCHED THEN UPDATE SET ".implode(", ",$Fg)." WHEN NOT MATCHED THEN INSERT (".implode(", ",array_keys($P)).") VALUES (".implode(", ",$P).");"))return
false;}return
true;}function
begin(){return
queries("BEGIN TRANSACTION");}}function
idf_escape($v){return"[".str_replace("]","]]",$v)."]";}function
table($v){return($_GET["ns"]!=""?idf_escape($_GET["ns"]).".":"").idf_escape($v);}function
connect(){global$b;$i=new
Min_DB;$qb=$b->credentials();if($i->connect($qb[0],$qb[1],$qb[2]))return$i;return$i->error;}function
get_databases(){return
get_vals("SELECT name FROM sys.databases WHERE name NOT IN ('master', 'tempdb', 'model', 'msdb')");}function
limit($H,$Z,$_,$ee=0,$N=" "){return($_!==null?" TOP (".($_+$ee).")":"")." $H$Z";}function
limit1($R,$H,$Z,$N="\n"){return
limit($H,$Z,1,0,$N);}function
db_collation($m,$db){global$i;return$i->result("SELECT collation_name FROM sys.databases WHERE name = ".q($m));}function
engines(){return
array();}function
logged_user(){global$i;return$i->result("SELECT SUSER_NAME()");}function
tables_list(){return
get_key_vals("SELECT name, type_desc FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ORDER BY name");}function
count_tables($l){global$i;$J=array();foreach($l
as$m){$i->select_db($m);$J[$m]=$i->result("SELECT COUNT(*) FROM INFORMATION_SCHEMA.TABLES");}return$J;}function
table_status($C=""){$J=array();foreach(get_rows("SELECT name AS Name, type_desc AS Engine FROM sys.all_objects WHERE schema_id = SCHEMA_ID(".q(get_schema()).") AND type IN ('S', 'U', 'V') ".($C!=""?"AND name = ".q($C):"ORDER BY name"))as$K){if($C!="")return$K;$J[$K["Name"]]=$K;}return$J;}function
is_view($S){return$S["Engine"]=="VIEW";}function
fk_support($S){return
true;}function
fields($R){$J=array();foreach(get_rows("SELECT c.max_length, c.precision, c.scale, c.name, c.is_nullable, c.is_identity, c.collation_name, t.name type, CAST(d.definition as text) [default]
FROM sys.all_columns c
JOIN sys.all_objects o ON c.object_id = o.object_id
JOIN sys.types t ON c.user_type_id = t.user_type_id
LEFT JOIN sys.default_constraints d ON c.default_object_id = d.parent_column_id
WHERE o.schema_id = SCHEMA_ID(".q(get_schema()).") AND o.type IN ('S', 'U', 'V') AND o.name = ".q($R))as$K){$U=$K["type"];$zd=(preg_match("~char|binary~",$U)?$K["max_length"]:($U=="decimal"?"$K[precision],$K[scale]":""));$J[$K["name"]]=array("field"=>$K["name"],"full_type"=>$U.($zd?"($zd)":""),"type"=>$U,"length"=>$zd,"default"=>$K["default"],"null"=>$K["is_nullable"],"auto_increment"=>$K["is_identity"],"collation"=>$K["collation_name"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"primary"=>$K["is_identity"],);}return$J;}function
indexes($R,$j=null){$J=array();foreach(get_rows("SELECT i.name, key_ordinal, is_unique, is_primary_key, c.name AS column_name, is_descending_key
FROM sys.indexes i
INNER JOIN sys.index_columns ic ON i.object_id = ic.object_id AND i.index_id = ic.index_id
INNER JOIN sys.columns c ON ic.object_id = c.object_id AND ic.column_id = c.column_id
WHERE OBJECT_NAME(i.object_id) = ".q($R),$j)as$K){$C=$K["name"];$J[$C]["type"]=($K["is_primary_key"]?"PRIMARY":($K["is_unique"]?"UNIQUE":"INDEX"));$J[$C]["lengths"]=array();$J[$C]["columns"][$K["key_ordinal"]]=$K["column_name"];$J[$C]["descs"][$K["key_ordinal"]]=($K["is_descending_key"]?'1':null);}return$J;}function
view($C){global$i;return
array("select"=>preg_replace('~^(?:[^[]|\[[^]]*])*\s+AS\s+~isU','',$i->result("SELECT VIEW_DEFINITION FROM INFORMATION_SCHEMA.VIEWS WHERE TABLE_SCHEMA = SCHEMA_NAME() AND TABLE_NAME = ".q($C))));}function
collations(){$J=array();foreach(get_vals("SELECT name FROM fn_helpcollations()")as$e)$J[preg_replace('~_.*~','',$e)][]=$e;return$J;}function
information_schema($m){return
false;}function
error(){global$i;return
nl_br(h(preg_replace('~^(\[[^]]*])+~m','',$i->error)));}function
create_database($m,$e){return
queries("CREATE DATABASE ".idf_escape($m).(preg_match('~^[a-z0-9_]+$~i',$e)?" COLLATE $e":""));}function
drop_databases($l){return
queries("DROP DATABASE ".implode(", ",array_map('idf_escape',$l)));}function
rename_database($C,$e){if(preg_match('~^[a-z0-9_]+$~i',$e))queries("ALTER DATABASE ".idf_escape(DB)." COLLATE $e");queries("ALTER DATABASE ".idf_escape(DB)." MODIFY NAME = ".idf_escape($C));return
true;}function
auto_increment(){return" IDENTITY".($_POST["Auto_increment"]!=""?"(".number($_POST["Auto_increment"]).",1)":"")." PRIMARY KEY";}function
alter_table($R,$C,$q,$uc,$hb,$Sb,$e,$Fa,$ye){$c=array();foreach($q
as$p){$f=idf_escape($p[0]);$X=$p[1];if(!$X)$c["DROP"][]=" COLUMN $f";else{$X[1]=preg_replace("~( COLLATE )'(\\w+)'~",'\1\2',$X[1]);if($p[0]=="")$c["ADD"][]="\n  ".implode("",$X).($R==""?substr($uc[$X[0]],16+strlen($X[0])):"");else{unset($X[6]);if($f!=$X[0])queries("EXEC sp_rename ".q(table($R).".$f").", ".q(idf_unescape($X[0])).", 'COLUMN'");$c["ALTER COLUMN ".implode("",$X)][]="";}}}if($R=="")return
queries("CREATE TABLE ".table($C)." (".implode(",",(array)$c["ADD"])."\n)");if($R!=$C)queries("EXEC sp_rename ".q(table($R)).", ".q($C));if($uc)$c[""]=$uc;foreach($c
as$z=>$X){if(!queries("ALTER TABLE ".idf_escape($C)." $z".implode(",",$X)))return
false;}return
true;}function
alter_indexes($R,$c){$w=array();$Hb=array();foreach($c
as$X){if($X[2]=="DROP"){if($X[0]=="PRIMARY")$Hb[]=idf_escape($X[1]);else$w[]=idf_escape($X[1])." ON ".table($R);}elseif(!queries(($X[0]!="PRIMARY"?"CREATE $X[0] ".($X[0]!="INDEX"?"INDEX ":"").idf_escape($X[1]!=""?$X[1]:uniqid($R."_"))." ON ".table($R):"ALTER TABLE ".table($R)." ADD PRIMARY KEY")." (".implode(", ",$X[2]).")"))return
false;}return(!$w||queries("DROP INDEX ".implode(", ",$w)))&&(!$Hb||queries("ALTER TABLE ".table($R)." DROP ".implode(", ",$Hb)));}function
last_id(){global$i;return$i->result("SELECT SCOPE_IDENTITY()");}function
explain($i,$H){$i->query("SET SHOWPLAN_ALL ON");$J=$i->query($H);$i->query("SET SHOWPLAN_ALL OFF");return$J;}function
found_rows($S,$Z){}function
foreign_keys($R){$J=array();foreach(get_rows("EXEC sp_fkeys @fktable_name = ".q($R))as$K){$xc=&$J[$K["FK_NAME"]];$xc["table"]=$K["PKTABLE_NAME"];$xc["source"][]=$K["FKCOLUMN_NAME"];$xc["target"][]=$K["PKCOLUMN_NAME"];}return$J;}function
truncate_tables($T){return
apply_queries("TRUNCATE TABLE",$T);}function
drop_views($Qg){return
queries("DROP VIEW ".implode(", ",array_map('table',$Qg)));}function
drop_tables($T){return
queries("DROP TABLE ".implode(", ",array_map('table',$T)));}function
move_tables($T,$Qg,$Yf){return
apply_queries("ALTER SCHEMA ".idf_escape($Yf)." TRANSFER",array_merge($T,$Qg));}function
trigger($C){if($C=="")return
array();$L=get_rows("SELECT s.name [Trigger],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(s.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(s.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(s.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing],
c.text
FROM sysobjects s
JOIN syscomments c ON s.id = c.id
WHERE s.xtype = 'TR' AND s.name = ".q($C));$J=reset($L);if($J)$J["Statement"]=preg_replace('~^.+\s+AS\s+~isU','',$J["text"]);return$J;}function
triggers($R){$J=array();foreach(get_rows("SELECT sys1.name,
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsertTrigger') = 1 THEN 'INSERT' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsUpdateTrigger') = 1 THEN 'UPDATE' WHEN OBJECTPROPERTY(sys1.id, 'ExecIsDeleteTrigger') = 1 THEN 'DELETE' END [Event],
CASE WHEN OBJECTPROPERTY(sys1.id, 'ExecIsInsteadOfTrigger') = 1 THEN 'INSTEAD OF' ELSE 'AFTER' END [Timing]
FROM sysobjects sys1
JOIN sysobjects sys2 ON sys1.parent_obj = sys2.id
WHERE sys1.xtype = 'TR' AND sys2.name = ".q($R))as$K)$J[$K["name"]]=array($K["Timing"],$K["Event"]);return$J;}function
trigger_options(){return
array("Timing"=>array("AFTER","INSTEAD OF"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("AS"),);}function
schemas(){return
get_vals("SELECT name FROM sys.schemas");}function
get_schema(){global$i;if($_GET["ns"]!="")return$_GET["ns"];return$i->result("SELECT SCHEMA_NAME()");}function
set_schema($lf){return
true;}function
use_sql($k){return"USE ".idf_escape($k);}function
show_variables(){return
array();}function
show_status(){return
array();}function
convert_field($p){}function
unconvert_field($p,$J){return$J;}function
support($ic){return
preg_match('~^(columns|database|drop_col|indexes|scheme|sql|table|trigger|view|view_trigger)$~',$ic);}$y="mssql";$yg=array();$Of=array();foreach(array(lang(27)=>array("tinyint"=>3,"smallint"=>5,"int"=>10,"bigint"=>20,"bit"=>1,"decimal"=>0,"real"=>12,"float"=>53,"smallmoney"=>10,"money"=>20),lang(28)=>array("date"=>10,"smalldatetime"=>19,"datetime"=>19,"datetime2"=>19,"time"=>8,"datetimeoffset"=>10),lang(25)=>array("char"=>8000,"varchar"=>8000,"text"=>2147483647,"nchar"=>4000,"nvarchar"=>4000,"ntext"=>1073741823),lang(29)=>array("binary"=>8000,"varbinary"=>8000,"image"=>2147483647),)as$z=>$X){$yg+=$X;$Of[$z]=array_keys($X);}$Eg=array();$le=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","NOT IN","IS NOT NULL");$Cc=array("len","lower","round","upper");$Gc=array("avg","count","count distinct","max","min","sum");$Lb=array(array("date|time"=>"getdate",),array("int|decimal|real|float|money|datetime"=>"+/-","char|text"=>"+",));}$Gb['firebird']='Firebird (alpha)';if(isset($_GET["firebird"])){$Fe=array("interbase");define("DRIVER","firebird");if(extension_loaded("interbase")){class
Min_DB{var$extension="Firebird",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($O,$V,$G){$this->_link=ibase_connect($O,$V,$G);if($this->_link){$Ig=explode(':',$O);$this->service_link=ibase_service_attach($Ig[0],$V,$G);$this->server_info=ibase_server_info($this->service_link,IBASE_SVC_SERVER_VERSION);}else{$this->errno=ibase_errcode();$this->error=ibase_errmsg();}return(bool)$this->_link;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}function
select_db($k){return($k=="domain");}function
query($H,$zg=false){$I=ibase_query($H,$this->_link);if(!$I){$this->errno=ibase_errcode();$this->error=ibase_errmsg();return
false;}$this->error="";if($I===true){$this->affected_rows=ibase_affected_rows($this->_link);return
true;}return
new
Min_Result($I);}function
multi_query($H){return$this->_result=$this->query($H);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($H,$p=0){$I=$this->query($H);if(!$I||!$I->num_rows)return
false;$K=$I->fetch_row();return$K[$p];}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($I){$this->_result=$I;}function
fetch_assoc(){return
ibase_fetch_assoc($this->_result);}function
fetch_row(){return
ibase_fetch_row($this->_result);}function
fetch_field(){$p=ibase_field_info($this->_result,$this->_offset++);return(object)array('name'=>$p['name'],'orgname'=>$p['name'],'type'=>$p['type'],'charsetnr'=>$p['length'],);}function
__destruct(){ibase_free_result($this->_result);}}}class
Min_Driver
extends
Min_SQL{}function
idf_escape($v){return'"'.str_replace('"','""',$v).'"';}function
table($v){return
idf_escape($v);}function
connect(){global$b;$i=new
Min_DB;$qb=$b->credentials();if($i->connect($qb[0],$qb[1],$qb[2]))return$i;return$i->error;}function
get_databases($sc){return
array("domain");}function
limit($H,$Z,$_,$ee=0,$N=" "){$J='';$J.=($_!==null?$N."FIRST $_".($ee?" SKIP $ee":""):"");$J.=" $H$Z";return$J;}function
limit1($R,$H,$Z,$N="\n"){return
limit($H,$Z,1,0,$N);}function
db_collation($m,$db){}function
engines(){return
array();}function
logged_user(){global$b;$qb=$b->credentials();return$qb[1];}function
tables_list(){global$i;$H='SELECT RDB$RELATION_NAME FROM rdb$relations WHERE rdb$system_flag = 0';$I=ibase_query($i->_link,$H);$J=array();while($K=ibase_fetch_assoc($I))$J[$K['RDB$RELATION_NAME']]='table';ksort($J);return$J;}function
count_tables($l){return
array();}function
table_status($C="",$hc=false){global$i;$J=array();$ub=tables_list();foreach($ub
as$w=>$X){$w=trim($w);$J[$w]=array('Name'=>$w,'Engine'=>'standard',);if($C==$w)return$J[$w];}return$J;}function
is_view($S){return
false;}function
fk_support($S){return
preg_match('~InnoDB|IBMDB2I~i',$S["Engine"]);}function
fields($R){global$i;$J=array();$H='SELECT r.RDB$FIELD_NAME AS field_name,
r.RDB$DESCRIPTION AS field_description,
r.RDB$DEFAULT_VALUE AS field_default_value,
r.RDB$NULL_FLAG AS field_not_null_constraint,
f.RDB$FIELD_LENGTH AS field_length,
f.RDB$FIELD_PRECISION AS field_precision,
f.RDB$FIELD_SCALE AS field_scale,
CASE f.RDB$FIELD_TYPE
WHEN 261 THEN \'BLOB\'
WHEN 14 THEN \'CHAR\'
WHEN 40 THEN \'CSTRING\'
WHEN 11 THEN \'D_FLOAT\'
WHEN 27 THEN \'DOUBLE\'
WHEN 10 THEN \'FLOAT\'
WHEN 16 THEN \'INT64\'
WHEN 8 THEN \'INTEGER\'
WHEN 9 THEN \'QUAD\'
WHEN 7 THEN \'SMALLINT\'
WHEN 12 THEN \'DATE\'
WHEN 13 THEN \'TIME\'
WHEN 35 THEN \'TIMESTAMP\'
WHEN 37 THEN \'VARCHAR\'
ELSE \'UNKNOWN\'
END AS field_type,
f.RDB$FIELD_SUB_TYPE AS field_subtype,
coll.RDB$COLLATION_NAME AS field_collation,
cset.RDB$CHARACTER_SET_NAME AS field_charset
FROM RDB$RELATION_FIELDS r
LEFT JOIN RDB$FIELDS f ON r.RDB$FIELD_SOURCE = f.RDB$FIELD_NAME
LEFT JOIN RDB$COLLATIONS coll ON f.RDB$COLLATION_ID = coll.RDB$COLLATION_ID
LEFT JOIN RDB$CHARACTER_SETS cset ON f.RDB$CHARACTER_SET_ID = cset.RDB$CHARACTER_SET_ID
WHERE r.RDB$RELATION_NAME = '.q($R).'
ORDER BY r.RDB$FIELD_POSITION';$I=ibase_query($i->_link,$H);while($K=ibase_fetch_assoc($I))$J[trim($K['FIELD_NAME'])]=array("field"=>trim($K["FIELD_NAME"]),"full_type"=>trim($K["FIELD_TYPE"]),"type"=>trim($K["FIELD_SUB_TYPE"]),"default"=>trim($K['FIELD_DEFAULT_VALUE']),"null"=>(trim($K["FIELD_NOT_NULL_CONSTRAINT"])=="YES"),"auto_increment"=>'0',"collation"=>trim($K["FIELD_COLLATION"]),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),"comment"=>trim($K["FIELD_DESCRIPTION"]),);return$J;}function
indexes($R,$j=null){$J=array();return$J;}function
foreign_keys($R){return
array();}function
collations(){return
array();}function
information_schema($m){return
false;}function
error(){global$i;return
h($i->error);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($lf){return
true;}function
support($ic){return
preg_match("~^(columns|sql|status|table)$~",$ic);}$y="firebird";$le=array("=");$Cc=array();$Gc=array();$Lb=array();}$Gb["simpledb"]="SimpleDB";if(isset($_GET["simpledb"])){$Fe=array("SimpleXML + allow_url_fopen");define("DRIVER","simpledb");if(class_exists('SimpleXMLElement')&&ini_bool('allow_url_fopen')){class
Min_DB{var$extension="SimpleXML",$server_info='2009-04-15',$error,$timeout,$next,$affected_rows,$_result;function
select_db($k){return($k=="domain");}function
query($H,$zg=false){$F=array('SelectExpression'=>$H,'ConsistentRead'=>'true');if($this->next)$F['NextToken']=$this->next;$I=sdb_request_all('Select','Item',$F,$this->timeout);$this->timeout=0;if($I===false)return$I;if(preg_match('~^\s*SELECT\s+COUNT\(~i',$H)){$Sf=0;foreach($I
as$ld)$Sf+=$ld->Attribute->Value;$I=array((object)array('Attribute'=>array((object)array('Name'=>'Count','Value'=>$Sf,))));}return
new
Min_Result($I);}function
multi_query($H){return$this->_result=$this->query($H);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
quote($Q){return"'".str_replace("'","''",$Q)."'";}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0;function
__construct($I){foreach($I
as$ld){$K=array();if($ld->Name!='')$K['itemName()']=(string)$ld->Name;foreach($ld->Attribute
as$Ca){$C=$this->_processValue($Ca->Name);$Y=$this->_processValue($Ca->Value);if(isset($K[$C])){$K[$C]=(array)$K[$C];$K[$C][]=$Y;}else$K[$C]=$Y;}$this->_rows[]=$K;foreach($K
as$z=>$X){if(!isset($this->_rows[0][$z]))$this->_rows[0][$z]=null;}}$this->num_rows=count($this->_rows);}function
_processValue($Nb){return(is_object($Nb)&&$Nb['encoding']=='base64'?base64_decode($Nb):(string)$Nb);}function
fetch_assoc(){$K=current($this->_rows);if(!$K)return$K;$J=array();foreach($this->_rows[0]as$z=>$X)$J[$z]=$K[$z];next($this->_rows);return$J;}function
fetch_row(){$J=$this->fetch_assoc();if(!$J)return$J;return
array_values($J);}function
fetch_field(){$qd=array_keys($this->_rows[0]);return(object)array('name'=>$qd[$this->_offset++]);}}}class
Min_Driver
extends
Min_SQL{public$He="itemName()";function
_chunkRequest($Tc,$ra,$F,$ac=array()){global$i;foreach(array_chunk($Tc,25)as$Ya){$we=$F;foreach($Ya
as$t=>$u){$we["Item.$t.ItemName"]=$u;foreach($ac
as$z=>$X)$we["Item.$t.$z"]=$X;}if(!sdb_request($ra,$we))return
false;}$i->affected_rows=count($Tc);return
true;}function
_extractIds($R,$Qe,$_){$J=array();if(preg_match_all("~itemName\(\) = (('[^']*+')+)~",$Qe,$Jd))$J=array_map('idf_unescape',$Jd[1]);else{foreach(sdb_request_all('Select','Item',array('SelectExpression'=>'SELECT itemName() FROM '.table($R).$Qe.($_?" LIMIT 1":"")))as$ld)$J[]=$ld->Name;}return$J;}function
select($R,$M,$Z,$Dc,$oe=array(),$_=1,$E=0,$Je=false){global$i;$i->next=$_GET["next"];$J=parent::select($R,$M,$Z,$Dc,$oe,$_,$E,$Je);$i->next=0;return$J;}function
delete($R,$Qe,$_=0){return$this->_chunkRequest($this->_extractIds($R,$Qe,$_),'BatchDeleteAttributes',array('DomainName'=>$R));}function
update($R,$P,$Qe,$_=0,$N="\n"){$zb=array();$gd=array();$t=0;$Tc=$this->_extractIds($R,$Qe,$_);$u=idf_unescape($P["`itemName()`"]);unset($P["`itemName()`"]);foreach($P
as$z=>$X){$z=idf_unescape($z);if($X=="NULL"||($u!=""&&array($u)!=$Tc))$zb["Attribute.".count($zb).".Name"]=$z;if($X!="NULL"){foreach((array)$X
as$md=>$W){$gd["Attribute.$t.Name"]=$z;$gd["Attribute.$t.Value"]=(is_array($X)?$W:idf_unescape($W));if(!$md)$gd["Attribute.$t.Replace"]="true";$t++;}}}$F=array('DomainName'=>$R);return(!$gd||$this->_chunkRequest(($u!=""?array($u):$Tc),'BatchPutAttributes',$F,$gd))&&(!$zb||$this->_chunkRequest($Tc,'BatchDeleteAttributes',$F,$zb));}function
insert($R,$P){$F=array("DomainName"=>$R);$t=0;foreach($P
as$C=>$Y){if($Y!="NULL"){$C=idf_unescape($C);if($C=="itemName()")$F["ItemName"]=idf_unescape($Y);else{foreach((array)$Y
as$X){$F["Attribute.$t.Name"]=$C;$F["Attribute.$t.Value"]=(is_array($Y)?$X:idf_unescape($Y));$t++;}}}}return
sdb_request('PutAttributes',$F);}function
insertUpdate($R,$L,$He){foreach($L
as$P){if(!$this->update($R,$P,"WHERE `itemName()` = ".q($P["`itemName()`"])))return
false;}return
true;}function
begin(){return
false;}function
commit(){return
false;}function
rollback(){return
false;}function
slowQuery($H,$eg){$this->_conn->timeout=$eg;return$H;}}function
connect(){global$b;list(,,$G)=$b->credentials();if($G!="")return
lang(22);return
new
Min_DB;}function
support($ic){return
preg_match('~sql~',$ic);}function
logged_user(){global$b;$qb=$b->credentials();return$qb[1];}function
get_databases(){return
array("domain");}function
collations(){return
array();}function
db_collation($m,$db){}function
tables_list(){global$i;$J=array();foreach(sdb_request_all('ListDomains','DomainName')as$R)$J[(string)$R]='table';if($i->error&&defined("PAGE_HEADER"))echo"<p class='error'>".error()."\n";return$J;}function
table_status($C="",$hc=false){$J=array();foreach(($C!=""?array($C=>true):tables_list())as$R=>$U){$K=array("Name"=>$R,"Auto_increment"=>"");if(!$hc){$Rd=sdb_request('DomainMetadata',array('DomainName'=>$R));if($Rd){foreach(array("Rows"=>"ItemCount","Data_length"=>"ItemNamesSizeBytes","Index_length"=>"AttributeValuesSizeBytes","Data_free"=>"AttributeNamesSizeBytes",)as$z=>$X)$K[$z]=(string)$Rd->$X;}}if($C!="")return$K;$J[$R]=$K;}return$J;}function
explain($i,$H){}function
error(){global$i;return
h($i->error);}function
information_schema(){}function
is_view($S){}function
indexes($R,$j=null){return
array(array("type"=>"PRIMARY","columns"=>array("itemName()")),);}function
fields($R){return
fields_from_edit();}function
foreign_keys($R){return
array();}function
table($v){return
idf_escape($v);}function
idf_escape($v){return"`".str_replace("`","``",$v)."`";}function
limit($H,$Z,$_,$ee=0,$N=" "){return" $H$Z".($_!==null?$N."LIMIT $_":"");}function
unconvert_field($p,$J){return$J;}function
fk_support($S){}function
engines(){return
array();}function
alter_table($R,$C,$q,$uc,$hb,$Sb,$e,$Fa,$ye){return($R==""&&sdb_request('CreateDomain',array('DomainName'=>$C)));}function
drop_tables($T){foreach($T
as$R){if(!sdb_request('DeleteDomain',array('DomainName'=>$R)))return
false;}return
true;}function
count_tables($l){foreach($l
as$m)return
array($m=>count(tables_list()));}function
found_rows($S,$Z){return($Z?null:$S["Rows"]);}function
last_id(){}function
hmac($wa,$ub,$z,$Ue=false){$Oa=64;if(strlen($z)>$Oa)$z=pack("H*",$wa($z));$z=str_pad($z,$Oa,"\0");$nd=$z^str_repeat("\x36",$Oa);$od=$z^str_repeat("\x5C",$Oa);$J=$wa($od.pack("H*",$wa($nd.$ub)));if($Ue)$J=pack("H*",$J);return$J;}function
sdb_request($ra,$F=array()){global$b,$i;list($Qc,$F['AWSAccessKeyId'],$of)=$b->credentials();$F['Action']=$ra;$F['Timestamp']=gmdate('Y-m-d\TH:i:s+00:00');$F['Version']='2009-04-15';$F['SignatureVersion']=2;$F['SignatureMethod']='HmacSHA1';ksort($F);$H='';foreach($F
as$z=>$X)$H.='&'.rawurlencode($z).'='.rawurlencode($X);$H=str_replace('%7E','~',substr($H,1));$H.="&Signature=".urlencode(base64_encode(hmac('sha1',"POST\n".preg_replace('~^https?://~','',$Qc)."\n/\n$H",$of,true)));@ini_set('track_errors',1);$lc=@file_get_contents((preg_match('~^https?://~',$Qc)?$Qc:"http://$Qc"),false,stream_context_create(array('http'=>array('method'=>'POST','content'=>$H,'ignore_errors'=>1,))));if(!$lc){$i->error=$php_errormsg;return
false;}libxml_use_internal_errors(true);$bh=simplexml_load_string($lc);if(!$bh){$o=libxml_get_last_error();$i->error=$o->message;return
false;}if($bh->Errors){$o=$bh->Errors->Error;$i->error="$o->Message ($o->Code)";return
false;}$i->error='';$Xf=$ra."Result";return($bh->$Xf?$bh->$Xf:true);}function
sdb_request_all($ra,$Xf,$F=array(),$eg=0){$J=array();$Kf=($eg?microtime(true):0);$_=(preg_match('~LIMIT\s+(\d+)\s*$~i',$F['SelectExpression'],$B)?$B[1]:0);do{$bh=sdb_request($ra,$F);if(!$bh)break;foreach($bh->$Xf
as$Nb)$J[]=$Nb;if($_&&count($J)>=$_){$_GET["next"]=$bh->NextToken;break;}if($eg&&microtime(true)-$Kf>$eg)return
false;$F['NextToken']=$bh->NextToken;if($_)$F['SelectExpression']=preg_replace('~\d+\s*$~',$_-count($J),$F['SelectExpression']);}while($bh->NextToken);return$J;}$y="simpledb";$le=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","IN","IS NULL","NOT LIKE","IS NOT NULL");$Cc=array();$Gc=array("count");$Lb=array(array("json"));}$Gb["mongo"]="MongoDB";if(isset($_GET["mongo"])){$Fe=array("mongo","mongodb");define("DRIVER","mongo");if(class_exists('MongoDB')){class
Min_DB{var$extension="Mongo",$server_info=MongoClient::VERSION,$error,$last_id,$_link,$_db;function
connect($Gg,$D){return@new
MongoClient($Gg,$D);}function
query($H){return
false;}function
select_db($k){try{$this->_db=$this->_link->selectDB($k);return
true;}catch(Exception$Xb){$this->error=$Xb->getMessage();return
false;}}function
quote($Q){return$Q;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($I){foreach($I
as$ld){$K=array();foreach($ld
as$z=>$X){if(is_a($X,'MongoBinData'))$this->_charset[$z]=63;$K[$z]=(is_a($X,'MongoId')?'ObjectId("'.strval($X).'")':(is_a($X,'MongoDate')?gmdate("Y-m-d H:i:s",$X->sec)." GMT":(is_a($X,'MongoBinData')?$X->bin:(is_a($X,'MongoRegex')?strval($X):(is_object($X)?get_class($X):$X)))));}$this->_rows[]=$K;foreach($K
as$z=>$X){if(!isset($this->_rows[0][$z]))$this->_rows[0][$z]=null;}}$this->num_rows=count($this->_rows);}function
fetch_assoc(){$K=current($this->_rows);if(!$K)return$K;$J=array();foreach($this->_rows[0]as$z=>$X)$J[$z]=$K[$z];next($this->_rows);return$J;}function
fetch_row(){$J=$this->fetch_assoc();if(!$J)return$J;return
array_values($J);}function
fetch_field(){$qd=array_keys($this->_rows[0]);$C=$qd[$this->_offset++];return(object)array('name'=>$C,'charsetnr'=>$this->_charset[$C],);}}class
Min_Driver
extends
Min_SQL{public$He="_id";function
select($R,$M,$Z,$Dc,$oe=array(),$_=1,$E=0,$Je=false){$M=($M==array("*")?array():array_fill_keys($M,true));$Df=array();foreach($oe
as$X){$X=preg_replace('~ DESC$~','',$X,1,$nb);$Df[$X]=($nb?-1:1);}return
new
Min_Result($this->_conn->_db->selectCollection($R)->find(array(),$M)->sort($Df)->limit($_!=""?+$_:0)->skip($E*$_));}function
insert($R,$P){try{$J=$this->_conn->_db->selectCollection($R)->insert($P);$this->_conn->errno=$J['code'];$this->_conn->error=$J['err'];$this->_conn->last_id=$P['_id'];return!$J['err'];}catch(Exception$Xb){$this->_conn->error=$Xb->getMessage();return
false;}}}function
get_databases($sc){global$i;$J=array();$wb=$i->_link->listDBs();foreach($wb['databases']as$m)$J[]=$m['name'];return$J;}function
count_tables($l){global$i;$J=array();foreach($l
as$m)$J[$m]=count($i->_link->selectDB($m)->getCollectionNames(true));return$J;}function
tables_list(){global$i;return
array_fill_keys($i->_db->getCollectionNames(true),'table');}function
drop_databases($l){global$i;foreach($l
as$m){$df=$i->_link->selectDB($m)->drop();if(!$df['ok'])return
false;}return
true;}function
indexes($R,$j=null){global$i;$J=array();foreach($i->_db->selectCollection($R)->getIndexInfo()as$w){$Bb=array();foreach($w["key"]as$f=>$U)$Bb[]=($U==-1?'1':null);$J[$w["name"]]=array("type"=>($w["name"]=="_id_"?"PRIMARY":($w["unique"]?"UNIQUE":"INDEX")),"columns"=>array_keys($w["key"]),"lengths"=>array(),"descs"=>$Bb,);}return$J;}function
fields($R){return
fields_from_edit();}function
found_rows($S,$Z){global$i;return$i->_db->selectCollection($_GET["select"])->count($Z);}$le=array("=");}elseif(class_exists('MongoDB\Driver\Manager')){class
Min_DB{var$extension="MongoDB",$server_info=MONGODB_VERSION,$error,$last_id;var$_link;var$_db,$_db_name;function
connect($Gg,$D){$d='MongoDB\Driver\Manager';return
new$d($Gg,$D);}function
query($H){return
false;}function
select_db($k){$this->_db_name=$k;return
true;}function
quote($Q){return$Q;}}class
Min_Result{var$num_rows,$_rows=array(),$_offset=0,$_charset=array();function
__construct($I){foreach($I
as$ld){$K=array();foreach($ld
as$z=>$X){if(is_a($X,'MongoDB\BSON\Binary'))$this->_charset[$z]=63;$K[$z]=(is_a($X,'MongoDB\BSON\ObjectID')?'MongoDB\BSON\ObjectID("'.strval($X).'")':(is_a($X,'MongoDB\BSON\UTCDatetime')?$X->toDateTime()->format('Y-m-d H:i:s'):(is_a($X,'MongoDB\BSON\Binary')?$X->bin:(is_a($X,'MongoDB\BSON\Regex')?strval($X):(is_object($X)?json_encode($X,256):$X)))));}$this->_rows[]=$K;foreach($K
as$z=>$X){if(!isset($this->_rows[0][$z]))$this->_rows[0][$z]=null;}}$this->num_rows=$I->count;}function
fetch_assoc(){$K=current($this->_rows);if(!$K)return$K;$J=array();foreach($this->_rows[0]as$z=>$X)$J[$z]=$K[$z];next($this->_rows);return$J;}function
fetch_row(){$J=$this->fetch_assoc();if(!$J)return$J;return
array_values($J);}function
fetch_field(){$qd=array_keys($this->_rows[0]);$C=$qd[$this->_offset++];return(object)array('name'=>$C,'charsetnr'=>$this->_charset[$C],);}}class
Min_Driver
extends
Min_SQL{public$He="_id";function
select($R,$M,$Z,$Dc,$oe=array(),$_=1,$E=0,$Je=false){global$i;$M=($M==array("*")?array():array_fill_keys($M,1));if(count($M)&&!isset($M['_id']))$M['_id']=0;$Z=where_to_query($Z);$Df=array();foreach($oe
as$X){$X=preg_replace('~ DESC$~','',$X,1,$nb);$Df[$X]=($nb?-1:1);}if(isset($_GET['limit'])&&is_numeric($_GET['limit'])&&$_GET['limit']>0)$_=$_GET['limit'];$_=min(200,max(1,(int)$_));$Af=$E*$_;$d='MongoDB\Driver\Query';$H=new$d($Z,array('projection'=>$M,'limit'=>$_,'skip'=>$Af,'sort'=>$Df));$gf=$i->_link->executeQuery("$i->_db_name.$R",$H);return
new
Min_Result($gf);}function
update($R,$P,$Qe,$_=0,$N="\n"){global$i;$m=$i->_db_name;$Z=sql_query_where_parser($Qe);$d='MongoDB\Driver\BulkWrite';$Sa=new$d(array());if(isset($P['_id']))unset($P['_id']);$Ze=array();foreach($P
as$z=>$Y){if($Y=='NULL'){$Ze[$z]=1;unset($P[$z]);}}$Fg=array('$set'=>$P);if(count($Ze))$Fg['$unset']=$Ze;$Sa->update($Z,$Fg,array('upsert'=>false));$gf=$i->_link->executeBulkWrite("$m.$R",$Sa);$i->affected_rows=$gf->getModifiedCount();return
true;}function
delete($R,$Qe,$_=0){global$i;$m=$i->_db_name;$Z=sql_query_where_parser($Qe);$d='MongoDB\Driver\BulkWrite';$Sa=new$d(array());$Sa->delete($Z,array('limit'=>$_));$gf=$i->_link->executeBulkWrite("$m.$R",$Sa);$i->affected_rows=$gf->getDeletedCount();return
true;}function
insert($R,$P){global$i;$m=$i->_db_name;$d='MongoDB\Driver\BulkWrite';$Sa=new$d(array());if(isset($P['_id'])&&empty($P['_id']))unset($P['_id']);$Sa->insert($P);$gf=$i->_link->executeBulkWrite("$m.$R",$Sa);$i->affected_rows=$gf->getInsertedCount();return
true;}}function
get_databases($sc){global$i;$J=array();$d='MongoDB\Driver\Command';$gb=new$d(array('listDatabases'=>1));$gf=$i->_link->executeCommand('admin',$gb);foreach($gf
as$wb){foreach($wb->databases
as$m)$J[]=$m->name;}return$J;}function
count_tables($l){$J=array();return$J;}function
tables_list(){global$i;$d='MongoDB\Driver\Command';$gb=new$d(array('listCollections'=>1));$gf=$i->_link->executeCommand($i->_db_name,$gb);$eb=array();foreach($gf
as$I)$eb[$I->name]='table';return$eb;}function
drop_databases($l){return
false;}function
indexes($R,$j=null){global$i;$J=array();$d='MongoDB\Driver\Command';$gb=new$d(array('listIndexes'=>$R));$gf=$i->_link->executeCommand($i->_db_name,$gb);foreach($gf
as$w){$Bb=array();$g=array();foreach(get_object_vars($w->key)as$f=>$U){$Bb[]=($U==-1?'1':null);$g[]=$f;}$J[$w->name]=array("type"=>($w->name=="_id_"?"PRIMARY":(isset($w->unique)?"UNIQUE":"INDEX")),"columns"=>$g,"lengths"=>array(),"descs"=>$Bb,);}return$J;}function
fields($R){$q=fields_from_edit();if(!count($q)){global$n;$I=$n->select($R,array("*"),null,null,array(),10);while($K=$I->fetch_assoc()){foreach($K
as$z=>$X){$K[$z]=null;$q[$z]=array("field"=>$z,"type"=>"string","null"=>($z!=$n->primary),"auto_increment"=>($z==$n->primary),"privileges"=>array("insert"=>1,"select"=>1,"update"=>1,),);}}}return$q;}function
found_rows($S,$Z){global$i;$Z=where_to_query($Z);$d='MongoDB\Driver\Command';$gb=new$d(array('count'=>$S['Name'],'query'=>$Z));$gf=$i->_link->executeCommand($i->_db_name,$gb);$lg=$gf->toArray();return$lg[0]->n;}function
sql_query_where_parser($Qe){$Qe=trim(preg_replace('/WHERE[\s]?[(]?\(?/','',$Qe));$Qe=preg_replace('/\)\)\)$/',')',$Qe);$Yg=explode(' AND ',$Qe);$Zg=explode(') OR (',$Qe);$Z=array();foreach($Yg
as$Wg)$Z[]=trim($Wg);if(count($Zg)==1)$Zg=array();elseif(count($Zg)>1)$Z=array();return
where_to_query($Z,$Zg);}function
where_to_query($Ug=array(),$Vg=array()){global$b;$ub=array();foreach(array('and'=>$Ug,'or'=>$Vg)as$U=>$Z){if(is_array($Z)){foreach($Z
as$bc){list($cb,$je,$X)=explode(" ",$bc,3);if($cb=="_id"){$X=str_replace('MongoDB\BSON\ObjectID("',"",$X);$X=str_replace('")',"",$X);$d='MongoDB\BSON\ObjectID';$X=new$d($X);}if(!in_array($je,$b->operators))continue;if(preg_match('~^\(f\)(.+)~',$je,$B)){$X=(float)$X;$je=$B[1];}elseif(preg_match('~^\(date\)(.+)~',$je,$B)){$vb=new
DateTime($X);$d='MongoDB\BSON\UTCDatetime';$X=new$d($vb->getTimestamp()*1000);$je=$B[1];}switch($je){case'=':$je='$eq';break;case'!=':$je='$ne';break;case'>':$je='$gt';break;case'<':$je='$lt';break;case'>=':$je='$gte';break;case'<=':$je='$lte';break;case'regex':$je='$regex';break;default:continue;}if($U=='and')$ub['$and'][]=array($cb=>array($je=>$X));elseif($U=='or')$ub['$or'][]=array($cb=>array($je=>$X));}}}return$ub;}$le=array("=","!=",">","<",">=","<=","regex","(f)=","(f)!=","(f)>","(f)<","(f)>=","(f)<=","(date)=","(date)!=","(date)>","(date)<","(date)>=","(date)<=",);}function
table($v){return$v;}function
idf_escape($v){return$v;}function
table_status($C="",$hc=false){$J=array();foreach(tables_list()as$R=>$U){$J[$R]=array("Name"=>$R);if($C==$R)return$J[$R];}return$J;}function
create_database($m,$e){return
true;}function
last_id(){global$i;return$i->last_id;}function
error(){global$i;return
h($i->error);}function
collations(){return
array();}function
logged_user(){global$b;$qb=$b->credentials();return$qb[1];}function
connect(){global$b;$i=new
Min_DB;list($O,$V,$G)=$b->credentials();$D=array();if($V.$G!=""){$D["username"]=$V;$D["password"]=$G;}$m=$b->database();if($m!="")$D["db"]=$m;try{$i->_link=$i->connect("mongodb://$O",$D);if($G!=""){$D["password"]="";try{$i->connect("mongodb://$O",$D);return
lang(22);}catch(Exception$Xb){}}return$i;}catch(Exception$Xb){return$Xb->getMessage();}}function
alter_indexes($R,$c){global$i;foreach($c
as$X){list($U,$C,$P)=$X;if($P=="DROP")$J=$i->_db->command(array("deleteIndexes"=>$R,"index"=>$C));else{$g=array();foreach($P
as$f){$f=preg_replace('~ DESC$~','',$f,1,$nb);$g[$f]=($nb?-1:1);}$J=$i->_db->selectCollection($R)->ensureIndex($g,array("unique"=>($U=="UNIQUE"),"name"=>$C,));}if($J['errmsg']){$i->error=$J['errmsg'];return
false;}}return
true;}function
support($ic){return
preg_match("~database|indexes~",$ic);}function
db_collation($m,$db){}function
information_schema(){}function
is_view($S){}function
convert_field($p){}function
unconvert_field($p,$J){return$J;}function
foreign_keys($R){return
array();}function
fk_support($S){}function
engines(){return
array();}function
alter_table($R,$C,$q,$uc,$hb,$Sb,$e,$Fa,$ye){global$i;if($R==""){$i->_db->createCollection($C);return
true;}}function
drop_tables($T){global$i;foreach($T
as$R){$df=$i->_db->selectCollection($R)->drop();if(!$df['ok'])return
false;}return
true;}function
truncate_tables($T){global$i;foreach($T
as$R){$df=$i->_db->selectCollection($R)->remove();if(!$df['ok'])return
false;}return
true;}$y="mongo";$Cc=array();$Gc=array();$Lb=array(array("json"));}$Gb["elastic"]="Elasticsearch (beta)";if(isset($_GET["elastic"])){$Fe=array("json + allow_url_fopen");define("DRIVER","elastic");if(function_exists('json_decode')&&ini_bool('allow_url_fopen')){class
Min_DB{var$extension="JSON",$server_info,$errno,$error,$_url;function
rootQuery($_e,$lb=array(),$Sd='GET'){@ini_set('track_errors',1);$lc=@file_get_contents("$this->_url/".ltrim($_e,'/'),false,stream_context_create(array('http'=>array('method'=>$Sd,'content'=>$lb===null?$lb:json_encode($lb),'header'=>'Content-Type: application/json','ignore_errors'=>1,))));if(!$lc){$this->error=$php_errormsg;return$lc;}if(!preg_match('~^HTTP/[0-9.]+ 2~i',$http_response_header[0])){$this->error=$lc;return
false;}$J=json_decode($lc,true);if($J===null){$this->errno=json_last_error();if(function_exists('json_last_error_msg'))$this->error=json_last_error_msg();else{$kb=get_defined_constants(true);foreach($kb['json']as$C=>$Y){if($Y==$this->errno&&preg_match('~^JSON_ERROR_~',$C)){$this->error=$C;break;}}}}return$J;}function
query($_e,$lb=array(),$Sd='GET'){return$this->rootQuery(($this->_db!=""?"$this->_db/":"/").ltrim($_e,'/'),$lb,$Sd);}function
connect($O,$V,$G){preg_match('~^(https?://)?(.*)~',$O,$B);$this->_url=($B[1]?$B[1]:"http://")."$V:$G@$B[2]";$J=$this->query('');if($J)$this->server_info=$J['version']['number'];return(bool)$J;}function
select_db($k){$this->_db=$k;return
true;}function
quote($Q){return$Q;}}class
Min_Result{var$num_rows,$_rows;function
__construct($L){$this->num_rows=count($this->_rows);$this->_rows=$L;reset($this->_rows);}function
fetch_assoc(){$J=current($this->_rows);next($this->_rows);return$J;}function
fetch_row(){return
array_values($this->fetch_assoc());}}}class
Min_Driver
extends
Min_SQL{function
select($R,$M,$Z,$Dc,$oe=array(),$_=1,$E=0,$Je=false){global$b;$ub=array();$H="$R/_search";if($M!=array("*"))$ub["fields"]=$M;if($oe){$Df=array();foreach($oe
as$cb){$cb=preg_replace('~ DESC$~','',$cb,1,$nb);$Df[]=($nb?array($cb=>"desc"):$cb);}$ub["sort"]=$Df;}if($_){$ub["size"]=+$_;if($E)$ub["from"]=($E*$_);}foreach($Z
as$X){list($cb,$je,$X)=explode(" ",$X,3);if($cb=="_id")$ub["query"]["ids"]["values"][]=$X;elseif($cb.$X!=""){$Zf=array("term"=>array(($cb!=""?$cb:"_all")=>$X));if($je=="=")$ub["query"]["filtered"]["filter"]["and"][]=$Zf;else$ub["query"]["filtered"]["query"]["bool"]["must"][]=$Zf;}}if($ub["query"]&&!$ub["query"]["filtered"]["query"]&&!$ub["query"]["ids"])$ub["query"]["filtered"]["query"]=array("match_all"=>array());$Kf=microtime(true);$nf=$this->_conn->query($H,$ub);if($Je)echo$b->selectQuery("$H: ".print_r($ub,true),$Kf,!$nf);if(!$nf)return
false;$J=array();foreach($nf['hits']['hits']as$Pc){$K=array();if($M==array("*"))$K["_id"]=$Pc["_id"];$q=$Pc['_source'];if($M!=array("*")){$q=array();foreach($M
as$z)$q[$z]=$Pc['fields'][$z];}foreach($q
as$z=>$X){if($ub["fields"])$X=$X[0];$K[$z]=(is_array($X)?json_encode($X):$X);}$J[]=$K;}return
new
Min_Result($J);}function
update($U,$Ve,$Qe,$_=0,$N="\n"){$ze=preg_split('~ *= *~',$Qe);if(count($ze)==2){$u=trim($ze[1]);$H="$U/$u";return$this->_conn->query($H,$Ve,'POST');}return
false;}function
insert($U,$Ve){$u="";$H="$U/$u";$df=$this->_conn->query($H,$Ve,'POST');$this->_conn->last_id=$df['_id'];return$df['created'];}function
delete($U,$Qe,$_=0){$Tc=array();if(is_array($_GET["where"])&&$_GET["where"]["_id"])$Tc[]=$_GET["where"]["_id"];if(is_array($_POST['check'])){foreach($_POST['check']as$Ua){$ze=preg_split('~ *= *~',$Ua);if(count($ze)==2)$Tc[]=trim($ze[1]);}}$this->_conn->affected_rows=0;foreach($Tc
as$u){$H="{$U}/{$u}";$df=$this->_conn->query($H,'{}','DELETE');if(is_array($df)&&$df['found']==true)$this->_conn->affected_rows++;}return$this->_conn->affected_rows;}}function
connect(){global$b;$i=new
Min_DB;list($O,$V,$G)=$b->credentials();if($G!=""&&$i->connect($O,$V,""))return
lang(22);if($i->connect($O,$V,$G))return$i;return$i->error;}function
support($ic){return
preg_match("~database|table|columns~",$ic);}function
logged_user(){global$b;$qb=$b->credentials();return$qb[1];}function
get_databases(){global$i;$J=$i->rootQuery('_aliases');if($J){$J=array_keys($J);sort($J,SORT_STRING);}return$J;}function
collations(){return
array();}function
db_collation($m,$db){}function
engines(){return
array();}function
count_tables($l){global$i;$J=array();$I=$i->query('_stats');if($I&&$I['indices']){$Zc=$I['indices'];foreach($Zc
as$Yc=>$Lf){$Xc=$Lf['total']['indexing'];$J[$Yc]=$Xc['index_total'];}}return$J;}function
tables_list(){global$i;$J=$i->query('_mapping');if($J)$J=array_fill_keys(array_keys($J[$i->_db]["mappings"]),'table');return$J;}function
table_status($C="",$hc=false){global$i;$nf=$i->query("_search",array("size"=>0,"aggregations"=>array("count_by_type"=>array("terms"=>array("field"=>"_type")))),"POST");$J=array();if($nf){$T=$nf["aggregations"]["count_by_type"]["buckets"];foreach($T
as$R){$J[$R["key"]]=array("Name"=>$R["key"],"Engine"=>"table","Rows"=>$R["doc_count"],);if($C!=""&&$C==$R["key"])return$J[$C];}}return$J;}function
error(){global$i;return
h($i->error);}function
information_schema(){}function
is_view($S){}function
indexes($R,$j=null){return
array(array("type"=>"PRIMARY","columns"=>array("_id")),);}function
fields($R){global$i;$I=$i->query("$R/_mapping");$J=array();if($I){$Fd=$I[$R]['properties'];if(!$Fd)$Fd=$I[$i->_db]['mappings'][$R]['properties'];if($Fd){foreach($Fd
as$C=>$p){$J[$C]=array("field"=>$C,"full_type"=>$p["type"],"type"=>$p["type"],"privileges"=>array("insert"=>1,"select"=>1,"update"=>1),);if($p["properties"]){unset($J[$C]["privileges"]["insert"]);unset($J[$C]["privileges"]["update"]);}}}}return$J;}function
foreign_keys($R){return
array();}function
table($v){return$v;}function
idf_escape($v){return$v;}function
convert_field($p){}function
unconvert_field($p,$J){return$J;}function
fk_support($S){}function
found_rows($S,$Z){return
null;}function
create_database($m){global$i;return$i->rootQuery(urlencode($m),null,'PUT');}function
drop_databases($l){global$i;return$i->rootQuery(urlencode(implode(',',$l)),array(),'DELETE');}function
alter_table($R,$C,$q,$uc,$hb,$Sb,$e,$Fa,$ye){global$i;$Me=array();foreach($q
as$fc){$jc=trim($fc[1][0]);$kc=trim($fc[1][1]?$fc[1][1]:"text");$Me[$jc]=array('type'=>$kc);}if(!empty($Me))$Me=array('properties'=>$Me);return$i->query("_mapping/{$C}",$Me,'PUT');}function
drop_tables($T){global$i;$J=true;foreach($T
as$R)$J=$J&&$i->query(urlencode($R),array(),'DELETE');return$J;}function
last_id(){global$i;return$i->last_id;}$y="elastic";$le=array("=","query");$Cc=array();$Gc=array();$Lb=array(array("json"));$yg=array();$Of=array();foreach(array(lang(27)=>array("long"=>3,"integer"=>5,"short"=>8,"byte"=>10,"double"=>20,"float"=>66,"half_float"=>12,"scaled_float"=>21),lang(28)=>array("date"=>10),lang(25)=>array("string"=>65535,"text"=>65535),lang(29)=>array("binary"=>255),)as$z=>$X){$yg+=$X;$Of[$z]=array_keys($X);}}$Gb=array("server"=>"MySQL")+$Gb;if(!defined("DRIVER")){$Fe=array("MySQLi","MySQL","PDO_MySQL");define("DRIVER","server");if(extension_loaded("mysqli")){class
Min_DB
extends
MySQLi{var$extension="MySQLi";function
__construct(){parent::init();}function
connect($O="",$V="",$G="",$k=null,$De=null,$Cf=null){global$b;mysqli_report(MYSQLI_REPORT_OFF);list($Qc,$De)=explode(":",$O,2);$Jf=$b->connectSsl();if($Jf)$this->ssl_set($Jf['key'],$Jf['cert'],$Jf['ca'],'','');$J=@$this->real_connect(($O!=""?$Qc:ini_get("mysqli.default_host")),($O.$V!=""?$V:ini_get("mysqli.default_user")),($O.$V.$G!=""?$G:ini_get("mysqli.default_pw")),$k,(is_numeric($De)?$De:ini_get("mysqli.default_port")),(!is_numeric($De)?$De:$Cf),($Jf?64:0));$this->options(MYSQLI_OPT_LOCAL_INFILE,false);return$J;}function
set_charset($Ta){if(parent::set_charset($Ta))return
true;parent::set_charset('utf8');return$this->query("SET NAMES $Ta");}function
result($H,$p=0){$I=$this->query($H);if(!$I)return
false;$K=$I->fetch_array();return$K[$p];}function
quote($Q){return"'".$this->escape_string($Q)."'";}}}elseif(extension_loaded("mysql")&&!((ini_bool("sql.safe_mode")||ini_bool("mysql.allow_local_infile"))&&extension_loaded("pdo_mysql"))){class
Min_DB{var$extension="MySQL",$server_info,$affected_rows,$errno,$error,$_link,$_result;function
connect($O,$V,$G){if(ini_bool("mysql.allow_local_infile")){$this->error=lang(32,"'mysql.allow_local_infile'","MySQLi","PDO_MySQL");return
false;}$this->_link=@mysql_connect(($O!=""?$O:ini_get("mysql.default_host")),("$O$V"!=""?$V:ini_get("mysql.default_user")),("$O$V$G"!=""?$G:ini_get("mysql.default_password")),true,131072);if($this->_link)$this->server_info=mysql_get_server_info($this->_link);else$this->error=mysql_error();return(bool)$this->_link;}function
set_charset($Ta){if(function_exists('mysql_set_charset')){if(mysql_set_charset($Ta,$this->_link))return
true;mysql_set_charset('utf8',$this->_link);}return$this->query("SET NAMES $Ta");}function
quote($Q){return"'".mysql_real_escape_string($Q,$this->_link)."'";}function
select_db($k){return
mysql_select_db($k,$this->_link);}function
query($H,$zg=false){$I=@($zg?mysql_unbuffered_query($H,$this->_link):mysql_query($H,$this->_link));$this->error="";if(!$I){$this->errno=mysql_errno($this->_link);$this->error=mysql_error($this->_link);return
false;}if($I===true){$this->affected_rows=mysql_affected_rows($this->_link);$this->info=mysql_info($this->_link);return
true;}return
new
Min_Result($I);}function
multi_query($H){return$this->_result=$this->query($H);}function
store_result(){return$this->_result;}function
next_result(){return
false;}function
result($H,$p=0){$I=$this->query($H);if(!$I||!$I->num_rows)return
false;return
mysql_result($I->_result,0,$p);}}class
Min_Result{var$num_rows,$_result,$_offset=0;function
__construct($I){$this->_result=$I;$this->num_rows=mysql_num_rows($I);}function
fetch_assoc(){return
mysql_fetch_assoc($this->_result);}function
fetch_row(){return
mysql_fetch_row($this->_result);}function
fetch_field(){$J=mysql_fetch_field($this->_result,$this->_offset++);$J->orgtable=$J->table;$J->orgname=$J->name;$J->charsetnr=($J->blob?63:0);return$J;}function
__destruct(){mysql_free_result($this->_result);}}}elseif(extension_loaded("pdo_mysql")){class
Min_DB
extends
Min_PDO{var$extension="PDO_MySQL";function
connect($O,$V,$G){global$b;$D=array(PDO::MYSQL_ATTR_LOCAL_INFILE=>false);$Jf=$b->connectSsl();if($Jf)$D+=array(PDO::MYSQL_ATTR_SSL_KEY=>$Jf['key'],PDO::MYSQL_ATTR_SSL_CERT=>$Jf['cert'],PDO::MYSQL_ATTR_SSL_CA=>$Jf['ca'],);$this->dsn("mysql:charset=utf8;host=".str_replace(":",";unix_socket=",preg_replace('~:(\d)~',';port=\1',$O)),$V,$G,$D);return
true;}function
set_charset($Ta){$this->query("SET NAMES $Ta");}function
select_db($k){return$this->query("USE ".idf_escape($k));}function
query($H,$zg=false){$this->setAttribute(1000,!$zg);return
parent::query($H,$zg);}}}class
Min_Driver
extends
Min_SQL{function
insert($R,$P){return($P?parent::insert($R,$P):queries("INSERT INTO ".table($R)." ()\nVALUES ()"));}function
insertUpdate($R,$L,$He){$g=array_keys(reset($L));$Ge="INSERT INTO ".table($R)." (".implode(", ",$g).") VALUES\n";$Mg=array();foreach($g
as$z)$Mg[$z]="$z = VALUES($z)";$Rf="\nON DUPLICATE KEY UPDATE ".implode(", ",$Mg);$Mg=array();$zd=0;foreach($L
as$P){$Y="(".implode(", ",$P).")";if($Mg&&(strlen($Ge)+$zd+strlen($Y)+strlen($Rf)>1e6)){if(!queries($Ge.implode(",\n",$Mg).$Rf))return
false;$Mg=array();$zd=0;}$Mg[]=$Y;$zd+=strlen($Y)+2;}return
queries($Ge.implode(",\n",$Mg).$Rf);}function
slowQuery($H,$eg){if(min_version('5.7.8','10.1.2')){if(preg_match('~MariaDB~',$this->_conn->server_info))return"SET STATEMENT max_statement_time=$eg FOR $H";elseif(preg_match('~^(SELECT\b)(.+)~is',$H,$B))return"$B[1] /*+ MAX_EXECUTION_TIME(".($eg*1000).") */ $B[2]";}}function
convertSearch($v,$X,$p){return(preg_match('~char|text|enum|set~',$p["type"])&&!preg_match("~^utf8~",$p["collation"])&&preg_match('~[\x80-\xFF]~',$X['val'])?"CONVERT($v USING ".charset($this->_conn).")":$v);}function
warnings(){$I=$this->_conn->query("SHOW WARNINGS");if($I&&$I->num_rows){ob_start();select($I);return
ob_get_clean();}}function
tableHelp($C){$Gd=preg_match('~MariaDB~',$this->_conn->server_info);if(information_schema(DB))return
strtolower(($Gd?"information-schema-$C-table/":str_replace("_","-",$C)."-table.html"));if(DB=="mysql")return($Gd?"mysql$C-table/":"system-database.html");}}function
idf_escape($v){return"`".str_replace("`","``",$v)."`";}function
table($v){return
idf_escape($v);}function
connect(){global$b,$yg,$Of;$i=new
Min_DB;$qb=$b->credentials();if($i->connect($qb[0],$qb[1],$qb[2])){$i->set_charset(charset($i));$i->query("SET sql_quote_show_create = 1, autocommit = 1");if(min_version('5.7.8',10.2,$i)){$Of[lang(25)][]="json";$yg["json"]=4294967295;}return$i;}$J=$i->error;if(function_exists('iconv')&&!is_utf8($J)&&strlen($kf=iconv("windows-1250","utf-8",$J))>strlen($J))$J=$kf;return$J;}function
get_databases($sc){$J=get_session("dbs");if($J===null){$H=(min_version(5)?"SELECT SCHEMA_NAME FROM information_schema.SCHEMATA ORDER BY SCHEMA_NAME":"SHOW DATABASES");$J=($sc?slow_query($H):get_vals($H));restart_session();set_session("dbs",$J);stop_session();}return$J;}function
limit($H,$Z,$_,$ee=0,$N=" "){return" $H$Z".($_!==null?$N."LIMIT $_".($ee?" OFFSET $ee":""):"");}function
limit1($R,$H,$Z,$N="\n"){return
limit($H,$Z,1,0,$N);}function
db_collation($m,$db){global$i;$J=null;$ob=$i->result("SHOW CREATE DATABASE ".idf_escape($m),1);if(preg_match('~ COLLATE ([^ ]+)~',$ob,$B))$J=$B[1];elseif(preg_match('~ CHARACTER SET ([^ ]+)~',$ob,$B))$J=$db[$B[1]][-1];return$J;}function
engines(){$J=array();foreach(get_rows("SHOW ENGINES")as$K){if(preg_match("~YES|DEFAULT~",$K["Support"]))$J[]=$K["Engine"];}return$J;}function
logged_user(){global$i;return$i->result("SELECT USER()");}function
tables_list(){return
get_key_vals(min_version(5)?"SELECT TABLE_NAME, TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ORDER BY TABLE_NAME":"SHOW TABLES");}function
count_tables($l){$J=array();foreach($l
as$m)$J[$m]=count(get_vals("SHOW TABLES IN ".idf_escape($m)));return$J;}function
table_status($C="",$hc=false){$J=array();foreach(get_rows($hc&&min_version(5)?"SELECT TABLE_NAME AS Name, ENGINE AS Engine, TABLE_COMMENT AS Comment FROM information_schema.TABLES WHERE TABLE_SCHEMA = DATABASE() ".($C!=""?"AND TABLE_NAME = ".q($C):"ORDER BY Name"):"SHOW TABLE STATUS".($C!=""?" LIKE ".q(addcslashes($C,"%_\\")):""))as$K){if($K["Engine"]=="InnoDB")$K["Comment"]=preg_replace('~(?:(.+); )?InnoDB free: .*~','\1',$K["Comment"]);if(!isset($K["Engine"]))$K["Comment"]="";if($C!="")return$K;$J[$K["Name"]]=$K;}return$J;}function
is_view($S){return$S["Engine"]===null;}function
fk_support($S){return
preg_match('~InnoDB|IBMDB2I~i',$S["Engine"])||(preg_match('~NDB~i',$S["Engine"])&&min_version(5.6));}function
fields($R){$J=array();foreach(get_rows("SHOW FULL COLUMNS FROM ".table($R))as$K){preg_match('~^([^( ]+)(?:\((.+)\))?( unsigned)?( zerofill)?$~',$K["Type"],$B);$J[$K["Field"]]=array("field"=>$K["Field"],"full_type"=>$K["Type"],"type"=>$B[1],"length"=>$B[2],"unsigned"=>ltrim($B[3].$B[4]),"default"=>($K["Default"]!=""||preg_match("~char|set~",$B[1])?$K["Default"]:null),"null"=>($K["Null"]=="YES"),"auto_increment"=>($K["Extra"]=="auto_increment"),"on_update"=>(preg_match('~^on update (.+)~i',$K["Extra"],$B)?$B[1]:""),"collation"=>$K["Collation"],"privileges"=>array_flip(preg_split('~, *~',$K["Privileges"])),"comment"=>$K["Comment"],"primary"=>($K["Key"]=="PRI"),);}return$J;}function
indexes($R,$j=null){$J=array();foreach(get_rows("SHOW INDEX FROM ".table($R),$j)as$K){$C=$K["Key_name"];$J[$C]["type"]=($C=="PRIMARY"?"PRIMARY":($K["Index_type"]=="FULLTEXT"?"FULLTEXT":($K["Non_unique"]?($K["Index_type"]=="SPATIAL"?"SPATIAL":"INDEX"):"UNIQUE")));$J[$C]["columns"][]=$K["Column_name"];$J[$C]["lengths"][]=($K["Index_type"]=="SPATIAL"?null:$K["Sub_part"]);$J[$C]["descs"][]=null;}return$J;}function
foreign_keys($R){global$i,$ge;static$Ae='`(?:[^`]|``)+`';$J=array();$pb=$i->result("SHOW CREATE TABLE ".table($R),1);if($pb){preg_match_all("~CONSTRAINT ($Ae) FOREIGN KEY ?\\(((?:$Ae,? ?)+)\\) REFERENCES ($Ae)(?:\\.($Ae))? \\(((?:$Ae,? ?)+)\\)(?: ON DELETE ($ge))?(?: ON UPDATE ($ge))?~",$pb,$Jd,PREG_SET_ORDER);foreach($Jd
as$B){preg_match_all("~$Ae~",$B[2],$Ef);preg_match_all("~$Ae~",$B[5],$Yf);$J[idf_unescape($B[1])]=array("db"=>idf_unescape($B[4]!=""?$B[3]:$B[4]),"table"=>idf_unescape($B[4]!=""?$B[4]:$B[3]),"source"=>array_map('idf_unescape',$Ef[0]),"target"=>array_map('idf_unescape',$Yf[0]),"on_delete"=>($B[6]?$B[6]:"RESTRICT"),"on_update"=>($B[7]?$B[7]:"RESTRICT"),);}}return$J;}function
view($C){global$i;return
array("select"=>preg_replace('~^(?:[^`]|`[^`]*`)*\s+AS\s+~isU','',$i->result("SHOW CREATE VIEW ".table($C),1)));}function
collations(){$J=array();foreach(get_rows("SHOW COLLATION")as$K){if($K["Default"])$J[$K["Charset"]][-1]=$K["Collation"];else$J[$K["Charset"]][]=$K["Collation"];}ksort($J);foreach($J
as$z=>$X)asort($J[$z]);return$J;}function
information_schema($m){return(min_version(5)&&$m=="information_schema")||(min_version(5.5)&&$m=="performance_schema");}function
error(){global$i;return
h(preg_replace('~^You have an error.*syntax to use~U',"Syntax error",$i->error));}function
create_database($m,$e){return
queries("CREATE DATABASE ".idf_escape($m).($e?" COLLATE ".q($e):""));}function
drop_databases($l){$J=apply_queries("DROP DATABASE",$l,'idf_escape');restart_session();set_session("dbs",null);return$J;}function
rename_database($C,$e){$J=false;if(create_database($C,$e)){$af=array();foreach(tables_list()as$R=>$U)$af[]=table($R)." TO ".idf_escape($C).".".table($R);$J=(!$af||queries("RENAME TABLE ".implode(", ",$af)));if($J)queries("DROP DATABASE ".idf_escape(DB));restart_session();set_session("dbs",null);}return$J;}function
auto_increment(){$Ga=" PRIMARY KEY";if($_GET["create"]!=""&&$_POST["auto_increment_col"]){foreach(indexes($_GET["create"])as$w){if(in_array($_POST["fields"][$_POST["auto_increment_col"]]["orig"],$w["columns"],true)){$Ga="";break;}if($w["type"]=="PRIMARY")$Ga=" UNIQUE";}}return" AUTO_INCREMENT$Ga";}function
alter_table($R,$C,$q,$uc,$hb,$Sb,$e,$Fa,$ye){$c=array();foreach($q
as$p)$c[]=($p[1]?($R!=""?($p[0]!=""?"CHANGE ".idf_escape($p[0]):"ADD"):" ")." ".implode($p[1]).($R!=""?$p[2]:""):"DROP ".idf_escape($p[0]));$c=array_merge($c,$uc);$Mf=($hb!==null?" COMMENT=".q($hb):"").($Sb?" ENGINE=".q($Sb):"").($e?" COLLATE ".q($e):"").($Fa!=""?" AUTO_INCREMENT=$Fa":"");if($R=="")return
queries("CREATE TABLE ".table($C)." (\n".implode(",\n",$c)."\n)$Mf$ye");if($R!=$C)$c[]="RENAME TO ".table($C);if($Mf)$c[]=ltrim($Mf);return($c||$ye?queries("ALTER TABLE ".table($R)."\n".implode(",\n",$c).$ye):true);}function
alter_indexes($R,$c){foreach($c
as$z=>$X)$c[$z]=($X[2]=="DROP"?"\nDROP INDEX ".idf_escape($X[1]):"\nADD $X[0] ".($X[0]=="PRIMARY"?"KEY ":"").($X[1]!=""?idf_escape($X[1])." ":"")."(".implode(", ",$X[2]).")");return
queries("ALTER TABLE ".table($R).implode(",",$c));}function
truncate_tables($T){return
apply_queries("TRUNCATE TABLE",$T);}function
drop_views($Qg){return
queries("DROP VIEW ".implode(", ",array_map('table',$Qg)));}function
drop_tables($T){return
queries("DROP TABLE ".implode(", ",array_map('table',$T)));}function
move_tables($T,$Qg,$Yf){$af=array();foreach(array_merge($T,$Qg)as$R)$af[]=table($R)." TO ".idf_escape($Yf).".".table($R);return
queries("RENAME TABLE ".implode(", ",$af));}function
copy_tables($T,$Qg,$Yf){queries("SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO'");foreach($T
as$R){$C=($Yf==DB?table("copy_$R"):idf_escape($Yf).".".table($R));if(!queries("\nDROP TABLE IF EXISTS $C")||!queries("CREATE TABLE $C LIKE ".table($R))||!queries("INSERT INTO $C SELECT * FROM ".table($R)))return
false;foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($R,"%_\\")))as$K){$tg=$K["Trigger"];if(!queries("CREATE TRIGGER ".($Yf==DB?idf_escape("copy_$tg"):idf_escape($Yf).".".idf_escape($tg))." $K[Timing] $K[Event] ON $C FOR EACH ROW\n$K[Statement];"))return
false;}}foreach($Qg
as$R){$C=($Yf==DB?table("copy_$R"):idf_escape($Yf).".".table($R));$Pg=view($R);if(!queries("DROP VIEW IF EXISTS $C")||!queries("CREATE VIEW $C AS $Pg[select]"))return
false;}return
true;}function
trigger($C){if($C=="")return
array();$L=get_rows("SHOW TRIGGERS WHERE `Trigger` = ".q($C));return
reset($L);}function
triggers($R){$J=array();foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($R,"%_\\")))as$K)$J[$K["Trigger"]]=array($K["Timing"],$K["Event"]);return$J;}function
trigger_options(){return
array("Timing"=>array("BEFORE","AFTER"),"Event"=>array("INSERT","UPDATE","DELETE"),"Type"=>array("FOR EACH ROW"),);}function
routine($C,$U){global$i,$Tb,$ed,$yg;$xa=array("bool","boolean","integer","double precision","real","dec","numeric","fixed","national char","national varchar");$Ff="(?:\\s|/\\*[\s\S]*?\\*/|(?:#|-- )[^\n]*\n?|--\r?\n)";$xg="((".implode("|",array_merge(array_keys($yg),$xa)).")\\b(?:\\s*\\(((?:[^'\")]|$Tb)++)\\))?\\s*(zerofill\\s*)?(unsigned(?:\\s+zerofill)?)?)(?:\\s*(?:CHARSET|CHARACTER\\s+SET)\\s*['\"]?([^'\"\\s,]+)['\"]?)?";$Ae="$Ff*(".($U=="FUNCTION"?"":$ed).")?\\s*(?:`((?:[^`]|``)*)`\\s*|\\b(\\S+)\\s+)$xg";$ob=$i->result("SHOW CREATE $U ".idf_escape($C),2);preg_match("~\\(((?:$Ae\\s*,?)*)\\)\\s*".($U=="FUNCTION"?"RETURNS\\s+$xg\\s+":"")."(.*)~is",$ob,$B);$q=array();preg_match_all("~$Ae\\s*,?~is",$B[1],$Jd,PREG_SET_ORDER);foreach($Jd
as$ve){$C=str_replace("``","`",$ve[2]).$ve[3];$q[]=array("field"=>$C,"type"=>strtolower($ve[5]),"length"=>preg_replace_callback("~$Tb~s",'normalize_enum',$ve[6]),"unsigned"=>strtolower(preg_replace('~\s+~',' ',trim("$ve[8] $ve[7]"))),"null"=>1,"full_type"=>$ve[4],"inout"=>strtoupper($ve[1]),"collation"=>strtolower($ve[9]),);}if($U!="FUNCTION")return
array("fields"=>$q,"definition"=>$B[11]);return
array("fields"=>$q,"returns"=>array("type"=>$B[12],"length"=>$B[13],"unsigned"=>$B[15],"collation"=>$B[16]),"definition"=>$B[17],"language"=>"SQL",);}function
routines(){return
get_rows("SELECT ROUTINE_NAME AS SPECIFIC_NAME, ROUTINE_NAME, ROUTINE_TYPE, DTD_IDENTIFIER FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = ".q(DB));}function
routine_languages(){return
array();}function
routine_id($C,$K){return
idf_escape($C);}function
last_id(){global$i;return$i->result("SELECT LAST_INSERT_ID()");}function
explain($i,$H){return$i->query("EXPLAIN ".(min_version(5.1)?"PARTITIONS ":"").$H);}function
found_rows($S,$Z){return($Z||$S["Engine"]!="InnoDB"?null:$S["Rows"]);}function
types(){return
array();}function
schemas(){return
array();}function
get_schema(){return"";}function
set_schema($lf){return
true;}function
create_sql($R,$Fa,$Pf){global$i;$J=$i->result("SHOW CREATE TABLE ".table($R),1);if(!$Fa)$J=preg_replace('~ AUTO_INCREMENT=\d+~','',$J);return$J;}function
truncate_sql($R){return"TRUNCATE ".table($R);}function
use_sql($k){return"USE ".idf_escape($k);}function
trigger_sql($R){$J="";foreach(get_rows("SHOW TRIGGERS LIKE ".q(addcslashes($R,"%_\\")),null,"-- ")as$K)$J.="\nCREATE TRIGGER ".idf_escape($K["Trigger"])." $K[Timing] $K[Event] ON ".table($K["Table"])." FOR EACH ROW\n$K[Statement];;\n";return$J;}function
show_variables(){return
get_key_vals("SHOW VARIABLES");}function
process_list(){return
get_rows("SHOW FULL PROCESSLIST");}function
show_status(){return
get_key_vals("SHOW STATUS");}function
convert_field($p){if(preg_match("~binary~",$p["type"]))return"HEX(".idf_escape($p["field"]).")";if($p["type"]=="bit")return"BIN(".idf_escape($p["field"])." + 0)";if(preg_match("~geometry|point|linestring|polygon~",$p["type"]))return(min_version(8)?"ST_":"")."AsWKT(".idf_escape($p["field"]).")";}function
unconvert_field($p,$J){if(preg_match("~binary~",$p["type"]))$J="UNHEX($J)";if($p["type"]=="bit")$J="CONV($J, 2, 10) + 0";if(preg_match("~geometry|point|linestring|polygon~",$p["type"]))$J=(min_version(8)?"ST_":"")."GeomFromText($J)";return$J;}function
support($ic){return!preg_match("~scheme|sequence|type|view_trigger|materializedview".(min_version(5.1)?"":"|event|partitioning".(min_version(5)?"":"|routine|trigger|view"))."~",$ic);}function
kill_process($X){return
queries("KILL ".number($X));}function
connection_id(){return"SELECT CONNECTION_ID()";}function
max_connections(){global$i;return$i->result("SELECT @@max_connections");}$y="sql";$yg=array();$Of=array();foreach(array(lang(27)=>array("tinyint"=>3,"smallint"=>5,"mediumint"=>8,"int"=>10,"bigint"=>20,"decimal"=>66,"float"=>12,"double"=>21),lang(28)=>array("date"=>10,"datetime"=>19,"timestamp"=>19,"time"=>10,"year"=>4),lang(25)=>array("char"=>255,"varchar"=>65535,"tinytext"=>255,"text"=>65535,"mediumtext"=>16777215,"longtext"=>4294967295),lang(33)=>array("enum"=>65535,"set"=>64),lang(29)=>array("bit"=>20,"binary"=>255,"varbinary"=>65535,"tinyblob"=>255,"blob"=>65535,"mediumblob"=>16777215,"longblob"=>4294967295),lang(31)=>array("geometry"=>0,"point"=>0,"linestring"=>0,"polygon"=>0,"multipoint"=>0,"multilinestring"=>0,"multipolygon"=>0,"geometrycollection"=>0),)as$z=>$X){$yg+=$X;$Of[$z]=array_keys($X);}$Eg=array("unsigned","zerofill","unsigned zerofill");$le=array("=","<",">","<=",">=","!=","LIKE","LIKE %%","REGEXP","IN","FIND_IN_SET","IS NULL","NOT LIKE","NOT REGEXP","NOT IN","IS NOT NULL","SQL");$Cc=array("char_length","date","from_unixtime","lower","round","floor","ceil","sec_to_time","time_to_sec","upper");$Gc=array("avg","count","count distinct","group_concat","max","min","sum");$Lb=array(array("char"=>"md5/sha1/password/encrypt/uuid","binary"=>"md5/sha1","date|time"=>"now",),array(number_type()=>"+/-","date"=>"+ interval/- interval","time"=>"addtime/subtime","char|text"=>"concat",));}define("SERVER",$_GET[DRIVER]);define("DB",$_GET["db"]);define("ME",preg_replace('~^[^?]*/([^?]*).*~','\1',$_SERVER["REQUEST_URI"]).'?'.(sid()?SID.'&':'').(SERVER!==null?DRIVER."=".urlencode(SERVER).'&':'').(isset($_GET["username"])?"username=".urlencode($_GET["username"]).'&':'').(DB!=""?'db='.urlencode(DB).'&'.(isset($_GET["ns"])?"ns=".urlencode($_GET["ns"])."&":""):''));$ca="4.6.3";class
Adminer{var$operators=array("<=",">=");var$_values=array();function
name(){return"<a href='https://www.adminer.org/editor/'".target_blank()." id='h1'>".lang(34)."</a>";}function
credentials(){return
array(SERVER,$_GET["username"],get_password());}function
connectSsl(){}function
permanentLogin($ob=false){return
password_file($ob);}function
bruteForceKey(){return$_SERVER["REMOTE_ADDR"];}function
serverName($O){}function
database(){global$i;if($i){$l=$this->databases(false);return(!$l?$i->result("SELECT SUBSTRING_INDEX(CURRENT_USER, '@', 1)"):$l[(information_schema($l[0])?1:0)]);}}function
schemas(){return
schemas();}function
databases($sc=true){return
get_databases($sc);}function
queryTimeout(){return
5;}function
headers(){}function
csp(){return
csp();}function
head(){return
true;}function
css(){$J=array();$r="adminer.css";if(file_exists($r))$J[]=$r;return$J;}function
loginForm(){echo"<table cellspacing='0'>\n",$this->loginFormField('username','<tr><th>'.lang(35).'<td>','<input type="hidden" name="auth[driver]" value="server"><input name="auth[username]" id="username" value="'.h($_GET["username"]).'" autocapitalize="off">'.script("focus(qs('#username'));")),$this->loginFormField('password','<tr><th>'.lang(36).'<td>','<input type="password" name="auth[password]">'."\n"),"</table>\n","<p><input type='submit' value='".lang(37)."'>\n",checkbox("auth[permanent]",1,$_COOKIE["adminer_permanent"],lang(38))."\n";}function
loginFormField($C,$Nc,$Y){return$Nc.$Y;}function
login($Dd,$G){return
true;}function
tableName($Uf){return
h($Uf["Comment"]!=""?$Uf["Comment"]:$Uf["Name"]);}function
fieldName($p,$oe=0){return
h(preg_replace('~\s+\[.*\]$~','',($p["comment"]!=""?$p["comment"]:$p["field"])));}function
selectLinks($Uf,$P=""){$a=$Uf["Name"];if($P!==null)echo'<p class="tabs"><a href="'.h(ME.'edit='.urlencode($a).$P).'">'.lang(39)."</a>\n";}function
foreignKeys($R){return
foreign_keys($R);}function
backwardKeys($R,$Tf){$J=array();foreach(get_rows("SELECT TABLE_NAME, CONSTRAINT_NAME, COLUMN_NAME, REFERENCED_COLUMN_NAME
FROM information_schema.KEY_COLUMN_USAGE
WHERE TABLE_SCHEMA = ".q($this->database())."
AND REFERENCED_TABLE_SCHEMA = ".q($this->database())."
AND REFERENCED_TABLE_NAME = ".q($R)."
ORDER BY ORDINAL_POSITION",null,"")as$K)$J[$K["TABLE_NAME"]]["keys"][$K["CONSTRAINT_NAME"]][$K["COLUMN_NAME"]]=$K["REFERENCED_COLUMN_NAME"];foreach($J
as$z=>$X){$C=$this->tableName(table_status($z,true));if($C!=""){$nf=preg_quote($Tf);$N="(:|\\s*-)?\\s+";$J[$z]["name"]=(preg_match("(^$nf$N(.+)|^(.+?)$N$nf\$)iu",$C,$B)?$B[2].$B[3]:$C);}else
unset($J[$z]);}return$J;}function
backwardKeysPrint($Ja,$K){foreach($Ja
as$R=>$Ia){foreach($Ia["keys"]as$fb){$A=ME.'select='.urlencode($R);$t=0;foreach($fb
as$f=>$X)$A.=where_link($t++,$f,$K[$X]);echo"<a href='".h($A)."'>".h($Ia["name"])."</a>";$A=ME.'edit='.urlencode($R);foreach($fb
as$f=>$X)$A.="&set".urlencode("[".bracket_escape($f)."]")."=".urlencode($K[$X]);echo"<a href='".h($A)."' title='".lang(39)."'>+</a> ";}}}function
selectQuery($H,$Kf,$gc=false){return"<!--\n".str_replace("--","--><!-- ",$H)."\n(".format_time($Kf).")\n-->\n";}function
rowDescription($R){foreach(fields($R)as$p){if(preg_match("~varchar|character varying~",$p["type"]))return
idf_escape($p["field"]);}return"";}function
rowDescriptions($L,$wc){$J=$L;foreach($L[0]as$z=>$X){if(list($R,$u,$C)=$this->_foreignColumn($wc,$z)){$Tc=array();foreach($L
as$K)$Tc[$K[$z]]=q($K[$z]);$Ab=$this->_values[$R];if(!$Ab)$Ab=get_key_vals("SELECT $u, $C FROM ".table($R)." WHERE $u IN (".implode(", ",$Tc).")");foreach($L
as$Wd=>$K){if(isset($K[$z]))$J[$Wd][$z]=(string)$Ab[$K[$z]];}}}return$J;}function
selectLink($X,$p){}function
selectVal($X,$A,$p,$qe){$J=$X;$A=h($A);if(preg_match('~blob|bytea~',$p["type"])&&!is_utf8($X)){$J=lang(40,strlen($qe));if(preg_match("~^(GIF|\xFF\xD8\xFF|\x89PNG\x0D\x0A\x1A\x0A)~",$qe))$J="<img src='$A' alt='$J'>";}if(like_bool($p)&&$J!="")$J=(preg_match('~^(1|t|true|y|yes|on)$~i',$X)?lang(41):lang(42));if($A)$J="<a href='$A'".(is_url($A)?target_blank():"").">$J</a>";if(!$A&&!like_bool($p)&&preg_match(number_type(),$p["type"]))$J="<div class='number'>$J</div>";elseif(preg_match('~date~',$p["type"]))$J="<div class='datetime'>$J</div>";return$J;}function
editVal($X,$p){if(preg_match('~date|timestamp~',$p["type"])&&$X!==null)return
preg_replace('~^(\d{2}(\d+))-(0?(\d+))-(0?(\d+))~',lang(43),$X);return$X;}function
selectColumnsPrint($M,$g){}function
selectSearchPrint($Z,$g,$x){$Z=(array)$_GET["where"];echo'<fieldset id="fieldset-search"><legend>'.lang(44)."</legend><div>\n";$qd=array();foreach($Z
as$z=>$X)$qd[$X["col"]]=$z;$t=0;$q=fields($_GET["select"]);foreach($g
as$C=>$_b){$p=$q[$C];if(preg_match("~enum~",$p["type"])||like_bool($p)){$z=$qd[$C];$t--;echo"<div>".h($_b)."<input type='hidden' name='where[$t][col]' value='".h($C)."'>:",(like_bool($p)?" <select name='where[$t][val]'>".optionlist(array(""=>"",lang(42),lang(41)),$Z[$z]["val"],true)."</select>":enum_input("checkbox"," name='where[$t][val][]'",$p,(array)$Z[$z]["val"],($p["null"]?0:null))),"</div>\n";unset($g[$C]);}elseif(is_array($D=$this->_foreignKeyOptions($_GET["select"],$C))){if($q[$C]["null"])$D[0]='('.lang(7).')';$z=$qd[$C];$t--;echo"<div>".h($_b)."<input type='hidden' name='where[$t][col]' value='".h($C)."'><input type='hidden' name='where[$t][op]' value='='>: <select name='where[$t][val]'>".optionlist($D,$Z[$z]["val"],true)."</select></div>\n";unset($g[$C]);}}$t=0;foreach($Z
as$X){if(($X["col"]==""||$g[$X["col"]])&&"$X[col]$X[val]"!=""){echo"<div><select name='where[$t][col]'><option value=''>(".lang(45).")".optionlist($g,$X["col"],true)."</select>",html_select("where[$t][op]",array(-1=>"")+$this->operators,$X["op"]),"<input type='search' name='where[$t][val]' value='".h($X["val"])."'>".script("mixin(qsl('input'), {onkeydown: selectSearchKeydown, onsearch: selectSearchSearch});","")."</div>\n";$t++;}}echo"<div><select name='where[$t][col]'><option value=''>(".lang(45).")".optionlist($g,null,true)."</select>",script("qsl('select').onchange = selectAddRow;",""),html_select("where[$t][op]",array(-1=>"")+$this->operators),"<input type='search' name='where[$t][val]'></div>",script("mixin(qsl('input'), {onchange: function () { this.parentNode.firstChild.onchange(); }, onsearch: selectSearchSearch});"),"</div></fieldset>\n";}function
selectOrderPrint($oe,$g,$x){$pe=array();foreach($x
as$z=>$w){$oe=array();foreach($w["columns"]as$X)$oe[]=$g[$X];if(count(array_filter($oe,'strlen'))>1&&$z!="PRIMARY")$pe[$z]=implode(", ",$oe);}if($pe){echo'<fieldset><legend>'.lang(46)."</legend><div>","<select name='index_order'>".optionlist(array(""=>"")+$pe,($_GET["order"][0]!=""?"":$_GET["index_order"]),true)."</select>","</div></fieldset>\n";}if($_GET["order"])echo"<div style='display: none;'>".hidden_fields(array("order"=>array(1=>reset($_GET["order"])),"desc"=>($_GET["desc"]?array(1=>1):array()),))."</div>\n";}function
selectLimitPrint($_){echo"<fieldset><legend>".lang(47)."</legend><div>";echo
html_select("limit",array("","50","100"),$_),"</div></fieldset>\n";}function
selectLengthPrint($bg){}function
selectActionPrint($x){echo"<fieldset><legend>".lang(48)."</legend><div>","<input type='submit' value='".lang(49)."'>","</div></fieldset>\n";}function
selectCommandPrint(){return
true;}function
selectImportPrint(){return
true;}function
selectEmailPrint($Pb,$g){if($Pb){print_fieldset("email",lang(50),$_POST["email_append"]);echo"<div>",script("qsl('div').onkeydown = partialArg(bodyKeydown, 'email');"),"<p>".lang(51).": <input name='email_from' value='".h($_POST?$_POST["email_from"]:$_COOKIE["adminer_email"])."'>\n",lang(52).": <input name='email_subject' value='".h($_POST["email_subject"])."'>\n","<p><textarea name='email_message' rows='15' cols='75'>".h($_POST["email_message"].($_POST["email_append"]?'{$'."$_POST[email_addition]}":""))."</textarea>\n","<p>".script("qsl('p').onkeydown = partialArg(bodyKeydown, 'email_append');","").html_select("email_addition",$g,$_POST["email_addition"])."<input type='submit' name='email_append' value='".lang(11)."'>\n";echo"<p>".lang(53).": <input type='file' name='email_files[]'>".script("qsl('input').onchange = emailFileChange;"),"<p>".(count($Pb)==1?'<input type="hidden" name="email_field" value="'.h(key($Pb)).'">':html_select("email_field",$Pb)),"<input type='submit' name='email' value='".lang(54)."'>".confirm(),"</div>\n","</div></fieldset>\n";}}function
selectColumnsProcess($g,$x){return
array(array(),array());}function
selectSearchProcess($q,$x){$J=array();foreach((array)$_GET["where"]as$z=>$Z){$cb=$Z["col"];$je=$Z["op"];$X=$Z["val"];if(($z<0?"":$cb).$X!=""){$ib=array();foreach(($cb!=""?array($cb=>$q[$cb]):$q)as$C=>$p){if($cb!=""||is_numeric($X)||!preg_match(number_type(),$p["type"])){$C=idf_escape($C);if($cb!=""&&$p["type"]=="enum")$ib[]=(in_array(0,$X)?"$C IS NULL OR ":"")."$C IN (".implode(", ",array_map('intval',$X)).")";else{$cg=preg_match('~char|text|enum|set~',$p["type"]);$Y=$this->processInput($p,(!$je&&$cg&&preg_match('~^[^%]+$~',$X)?"%$X%":$X));$ib[]=$C.($Y=="NULL"?" IS".($je==">="?" NOT":"")." $Y":(in_array($je,$this->operators)||$je=="="?" $je $Y":($cg?" LIKE $Y":" IN (".str_replace(",","', '",$Y).")")));if($z<0&&$X=="0")$ib[]="$C IS NULL";}}}$J[]=($ib?"(".implode(" OR ",$ib).")":"1 = 0");}}return$J;}function
selectOrderProcess($q,$x){$Wc=$_GET["index_order"];if($Wc!="")unset($_GET["order"][1]);if($_GET["order"])return
array(idf_escape(reset($_GET["order"])).($_GET["desc"]?" DESC":""));foreach(($Wc!=""?array($x[$Wc]):$x)as$w){if($Wc!=""||$w["type"]=="INDEX"){$Ic=array_filter($w["descs"]);$_b=false;foreach($w["columns"]as$X){if(preg_match('~date|timestamp~',$q[$X]["type"])){$_b=true;break;}}$J=array();foreach($w["columns"]as$z=>$X)$J[]=idf_escape($X).(($Ic?$w["descs"][$z]:$_b)?" DESC":"");return$J;}}return
array();}function
selectLimitProcess(){return(isset($_GET["limit"])?$_GET["limit"]:"50");}function
selectLengthProcess(){return"100";}function
selectEmailProcess($Z,$wc){if($_POST["email_append"])return
true;if($_POST["email"]){$sf=0;if($_POST["all"]||$_POST["check"]){$p=idf_escape($_POST["email_field"]);$Qf=$_POST["email_subject"];$Pd=$_POST["email_message"];preg_match_all('~\{\$([a-z0-9_]+)\}~i',"$Qf.$Pd",$Jd);$L=get_rows("SELECT DISTINCT $p".($Jd[1]?", ".implode(", ",array_map('idf_escape',array_unique($Jd[1]))):"")." FROM ".table($_GET["select"])." WHERE $p IS NOT NULL AND $p != ''".($Z?" AND ".implode(" AND ",$Z):"").($_POST["all"]?"":" AND ((".implode(") OR (",array_map('where_check',(array)$_POST["check"]))."))"));$q=fields($_GET["select"]);foreach($this->rowDescriptions($L,$wc)as$K){$bf=array('{\\'=>'{');foreach($Jd[1]as$X)$bf['{$'."$X}"]=$this->editVal($K[$X],$q[$X]);$Ob=$K[$_POST["email_field"]];if(is_mail($Ob)&&send_mail($Ob,strtr($Qf,$bf),strtr($Pd,$bf),$_POST["email_from"],$_FILES["email_files"]))$sf++;}}cookie("adminer_email",$_POST["email_from"]);redirect(remove_from_uri(),lang(55,$sf));}return
false;}function
selectQueryBuild($M,$Z,$Dc,$oe,$_,$E){return"";}function
messageQuery($H,$dg,$gc=false){return" <span class='time'>".@date("H:i:s")."</span><!--\n".str_replace("--","--><!-- ",$H)."\n".($dg?"($dg)\n":"")."-->";}function
editFunctions($p){$J=array();if($p["null"]&&preg_match('~blob~',$p["type"]))$J["NULL"]=lang(7);$J[""]=($p["null"]||$p["auto_increment"]||like_bool($p)?"":"*");if(preg_match('~date|time~',$p["type"]))$J["now"]=lang(56);if(preg_match('~_(md5|sha1)$~i',$p["field"],$B))$J[]=strtolower($B[1]);return$J;}function
editInput($R,$p,$Da,$Y){if($p["type"]=="enum")return(isset($_GET["select"])?"<label><input type='radio'$Da value='-1' checked><i>".lang(8)."</i></label> ":"").enum_input("radio",$Da,$p,($Y||isset($_GET["select"])?$Y:0),($p["null"]?"":null));$D=$this->_foreignKeyOptions($R,$p["field"],$Y);if($D!==null)return(is_array($D)?"<select$Da>".optionlist($D,$Y,true)."</select>":"<input value='".h($Y)."'$Da class='hidden'>"."<input value='".h($D)."' class='jsonly'>"."<div></div>".script("qsl('input').oninput = partial(whisper, '".ME."script=complete&source=".urlencode($R)."&field=".urlencode($p["field"])."&value=');
qsl('div').onclick = whisperClick;",""));if(like_bool($p))return'<input type="checkbox" value="'.h($Y?$Y:1).'"'.(preg_match('~^(1|t|true|y|yes|on)$~i',$Y)?' checked':'')."$Da>";$Oc="";if(preg_match('~time~',$p["type"]))$Oc=lang(57);if(preg_match('~date|timestamp~',$p["type"]))$Oc=lang(58).($Oc?" [$Oc]":"");if($Oc)return"<input value='".h($Y)."'$Da> ($Oc)";if(preg_match('~_(md5|sha1)$~i',$p["field"]))return"<input type='password' value='".h($Y)."'$Da>";return'';}function
editHint($R,$p,$Y){return(preg_match('~\s+(\[.*\])$~',($p["comment"]!=""?$p["comment"]:$p["field"]),$B)?h(" $B[1]"):'');}function
processInput($p,$Y,$s=""){if($s=="now")return"$s()";$J=$Y;if(preg_match('~date|timestamp~',$p["type"])&&preg_match('(^'.str_replace('\$1','(?P<p1>\d*)',preg_replace('~(\\\\\\$([2-6]))~','(?P<p\2>\d{1,2})',preg_quote(lang(43)))).'(.*))',$Y,$B))$J=($B["p1"]!=""?$B["p1"]:($B["p2"]!=""?($B["p2"]<70?20:19).$B["p2"]:gmdate("Y")))."-$B[p3]$B[p4]-$B[p5]$B[p6]".end($B);$J=($p["type"]=="bit"&&preg_match('~^[0-9]+$~',$Y)?$J:q($J));if($Y==""&&like_bool($p))$J="0";elseif($Y==""&&($p["null"]||!preg_match('~char|text~',$p["type"])))$J="NULL";elseif(preg_match('~^(md5|sha1)$~',$s))$J="$s($J)";return
unconvert_field($p,$J);}function
dumpOutput(){return
array();}function
dumpFormat(){return
array('csv'=>'CSV,','csv;'=>'CSV;','tsv'=>'TSV');}function
dumpDatabase($m){}function
dumpTable(){echo"\xef\xbb\xbf";}function
dumpData($R,$Pf,$H){global$i;$I=$i->query($H,1);if($I){while($K=$I->fetch_assoc()){if($Pf=="table"){dump_csv(array_keys($K));$Pf="INSERT";}dump_csv($K);}}}function
dumpFilename($Sc){return
friendly_url($Sc);}function
dumpHeaders($Sc,$Ud=false){$cc="csv";header("Content-Type: text/csv; charset=utf-8");return$cc;}function
importServerPath(){}function
homepage(){return
true;}function
navigation($Td){global$ca;echo'<h1>
',$this->name(),' <span class="version">',$ca,'</span>
<a href="https://www.adminer.org/editor/#download"',target_blank(),' id="version">',(version_compare($ca,$_COOKIE["adminer_version"])<0?h($_COOKIE["adminer_version"]):""),'</a>
</h1>
';if($Td=="auth"){$oc=true;foreach((array)$_SESSION["pwds"]as$Ng=>$xf){foreach($xf[""]as$V=>$G){if($G!==null){if($oc){echo"<p id='logins'>",script("mixin(qs('#logins'), {onmouseover: menuOver, onmouseout: menuOut});");$oc=false;}echo"<a href='".h(auth_url($Ng,"",$V))."'>".($V!=""?h($V):"<i>".lang(7)."</i>")."</a><br>\n";}}}}else{$this->databasesPrint($Td);if($Td!="db"&&$Td!="ns"){$S=table_status('',true);if(!$S)echo"<p class='message'>".lang(9)."\n";else$this->tablesPrint($S);}}}function
databasesPrint($Td){}function
tablesPrint($T){echo"<ul id='tables'>",script("mixin(qs('#tables'), {onmouseover: menuOver, onmouseout: menuOut});");foreach($T
as$K){echo'<li>';$C=$this->tableName($K);if(isset($K["Engine"])&&$C!="")echo"<a href='".h(ME).'select='.urlencode($K["Name"])."'".bold($_GET["select"]==$K["Name"]||$_GET["edit"]==$K["Name"],"select")." title='".lang(59)."'>$C</a>\n";}echo"</ul>\n";}function
_foreignColumn($wc,$f){foreach((array)$wc[$f]as$vc){if(count($vc["source"])==1){$C=$this->rowDescription($vc["table"]);if($C!=""){$u=idf_escape($vc["target"][0]);return
array($vc["table"],$u,$C);}}}}function
_foreignKeyOptions($R,$f,$Y=null){global$i;if(list($Yf,$u,$C)=$this->_foreignColumn(column_foreign_keys($R),$f)){$J=&$this->_values[$Yf];if($J===null){$S=table_status($Yf);$J=($S["Rows"]>1000?"":array(""=>"")+get_key_vals("SELECT $u, $C FROM ".table($Yf)." ORDER BY 2"));}if(!$J&&$Y!==null)return$i->result("SELECT $C FROM ".table($Yf)." WHERE $u = ".q($Y));return$J;}}}$b=(function_exists('adminer_object')?adminer_object():new
Adminer);function
page_header($gg,$o="",$Ra=array(),$hg=""){global$ba,$ca,$b,$Gb,$y;page_headers();if(is_ajax()&&$o){page_messages($o);exit;}$ig=$gg.($hg!=""?": $hg":"");$jg=strip_tags($ig.(SERVER!=""&&SERVER!="localhost"?h(" - ".SERVER):"")." - ".$b->name());echo'<!DOCTYPE html>
<html lang="',$ba,'" dir="',lang(60),'">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="noindex">
<title>',$jg,'</title>
<link rel="stylesheet" type="text/css" href="',h(preg_replace("~\\?.*~","",ME)."?file=default.css&version=4.6.3"),'">
',script_src(preg_replace("~\\?.*~","",ME)."?file=functions.js&version=4.6.3");if($b->head()){echo'<link rel="shortcut icon" type="image/x-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.6.3"),'">
<link rel="apple-touch-icon" href="',h(preg_replace("~\\?.*~","",ME)."?file=favicon.ico&version=4.6.3"),'">
';foreach($b->css()as$sb){echo'<link rel="stylesheet" type="text/css" href="',h($sb),'">
';}}echo'
<body class="',lang(60),' nojs">
';$r=get_temp_dir()."/adminer.version";if(!$_COOKIE["adminer_version"]&&function_exists('openssl_verify')&&file_exists($r)&&filemtime($r)+86400>time()){$Og=unserialize(file_get_contents($r));$Ne="-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwqWOVuF5uw7/+Z70djoK
RlHIZFZPO0uYRezq90+7Amk+FDNd7KkL5eDve+vHRJBLAszF/7XKXe11xwliIsFs
DFWQlsABVZB3oisKCBEuI71J4kPH8dKGEWR9jDHFw3cWmoH3PmqImX6FISWbG3B8
h7FIx3jEaw5ckVPVTeo5JRm/1DZzJxjyDenXvBQ/6o9DgZKeNDgxwKzH+sw9/YCO
jHnq1cFpOIISzARlrHMa/43YfeNRAm/tsBXjSxembBPo7aQZLAWHmaj5+K19H10B
nCpz9Y++cipkVEiKRGih4ZEvjoFysEOdRLj6WiD/uUNky4xGeA6LaJqh5XpkFkcQ
fQIDAQAB
-----END PUBLIC KEY-----
";if(openssl_verify($Og["version"],base64_decode($Og["signature"]),$Ne)==1)$_COOKIE["adminer_version"]=$Og["version"];}echo'<script',nonce(),'>
mixin(document.body, {onkeydown: bodyKeydown, onclick: bodyClick',(isset($_COOKIE["adminer_version"])?"":", onload: partial(verifyVersion, '$ca', '".js_escape(ME)."', '".get_token()."')");?>});
document.body.className = document.body.className.replace(/ nojs/, ' js');
var offlineMessage = '<?php echo
js_escape(lang(61)),'\';
var thousandsSeparator = \'',js_escape(lang(5)),'\';
</script>

<div id="help" class="jush-',$y,' jsonly hidden"></div>
',script("mixin(qs('#help'), {onmouseover: function () { helpOpen = 1; }, onmouseout: helpMouseout});"),'
<div id="content">
';if($Ra!==null){$A=substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1);echo'<p id="breadcrumb"><a href="'.h($A?$A:".").'">'.$Gb[DRIVER].'</a> &raquo; ';$A=substr(preg_replace('~\b(db|ns)=[^&]*&~','',ME),0,-1);$O=$b->serverName(SERVER);$O=($O!=""?$O:lang(62));if($Ra===false)echo"$O\n";else{echo"<a href='".($A?h($A):".")."' accesskey='1' title='Alt+Shift+1'>$O</a> &raquo; ";if($_GET["ns"]!=""||(DB!=""&&is_array($Ra)))echo'<a href="'.h($A."&db=".urlencode(DB).(support("scheme")?"&ns=":"")).'">'.h(DB).'</a> &raquo; ';if(is_array($Ra)){if($_GET["ns"]!="")echo'<a href="'.h(substr(ME,0,-1)).'">'.h($_GET["ns"]).'</a> &raquo; ';foreach($Ra
as$z=>$X){$_b=(is_array($X)?$X[1]:h($X));if($_b!="")echo"<a href='".h(ME."$z=").urlencode(is_array($X)?$X[0]:$X)."'>$_b</a> &raquo; ";}}echo"$gg\n";}}echo"<h2>$ig</h2>\n","<div id='ajaxstatus' class='jsonly hidden'></div>\n";restart_session();page_messages($o);$l=&get_session("dbs");if(DB!=""&&$l&&!in_array(DB,$l,true))$l=null;stop_session();define("PAGE_HEADER",1);}function
page_headers(){global$b;header("Content-Type: text/html; charset=utf-8");header("Cache-Control: no-cache");header("X-Frame-Options: deny");header("X-XSS-Protection: 0");header("X-Content-Type-Options: nosniff");header("Referrer-Policy: origin-when-cross-origin");foreach($b->csp()as$rb){$Lc=array();foreach($rb
as$z=>$X)$Lc[]="$z $X";header("Content-Security-Policy: ".implode("; ",$Lc));}$b->headers();}function
csp(){return
array(array("script-src"=>"'self' 'unsafe-inline' 'nonce-".get_nonce()."' 'strict-dynamic'","connect-src"=>"'self'","frame-src"=>"https://www.adminer.org","object-src"=>"'none'","base-uri"=>"'none'","form-action"=>"'self'",),);}function
get_nonce(){static$ae;if(!$ae)$ae=base64_encode(rand_string());return$ae;}function
page_messages($o){$Gg=preg_replace('~^[^?]*~','',$_SERVER["REQUEST_URI"]);$Qd=$_SESSION["messages"][$Gg];if($Qd){echo"<div class='message'>".implode("</div>\n<div class='message'>",$Qd)."</div>".script("messagesPrint();");unset($_SESSION["messages"][$Gg]);}if($o)echo"<div class='error'>$o</div>\n";}function
page_footer($Td=""){global$b,$mg;echo'</div>

';switch_lang();if($Td!="auth"){echo'<form action="" method="post">
<p class="logout">
<input type="submit" name="logout" value="',lang(63),'" id="logout">
<input type="hidden" name="token" value="',$mg,'">
</p>
</form>
';}echo'<div id="menu">
';$b->navigation($Td);echo'</div>
',script("setupSubmitHighlight(document);");}function
int32($Wd){while($Wd>=2147483648)$Wd-=4294967296;while($Wd<=-2147483649)$Wd+=4294967296;return(int)$Wd;}function
long2str($W,$Sg){$kf='';foreach($W
as$X)$kf.=pack('V',$X);if($Sg)return
substr($kf,0,end($W));return$kf;}function
str2long($kf,$Sg){$W=array_values(unpack('V*',str_pad($kf,4*ceil(strlen($kf)/4),"\0")));if($Sg)$W[]=strlen($kf);return$W;}function
xxtea_mx($dh,$ch,$Sf,$md){return
int32((($dh>>5&0x7FFFFFF)^$ch<<2)+(($ch>>3&0x1FFFFFFF)^$dh<<4))^int32(($Sf^$ch)+($md^$dh));}function
encrypt_string($Nf,$z){if($Nf=="")return"";$z=array_values(unpack("V*",pack("H*",md5($z))));$W=str2long($Nf,true);$Wd=count($W)-1;$dh=$W[$Wd];$ch=$W[0];$Oe=floor(6+52/($Wd+1));$Sf=0;while($Oe-->0){$Sf=int32($Sf+0x9E3779B9);$Kb=$Sf>>2&3;for($te=0;$te<$Wd;$te++){$ch=$W[$te+1];$Vd=xxtea_mx($dh,$ch,$Sf,$z[$te&3^$Kb]);$dh=int32($W[$te]+$Vd);$W[$te]=$dh;}$ch=$W[0];$Vd=xxtea_mx($dh,$ch,$Sf,$z[$te&3^$Kb]);$dh=int32($W[$Wd]+$Vd);$W[$Wd]=$dh;}return
long2str($W,false);}function
decrypt_string($Nf,$z){if($Nf=="")return"";if(!$z)return
false;$z=array_values(unpack("V*",pack("H*",md5($z))));$W=str2long($Nf,false);$Wd=count($W)-1;$dh=$W[$Wd];$ch=$W[0];$Oe=floor(6+52/($Wd+1));$Sf=int32($Oe*0x9E3779B9);while($Sf){$Kb=$Sf>>2&3;for($te=$Wd;$te>0;$te--){$dh=$W[$te-1];$Vd=xxtea_mx($dh,$ch,$Sf,$z[$te&3^$Kb]);$ch=int32($W[$te]-$Vd);$W[$te]=$ch;}$dh=$W[$Wd];$Vd=xxtea_mx($dh,$ch,$Sf,$z[$te&3^$Kb]);$ch=int32($W[0]-$Vd);$W[0]=$ch;$Sf=int32($Sf-0x9E3779B9);}return
long2str($W,true);}$i='';$Kc=$_SESSION["token"];if(!$Kc)$_SESSION["token"]=rand(1,1e6);$mg=get_token();$Be=array();if($_COOKIE["adminer_permanent"]){foreach(explode(" ",$_COOKIE["adminer_permanent"])as$X){list($z)=explode(":",$X);$Be[$z]=$X;}}function
add_invalid_login(){global$b;$Ac=file_open_lock(get_temp_dir()."/adminer.invalid");if(!$Ac)return;$id=unserialize(stream_get_contents($Ac));$dg=time();if($id){foreach($id
as$jd=>$X){if($X[0]<$dg)unset($id[$jd]);}}$hd=&$id[$b->bruteForceKey()];if(!$hd)$hd=array($dg+30*60,0);$hd[1]++;file_write_unlock($Ac,serialize($id));}function
check_invalid_login(){global$b;$id=unserialize(@file_get_contents(get_temp_dir()."/adminer.invalid"));$hd=$id[$b->bruteForceKey()];$Zd=($hd[1]>29?$hd[0]-time():0);if($Zd>0)auth_error(lang(64,ceil($Zd/60)));}$Ea=$_POST["auth"];if($Ea){session_regenerate_id();$Ng=$Ea["driver"];$O=$Ea["server"];$V=$Ea["username"];$G=(string)$Ea["password"];$m=$Ea["db"];set_password($Ng,$O,$V,$G);$_SESSION["db"][$Ng][$O][$V][$m]=true;if($Ea["permanent"]){$z=base64_encode($Ng)."-".base64_encode($O)."-".base64_encode($V)."-".base64_encode($m);$Ke=$b->permanentLogin(true);$Be[$z]="$z:".base64_encode($Ke?encrypt_string($G,$Ke):"");cookie("adminer_permanent",implode(" ",$Be));}if(count($_POST)==1||DRIVER!=$Ng||SERVER!=$O||$_GET["username"]!==$V||DB!=$m)redirect(auth_url($Ng,$O,$V,$m));}elseif($_POST["logout"]){if($Kc&&!verify_token()){page_header(lang(63),lang(65));page_footer("db");exit;}else{foreach(array("pwds","db","dbs","queries")as$z)set_session($z,null);unset_permanent();redirect(substr(preg_replace('~\b(username|db|ns)=[^&]*&~','',ME),0,-1),lang(66).' '.lang(67,'https://sourceforge.net/donate/index.php?group_id=264133'));}}elseif($Be&&!$_SESSION["pwds"]){session_regenerate_id();$Ke=$b->permanentLogin();foreach($Be
as$z=>$X){list(,$Za)=explode(":",$X);list($Ng,$O,$V,$m)=array_map('base64_decode',explode("-",$z));set_password($Ng,$O,$V,decrypt_string(base64_decode($Za),$Ke));$_SESSION["db"][$Ng][$O][$V][$m]=true;}}function
unset_permanent(){global$Be;foreach($Be
as$z=>$X){list($Ng,$O,$V,$m)=array_map('base64_decode',explode("-",$z));if($Ng==DRIVER&&$O==SERVER&&$V==$_GET["username"]&&$m==DB)unset($Be[$z]);}cookie("adminer_permanent",implode(" ",$Be));}function
auth_error($o){global$b,$Kc;$yf=session_name();if(isset($_GET["username"])){header("HTTP/1.1 403 Forbidden");if(($_COOKIE[$yf]||$_GET[$yf])&&!$Kc)$o=lang(68);else{restart_session();add_invalid_login();$G=get_password();if($G!==null){if($G===false)$o.='<br>'.lang(69,target_blank(),'<code>permanentLogin()</code>');set_password(DRIVER,SERVER,$_GET["username"],null);}unset_permanent();}}if(!$_COOKIE[$yf]&&$_GET[$yf]&&ini_bool("session.use_only_cookies"))$o=lang(70);$F=session_get_cookie_params();cookie("adminer_key",($_COOKIE["adminer_key"]?$_COOKIE["adminer_key"]:rand_string()),$F["lifetime"]);page_header(lang(37),$o,null);echo"<form action='' method='post'>\n","<div>";if(hidden_fields($_POST,array("auth")))echo"<p class='message'>".lang(71)."\n";echo"</div>\n";$b->loginForm();echo"</form>\n";page_footer("auth");exit;}if(isset($_GET["username"])&&!class_exists("Min_DB")){unset($_SESSION["pwds"][DRIVER]);unset_permanent();page_header(lang(72),lang(73,implode(", ",$Fe)),false);page_footer("auth");exit;}stop_session(true);if(isset($_GET["username"])){list($Qc,$De)=explode(":",SERVER,2);if(is_numeric($De)&&$De<1024)auth_error(lang(74));check_invalid_login();$i=connect();$n=new
Min_Driver($i);}$Dd=null;if(!is_object($i)||($Dd=$b->login($_GET["username"],get_password()))!==true)auth_error((is_string($i)?h($i):(is_string($Dd)?$Dd:lang(75))));if($Ea&&$_POST["token"])$_POST["token"]=$mg;$o='';if($_POST){if(!verify_token()){$dd="max_input_vars";$Nd=ini_get($dd);if(extension_loaded("suhosin")){foreach(array("suhosin.request.max_vars","suhosin.post.max_vars")as$z){$X=ini_get($z);if($X&&(!$Nd||$X<$Nd)){$dd=$z;$Nd=$X;}}}$o=(!$_POST["token"]&&$Nd?lang(76,"'$dd'"):lang(65).' '.lang(77));}}elseif($_SERVER["REQUEST_METHOD"]=="POST"){$o=lang(78,"'post_max_size'");if(isset($_GET["sql"]))$o.=' '.lang(79);}function
email_header($Lc){return"=?UTF-8?B?".base64_encode($Lc)."?=";}function
send_mail($Ob,$Qf,$Pd,$Bc="",$mc=array()){$Ub=(DIRECTORY_SEPARATOR=="/"?"\n":"\r\n");$Pd=str_replace("\n",$Ub,wordwrap(str_replace("\r","","$Pd\n")));$Qa=uniqid("boundary");$Ba="";foreach((array)$mc["error"]as$z=>$X){if(!$X)$Ba.="--$Qa$Ub"."Content-Type: ".str_replace("\n","",$mc["type"][$z]).$Ub."Content-Disposition: attachment; filename=\"".preg_replace('~["\n]~','',$mc["name"][$z])."\"$Ub"."Content-Transfer-Encoding: base64$Ub$Ub".chunk_split(base64_encode(file_get_contents($mc["tmp_name"][$z])),76,$Ub).$Ub;}$La="";$Mc="Content-Type: text/plain; charset=utf-8$Ub"."Content-Transfer-Encoding: 8bit";if($Ba){$Ba.="--$Qa--$Ub";$La="--$Qa$Ub$Mc$Ub$Ub";$Mc="Content-Type: multipart/mixed; boundary=\"$Qa\"";}$Mc.=$Ub."MIME-Version: 1.0$Ub"."X-Mailer: Adminer Editor".($Bc?$Ub."From: ".str_replace("\n","",$Bc):"");return
mail($Ob,email_header($Qf),$La.$Pd.$Ba,$Mc);}function
like_bool($p){return
preg_match("~bool|(tinyint|bit)\\(1\\)~",$p["full_type"]);}$i->select_db($b->database());$ge="RESTRICT|NO ACTION|CASCADE|SET NULL|SET DEFAULT";$Gb[DRIVER]=lang(37);if(isset($_GET["select"])&&($_POST["edit"]||$_POST["clone"])&&!$_POST["save"])$_GET["edit"]=$_GET["select"];if(isset($_GET["download"])){$a=$_GET["download"];$q=fields($a);header("Content-Type: application/octet-stream");header("Content-Disposition: attachment; filename=".friendly_url("$a-".implode("_",$_GET["where"])).".".friendly_url($_GET["field"]));$M=array(idf_escape($_GET["field"]));$I=$n->select($a,$M,array(where($_GET,$q)),$M);$K=($I?$I->fetch_row():array());echo$n->value($K[0],$q[$_GET["field"]]);exit;}elseif(isset($_GET["edit"])){$a=$_GET["edit"];$q=fields($a);$Z=(isset($_GET["select"])?($_POST["check"]&&count($_POST["check"])==1?where_check($_POST["check"][0],$q):""):where($_GET,$q));$Fg=(isset($_GET["select"])?$_POST["edit"]:$Z);foreach($q
as$C=>$p){if(!isset($p["privileges"][$Fg?"update":"insert"])||$b->fieldName($p)=="")unset($q[$C]);}if($_POST&&!$o&&!isset($_GET["select"])){$Cd=$_POST["referer"];if($_POST["insert"])$Cd=($Fg?null:$_SERVER["REQUEST_URI"]);elseif(!preg_match('~^.+&select=.+$~',$Cd))$Cd=ME."select=".urlencode($a);$x=indexes($a);$Ag=unique_array($_GET["where"],$x);$Re="\nWHERE $Z";if(isset($_POST["delete"]))queries_redirect($Cd,lang(80),$n->delete($a,$Re,!$Ag));else{$P=array();foreach($q
as$C=>$p){$X=process_input($p);if($X!==false&&$X!==null)$P[idf_escape($C)]=$X;}if($Fg){if(!$P)redirect($Cd);queries_redirect($Cd,lang(81),$n->update($a,$P,$Re,!$Ag));if(is_ajax()){page_headers();page_messages($o);exit;}}else{$I=$n->insert($a,$P);$xd=($I?last_id():0);queries_redirect($Cd,lang(82,($xd?" $xd":"")),$I);}}}$K=null;if($_POST["save"])$K=(array)$_POST["fields"];elseif($Z){$M=array();foreach($q
as$C=>$p){if(isset($p["privileges"]["select"])){$_a=convert_field($p);if($_POST["clone"]&&$p["auto_increment"])$_a="''";if($y=="sql"&&preg_match("~enum|set~",$p["type"]))$_a="1*".idf_escape($C);$M[]=($_a?"$_a AS ":"").idf_escape($C);}}$K=array();if(!support("table"))$M=array("*");if($M){$I=$n->select($a,$M,array($Z),$M,array(),(isset($_GET["select"])?2:1));if(!$I)$o=error();else{$K=$I->fetch_assoc();if(!$K)$K=false;}if(isset($_GET["select"])&&(!$K||$I->fetch_assoc()))$K=null;}}if(!support("table")&&!$q){if(!$Z){$I=$n->select($a,array("*"),$Z,array("*"));$K=($I?$I->fetch_assoc():false);if(!$K)$K=array($n->primary=>"");}if($K){foreach($K
as$z=>$X){if(!$Z)$K[$z]=null;$q[$z]=array("field"=>$z,"null"=>($z!=$n->primary),"auto_increment"=>($z==$n->primary));}}}edit_form($a,$q,$K,$Fg);}elseif(isset($_GET["select"])){$a=$_GET["select"];$S=table_status1($a);$x=indexes($a);$q=fields($a);$yc=column_foreign_keys($a);$fe=$S["Oid"];parse_str($_COOKIE["adminer_import"],$ta);$if=array();$g=array();$bg=null;foreach($q
as$z=>$p){$C=$b->fieldName($p);if(isset($p["privileges"]["select"])&&$C!=""){$g[$z]=html_entity_decode(strip_tags($C),ENT_QUOTES);if(is_shortable($p))$bg=$b->selectLengthProcess();}$if+=$p["privileges"];}list($M,$Dc)=$b->selectColumnsProcess($g,$x);$kd=count($Dc)<count($M);$Z=$b->selectSearchProcess($q,$x);$oe=$b->selectOrderProcess($q,$x);$_=$b->selectLimitProcess();if($_GET["val"]&&is_ajax()){header("Content-Type: text/plain; charset=utf-8");foreach($_GET["val"]as$Bg=>$K){$_a=convert_field($q[key($K)]);$M=array($_a?$_a:idf_escape(key($K)));$Z[]=where_check($Bg,$q);$J=$n->select($a,$M,$Z,$M);if($J)echo
reset($J->fetch_row());}exit;}$He=$Dg=null;foreach($x
as$w){if($w["type"]=="PRIMARY"){$He=array_flip($w["columns"]);$Dg=($M?$He:array());foreach($Dg
as$z=>$X){if(in_array(idf_escape($z),$M))unset($Dg[$z]);}break;}}if($fe&&!$He){$He=$Dg=array($fe=>0);$x[]=array("type"=>"PRIMARY","columns"=>array($fe));}if($_POST&&!$o){$Xg=$Z;if(!$_POST["all"]&&is_array($_POST["check"])){$Xa=array();foreach($_POST["check"]as$Ua)$Xa[]=where_check($Ua,$q);$Xg[]="((".implode(") OR (",$Xa)."))";}$Xg=($Xg?"\nWHERE ".implode(" AND ",$Xg):"");if($_POST["export"]){cookie("adminer_import","output=".urlencode($_POST["output"])."&format=".urlencode($_POST["format"]));dump_headers($a);$b->dumpTable($a,"");$Bc=($M?implode(", ",$M):"*").convert_fields($g,$q,$M)."\nFROM ".table($a);$Fc=($Dc&&$kd?"\nGROUP BY ".implode(", ",$Dc):"").($oe?"\nORDER BY ".implode(", ",$oe):"");if(!is_array($_POST["check"])||$He)$H="SELECT $Bc$Xg$Fc";else{$_g=array();foreach($_POST["check"]as$X)$_g[]="(SELECT".limit($Bc,"\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$q).$Fc,1).")";$H=implode(" UNION ALL ",$_g);}$b->dumpData($a,"table",$H);exit;}if(!$b->selectEmailProcess($Z,$yc)){if($_POST["save"]||$_POST["delete"]){$I=true;$ua=0;$P=array();if(!$_POST["delete"]){foreach($g
as$C=>$X){$X=process_input($q[$C]);if($X!==null&&($_POST["clone"]||$X!==false))$P[idf_escape($C)]=($X!==false?$X:idf_escape($C));}}if($_POST["delete"]||$P){if($_POST["clone"])$H="INTO ".table($a)." (".implode(", ",array_keys($P)).")\nSELECT ".implode(", ",$P)."\nFROM ".table($a);if($_POST["all"]||($He&&is_array($_POST["check"]))||$kd){$I=($_POST["delete"]?$n->delete($a,$Xg):($_POST["clone"]?queries("INSERT $H$Xg"):$n->update($a,$P,$Xg)));$ua=$i->affected_rows;}else{foreach((array)$_POST["check"]as$X){$Tg="\nWHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($X,$q);$I=($_POST["delete"]?$n->delete($a,$Tg,1):($_POST["clone"]?queries("INSERT".limit1($a,$H,$Tg)):$n->update($a,$P,$Tg,1)));if(!$I)break;$ua+=$i->affected_rows;}}}$Pd=lang(83,$ua);if($_POST["clone"]&&$I&&$ua==1){$xd=last_id();if($xd)$Pd=lang(82," $xd");}queries_redirect(remove_from_uri($_POST["all"]&&$_POST["delete"]?"page":""),$Pd,$I);if(!$_POST["delete"]){edit_form($a,$q,(array)$_POST["fields"],!$_POST["clone"]);page_footer();exit;}}elseif(!$_POST["import"]){if(!$_POST["val"])$o=lang(84);else{$I=true;$ua=0;foreach($_POST["val"]as$Bg=>$K){$P=array();foreach($K
as$z=>$X){$z=bracket_escape($z,1);$P[idf_escape($z)]=(preg_match('~char|text~',$q[$z]["type"])||$X!=""?$b->processInput($q[$z],$X):"NULL");}$I=$n->update($a,$P," WHERE ".($Z?implode(" AND ",$Z)." AND ":"").where_check($Bg,$q),!$kd&&!$He," ");if(!$I)break;$ua+=$i->affected_rows;}queries_redirect(remove_from_uri(),lang(83,$ua),$I);}}elseif(!is_string($lc=get_file("csv_file",true)))$o=upload_error($lc);elseif(!preg_match('~~u',$lc))$o=lang(85);else{cookie("adminer_import","output=".urlencode($ta["output"])."&format=".urlencode($_POST["separator"]));$I=true;$fb=array_keys($q);preg_match_all('~(?>"[^"]*"|[^"\r\n]+)+~',$lc,$Jd);$ua=count($Jd[0]);$n->begin();$N=($_POST["separator"]=="csv"?",":($_POST["separator"]=="tsv"?"\t":";"));$L=array();foreach($Jd[0]as$z=>$X){preg_match_all("~((?>\"[^\"]*\")+|[^$N]*)$N~",$X.$N,$Kd);if(!$z&&!array_diff($Kd[1],$fb)){$fb=$Kd[1];$ua--;}else{$P=array();foreach($Kd[1]as$t=>$cb)$P[idf_escape($fb[$t])]=($cb==""&&$q[$fb[$t]]["null"]?"NULL":q(str_replace('""','"',preg_replace('~^"|"$~','',$cb))));$L[]=$P;}}$I=(!$L||$n->insertUpdate($a,$L,$He));if($I)$I=$n->commit();queries_redirect(remove_from_uri("page"),lang(86,$ua),$I);$n->rollback();}}}$Vf=$b->tableName($S);if(is_ajax()){page_headers();ob_start();}else
page_header(lang(49).": $Vf",$o);$P=null;if(isset($if["insert"])||!support("table")){$P="";foreach((array)$_GET["where"]as$X){if($yc[$X["col"]]&&count($yc[$X["col"]])==1&&($X["op"]=="="||(!$X["op"]&&!preg_match('~[_%]~',$X["val"]))))$P.="&set".urlencode("[".bracket_escape($X["col"])."]")."=".urlencode($X["val"]);}}$b->selectLinks($S,$P);if(!$g&&support("table"))echo"<p class='error'>".lang(87).($q?".":": ".error())."\n";else{echo"<form action='' id='form'>\n","<div style='display: none;'>";hidden_fields_get();echo(DB!=""?'<input type="hidden" name="db" value="'.h(DB).'">'.(isset($_GET["ns"])?'<input type="hidden" name="ns" value="'.h($_GET["ns"]).'">':""):"");echo'<input type="hidden" name="select" value="'.h($a).'">',"</div>\n";$b->selectColumnsPrint($M,$g);$b->selectSearchPrint($Z,$g,$x);$b->selectOrderPrint($oe,$g,$x);$b->selectLimitPrint($_);$b->selectLengthPrint($bg);$b->selectActionPrint($x);echo"</form>\n";$E=$_GET["page"];if($E=="last"){$_c=$i->result(count_rows($a,$Z,$kd,$Dc));$E=floor(max(0,$_c-1)/$_);}$pf=$M;$Ec=$Dc;if(!$pf){$pf[]="*";$mb=convert_fields($g,$q,$M);if($mb)$pf[]=substr($mb,2);}foreach($M
as$z=>$X){$p=$q[idf_unescape($X)];if($p&&($_a=convert_field($p)))$pf[$z]="$_a AS $X";}if(!$kd&&$Dg){foreach($Dg
as$z=>$X){$pf[]=idf_escape($z);if($Ec)$Ec[]=idf_escape($z);}}$I=$n->select($a,$pf,$Z,$Ec,$oe,$_,$E,true);if(!$I)echo"<p class='error'>".error()."\n";else{if($y=="mssql"&&$E)$I->seek($_*$E);$Qb=array();echo"<form action='' method='post' enctype='multipart/form-data'>\n";$L=array();while($K=$I->fetch_assoc()){if($E&&$y=="oracle")unset($K["RNUM"]);$L[]=$K;}if($_GET["page"]!="last"&&$_!=""&&$Dc&&$kd&&$y=="sql")$_c=$i->result(" SELECT FOUND_ROWS()");if(!$L)echo"<p class='message'>".lang(12)."\n";else{$Ka=$b->backwardKeys($a,$Vf);echo"<table id='table' cellspacing='0' class='nowrap checkable'>",script("mixin(qs('#table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true), onkeydown: editingKeydown});"),"<thead><tr>".(!$Dc&&$M?"":"<td><input type='checkbox' id='all-page' class='jsonly'>".script("qs('#all-page').onclick = partial(formCheck, /check/);","")." <a href='".h($_GET["modify"]?remove_from_uri("modify"):$_SERVER["REQUEST_URI"]."&modify=1")."'>".lang(88)."</a>");$Xd=array();$Cc=array();reset($M);$Te=1;foreach($L[0]as$z=>$X){if(!isset($Dg[$z])){$X=$_GET["columns"][key($M)];$p=$q[$M?($X?$X["col"]:current($M)):$z];$C=($p?$b->fieldName($p,$Te):($X["fun"]?"*":$z));if($C!=""){$Te++;$Xd[$z]=$C;$f=idf_escape($z);$Rc=remove_from_uri('(order|desc)[^=]*|page').'&order%5B0%5D='.urlencode($z);$_b="&desc%5B0%5D=1";echo"<th>".script("mixin(qsl('th'), {onmouseover: partial(columnMouse), onmouseout: partial(columnMouse, ' hidden')});",""),'<a href="'.h($Rc.($oe[0]==$f||$oe[0]==$z||(!$oe&&$kd&&$Dc[0]==$f)?$_b:'')).'">';echo
apply_sql_function($X["fun"],$C)."</a>";echo"<span class='column hidden'>","<a href='".h($Rc.$_b)."' title='".lang(89)."' class='text'> â†“</a>";if(!$X["fun"]){echo'<a href="#fieldset-search" title="'.lang(44).'" class="text jsonly"> =</a>',script("qsl('a').onclick = partial(selectSearch, '".js_escape($z)."');");}echo"</span>";}$Cc[$z]=$X["fun"];next($M);}}$_d=array();if($_GET["modify"]){foreach($L
as$K){foreach($K
as$z=>$X)$_d[$z]=max($_d[$z],min(40,strlen(utf8_decode($X))));}}echo($Ka?"<th>".lang(90):"")."</thead>\n";if(is_ajax()){if($_%2==1&&$E%2==1)odd();ob_end_clean();}foreach($b->rowDescriptions($L,$yc)as$Wd=>$K){$Ag=unique_array($L[$Wd],$x);if(!$Ag){$Ag=array();foreach($L[$Wd]as$z=>$X){if(!preg_match('~^(COUNT\((\*|(DISTINCT )?`(?:[^`]|``)+`)\)|(AVG|GROUP_CONCAT|MAX|MIN|SUM)\(`(?:[^`]|``)+`\))$~',$z))$Ag[$z]=$X;}}$Bg="";foreach($Ag
as$z=>$X){if(($y=="sql"||$y=="pgsql")&&preg_match('~char|text|enum|set~',$q[$z]["type"])&&strlen($X)>64){$z=(strpos($z,'(')?$z:idf_escape($z));$z="MD5(".($y!='sql'||preg_match("~^utf8~",$q[$z]["collation"])?$z:"CONVERT($z USING ".charset($i).")").")";$X=md5($X);}$Bg.="&".($X!==null?urlencode("where[".bracket_escape($z)."]")."=".urlencode($X):"null%5B%5D=".urlencode($z));}echo"<tr".odd().">".(!$Dc&&$M?"":"<td>".checkbox("check[]",substr($Bg,1),in_array(substr($Bg,1),(array)$_POST["check"])).($kd||information_schema(DB)?"":" <a href='".h(ME."edit=".urlencode($a).$Bg)."' class='edit'>".lang(91)."</a>"));foreach($K
as$z=>$X){if(isset($Xd[$z])){$p=$q[$z];$X=$n->value($X,$p);if($X!=""&&(!isset($Qb[$z])||$Qb[$z]!=""))$Qb[$z]=(is_mail($X)?$Xd[$z]:"");$A="";if(preg_match('~blob|bytea|raw|file~',$p["type"])&&$X!="")$A=ME.'download='.urlencode($a).'&field='.urlencode($z).$Bg;if(!$A&&$X!==null){foreach((array)$yc[$z]as$xc){if(count($yc[$z])==1||end($xc["source"])==$z){$A="";foreach($xc["source"]as$t=>$Ef)$A.=where_link($t,$xc["target"][$t],$L[$Wd][$Ef]);$A=($xc["db"]!=""?preg_replace('~([?&]db=)[^&]+~','\1'.urlencode($xc["db"]),ME):ME).'select='.urlencode($xc["table"]).$A;if($xc["ns"])$A=preg_replace('~([?&]ns=)[^&]+~','\1'.urlencode($xc["ns"]),$A);if(count($xc["source"])==1)break;}}}if($z=="COUNT(*)"){$A=ME."select=".urlencode($a);$t=0;foreach((array)$_GET["where"]as$W){if(!array_key_exists($W["col"],$Ag))$A.=where_link($t++,$W["col"],$W["val"],$W["op"]);}foreach($Ag
as$md=>$W)$A.=where_link($t++,$md,$W);}$X=select_value($X,$A,$p,$bg);$u=h("val[$Bg][".bracket_escape($z)."]");$Y=$_POST["val"][$Bg][bracket_escape($z)];$Mb=!is_array($K[$z])&&is_utf8($X)&&$L[$Wd][$z]==$K[$z]&&!$Cc[$z];$ag=preg_match('~text|lob~',$p["type"]);if(($_GET["modify"]&&$Mb)||$Y!==null){$Hc=h($Y!==null?$Y:$K[$z]);echo"<td>".($ag?"<textarea name='$u' cols='30' rows='".(substr_count($K[$z],"\n")+1)."'>$Hc</textarea>":"<input name='$u' value='$Hc' size='$_d[$z]'>");}else{$Ed=strpos($X,"<i>...</i>");echo"<td id='$u' data-text='".($Ed?2:($ag?1:0))."'".($Mb?"":" data-warning='".h(lang(92))."'").">$X</td>";}}}if($Ka)echo"<td>";$b->backwardKeysPrint($Ka,$L[$Wd]);echo"</tr>\n";}if(is_ajax())exit;echo"</table>\n";}if(!is_ajax()){if($L||$E){$Yb=true;if($_GET["page"]!="last"){if($_==""||(count($L)<$_&&($L||!$E)))$_c=($E?$E*$_:0)+count($L);elseif($y!="sql"||!$kd){$_c=($kd?false:found_rows($S,$Z));if($_c<max(1e4,2*($E+1)*$_))$_c=reset(slow_query(count_rows($a,$Z,$kd,$Dc)));else$Yb=false;}}$ue=($_!=""&&($_c===false||$_c>$_||$E));if($ue){echo(($_c===false?count($L)+1:$_c-$E*$_)>$_?'<p><a href="'.h(remove_from_uri("page")."&page=".($E+1)).'" class="loadmore">'.lang(93).'</a>'.script("qsl('a').onclick = partial(selectLoadMore, ".(+$_).", '".lang(94)."...');",""):''),"\n";}}echo"<div class='footer'><div>\n";if($L||$E){if($ue){$Ld=($_c===false?$E+(count($L)>=$_?2:1):floor(($_c-1)/$_));echo"<fieldset>";if($y!="simpledb"){echo"<legend><a href='".h(remove_from_uri("page"))."'>".lang(95)."</a></legend>",script("qsl('a').onclick = function () { pageClick(this.href, +prompt('".lang(95)."', '".($E+1)."')); return false; };"),pagination(0,$E).($E>5?" ...":"");for($t=max(1,$E-4);$t<min($Ld,$E+5);$t++)echo
pagination($t,$E);if($Ld>0){echo($E+5<$Ld?" ...":""),($Yb&&$_c!==false?pagination($Ld,$E):" <a href='".h(remove_from_uri("page")."&page=last")."' title='~$Ld'>".lang(96)."</a>");}}else{echo"<legend>".lang(95)."</legend>",pagination(0,$E).($E>1?" ...":""),($E?pagination($E,$E):""),($Ld>$E?pagination($E+1,$E).($Ld>$E+1?" ...":""):"");}echo"</fieldset>\n";}echo"<fieldset>","<legend>".lang(97)."</legend>";$Eb=($Yb?"":"~ ").$_c;echo
checkbox("all",1,0,($_c!==false?($Yb?"":"~ ").lang(98,$_c):""),"var checked = formChecked(this, /check/); selectCount('selected', this.checked ? '$Eb' : checked); selectCount('selected2', this.checked || !checked ? '$Eb' : checked);")."\n","</fieldset>\n";if($b->selectCommandPrint()){echo'<fieldset',($_GET["modify"]?'':' class="jsonly"'),'><legend>',lang(88),'</legend><div>
<input type="submit" value="',lang(14),'"',($_GET["modify"]?'':' title="'.lang(84).'"'),'>
</div></fieldset>
<fieldset><legend>',lang(99),' <span id="selected"></span></legend><div>
<input type="submit" name="edit" value="',lang(10),'">
<input type="submit" name="clone" value="',lang(100),'">
<input type="submit" name="delete" value="',lang(18),'">',confirm(),'</div></fieldset>
';}$zc=$b->dumpFormat();foreach((array)$_GET["columns"]as$f){if($f["fun"]){unset($zc['sql']);break;}}if($zc){print_fieldset("export",lang(101)." <span id='selected2'></span>");$se=$b->dumpOutput();echo($se?html_select("output",$se,$ta["output"])." ":""),html_select("format",$zc,$ta["format"])," <input type='submit' name='export' value='".lang(101)."'>\n","</div></fieldset>\n";}$b->selectEmailPrint(array_filter($Qb,'strlen'),$g);}echo"</div></div>\n";if($b->selectImportPrint()){echo"<div>","<a href='#import'>".lang(102)."</a>",script("qsl('a').onclick = partial(toggle, 'import');",""),"<span id='import' class='hidden'>: ","<input type='file' name='csv_file'> ",html_select("separator",array("csv"=>"CSV,","csv;"=>"CSV;","tsv"=>"TSV"),$ta["format"],1);echo" <input type='submit' name='import' value='".lang(102)."'>","</span>","</div>";}echo"<input type='hidden' name='token' value='$mg'>\n","</form>\n",(!$Dc&&$M?"":script("tableCheck();"));}}}if(is_ajax()){ob_end_clean();exit;}}elseif(isset($_GET["script"])){if($_GET["script"]=="kill")$i->query("KILL ".number($_POST["kill"]));elseif(list($R,$u,$C)=$b->_foreignColumn(column_foreign_keys($_GET["source"]),$_GET["field"])){$_=11;$I=$i->query("SELECT $u, $C FROM ".table($R)." WHERE ".(preg_match('~^[0-9]+$~',$_GET["value"])?"$u = $_GET[value] OR ":"")."$C LIKE ".q("$_GET[value]%")." ORDER BY 2 LIMIT $_");for($t=1;($K=$I->fetch_row())&&$t<$_;$t++)echo"<a href='".h(ME."edit=".urlencode($R)."&where".urlencode("[".bracket_escape(idf_unescape($u))."]")."=".urlencode($K[0]))."'>".h($K[1])."</a><br>\n";if($K)echo"...\n";}exit;}else{page_header(lang(62),"",false);if($b->homepage()){echo"<form action='' method='post'>\n","<p>".lang(103).": <input type='search' name='query' value='".h($_POST["query"])."'> <input type='submit' value='".lang(44)."'>\n";if($_POST["query"]!="")search_tables();echo"<table cellspacing='0' class='nowrap checkable'>\n",script("mixin(qsl('table'), {onclick: tableClick, ondblclick: partialArg(tableClick, true)});"),'<thead><tr class="wrap">','<td><input id="check-all" type="checkbox" class="jsonly">'.script("qs('#check-all').onclick = partial(formCheck, /^tables\[/);",""),'<th>'.lang(104),'<td>'.lang(105),"</thead>\n";foreach(table_status()as$R=>$K){$C=$b->tableName($K);if(isset($K["Engine"])&&$C!=""){echo'<tr'.odd().'><td>'.checkbox("tables[]",$R,in_array($R,(array)$_POST["tables"],true)),"<th><a href='".h(ME).'select='.urlencode($R)."'>$C</a>";$X=format_number($K["Rows"]);echo"<td align='right'><a href='".h(ME."edit=").urlencode($R)."'>".($K["Engine"]=="InnoDB"&&$X?"~ $X":$X)."</a>";}}echo"</table>\n","</form>\n",script("tableCheck();");}}page_footer();