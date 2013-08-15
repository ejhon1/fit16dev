<div class="clients view">
    <script>
        $(function() {
            $( "#tabs" ).tabs();
        });
    </script>
<h2><?php  echo __('Case'); ?></h2>

    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Nunc tincidunt</a></li>
            <li><a href="#tabs-2">Proin dolor</a></li>
            <li><a href="#tabs-3">Aenean lacinia</a></li>
        </ul>
        <div id="tabs-1">
            <p>

            <dl>
                <dt><?php echo __('Id'); ?></dt>
                <dd>
                    <?php echo h($client['Client']['id']); ?>
                    &nbsp;
                </dd>
                <?php /*
                <dt><?php echo __('Archive'); ?></dt>
                <dd>
                    <?php echo $this->Html->link($client['Archive']['archive_name'], array('controller' => 'archives', 'action' => 'view', $client['Archive']['id'])); ?>
                    &nbsp;
                </dd>
         */ ?>
                <dt><?php echo __('Status'); ?></dt>
                <dd>
                    <?php echo h($client['Client']['status']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Open/Closed'); ?></dt>
                <dd>
                    <?php echo h($client['Client']['open_or_closed']); ?>
                    &nbsp;
                </dd>
                <dt><?php echo __('Enquiry Date'); ?></dt>
                <dd>
                    <?php echo h($client['Client']['enquiry_date']); ?>
                    &nbsp;
                </dd>
            </dl>
        </div>

        <div id="tabs-2">
            <p>
            <h3><?php echo __('Applicants'); ?></h3>
            <?php if (!empty($applicants)): ?>
            <table cellpadding = "0" cellspacing = "0">
            <tr>
                <th><?php echo __('Name'); ?></th>
                <th><?php echo __('Email'); ?></th>
                <th><?php echo __('Type'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
            <?php foreach ($applicants as $applicant): ?>
                <tr>
                    <td><?php echo h($applicant['Applicant']['title'].' '.$applicant['Applicant']['first_name'].' '.$applicant['Applicant']['surname']); ?></td>
                    <td><?php echo $applicant['Applicant']['email']; ?></td>
                    <td><?php echo $applicant['Applicant']['applicant_type']; ?></td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('View'), array('controller' => 'applicants', 'action' => 'view', $applicant['Applicant']['id'])); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            </table>
            <?php endif; ?>
        </div>

        <div id="tabs-3">
        <p>
        <h3><?php echo __('Related Ancestor documents'); ?></h3>
        <?php if (!empty($ancestordocuments)): ?>
            <table cellpadding = "0" cellspacing = "0">
                <tr>
                    <th><?php echo __('Filename'); ?></th>
                    <th><?php echo __('Ancestor Type'); ?></th>
                    <th><?php echo __('Document Type'); ?></th>
                    <th><?php echo __('Uploaded'); ?></th>
                    <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
                <?php
                $i = 0;
                foreach ($ancestordocuments as $ancestordocument): ?>
                    <tr>
                        <td><?php echo $ancestordocument['Ancestordocument']['filename']; ?></td>
                        <td><?php echo $ancestordocument['AncestorType']['Ancestor']; ?></td>
                        <td><?php echo $ancestordocument['DocumentType']['doc_type']; ?></td>
                        <td><?php echo $ancestordocument['Ancestordocument']['created']; ?></td>
                        <td class="actions">
                            <?php echo $this->Html->link(__('View'), array('controller' => 'ancestordocuments', 'action' => 'view', $ancestordocument['Ancestordocument']['id'])); ?>
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
</div>
</div>