<#
.SYNOPSIS
  Sync CodeManager dark-theme files to the ZenTao running instance.
.DESCRIPTION
  Copies all custom view, control, config, CSS, and tool files from
  the dev project to the running ZenTao instance. Uses MD5 comparison
  to skip unchanged files.
.PARAMETER Mode
  dry-run: Preview what would be synced (default).
  live: Actually copy files.
.EXAMPLE
  powershell -File tools/sync-to-zen-tao.ps1 -Mode dry-run
  powershell -File tools/sync-to-zen-tao.ps1 -Mode live
#>

[CmdletBinding()]
param(
    [Parameter()]
    [ValidateSet('dry-run','live')]
    [string]$Mode = 'dry-run',

    [Parameter()]
    [string]$SourceRoot = 'D:\Workspace\project\个人项目\CodeManager',

    [Parameter()]
    [string]$TargetRoot = 'C:\ZenTao'
)

$ErrorActionPreference = 'Stop'

$files = @(
    @{Path='app\zentao\www\theme\codemanager\codemanager.css';           Desc='Main dark theme CSS'},
    @{Path='app\zentao\module\admin\control.php';                        Desc='Admin controller'},
    @{Path='app\zentao\module\bug\control.php';                          Desc='Bug controller'},
    @{Path='app\zentao\module\company\control.php';                      Desc='Company controller'},
    @{Path='app\zentao\module\doc\control.php';                          Desc='Doc controller'},
    @{Path='app\zentao\module\execution\control.php';                    Desc='Execution controller'},
    @{Path='app\zentao\module\kanban\control.php';                       Desc='Kanban controller'},
    @{Path='app\zentao\module\product\control.php';                      Desc='Product controller'},
    @{Path='app\zentao\module\project\control.php';                      Desc='Project controller'},
    @{Path='app\zentao\module\story\control.php';                        Desc='Story controller'},
    @{Path='app\zentao\module\task\control.php';                         Desc='Task controller'},
    @{Path='app\zentao\module\testcase\control.php';                     Desc='Testcase controller'},
    @{Path='app\zentao\module\testreport\control.php';                   Desc='Testreport controller'},
    @{Path='app\zentao\module\index\config.php';                         Desc='Index config (oldPages)'},
    @{Path='app\zentao\module\my\view\index.html.php';                   Desc='01-地盘-首页'},
    @{Path='app\zentao\module\admin\view\dashboard.html.php';            Desc='02-后台-首页'},
    @{Path='app\zentao\module\admin\view\security.html.php';             Desc='03-后台-安全设置'},
    @{Path='app\zentao\module\admin\view\moduleconfig.html.php';         Desc='04-后台-模块配置'},
    @{Path='app\zentao\module\product\view\browselist.html.php';         Desc='05-产品-列表'},
    @{Path='app\zentao\module\product\view\kanban.html.php';             Desc='06-产品-看板'},
    @{Path='app\zentao\module\project\view\browselist.html.php';         Desc='07-项目-列表'},
    @{Path='app\zentao\module\project\view\boardview.html.php';          Desc='08-项目-看板'},
    @{Path='app\zentao\module\project\view\detail.html.php';             Desc='09-项目-详情'},
    @{Path='app\zentao\module\execution\view\browselist.html.php';       Desc='10-执行-列表'},
    @{Path='app\zentao\module\execution\view\boardview.html.php';        Desc='11-执行-看板'},
    @{Path='app\zentao\module\execution\view\detail.html.php';           Desc='12-执行-详情'},
    @{Path='app\zentao\module\story\view\browselist.html.php';           Desc='13-需求-列表'},
    @{Path='app\zentao\module\story\view\detail.html.php';               Desc='14-需求-详情'},
    @{Path='app\zentao\module\task\view\browselist.html.php';            Desc='15-任务-列表'},
    @{Path='app\zentao\module\task\view\detail.html.php';                Desc='16-任务-详情'},
    @{Path='app\zentao\module\bug\view\browselist.html.php';             Desc='17-Bug-列表'},
    @{Path='app\zentao\module\bug\view\detail.html.php';                 Desc='18-Bug-详情'},
    @{Path='app\zentao\module\testcase\view\browselist.html.php';        Desc='19-测试-用例列表'},
    @{Path='app\zentao\module\testreport\view\browselist.html.php';      Desc='20-测试-测试单列表'},
    @{Path='app\zentao\module\testreport\view\detail.html.php';          Desc='21-测试-测试单详情'},
    @{Path='app\zentao\module\doc\view\spaceindex.html.php';             Desc='22-文档-空间首页'},
    @{Path='app\zentao\module\doc\view\browselist.html.php';             Desc='23-文档-文档列表'},
    @{Path='app\zentao\module\doc\view\detail.html.php';                 Desc='24-文档-文档详情'},
    @{Path='app\zentao\module\kanban\view\spaceindex.html.php';          Desc='25-看板-空间'},
    @{Path='app\zentao\module\kanban\view\boarddetail.html.php';         Desc='26-看板-看板详情'},
    @{Path='app\zentao\module\admin\view\formtemplate.html.php';         Desc='27-表单-创建编辑通用'},
    @{Path='app\zentao\module\company\view\index.html.php';              Desc='28-组织-首页'},
    @{Path='tools\verify-routes.js';                                     Desc='Route verification script'},
    @{Path='tools\screenshot-pages.js';                                  Desc='Screenshot capture script'}
)

$synced = 0
$skipped = 0

Write-Host "Sync-to-ZenTao  |  Mode: $Mode" -ForegroundColor Cyan
Write-Host "Source: $SourceRoot" -ForegroundColor Gray
Write-Host "Target: $TargetRoot" -ForegroundColor Gray
Write-Host ""

foreach ($entry in $files) {
    $relPath  = $entry.Path
    $desc     = $entry.Desc
    $srcFile  = Join-Path $SourceRoot $relPath
    $tgtFile  = Join-Path $TargetRoot $relPath

    if (-not (Test-Path $srcFile)) {
        Write-Host "  SKIP  $relPath  (source not found)" -ForegroundColor Yellow
        $skipped++
        continue
    }

    $srcHash = (Get-FileHash -Path $srcFile -Algorithm MD5).Hash
    $tgtHash = if (Test-Path $tgtFile) { (Get-FileHash -Path $tgtFile -Algorithm MD5).Hash } else { '' }

    if ($srcHash -eq $tgtHash) {
        Write-Host "  SAME  $relPath  [$desc]" -ForegroundColor DarkGray
        $skipped++
        continue
    }

    if ($Mode -eq 'live') {
        $tgtDir = Split-Path $tgtFile -Parent
        if (-not (Test-Path $tgtDir)) {
            New-Item -ItemType Directory -Path $tgtDir -Force | Out-Null
        }
        Copy-Item -Path $srcFile -Destination $tgtFile -Force
        Write-Host "  COPY  $relPath  [$desc]" -ForegroundColor Green
    } else {
        Write-Host "  DIFF  $relPath  [$desc] (dry-run)" -ForegroundColor Magenta
    }
    $synced++
}

Write-Host ""
Write-Host "Summary: $($synced) files differ, $($skipped) unchanged or missing" -ForegroundColor White
if ($Mode -eq 'dry-run' -and $synced -gt 0) {
    Write-Host "Run with -Mode live to apply changes." -ForegroundColor Yellow
}
