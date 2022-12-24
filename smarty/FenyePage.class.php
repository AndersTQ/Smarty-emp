<?php
 //这是一个用于保存分页信息的类
 class FenyePage{
		public $pageSize=10; 
		public $res_array;  //这是显示数据
		public $rowCount;   //这是从数据库中获取
		public $pageNow=1;  //用户指定的
		public $pageCount;  //这个是计算得到的
		public $navigator;   //分页导航
		public $fenyeDb;
		public $fenyeTable;
		public $goUrl;	//表示把分页请求提交给哪个页面
		var $res="";
		var $condition="";
	/**
	 * @return unknown
	 */
	public function getNavigator() {
		return $this->navigator;
	}
	
	/**
	 * @return unknown
	 */
	public function getPageCount() {
		return $this->pageCount;
	}
	
	/**
	 * @return unknown
	 */
	public function getPageNow() {
		return $this->pageNow;
	}
	
	/**
	 * @return unknown
	 */
	public function getPageSize() {
		return $this->pageSize;
	}
	
	/**
	 * @return unknown
	 */
	public function getRowCount() {
		return $this->rowCount;
	}
	
	/**
	 * @param unknown_type $navigator
	 */
	public function setNavigator($navigator) {
		$this->navigator = $navigator;
	}
	
	/**
	 * @param unknown_type $pageCount
	 */
	public function setPageCount($pageCount) {
		$this->pageCount = $pageCount;
	}
	
	/**
	 * @param unknown_type $pageNow
	 */
	public function setPageNow($pageNow) {
		$this->pageNow = $pageNow;
	}
	
	/**
	 * @param unknown_type $pageSize
	 */
	public function setPageSize($pageSize) {
		$this->pageSize = $pageSize;
	}
	
	/**
	 * @param unknown_type $rowCount
	 */
	public function setRowCount($rowCount) {
		$this->rowCount = $rowCount;
	}
 }
?>