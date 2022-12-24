<?php /* Smarty version 2.6.18, created on 2015-11-17 16:06:39
         compiled from EmpList.tpl */ ?>
<html>
<h1>好友列表——模板方式显示</h1>
<table>
<tr><td>id</td><td>name</td><td>passwd</td></tr>
<?php $_from = $this->_tpl_vars['arr2015']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['emp']):
?>
<tr><td><?php echo $this->_tpl_vars['emp']['empid']; ?>
</td><td><?php echo $this->_tpl_vars['emp']['email']; ?>
</td><td><?php echo $this->_tpl_vars['emp']['passwd']; ?>
</td></tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</html>