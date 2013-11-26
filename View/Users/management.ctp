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
<div class="umtop">
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->element('dashboard'); ?>
	<div class="um_box_up"></div>
	<div class="um_box_mid">
		<div class="um_box_mid_content">
			<div class="um_box_mid_content_top">
				<span class="umstyle1"><?php echo __('Type Management'); ?></span>
				<div style="clear:both"></div>
			</div>
			<div class="umhr"></div>
			<div class="um_box_mid_content_mid" id="index">
                <div class="row">
                    <div class="span5"><p>
                        <h3><?php echo __('Ancestor Types'); ?><a class="btn pull-right" href="./ancestortypes/add">New</a></h3>
                        <table>
                            <tr>
                                <th>Id</th>
                                <th>Ancestor Type</th>
                                <th></th>
                            </tr>
                            <?php foreach ($ancestortypes as $ancestortype): ?>
                                <tr>
                                    <td><?php echo h($ancestortype['Ancestortype']['id']); ?>&nbsp;</td>
                                    <td><?php echo h($ancestortype['Ancestortype']['ancestor_type']); ?>&nbsp;</td>
                                    <td class="actions">
                                        <?php echo $this->Html->link(__('Edit'), array('plugin' => false, 'controller' => 'ancestortypes', 'action' => 'edit', $ancestortype['Ancestortype']['id'])); ?>
                                        <?php echo $this->Form->postLink(__('Delete'), array('plugin' => false, 'controller' => 'ancestortypes','action' => 'delete', $ancestortype['Ancestortype']['id']), null, __('Are you sure you want to delete type '.$ancestortype['Ancestortype']['ancestor_type'].'?', $ancestortype['Ancestortype']['id'])); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <div class="span5"><p>
                        <h3><?php echo __('Statuses'); ?><a class="btn pull-right" href="./statuses/add">New</a></h3>
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <th>Id</th>
                                <th>Status Type</th>
                                <th class="actions"><?php echo __('Actions'); ?></th>
                            </tr>
                            <?php foreach ($statuses as $status): ?>
                                <tr>
                                    <td><?php echo h($status['Status']['id']); ?>&nbsp;</td>
                                    <td><?php echo h($status['Status']['status_type']); ?>&nbsp;</td>
                                    <td class="actions">
                                        <?php echo $this->Html->link(__('Edit'), array('plugin' => false, 'controller' => 'statuses', 'action' => 'edit', $status['Status']['id'])); ?>
                                        <?php echo $this->Form->postLink(__('Delete'), array('plugin' => false, 'controller' => 'statuses', 'action' => 'delete', $status['Status']['id']), null, __('Are you sure you want to delete type '.$status['Status']['status_type'].'?', $status['Status']['id'])); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>


			</div>
                <br>
                <br>
                <div class="row">
                    <div class="span9">
                        <h3><?php echo __('Document Types'); ?><a class="btn pull-right" href="./documenttypes/add">New</a></h3>
                    <table>
                        <tr>
                            <th>Id</th>
                            <th>Category</th>
                            <th>Type</th>
                            <th>Code</th>
                            <th></th>
                        </tr>
                        <?php foreach ($documenttypes as $documenttype): ?>
                            <tr>
                                <td><?php echo h($documenttype['Documenttype']['id']); ?>&nbsp;</td>
                                <td><?php echo h($documenttype['Documenttype']['category']); ?>&nbsp;</td>
                                <td><?php echo h($documenttype['Documenttype']['type']); ?>&nbsp;</td>
                                <td><?php echo h($documenttype['Documenttype']['code']); ?>&nbsp;</td>
                                <td class="actions">
                                    <?php echo $this->Html->link(__('Edit'), array('plugin' => false, 'controller' => 'documenttypes','action' => 'edit', $documenttype['Documenttype']['id'])); ?>
                                    <?php echo $this->Form->postLink(__('Delete'), array('plugin' => false, 'controller' => 'documenttypes', 'action' => 'delete', $documenttype['Documenttype']['id']), null, __('Are you sure you want to delete type '.$documenttype['Documenttype']['type'].'?', $documenttype['Documenttype']['id'])); ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    </div>
                </div>
		</div>
	</div>
	<div class="um_box_down"></div>
</div>
</div>
