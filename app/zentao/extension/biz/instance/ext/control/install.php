<?php
helper::importControl('instance');
class myInstance extends instance
{
    /**
     * @param int $appID
     * @param string $checkResource
     */
    public function install($appID, $checkResource = 'true')
    {
        if(!empty($_POST))
        {
            form::data($this->config->instance->form->install)->get();

            $this->buildCustomConfig($appID);
            $this->checkCustomFields($appID);
            if(dao::isError()) return $this->sendError(dao::getError());

            if(!empty($this->config->instance->form->install->custom))
            {
                $this->config->instance->form->install = array_merge($this->config->instance->form->install, $this->config->instance->form->install->custom);
            }
        }
        parent::install($appID, $checkResource);
    }
public function __construct($moduleName = '', $methodName = '')
{
    parent::__construct($moduleName, $methodName);
$runVersion = 'biz13.1';

    if(function_exists('ioncube_license_properties')) $properties = ioncube_license_properties();
$contactEmail  = !empty($properties['email']['value'])  ? $properties['email']['value']  : 'co@zentao.net';
$contactMobile = !empty($properties['mobile']['value']) ? $properties['mobile']['value'] : '4006 889923';
$contactQQ     = !empty($properties['qq']['value']) ? $properties['qq']['value'] : 'co@zentao.net';
if($this->app->getModuleName() != 'upgrade')
{
    $user = $this->dao->select("COUNT('*') as `count`")->from(TABLE_USER)
        ->where('deleted')->eq(0)
        ->fetch();
    if(!empty($properties['user']) and $properties['user']['value'] < $user->count) die(" <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dli'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <title>Error</title>
</head>
<body>
<h2 style='color:red;text-align:center'>用户人数超出限制</h2>
您版本的用户数是{$properties['user']['value']}，您目前系统中已有{$user->count}人，已经超过了限制，请联系我们增加人数授权。<br />
Email：<a href='mailto:$contactEmail'>$contactEmail</a><br />
手机：13730922971<br />
电话：$contactMobile<br />
QQ：$contactQQ<br />
微信：13730922971<br />
网址：<a href='http://www.zentao.net/goto.php?item=buybiz'>www.zentao.net</a><br />
<br /><br /><br />
<h2 style='color:red;text-align:center'>Users Count Exceeded</h2>
The number of users is more than {$properties['user']['value']} as licensed. Please contact us to get more licenses.<br />
email:<a href='mailto:support@zentaoalm.com'>support@zentaoalm.com</a><br />
Web:<a href='http://www.zentao.pm'>www.zentao.pm</a><br />
</body>
</html>");
}

if(!empty($properties['version']['value']) and !defined('IN_UPGRADE'))
{
    if(!isset($runVersion)) $runVersion = $this->config->version;
    $authorizedVersion = $properties['version']['value'];
    $isAuth = $runVersion == $authorizedVersion;
    if(!$isAuth && $this->config->edition != 'biz')
    {
        $this->app->loadLang('upgrade');
        $this->app->loadConfig('upgrade');
        $openRunVersion    = zget($this->config->upgrade->bizVersion, str_replace('.', '_', $runVersion), $runVersion);
        $openAuthedVersion = $authorizedVersion;
        if($this->config->edition == 'max') $openAuthedVersion = zget($this->config->upgrade->maxVersion, str_replace('.', '_', $authorizedVersion), $authorizedVersion);
        if($this->config->edition == 'ipd') $openAuthedVersion = zget($this->config->upgrade->ipdVersion, str_replace('.', '_', $authorizedVersion), $authorizedVersion);
        $isAuth = $openRunVersion == $openAuthedVersion;
    }
    if(!$isAuth) die(" <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dli'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <title>Error</title>
</head>
<body>
<h2 style='color:red;text-align:center'>没有授权此版本</h2>
您版本授权的版本是{$properties['version']['value']}，当前使用的版本是{$runVersion}，请联系我们重新购买授权。<br />
Email：<a href='mailto:$contactEmail'>$contactEmail</a><br />
手机：13730922971<br />
电话：$contactMobile<br />
QQ：$contactQQ<br />
微信：13730922971<br />
网址：<a href='http://www.zentao.net/goto.php?item=buybiz'>www.zentao.net</a><br />
<br /><br /><br />
<h2 style='color:red;text-align:center'>This version is not licensed.</h2>
The licensed version is {$properties['version']['value']}. You are using {$runVersion}. Please contact us to buy the right licenses.<br />
email:<a href='mailto:support@zentaoalm.com'>support@zentaoalm.com</a><br />
Web:<a href='http://www.zentao.pm/'>www.zentao.pm/</a><br />
</body>
</html>");
}

if(!empty($properties['edition']['value']) and !defined('IN_UPGRADE'))
{
    if($properties['edition']['value'] != $this->config->edition) die(" <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dli'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <title>Error</title>
</head>
<body>
<h2 style='color:red;text-align:center'>没有授权此版本</h2>
您版本授权的版本是{$properties['edition']['value']}，当前使用的版本是{$this->config->edition}，请联系我们重新购买授权。<br />
Email：<a href='mailto:$contactEmail'>$contactEmail</a><br />
手机：13730922971<br />
电话：$contactMobile<br />
QQ：$contactQQ<br />
微信：13730922971<br />
网址：<a href='http://www.zentao.net/goto.php?item=buybiz'>www.zentao.net</a><br />
<br /><br /><br />
<h2 style='color:red;text-align:center'>This version is not licensed.</h2>
The licensed version is {$properties['edition']['value']}. You are using {$this->config->edition}. Please contact us to buy the right licenses.<br />
email:<a href='mailto:support@zentaoalm.com'>support@zentaoalm.com</a><br />
Web:<a href='http://www.zentao.pm/'>www.zentao.pm/</a><br />
</body>
</html>");
}

if(!empty($properties['domain']))
{
    $host    = $_SERVER['HTTP_HOST'];
    $portPos = strrpos($host, ':');
    if($portPos !== false)
    {
        $port = substr($host, $portPos + 1);
        if(is_numeric($port)) $host = substr($host, 0, $portPos);
    }
    $host .= $_SERVER['REQUEST_URI'];

    $checkHost  = false;
    $allowHosts = explode(',', $properties['domain']['value']);
    foreach($allowHosts as $allowHost)
    {
        if(strpos($host, $allowHost) !== false)
        {
            $checkHost = true;
            break;
        }
    }
    if(!$checkHost) die(" <!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dli'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
  <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
  <title>Error</title>
</head>
<body>
<h2 style='color:red;text-align:center'>绑定域名访问错误</h2>
您版本绑定的信息与您当前访问的地址不一致，如果有问题，请联系我们修改绑定信息。<br />
Email：<a href='mailto:$contactEmail'>$contactEmail</a><br />
手机：13730922971<br />
电话：$contactMobile<br />
QQ：$contactQQ<br />
微信：13730922971<br />
网址：<a href='http://www.zentao.net/goto.php?item=buybiz'>www.zentao.net</a><br />
<br /><br /><br />
<h2 style='color:red;text-align:center'>Domain Error</h2>
The information bound to your version does not match the address you are currently accessing. If there is a problem, please contact us to modify the binding information.<br />
email:<a href='mailto:support@zentaoalm.com'>support@zentaoalm.com</a><br />
Web:<a href='http://www.zentao.pm'>www.zentao.pm</a><br />
</body>
</html>");
};
}
}
