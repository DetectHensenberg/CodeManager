<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<iframe frameborder='0' name='hiddenwin' id='hiddenwin' scrolling='no' class='debugwin hidden'></iframe>
<?php if($this->loadModel('cron')->runnable()) js::execute('startCron()');?>
<?php if(file_exists($this->app->getBasePath() . 'www/js/codemanager.js')) js::import($this->app->getWebRoot() . 'js/codemanager.js?t=' . filemtime($this->app->getBasePath() . 'www/js/codemanager.js'));?>
<script>
<?php if(isset($pageJS)) echo $pageJS;?>
</script>
</body>
</html>
