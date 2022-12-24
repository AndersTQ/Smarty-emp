<html>
<h1>好友列表——模板方式显示</h1>
{* 这里是注释 *}
  <body bgcolor="cyan">
	<table>
	<tr><td>id</td><td>name</td><td>passwd</td></tr>
	{* 循环取出arr中的数据 *}
	{foreach from=$arr2015 item=emp key=key}
	<tr><td>{$emp.empid}</td><td>{$emp.email}</td><td>{$emp.passwd}</td></tr>
	{/foreach}
	</table>
  </body>
</html>