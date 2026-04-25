param (
    [string]$MYSQL_EXE,
    [string]$MYSQL_ACCOUNT,
    [string]$MYSQL_PASSWORD,
    [string]$MYSQL_PORT,
    [string]$APACHE_PORT,
    [string]$XXD_PATH,
    [string]$ZENTAO_PATH
)

function Get-Hex {
    "1", "2", "3", "4", "5", "6", "7", "8", "9", "a", "b", "c", "d", "e", "f" | Get-Random
}

$updateAesKeySql0 = "`"USE zentao; REPLACE INTO ``zt_config`` (``owner``,``module``,``section``,``key``,``value``) VALUES ('system','common','xuanxuan','key','"
$updateAesKeySql1 = "'); REPLACE INTO ``zt_config`` (``owner``,``module``,``section``,``key``,``value``) VALUES ('system','common','xuanxuan','turnon','1'); REPLACE INTO ``zt_config`` (``owner``,``module``,``section``,``key``,``value``) VALUES ('system','common','xxserver','installed','1');`""

$aesKey = '';

for ($i = 0; $i -lt 32; $i++){
    $hex = Get-Hex;
    $aesKey = $aesKey + $hex;
}

$configPath = ($XXD_PATH + "\config\xxd.conf")
$serverLine = (Get-Item -Path $configPath | Get-Content -Tail 1)

if ($serverLine -match '88888888888888888888888888888888$') { # Append default server config if has not configured before.
    Start-Process -NoNewWindow -Wait -FilePath ($MYSQL_EXE) -ArgumentList ("--user=" + $MYSQL_ACCOUNT + " --password=" + $MYSQL_PASSWORD + " --port=" + $MYSQL_PORT+ " -e " + $updateAesKeySql0 + $aesKey + $updateAesKeySql1)
    (Get-Content -Encoding utf8 $configPath) -replace 'https=on', 'https=off' | Out-File -Encoding utf8 $configPath
    Add-Content -Encoding utf8 $configPath -Value ('default = http://127.0.0.1:' + $APACHE_PORT + '/zentao/x.php,' + $aesKey)
} elseif ($serverLine -match '^default = http://127.0.0.1:\d{2,5}/zentao/x.php,') { # Update Apache port on reinstall.
    (Get-Content -Encoding utf8 $configPath) -replace '^default = http://127.0.0.1:\d{2,5}/zentao/x.php,', ('default = http://127.0.0.1:' + $APACHE_PORT + '/zentao/x.php,') | Set-Content $configPath
}
