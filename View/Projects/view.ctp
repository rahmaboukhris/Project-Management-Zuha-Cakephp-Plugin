<div class="project view">
    <h2><?php echo __('%s Dashboard', $project['Project']['displayName']); ?></h2>
    <div id="n1" class="info-block">
      <div class="viewRow">
        <?php if ($this->Session->read('Auth.User.user_role_id') == 1) : ?>
        <ul class="metaData">
          <li><span class="metaDataLabel"> <?php echo __('Days Since Launch: '); ?> </span><span class="metaDataDetail"><?php echo floor((time() - strtotime($project['Project']['created'])) / 86400); ?></span></li>
          <!--li><span class="metaDataLabel">
            <?php echo __('Estimated Hours: '); ?>
            </span><span name="estimatedhours" class="edit metaDataDetail" id="<?php echo __($project['Project']['id']); ?>"><?php echo $project['Project']['estimated_hours']; ?></span></li-->
          <li><span class="metaDataLabel"> <?php echo __('Time Logged: '); ?> </span><span id="spenthours<?php echo $project['Project']['id']; ?>" class="metaDataDetail"><?php echo $trackedHoursSum; ?></span></li>
          <!--li><span class="metaDataLabel">
            <?php echo __('Percent Complete: '); ?>
            </span><span id="percentcomplete" class="metaDataDetail"><?php echo $percentComplete; __('%'); ?></span></li-->
        </ul>
        <?php endif; ?>
        <div class="recordData">
          <h3><?php echo __('Latest Activities'); ?></h3>
          <?php echo $this->Element('activities', array('parentForeignKey' => $project['Project']['id']), array('plugin' => 'activities')); ?> </div>
      </div>
    </div>
  <!-- /info-block end -->
</div>
<?php
$archiveStatusLink = !empty($project['is_archived']) ? $this->Html->link(__('Un-archive', true), array('controller' => 'projects', 'action' => 'unarchive', $project['Project']['id']), array('class' => 'archive')) : $this->Html->link(__('Archive', true), array('controller' => 'projects', 'action' => 'archive', $project['Project']['id']), array('class' => 'archive'));
// set the contextual menu items
$this->set('context_menu', array('menus' => array(
	array(
		'heading' => 'Project',
		'items' => array(
			$this->Html->link('<span>Dashboard</span>', array('plugin' => 'projects', 'controller' => 'projects', 'action' => 'view', $project['Project']['id']), array('title' => 'Dashboard', 'escape' => false, 'class' => 'ui-btn-active')),
			$this->Html->link('<span>Messages</span>', array('plugin' => 'projects', 'controller' => 'projects', 'action' => 'messages', $project['Project']['id']), array('title' => 'Messages', 'escape' => false)),
			$this->Html->link('<span>Tasks</span>', array('plugin' => 'projects', 'controller' => 'projects', 'action' => 'tasks', $project['Project']['id']), array('title' => 'Tasks', 'escape' => false)),
			$this->Html->link('<span>People</span>', array('plugin' => 'projects', 'controller' => 'projects', 'action' => 'people', $project['Project']['id']), array('title' => 'People', 'escape' => false)),
			)
		),
	array(
		'heading' => 'Timesheets',
		'items' => array(
			$this->Html->link(__('Edit'), array('controller' => 'projects', 'action' => 'edit', $project['Project']['id']), array('class' => 'edit')),
			$this->Html->link(__('Add Time'), array('plugin' => 'timesheets', 'controller' => 'timesheet_times', 'action' => 'add', 'project_id' => $project['Project']['id']), array('class' => 'add')),
			$archiveStatusLink,
			)
		),
	))); ?>