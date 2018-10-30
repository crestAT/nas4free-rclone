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
lzw_decompress("\0\0\0` \0�\0\n @\0�C��\"\0`E�Q����?�tvM'�Jd�d\\�b0\0�\"��fӈ��s5����A�XPaJ�0���8�#R�T��z`�#.��c�X��Ȁ?�-\0�Im?�.�M��\0ȯ(̉��/(%�\0");}elseif($_GET["file"]=="default.css"){header("Content-Type: text/css; charset=utf-8");echo
lzw_decompress("\n1̇�ٌ�l7��B1�4vb0��fs���n2B�ѱ٘�n:�#(�b.\rDc)��a7E����l�ñ��i1̎s���-4��f�	��i7������Fé�vt2���!�r0���t~�U�'3M��W�B�'c�P�:6T\rc�A�zr_�WK�\r-�VNFS%~�c���&�\\^�r����u�ŎÞ�ً4'7k����Q��h�'g\rFB\ryT7SS�P�1=ǤcI��:�d��m>�S8L�J��t.M���	ϋ`'C����889�� �Q����2�#8А����6m����j��h�<�����9/��:�J�)ʂ�\0d>!\0Z��v�n��o(���k�7��s��>��!�R\"*nS�\0@P\"��(�#[���@g�o���zn�9k�8�n���1�I*��=�n������0�c(�;�à��!���*c��>Ύ�E7D�LJ��1����`�8(��3M��\"�39�?E�e=Ҭ�~������Ӹ7;�C����E\rd!)�a*�5ajo\0�#`�38�\0��]�e���2�	mk��e]���AZs�StZ�Z!)BR�G+�#Jv2(���c�4<�#sB�0���6YL\r�=���[�73��<�:��bx��J=	m_ ���f�l��t��I��H�3�x*���6`t6��%�U�L�eق�<�\0�AQ<P<:�#u/�:T\\>��-�xJ�͍QH\nj�L+j�z��7���`����\nk��'�N�vX>�C-T˩�����4*L�%Cj>7ߨ�ި���`���;y���q�r�3#��} :#n�\r�^�=C�Aܸ�Ǝ�s&8��K&��*0��t�S���=�[��:�\\]�E݌�/O�>^]�ø�<����gZ�V��q����� ��x\\������޺��\"J�\\î��##���D��x6��5x�������\rH�l ����b��r�7��6���j|����ۖ*�FAquvyO��WeM����D.F��:R�\$-����T!�DS`�8D�~��A`(�em�����T@O1@��X��\nLp�P�����m�yf��)	���GSEI���xC(s(a�?\$`tE�n��,�� \$a��U>,�В\$Z�kDm,G\0��\\��i��%ʹ� n��������g���b	y`��Ԇ�W� 䗗�_C��T\ni��H%�da��i�7�At�,��J�X4n����0o͹�9g\nzm�M%`�'I���О-���7:p�3p��Q�rED������b2]�PF����>e���3j\n�߰t!�?4f�tK;��\rΞи�!�o�u�?���Ph���0uIC}'~��2�v�Q���8)���7�DI�=��y&��ea�s*hɕjlA�(�\"�\\��m^i��M)��^�	|~�l��#!Y�f81RS����!���62P�C��l&���xd!�|��9�`�_OY�=��G�[E�-eL�CvT� )�@�j-5���pSg�.�G=���ZE��\$\0�цKj�U��\$���G'I�P��~�ځ� ;��hNێG%*�Rj�X[�XPf^��|��T!�*N��І�\rU��^q1V!��Uz,�I|7�7�r,���7���ľB���;�+���ߕ�A�p����^���~ؼW!3P�I8]��v�J��f�q�|,���9W�f`\0�q�Z�p}[Jdhy��N�Y|�Cy,�<s A�{e�Q���hd���Ǉ �B4;ks&�������a�������;˹}�S��J���)�=d��|���Nd��I�*8���dl�ѓ�E6~Ϩ�F����X`�M\rʞ/�%B/V�I�N&;���0�UC cT&.E+��������@�0`;���G�5��ަj'������Ɛ�Y�+��QZ-i���yv��I�5��,O|�P�]Fۏ�����\0���2�49͢���n/χ]س&��I^�=�l��qfI��= �]x1GR�&�e�7��)��'��:B�B�>a�z�-���2.����bz���#�����Uᓍ�L7-�w�t�3ɵ��e���D��\$�#���j�@�G�8� �7p���R�YC��~��:�@��EU�J��;67v]�J'���q1ϳ�El�QІi�����/��{k<��֡M�po�}��r��q�؞�c�ä�_m�w��^�u������������ln���	��_�~�G�n����{kܞ�w���\rj~�K�\0�����-����B�;����b`}�CC,���-��L��8\r,��kl�ǌ�n}-5����3u�gm��Ÿ�*�/������׏�`�`�#x�+B?#�ۏN;OR\r����\$�����k��ϙ\01\0k�\0�8��a��/t���#(&�l&���p��삅���i�M�{�zp*�-g���v��6�k�	���d�؋����A`");}elseif($_GET["file"]=="functions.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress("f:��gCI��\n8��3)��7���81��x:\nOg#)��r7\n\"��`�|2�gSi�H)N�S��\r��\"0��@�)�`(\$s6O!��V/=��' T4�=��iS��6IO��er�x�9�*ź��n3�\rщv�C��`���2G%�Y�����1��f���Ȃl��1�\ny�*pC\r\$�n�T��3=\\�r9O\"�	��l<�\r�\\��I,�s\nA��eh+M�!�q0��f�`(�N{c��+w���Y��p٧3�3��+I��j�����k��n�q���zi#^r�����3���[��o;��(��6�#�Ґ��\":cz>ߣC2v�CX�<�P��c*5\n���/�P97�|F��c0�����!���!���!��\nZ%�ć#CH�!��r8�\$���,�Rܔ2���^0��@�2��(�88P/��݄�\\�\$La\\�;c�H��HX���\nʃt���8A<�sZ�*�;I��3��@�2<���!A8G<�j�-K�({*\r��a1���N4Tc\"\\�!=1^���M9O�:�;j��\r�X��L#H�7�#Tݪ/-���p�;�B \n�2!���t]apΎ��\0R�C�v�M�I,\r���\0Hv��?kT�4����uٱ�;&���+&���\r�X���bu4ݡi88�2B�/⃖4���N8A�A)52������2��s�8�5���p�WC@�:�t�㾴�e��h\"#8_��cp^��I]OH��:zd�3g�(���Ök��\\6����2�ږ��i��7���]\r�xO�n�p�<��p�Q�U�n��|@���#G3��8bA��6�2�67%#�\\8\r��2�c\r�ݟk��.(�	��-�J;��� ��L�� ���W��㧓ѥɤ����n��ҧ���M��9ZНs]�z����y^[��4-�U\0ta��62^��.`���.C�j�[ᄠ% Q\0`d�M8�����\$O0`4���\n\0a\rA�<�@����\r!�:�BA�9�?h>�Ǻ��~̌�6Ȉh�=�-�A7X��և\\�\r��Q<蚧q�'!XΓ2�T �!�D\r��,K�\"�%�H�qR\r�̠��C =�������<c�\n#<�5�M� �E��y�������o\"�cJKL2�&��eR��W�AΐTw�ё;�J���\\`)5��ޜB�qhT3��R	�'\r+\":�8��tV�A�+]��S72��Y�F��Z85�c,���J��/+S�nBpoW�d��\"�Q��a�ZKp�ާy\$�����4�I�@L'@�xC�df�~}Q*�ҺA��Q�\"B�*2\0�.��kF�\"\r��� �o�\\�Ԣ���VijY��M��O�\$��2�ThH����0XH�5~kL���T*:~P��2�t���B\0�Y������j�vD�s.�9�s��̤�P�*x���b�o����P�\$�W/�*��z';��\$�*����d�m�Ã�'b\r�n%��47W�-�������K���@<�g�èbB��[7�\\�|�VdR��6leQ�`(Ԣ,�d��8\r�]S:?�1�`��Y�`�A�ғ%��ZkQ�sM�*���{`�J*�w��ӊ>�վ�D���>�eӾ�\"�t+po������W\$����Q�@��3t`����-k7g��]��l��E��^dW>nv�t�lzPH��FvW�V\n�h;��B�D�س/�:J��\\�+ %�����]��ъ��wa�ݫ���=��X��N�/��w�J�_[�t)5���QR2l�-:�Y9�&l R;�u#S	� ht�k�E!l���>SH��X<,��O�YyЃ%L�]\0�	��^�dw�3�,Sc�Qt�e=�M:4���2]��P�T�s��n:��u>�/�d�� ��a�'%����qҨ&@֐���H�G�@w8p����΁�Z\n��{�[�t2���a��>	�w�J�^+u~�o��µXkզBZk˱�X=��0>�t��lŃ)Wb�ܦ��'�A�,��m�Y�,�A���e��#V��+�n1I����E�+[����[��-R�mK9��~���L�-3O���`_0s���L;�����]�6��|��h�V�T:��ޞerM��a�\$~e�9�>����Д�\r��\\���J1Ú���%�=0{�	����|ޗtڼ�=���Q�|\0?��[g@u?ɝ|��4�*��c-7�4\ri'^���n;�������(���{K�h�nf���Zϝ}l�����]\r��pJ>�,gp{�;�\0��u)��s�N�'����H��C9M5��*��`�k�㬎����AhY��*����jJ�ǅPN+^� D�*��À���D��P���LQ`O&��\0�}�\$���6�Zn>��0� �e��\n��	�trp!�hV�'Py�^�*|r%|\nr\r#���@w����T.Rv�8�j�\nmB���p�� �Y0�Ϣ�m\0�@P\r8�Y\rG��d�	�QG�P%E�/@]\r���{\0�Q����bR M\rF��|��%0SDr�����f/����\":�mo�ރ�%�@�3H�x\0�l\0���	��W����\n�8\r\0}�@�D��`#�t��.�jEoDrǢlb����t�f4�0���%�0���k�z2\r� �W@�%\r\n~1��X����D2!��O�*���{0<E��k*m�0ı���|\r\n�^i��� ��!.�r � ��������f��Ĭ��+:��ŋJ�B5\$L���P���LĂ�� Z@����`^P�L%5%jp�H�W��on��kA#&���8��<K6�/����̏������XWe+&�%���c&rj��'%�x�����nK�2�2ֶ�l��*�.�r��΢���*�\r+jp�Bg�{ ���0�%1(���Z�`Q#�Ԏ�n*h��v�B����\\F\n�W�r f\$�93�G4%d�b�:JZ!�,��_��f%2��6s*F���Һ�EQ�q~��`ts�Ҁ���(�`�\r���#�R����R�r��X��:R�)�A*3�\$l�*ν:\"Xl��tbK�-��O>R�-�d��=��\$S�\$�2��}7Sf��[�}\"@�]�[6S|SE_>�q-�@z`�;�0��ƻ��C�*��[���{D��jC\nf�s�P�6'���ȕ QE���N\\%r�o�7o�G+dW4A*��#TqE�f��%�D�Z�3��2.��Rk��z@��@�E�D�`C�V!C��ŕ\0���I�)38��M3�@�3L��ZB�1F@L�h~G�1M���6��4�Xє�}ƞf�ˢIN��34��X�Btd�8\nbtN��Qb;�ܑD��L�\0��\"\n����V��6��]U�cVf���D`�M�6�O4�4sJ��55�5�\\x	�<5[F�ߵy7m�)@SV��Ğ#�x��8 ոы��`�\\`�-�v2���p���+v���U��L�xY.����\0005(�@��ⰵ[U@#�VJuX4�u_�\"JO(Dt�_	5s�^���������5�^�^V�I��\rg&]��\r\"ZCI�6��#��\r��ܓ��]7���q�0��6}o���`u��ab(�X�D�f�M�N)�V�UUF�о��=jSWi�\"\\B1Ğ�E0� �amP��&<�O_�L���.c�1Z*��R\$�h���mv�[v>ݭ�p����(��0����cP�om\0R��p�&�w+KQ�s6�}5[s�J���2��/���O �V*)�R�.Du33�F\r�;��v4���H�	_!��2��k����+��%�:�_,�eo��F��AJ�O�\"%�\n�k5`z %|�%�Ϋg|��}l�v2n7�~\0�	�YRH��@��r��xN-Jp\0���f#��@ˀmv�x��\r���2WMO/�\nD��7�}2���VW�W��wɀ7����H�k���]�\$�Mz\\�e�.f�RZ�a�B���Qd�KZ��vt���w4�\0�Z@�	��Bc;�b��>�B�	3m�n\n�o��J3��k�(܍���\"�yG\$:\r�ņ�ݎ��G6�ɲJ��y��Q�\\Q��if�����(�m)/r�\$�J�/�H�]*���g�ZOD�Ѭ��]1�g22������f�=HT��]N�&���M\0�[8x�ȮE��8&L�Vm�v����j�ט�F��\\��	���&s�@Q� \\\"�b��	��\rBs�Iw�	�Yɜ�N �7�C/&٫`�\n\n��[k���*A���T�V*UZtz{�.��y�S���#�3�ipzW@yC\nKT��1@|�z#���_CJz(B�,V�(K�_��dO���P�@X��t�Ѕ��c;�WZzW�_٠�\0ފ�CF�xR �	�\n������P�A��&������,�pfV|@N�\"�\$�[�i����������Z�\0Zd\\\"�|�W`��]��tz�o\$�\0[����u�e���ə�bhU-��,�r �Lk8��֫�V&�al����d��2;	�'-��Jyu��a���\0����a��{s�[9V\0��F��R �VB0S;D�>L4�&�ZHO1�\0�wg��S�tK��R�z���i��+�3�w��z�X�]�(G\$����D+�tչ�(#����oc�:	��Y6�\0��&��	@�	���)��!����w���# t�x�ND�����)��C��FZ�p��a��*F�b�	��ͼ����ģ�����Si/S�!��z�UH*�4����0�K�-�/���-k`�n�Li�J�~�w�Jn��\"�`�=��V�3Oį8t�>��vo��E.��Rz`��p�P���E\\��ɧ�3L�l�ѥs]T���oV��\n��	*�\r�@7)��D�m�0W�5Ӏ��ǰ�w��b���|	��JV����\"�ur\r�&N0N�B�d��d�8�D��_ͫ�^T��H#]�d�+�v�~�U,�PR%�����x���fA��C��m����͸����c��yŜD)���uH���p�p�^u\0�����}�{ѡ�\rg�s�QM�Y�2j�\r�|0\0X��@q���I`��5F�6�N��V@ӔsE�p���#\r�P�T��DeW�ؼ񛭁��z!û�:�DMV(��~X���9�\0�@���40N�ܽ~�Q�[T���e�qSv\"�\"h�\0R-�hZ�d����F5�P��`�9�D&xs9W֗5Er@o�wkb�1��PO-O�OxlH�D6/ֿ�m�ޠ��3�7T��K�~54�	�p#�I�>YIN\\5���NӃ����M��pr&�G�xM�sq����.F���8�Cs�� h�e5������*�b�)Sڪ��̭�e�0�-X� {�5|�i�֢a��ȕ6z�޽��/Y���ێM� ƃ� �\nR*8r o� @7�8Bf�z�K�r���A\$˰	p�\0?���d�k�|45}�A����ɶ�W��J�2k Gi\0\"����d���8�\0�>m��� `8�w�7�o4�cGh��Q�(퀨�8@\$<\0p��0���L�eX+�Ja�{�B��h��8�Cy���P2��Ӯ�*�EH�2���DqS�ۘ�p�0�I���k�`��S�\n�:��B�7����{-����`����6�A�W�ܖ\r�p�W#���?���{\0������cD��[<����f�--�pԌ�*B�]�nW��^��R70\r�+N�GN�\$(\0�#+y�@�@iD(8@\r�h��H�He����zz�{1���h��W1F�Who&aɜ�d6���jw�������`h�{v`RE�\nj���`�ܷ����*���ʸ}�Y��	\rY�H�6�#\0�廆��a�� Q�HEl4�d���p��#�������o�br+_)\r`��!�|dQ�>��=Qʡ��ζ�EOB'�>�P��Ӷ� A\rnK�i�� 	�����	�%<	�o;�S�@�!	�x��:���A�+\\1d\$�jO��7�%�	�/����gu�z*�G�H�5\"8��,�]raq���/�h��#����\$ /tn��8y��-�O���H�b���<�Z�!���1��`�.(uo����|`GːS��BaM	ڂ9ƞ�D@���1�B�tD��ʡ@?o�(H��qC��8E�TcncR��6�N%�rHj��2G\0�a��q �r��z9b>(P��x��<��)�x#�8�誹t���h�2v��Wo2U���t��+=�l#���j�D�	0����&R�c�\$�*̑-Z`��\r��;�|A�p�=1�	1����ƈ�bEv(^�X�P2=\0}�W���G�<���G�����R�#P�Hܮr9	��Y��!�LB���4�NC�Z��IC���MLm��,�f@eY�x�BS(�+��<4Y�)-�\r�z?\$���\"\"�� 6�E�\r)z���@ȑ��r����*��J�윋��%\$�e�J���\0A�\$ڰ/5��B0S���x��I�Q)�<��4YS�&�{��b�+IG=>�\r�PY`Z�D�`��U����F1���4d8X(����C%�`�㜭0�I\$�7W�pǁ,��Ac���&Ԍ�p\$�:�r@�\"{\0004�B�1�\rG��\nC�1A�-P.�v%��UXI�D<)��ӭ&Y�G`��W�\n�ǐ(0}�֍�= �]��1��qcT�*�@%��v\\ ��2,�0�t�\"@�T��\rP}�/d�@��6�bK��Ĝ���-�<��{F�i3g��)���Ж�8�fd���L\$1��������:\"�`�ɭ�M�35���%1�4Me�l���&N�q#�o�Nݴ@QC���O܍F(�v'#badV������\$���LgB���NǑ�)��Y��\0���y]KPr��@��s�ZЇfVI�\0��Id�b@&�8��M�umt˦���7�q3u h\n��4�M6k�<�Ă=`�D\\C�^!��:�0�y!��������)ZX(Q!���(�~���N��D����D{");}elseif($_GET["file"]=="jush.js"){header("Content-Type: text/javascript; charset=utf-8");echo
lzw_decompress('');}else{header("Content-Type: image/gif");switch($_GET["file"]){case"plus.gif":echo'';break;case"cross.gif":echo'';break;case"up.gif":echo'';break;case"down.gif":echo'';break;case"arrow.gif":echo'';break;}}exit;}if($_GET["script"]=="version"){$Ac=file_open_lock(get_temp_dir()."/adminer.version");if($Ac)file_write_unlock($Ac,serialize(array("signature"=>$_POST["signature"],"version"=>$_POST["version"])));exit;}global$b,$i,$n,$Gb,$Lb,$Tb,$o,$Cc,$Gc,$aa,$ed,$y,$ba,$vd,$ge,$Be,$Of,$Kc,$mg,$qg,$yg,$Eg,$ca;if(!$_SERVER["REQUEST_URI"])$_SERVER["REQUEST_URI"]=$_SERVER["ORIG_PATH_INFO"];if(!strpos($_SERVER["REQUEST_URI"],'?')&&$_SERVER["QUERY_STRING"]!="")$_SERVER["REQUEST_URI"].="?$_SERVER[QUERY_STRING]";if($_SERVER["HTTP_X_FORWARDED_PREFIX"])$_SERVER["REQUEST_URI"]=$_SERVER["HTTP_X_FORWARDED_PREFIX"].$_SERVER["REQUEST_URI"];$aa=($_SERVER["HTTPS"]&&strcasecmp($_SERVER["HTTPS"],"off"))||ini_bool("session.cookie_secure");@ini_set("session.use_trans_sid",false);if(!defined("SID")){session_cache_limiter("");session_name("adminer_sid");$F=array(0,preg_replace('~\?.*~','',$_SERVER["REQUEST_URI"]),"",$aa);if(version_compare(PHP_VERSION,'5.2.0')>=0)$F[]=true;call_user_func_array('session_set_cookie_params',$F);session_start();}remove_slashes(array(&$_GET,&$_POST,&$_COOKIE),$nc);if(get_magic_quotes_runtime())set_magic_quotes_runtime(false);@set_time_limit(0);@ini_set("zend.ze1_compatibility_mode",false);@ini_set("precision",15);$vd=array('en'=>'English','ar'=>'العربية','bg'=>'Български','bn'=>'বাংলা','bs'=>'Bosanski','ca'=>'Català','cs'=>'Čeština','da'=>'Dansk','de'=>'Deutsch','el'=>'Ελληνικά','es'=>'Español','et'=>'Eesti','fa'=>'فارسی','fi'=>'Suomi','fr'=>'Français','gl'=>'Galego','he'=>'עברית','hu'=>'Magyar','id'=>'Bahasa Indonesia','it'=>'Italiano','ja'=>'日本語','ko'=>'한국어','lt'=>'Lietuvių','ms'=>'Bahasa Melayu','nl'=>'Nederlands','no'=>'Norsk','pl'=>'Polski','pt'=>'Português','pt-br'=>'Português (Brazil)','ro'=>'Limba Română','ru'=>'Русский','sk'=>'Slovenčina','sl'=>'Slovenski','sr'=>'Српски','ta'=>'த‌மிழ்','th'=>'ภาษาไทย','tr'=>'Türkçe','uk'=>'Українська','vi'=>'Tiếng Việt','zh'=>'简体中文','zh-tw'=>'繁體中文',);function
get_lang(){global$ba;return$ba;}function
lang($v,$ce=null){if(is_string($v)){$Ee=array_search($v,get_translations("en"));if($Ee!==false)$v=$Ee;}global$ba,$qg;$pg=($qg[$v]?$qg[$v]:$v);if(is_array($pg)){$Ee=($ce==1?0:($ba=='cs'||$ba=='sk'?($ce&&$ce<5?1:2):($ba=='fr'?(!$ce?0:1):($ba=='pl'?($ce%10>1&&$ce%10<5&&$ce/10%10!=1?1:2):($ba=='sl'?($ce%100==1?0:($ce%100==2?1:($ce%100==3||$ce%100==4?2:3))):($ba=='lt'?($ce%10==1&&$ce%100!=11?0:($ce%10>1&&$ce/10%10!=1?1:2)):($ba=='bs'||$ba=='ru'||$ba=='sr'||$ba=='uk'?($ce%10==1&&$ce%100!=11?0:($ce%10>1&&$ce%10<5&&$ce/10%10!=1?1:2)):1)))))));$pg=$pg[$Ee];}$ya=func_get_args();array_shift($ya);$zc=str_replace("%d","%s",$pg);if($zc!=$pg)$ya[0]=format_number($ce);return
vsprintf($zc,$ya);}function
switch_lang(){global$ba,$vd;echo"<form action='' method='post'>\n<div id='lang'>",lang(19).": ".html_select("lang",$vd,$ba,"this.form.submit();")," <input type='submit' value='".lang(20)."' class='hidden'>\n","<input type='hidden' name='token' value='".get_token()."'>\n";echo"</div>\n</form>\n";}if(isset($_POST["lang"])&&verify_token()){cookie("adminer_lang",$_POST["lang"]);$_SESSION["lang"]=$_POST["lang"];$_SESSION["translations"]=array();redirect(remove_from_uri());}$ba="en";if(isset($vd[$_COOKIE["adminer_lang"]])){cookie("adminer_lang",$_COOKIE["adminer_lang"]);$ba=$_COOKIE["adminer_lang"];}elseif(isset($vd[$_SESSION["lang"]]))$ba=$_SESSION["lang"];else{$qa=array();preg_match_all('~([-a-z]+)(;q=([0-9.]+))?~',str_replace("_","-",strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"])),$Jd,PREG_SET_ORDER);foreach($Jd
as$B)$qa[$B[1]]=(isset($B[3])?$B[3]:1);arsort($qa);foreach($qa
as$z=>$Oe){if(isset($vd[$z])){$ba=$z;break;}$z=preg_replace('~-.*~','',$z);if(!isset($qa[$z])&&isset($vd[$z])){$ba=$z;break;}}}$qg=$_SESSION["translations"];if($_SESSION["translations_version"]!=2877580429){$qg=array();$_SESSION["translations_version"]=2877580429;}function
get_translations($ud){switch($ud){case"en":$h="A9D�y�@s:�G�(�ff�����	��:�S���a2\"1�..L'�I��m�#�s,�K��OP#I�@%9��i4�o2ύ���,9�%�P�b2��a��r\n2�NC�(�r4��1C`(�:Eb�9A�i:�&㙔�y��F��Y��\r�\n� 8Z�S=\$A����`�=�܌���0�\n��dF�	��n:Zΰ)��Q���mw����O��mfpQ�΂��q��a�į�#q��w7S�X3������o�\n>Z�M�zi��s;�̒��_�:���#|@�46��:�\r-z|�(j*���0�:-h��/̸�8)+r^1/Л�η,�ZӈKX�9,�p�:>#���(�6�qC���I�|��Ȣ,�(y �,	%b{�K���)B����P޵\rҪ�6��2��K�p�;��\$#�΁!,�7�#�2��A b�����,N1�\0S�<���=�RZ�#b��(�%&��L�����2���Б�a	�r4�9)��1OAH�<�N)�Y\$���W���%�\$	К&�B��cͬ<�������[K)���\r�������3\r�[G@�Lh�-�*�*\r���7(��:�c�9�è�L��X��	�Y�+Z~����;^_�!���J���롈M.�a��ë:�/c��v�\"�)̸�5��pAV���\0�,�N��2����`�@�ź���?.@ ��b���� �\n��Ѐ���D�A�6.hx�!�I���ʞ8\r(Ʌ��Ǒa؂P�*0�ݧ�^��g�+�mCEN8a�^���\\�k���3��7KHÞ��c�|\$�H�T:n{�tF��ސ�y4����dP:~�=Ogp����z�>`V��4��;��?�Z��\$#�ΎZf=��D��{���ch{��4�l3\"����o��hg����j�H\n-��A@\$���&dI�(f�߽c�Ό��2����R�a1&dԔ3fMk�6�6bTK	q0e��>S�\n�\$\$�2����,������0\"�rBy��A?怀�fTI\"�kmuw>S��C<ql��*ԗʷ-0 '�0�y>\nDՀ�x�����n�I)�Fq�r��i(11��2G�\"�A����IQ�\$a*@��n��/����_�i�&,�,S�q�\\,/R�Z�PʮH��A&Y\$h���/��ν`�����ψ3*I��&|�XF�i���.�\r��4�����\$l�68@]�i��� �pK��bAT*`Z�.�4�+�&<�%��+�a&�ę)�T�g�D�ɘ/��C~Jg��M�9�#Xp�T{\r�1�^B��6���·{HW�l�ٴ�3< ��)h�R��tiYQA\\4�p@HB�M�<;���%&�(!��~�C�%/TT� �#�qe&��0�h�M�qx�/Ҟ�t	�.l�Z�wu�װ\\";break;case"ar":$h="�C�P���l*�\r�,&\n�A���(J.��0Se\\�\r��b�@�0�,\nQ,l)���µ���A��j_1�C�M��e��S�\ng@�Og���X�DM�)��0��cA��n8�e*y#au4�� �Ir*;rS�U�dJ	}���*z�U�@��X;ai1l(n������[�y�d�u'c(��oF����e3�Nb���p2N�S��ӳ:LZ�z�P�\\b�u�.�[�Q`u	!��Jy��&2��(gT��SњM�x�5g5�K�K�¦����0ʀ(�7\rm8�7(�9\r�f\"7N�9�� ��4�x荶��x�;�#\"�������2ɰW\"J\nB��'hk�ūb�Di�\\@���p���yf���9����V�?�TXW���F��{�3)\"�W9�|��eRhU��Ҫ�1��P�>���\"o{�\"7�^��pL\n7OM*�O��<7cp�4��Rfl�N��SJ���Dŋ�#�����Jr� �>�J��Hsޜ:����ð�UlK���,n�R�*h������Ȓ,2 �B�����d4�PH�� gj�)���kR<�J�\"��ɣ\r/h�P�&�ӨRؑ3��ŗK!T��RN�����'ȍ�YI����x:�[I�l~�!U9H>�}�=�̜��n2�)vF<�1��Qa@�	�ht)�`P�5�h��ct0����[_�z?rb\0P�:\r�S<�#�J7��0���4V�J��T�U��X��@P�7�h�7!\0�E���c0�6`�3�C�X�[H�3�/PA��@����P9�*zN��A\0�)�B2�#�*���uL���a�*�����dLT�Z	+��3�V��@�v2�Ư�g;�4Pf3Oí���Í�6�1ѴX������0z)�}	P��3��x�b��\0�����;b�C!iN�����O՝�^���&a5���jP� K!C�\0�ӑ�z�콰��p`�����paymQ ���(n�\n\"����s�\$6�^aHt|��>poCz�6��0��JP�l�47B�~���fT����cE�.}����fA�!��(�@�stF�8 g����!�!����tn��F�zm#	0�8!CHa\r���dr_�qU\$�)�e��Xb�4>�Oك!��H���%H�%A\rF����͡�5F��\0ʲ�G6f�\n�y݃��)���t���r�H�,%^M�Q.(k�;Ҷ,�a�\$\$Nj*�P�)G>G-H��=\$��3U�*�4�L�I&|@Ҳ\r:B�!�fӃ�u6H\\3 ���a̀���V�\$�C��G�ؠ��l�\n<)�BDf#�X�s�:��ڑ�%�bp�Q%%ҊM��I�H�ET�J��N�����o��x[f;�\n (���;j�����HgL(��@�� 5�\\#@�U�テ�m��JF�1�ALmN�a`O�z�sb�٩��u��A�K\n�WD`Dב7_��D�[7li�r~m�X@�&a: �\n�Sa�B G��U�0� ����bA3Մ6�d/�\n�P#�p�ބ�=u��)��bW� ��[Ԃ:�9#sE�z�{�PLA6���71���%I!�#�̖��\$W��� GU**�DB�����MP�	�Q� �\"�@V�O��RS4�sV.e8��>_l�㽉��;�I8e5�[��>+�:¾����)OV�1o֢��\0P�4�8��%|>�k���,�\0";break;case"bg":$h="�P�\r�E�@4�!Awh�Z(&��~\n��fa��N�`���D��4���\"�]4\r;Ae2��a�������.a���rp��@ד�|.W.X4��FP�����\$�hR�s���}@�Зp�Д�B�4�sE�΢7f�&E�,��i�X\nFC1��l7c��MEo)_G����_<�Gӭ}���,k놊qPX�}F�+9���7i��Z贚i�Q��_a���Z��*�n^���S��9���Y�V��~�]�X\\R�6���}�j�}	�l�4�v��=��3	�\0�@D|�¤���[�����^]#�s.�3d\0*��X�7��p@2�C��9(� �:#�9��\0�7���A����8\\z8Fc�������m X���4�;��r�'HS���2�6A>�¦�6��5	�ܸ�kJ��&�j�\"K������9�{.��-�^�:�*U?�+*>S�3z>J&SK�&���hR����&�:��ɒ>I�J���L�H�H�����Eq8�ZV��s[����2�Ø�7ث��έj��/�h�C��?CմKT�Q�	�k�hL�X7&�\n��=��p�K*�i�Y-���U�D02!�R҉�!-�E_��>�#�H�� g����D�	\"�x�\$ҩS����:ںw����8�J��n��6����Ж@\"��h�4���<��K�kB9�i3Y�l��/��'�%�����J��(2�+n��v�َ%��\\�4����^b���hR8th(��怔 P��������\0��9���J�s��c��D6���'�̼���eb���iJ�������!��T��n�=�8	�j�K�>h�n�!�F�����������8A�4�F����N�i�Z�u��eCv�:��0'x��姃�xx+��x�'S�y����S�*���.�L��\\�I��!��&��h�j�|�%��;Z:\n�蹄:n��M�A����5hX�AF�^�;�\$�`�@�Q\n:��:�`��\0A��4��P���X��\0xA\0hA�3�D[�>F��:C��xa�(��(6V�cXK�\0v�\n�x\$���8�, T�d���,���ow��9�r��ɳ'�\"#Ę�Ah��80t�xw�@�0øz�r+�bIń�2��<9��B�J�X�i壣M	��l����|��/x�ͧ�6iH\\�Zˠ㐃x�Z4`<X���p�Q�!��\n�r�~\n�H= *#P���ݞ�@��pE�9�ʿfXa�0ƎC�f��6��gi��P4j��p q.\"�C`s9��-6S+�f���.�%��uR��tB�H\nY����  ����h+Gk�(!��}8\"�\r��8 ���e�\$\$t���oG�B~�y����v�E/�e��j\n&.���Β��\n)OR�Kc�E�\\^��,����!�,����`Ӊ�h�P��\">\$\r밂�Y�6�*mMY�LO�J��zW+�R�2Z'�u�B��0=4�c�^�ˊ<���ڭ:\n�L���s�q��א�B���{�U�w0^Y g��'�NS��V�	H4o�i�h	D��t�\n)^T�	Ɲ\"@�15��e�����Q	����hq�� �R��I��IyKJS�6���ܫ�0N~�\r*�������ܤjV�q��	3a8V��TL�i��j��|\\��ݱ�c���^�C�)6R͠AE`�c��nb�M�b�d��=km�!��\n���&+��KPW�N�	���3O[�Ҫi�6_SO3�,���q:\0�0-b&VR�\n#P8��~�����;���^�����0�ȭ���=w-S�{n�l�zB��TK%�ҞDy�KD\\F�`*gl��+d/�dh{�\n�O\"�(��\"��k1�ľ�t�A�Y��d{�W���q�2�܌ȁ�%�qm�)�v�sI>;Gf��B�-R�m�\r>�f��#�Ʉ�82�Zz��v8�u[�!E|��\rʐ�H�L�}4���m�[�x����֮������6K͕:mG�u)\\q���";break;case"bn":$h="�S)\nt]\0_� 	XD)L��@�4l5���BQp�� 9��\n��\0��,��h�SE�0�b�a%�. �H�\0��.b��2n��D�e*�D��M���,OJÐ��v����х\$:IK��g5U4�L�	Nd!u>�&������a\\�@'Jx��S���4�P�D�����z�.S��E<�OS���kb�O�af�hb�\0�B���r��)����Q��W��E�{K��PP~�9\\��l*�_W	��7��ɼ� 4N�Q�� 8�'cI��g2��O9��d0�<�CA��:#ܺ�%3��5�!n�nJ�mk����,q���@ᭋ�(n+L�9�x���k�I��2�L\0I��#Vܦ�#`�������B��4��:�� �,X���2����,(_)��7*�\n�p���p@2�C��9.�#�\0�#��2\r��7���8M���:�c��2@�L�� �S6�\\4�Gʂ\0�/n:&�.Ht��ļ/��0��2�TgPEt̥L�,L5H����L��G��j�%���R�t����-I�04=XK�\$Gf�Jz��R\$�a`(�����+b0�Ȉ�@/r��M�X�v����N����7cH�~Q(L�\$��>��(]x�W�}�YT���W5b�o�H�*|NKՅDJ���3 !��CmG��h�e4��5�Z@�c%=k�HK�C�-��9r/��A l����m��N)�\"�J:k^H�[q��#�\n���	ۑJW7D]�v�c������\0E�K	��r�Y)�-d֐��љ��4S�BVa����g�r��pKPP�dtN_�1���8�2�o�J5hRg��Ss�bUϔ�����G+�&YM���s����\$�\$	К&�B���p�cW�5�~�K�MѺh;�mGǻ8�:@S��#��7��0�&�J��Ҳ�Hǝ\0%����Ш�8m!�<�\0��cg�9�`�\0l\r�&0X|Ô\r!�0��A	��mI�����\nTI[T\"�D`@R�\rE��zSK2�R����Tf��/\n��\nhV��8�tED@��nx�,�C��f^!�~��@C\$*\rɲ�5��C\"l\0�0����\".@�'��`g��0���m��e6�Eڼ4T�HqVB��<GZQ����ٔ�g�AJ\$@���~���P�93��K�Q�:���C@t��9��^ü���4�����8/��e/���W�/�A���pm�a�A�U�&��\r���N\0�� iPI�F���YnSr���w�)�+/*.E3ޅ�X���FI%�dc\"��!�@/�@�lG�8&����:!�T'�% ��Pq5Q�|�A�a�m\0�,��i!�9�����t�*1eM6�v���:�@\$��,�f%�F��O��\0��;�Lq�cH��	�~b�pC_�H�y�I�=��2��\0���?��>�84�j�3��\$�/y�1p��\"��MaDU. ���`��*3ݻb���Ƞ�H�C&�g᫈��`��C�T@����:ژ��*d.o��\\@��*��J(~S�I'x@�Ώ2}N��r�����u>)�3&���,k�'�e��4��EsPg�D���P\r���\0�¡�E�E��[*�@��\n3Rl-��s���UR�;1d5YU#���!��L�ۜe+n�ġJﾗ@�6|��1���Q	��3V�@{#�F\n����5�'��X�&�ƜS1q��bC��\0x�Y\"z�<�u��d6jQG�U\\�z�i �(YF�e6���WR�e(�RѬĎQiPZ��&J�%9̩r��i796:e*j��� 9�<`�`la���0�(tu���Vy�8�Hf�����l\\c\"}�p�5P��h8^Q��\$��T�R�`����)�5Vsl!E�|�(l�b�H��o+�����4ڌ�a���d�=��}P7,�W7(��KcxΪ�#5�M��A7Pj*���Vcm���Dt�w�Ra,I�|�O���h3݁-����Ɋ(��\"���i+�\nY�°0\n�)�3��ڛӺs\\�bH+�Y��u/]�B\$mſDs������g'Wi���wf��\$�S�C+n�0�X��UaJ���A��M���#����q��ܲW�;���^��'�1&��_�B�ųv&\0";break;case"bs":$h="D0�\r����e��L�S���?	E�34S6MƨA��t7��p�tp@u9���x�N0���V\"d7����dp���؈�L�A�H�a)̅.�RL��	�p7���L�X\nFC1��l7AG���n7���(U�l�����b��eēѴ�>4����)�y��FY��\n,�΢A�f �-�����e3�Nw�|��H�\r�]�ŧ��43�X�ݣw��A!�D��6e�o7�Y>9���q�\$���iM�pV�tb�q\$�٤�\n%���LIT�k���)�乪��0�h���4	\n\n:�\n��:4P �;�c\"\\&��H�\ro�4����x��@��,�\nl�E��j�+)��\n���C�r�5����ү/�~����;.�����j�&�f)|0�B8�7����,����ŭZ��'��ģ���8�9�#|�	���*�f!\"�81��9��l:���br���P�/��P���J3F53���7��,UF��8Ę��MBTcR�STU%9,#�R���\\u�b�Q�j�3�L֌�\"9G.nbc,��p�,#X���\"���\"(�F�J�	�\"_%���%��(\r�J�\"1<:ŉ]��[�Z���+�]VF���^��C�lڰ�#�-�S�w���D)6~��P�0�B@�	�ht)�`P�\r�h\\-�9h�.�cծ�F�BF\r��0�'��2�7/�f9\\53I\r�hڍ)<�:�cT9�è؁\r�:�9���娌6��u;7�8P9�)p�2�ҳ��b��#C�5�Gߌ;)_k�v˘�:�ªR2�*4ML2��:��|Lܔ(�8@ ��[���s������42c0z)�|�'���|�\n�\r܂�V�D�OCZ3���N�Әț����	³��4�p�A�3�o^4���9�Ax^;�v9�Ar�3��w�8�Ӥ���|\$���Ncptw�7��Љ�` i��T�yV�(\\���JZ�u&������Hk3l��'B8�@ag�;\0�i�ـ4G���NC1M�%��v���c^?p����Bٌ����]Ù./E��£Bs�#��A�@��ph@\$���,\$�� �4K�v*Э���FiM9�^E�:�h�P�w%���7&����@��0��Zy�9�Et���aU	3��zs�Lb+��0@�ٽ;ʑ5��EC�<��� �Cr'6Q�ɇ�j��f?�m�>ȍ\$�,@�?��#��A=�(��i[�`��<A`�\\D0z4�R��6UD!&E��A��n�(�B��U�;�*g�Ϣ�vf�y�A���3�PB�\0S\n!1�i�HF\n���\"t4��� q\r�&�nT�\$��=t�O��E��¸#�J�!M䘔��Bs���9ڕ�C�0L����i�tY�:�)�I�E@Y�d!���\n�1�E\0�v��ބ!%\$:�9�\0��C�Q(Bɳ�P��h8M�Y�2\\��̔�M�70�N�H\rG�r&�0����3��e���2Q�\r\$fr@��p�O)�'�@7��<���i3���*\\bO��>�p��;#KI�S��&�J�WLQCD\ne\r���(f�~Q�V�\"��i��K^w)��ْ��䏯�,1�7dʭVdy��q����N�ъ�=/H�;�3f����%e��R2���yK�i\0";break;case"ca":$h="E9�j���e3�NC�P�\\33A�D�i��s9�LF�(��d5M�C	�@e6Ɠ���r����d�`g�I�hp��L�9��Q*�K��5L� ��S,�W-��\r��<�e4�&\"�P�b2��a��r\n1e��y��g4��&�Q:�h4�\rC�� �M���Xa����+�����\\>R��LK&��v������3��é�pt��0Y\$l�1\"P� ���d��\$�Ě`o9>U��^y�==��\n)�n�+Oo���M|���*��u���Nr9]x��{d���3j�P(��c��2&\"�:���:��\0��\r�rh�(��8����p�\r#{\$�j����#Ri�*��h����B��8B�D�J4��h��n{��K� !/28,\$�� #��@�:.�j0��`@����ʨ��4����U�P�&��b�\$� �#.�P�L�<�H�4�cJhŠ�2a�o\$4ҍZ�0����˴�@ʡ9�(�C�p��EU1���^u�cA%�(�20؃��zR6\r�x�	㒌�&FZ�S��FҔ�9k�6���\r�0e�e� P����qu\$	9�B(��2�N�;W�V�k�)q��sQ�p}0o��G_�>pH59\\�<蒲@�	�ht)�`P�2�h��c\\0���y�Pu&��\0Ѵ�*:7��4;N�){]\0�Nz������\n�z��\r��4���\$31A��2P���#8¼�ϵZ�\r���aJc��n�@!�b�����;���w��(�2�6�R;���T�yL�l����Z�\$У�#&ؗ�:b2�\$��h42�0z*!}\0�O`�3��x�&)�\"�S�L��H��lK�	�ќ8[N��`&���M�u��x�/�0]o^4���9�Ax^;��r?Ѧ���_�L�NCp_�a�(���w.�3#t�8tja���d���#G�,:P�a	0%\09�PACb~HN���@��a`�ts^JC��p�*p���kDa�,p��!i,\r\"`�P�ٔY簽�DraӃ�x&\\��a�#+��n�P��\r�!'�b\n\n\n�)@ԋ(�|��v��ٚ�Zk�C�5e�:TjV�z/k\$;��q�ҍ���t��	�Xİ�������5'd��R*�A�fQRDXLBI&�5�t�Ct	7`��AbJ��mt����t݃�?��?��b�M�8���(�2�>���@��̐.I�S��Q�+��Q�F��+݅a���TJ�K�[��)XaO��Y\$|�*���Q	� ��0T�*qS���d�f�*D9�`x�4O�j5�N��*�\$y�,\$<�a\r SԈ�2^I)E#��zу4`@i%f��Y�T��t束 ��Q#N��&�`+�*2~��ز^�Y�:�� Z�I�F��\n Xb�A\0U\n�����Ls���D��ʌ�L�5L��ѓ�C��=�&��ʊ��)[lВ��hbL[Ө��4���T�1l�&��z����id�)�힞jh�U�t�,ha�����d��8�&���q\\N�P1k@�.��d\n\$XrС��`�k��FQV*{^�hSb��2(%��(x��&��� ��Ef饯+ ��aq�*�\"5�s-\rr@";break;case"cs":$h="O8�'c!�~\n��fa�N2�\r�C2i6�Q��h90�'Hi��b7����i��i6ȍ���A;͆Y��@v2�\r&�y�Hs�JGQ�8%9��e:L�:e2���Zt�@\nFC1��l7AP��4T�ت�;j\nb�dWeH��a1M��̬���N���e���^/J��-{�J�p�lP���D��le2b��c��u:F���\r��bʻ�P��77��LDn�[?j1F��7�����I61T7r���{�F�E3i����Ǔ^0�b�b���p@c4{�2�&�\0���r\"��JZ�\r(挥b�䢦�k�:�CP�)�z�=\n �1�c(�*\n��99*�^����:4���2��Y����a����8 Q�F&�X�?�|\$߸�\n!\r)���<i��R�B8�7��x�4Ƃ��5���/j�P�'#dά��p���0��c+�0���Զ#�j�F�\$AH�(\"�H��#�z9Ƃ���;���F����.�sV�M�Ȅ�\0�0��HKT�p��WV`蹁C�7�P�pHXA��G�@�2DI��;O(��@Bb`Ȉ#\\f���\"��*0	�`暍�m\rF-@��1we�7�7%�t�b�6��\r�%R2�#\n07��<߷��U�N\n�0�M��_�^\0�b8%���\\.b�8�	�ht)�`P�\r�p�9f���n[λ�M���3�0̡@J��K���;H�7�Z�;A\0�]��\$5����~���!O��`@=k��>�\\6��#l��6�N��'ڝ�8:η�k��CP�ɬ���]��^�m����:��.����^���[/�qV�ƳH���8֞�)�pAr���w3��H��S���%w/5��ɼ14�z4;8�)�?��	���(ܦ�\0�2m�����@2���D�A�6Lȣ�I��^0���a���գt���C�?J}t�'֣�I�L�Q�!Z��K�A����E@�3�A)��(~��A��>`���@��x\\���hด�p^Ø/N���^�Ø>	!�8���Z~Oѩ\"�&S\n�b02\"��0F�12�����iK�Rk/d1?�HN	Ҡ\$�l�5TVd\r(0�\0@0��s}�l�%��#d5��Pۜ�\"���4\"c��\"��4���^�\nGi+.ԨD(d���8F&�c8��gP~\0P	@I�8+H��@��D�R�/��F(g���?��n+Вx�����KC�a�&F�M�ē�`)�9�D��#�<���7�5�\"S�3��j���Dp���\$��yU!��'D�z� h���\$�P�SۆD	��Fk�1F\$3\r�=@�.P��}�=ȓ�`�P	�L*(_��GS鞗����'ѝAM]��:��0i����Ba k�=�2V�\n;u!L(��JIʰm.f=�?F�m\r�|`�-\r�0@��Ӷ�G�H)h4�|�R�7���\0~�]u1��1W�}R��a(A�a�詃	P�+����y`')�(F��0#_�\n{f,Y��Ӫ���b\n��Z&*ŧ����Z��G��!A: �\n��C�)�:�Rjq\n#b�MT��f���_\r�)U�P��96����<�v,�v`d*�@�A�+���gX�km�aL2�*���}�O�����}��lw���r&EH��pn�sf`��\nWHȩB�)M!�E�z�B��K#�FΚB��3U-�!4*�ȚdC�xćC5W�:;'l�SR�\r	�R��ްOC��v�젿�~�Y�DJ��>�(���U3\n͈�����OOs��\0��F\\B��D<���ȥ����J	�AP�a�1D��WSz���";break;case"da":$h="E9�Q��k5�NC�P�\\33AAD����eA�\"���o0�#cI�\\\n&�Mpci�� :IM���Js:0�#���s�B�S�\nNF��M�,��8�P�FY8�0��cA��n8����h(�r4��&�	�I7�S	�|l�I�FS%�o7l51�r������(�6�n7���13�/�)��@a:0��\n��]���t��e�����8��g:`�	���h���B\r�g�Л����)�0�3��h\n!��pQT�k7���WX�'\"h.��e9�<:�t�=�3��ȓ�.�@;)CbҜ)�X��bD��MB���*ZH��	8�:'����;M��<����9��\r�#j������EBp�:Ѡ�欑���)��+<!#\n#���C(��0�(��b���K�|�-n�߭��܉���	�*��S\"���\n>�Lbp�ж�2�2�!,�?&��5 R.5A l���@ P��;�@쳎k#4��m��+\r�K\$2C\$��� ���k\"��B0�D��2|\n����Κ��Jef�(�P3�`0��-�e�C�\$	К&�B���z^-�e-�s���yW6�#�\r��,�� �ҍ�0�U���ESKj:�\"�����9(����c0��NkX�&�0������s�J7��P9�)8�3�#c|Јb��#����^7MvL�ێN{[48�\\��,e�*\r�V�Hê��ɑ�X��)��!\0О���D�A��)��x�!�5�\r2��`�bt�49����0�Mh���*���s(��F�b��q�\\lɳ\r��9�Ax^;�rC�<�8��]d��JCp_��a�6�͂�,m��9�E�I���ϴ#:tҤMK��]��9�(+��cZ�ƈ����:����1�2�@;�S�1��|����bX�i�}���L�'<3z��Imd���8�iA�\0×6��ȫ^'�˙�@@P��2�\n\n )rD����L���iL����Li�\r0D�\$�}Ñ�#'����Vx��*e����q��o#��9��<y�A*%��ϧ���tL&�7�����8hP�o\"!�z�(\$|�y�Xp\0����C��4!����� sd|����~����P|'�0�@�T+��*3����\r(A�цrD��������%0AI�;'�A��G�� g�����A�K#�|���N0S\n!0��A\0F\n�A�p��as����&\0R�8E\r�]<��ɪԜS�M	TTgT��6s�I�*y}��\"��j�\"�8O��?��\nhp6�ց�Y�\\���`�_^#�4P�2M��R\ra{Fz��P��T�ᚆP�w�*]�	��\nc\n�L׈3�f,Zjc	R�Ib���\$Fi�U�bU��X��4�|3�NH�Q{&r��������~Kn-U��=�#���J_`a�oB����ֻ˂�9gB	!��sA>#���@��ټ1d&������m�%���I\\@0���	_*�\r'���B��EUF��H@";break;case"de":$h="S4����@s4��S��%��pQ �\n6L�Sp��o��'C)�@f2�\r�s)�0a����i��i6�M�dd�b�\$RCI���[0��cI�� ��S:�y7�a��t\$�t��C��f4����(�e���*,t\n%�M�b���e6[�@���r��d��Qfa�&7���n9�ԇCіg/���* )aRA`��m+G;�=DY��:�֎Q���K\n�c\n|j�']�C�������\\�<,�:�\r٨U;Iz�d���g#��7%�_,�a�a#�\\��\n�p�7\r�:�Cx�\$k���6#zZ@�x�:����x�;�C\"f!1J*��n���.2:����8�QZ����,�\$	��0��0�s�ΎH�̀�K�Z��C\nT��m{����S��C�'��9\r`P�2��lº����-��AI��8 ф����\$�f&GX���S�#Fr�D��	�x΀�Tx��h;��1�\0�(I89�c���C�H��e\\��CP�/t�H� i^�.���1��حJ*�\$�lc\n�#�����-�ҐF�2:Ψ�\">��jj4��P�l0���3�P�7\rէ6�#\\4!-3X�\rƝ��e�|��7\$瀥�V��S�I�@t&��Ц)�K\0�cVD5��ݎ��5)��e��H:���e����`�޳P؍���t;+S�3\r�X�7��.7���pAHh0��(cH�Bh\n������@�Rx��#`\\�H���h�Hϥ鴲��v�k\n�7�;�N{��э&�4mcvڙ�b��#��}9�;#�(�J�6H0�\r��3\$�I���7w�1�I�z���]�%n����9��R���\0�2\r�\n֌t������a�D��A�Ȑ\$~@x�!�>�ZC8�25��'�@���:�\\��%�F��MO0r�iN) @��,~'�p��A_��9��^ü�i旴��8/#`�>����{�`�\$���[�Q�8Dq�R�]*r50���F�jVBg9��S�� '+���S���\$�D�\0�hS%�\0�D�R�ֳD+d�<n�9\$Er��\"#�MD0�c�A�c�a�����`tr�*���h�(#(��r:F(��H@Jq:X�nG��b�O�D�2x�,�:rUy��PTAL)�y<&��	{�/ (��]!o%�\r\r)'�Щ�0(2�\$\0���9%�)����BHn�O��?�bNI�mu���e���;z��XdK�r^�Ѭ�&����^\"؅�0�G<86s�my�WM\\�#�.�FG�O4E���r0V�S_�D��E�(LO\naP�vdt\"IF\r�)��r��t��#�r�Rӣ�gaȣ�2wỤ4��#��Y Ia�:�x�`�\0k)�f�\rJ��\n!2��bM\0F\n�@БrTF�!� o��KCa��;��\r���Iѩ�l@����&T��;׺�W�)�&]T�aaRKty��{�\n�\r&�7&�j����\r��%�wh\rɰ0�bU��'Q	\$���:�6�T��X~��!&k��XK\r\\�*9+m��-�2f��z�\$t�\\�t�Hw�2|�Ռ�IA*`D�Ɍ1@�H\n/Ǚn� jH�O=g\\�Z����B#�Z��jﬔE\r9�ZL��T����)Zܫ-�H�&bZCi�%����5W���`؀��f��I,쭗&�K7W\0x��x�B�f�Ȁ�v��鷰X��&���\0";break;case"el":$h="�J����=�Z� �&r͜�g�Y�{=;	E�30��\ng%!��F��3�,�̙i��`��d�L��I�s��9e'�A��='���\nH|�x�V�e�H56�@TБ:�hΧ�g;B�=\\EPTD\r�d�.g2�MF2A�V2i�q+��Nd*S:�d�[h�ڲ�G%����..YJ�#!��j6�2�>h\n�QQ34d�%Y_���\\Rk�_��U�[\n��OW�x�:�X� +�\\�g��+�[J��y��\"���Eb�w1uXK;r���h���s3�D6%������`�Y�J�F((zlܦ&s�/�����2��/%�A�[�7���[��JX�	�đ�Kں��m늕!iBdABpT20�:�%�#���q\\�5)��*@I����\$Ф���6�>�r��ϼ�gfy�/.J��?�*��X�7��p@2�C��9)B �:#�9��\0�7���A5����8�\n8Oc��9��)A\"�\\=.��Q��Z䧾P侪�ڝ*���\0���\\N��J�(�*k[°�b��(l���1Q#\nM)ƥ��l��h�ʪ�Ft�.KM@�\$��@Jyn��Ѽ�/J��`���3N�����B���z�,/���H�<���Nsx�~_�����2�Ø�7�)6�T��`�8&tR�8ث񋦫�g6vv+h�N��X���Gd�,s{3�⾜S��M�������4L���}*g�.�J2�:^���)��5\rj�\\�A j�����p)l��\\\$�'j� F�k�������\$\rm�x��9%NS\$�p|�h�0�#dcU\$�̧�&v_x'����+�����-jC/�\r�NYt|+�j:gM��Vg�p�-;0��Rg/ҩRg!ѝ��~2DJ\$�n���^-�i�.�J���\"\\��ϯ8��C`�9\$����=\n�]O�-g��e�;�dK|J����� ���3���\n�;Cn��W:ŉ�)7�h�+�(n\n��*��� U #�B\$X=��iYʳ{�h��Xu�z�tpL�;`[�z%�%*��ё2�X���L7����f��\$&AХ��S��y����+*YV\$H��t��II-aL)`\\��!K��h�M\n�\$�\\��U�-\\�² ��-ȸ�@�SJ��:����\0A��4���	Ca��8\0xA\0hA�3�D`�>O�:I��xa�K�	OIy�.eF\"�J��%jb_D�:�4,�DC3�I1de+)��\\�Oc+�\n7�yS*�h\"\r�:\0��x/��7'S�.Na����cb\0�W�0|�RR+T'Թ,��.%�C�9W��RD�����l��d����*\$W�Y;4q���c�!R�g���&��*�὜:pAe��+�0G;�#��arՈ\0��]HbO��8I0�C+L!���%��a�:����<����:�A[S���\0�1ʹH��a\r��3k�1��O�ɟ�jH!+)�*��HQ��DN��lݩ�K��wXUid�H\n\0� R��Hj��t���w�9�(!�	=R�o\r��8 ��he�f�(���oP�곇z�oʢY�tP��bD�\\U2\$�%S\n)L��\"�ݵ*r�\\X�E�g0��Hh����R��kQB��=n��)3nˤ�E�����c_)%�H���\$Y4O�@&\"h@��cI��3�O)�����u�Q�˶}�0'���b���2v���^O\naR7�RNu1*�����u7|sG�`b�<d�b���o��F�ܐ3c�{��庰����fU�7T�ɺ3eKx \naD&^b�\"A\0F\n��e!�c���y�\$8�>�0���f���w/�EJ�#@W�Ѭ*Y[��H=\$��K�s+l��RӦ�F�͚a,xdvHY�(���ABۘ!U�Cm�i�y��6�EO[�=s��%jZ�ViC�9	�.V��7�Xc\r��1��T��ڬ,�,��;����\"��\n���y�V10X�+�2T�9�h�����}�b\n%�P��h8)@��Xc���h�hm�5.J��H[��\nw����d���+D��>���\$�\0�E!\\�|\n(3AL���gL\$�˕L��,�\$\0�S:^Qq�\"���=ݐ[s��-PY���:9�\$ەn}���o@��tX��aE4x-�lգh�I��:)�c[���7\"�/A&��,������]:H�&�^�EH<Ā�P��ނEc��[|1}���c�s�9bxĉ�8\"� 1����r�t��G�F�~,��]��w<EH���Y�m�2���o��5����e1\n";break;case"es":$h="�_�NgF�@s2�Χ#x�%��pQ8� 2��y��b6D�lp�t0�����h4����QY(6�Xk��\nx�E̒)t�e�	Nd)�\n�r��b�蹖�2�\0���d3\rF�q��n4��U@Q��i3�L&ȭV�t2�����4&�̆�1��)L�(N\"-��DˌM�Q��v�U#v�Bg����S���x��#W�Ўu��@���R <�f�q�Ӹ�pr�q�߼�n�3t\"O��B�7��(������%�vI��� ���U7�{є�9M��	���9�J�: �bM��;��\"h(-�\0�ϭ�`@:���0�\n@6/̂��.#R�)�ʊ�8�4�	��0�p�*\r(�4���C��\$�\\.9�**a�Ck쎁B0ʗÎз P��H���P�:F[*������\nPA�3:E5B3R���#0&F	@暹ks�\"%20��L�w*��z�7:\r�Tḣ�Xʢp�2���+09�(�C����D��C�P���^uxbPnk4�e��9�*��j�Oh��#�\\W@S�1*r�B ��Ȏ+� ��P�mOb(�ұ(�i������%?s�-25u\r1�:�2�\$	@t&��Ц)�C ���h^-�8h�.�B�`�<��HDcK�\r�2ͥ�d�3� ܬ�ϳJ�7b�I%HB=\\т�ޞ�#s�oȖR29�êX6QKH�L�3�+��4��0�:�@������b��#:��\n�]�\0�K���9\\w�U�Gmz;��`̷\r���9�u	.X�iR�T���*3ϊ5��P��[���R�������D�A�x׼!�^0�ɠ��ً�2���H0�d�c��@�@�n��Lo�j��%PH�����4��pAγ�D4���9�Ax^;��ti�?+p��?`�:D�p_юa𒒤2S��u�J4���SS�(��H�A�',�⟠���%��#L��Di�?2�CADg�\0�i�d#g��\$�>C3�@�����K�'�&�_�p���^����<pS�yo�0'���DQ*���\r��\0PR�IH ���28Z	(V���8\r!�!'(����F���\r���@�r���H�\\<��.�\0�A���r�pϺO%4<H�k���g'�5~I\"�\"0䕹�����@�;�\"C��6��&Y��H��cL`qR�\r	���#臎ɸ(PI�A�<)�D:�9#���rP�p KN�=t�N	�<Md�X��D��ԒD�P�#�aHR�Yl��C4g9z5��@\\\0S\n!1�&��0T�3|��BO&)� ��E4�Ha+<�mv\0�>e��0�{Q�Hzjh�ؔRU��N��J���V����p�{���`+�-&D�Ajh�4���JZ!4����	\n�xU\n���0��-D�R�JaEb��պ�G�-MW�u)ԏF�6HVS�7���%S`�0y`�fF+i�I��aYh�=��TaL9�\n��HĄ^Q�C�)[�����e.a��(�}�ʉ��Y��P��j<A@������A�	��Æ���S��NW:_]YM�/�Z4D6n�(x��������,��qK̽XT�:U��qp�rT��";break;case"et":$h="K0���a�� 5�M�C)�~\n��fa�F0�M��\ry9�&!��\n2�IIن��cf�p(�a5��3#t����ΧS��%9�����p���N�S\$�X\nFC1��l7AGH��\n7��&xT��\n*LP�|� ���j��\n)�NfS����9��f\\U}:���Rɼ� 4Nғq�Uj;F��| ��:�/�II�����R��7���a�ýa�����t��p���Aߚ�'#<�{�Л��]���a��	��U7�sp��r9Zf�C�)2��ӤWR��O����c�ҽ�	����jx����2�n�v)\nZ�ގ�~2�,X��#j*D(�2<�p��,��<1E`P�:��Ԡ���88#(��!jD0�`P���#�+%��	��JAH#��x���R�\"0K� KK�7L�J���SC�<5�rt7�ɨ�F���4�r7�rL��/�	�z؊�L%8-㬃��jFL�@�9\rC* ��ʐԈ�賏, ΁A l��h�Bx�L��2�Ic\0��kP(\r4��4���2@P��nP�#!���2�HM����4zڤ��I`*��@:�P��7#��X\$	К&�B��*�h\\-�8�.��x���j6L S*�ɩH�3��z�=�ܝF��qH67ˀ��\r�`�Aj�1����:����acL9d�Ό��U��O0�aKh7ƙ*�b��#f���C|T�4�\0촍�@�ݍ)�����ff�%)xܞ��4N̽(�5(�P�8JP9f��!��xߍ��3�����U�A�^0���4�ol�I<�j0S۳-�ʇ�RHʚ��+ޕ@���<�1�q�:����x���&�9�H���\nN�p_�a�6�,�7��)9K�pރ��*p��ISߒ��-;�_��\$���ï����Haj�͇r4�K��M�9%�C1�N,���^�]#>�Ƹ�+�*R� n�>\0�L��5�@����FP�d;���BJ�:4dpӬ�AH\n�	�W\\aR�Hh�(!��{\0۱�3���#HA���80wv�I���Z�1�\":�pN�)<%��.w8� ��;���iB(�ŝ&�R�I&XR���q��1�k�����)�1��p�B�P�T��`�J���Y\$���'�#�Tc����W8B�Q%���H9z�Sxp\r��5���f1�=���M�4n�L(��@�Z���#H��\"��X�l�ɔ�Ea��Gʹ�6�:-[Y�m�(*��{=�Sl*r%��B����-���I�/\rG���B��j�lG��9\\q�J)i��6��L�჌4��� K>\n�P#�p���%;D��J���j/Ȝ��8d����z�Ϣ,_8i�������4j���B�����8���R\$E+�9,X�����I�>��F�F�*�\rq��bu¡�Bd�t�7���b�×H�B[fOH����OP9gWD�(�!0*Y#'G(��2��Xu/�x���B@";break;case"fa":$h="�B����6P텛aT�F6��(J.��0Se�SěaQ\n��\$6�Ma+X�!(A������t�^.�2�[\"S��-�\\�J���)Cfh��!(i�2o	D6��\n�sRXĨ\0Sm`ۘ��k6�Ѷ�m��kv�ᶹ6�	�C!Z�Q�dJɊ�X��+<NCiW�Q�Mb\"����*�5o#�d�v\\��%�ZA���#��g+���>m�c���[��P�vr��s��\r�ZU��s��/��H�r���%�)�NƓq�GXU�+)6\r��*��<�7\rcp�;��\0�9Cx���0�C�2� �2�a:#c��8AP��	c�2+d\"�����%e�_!�y�!m��*�Tڤ%Br� ��9�j�����S&�%hiT�-%���,:ɤ%�@�5�Qb�<̳^�&	�\\�z���\" �7�2��J�&Y�� �9�d(��T7P43CP�(�:�p�4���R��HR@�7L�x��h�n����˾��;�����̜�YI��G'��2B�%v�T�	^�\"�#�O@HKc>�C�դ;�@PH�� gl��c���X�iN��+L!L�t\n;����	r됉�BUKQ�#������~X��qR���M3������̛\0l�ɲÁ�W;\\��%��+�,�������Vc<�d�F@�J��;�Ѱ\$	К&�B��cΌ<��h�6�� �~��\\�x�9�c`�\$�����<�%I\n������m�ֱV�~\"���#@��K��FW�DF(Vc�A&�P�I+�[4�7N{@\\֋.:��x��AoL���o�\rr�p�=�ĴI+�Ʒ�z��B�)�\0�7�t��<�Z�(��wF�쵽^��)�q�Y�f��\"%RK�8�bK����0���C���# ��@�`@1Ҵ�����\r��3��е`g��0�ⶍҳF�y��nW�p\r���w��^1�U	@؝��`XAo� �A�ʙ��\$)I�+r�oT\";~/���w��t��^�\0./�� ��z��*=H�5*��s�a}#�J�\n��pSV\"�0�k�\0εBB�фX.NI��RD[)F�C�:�6��X2�h�6{HP0�8\0�A\0w\r!�6\0ą�{��6�U�C2�Ht1�40�0u���7�s�\"CHt\r�4!E%_[�}�\0ؒ#j|8lAݐz�W.!	��,��	�T�ia�\0��n'qĝ8VJAC/8���(��4�x�ň\0��Cpe����@�i=j3�iވP�CA�KiH��K��⸴���c�0���3���`)�-�V�L��8n�s3h��*^eo\n\n\"�cL\$�7f�;\0�F��o�T4�d6FԊƕS����fA!��DI�&�S�r�	����2K3E�P�[!�D��B�@X�U%	���X�R1d�����I)<au1QĔ��I؄s+��OVr�\r�nlsX�{ZRQ^'L(�ʾM�\r(����8��Ѓ����*xl�k�0��%ȼ���W�D�:� ^��J�֪�&�Xq�FԠCV��	�l����JA�!�vŖ,��m.9�%1��Ş��L;nyT�[E�mn&�: �\n�Xia�SG(�W!x?l���`�0-�;�O\r9\$��b�9;�i�-����5W~I�z=j\$�!,#N/q�X���R�DT�t3�ԁ�6:�0�}?�|��R��)oj��ݪV�m-u+�x���e�TyUHNJ�2�s��P�'A��M&,l�h+N|bm�<��L�����PX�د��?z�V�\"D���JM���Lei�>�9��aU]3�1�̛��Ȱ�Sxr�9�XE�";break;case"fi":$h="O6N��x��a9L#�P�\\33`����d7�Ά���i��&H��\$:GNa��l4�e�p(�u:��&蔲`t:DH�b4o�A����B��b��v?K������d3\rF�q��t<�\rL5 *Xk:��+d��nd����j0�I�ZA��a\r';e�� �K�jI�Nw}�G��\r,�k2�h����@Ʃ(vå��a��p1I��݈*mM�qza��M�C^�m��v���;��c�㞄凃�����P�F����K�u�ҩ��n7��3���5\"p&#T@���@����8>�*V9�c��2&�AH�5�Pޔ�a������X��j����i�82�Pcf&�n(�@�;����x�#�N	êd���P�ҽ0|0��@���)Ӹ�\nъ�(ޙ��\"1o�:�)c�<یS�CP�<��F�i��:�S���##N�\r1�'GI�)����ۼ�H��� �		cd���<��]H(.���\n��F���ʆ��x�:�!-Z���@�<��r>��\\u�cJ5[���c�&C�<�U�P�p�&Ct|2Ub�XӺ��[#T��\r��ɁB�r�#M�2�LMȁ1�*%r\rfmp(�4�5�e�8��]X�� �|�j��\\8<��P��R�@t&��Ц)�C��8�p�;e��[I���1d� �3Ƀ���4\\��	b]�Q�{aI�3v�4X@6��J<8-�`�䎣sE�Dn���S킂�Si�Ѝ-�`@����ql<Zue���2�/�e��Zjy�\rڐ˪����4h���3E!1c��M={V�4�ԍ��CUk��n����yer�k�x!�b������ǅ^�T��4O4�^rj*�c�=�l}TS��C�Ҩ�\\D�eL���\0�2s��1Ή����9�0z)�|�6� �3��x�&�O����8ܹ\\Y4NY����ɛ�0G�8� Z�L7�]�sRHI�������_Xh(�9��^ü)ĝ�s��yw�)�9���`s�Q�R�_�m�p7��\$]�e4\r�%*u2�ñlDO<?�BF�\n�E%aZC�)ɔ\"���Q\n` �`6\0�ArOT��x��ja�\0�0�_A{�f5�@�P�\$&@�1����ZhlN�>@�t>n�1�	���4�PQ  \n (!�,�\"��\0���4V#��Pk�Rd[	�Cj��3���AC��s�3�d��1h\r�S�|H�5\nΝx�͞:�r���D\"]�'�Bk7��LCius�/�CT�\r;v�,��v�B�M��%��X�G]���C�yp+��=��N�je���IA��N˹�Q2rH�O\naP�	�['s�\n���`GP�k���2�)�GS!\r��4�rrH��D*e���E@	=4�Ϡ�0��E*��#@��bjF���R:ug�S\r��^JJ��O��B�N�I�n���\\�j�������8o\r	���P�R�@\$%�+	(ꨮK��yr�C`+6���>�[0�\0�DMT��7�%`̅P����C0�\r��A0��]�	X�لk��*&��bA>M9B ���3Db	aw�Ģ`���E8fè\$(j���0�p��#]hMa������kMӱ�\$�./���bjI)Qdه�3MY�U�)E��i�om�u1̶�P���eݚs�@�C	\$\$p��آChl@PR�E��5\$xȃIl";break;case"fr":$h="�E�1i��u9�fS���i7\n��\0�%���(�m8�g3I��e��I�cI��i��D��i6L��İ�22@�sY�2:JeS�\ntL�M&Ӄ��� �Ps��Le�C��f4����(�i���Ɠ<B�\n �LgSt�g�M�CL�7�j��?�7Y3���:N��xI�Na;OB��'��,f��&Bu��L�K������^�\rf�Έ����9�g!uz�c7�����'���z\\ή�����k��n��M<����3�0����3��P�퍏�*��X�7������P�0��rP2\r�T����B���p�;��#D2��NՎ�\$���;	�C(��2#K�������+���\0P�4&\\£���8)Qj��C�'\r�h�ʣ���D�2�B�4ˀP����윲ɬI�%*,��%����*hL�=���I����dK�+@Qp�*�\0S��1\nG20#���1��)>�>�U��!�\n�L���ԍ�&62o�苌��Ɓ�HK^���v���H� j�����C*l�Z�L�C���a� P�9+��X�S��H\nu�����+�!�w �6BS �:�M�(\r&P��.�h0���at��#:P�Ό���2au�^���%A;U�R:b�(݌#�t�����\$	К&�B��\rCP^6��x�0���?*b`�%.������ѡ�UE�)s^�0�Ц�54��ɻ�mu�cx�!ZV��I��ab��am[~Au��:�##=c���l�=3���.ٰ\ryR��H'�������������\n�xד�)�:��.��EMS5�aZ:��\r��ʧLf�M\0CqIJ3O�B 3����[�)*�x�����J�DC�����x�k\\�I!F��k��V�j3u=�U���q���(5�l�l�Lة:�]0���\r�p`�����pay�@�����4 F�C��^�C�>#��\\\n�tj�+�&\$�6�G�S�a&�eL�#*��U���\"tRP]��;f�����C�bk�U�tTBO 9�{�]3���0�g��o/�f+)�|���a7D(ʔ�@Q�Q҄h�U�Ƭ��0H̩��	HHP	@�T<K�#�! ��CLW�`s\$!�����ڗQ�'���.B�Iؒ�[�\$���J\n��A?u@�W�mq�զ?����(��:���{�O9���3%�����P���=]��?CJi�I��l\\7��,qR��2�@��HK�z1�v�L�k��	��P�қ� \n<)�B|X�8gM����@��Hd��6�\$+I^4��Y��(�=uiY�'��ߍy=l\$�\0P�r�dPP4F��Ge#�`o�D��\nH�Y[&L(��BWB0T���\"���V�&&w��eÓ]B!0�ur� +\"�25.Hk��]0�]V**_��&�f���\\�!�bb�Bg��t�k�mb�����X�dU��2�[덈e\$�!� �\n��n�Ε�	H��5�4VȘ�R��MF�7��R�FS�,��C8��\0U\n�����P(g0���W\n�Ce트)1>[�X	mȒD��\"H�T��\$�Q�#\n- LUrTK�[aR͛>�I{��\"�5�@�J��\n��T\$0Z#sa�1\n7i~�!�C�=a�������FI\$2���?o)��ʦ�8g�~;l2�5��r�1]��w�L A@s)��(��L}�%�F�-���yJ0��qH��@PV(��֕��~�h";break;case"gl":$h="E9�j��g:����P�\\33AAD�y�@�T���l2�\r&����a9\r�1��h2�aB�Q<A'6�XkY�x��̒l�c\n�NF�I��d��1\0��B�M��	���h,�@\nFC1��l7AF#��\n7��4u�&e7B\rƃ�b7�f�S%6P\n\$��ף���]E�FS���'�M\"�c�r5z;d�jQ�0�·[���(��p�% �\n#���	ˇ)�A`�Y��'7T8N6�Bi�R��hGcK��z&�Q\n�rǓ;��T�*��u�Z�\n9M�=Ӓ�4��肎��K��9���Ț\n�X0�А�䎬\n�k�ҲCI�Y�J�欥�r��*�4����0�m��4�pꆖ��{Z���\\.�\r/ ��\r�R8?i:�\r�~!;	D�\nC*�(�\$����V��\$`0��\n��%,АD�d�D�+�OSt9�Lb���Ot��h��J�`B��+dǊ\nRsF�jP@1��sA#\r�I#p��� @1-(R��K8#�R�7A j���p����Ǣ��\r��4�ʉ���#�D�P�2�t����*r�I�( ��� ���3Qς(�Ա�`�m��\r�4ƃx]U��x��C�بO�)B@�	�ht)�`P�2�h��c,0����GY�p��\0S>ʴi�MLQ�GZZc�R�2��^� ��Wn�(����Щ�9D_���E�*B����S)�p�Q�\"%��`4A���Uh��E������f���b��5���)�0쁍��\\][�Z���:U?�j��/#k=+^�Ve(�����P��*F�\n�#��в:��&��h�B:��!�\n43c0z*�|�/�s�}F��0:��9��,'\n�-�*��<Q�P��ӻ|x��'�7���](v=��:����x���ѧN��#8^�~��;\r�h��I\$���;�|J�>*�æ�z��H%\$��&|YV�r��P�ӌ�'%&1���0x��k�\0�j����������)�xJU�c<g;����o\n�zIR�l��%��%Dy:�R&z�Ʉ*h**?�*�B�H\n7�tiAV&��4`F��\$Ȋ�Gtɹ+��xl���@O6\$�L0=}��P��aa�K�c���dk;\r�P��\0b���)��\$��I�Al���#�\$SQ�'D��d(��uT&�E�ً�^�~���S�{+hD���Lv�>�A�GE�BaC��/�1��\0�£@g+�Æs�3%�Y{���Ŷ%%̻rQ������	%� �L�I/\\po(ph:�RR�QIF+��)���g1�&ᄜ��Vߌ(F\n�����L]ZT́M��\0��Z��9-�.\"hhi(��f���Ϝi�2i����7.�yV&����8n�������q!���D�Qi�6���CdFnOt�J`z.9���J�q��k��0cJ*���X*�@�A�\rTĴ6RG�J�f�.W��hQ�*\$e�\"BA��[����p%�>��Y�����6'a>%�eOt�o!�0���U-4�\"Ն��K  ����+XJI�F�%�;|x��P�F���hL韮Jb�UG^�M}_e1�#�A[	�<Fc+\0�2�j���ZӍ�O�P��p�a�3\r��Ň ";break;case"he":$h="�J5�\rt��U@ ��a��k���(�ff�P��������<=�R��\rt�]S�F�Rd�~�k�T-t�^q ��`�z�\0�2nI&�A�-yZV\r%��S��`(`1ƃQ��p9��'����K�&cu4���Q��� ��K*�u\r��u�I�Ќ4� MH㖩|���Bjs���=5��.��-���uF�}��D 3�~G=��`1:�F�9�k�)\\���N5�������%�(�n5���sp��r9�B�Q�t0��'3(��o2����d�p8x��Y����\"O��{J�!\ryR���i&���J ��\nҔ�'*����*���-� ӯH�v�&j�\n�A\n7t��.|��Ģ6�'�\\h�-,J�k�(;���)��4�oH���a��\r�t��Jr��<�(�9�#|�2�[W!�˃�� �[��D�Zv�GP�B�1r���k��z{	1����48�\$��M\n6�A b���0�nk�T�l9-��ð)����Ja�nk����D����6��\$�6���,��3T+S%�.�Q�� ����Z U�F��1	*�����\$	К&�B��c��<��h�6�� �P�IT�8���:\r�{&�H�\"�\\�OPJV����z�5��z��IZw��l�[|�p:V��\$�X�0x���tF�ɭK!�	����s�iai5�N�lM��\$΁B�%�\"��s�D�2T\n@�������4�!ah�2\r�H������x0�@�2���D��A�`��d�x�!��ͭ:p� (\rZ�g��;O�����.3_i6h:v�7�4��l�N׶�C@�:�t��Lkz��C8_/u��0LA~�9�ZJJ�P��G��9Nd�as��䖓O�~' [P��pi��0P:���0�4=��:L.��4��`@1=���3<Ch�G#4�9>����c0���`o�x>p�=�5�\0���\"^|��64]3����� \n (\0PR�I�T�!�&����g�!�\0�C������S�|�a�\r��\n@����I������əC�l�5����0r���G k�R<�0� RV�2 d���d�PLg[,�Fg�B\\k̀�/�lOIkeO��(���H,*N���\"L֢ב�����\"�B�O\naR1��JC�Dky&`��\$�L��nr�4X�@lm0jk��:��bX%�6�Z��%\$�KE�m��	M��İ���0d��ר�f�*0Lk��/)ƹ�10���B��c�Q�p��Ɂ�%/�9>�V��i=P+H���m�Y�/���dS�2xŬ��YJM\0u�������Q�c0�/B����(�٘�J\r@S��2G@��̍b���!7��Z�+�(�\$����� %��iJ\"9@��#�!�����L#�FD8�T�ję�VD�nծ�H���%�tӔ�ՊI�����8Ô�qN�jm\$�2�IB״�Y�2C�.,H�";break;case"hu":$h="B4�����e7���P�\\33\r�5	��d8NF0Q8�m�C|��e6kiL � 0��CT�\\\n Č'�LMBl4�fj�MRr2�X)\no9��D����:OF�\\�@\nFC1��l7AL5� �\n�L��Lt�n1�eJ��7)��F�)�\n!aOL5���x��L�sT��V�\r�*DAq2Q�Ǚ�d�u'c-L� 8�'cI�'���Χ!��!4Pd&�nM�J�6�A����p�<W>do6N����\n���\"a�}�c1�=]��\n*J�Un\\t�(;�1�(6B��5��x�73��7�I���8��Z�7*�9�c����;��\"n����̘�R���XҬ�L�玊zd�\r�謫j���mc�#%\rTJ��e�^��������D�<cH�α�(�-�C�\$�M�#��*��;�\"��6�`A3�t�֩���9�²7cH�@&�b������Fr�6H���\$`P��0�K�*モ�k��C�@9\"���M\rI\n���(ȃ&��YV�%m\\U����(�pHX��%�#�?^�#���G�`Ę�r�ž�\\�#��b�-cmq	m��� N�@��jQ��M>6��<�B�����Ge��e���-�yG)@ׂ��`][�xU�ڳ�f^`ؖ(��x��b@Pڂ\\RL��t6�b��\"�\\6��#�0�N�ؒ�IK�5�Z7��2��0SX�]/�<���{_x�a\0�@��c0���:�9���<�=�.�]f6�㪲aJna�#�쫴u�b��#&��3	Qf^!Y���b0��#�0�Q�~�Y�]�:)���@j�'��\0�Ю���1�t\n�=���Ф��D�A�I;�px�!󏭍c\$�)M��/��K*�9�%L������8��`�C�\0劏�ҤDAr�����:����x���׶�B�j༄@D�B\n���9���C��y��㼔�d��7\$��^l�X9(�6�ǜB\nHe@��7����r+!��s�V�c�%\r����q���&��0@ͪ9{�d9dd��aύ5��؛ ol�\"\$��kN�����C`s&�8���D���2]��6>���WZFp��Nۈ�@\$ތ#��1�2>M��!Q֐3`l������\r3�\np��0\r��;�&��[��p&Y/c|��9^\$�\"V��JA��)V_hNH\$���3>`� tH����\"M8 �h�!r����)�:�R��Y u���E����8	�GLc�\rd�A��	�����,�l�!�qESJ�Q�A�z��;����)ȃ��fN�h��0��v�״�A�3�\0�Ba26����\$5Vd�N��?8	( ����#jJp�U����~�gAY�e����zɍ���\\T��]���buUW�\n�s�J5c�X�Պ�\$��s�4�9���\r\r�v\r�y��b/&���\$�R��q\n�P#�p�]��\r���+2,��?�M���=,�?����Y{d��#䄑Ӕ\\����;p�z����\r5��W@B\\\nJpP�0Ҧ���:��v)6\r=.\n��d���跌Y��	G��<Ș�\$�,���B��҅\r􅓔���\0PL�v(���z���Y�Ta�`�t�)�4Gj���w����\0��-��*����@�P�\n���1�U��O1�ˀ5�p�|�};�<�3��Z���J*���";break;case"id":$h="A7\"Ʉ�i7�BQp�� 9�����A8N�i��g:���@��e9�'1p(�e9�NRiD��0���I�*70#d�@%9����L�@t�A�P)l�`1ƃQ��p9��3||+6bU�t0�͒Ҝ��f)�Nf������S+Դ�o:�\r��@n7�#I��l2������:c����>㘺M��p*���4Sq�����7hA�]��l�7���c'������'�D�\$��H�4�U7�z��o9KH����d7����x���Ng3��Ȗ�C��\$s��**J���H�5�mܽ��b\\��Ϫ��ˠ��,�R<Ҏ����\0Ε\"I�O�A\0�A�r�BS���8�7����\"/M;�@@�HЬ���(�	/k,,��ˀ�� �:=\0P�Er�	�X�5�SK�D��ڜ����!\$ɐꅌ�4��)��A b����Bq/#���5���ۯκ���h12�H�����6O[)�� �T	�V4�Mh�Z5S�!R���ůcbv���jZ�\"@t&��Ц)�B��i�\"�Z6��h�2TJJ�9�d>0�Jd�\r�0̴��*�1�ؗS���\$7�3�t\$/��1���W�`�3��X��Cʄ��\"ϣjی�@�����5��\0�)�B2��\"	 \\V�-���\0��\r�}h��.de���L[�i��ބɋ]��1�ȢP��S��D�A��.�8x�!��\n1c���0=#7����\nf�?���<���ꚶ��\r��8a�^��h\\��@\\��z=�Jh��7���	-[0܎��'H#@�>��A�?)E��T֐�n`4�S�o\r#6:41�ƨ,��/a\$�Q�����,�w�\0��v\r�(#����lrb��L2v�L����*�.}��x(	�p�K�s�N�AH,��EYWk�i�əS.f[��?�ҟ2�0wo� �6�J�1\r�V�c0ږ�u\r�()r��Ё��O혥�zO��+@(\r��P�-	\$<<��v�`�s#ΰ�uLC�0#a��֒��CS|%1�h�S�i�nK�T��@xS\n�<�V|M	��e��;��P���N\$�8��Lʁ,A�3�@���H0�1�<��BO��)��̠x 2�#G�NS��?��ER ��vO!�,\$�bΣ�N�Q_J�w��i%�Y���+	[;K��Z�\\������/�j\r��.���E�I�&(��8��K�#I�j�I�(!T*`Z&KPK�~c��e	��X\$�Q4\0�ܑ�b�x�\$�80yF�R��<�G�;�����RE]�TxPK�k#��:�2J��aw�\"]\0���m=��R�a<���(��7bi�S^�=ެu=�ѮT���?��~}�����CUTi�6E��S�\n��m:����`@�s";break;case"it":$h="S4�Χ#x�%���(�a9@L&�)��o����l2�\r��p�\"u9��1qp(�a��b�㙦I!6�NsY�f7��Xj�\0��B��c���H 2�NgC,�Z0��cA��n8���S|\\o���&��N�&(܂ZM7�\r1��I�b2�M��s:�\$Ɠ9�ZY7�D�	�C#\"'j	�� ���!���4Nz��S����fʠ 1�����c0���x-T�E%�� �����\n\"�&V��3��Nw⩸�#;�pPC�����Τ&C~~Ft�h����ts;������#Cb�����l7\r*(椩j\n��4�Q�P%����\r(*\r#��#�Cv���`N:����:����M�пN�\\)�P�2��.��SZ���Ш-��\"��(�<@��I��TT\"�H����0Р��#��1B*ݯ��\r	�zԒ�r7L�М���62�k0J2�3�A� P�D�`PH�� gH�(s����8��П1:��ڕ�Bԛ���N�:jr����3�â� �C+ݯ�s8�P�-\\0���_�Au@XUz9c�-2�(�v7�B@�	�ht)�`P�2�h��c��<��P��7���=@\r3\n69@S �\"	�3Δ�\n�L��\"���ތNcˎ�c3���78Ac@9a����-\rQ��0P9�)h�7�h�@!�b���\$�����qh&b`��mL�;,\$b2�����-�K�bV�T�;�X�#�p@ ��#�iɪ49�`4Z@z(�|�-���3��x�`��ֆ/�\$P0�C̋\"C�j��S�޻�J���'s\r�<C�K����H͵���9�Ax^;�u��<�@���d���Cp_�a�6�	����PA\r�A�9m���C�%�bB��I\$>2�,��\$+�>��Z��1�jx��2�j�)@#7��8�*b�xA�CQ�i��:�\r�Q�%�Ipm'\r�bv��A��\0����9#N\n\n0)&!�����PIhC\$���5�Bf�I�\$y@A��j�QN>�7�p�~�t\0\rɨ����̓IeD\r����K9\n��R��Qbg_�(����dI��=�0���[J�@�t�ֶ�K\\T,�1�s�j!��3�,7��H���	�L*3��HiX�����b�>&-�[C�!�0����ٸyF�܆��	�'��)��P\nl��R��\0L��Ǎ��2&KN�|L���2CL�΃��r�Z`��fD�O��\"�#�K�0lV��\"Y�(�8�R�Y�_�%9��J,�N��e���PlqԀ���q�6���^�+��86�����\0U\n����nK�s%���	p}Bʣ�1�gqH\n�\$z�\"�]0�&,�����z��qXʝ@R8gʬ��jtD�-bŮTj_h#����-Ƣ�F(iy��@Piii�mZ�8%��_��2/����:�򀣫,ņt2�I���9���\r�]'���!�zd]I\r/�l��R�!��5<�4�l�";break;case"ja":$h="�W'�\nc���/�ɘ2-޼O���ᙘ@�S��N4UƂP�ԑ�\\}%QGq�B\r[^G0e<	�&��0S�8�r�&����#A�PKY}t ��Q�\$��I�+ܪ�Õ8��B0��<���h5\r��S�R�9P�:�aKI �T\n\n>��Ygn4\n�T:Shi�1zR��xL&���g`�ɼ� 4N�Q�� 8�'cI��g2��My��d0�5�CA�tt0����S�~���9�����s��=��O�\\�������F�q��E:S*Lҡ\0�U'�����(TB��5�ø����7�N`��#���{r֍�@9�Ä\r��;��#���14���ZW�YBr����T�Dz���Q��1�2<@����#ʲ��\$a�K�\$	V��ē)�,C�d��D�L��E�`�G9|T���������)�L��� ��T�&�VA��_4+S�6A�T�\$4B8UN3���9-��A�@�N���@9S�(��\rØ�7ձ=��(�G���3M��H��#ZQK�D��yX*�zX��ME2�9gZyi%\ns�et_��1H\"C A?*���܁Mp!pH�A�zR�9hQ9��vs�}�i����B/\$Y+tGI\\�S�JYEZ�[��)]���t���s���]�䚣)�@.qCv��+�)D�w������h��G���_)�S�{>S#ж<�Ⱥ\r�h\\2��w�����:M#L#�X7��0���:�e]��?n�\$χ��{^6�#p��h�1�m��3�`@6\r�;�9����ǌ#8��@Kw\r�`���R���s�Ub��#V�b8Y���C�>|�39!�2)#���#�=n*50t3T#�\\���֍�OB1�p�����n�0z*!}\n�c����/ ���TGŹ(o@�8'ϐ�Lj�AS���H��]rG���z�(&�#��sDh���[�&~/�4?W��t��^�\0./�� ��xe\r�%Uĥ\\�{�`�\$���m�lJ����qz�7����XQ	q��7H�	p,��y���ip�\"\$dP��!��+\0@ͫ�F�8 �����!���&�aS�sNq� yq\r�h5��0Ő@�Z\r!�63��Q�5F���g�d,��(���ђ4F��t#�\"\n�&r�A@e�D)���\$��̺4a\rX>���ٯ6&�ڛpʻ��r���!�5+�w����;�t��s�Z%�W&��9Dx����U�P���d\$�s'RL:��Q-0�	����0�D A-���~I�,[�d\r+��!�&��7M�8�Sr��2\r��\">�Pq\"T�s�NP��Bn`P	�L*��LU�(\$�@�qC�K��&�~G�bOBꌋ��ށH�@��>:@�M�f�UT��!zq�Қp��\\�W\r�\r�\0�C8 \naD&\0�9A�~a*�LLVCS�6�MZ\rc+�r.a\$�)�>D���J+h�厢lZa,�-k�\"%Ep�L\$�1�32�kv�������\0���`+m�1��@�ߘv���p�H�C3��0#Y\0���ԋu(*�@�A¢}�����V�&Z\$pN��&X�(�\"\$p�6�`JŧcLq�Blbe�\$�������(�����d��R����O�̉�!d}9���bB\0+D7�U[lR���qjc�Ш��@s	�8�����BNu���ZD|�,L�D�������ڪ�u`	*֤�VdFn��7U�4y;�ɀ";break;case"ko":$h="�E��dH�ڕL@����؊Z��h�R�?	E�30�شD���c�:��!#�t+�B�u�Ӑd��<�LJ����N\$�H��iBvr�Z��2X�\\,S�\n�%�ɖ��\n�؞VA�*zc�*��D���0��cA��n8ȡ�R`�M�i��XZ:�	J���>��]��ñN������,�	�v%�qU�Y7�D�	�� 7����i6L�S���:�����h4�N���P +�[�G�bu,�ݔ#������^�hA?�IR���(�X E=i��g̫z	��[*K��XvEH*��[b;��\0�9Cx䠈�#�0�mx�7����:��8BQ\0�c�\$22K����12J�a�X/�*R�P\n� �N��H��j����I^\\#��ǭl�u���<H40	���J��:�bv���Ds�!�\"�&�ӑ�B DS*M��j��M Tn�PP�乍̐BPp�D��9Qc(��Ø�7�*	�U)q:��gY(J�!aL3�u�ӱrBo��YAq+��Qnʓ�܊@�E�P'a8^%ɝ�_X�V��K�S���I�##�X1�i�=C�x6 PH�� gv��d�dL�U	�@꒧Y@V:�!*^������A�gYSp���fĐR��V0dfj���[)����x��A��Koa؄w��\$��2\nDL;�=8�e�#��<�Ⱥ��hZ2��X+UMV6��NԄ�׍�0�6>�+�B&��^��3�M�`P�7�Ch�7!\0�L����c0�6`�3�ØX�[��3�/�A�ea\0���(P9�.{	O�gY ��b��# �6@�s΀�O>M��PE�R\$�Om��+��\"�Y��5:�O�@ �����c9M�x@-^�3����:>�8x�!��ʐ���le�=�ޤ�ā�!R.lP��R��9��V���p\r-}=w���\r�:\0��x/�l��P��2��H��*�S���0|Chp7!��G��T\\48�o�,CY�\r(��g�������t�����(/׆��� ���#^{�P�o�\0�}o��8G�l[8��4��a� p2�����Fh���@h���\n (#\$hx�\0(*���T�;ȘtD%\0%�Y�g�)X!�ǟ�)�6F���tV�\$A�ޜ�<�#�����I�T�]�!m�`��LNd�9 �̤�B�Ɍ�'�R��<Hȼ l̞�R��&��/�hS 7���\n	\$t<���V�Dd7CӐoZ�q��d\"^\\y�P��X���t�Ȝݔ�T<�M���*y�!k�m?�Jdh�T\\J����8H�;�4up��X��3�Ƭ'4Qwml�6�ޡ�o��t ��\0S\n!0i\\\r���RF�u�a�%rs��k��zZ��&�#�(�۔l�i�Tv|�\0aBZnQ�l��md��/��<!kS4���Ҋ�\\��4�\r���V� c\rj1����ܪr��4�f��F���\"���hU\n�����y���x����|N�&2�cbRᯌ%���M�a81��+�9g�!��uA\0w	�2�a���+5�2�(&T%�P�Bג�>[��\n�dJ�O�޽���glY	��H3\na���y`ą��J졘2vRTT�Y#-��E)R!��{[�^b���_��S.";break;case"lt":$h="T4��FH�%���(�e8NǓY�@�W�̦á�@f�\r��Q4�k9�M�a���Ō��!�^-	Nd)!Ba����S9�lt:��F �0��cA��n8��Ui0���#I��n�P!�D�@l2����Kg\$)L�=&:\nb+�u����l�F0j���o:�\r#(��8Yƛ���/:E����@t4M���HI��'S9���P춛h��b&Nq���|�J��PV�u��o���^<k4�9`��\$�g,�#H(�,1XI�3&�U7��sp��r9X�C	�X�2�k>�6�cF8,c�@��c��#�:���Lͮ.X@��0Xض#�r�Y�#�z���\"��*ZH*�C�����д#R�Ӎ(��)�h\"��<���\r��b	 �� �2�C+����\n�5�Hh�2��l��)`P��5��J,o��ֲ������(��H�:����Š�R�m\nȗQ�n�)KP�%�_\r�(,�H�:�����4#�]ңM.�KT&���P®-A(�=.ʀ�Ղ3���_X���<��S.��Zv8j挪�*��c��9O�ҿ<�bUYF�*9�hh�:<t�\"��tU�1���B\n�ŻD�J\r.<�o+�~Fi�_%C�`\\����-�%��`�If�8f	g1�R��ڂ@�	�ht)�`P�<�Ⱥ��hZ2���+��\"�/DHj9j1�lʍ�0�6,�,�����eKS:�*\r�V7!1ic>9�èط��4�4㖪�,���Z��8깅�S	JV�R�\0�)�B3N7�KDLCܙ�̪S�8�2�6��~m.�-R���1���	F)V���c�2�r��(�/!<,�����\\���\0�2m��s�R2>�\0y��0��I�D=�DB3��x�h��\"W\"�R���ζ%7U��q0ڸ�6cRF�ӞB��87����^7�4�����/�����(rŌ3�����qN������Hm��G���:^5\nE��VF��\nݩ���U;\",5���i֙Nx��Fӊ/\rT0�2:��\0w3�|1XV��^U�33~��\rk�|�6(�vCA��d00��@�3�<���r��`� \r!�7���e�� C]�!�f���;\n (!�䈑�('M�4�P�3���d4��:^�Z	%�ˠ�XH���!�ԛ;B=%fr\0�ɳ�����0���VKIyp\r!�G�\0ڎ�`l�m��bM��i\\��XHXy2�]�Dˊ�5���g�Pf?!��@�u��g\$Sb1�\"g� Px%��\0�T��ܸ��@é+���fϷ(�*�\rd`#cҺɩ5�������Y\\�j��f(!�'F:i�7ՠ�o��5XY�Ba3�TͱP�\$+�U�#xRG�iܒ�&��3.Q�%��H�(�2�T�曖�kZh�x�v��U��U�������	ԩ᥃�j��kI�c!\rr�V� c\ri���P�K&�%r�35S�Oi�&%�*&��@B�F��5;�\$�%q��L����|#�bΑ�f��;��l�7B0���?����F�%R!��/�`j%DX:W��S�y+�F���qc-��S�_M�� %p6�Ѕ����ʷLXԋ�A2�*� q�a�,7�e��K�bUA�i�Ybl�y�Mx�.�P(U�W8_26b1z<Ċ���J)��8d���(Vy���[b�ļؽp��/j��(K��x���";break;case"ms":$h="A7\"���t4��BQp�� 9���S	�@n0�Mb4d� 3�d&�p(�=G#�i��s4�N����n3����0r5����h	Nd))W�F��SQ��%���h5\r��Q��s7�Pca�T4� f�\$RH\n*���(1��A7[�0!��i9�`J��Xe6��鱤@k2�!�)��Bɝ/���Bk4���C%�A�4�Js.g��@��	�œ��oF�6�sB�������e9NyCJ|y�`J#h(�G�uH�>�T�k7������r��\"����:7�Nqs|[�8z,��c�����*��<�⌤h���7���)�Z���\"��íBR|� ���3��P�7��z�0��Z��%����p����\n����,X�0�P��>�c�x@�I2[�'I�(��ɂ�ĤҀ䌁B*v:E�sz��4P�B[�(�b(���zr��T�;���0���P�禌0ꅌ�(��!-1Qo��Lh���Zt�jq��ƨ�Z�͂��ɁBB�)z�(\r+k�\"���\"�C�2��cz8\r2�W\räaDI��@�����4&�S�>�\r�3բ@t&��Ц)�B��s�\"�N6�� �V��t��Cd?X (��'#x�3-�pʒ�*��N��/�\"����N0���#sH�1�L�v6aS�7�')\nF\"��/S�D�(��k�4H���(�7�\r؆)�B5�4�-��\r�jY1�\n�ǎm\0�(�;c=aL��'���f΂b��)���X�8�Mir� ���9d��7�ǭ�ч��9�0z)A}����Z�|�?L�����\$:d���O�T��/KjK7YYV�ݎ�R[g�܄����A����:����x�݅�&���x���\$��KCp_�a�ƌ0Gq�&4-�3���:��p��-��D���i%�@��f�C�0�hB���>��#3�gHa�<9\0���a�:��0j_�i�\"	�t\"g�|p�\$��ĸ\\�7����c{�( \n (V�\n\nP)ZE���~�P�V`�^�cvf\"����:@Բ�'���+^~���B-\r�hHn�Bq�!\\�PĴ̲�Q,�%%���Y3?':�0�Q d��4��B�}-�e#`��8 m���h��\\��{ɜݛ�O\naQ�>��ď�0h�,2�5js�>hL�F�*sz�6�%.��zJ��P��4J��E\n!2!��z�`*���X#HZ�\r�B�I��&�M�*�2�h��\n@�lM�D�-�#0rMA��*&M�vǢj�5�j9�ˢ\\h|6��[C�&��g�F��n Hf\\���\$Y4M&��#@�0-�udI9�L�L�xj���5�%������\nl���s��S8�=4Jh ��>�9�FM|�j�8E妼�UC'e�WePZђ�M��ɝ\"�f�r:-!fQb\"��Vɵ��K�\rPFE*sR-&���G�]N��\"%��+�T�";break;case"nl":$h="W2�N�������)�~\n��fa�O7M�s)��j5�FS���n2�X!��o0���p(�a<M�Sl��e�2�t�I&���#y��+Nb)̅5!Q��q�;�9��`1ƃQ��p9 &pQ��i3�M�`(��ɤf˔�Y;�M`����@�߰���\n,�ঃ	�Xn7�s�����4'S���,:*R�	��5'�t)<_u�������FĜ������'5����>2��v�t+CN��6D�Ͼ��G#��U7�~	ʘr��({S	�X2'�@��m`� c��9��Ț�Oc�.N��c��(�j��*����%\n2J�c�2D�b��O[چJPʙ���a�hl8:#�H�\$�#\"���:���:�0�1p@�,	�,' NK���j���P��6��J.�|Җ*�c�8��\0ұF\"b>��\"(�4�C�k	G��0��P�0�c@���P�7%�;�ã�R(����6�P�������!*R1)XU\$Ul�<��\0�hH�A�-'�Z��+�!���#9@P�1��%�B(Z6ʋ�ޣ3�8JCR�K�#������k�.=,I�iW�7]��*n%�t&�p�	@t&��Ц)�C �k��h�5bP��K#r��.V���\r��̠��X7��2<�����B�J��kCl\r��	��ƒc0�6��9�8�l0�򢊽*�Hڽ�XP9�-�:���8@!�b���9apAr������̻'h�6\n��R��p�8MCx3��c8��{[�:�4�@ ��z�9:#�4��\0x�p��J�D@��N��x�n�3�9�)cf�%�2h/�s=�nU*������ώ<�A�,:<�w�rh7-�Qãt�x��ɏ��˰��~�?-N�p_̎a�6��,�7�G5�M�ޔ�A��T��&c�R��'�+�U�L�B!\$|�B ;���g��b%!�3���Y�<g��S�lITj �4\\����F%��'W��a�E(-d�\0�v\$��F���s�8(*�T2�^ց�'ƈ�c JP8r�L٠8 ay�o�b��rF���3�X��rrN��I+�P\"F��s�ld44ִUI�I\"���' \"��E&�٢��J8 �0����q͉�d��B�f���5\n<)�@Zk�1Q5\$������CYri�r>���A�<�:�w(�FΒp*n87#����^&��4.k	y1���\0�Bd���4�p�\"[*/�?�&�H�+{\nITK���3}	3�N�~��c�N&�5��MU��}P@��c�����}ENz�Y�MB\r��X�0����!N�dB�Q,\$ix˄i�N�,i�T*`Z{�O�v��+�Qb�rE�qAu	2�i!7��N��+HMX�>HL�3����\"_�i��g2j.L�R#�%#�3�Ѽ�h%萂*�r�l'�|�Q����Q���`Ӌ��?`*����HJe�'���rk&P�3�LPȅ6#���UUQ�f�����^\"�E�1�Ś�s8R���s�c\r�AJΜ�����o9`";break;case"no":$h="E9�Q��k5�NC�P�\\33AAD����eA�\"a��t����l��\\�u6��x��A%���k����l9�!B)̅)#I̦��Zi�¨q�,�@\nFC1��l7AGCy�o9L�q��\n\$�������?6B�%#)��\n̳h�Z�r��&K�(�6�nW��mj4`�q���e>�䶁\rKM7'�*\\^�w6^MҒa��>mv�>��t��4�	����j���	�L��w;i��y�`N-1�B9{�Sq��o;�!G+D��a:]�у!�ˢ��gY��8#Ø��H�֍�R>O���6Lb�ͨ����)�2,��\"���8�������	ɀ��=� @�CH�צּL�	��;!N��2����*���h\n�%#\n,�&��@7 �|��*	��8�R�3�����p(@0#r巫d�(!L�.79�c��Bp��1hh�)\0�c\n��CP�\"�H�xH b��n��;-��̨��0���<�(\$2C\$�P8�2�h�7��P��B�қ'������#��Jmw�-H�P��g��*�2Zt�MW�К&�B���zb-��iJ��5n�>|�,Dc(Z���hН�-��7���3՚���R�&N\0�S\n�x�N��*��c�9�è؎Or�X���¶0�%6����aJR*���ؿ.A\0�)�B5�7�*`ZYt䂍cP�Ȱh�ϧ6`P�:OVL�H\r��0iH�42Ik}� ��2f�哌r�� !��\r	���J(D>�jf��x�%&05�ؘ؝�v�{��H��3�,�B۩Z�9WSh�k <w!i���o�Bl8a�^���\\����3��_�+)r��|\$�����W��z��l���8z�vձ����)v����qbc�5c�V:��:R�L�\"1�r�@ɢ#�9=���a�e�1���\$-e2\0@�L��s(�3��CInCF���&��?(0��!#XAC�;X�`(��a<)B�PRSH\n�je,��f���m��\nA}s���\0@~P��=����v�ӓ�Lm����)%e<��\$|M�%'��4��ß�rMp��d�P�)	\$D<�B���o?KnEb|C��9�����b	�)��=h�s)���@Ƚ^�g{��4��\0u(\$S�Rcs'/@>�{\n���C �5��Lé���ȿ��	� ����<M�\$.����0�i&dp���`��qy���I(��)e�ŗB��� [�Jz��6e�(���)Os�s��)Q\n�hP�J�Z�0��zDIHCDa���B��.�8�6zDjgkU)&���wގ�Ĭ\n�P#��C9�\r��3Хb�A�f��Q:�PʝCK�t%�R��>&��\0��Jsmh�0�;2�p\n8����q�d��U�iM:ۥ(~>:p�<ΚE��zה�`aH\n �H\$�0O��l>3�f�\n�=N�V-��S����)-Wf��T�S %�w��N]�`�]��]�Z�\$T@";break;case"pl":$h="C=D�)��eb��)��e7�BQp�� 9���s�����\r&����yb������ob�\$Gs(�M0��g�i��n0�!�Sa�`�b!�29)�V%9���	�Y 4���I��0��cA��n8��X1�b2���i�<\n!Gj�C\r��6\"�'C��D7�8k��@r2юFF��6�Վ���Z�B��.�j4� �U��i�'\n���v7v;=��SF7&�A�<�؉����r���Z��p��k'��z\n*�κ\0Q+�5Ə&(y���7�����r7���C\r��0�c+D7��`�:#�����\09���ȩ�{�<e��m(�2��Z��Nx��! t*\n����-򴇫�P�ȠϢ�*#��j3<�� P�:��;�=C�;���#�\0/J�9I����B8�7�#��0���6@J�@���\0�4E���9N.8���Ø�7�)����@S��/c ����\$@	H�ݍ�x��ON[�0��Z��@#��K	Ϣ�2C\"&2\$�X���C�58Ue]U2���=)h�pHW��)�C��ŁC8�=!�0ء�\"�S��:H���2�c�4Z��#d�0�C��\"����%&!)QM���i\r{�iJ<��-�0ܡp~_ϜY��w*k��7��n>�&�::��@t&��Ц)�P��o��.�B��p�<�\r�ʂ��L�3�>�\nq:h9=T�&�6M2����܌cB92�A�>���#��Ao��Jx����^\r���Z�2���kŞ��;����꛶�>Q)�V�8��mjژ�~�n���Ik;ָ9���%����pâl'!���p�)�Z b��#�\0�̸�^\$0Ã3�6��`��!|ƛ^��)���~��vc�� �o=P��@ ��<O�Ď�c���2�����D�A�F�9D�x�!����JV�kk�M�)@҅��&�h0��R\nPh�%3��j��	B0ݻW�Xe}��4@��:�;��\\���?!��\0��*w\"	�>����\r!�� aS�%	0ܼ�(e)����_Q�t��BXPb�)�kܞ���H2kLH:�0�\rHw@\$lB!�:'��P�(l\$��'|�J�!�� ���(s���\$� �R�(9��̀d���630^�xoD������(�]|�ʙW+QLs��`��f]���nox�9\\H��.G�=E�0�AP-�4 �Fu��؁c@�\$�D	�x��:+T0g	M���2	Ii�HEH���L�iu\$��3)h������%'\0�I�;'��(\$��A�/��-�sӉ6	D ^���Њ��L�Ց�ğr{�Ž�0�|�I�)ɬ��AXJ\"\$�Y�L���B�m+t`7�%>&Jr�)T����է�\$��R!�( 8�4�2:��j�d�U*�!\n��\naD&8RaGh�w#��Ft�ŝ�`���U	N!����H{'AHȡ\"��K�)C�����M�b���A9��a	�iS��X�&���@s<�TG�;�T�I��k`­��0V����\0c�ҵ&�\r1�Vʩ5�v�Ԩ�I�P98l�M��1�RI��l/�9> (�B�F���[�5jl����ZEep-)�4AR�	},;ya��	Nk����Q�S���#I�\":�*d�?Ƽ��c�B�,�j>�<#N[���\n��3�Hq�1�`��h�j��̩0A�%#b�˒���|p��n\nt��\0����=����\"Y���N��3&r��2��&G�F�B!�*�P\"���N\0[�b�{����V �e�����B65�	j��Pr��v�\\� �";break;case"pt":$h="T2�D��r:OF�(J.��0Q9��7�j���s9�էc)�@e7�&��2f4��SI��.&�	��6��'�I�2d��fsX�l@%9��jT�l 7E�&Z!�8���h5\r��Q��z4��F��i7M�ZԞ�	�&))��8&�̆���X\n\$��py��1~4נ\"���^��&��a�V#'��ٞ2��H���d0�vf�����β�����K\$�Sy��x��`�\\[\rOZ��x���N�-�&�����gM�[�<��7�ES�<�n5���st��I��ܰl0�)\r�T:\"m�<�#�0�;��\"p(.�\0��C#�&���/�K\$a��R����`@5(L�4�cȚ)�ҏ6Q�`7\r*Cd8\$�����jC��Cj��P��r!/\n�\nN��㌯���%r�2���\\��B��C3R�k�\$�	����[i%�PD:��L��<�CN��ҳ�&�+�� ��}��x�ˬ�h��\0�<� HKP�hJ(<� S���^u�b\n	��:��P�ፕ�\r�{���n�����4� P��;�J2�s�\"���ҽ������r� ���\"�)[�S���L�%Q�oST(�o�W�W!'κG\"@�	�ht)�`P�2�h��c,0��K_l��Sq!Cc�4m*Y��0���)Ŭ9%RRr���b&ؤ(�r7�	��2C�ƃ\$0�X��\$6c��_o���9�2��R�\n�x֔�)��;(OZ�e��CK�ۣ���T�I�p˗g�9f��1�0n�9���N�6C4;:��8@ ����p���a�� �Ό��D�A򐼹��x�!���/�����Zd\rC�e���&���\"�B�R�ٳ��Aδ�D4���9�Ax^;�tm�@+���\0�:N�F9��H�85������xA'��B�~c��A�'\0OI@t'���R�C)\$ F��#�[�;�@�1����\$���w���9�'њ@oiPah�v�ϪN �&\0���H��\r�9��r\\�r�D\$�/���B\n\n ( �`�( @�r��LXs#�\0��hsWL<��՚վlO6F�� ���C��'���µ�gm)0���p�t|w���X���s�#�u�-�\"��1l\0!�Z����D04��D�ɤA	�p����3��!�l@��܅��1�T>�M�p`M�\\�SF��:�`@Ҵ�o`�.�@�B�q�'���� �&���fv�s���gW���tV�%�?��b�i��� \naD&!��� �R&��BQb{����D��z+g����g�S�1F0��bqBMj;�R�/�f�fLtY|?�}�\0A��W-CJ)8��gf�nX��]%bN��-X��׿4<� �S\n�P#�pI�s�1nD�/:���\0.�A{�j h#\\�!�Ҝ��]f�mm @N� lG&\$ņ`�Ö��d�P�� 8\n(�֊�`��C�(X��5�+c��, �鿒���qF���\0��f*��\n	�#��.�EK�ţ�Ø��z���b��zE�!!���U�zC�O=Պ��b��9-c�,��*�aH�ϮT>�'�民z-���";break;case"pt-br":$h="V7��j���m̧(1��?	E�30��\n'0�f�\rR 8�g6��e6�㱤�rG%����o��i��h�Xj���2L�SI�p�6�N��Lv>%9��\$\\�n 7F��Z)�\r9���h5\r��Q��z4��F��i7M�����&)A��9\"�*R�Q\$�s��NXH��f��F[���\"��M�Q��'�S���f��s���!�\r4g฽�䧂�f���L�o7T��Y|�%�7RA\\�i�A��_f�������DIA��\$���QT�*��f�y�ܕM8䜈���;�Kn؎��v���9���Ȝ��@35�����z7��ȃ2�k�\nں��R��4	Ȇ0��X\r)q����\$	Ct9����#%�څ�O\\�(�v!0R�\nC,r�+��/�؈ϸ�򰘦��ڄ\\55��X漲�ȘϱH�\"�/���-/B�V�B+�+3b`޿��x䞍�Z�\r���Ҽ��J2�4�CQ��P�T��PH�� gX� P�ӌc�&�h��b�Bx��4j���P�a�����s�(\"�������rF:�+ЃJ�����20�p��4�Ib\\���-Au�m�̾'��Ф��P�3߀P�\$Bh�\nb�2�x�6���Ë�\"��ڮ����\0P��MSX���x�3\r�\0��!ij��]�ب7�)����ƅ\$c0��T�� ��w�ݏ�8�\n����R���ZVb��#;�b��ށΗ<wu'����b�I�^��B��S\$��\rs�}CӸ�3�ɩ!z@��N��`-kF3���K���^0�قF¬��5:D!\ré��:��l@�n��&��2`8Bp���t�.r���C@�:�t�㿤GD��zW�D�����	#h���#�=�N-Ğ:(\0��N�IR���ݯ��\"f+G��s�kLZ�2kН��CS:\0�;��Rc(r_jM/\0���g��9�&���|~\0�t�B^�%�����:�u2���(tD�Q)�{ȩ�\0�r1Q�RJ�232A̐��lJ��R�D���@l�ٶT(�#��L��x��d�CaZ�f�U	9\n'P�Ǆr\nD(�\0�G̑�RHh�<7��&p��\0��퍤T<��HUa%o����F��24�!�=hX��D��;���O\naQ%4rOS�8#��+�^�d�8��5(P	�'�\r�I�FT˲\$��A �uu���E��OG�n�8����\0�Bb� �t\0�\"A>T%?iT|�r\$�\rb̃H�\r:�^��ĲqAT�#��x��Ht	�Nt�E	�Hd�S,�H ��K֒��ԿiM`!��W,CJ�\"��19�]��%�E/0Z���F�a���0�¨T��/d�\$T���5�w�9�k��PsL� �����aCS\nG�\"N䜔��8��� 'f06#��̐f,<2�3F�SrK�69� QOy�*ta��\0α��IZ@X\0��;�\0�'��:�=>7�((�pzU�CR�a��FQ��]I�a��CT�[��v�U�\$E�3 ��5��THx�FQ��36��q&�\"q^�i��������#���z\0";break;case"ro":$h="S:���VBl� 9�L�S������BQp����	�@p:�\$\"��c���f���L�L�#��>e�L��1p(�/���i��i�L��I�@-	Nd���e9�%�	��@n��h��|�X\nFC1��l7AFsy�o9B�&�\rن�7F԰�82`u���Z:LFSa�zE2`xHx(�n9�̹�g��I�f;���=,��f��o��NƜ��� :n�N,�h��2YY�N�;���΁� �A�f����2�r'-K��� �!�{��:<�ٸ�\nd& g-�(��0`P�ތ�P�7\rcp�;�)��'�#�-@2\r���1À�+C�*9���Ȟ�˨ބ��:�/a6����2�ā�J�E\nℛ,Jh���P�#Jh����V9#���JA(0���\r,+���ѡ9P�\"����ڐ.����/q�) ���#��x�2��lҦ�i¤/��1G4=C�c,z�i������4�L�Bp��8(F��� C�:&\r�<n�	��7RR;J��\rb��AN�J��D�@6��ŠP�PP�pH�A�!��\r^��(�D������0(����(\r��vJ�x�4�\r(��\r�8�Z����#��`�K���)lV�aNM����p �c6�b0�&�\r�jׁR��6�B@�	�ht)�`P���h\\-�9��.�W�6�Ce6(�_D�0ؽ�����J���P�7���4�ƫ�c�̡��k�c���WF1�&� a@����)�\0�5�A��#*O\n��'�䢪�n���A\0�����z*6�B��FHK�*^�9m�zë��X4<�0z*A}/����}���B��1�9���mx΄:㳯�]�2\r�5�z&¯�?ģ���x�\$NuAX2���:����x����R�ZAr�3�����	;���0|Sy�O�	�;��S���\r�����ߑ\n�*ЁҰ^\n9P!�1Rd�Q.V�{�7.	�UK�psxM��7N)?���юr����f�ь68��:���\r%�J�dt�\$&QX��k�l:��1�sp�Q�8C��[\0PT���;��+��C��7���,>��N9(l����	=#I���@��^a���\$�b����i��IC(��%�J�Mj\\)�}{�bÊ�>\0�=��^�Hx���d��4!�\n��y�u�����B�ɜLo����c�rQ�z�`0���xS\n�eX#�y%�Tb+!�B>Qj�B�\"'��^\\t�����b\\BҢ-�̞H�N��Uh�J\r� ��JS�pO,)��V�ɻ%�*91�oDbf'�r���\nW�\$���	c�+�ч �YiQ������dV�:\n3T���x��\n��,l�3Nm?(�L4��WV4�5r��1v2��mT��Ҭ��tk���\r��j/��M�@ ��7�ub�Z5q�&f��rC���(�*�@�A;fd�Ռ�:�o�X�\"��20�+��H��>0����&]�mb,Ȭ�Z�T�x_��4���f��V��ں��]T�����ɑɼ��%8%�6B`@0�]{�����!v�����,�uXR��\nT� �\0�j��;W+G�=^sMH���U��,[�Y�M�]fUa�E��U����E �C���S�e�Ռ���2���U4�ι��";break;case"ru":$h="�I4Qb�\r��h-Z(KA{���ᙘ@s4��\$h�X4m�E�FyAg�����\nQBKW2)R�A@�apz\0]NKWRi�Ay-]�!�&��	���p�CE#���yl��\n@N'R)��\0�	Nd*;AEJ�K����F���\$�V�&�'AA�0�@\nFC1��l7c+�&\"I�Iз��>Ĺ���K,q��ϴ�.��u�9�꠆��L���,&��NsD�M�����e!_��Z��G*�r�;i��9X��p�d����'ˌ6ky�}�V��\n�P����ػN�3\0\$�,�:)�f�(nB>�\$e�\n��mz������!0<=�����S<��lP�*�E�i�䦖�;�(P1�W�j�t�E��B��5��x�7(�9\r㒎\"#��1#���x�9�h苎���*�ㄺ9��Ⱥ�\nc�\n*J�\\�iT\$��S�[�����,��D;Hdn�*˒�R-e�:hBŪ��0�S<Y1i����f���8���E<��v�;�A�S�J\n�����sA<�xh����&�:±ÕlD�9��&��=H�X� �9�cd����7[���q\\(�:�p�4��s�V�51p����@\$2L)�#̼�\$bd���j�b��eR�K�#\$󜖼1;G�\nsY��b�c���й�(�էI��e�����f�Y�1/}�XdL`�pH�A�3�Y\nd����vl���U��G&��P�.3jj���ծ/�(�#+A�V�Av����*��j��a���ע���J�4h�+�^E��\ru_Z\$����0���\0���Q�)��\\�r��OϿ)r�w1��jrA��<z��U�[���Y�N��?y>YO3\\�Ѡ���4\0P�(�hu��\\-�E��.ș��\r���\"6�\n�W\$o��`�p��!G�>8�yE�֮�@/\\�l����lͪ�9\n����t�\r#�%M!ڪT����L=�\$�,�xw#�k�LA����Q��?x&���B#����%\0�����'�`ۘiyr�\"�X\"P`�Ⴅ���k�|&�.��	������³�a�U���C�P�7�p��� b\\@dq��V돤ITL�\r6%>�XQR4Ō!�0��l3���1g&�Ã'\$��,1J��^Q\$���gW�\\r��Gbo�(����\nKL��qU��8 !�6��ܔ�` k�w�D��a�9P�Ar@�0�@�-�8<�*5K�>��ю�PO��PG8�9s×�Q�c���Jd�n����X-^�)� �E9E�n�3b�pD�t��^�.2�[% \\�C8/]�iu��޼A|�`�h/��SS��!3Jj?si�s�/��i.PH��/�H?����(�,��,��SgB����\\t��*\"9�;��)�B_!�g�@�Hl\r��1%����`r\r����̻�ha�1�0�kl\r�[U��@ �	}nV�u1e�n��62�uO*G\$�1���� �e� �������O�ʠ�Jz�%\rD>wY\0����׌���B��@�iՄ2�z�o�bd[i�7�{^��l��5ӝ^����k֝�+r�PO�}�V\n]U�%3���G&r��	K����W�v�a>�������c'�*�/HjO��%B��S���Db}RDdJ��@b�b6����y�4T3�%D��!Mx�\$����9N|Hp�+�>�yM�dJv�4�~Gj�V��0��9X�\r݁\0P	�L*O���b�8i��Ɗ\\T�	MȐ�#NV�j.�'�Pۀ	B}���kck�^Hy9����b�r\r��%D~ү�\\@������)�Ջ�%��8�d��\0S\n!2@�R�O  �P(,��/ON�aF�:xCaA@cϲ\"Cr2%�k�0d��Rto����;}C�����u�N쓈������T��`��]]l=j\r�#}o�~�خ�h�}�Y����l�Qq�������ɬW���O��Zl���lc@TǕ���.+�DG6�FX/ڏ\":���M�W{�&�s��S\$:�C*��/�|��\"A�\0�\$\08N��Q�9��m�us�k��@�5���k���a�̝v�jD;wܿ?1����.p����e\"�2�#��Pf����p@��2��'u/M�M���Ğ��*_|�S#�\0Y��V��ߪ�e�ӝ����:asO���N��*��cB�0a��KI. ĳ�\$b\$z�a,MWa��bK4J:���ޒ6✱�X��)�0�iK?Mӥ-xH�5�����[G=�\$dM��n�jm�ˢ���y̌n�夔�,���~y��V���Ǯj���J�hbq�";break;case"sk":$h="N0��FP�%���(��]��(a�@n2�\r�C	��l7��&�����������P�\r�h���l2������5��rxdB\$r:�\rFQ\0��B���18���-9���H�0��cA��n8��)���D�&sL�b\nb�M&}0�a1g�̤�k0��2pQZ@�_bԷ���0 �_0��ɾ�h��\r�Y�83�Nb���p�/ƃN��b�a��aWw�M\r�+o;I���Cv��\0��!����F\"<�lb�Xj�v&�g��0��<���zn5������9\"iH�0����{T���ףC�8@Ø�H�\0oڞ>��d��z�=\n�1�H�5�����*��j�+�P�2��`�2�����I��5�eKX<��b��6 P��+P�,�@�P�����)��`�2��h�:32�j�'�A�m�Nh��Cp�4���R- I��'� �֎@P��HEl���P��\$r<4\r����r��994��Ӕ�sBs���M��*�� @1 ��Z����]����֎�P��M�pHY���4'��\rc\$^7����BM�u�	�u#Xƽ�c��k��k֏�B|?����J�q,�:SO@4Iײ�*1�o9��t^����y(�\\�C`ӆ`�\nu%W���60��n��x��b/�(��	Kd��T��	�ht)�`T26�������mޢ�Ī6M�S:���`�3��0����{U%\r>Ɋ�zB����@:�è��c��:��@�O�cX9l�ϊ���Z6���daJR'#7��8i�@!�b��3ÍDc2&6�@=4nJS�S��V�-c(�2Ӊ�B+��5��H��?\r_4����3���#��O�M����H2���D�A����8x�!������&O�0��GJ���aC��B0�)_؊B�l.9bC��C�%r�4<���@t��9��^ü����\\D�8/'0h<'���A{�`�\$���NPn�m�%�ی�5����d'!������aK�n���p�Q	�7')%���C�P �;������rwi�[���{k5M��7 ��\"��\r�'T�[P����de��@��8�`NEȐ/r�\"�2�1�ȄNCb��G��+c��\0��8`�	�'�SNMJ�B!�՛T��� �	V��	�R�+��8�X��E�\0�D� z�i/&-��-���i6'�5�����������Jq)	\$,<��\n�y'*�:CW\0C�u5H83 >���81�%r5(h�\n�4xI�I	((�\$+J���Ҏ	8\"N~mMz\r)(�30�qfxj��5�D�٧N����6xN���V��0�%N&(�`�nVĺU�o=SL�T�YG2s �չ7;!���2솪�@\"�I*ZN�iRF��UdS�d;&�%�R���2(�����8y�bj���`+\rlh��bE3T�8��R�&�c�hG�=B�\$JB1)�p��xl�T���VF�9)�50��I\$��z-����7m�l��݆oY=N����IH�q����C\0`�I}�bG�`�p�T&0&�\0̓�YY5��+G�JH�q�\$�(�/�?\nJI�Xd��0�و�u:茍�4Q|�1'%!2�+`�D�BJ�0�r�	��J�i)�V'�̓'�O����&Xa�LW�J\n�\nk�2�J�Y ~f0\"��j�,�ZkT�4�0�ͽ�I��][�`ҨRũ8��3��\nk( ";break;case"sl":$h="S:D��ib#L&�H�%���(�6�����l7�WƓ��@d0�\r�Y�]0���XI�� ��\r&�y��'��̲��%9���J�nn��S鉆^ #!��j6� �!��n7��F�9�<l�I����/*�L��QZ�v���c���c��M�Q��3���g#N\0�e3�Nb	P��p�@s��Nn�b���f��.������Pl5MB�z67Q�����fn�_�T9�n3��'�Q�������(�p�]/�Sq��w�NG(�.St0��FC~k#?9��)���9���ȗ�`�4��c<��Mʨ��2\$�R����%Jp@�*��^�;��1!��ֹ\r#��b�,0�J`�:�����B�0�H`&���#��x�2���!�*���L�4A�+R��< #t7�MS��\r�~2���5��P4�L�2�R@�P(қ0��*5�R<���|h'\r��2��X�b:!-+K�4�65\$��AKTh<�@R���\\�xb�:�J�5�Òx�8��KB�Bd�F� ��(Γ��/�(Z6�#J�'��P��M����<�����-��o�hZ��-�h��M�6!i��\r]7]��]����l�5,^��]|ܨ`�sޘ�iQ�x��\r@P�\$Bh�\nb���p���b픺��,:%�P�&�LS *#0̝*\rT�2���@\$ϐ*\r애7,��:�c49�è�\$l�I�(�����4�êaLG6.��\r�k�!�b����q4C246��\0@�Px�֎�#)@&��8g\n<���s������\r\"�=PP�2@�#���X2���D�A��\$�p��}3&�C��^�\n��|nQ�EDg�\n^&�(��p/����б�/J\r��8a�^��\\�k�P\\��|�L|�7�8�	#h���cp��vR�\$�h@�Bz�p)�	��x��9<*��d��8o!)e��C%L��;�&�]`8rr)-\n��HiO5����m!(t`��0�\0c/P(4���K�7��С�,T�<<��V�����\$\0@\n\n@)#��C�`�ny/i��B(gH9�3\nA��6iO� #�;��NTP2g=�\"2bLɩ:�Ɇ!X�nxi`�H;b\n|��-�;�~�I�\nT	l���&LY'\r(P���!�x ��:��~�arϕ.�Ð��4q����	�<d�6-�nxS\n��-40�uԼ�20�L���H�&<\"Q\"<r��[Cl�T�5�g���PP3�\0�B` �H�n��^!hQ���JPAș�)��Rc\r'P�C��Cԓ�'�L�I\n.�KҒ) ;�<j�{�(� �0�D	\nt�ҵ�\\�u!I�♑�k\$H��B��I�OC-*�,�����h\ni46��2M�8/E��E��o�YF%�~@7O�A�\n�P#�p�s�/n��Fi2��j0�w00�]��@^k���P�Q�M\$6A/�aL9.�6���al3c�dj��:(JK�t.��&�0���d6��\r���� O������'\$�\n۬�8�ُ S8�R��o����d����� �\0���\\Ή\0006+X�h˰ 5��5'e�❽4�+ үu�0��� �Y !�\0��dKb�(IV��o2�~d�=�\r��/�|�Ħ�Ȓ�\0";break;case"sr":$h="�J4��4P-Ak	@��6�\r��h/`��P�\\33`���h���E����C��\\f�LJⰦ��e_���D�eh��RƂ���hQ�	��jQ����*�1a1�CV�9��%9��P	u6cc�U�P��/�A�B�P�b2��a��s\$_��T���I0�.\"u�Z�H��-�0ՃAcYXZ�5�V\$Q�4�Y�iq���c9m:��M�Q��v2�\r����i;M�S9�� :q�!���:\r<��˵ɫ�x�b���x�>D�q�M��|];ٴRT�R�Ҕ=�q0�!/kV֠�N�)\nS�)��H�3��<��Ӛ�ƨ2E�H�2	��׊�p���p@2�C��9(B#��#��2\r�s�7���8Fr��c�f2-d⚓�E��D��N��+1�������\"��&,�n� kBր����4 �;XM���`�&	�p��I�u2Q�ȧ�sֲ>�k%;+\ry�H�S�I6!�,��,R�ն�ƌ#Lq�NSF�l�\$��d�@�0��\0P���X@��^7V�\rq]W(��Ø�7ثZ�+-�E4�\"M��AJ�*��σT�\$�R�&ˊHO����T�S����\n#l������#>�M�}(�-�|��\n^�\$��H��A j�� �w#�W#�gt3쒀�cik�h�����M֛C\$5�H&f�]�Ыγ�c\"��(]:��Dʒ�چ�\"*�q�	=�d��6���}���*�,e��CR��N��\r6�Av�k/jh�k��ˡ,H�+�l�ik�j�)�)i���K6񤭪�3��\$	К&�B���`�6����Ϗ\"�E���1FK���\r���ܷa\0�98#x�3\r��������a�\n�{�6�#p��(�1�np�3�`@6\r�<\$9�����#8�	%�6�C��aJ֢,s=O9�\"�)Ҝ�Zk�����7n�`ƕ��4D#&�T��2xO�b+���r�\r�*9�]U���\0A��7#��B�����o]�f��� |��tBA����[(CKЈ��\"���Dż�6w�OWz�C-Ԟ6D��`1B	���#��Pr_+8�h�!l/\r�����s@��x��#wH��p^CtXrc,�_\r�>	!�8�� �=��������� 5�ґ��Ȅ��:\$�L���I�P�,�b|]A�i�A�B�@�<�\r�A��C:Y\0�;����pFp9H��C4]HOA�=G���.��d������3�\0�C`s-fa���[L��]�����lxDaS��n!A\0P	BwOdʜcc��\0��P�Ȅ���q�A�9��|�@�y�G�t=��Gy2~H4��ST�[T�����2�I�4f1m��k�ґ=���!�U��\r����qJ(�?E��SP\n	\$�<��W��H(�7I��sݠq�9 �ddaz��x��	���ݤI��#gUR���!<)�I��L�3k�Au��삩�)�D��Of����w�*��Qd�Ij�P��D�e�fq^��z���UU������^d�\r���\0�C8 \naD&\0�F�Ʌ�*PG��CL�H�����D�4=4���D���U�F�Kw��2F��k�(oAqW~�X��GW��\\�z%(�6L�Im-����ݥ���C7�}/�	����`Dplq4����l��%؆Kgz��I��(#\\����|��*�@�A»�}	�%�h)�<��SV�~qDn��?3�͑2��� �L���\r).���J¼�����flų�\nE@PM��3�]\\k��ph4\\F���(5l�j^9^�L�wf�����˦!�F5z���V��3�H��+e����Iݶ0bʱ���Y%b42��(|��C/ƫKx\$�\ri�ך�\na���8��jP���h!j`-�D)�1���O,�m��.��f�OI\"}g��\n\rp���*\$��";break;case"ta":$h="�W* �i��F�\\Hd_�����+�BQp�� 9���t\\U�����@�W��(<�\\��@1	|�@(:�\r��	�S.WA��ht�]�R&����\\�����I`�D�J�\$��:��TϠX��`�*���rj1k�,�Յz@%9���5|�Ud�ߠj䦸��C��f4����~�L��g�����p:E5�e&���@.�����qu����W[��\"�+@�m��\0��,-��һ[�׋&��a;D�x��r4��&�)��s<�!���:\r?����8\nRl�������[zR.�<���\n��8N\"��0���AN�*�Åq`��	�&�B��%0dB���Bʳ�(B�ֶnK��*���9Q�āB��4��:�����Nr\$��Ţ��)2��0�\n*��[�;��\0�9Cx����0�o�7���:\$\n�5O��9��P��EȊ����R����Zĩ�\0�Bnz��A����J<>�p�4��r��K)T��B�|%(D��FF��\r,t�]T�jr�����D���:=KW-D4:\0��ȩ]_�4�b��-�,�W�B�G \r�z��6�O&�r̤ʲp���Պ�I��G��=��:2��F6Jr�Z�{<���CM,�s|�8�7��-��B#��=���5L�v8�S�<2�-ERTN6��iJ��̈́J5�R��U�D�8�ڭhg��l\n���e�	?X�JRR�BٲJ�d�K��d[a�������]��v�Y�[5Ն��M)WV�+��\$e}� N󽥘{�h��/x�A j��� ��m��2�,6��Mĺ۰\"7������+��\n^��ܵ'�R.\0��R�@ޕ*�<����[�|uhZ�n	p��]qm0�w\\�7�g�����QW��x^'h��?��.8G�!v���Ѣ���>z�|���Sf{���7wވ_��8��%B\0�Q��A \$��A�S\n`(2@^Ch/a����P���y��z�JAJQ�\0006,�v��aG�7�`�@e8(��B���Xɜ�<���\r���@�yCha\r��UDCc=��3P�\ngI��g) GF�R@u>�9���R� ٘e^�_�Qnɇ��h���Ʉ)����!�I�L�8D����h}hi���i�b�%\$�W:D��qH3�䷥�m+\"��*�>U��N�a>��UF�A\0A��7&x��*�����w��f��� |��tI������\r�9ե#֔D9lѱ*�,�{1DE`��&�2t2���f���E��58p�y���M�\0��՚�lͰ��p`����I�qE���&���U0e,�R�����I4籊���9g;T����|�a\rg�4���fm>�22u���h*�jJ�\$���c0A��P��A^\n����8�( �3�#�<�LU��C��a�q�3Ƙ�\\��񭄀0�P@��*�A�68���J��P�7���T�X��r\0PP	@�U�\\U�ͰA�K6g�-9��g^G��,ͭ���S�zOY���=� �|�vOP��{���d���&| �_V�HV��[�LWM��^O�W9�	) 32A������+�Ѯl�].�2����-��E.	8oM��2fOɲv��+0��^I!F���2)�`�)�^��r�Vu\r�[�[�\r������dLW�I'p@�ޏ\"xN!�����Èu=��3&��2f\\A���X�lU�OǸ� B��Q����푀�T�ȇ\0�)�3̯3�B�q]_Q8�P�Ҫ��*�T��b`�`i�@7`�èr>̳�p�p�\r�@�J^�1��L7Ɓ�-E҄Q+� Z0��c��k�`�k\"�z\r&�>G\\���L��a��#~\"Se�r��|g�\n�Z�<�ᄗZ��2���XΫ��Yྜ�6��]`�\$�p�h�<.J�l���d�^o�^��w�'��Ҹ=Ҿ�ק��~e#o��ݸ��䠚N_/���+_�B?���\n�@a�W���B�����*i^�&��d�]��e\n�P#�p�f�6I;��flTu*��Nq���5����GU��}��OےK�����Υ_\\�~U��z���W4:t��J}���#q@���0�6��.B�c�IL0w]��(y�ٙ�p�?;H��o%��~[�~��-�\\�'fu�a�xR1H2��4Zb��3��;��{	g�������*Ȅmf�@��ʾ�[�������\r�7f-� ��A�!�5M�+�Y��s'�m�|ٽR�M:���˵�w>�S)y羮YΧU��T鯼�����2\$�R��C(s5���n��/H�N���P������/�Q���޿T\"'�s��1�(��0�.�e�7'V������[�BS�Q��K���ODJ ";break;case"th":$h="�\\! �M��@�0tD\0�� \nX:&\0��*�\n8�\0�	E�30�/\0ZB�(^\0�A�K�2\0���&��b�8�KG�n����	I�?J\\�)��b�.��)�\\�S��\"��s\0C�WJ��_6\\+eV�6r�Jé5k���]�8��@%9��9��4��fv2� #!��j6�5��:�i\\�(�zʳy�W e�j�\0MLrS��{q\0�ק�|\\Iq	�n�[�R�|��馛��7;Z��4	=j����.����Y7�D�	�� 7����i6L�S�������0��x�4\r/��0�O�ڶ�p��\0@�-�p�BP�,�JQpXD1���jCb�2�α;�󤅗\$3��\$\r�6��мJ���+��.�6��Q󄟨1���`P���#pά����P.�JV�!��\0�0@P�7\ro��7(�9\r㒰\"@�`�9�� ��>x�p�8���9����i�؃+��¿�)ä�6MJԟ�1lY\$�O*U�@���,�����8n�x\\5�T(�6/\n5��8����BN�H\\I1rl�H��Ô�Y;r�|��ՌIM�&��3I �h��_�Q�B1��,�nm1,��;�,�d��E�;��&i�d��(UZ�b����!N��P����|N3h݌��F89cc(��Ø�7�0{�R�I�F��6S����wܨ�qp\\NM'1�R���p�ap�:5��Li�`��I�IKH��Z �c#ۑSi�h,~�CN�*���#�VK��/�۬���3�\r%ʈ<��S���^|8b��M��]�6��;hӥ�i���d01�q�-�ss�s�T8J+*gKn+�껹�xt��Őÿc9��*�᝱q���>�)�J��uR��E������t���L��u_;v���S�������H\$	К&�B��xI��)c3�v�P^-�e�j]�>.))�@4Z��(\n\r��9\0��z�r=�3`ؕC)�9�,�-Ť�aY{�)޷����T\r��6��A\0ue!�1�3��0u\r��6�ΕC�,?���R� � ���ԪP((`�\r0F�����Vd�S0��3z:��뤣`m\n�{I��,rw��:H�͝�\nm���h��%@!9�[��ͬ�4G:�^o|�Cؚ�fc�Օ%`@C\$N\rɺ!6Xʃ\"n\0�0��\$��\"1\0�'�>�g��0���+M�%^��@���?�5 KQ-MQ�H�L�s-��;����jw@��C5��hx�	(�G)CD��!�:@���/��z��&`�rN!��P�?Y<�eL�ʠ��Hm�6���,���7���!hk=�B��[&�pt|+�ղ�J�CW&K��.�hh=�1�X���a����\$��\ro!�3M�\r!�އ0����NP9��J\0000��@�-\r!�6+��4Ly�CQ�V��`�	�_:����EF�ۂ�'en4�\0�\0(1\0�T�2�	�;n�qr&*Vp��3*�\\6Y&鬱?���c�~�+yPa�:��S�\\���̠�\n�#yP�gJ2���Py�tv�����luU�Ζ:�J��E�t�c�l�gG4���y9[������X	\$�<��@Ky>)�<�,��!��'�̜l��m� y�U��x�V}C�L��B�s���F�J�\r���el���S/��[�4�*�gtm�\nId\0K7��J.�-DV���b�s�!�n+:[l�y�v\n�h4H��O=�p�а�=��A�3�Т\0f�����P�+�.o!��(H�{���Mǹ94t��Ս��hAfHŰ��[*9β�9�e�K\0��&�/�z��a�dt�l��ed�<�S����Ù��Y��3�	 �\r��1�p���\09�b�frT�ۍ5�`#d��%�<�I�*�@�A��ׁ+��ގ�MS����fF�Yժ��{�\n\n�vg|���U��T4�`���mʎ4*WwpҰt=�0�\r�8\\h�03�b�T��q�U�vw�Ns>�B�5�l��Y~��	j�����X	��&��@W��Ĭ��h���pl�M�70N٬	��a% �~i��+(Q�A�b,��;�Ԭ�ݍ�976�>�&����h]xl�9���w��jI\\.yxNĠ";break;case"tr":$h="E6�M�	�i=�BQp�� 9������ 3����!��i6`'�y�\\\nb,P!�= 2�̑H���o<�N�X�bn���)̅'��b��)��:GX���@\nFC1��l7ASv*|%4��F`(�a1\r�	!���^�2Q�|%�O3���v��K��s��fSd��kXjya��t5��XlF�:�ډi��x���\\�F�a6�3���]7��F	�Ӻ��AE=�� 4�\\�K�K:�L&�QT�k7��8��KH0�F��fe9�<8S���p��NÙ�J2\$�(@:�N��\r�\n�����l4��0@5�0J���	�/�����㢐��S��B��:/�B��l-�P�45�\n6�iA`Ѝ�H �`P�2��`��H�Ƶ�J�\r҂���p�<C�r��i8�'C�z\$�/m��1�Q<,�EE�(AC|#BJ�Ħ.8���3��>�q�bԄ�\"l��ME�-J����b鄁�\\��c!�`P��� �#�떠��1�-JR���X�ͯ�k�9��24�#ɋT�������:���-t�1��7e�x]GQCYgWv�3i��e�,�H��b�t\"��戋c��<��h�0��8�\n�z![��P�%�F���:|��Ú}�I8�:�ê�����ׅ��3���zv9����Ǎ�ܑ>:,8A\"}k��#�4�h���a:5�c�]58،��#�3Fb��#!\0��؁p@#\$�k2�S�\$�~O��k,�9&~�;y�b��#\"��ФQ�*xz|�ԉd:��\\Z�Z�x����3���^�X����8G��^^,��\"�}������*��2�`@6/��hz*1<�9��J��3q�2՗�r\r�\\C�������;G�qb̳igq�\"4���9�Ax^;�u����rJ3���.&2���C�})��`�]#�BhT��ك�(7\$u^R�q���d��=b܉2>V���\$.��2A3\n�6r`G�i�=m���.ɠKheb������D��ͶBYC�y\$&L5�2P(n@�\\��#���/ a@\$�b\n/ Dt�����U�T�}��T��ln���2�Ơ��*hZ%�#cJx.XO�g:E�A,%�~\n����riЀ6�\$	a8i\$䤕�9L!d,���׎��� ,0X�&nc�v�\rF�=��\n�q蓘�3`x n��9x���\0r�D���lOxyd.y�����;�e�<��0xS\n����ge%���dE�g���E��lST���JA��u!��A4q�4��Ġ�`�\"�\$\r�ɒ)�5�{F\naD&:�(f��9&z*s~}X�OA�\rR�c�F���cD��F�KR2/���+��(t�riRQL����A&�ؔF��Rx#P)XBT�2F��'�1�{p���\"k�K\r��%��\r4�T*`Z�o�%���>��B��;(�k��ɜ-����-w�Q�Jf�K�s=�dٮ���\r��(#�YRA���������U'L��0�Q�0�����oCH0��@ș\$�.�X��x�N�1�J������\"�Q�C�%�g멄V�1t���w�r�K�t�L�8��؂�k}����7��	n3�/��@�";break;case"uk":$h="�I4�ɠ�h-`��&�K�BQp�� 9��	�r�h-��-}[��Z����H`R������db��rb�h�d��Z��G��H�����\r�Ms6@Se+ȃE6�J�Td�Jsh\$g�\$�G��f�j>���C��f4����j��SdR�B�\rh��SE�6\rV�G!TI��V�����{Z�L����ʔi%Q�B���vUXh���Z<,�΢A��e�����v4��s)�@t�NC	Ӑt4z�C	��kK�4\\L+U0\\F�>�kC�5�A��2@�\$M��4�TA��J\\G�OR����	�.�%\nK���B��4��;\\��\r�'��T��SX5���5�C�����7�I�����{���0��8HC���Y\"Ֆ�:�F\n*X�#.h2�B�ِ)�7)�䦩��Q\$��D&j��,Úֶ�Kz��%˻J���A�Q\$�B22;`ՠс� ��N��R�4J2l��2R�?\n7���TE/d���&�\$��A+��\"<O+�>��p7W�B�`�V\0�<;�p�4��r�P��� ��\r2�	�̍T�8�Ҍ��욲�(�b4Q����]	�x�)�a��dҺ��T�C)]��c\"�,Ix�Pv�a��y\\��d_S\"4��PH�� g��7�D5e�4X�\n8Zݡ(թ3\\�E*�E�l�Oh|h��F��\n���h�0�-u0ZA�J��?�n]�N\r��%r��N��įk�A�)j��?L�����&���J���*NöK��͈�����4;�s��{B��7|b�����\r��>�1�ZSiF�oY�th�GOj(ҘZ�Axu���<]�C�Z�C`�9N�0�N@�3�d@2�pz��U���\n�{�����@:�è�1����:��\0�7��\0�0�~��3��A��l@:��@�\nKY�r*����R�u�9�\\A�.��Ep#�+��h���	X�-dG�dJ�Sm����b��s��*Tfu�2��=�\0��nG)�1��� ���<��Ag@�\"�@�8<�=���*dS��4�TDbaE�!,���]R�aR�`�6%���.\\d�͔�2���'�5!咔�RJ��<\0��R�J���'E\0��p`����'�pa�=����(n�2T����s�\$6��eHt�Qq`K���Q�!�5��ғ��ܗ1x��A.�Z�S!�����z��I]�p�C@�rc��Ds��C���)pf��-�W��_[�F��y�F��HK��Cb~`Fl۟�D����]�@�Ғ�Ÿ \n (�����U��pS��')�er&r�5�tw*\">5'&hbJ�A �����b�\\�ӞtN�eaI49C�x�BJ��;ԨC�ۡLk���b��И�\"8�֨)��>��}B��{�(��CzH롽Rq��):vRM����@��ctgKĪ5�`o�jw+�]>���E����4�����n�'��<��N�J��6��G�I��4\r��9�T��=M����C�!S2�����	�L*34K��=,��2�,��-�*�ϸ��,�֎���/d�\n�4�D9n�S.�� %�੠t^4M�8h1�nv�\\�01���Q	��3T�@t\"`F\n�C� @e�N�����rq��UZ��j��T��;�#��)�JhiQ[�x�_b�FPV<k�	�\n��ݐ�Vo�z�����������6|v�-�G%0x_�r1�9�?���a��A\r��V� ��d�����Tԃ��̌L��)�������l;IS��p�0-\"��BO��7N]b�Ҧ�W+y�F�]��Z�X�i�/��SnƬT�j*�q֗7�eH��;�M�\$���k~�/��6&��߁��Bl�\r!�<��N]HCa������,���%7\r�*�J��b� �2��a�+lM�@��m�nI�)=Y��t\$!��n\\��ŀ���mG� o����)�\\�t�F�I��f���0}S�h(�藰�[M�&��L���-C��\na��N*��1�v�*(J�\rN���ќS�f�C-l�}���.��4b>����M[5��r���*D";break;case"vi":$h="Bp��&������ *�(J.��0Q,��Z���)v��@Tf�\n�pj�p�*�V���C`�]��rY<�#\$b\$L2��@%9���I�����Γ���4˅����d3\rF�q��t9N1�Q�E3ڡ�h�j[�J;���o��\n�(�Ub��da���I¾Ri��D�\0\0�A)�X�8@q:�g!�C�_#y�̸�6:����ڋ�.���K;�.���}F��ͼS0��6�������\\��v����N5��n5���x!��r7���C	��1#�����(�͍�&:����;�#\"\\!�%:8!K�H�+�ڜ0R�7���wC(\$F]���]�+��0��Ҏ9�jjP��e�Fd��c@��J*�#�ӊX�\n\npE�ɚ44�K\n�d����@3��&�!\0��3Z���0�9ʤ�H�Ln1\r��?!\0�7?�wBTX�<�8�4���0�(�T43�JV� %h��S�*l����΢mC)�	Rܘ���A���D�,����B�E�*iT\$�E0�1PJ2/#�\"aH�M���Zv�kR������R�R�CpT�&DܰE�^��G^��I�`P���2�h��Uk+�i�pD��h�4��N]�3;'I)�O<�`Uj�S#Y�T1B>6�Z�mx�O1[#��P+�	�ht)�`P�<�Ⱥ��hZ2�P���l�.́Cb�#{40�P�3�c�2��aC3a��Of;����k��Z�x�8���|�C���[46E�`@��s2:�p����Y�8a�PP�ʌ;,�s���(b�)ۨ��q4�a�3�H1J5�EX�dr;��C�P3�cE05��5\n:�k��2\r���t��2>�\0x�����J@D�C����^0��p��ԩQ@�Jjw HP�~:u�`W\r�tJh�H�]\n�`�U�0p�U0Z����{��:@���/�����p.?!��xJ���\r���0|a�Q\$Ȣ>���L�����r�BE�I�2�ȚRh��0�ä*݊��Á�x��6�U�C2�Q��:�0��0u���7��	�4@h�.�V��tQ!�KB���\$CE���T�h�w=�n���H\n�t�<%��3HD�7��.�pe���I���I�P!�/9\$���AQ�6x�R�� oE��<Ђ�j�Qk�]!�8�J����;����\nM��|Z��.����%1'�\"\$H����vd��\\H�ykG���(��k5@�t� d���yo6P��:��,l@RQ�X~ړb3\$�BXO\naPӇV��	�`n&�%�L!�.&�䝜R{8���\"��K%��S ���fq\0���n�@8�tU�5.�\n�`�\$��p�����1�	'��j\$I��\"	���qX�۬up:Vt�tLIH%�ELR�	�ai�]�T��� ��Ej��߁�m��%xrHI�G���WX��߫m���X�Ԕ�� U\n���ܐ�\\���ș:\"ͫ~�dx���WZ�`='(��2�t̥vAD:��I�U�0�U��(��U��5�W�Vlh�fl��V��+����QZ��f���-��%��� ��K�GI@�@�'V:.�hn:ᆫN%F]6m��+t��\"�]��ۑ��)�EVl�T<:�������K�bf��_��";break;case"zh":$h="�^��s�\\�r����|%��:�\$\nr.���2�r/d�Ȼ[8� S�8�r�!T�\\�s���I4�b�r��ЀJs!Kd�u�e�V���D�X,#!��j6� �:�t\nr���U:.Z�Pˑ.�\rVWd^%�䌵�r�T�Լ�*�s#U�`Qd�u'c(��oF����e3�Nb�`�p2N�S��ӣ:LY�ta~��&6ۊ��r�s���k��{��6�������c(��2��f�q�ЈP:S*@S�^�t*���ΔT���^\\�nNG#y�j\"5M��9�� ��2�x�m8���c�9����ڼź\0�>A~L���6s%I�X��ˊ�:��M(�bx���d�*�b�K��aL��K#�s��X�g)<��<v��q>s��K���tFC���D�!zH�\$��C�*r�e��^�@P�׶L��ѿ���:��8A<��(�ՍØ�7Э��K�����/�)3GHr*F�ys�\n�L�%�*ݜ�as�}F�)v]I�C���vtI`��L�!pH�A�ZH�9i8����B(e�s��rZG0���,��QP�L�I\0D��YS!�� t�Er����)�C��vt�M��B^g)H���KZ�\$\r�y'Ѷ�s��j�	@t&��Ц)�B��\"�\\6��p�2W5�uV,M�6��Ǆ�ʍ�0�6;�+j�)�QCI>'1fT\$��*\r���0���@:У��1�C��:��\0�7����4���0���m�8@6���VaN��ɤ@@!�b��\$�!�D����C��f�ѧ)J�Z^�@H���O���\$�4c4�:���@ �����mC��@,�v3���4�:;�8x�!�j)�;��P�)!��^[�|i,XU(���V930�*9V��4�p�gڍ�r4���9�Ax^;�p���/���xe\r�A�%�{�`�\$���g�l�\r�v�MhoV�����eCJ?MMՆ����J�V��B��B.�@�d\$W���K�!��B��g�b2���: �U�a�}5����`lM����ZiA�a��\0��`�i!�9�2�\\�\"&E�����%z�T��\0�iD�G�S�CAG!�\$�5����4�`��<h*�A��:3^�P\\cla�H��\"(�����l!^q.&���RnND\";¸Z�#ʲ��O.@��`I\"a�@ҭL�@��\r��F�Èu4H,3�����|�E�Ɓ\"ėBF�E\nATO�u	�L*G�)	\\��H��Ѐ��^��~��H�ZkTr�<.�!�1�@1�F��{�g �1���Q	��3H�@g]�F\n��+P���p��Y�(�C<�RB�r9�ً.�0s	�h�)�8�D��Pi�1.���Ԃ\n#ĺ_U��X�Q&#d+5\r��1�\0����v��1�)���i�Z�P�G�k�Aq	���0-	��Lc�m[�t�0r��xtLaN#���.�Ry��uA6�ֶZ&Jz�-Y��%Qq\"��)�{a��9�I���#���9B�s	Asd(��0&QjO�@ *޿���E�\"u8ʢ#�h�s���1�'�5�\"0�S?\$�h�=0)�!�=����E��2�YB�{-eynڱ�� ���*\0";break;case"zh-tw":$h="�^��%ӕ\\�r�����|%��u:H�B(\\�4��p�r��neRQ̡D8� S�\n�t*.t�I&�G�N��AʤS�V�:	t%9��Sy:\"<�r�ST�,#!��j6�1uL\0�����U:.��I9���B��K&]\nD�X�[��}-,�r����������&��a;D�x��r4��&�)��s3�S���t�\r�A��b���E�E1��ԣ�g:�x�]#0,'}üb1Q�\\y\0�V��E<���g��S� )ЪOLP\0��Δ�MƼ��� 2��F��׶����{N͍�@9�����;��#ttn�z�>��D�ql����@g1&Z%�)�T'9jB\nC\"�%)n�j�\"����d�Co{@�IBO���s�Ā���*�O���t�ě��\$d���lY�\nr�%�\0J�B#h۴��P�?t��)�>���`7cH�B7P�.���[W��ʬr���L��)^C kA�L�iqJ����\\���BB�n�O%RM��x�C�`aH<��S8��\\v8j��ℷ��vs�|�s����GG)tG�I�|���Z:^��	\\ED=�M�%i t�e��[=��t�S�\\Zd�����ZW��)]%��5��q�n�7��]�̉�G�ʢ�\$	К&�B��c�T<��p�6�� �u]������6��\$���\r�0�6;�+tr���RH�A�a���΍��<��:�cN9�è�\r�x��acR9k��0�����k�:�u�t�#D��F��)�H�5��r�gIF�4�y0���Kѹ�D�U�2\"�.��4�:Ю�@ �������B���@,��3���,�:;�8x�!�t)�t3�GIGJ�a�r\\��Ռ��6�=	B��o@�N�w}����#@�:�t�����i'��p^�`:�q�C�����I\r����[�N�� ޭ�T.1�!��]�n�=�p@9E�I t\n!V9D��>�4���D.捳�#4˪PY[���P[`lAͲ6f�ڛ�C6F�����\0c}�\\4����EH�B��`��!�.B%h���9����<Z8@��kE���2\"\nA&D!�wgK�3ƀ�CL��pr��� ��Hw�X�Ƨ�0�#�VȲVy��Iz丘'�0��@\\9\"�MK��'����2��(��W����@��[����t 6f����i�Pf?a���'f�����-���:�M1�\n<)�@@���'�a���.�B�e�|�a%�BH�*\r�Bb+H1���əP�֚�\r������\0S\n!0cFf���P(4�ݠ����q���fO��/UYuh�!�7<G���!�&š�V*�������UK�ºf���܍=��=��/E����F3��\n�Ha�?wz�4ߒA�����L+A���X��3v>�T*`Z˶�g}D���cx1�j5Ǭ�Y�;��F\0��]k��%@C\n�P����j�t�q8:	�Q�4��kf+��FB@r/��/�tx&D&Q��\"\0W\0���(	K�_ì�n��\"9۱�'�M�\"0�SI%���Q��[cڥ�\n��Y��.�X�Y�<�PK8_5㗄\\���\\*��";break;}$qg=array();foreach(explode("\n",lzw_decompress($h))as$X)$qg[]=(strpos($X,"\t")?explode("\t",$X):$X);return$qg;}if(!$qg){$qg=get_translations($ba);$_SESSION["translations"]=$qg;}if(extension_loaded('pdo')){class
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
apply_sql_function($X["fun"],$C)."</a>";echo"<span class='column hidden'>","<a href='".h($Rc.$_b)."' title='".lang(89)."' class='text'> ↓</a>";if(!$X["fun"]){echo'<a href="#fieldset-search" title="'.lang(44).'" class="text jsonly"> =</a>',script("qsl('a').onclick = partial(selectSearch, '".js_escape($z)."');");}echo"</span>";}$Cc[$z]=$X["fun"];next($M);}}$_d=array();if($_GET["modify"]){foreach($L
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