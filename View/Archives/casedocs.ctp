<div class="archives view">
<h2><?php  echo __('Documents'); ?></h2>

    <div class="related">
        <h3><?php echo __('Ancestor\'s  Documents'); ?></h3>
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
                <li><?php echo $this->Html->link(__('Upload Ancestor Document'), array('controller' => 'ancestordocuments', 'action' => 'upload')); ?> </li>
            </ul>
        </div>
    </div>

    <br>
    <br>

    <div class="related">
        <h3><?php echo __('Applicant Documents'); ?></h3>
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
                <li><?php echo $this->Html->link(__('Upload Applicant Document'), array('controller' => 'applicantdocuments', 'action' => 'uploadapplicant')); ?> </li>
            </ul>
        </div>
    </div>

</div>