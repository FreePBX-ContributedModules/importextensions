<?php
require_once "/var/www/html/admin/functions.inc.php";
require_once "/var/www/html/admin/modules/core/functions.inc.php";
$amp_conf = parse_amportal_conf("/etc/amportal.conf");
$asterisk_conf = parse_asterisk_conf("/etc/asterisk/asterisk.conf");
require_once "/var/www/html/admin/common/php-asmanager.php";
require_once "/var/www/html/admin/header_auth.php";

if ( $_REQUEST["csv_uploaded"] ) {

    $aFields = array ( 
      "display" => array(false, -1),
      "tech" => array(false, -1),
      "action" => array(false, -1),
      "extdisplay" => array(false, -1),
      "extension" => array(false, -1),
      "description" => array(false, -1),
      "devicetype" => array(false, -1),
      "deviceuser" => array(false, -1),
      "password" => array(false, -1),
      "directdid" => array(false, -1),
      "didalert" => array(false, -1),
      "outboundcid" => array(false, -1),
      "emergency_cid" => array(false, -1),
      "record_in" => array(false, -1),
      "record_out" => array(false, -1),
      "devinfo_secret" => array(false, -1),
      "devinfo_dtmfmode" => array(false, -1),
      "devinfo_canreinvite" => array(false, -1),
      "devinfo_context" => array(false, -1),
      "devinfo_host" => array(false, -1),
      "devinfo_type" => array(false, -1),
      "devinfo_nat" => array(false, -1),
      "devinfo_port" => array(false, -1),
      "devinfo_qualify" => array(false, -1),
      "devinfo_callgroup" => array(false, -1),
      "devinfo_pickupgroup" => array(false, -1),
      "devinfo_disallow" => array(false, -1),
      "devinfo_allow" => array(false, -1),
      "devinfo_dial" => array(false, -1),
      "devinfo_accountcode" => array(false, -1),
      "devinfo_mailbox" => array(false, -1),
      "vm" => array(false, -1),
      "vmpwd" => array(false, -1),
      "email" => array(false, -1),
      "pager" => array(false, -1),
      "attach" => array(false, -1),
      "saycid" => array(false, -1),
      "envelope" => array(false, -1),
      "delete" => array(false, -1),
      "options" => array(false, -1),
      "vmcontext" => array(false, -1),
      "name" => array(false, -1),
    );
    
$fh = fopen($_FILES['csvFile']['tmp_name'], "r");
while (($aInfo = fgetcsv($fh, 1000, ",")) !== FALSE) 
    {
        if ( empty($aInfo[0]) ) {
          continue;
        }
        //If this is the first row then we need to check each fields listed
        if ($i==0)
        {
            
            for ($j=0; $j<count($aInfo); $j++)
            {
                $aKeys = array_keys($aFields);
                
                foreach ($aKeys as $sKey)
                {
                    if ($aInfo[$j] == $sKey)
                    {
                        $aFields[$sKey][0] = true;
                        $aFields[$sKey][1] = $j;
                    }
                }
            }
            
            $i++;
            continue;
        }

        if ($aFields["name"][0]) {
                $vars["name"] = trim($aInfo[$aFields["name"][1]]);
        }
        if ($aFields["display"][0]) {
                $vars["display"] = trim($aInfo[$aFields["display"][1]]);
        }
        if ($aFields["tech"][0]) {
                $vars["tech"] = trim($aInfo[$aFields["tech"][1]]);
        }
        if ($aFields["action"][0]) {
                $vars["action"] = trim($aInfo[$aFields["action"][1]]);
        }
        if ($aFields["extdisplay"][0]) {
                $vars["extdisplay"] = trim($aInfo[$aFields["extdisplay"][1]]);
        }
        if ($aFields["extension"][0]) {
                $vars["extension"] = trim($aInfo[$aFields["extension"][1]]);
        }
        if ($aFields["description"][0]) {
                $vars["description"] = trim($aInfo[$aFields["description"][1]]);
        }
        if ($aFields["devicetype"][0]) {
                $vars["devicetype"] = trim($aInfo[$aFields["devicetype"][1]]);
        }
        if ($aFields["deviceuser"][0]) {
                $vars["deviceuser"] = trim($aInfo[$aFields["deviceuser"][1]]);
        }
        if ($aFields["password"][0]) {
                $vars["password"] = trim($aInfo[$aFields["password"][1]]);
        }
        if ($aFields["directdid"][0]) {
                $vars["directdid"] = trim($aInfo[$aFields["directdid"][1]]);
        }
        if ($aFields["didalert"][0]) {
                $vars["didalert"] = trim($aInfo[$aFields["didalert"][1]]);
        }
        if ($aFields["outboundcid"][0]) {
                $vars["outboundcid"] = trim($aInfo[$aFields["outboundcid"][1]]);
        }
        if ($aFields["emergency_cid"][0]) {
                $vars["emergency_cid"] = trim($aInfo[$aFields["emergency_cid"][1]]);
        }
        if ($aFields["record_in"][0]) {
                $vars["record_in"] = trim($aInfo[$aFields["record_in"][1]]);
        }
        if ($aFields["record_out"][0]) {
                $vars["record_out"] = trim($aInfo[$aFields["record_out"][1]]);
        }
        if ($aFields["devinfo_secret"][0]) {
                $vars["devinfo_secret"] = trim($aInfo[$aFields["devinfo_secret"][1]]);
        }
        if ($aFields["devinfo_dtmfmode"][0]) {
                $vars["devinfo_dtmfmode"] = trim($aInfo[$aFields["devinfo_dtmfmode"][1]]);
        }
        if ($aFields["devinfo_canreinvite"][0]) {
                $vars["devinfo_canreinvite"] = trim($aInfo[$aFields["devinfo_canreinvite"][1]]);
        }
        if ($aFields["devinfo_context"][0]) {
                $vars["devinfo_context"] = trim($aInfo[$aFields["devinfo_context"][1]]);
        }
        if ($aFields["devinfo_host"][0]) {
                $vars["devinfo_host"] = trim($aInfo[$aFields["devinfo_host"][1]]);
        }
        if ($aFields["devinfo_type"][0]) {
                $vars["devinfo_type"] = trim($aInfo[$aFields["devinfo_type"][1]]);
        }
        if ($aFields["devinfo_nat"][0]) {
                $vars["devinfo_nat"] = trim($aInfo[$aFields["devinfo_nat"][1]]);
        }
        if ($aFields["devinfo_port"][0]) {
                $vars["devinfo_port"] = trim($aInfo[$aFields["devinfo_port"][1]]);
        }
        if ($aFields["devinfo_qualify"][0]) {
                $vars["devinfo_qualify"] = trim($aInfo[$aFields["devinfo_qualify"][1]]);
        }
        if ($aFields["devinfo_callgroup"][0]) {
                $vars["devinfo_callgroup"] = trim($aInfo[$aFields["devinfo_callgroup"][1]]);
        }
        if ($aFields["devinfo_pickupgroup"][0]) {
                $vars["devinfo_pickupgroup"] = trim($aInfo[$aFields["devinfo_pickupgroup"][1]]);
        }
        if ($aFields["devinfo_disallow"][0]) {
                $vars["devinfo_disallow"] = trim($aInfo[$aFields["devinfo_disallow"][1]]);
        }
        if ($aFields["devinfo_allow"][0]) {
                $vars["devinfo_allow"] = trim($aInfo[$aFields["devinfo_allow"][1]]);
        }
        if ($aFields["devinfo_dial"][0]) {
                $vars["devinfo_dial"] = trim($aInfo[$aFields["devinfo_dial"][1]]);
        }
        if ($aFields["devinfo_accountcode"][0]) {
                $vars["devinfo_accountcode"] = trim($aInfo[$aFields["devinfo_accountcode"][1]]);
        }
        if ($aFields["devinfo_mailbox"][0]) {
                $vars["devinfo_mailbox"] = trim($aInfo[$aFields["devinfo_mailbox"][1]]);
        }
        if ($aFields["vm"][0]) {
                $vars["vm"] = trim($aInfo[$aFields["vm"][1]]);
        }
        if ($aFields["vmpwd"][0]) {
                $vars["vmpwd"] = trim($aInfo[$aFields["vmpwd"][1]]);
        }
        if ($aFields["email"][0]) {
                $vars["email"] = trim($aInfo[$aFields["email"][1]]);
        }
        if ($aFields["pager"][0]) {
                $vars["pager"] = trim($aInfo[$aFields["pager"][1]]);
        }
        if ($aFields["attach"][0]) {
                $vars["attach"] = trim($aInfo[$aFields["attach"][1]]);
        }
        if ($aFields["saycid"][0]) {
                $vars["saycid"] = trim($aInfo[$aFields["saycid"][1]]);
        }
        if ($aFields["envelope"][0]) {
                $vars["envelope"] = trim($aInfo[$aFields["envelope"][1]]);
        }
        if ($aFields["delete"][0]) {
                $vars["delete"] = trim($aInfo[$aFields["delete"][1]]);
        }
        if ($aFields["options"][0]) {
                $vars["options"] = trim($aInfo[$aFields["options"][1]]);
        }
        if ($aFields["vmcontext"][0]) {
                $vars["vmcontext"] = trim($aInfo[$aFields["vmcontext"][1]]);
        }
	$_REQUEST = $vars;
	 voicemail_mailbox_add($mbox, $vars);
	 core_devices_add($vars["extension"],$vars["tech"],$vars["devinfo_dial"],$vars["devicetype"],$vars["deviceuser"],$vars["description"],$vars["emergency_cid"]);
	 #core_devices_addsip($vars["extension"]);
         core_users_add($vars,$vars["vmcontext"]);
	print "Added: " . $vars["extension"] . "<BR>";
	needreload();
        #redirect_standard_continue();

    }
} else {
?>
<p>Right click -> Save as : <a href="modules/importextensions/template.csv">Template CSV</a><br><br>
<form action="<?php $_SERVER['PHP_SELF'] ?>" name="uploadcsv" method="post" enctype="multipart/form-data">
Choose Account CSV File: <input name="csvFile" type="file">
<input name="csv_uploaded" type="hidden" value="1">
<input type="submit" value="Import!">
</form>
<?php
}
?>
