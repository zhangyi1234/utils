<?php

namespace utils\tree;
use Exception;

/**
 * 二叉树,安置网络
 */
class UserBinTree
{
	public static $instance = null;
	private $tree = null;
	public $version = null;

	private function __construct(){}

	/**
	 * 获取二叉树实例
	 * zhangyi [2023-01-30]
	 * @return UserBinTree|null
	 */
	static function getInstance(){
		if(self::$instance == null){
			self::$instance = new UserBinTree();
		}
		return self::$instance;
	}

	/**
	 * 注入二叉树的数据
	 * @param $data
	 * @param $version
	 * zhangyi [2023-01-30]
	 * @return $this
	 */
	function injectTreeData($data,$version){
		$this->tree = unserialize($data);
		$this->version = $version;
		return $this;
	}

	/**
	 * 获取二叉树的数据
	 * zhangyi [2023-01-30]
	 * @return string
	 */
	function getTreeData(){
		return serialize($this->tree);
	}

	/**
	 * 初始化二叉树 ,以及树的根节点
	 * zhangyi [2023-01-30]
	 * @return $this
	 */
	function initTreeRootNode(){
		/** @var array 用二维数据表示二叉树,里边每个节点代表一个用户 */
		$this->tree = [];

		//空节点,没有任何内容 是真正的二叉树根节点
		$nullRootNode = new UserBinTreeNode();
		$nullRootNode
			->setUserId(0)
			->setParentId(0)
			->setPosition(0)
			->setLeafNodeList([]);
		$this->tree[0] = $nullRootNode;

		return $this;
	}

	/**
	 * 二叉树中追加节点
	 * @param $type
	 * @param $memberId
	 * @param $parentId
	 * @param $position
	 * zhangyi [2023-01-30]
	 * @return UserBinTree
	 */
	function appendTreeNode($userId,$parentId,$position){
		if (array_key_exists($userId,$this->tree)){
			throw new Exception("子节点[{$userId}]已存在");
		}
		if ( ! array_key_exists($parentId,$this->tree)){
			throw new Exception("父节点[{$userId}]未找到");
		}
		if ( count($this->tree[intval($parentId)]->getLeafNodeList()) >= 2 ){
			throw new Exception("父节点[$parentId]已存在两个子节点");
		}

		//加入叶子节点
		$leafNode = new UserBinTreeNode();
		$leafNode
			->setUserId(intval($userId))
			->setParentId(intval($parentId))
			->setPosition(intval($position))
			->setLeafNodeList([]);
		$this->tree[intval($userId)] = $leafNode;

		//父节点的叶子节点中 加入新叶子节点
		$this->tree[intval($parentId)]
			->setLeafNodeList( array_merge( $this->tree[intval($parentId)]->getLeafNodeList(), [intval($userId)] ) );

		return $this;
	}




	/**
	 * 改变节点
	 * @param $treeType
	 * @param $memberId
	 * @param $parentId
	 * @param $position
	 * zhangyi [2023-01-30]
	 * @return void
	 */
	function changeTreeNode($treeType,$memberId,$parentId,$position = 0){

	}

	/**
	 * 获取一个节点的所有叶子节点 [查询网体]
	 * @param $treeType
	 * @param $treeNode
	 * zhangyi [2023-01-30]
	 * @return void
	 */
	function getAllLeafNode($treeType,$treeNode){

	}

	/**
	 * 获取一个节点的叶子节点 [查询直推]
	 * @param $treeType
	 * @param $treeNode
	 * zhangyi [2023-01-30]
	 * @return void
	 */
	function getLeafNode($treeType,$treeNode){

	}

	/**
	 * 获取一个节点的所有父节点 [查询上级链条]
	 * @param $treeType
	 * @param $treeNode
	 * zhangyi [2023-01-30]
	 * @return void
	 */
	function getAllParentNode($treeType,$treeNode){

	}

	/**
	 * 获取一个节点的直接父节点 [查询直属上级]
	 * @param $treeType
	 * @param $treeNode
	 * zhangyi [2023-01-30]
	 * @return void
	 */
	function getParentNode($leafNodeId){
		$this->tree[intval($leafNodeId)]->
	}


}