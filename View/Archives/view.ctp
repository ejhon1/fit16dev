<div class="archives view">
<h2><?php  echo __('Archive'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($archive['Archive']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Archive Name'); ?></dt>
		<dd>
			<?php echo h($archive['Archive']['archive_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Family Name'); ?></dt>
		<dd>
			<?php echo h($archive['Archive']['family_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($archive['Archive']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($archive['Archive']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
    <br>
    <br>


    <div class="related">
        <h3><?php echo __('Cases'); ?></h3>
        <?php if (!empty($archive['Client'])): ?>
            <table cellpadding = "0" cellspacing = "0">
                <tr>
                    <th><?php echo __('Id'); ?></th>
                    <th><?php echo __('Status'); ?></th>
                    <th><?php echo __('Open Or Closed'); ?></th>
                    <th><?php echo __('Enquiry Date'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
                <?php
                $i = 0;
                foreach ($archive['Client'] as $client): ?>
                    <tr>
                        <td><?php echo $client['id']; ?></td>
                        <td><?php echo $client['status']; ?></td>
                        <td><?php echo $client['open_or_closed']; ?></td>
                        <td><?php echo $client['enquiry_date']; ?></td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('View'), array('controller' => 'clients', 'action' => 'view', $client['id'])); ?>
                            <?php echo $this->Html->link(__('Edit'), array('controller' => 'clients', 'action' => 'edit', $client['id'])); ?>
                            <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'clients', 'action' => 'delete', $client['id']), null, __('Are you sure you want to delete # %s?', $client['id'])); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <div class="actions">
            <ul>
                <li><?php echo $this->Html->link(__('New Client'), array('controller' => 'clients', 'action' => 'add')); ?> </li>
            </ul>
        </div>
    </div>

    <br>
    <br>

    <div class="related">
        <h3><?php echo __('All Applicants'); ?></h3>
        <?php if (!empty($archive['Applicant'])): ?>
            <table cellpadding = "0" cellspacing = "0">
                <tr>
                    <th><?php echo __('Name'); ?></th>
                    <th><?php echo __('Email'); ?></th>
                    <th><?php echo __('Applicant Type'); ?></th>
                    <th><?php echo __('Added'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
                <?php
                $i = 0;
                foreach ($archive['Applicant'] as $applicant): ?>
                    <tr>
                        <td><?php echo $applicant['title'].' '.$applicant['first_name'].' '.$applicant['middle_name'].' '.$applicant['surname']; ?></td>
                        <td><?php echo $applicant['email']; ?></td>
                        <td><?php echo $applicant['applicant_type']; ?></td>
                        <td><?php echo $applicant['created']; ?></td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('View'), array('controller' => 'applicants', 'action' => 'view', $applicant['id'])); ?>
                            <?php echo $this->Html->link(__('Edit'), array('controller' => 'applicants', 'action' => 'edit', $applicant['id'])); ?>
                         </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>

        <div class="actions">
            <ul>
                <li><?php echo $this->Html->link(__('New Applicant'), array('controller' => 'applicants', 'action' => 'add')); ?> </li>
            </ul>
        </div>
    </div>

    <br>
    <br>



    <div class="related">
        <h3><?php echo __('Related Ancestordocuments'); ?></h3>
        <?php if (!empty($archive['Ancestordocument'])): ?>
        <table cellpadding = "0" cellspacing = "0">
        <tr>
            <th><?php echo __('Id'); ?></th>
            <th><?php echo __('Archive Id'); ?></th>
            <th><?php echo __('Ancestor Type'); ?></th>
            <th><?php echo __('Document Type'); ?></th>
            <th><?php echo __('Note'); ?></th>
            <th><?php echo __('Filename'); ?></th>
            <th><?php echo __('Filesize'); ?></th>
            <th><?php echo __('Filemime'); ?></th>
            <th><?php echo __('Created'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php
            $i = 0;
            foreach ($archive['Ancestordocument'] as $ancestordocument): ?>
            <tr>
                <td><?php echo $ancestordocument['id']; ?></td>
                <td><?php echo $ancestordocument['archive_id']; ?></td>
                <td><?php echo $ancestordocument['ancestor_type']; ?></td>
                <td><?php echo $ancestordocument['document_type']; ?></td>
                <td><?php echo $ancestordocument['note']; ?></td>
                <td><?php echo $ancestordocument['filename']; ?></td>
                <td><?php echo $ancestordocument['filesize']; ?></td>
                <td><?php echo $ancestordocument['filemime']; ?></td>
                <td><?php echo $ancestordocument['created']; ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('controller' => 'ancestordocuments', 'action' => 'view', $ancestordocument['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('controller' => 'ancestordocuments', 'action' => 'edit', $ancestordocument['id'])); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'ancestordocuments', 'action' => 'delete', $ancestordocument['id']), null, __('Are you sure you want to delete # %s?', $ancestordocument['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </table>
    <?php endif; ?>

        <div class="actions">
            <ul>
                <li><?php echo $this->Html->link(__('New Ancestordocument'), array('controller' => 'ancestordocuments', 'action' => 'add')); ?> </li>
            </ul>
        </div>
    </div>

    <br>
    <br>

    <div class="related">
        <h3><?php echo __('Related Applicantdocuments'); ?></h3>
        <?php if (!empty($archive['Applicantdocument'])): ?>
        <table cellpadding = "0" cellspacing = "0">
        <tr>
            <th><?php echo __('Id'); ?></th>
            <th><?php echo __('Archive Id'); ?></th>
            <th><?php echo __('Applicant Id'); ?></th>
            <th><?php echo __('Document Type'); ?></th>
            <th><?php echo __('Note'); ?></th>
            <th><?php echo __('Filename'); ?></th>
            <th><?php echo __('Filesize'); ?></th>
            <th><?php echo __('Filemime'); ?></th>
            <th><?php echo __('Created'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php
            $i = 0;
            foreach ($archive['Applicantdocument'] as $applicantdocument): ?>
            <tr>
                <td><?php echo $applicantdocument['id']; ?></td>
                <td><?php echo $applicantdocument['archive_id']; ?></td>
                <td><?php echo $applicantdocument['applicant_id']; ?></td>
                <td><?php echo $applicantdocument['document_type']; ?></td>
                <td><?php echo $applicantdocument['note']; ?></td>
                <td><?php echo $applicantdocument['filename']; ?></td>
                <td><?php echo $applicantdocument['filesize']; ?></td>
                <td><?php echo $applicantdocument['filemime']; ?></td>
                <td><?php echo $applicantdocument['created']; ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('controller' => 'applicantdocuments', 'action' => 'view', $applicantdocument['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('controller' => 'applicantdocuments', 'action' => 'edit', $applicantdocument['id'])); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'applicantdocuments', 'action' => 'delete', $applicantdocument['id']), null, __('Are you sure you want to delete # %s?', $applicantdocument['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </table>
    <?php endif; ?>

        <div class="actions">
            <ul>
                <li><?php echo $this->Html->link(__('New Applicantdocument'), array('controller' => 'applicantdocuments', 'action' => 'add')); ?> </li>
            </ul>
        </div>
    </div>

    <br>
    <br>

    <div class="related">
        <h3><?php echo __('Related Paperfiles'); ?></h3>
        <?php if (!empty($archive['Paperfile'])): ?>
        <table cellpadding = "0" cellspacing = "0">
        <tr>
            <th><?php echo __('Id'); ?></th>
            <th><?php echo __('Archive Id'); ?></th>
            <th><?php echo __('Status'); ?></th>
            <th><?php echo __('Created'); ?></th>
            <th><?php echo __('Modified'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php
            $i = 0;
            foreach ($archive['Paperfile'] as $paperfile): ?>
            <tr>
                <td><?php echo $paperfile['id']; ?></td>
                <td><?php echo $paperfile['archive_id']; ?></td>
                <td><?php echo $paperfile['status']; ?></td>
                <td><?php echo $paperfile['created']; ?></td>
                <td><?php echo $paperfile['modified']; ?></td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('controller' => 'paperfiles', 'action' => 'view', $paperfile['id'])); ?>
                    <?php echo $this->Html->link(__('Edit'), array('controller' => 'paperfiles', 'action' => 'edit', $paperfile['id'])); ?>
                    <?php echo $this->Form->postLink(__('Delete'), array('controller' => 'paperfiles', 'action' => 'delete', $paperfile['id']), null, __('Are you sure you want to delete # %s?', $paperfile['id'])); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </table>
    <?php endif; ?>

        <div class="actions">
            <ul>
                <li><?php echo $this->Html->link(__('New Paperfile'), array('controller' => 'paperfiles', 'action' => 'add')); ?> </li>
            </ul>
        </div>
    </div>

</div>