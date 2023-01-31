<?php

use utils\tree\UserBinTree;

require_once __DIR__."/vendor/autoload.php";

//测试
$r = UserBinTree::getInstance()
	->initTreeRootNode()
	->appendTreeNode(1,0,0)
	->appendTreeNode(2,1,1)
	->appendTreeNode(3,1,2)
	->getTreeData();

$r = UserBinTree::getInstance()
	->appendTreeNode(4,2,1)
	->getTreeData();

unserialize($r);
var_dump($r);


