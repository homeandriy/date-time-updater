<?php

return [
	'id'     => 'my_cron_jobs',
	'events' => array(
		'DPU_update_post_date' => array(
			'callback'      => [ Post_Updater_Script::class, 'cron_tasks' ],
			'interval_name' => '90_min',
			'interval_desc' => 'Каждые 90 минут',
		),
	),
];