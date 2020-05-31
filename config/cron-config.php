<?php

return [
	'id'     => 'my_cron_jobs', // не обязательный параметр
	'events' => array(
		// первая задача
		'DPU_update_post_date' => array(
			'callback'      => [ Post_Updater_Script::class, 'cron_tasks' ],
			'interval_name' => '1_min',
			'interval_desc' => 'Каждые 1 минут',
		),
	),
];