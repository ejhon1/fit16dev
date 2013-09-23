<?php
/*
	This file is part of UserMgmt.

	Author: Chetan Varshney (http://ektasoftwares.com)

	UserMgmt is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	UserMgmt is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
*/
?>
<div id="dashboard">
    <div style="float:left"><?php echo $this->Html->link(__("Dashboard",true),"/dashboard") ?></div>
    <?php   if ($this->UserAuth->isAdmin()) { ?>
        <div style="float:left;padding-left:25px"><?php echo $this->Html->link(__("Add Staff Member",true),"/newemployee") ?></div>
        <div style="float:left;padding-left:25px"><?php echo $this->Html->link(__("All Staff Members",true),"/allemployees") ?></div>
        <div style="float:left;padding-left:25px"><?php echo $this->Html->link(__("Add Group",true),"/addGroup") ?></div>
        <div style="float:left;padding-left:25px"><?php echo $this->Html->link(__("All Groups",true),"/allGroups") ?></div>
        <div style="float:left;padding-left:25px"><?php echo $this->Html->link(__("Permissions",true),"/permissions") ?></div>

    <?php   }?>
    <div style="clear:both"></div>
</div>