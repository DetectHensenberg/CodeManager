$src = "D:\Workspace\project\个人项目\CodeManager\app\zentao"
$dst = "C:\ZenTao\app\zentao"
Get-ChildItem -Path $src -Recurse -File | ForEach-Object {
    $target = $_.FullName -replace [regex]::Escape($src), $dst
    $targetDir = Split-Path $target -Parent
    if (-not (Test-Path $targetDir)) { New-Item -ItemType Directory -Force -Path $targetDir | Out-Null }
    Copy-Item $_.FullName $target -Force
}
Write-Host "Sync complete"
