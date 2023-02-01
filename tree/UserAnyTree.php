<?php

namespace utils\tree;
use Exception;

/**
 * 二叉树,安置网络
 */
class UserAnyTree
{
	private static $instance = null;
	private function __construct(){}
	/**
	 * 获取实例
	 * zhangyi [2023-01-30]
	 * @return UserAnyTree|null
	 */
	static function getInstance(){
		if(self::$instance == null){
			self::$instance = new UserAnyTree();
		}
		return self::$instance;
	}


	/** @var UserAnyTreeNode[] */
	private $tree = [];
	public $version = null;

	/**
	 * 获取二叉树的数据
	 * zhangyi [2023-01-30]
	 * @return array
	 */
	function getTreeData(){
		return [serialize($this->tree),$this->version];
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
		$nullRootNode = new UserAnyTreeNode();
		$nullRootNode
			->setId(0)
			->setParentId(0)
			->setLeafIdList([]);
		$this->tree[0] = $nullRootNode;

		return $this;
	}

	/**
	 * 二叉树中追加节点 [新推荐下级]
	 * @param $type
	 * @param $memberId
	 * @param $parentId
	 * zhangyi [2023-01-30]
	 * @return UserAnyTree
	 */
	function appendTreeNode($userId,$parentId){
		if (array_key_exists(intval($userId),$this->tree)){
			throw new Exception("子节点[$userId]已存在");
		}
		if ( ! array_key_exists($parentId,$this->tree)){
			throw new Exception("父节点[$userId]未找到");
		}

		//加入叶子节点
		$leafNode = new UserAnyTreeNode();
		$leafNode
			->setId(intval($userId))
			->setParentId(intval($parentId))
			->setLeafIdList([]);
		$this->tree[intval($userId)] = $leafNode;

		//父节点的叶子节点中 加入新叶子节点
		$this->tree[intval($parentId)]
			->setLeafIdList( array_merge( $this->tree[intval($parentId)]->getLeafIdList(), [intval($userId)] ) );

		return $this;
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
	 * 修改节点 [改推荐人]
	 * @param $treeType
	 * @param $memberId
	 * @param $parentId
	 * @param $position
	 * zhangyi [2023-01-30]
	 * @return UserAnyTree
	 */
	function changeTreeNode($nodeId,$parentId){
		$oldNode = $this->tree[intval($nodeId)];
		if ( ! $oldNode ) throw new Exception("节点[$nodeId]不存在");
		if ( ! $this->tree[intval($parentId)] ) throw new Exception("父节点[$parentId]未找到");


		//原上级节点的叶子节点集合变化
		$oldLeafIdList = $this->tree[$oldNode->getParentId()]->getLeafIdList();
		$idx = array_search($nodeId,$oldLeafIdList );
		array_splice($oldLeafIdList,$idx,1);
		$this->tree[$oldNode->getParentId()]->setLeafIdList( $oldLeafIdList );

		//新上级节点的叶子节点集合变化
		$this->tree[intval($parentId)]->setLeafIdList(array_merge($this->tree[intval($parentId)]->getLeafIdList(),[intval($nodeId)]));

		//本节点上级变化
		$this->tree[intval($nodeId)]->setParentId(intval($parentId));

		return $this;
	}

	/**
	 * 获取一个节点的所有叶子节点 [查询网体] [二叉树层级遍历]
	 * @param $treeType
	 * @param $treeNode
	 * zhangyi [2023-01-30]
	 * @return array
	 */
	function getAllLeafNode($treeNodeId){
		/** @var UserAnyTreeNode[] $nodeQueue */
		$nodeQueue = [];
		$res = [];
		array_push($nodeQueue,$this->tree[intval($treeNodeId)]);

		while( count($nodeQueue) > 0 ){
			$outNode = array_shift($nodeQueue);
			//网体中不包含当前节点
			if($outNode->getId() != $treeNodeId){
				$res[] = $outNode->getId();
			}

			if ( count($outNode->getLeafIdList()) > 0 ){
				foreach ( $outNode->getLeafIdList() as $leafNodeId ) {
					array_push($nodeQueue,$this->tree[intval($leafNodeId)]);
				}
			}
		}
		return $res;
	}

	/**
	 * 获取一个节点的叶子节点 [查询直推]
	 * @param $treeType
	 * @param $treeNode
	 * zhangyi [2023-01-30]
	 * @return array
	 */
	function getLeafNode($treeNodeId){
		return $this->tree[$treeNodeId]->getLeafIdList();
	}

	/**
	 * 获取一个节点的所有父节点 [查询上级链条,不包含自己]
	 * @param $treeType
	 * @param $treeNode
	 * zhangyi [2023-01-30]
	 * @return array
	 */
	function getAllParentNode($leafNodeId){
		$leafNode = $this->tree[intval($leafNodeId)];

		$res = [];
		while (true){
			if ($leafNode->getParentId() == 0) break;

			$res[] = $this->tree[$leafNode->getParentId()]->getId();
			$leafNode = $this->tree[$leafNode->getParentId()];
		}
		return $res;
	}

	/**
	 * 获取一个节点的直接父节点 [查询直属上级]
	 * @param $treeType
	 * @param $treeNode
	 * zhangyi [2023-01-30]
	 * @return int
	 */
	function getParentNode($leafNodeId){
		return $this->tree[intval($leafNodeId)]->getParentId();
	}


}