<script>
    $(function() {
        $( "#accordion" ).accordion({
            active: false,
            collapsible: true,
            heightStyle: "content"

        });
    });
</script>

<?php echo $this->HTML->css('usersIndex'); ?>

<div class="documents view">
    <div class="actions">
        <ul>
            <li><?php echo $this->Html->link(__('Upload Ancestor Document'), array('controller' => 'documents', 'action' => 'uploadancestor')); ?>
            </li>
            <li>
            <?php echo $this->Html->link(__('Upload Personal Document'), array('controller' => 'documents', 'action' => 'uploadapplicant')); ?>
            </li>
        </ul>
    </div>
    <p>
    <br><br><br><br><br><br>
    <div id="accordion">
    <h3>Ancestor Documents</h3>
    <div>
    <?php if (!empty($ancestordocuments)): ?>
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th class="heading">Ancestor Type</th>
                <th class="heading">Document Type</th>
                <th class="heading">File name</th>
                <th class="heading">Uploaded</th>
                <th class="actions"><?php echo __('View'); ?></th>
            </tr>
            <?php foreach ($ancestordocuments as $ancestordocument): ?>
                <tr class="list">
                    <td valign="top">
                        <?php echo h($ancestordocument['Ancestortype']['ancestor_type']); ?>
                    </td>
                    <td valign="top">
                        <?php echo h($ancestordocument['Documenttype']['type']); ?>
                    </td>
                    <td valign="top"><?php echo h($ancestordocument['Document']['filename']); ?>&nbsp;</td>
                    <td valign="top"><?php echo h($this->Time->format('d-m-Y h:i',$ancestordocument['Document']['created'])); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('controller' => 'documents', 'action' => 'view', $ancestordocument['Document']['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    <?php
    endif;
    ?>
    </div>
    <h3>Applicant Documents</h3>
    <div>
    <?php if (!empty($applicantdocuments)): ?>

        <table cellpadding="0" cellspacing="0">
            <tr>
                <th class="heading">Applicant</th>
                <th class="heading">Document Type</th>
                <th class="heading">File Name</th>
                <th class="heading">Uploaded</th>
                <th class="heading">View</th>
            </tr>
            <?php foreach ($applicantdocuments as $applicantdocument): ?>
                <tr class="list">
                    <td valign="top">
                        <?php echo h($applicantdocument['Applicant']['first_name'].' '.$applicantdocument['Applicant']['surname']); ?>
                    </td>
                    <td valign="top">
                        <?php echo h($applicantdocument['Documenttype']['type']); ?>
                    </td>
                    <td valign="top"><?php echo h($applicantdocument['Document']['filename']); ?>&nbsp;</td>
                    <td valign="top"><?php echo h($this->Time->format('d-m-Y h:i',$applicantdocument['Document']['created'])); ?>&nbsp;</td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('controller' => 'documents', 'action' => 'view', $applicantdocument['Document']['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    <?php
    endif;
    ?>
    </div>
</div>
</div>
