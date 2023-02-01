<?php

namespace utils\tree;

class UserAnyTreeNode
{
	protected $id = 0;
	protected $parentId = 0;
	protected $leafIdList = [];
	protected $createdAt = null;
	protected $updatedAt = null;

	public function __construct()
	{
		$this->createdAt = date('Y-m-d H:i:s');
		$this->updatedAt = date('Y-m-d H:i:s');
		return $this;
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId( $id )
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getParentId()
	{
		return $this->parentId;
	}

	/**
	 * @param int $parentId
	 */
	public function setParentId( $parentId )
	{
		$this->parentId = $parentId;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getLeafIdList()
	{
		return $this->leafIdList;
	}

	/**
	 * @param array $leafIdList
	 */
	public function setLeafIdList( $leafIdList )
	{
		$this->leafIdList = $leafIdList;
		return $this;
	}

	/**
	 * @return false|string|null
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * @param false|string|null $createdAt
	 */
	public function setCreatedAt( $createdAt )
	{
		$this->createdAt = $createdAt;
		return $this;
	}

	/**
	 * @return false|string|null
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}

	/**
	 * @param false|string|null $updatedAt
	 */
	public function setUpdatedAt( $updatedAt )
	{
		$this->updatedAt = $updatedAt;
		return $this;
	}





}
