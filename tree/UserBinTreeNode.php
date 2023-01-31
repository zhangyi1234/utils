<?php

namespace utils\tree;

class UserBinTreeNode
{
	protected $userId = 0;
	protected $parentId = 0;
	protected $position = 0;
	protected $leafNodeList = [];
	protected $createdAt;
	protected $updatedAt;

	public function __construct()
	{
		$this->createdAt = date('Y-m-d H:i:s');
		$this->updatedAt = date('Y-m-d H:i:s');
		return $this;
	}


	/**
	 * @return mixed
	 */
	public function getUserId()
	{
		return $this->userId;
	}

	/**
	 * @param mixed $userId
	 */
	public function setUserId( $userId )
	{
		$this->userId = $userId;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getParentId()
	{
		return $this->parentId;
	}

	/**
	 * @param mixed $parentId
	 */
	public function setParentId( $parentId )
	{
		$this->parentId = $parentId;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getPosition()
	{
		return $this->position;
	}

	/**
	 * @param mixed $position
	 */
	public function setPosition( $position )
	{
		$this->position = $position;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getLeafNodeList()
	{
		return $this->leafNodeList;
	}

	/**
	 * @param mixed $leafNodeList
	 */
	public function setLeafNodeList( $leafNodeList )
	{
		$this->leafNodeList = $leafNodeList;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * @param mixed $createdAt
	 */
	public function setCreatedAt( $createdAt )
	{
		$this->createdAt = $createdAt;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getUpdatedAt()
	{
		return $this->updatedAt;
	}

	/**
	 * @param mixed $updatedAt
	 */
	public function setUpdatedAt( $updatedAt )
	{
		$this->updatedAt = $updatedAt;
		return $this;
	}



}
