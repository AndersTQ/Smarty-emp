<html>
<h1>�����б���ģ�巽ʽ��ʾ</h1>
{* ������ע�� *}
  <body bgcolor="cyan">
	<table>
	<tr><td>id</td><td>name</td><td>passwd</td></tr>
	{* ѭ��ȡ��arr�е����� *}
	{foreach from=$arr2015 item=emp key=key}
	<tr><td>{$emp.empid}</td><td>{$emp.email}</td><td>{$emp.passwd}</td></tr>
	{/foreach}
	</table>
  </body>
</html>