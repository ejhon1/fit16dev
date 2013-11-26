<div class="clientcases view">
    <script>
    $(document).ready(function() {
    if (location.hash !== '') $('a[href="' + location.hash + '"]').tab('show');
    return $('a[data-toggle="tab"]').on('shown', function(e) {
    return location.hash = $(e.target).attr('href').substr(1);
    });
    });
    </script>
        <h3><?php echo __('Case statuses'); ?></h3>
    <a class="btn" data-toggle="modal" href="#myModal2">Update Status</a>
		<?php if (!empty($clientcase['Casestatus'])): ?>
            <table cellpadding = "0" cellspacing = "0">
                           <tr>
                                   <th><?php echo __('Status'); ?></th>
                                   <th><?php echo __('Date Updated'); ?></th>
                                   <th><?php echo __('Employee'); ?></th>


                               </tr>
                           <?php foreach ($casestatuses as $casestatus): ?>
                                   <tr>
                                           <td><?php echo $casestatus['Status']['status_type']; ?></td>
                                           <td><?php echo $casestatus['Casestatus']['date_updated']; ?></td>
                                           <td><?php echo $casestatus['Casestatus']['employee_id']; ?></td>


                                       </tr>
                               <?php endforeach; ?>
                       </table>
		<?php endif; ?>

		<div class="actions">
			<ul>
				<li><?php echo $this->Html->link(__('Update Status'), array('controller' => 'casestatuses', 'action' => 'add', $clientcase['Clientcase']['id'])); ?> </li>
				</ul>
		</div>
    <!-- Button trigger modal
    <a data-toggle="modal" href="#myModal" class="btn btn-primary btn-lg">Launch demo modal</a>-->




    </div>

    <div class = 'positionreset'>
    <div class="modal hide" id="myModal2"><!-- note the use of "hide" class -->

        <div class="modal-header">
            <button class="close" data-dismiss="modal">×</button>
            <h3>Update Case Status</h3>
        </div>
        <div class="modal-body">
            <?php echo $this->Form->create('Casestatus'); ?>
            <fieldset>
                <?php
                echo $this->Form->input('status_id');
                echo $this->Form->hidden('date_updated', array('default' => date('Y-m-d h:i:s')));
                echo $this->Form->hidden('clientcase_id', array('default' => $id));
                echo $this->Form->hidden('employee_id', array('default' => $employee['Employee']['id']));
                ?>
            </fieldset>

        </div>
        <div class="modal-footer">
            <?php echo $this->Form->end(__('Submit')); ?>
        </div>
    </div>
    </div>

<div id="content">
    <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
        <li class="active"><a href="#red" data-toggle="tab">Red</a></li>
        <li><a href="#orange" data-toggle="tab">Orange</a></li>
        <li><a href="#yellow" data-toggle="tab">Yellow</a></li>
        <li><a href="#green" data-toggle="tab">Green</a></li>
        <li><a href="#blue" data-toggle="tab">Blue</a></li>
    </ul>
    <div id="my-tab-content" class="tab-content">
        <div class="tab-pane active" id="red">
            <h1>Red</h1>
            <p>red red red red red red</p>
        </div>
        <div class="tab-pane" id="orange">
            <h1>Orange</h1>
            <p>orange orange orange orange orange</p>
        </div>
        <div class="tab-pane" id="yellow">
            <h1>Yellow</h1>
            <p>yellow yellow yellow yellow yellow</p>
        </div>
        <div class="tab-pane" id="green">
            <h1>Green</h1>
            <p>green green green green green</p>
        </div>
        <div class="tab-pane" id="blue">
            <h1>Blue</h1>
            <p>blue blue blue blue blue</p>
        </div>
    </div>
</div>

    <!-- <a href="#myModal3" role="button" class="btn" data-toggle="modal" id="LaunchDemo">Launch demo modal</a> --!>
    <!-- Modal -->


