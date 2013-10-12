<?php
echo $this->HTML->script('JQueryUser');
?>
<div class="documents index">
	<h2><?php echo __('Documents'); ?></h2>
	<table id="data">
    <thead>
        <tr>
			<th class="heading">Archive Name</th>
			<th class="heading">Category</th>
			<th class="heading">Type</th>
			<th class="heading">Filename</th>
			<th class="heading">Uploaded</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
    </thead>
    <tbody>
	<?php foreach ($documents as $document): ?>
	<tr class="list">
		<td>
			<?php echo h($document['Archive']['archive_name']); ?>
		</td>
		<td>
			<?php
            if(!empty($document['Applicant']['id']))
            {
                echo 'Applicant';
            }
            else if(!empty($document['Ancestortype']['id']))
            {
                echo 'Ancestor';
            }
            else if(!empty($document['Document']['copy_type']) && $document['Document']['copy_type'] != 'Digital')
            {
                echo h($document['Document']['copy_type']);
            }
            else
            {
                echo 'Unknown';
            }
            ?>
		</td>
		<td valign="top">
			<?php echo h($document['Documenttype']['type']); ?>
		</td>
		<td valign="top"><?php echo h($document['Document']['filename']); ?></td>
		<td valign="top"><?php echo h($this->Time->format('d-m-Y h:i', $document['Document']['created'])); ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $document['Document']['id'])); ?>
            <?php if($document['Document']['copy_type'] == 'Digital')
            {
                echo $this->Html->link(__('Download'), array('controller' => 'documents', 'action' => 'sendFile', $document['Document']['id']));
            }
            ?>
        </td>
	</tr>
<?php endforeach; ?>
    </tbody>
	</table>
</div>
