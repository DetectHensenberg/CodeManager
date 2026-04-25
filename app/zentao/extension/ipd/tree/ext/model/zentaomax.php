<?php
/**
 * 获取单元测试用例列表树。
 * Get testtask tree menu.
 *
 * @param  int    $taskID
 * @param  int    $startModule
 * @param  array  $userFunc
 * @access public
 * @return array
 */
public function getTestTaskTreeMenu($taskID, $startModule = 0, $userFunc = array())
{
    $this->app->loadLang('branch');

    $extra['taskID'] = $taskID;

    $startModulePath = '';
    if($startModule > 0)
    {
        $startModule = $this->getById($startModule);
        if($startModule) $startModulePath = $startModule->path . '%';
    }

    /* Get module according to product. */
    $products     = $this->loadModel('testtask')->getTaskProducts($taskID);
    $products     = $this->dao->select('id, name')->from(TABLE_PRODUCT)->where('id')->in(array_keys($products))->andWhere('deleted')->eq('0')->fetchPairs();
    $branchGroups = $this->loadModel('execution')->getBranchByProduct(array_keys($products));
    $paths = $this->dao->select('DISTINCT t3.path')->from(TABLE_TESTRUN)->alias('t1')
         ->leftJoin(TABLE_CASE)->alias('t2')->on('t1.`case` = t2.id')
         ->leftJoin(TABLE_MODULE)->alias('t3')->on('t2.module = t3.id')
         ->where('t1.task')->eq($taskID)
         ->andWhere('t3.deleted')->eq(0)
         ->andWhere('t2.deleted')->eq(0)
         ->fetchPairs();
    $caseModules = array();
    foreach($paths as $path)
    {
        $modules = explode(',', $path);
        foreach($modules as $module) $caseModules[$module] = $module;
    }

    $modules    = array();
    $productNum = count($products);
    foreach($products as $id => $product)
    {
        $extra['productID'] = $id;

        $data = new stdclass();
        $data->id     = 'product-' . $id;
        $data->parent = 0;
        $data->name   = $product;
        $modules[] = $data;

        /* tree menu. */
        $tree = '';
        $branchGroups[$id][BRANCH_MAIN] = empty($branchGroups[$id]) ? '' : $this->lang->branch->main;
        foreach($branchGroups[$id] as $branch => $branchName)
        {
            $query = $this->dao->select('*')->from(TABLE_MODULE)
                 ->where('root')->eq((int)$id)
                 ->andWhere('(type')->eq('case')
                 ->orWhere('type')->eq('story')
                 ->markRight(1)
                 ->beginIF(count($branchGroups[$id]) > 1)->andWhere('branch')->eq($branch)->fi()
                 ->beginIF($startModulePath)->andWhere('path')->like($startModulePath)->fi()
                 ->andWhere('deleted')->eq(0)
                 ->orderBy('grade desc, branch, `order`, type')
                 ->get();

            $stmt = $this->dbh->query($query);
            while($module = $stmt->fetch())
            {
                /* If not manage, ignore unused modules. */
                if(isset($caseModules[$module->id]))
                {
                    $childData = $this->buildTree($module, 'case', $data->id, $userFunc, $extra);
                    if($childData) $modules[] = $childData;
                }
            }
        }
    }
    return $modules;
}
