<?php
	require_once 'EmpModel.class.php';
	require_once '../../libs/Smarty.class.php';

	//��ȡ�û�id������
	$admid=@$_POST['adminid'];
	$passwd=@$_POST['passwd'];

//	echo $admid."  --  ".$passwd;
	// ����Ӧ��ȥ���ݿ�ȥ��֤
	if($admid==="110" && $passwd==="123"){
		// ���������һ�����飬��������empList.phpȥ��ʾ 1)session 2)cookie���鷳���ض���ʽ�����ƴ�С 3)ģ�弼��
		$arr=array("�ν�","����ϧ");
		//�����������ȥ�õ����е��û���Ϣ
		//��ͳд��
		$empModel=new EmpModel;
		$arr=$empModel->showEmpList();
	//	echo "<pre>";
	//	print_r($res);
	//	echo "</pre>";

	//	��������ʹ��ģ�������$arr���ݷ����һ������(tpl)
	//	1.��дһ��ģ���ļ�,Ҫ���ڹ涨��Ŀ¼�� empList.tpl template
	//	2.��tpl�ļ�����Ҫ��ʾ�Ľ��������������������(����smarty�⣬����libs�ļ��п���) smartyͨ���ڿ�������ʹ�ã�������php����
	//  3.���� ./libs/Smarty.class.php
	//		����Ŀ¼htdocs\smarty\templates_c,���� Fatal error: Smarty error: the $compile_dir 'templates_c' does not exist, or is not a directory. in D:\myenv\apache\htdocs\smarty\libs\Smarty.class.php on line 1095
	//		����Smarty����
		$smarty=new Smarty;
	//  4.��$arr���䵽smarty����
		$smarty->assign("arr2015",$arr);
	//  5.ָ�����ĸ�ģ����ʾ
		$smarty->display("EmpList2.tpl");

	//	header("Location: EmpList.php");		
	}else{
		header("Location: login.php");
	}
?>