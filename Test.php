<?php

use utils\tree\UserAnyTree;

require_once __DIR__."/vendor/autoload.php";

//测试
$r = UserAnyTree::getInstance()
	->initTreeRootNode()
	->appendTreeNode(1,0)
	->appendTreeNode(2,1)
	->appendTreeNode(3,1)
	->appendTreeNode(4,2)
	->appendTreeNode(5,4)
	->appendTreeNode(6,5)
	->appendTreeNode(7,5)
	->appendTreeNode(8,5)
	->appendTreeNode(9,7)
	->appendTreeNode(10,3)
	->appendTreeNode(11,10)
	->appendTreeNode(12,10)
	->appendTreeNode(13,11)
	->appendTreeNode(14,11)
	->getAllLeafNode(4);
//	->getAllParentNode(9);
print_r($r);
$r2 = UserAnyTree::getInstance()->getAllLeafNode(14);
print_r($r2);


UserAnyTree::getInstance()->changeTreeNode(5,11);


$r2 = UserAnyTree::getInstance()->getAllLeafNode(4);
print_r($r2);
$r2 = UserAnyTree::getInstance()->getAllLeafNode(11);
print_r($r2);



