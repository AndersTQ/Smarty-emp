<?php
	//这个一个工具类,作用是完成对数据库的操作
	class SqlHelper{
		public $conn;	// best private
		public $dbname="smartytest";
		public $username="root";
		public $password="root";
		public $host="localhost";

		public function __construct(){
			$this->conn=mysql_connect($this->host,$this->username,$this->password);
			if(!$this->conn){
				die("连接失败".mysql_error());
			}
			mysql_select_db($this->dbname,$this->conn);
		}

		//执行dql语句
		public function execute_dql($sql){
			$res=mysql_query($sql,$this->conn) or die(mysql_error());
		//	die($sql);
			return $res;
		}

		//执行dql语句，但是返回的是一个数组
		public function execute_dql2($sql){
			$arr=array();
			$res=mysql_query($sql,$this->conn) or die("查询失败 ".mysql_error());
			$i=0;
			//把$res=>$arr 把结果集内容转移到一个数组中.
			while($row=mysql_fetch_assoc($res)){
			//	$arr[$i++]=$row;
				$arr[]=$row;
			}
			//这里就可以马上把$res关闭.
			mysql_free_result($res);
			return $arr;
		}

		//考虑分页情况的查询,这是一个比较通用的并体现oop编程思想的代码
		//$sql1="select * from where 表名 limit 0,6";
		//$sql2="select count(id) from 表名"
		public function exectue_dql_fenye($fenyePage){
		//public function exectue_dql_fenye($gotoUrl2,$tableName,$fenyePage){	// $gotoUrl2,$tableName 以及 数据库 都应该封装到fenyePage对象中

			if ($fenyePage->pageNow<1) $fenyePage->pageNow=1;

		//	die($fenyePage->pageSize."xxxxxxxxxx");

		//	$sql2="select count(id) from ".$tableName;
			$sql2="select count(id) from ".$fenyePage->fenyeTable;

			$res2=mysql_query($sql2,$this->conn) or die(mysql_error());

			if($row=mysql_fetch_row($res2)){
				$fenyePage->pageCount=ceil($row[0]/$fenyePage->pageSize);
				if ($fenyePage->pageNow>$fenyePage->pageCount) $fenyePage->pageNow=$fenyePage->pageCount;
				$fenyePage->rowCount=$row[0];
			}
			mysql_free_result($res2);

		//	$sql1="select * from ".$tableName." limit "
			$sql1="select * from ".$fenyePage->fenyeTable." limit ".($fenyePage->pageNow-1)*$fenyePage->pageSize.",".$fenyePage->pageSize;

			//这里我们查询了要分页显示的数据
			$res=mysql_query($sql1,$this->conn) or die(mysql_error());
			//$res=>array()
			$arr=array();
			//把$res转移到$arr
			while($row=mysql_fetch_assoc($res)){
				$arr[]=$row;
			}
			mysql_free_result($res);

			$this->close_connect();

		//	die($fenyePage->pageNow);

		//	if ($fenyePage->pageNow>$fenyePage->pageCount) $fenyePage->pageNow=$fenyePage->pageCount;
			//把导航信息也封装到fenyePage对象中
			$navigate="<br/>";
			if ($fenyePage->pageNow>1){
				$prePage=$fenyePage->pageNow-1;
				$navigate.="<a href='{$fenyePage->goUrl}?pageNow=$prePage'>上一页</a>&nbsp;";
			}

			if(empty($pageNow)) $pageNow=$fenyePage->pageNow;
			if(empty($pageCount)) $pageCount=ceil($fenyePage->pageCount);
			$page_whole=10;
			$start=floor(($pageNow-1)/$page_whole)*$page_whole+1;
			$index=$start;
		/*	if($pageNow<1) header("Location: {$fenyePage->goUrl}?pageNow=$pageCount");
			if($pageNow>$pageCount) header("Location: {$fenyePage->goUrl}?pageNow=$pageCount");;	*/
			
			//整体每10页向前翻
			//如果当前pageNow在1-10页数，就没有向前翻动的超连接
			if($pageNow>$page_whole){
				$navigate.= "&nbsp;&nbsp;<a href='{$fenyePage->goUrl}?pageNow=".($start-1)."'>&nbsp;&nbsp;<<&nbsp;&nbsp;</a>";
			}
			//定$start 1---》10  floor((pageNow-1)/10)=0*10+1   11->20   floor((pageNow-1)/10)=1*10+1 21-30 floor((pageNow-1)/10)=2*10+1
			if($pageNow+$page_whole-1<=$pageCount)		$max_page=$index+$page_whole; 
			else{
				$max_page= $pageCount+1;
			//	die($max_page);
				if($max_page>$start+$page_whole) $max_page=$index+$page_whole;
			}
			for(;$start<$max_page;$start++){
				$navigate.= "<a href='{$fenyePage->goUrl}?pageNow=$start'>[$start]</a>";
			}

			if($pageNow<=floor($pageCount/$page_whole)*$page_whole )
				//整体每10页翻动
				$navigate.= "&nbsp;&nbsp;<a href='{$fenyePage->goUrl}?pageNow=$start'>&nbsp;&nbsp;>>&nbsp;&nbsp;</a>";



			if($fenyePage->pageNow<$fenyePage->pageCount){
				$nextPage=$fenyePage->pageNow+1;
				$navigate.="<a href='{$fenyePage->goUrl}?pageNow=$nextPage'>下一页</a>&nbsp;";
			}

			//显示当前页和共有多少页
			$navigate.= " &nbsp;&nbsp; 当前页{$pageNow}/共{$pageCount}页<br/>";

			$navigate.= '<br/><form action="'.$fenyePage->goUrl.'">
					跳转到:<input type="text" name="pageNow" />
					<input type="submit" value="GO">
					</form>';

			//把$arr赋给$fenyePage
			$fenyePage->res_array=$arr;
			$fenyePage->navigator=$navigate;
		}

		//执行dml语句
		public  function execute_dml($sql){
			$b=mysql_query($sql,$this->conn) or die(mysql_error());
			if(!$b){
				return 0;
			}else{
				if(mysql_affected_rows($this->conn)>0){
					return 1;//表示执行ok
				}else{
					return 2;//表示没有行受到影响
				}
			}
		}

		//关闭连接的方法
		public function close_connect(){
			if(!empty($this->conn))	mysql_close($this->conn);
		}
	}
?>