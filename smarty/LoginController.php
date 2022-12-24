<?php
	require_once 'EmpModel.class.php';
	require_once '../../libs/Smarty.class.php';

	//获取用户id和密码
	$admid=@$_POST['adminid'];
	$passwd=@$_POST['passwd'];

//	echo $admid."  --  ".$passwd;
	// 这里应当去数据库去验证
	if($admid==="110" && $passwd==="123"){
		// 如果这里有一个数组，怎样传给empList.php去显示 1)session 2)cookie很麻烦如特定格式、限制大小 3)模板技术
		$arr=array("宋江","阎婆惜");
		//这里我们如何去得到所有的用户信息
		//传统写法
		$empModel=new EmpModel;
		$arr=$empModel->showEmpList();
	//	echo "<pre>";
	//	print_r($res);
	//	echo "</pre>";

	//	这里我们使用模板结束把$arr数据分配给一个界面(tpl)
	//	1.编写一个模板文件,要放在规定的目录中 empList.tpl template
	//	2.给tpl文件分配要显示的结果集，或者是其他数据(引入smarty库，即把libs文件夹拷贝) smarty通常在控制器中使用，或其他php中用
	//  3.引入 ./libs/Smarty.class.php
	//		创建目录htdocs\smarty\templates_c,否则 Fatal error: Smarty error: the $compile_dir 'templates_c' does not exist, or is not a directory. in D:\myenv\apache\htdocs\smarty\libs\Smarty.class.php on line 1095
	//		创建Smarty对象
		$smarty=new Smarty;
	//  4.把$arr分配到smarty对象
		$smarty->assign("arr2015",$arr);
	//  5.指定用哪个模板显示
		$smarty->display("EmpList2.tpl");

	//	header("Location: EmpList.php");		
	}else{
		header("Location: login.php");
	}
?>