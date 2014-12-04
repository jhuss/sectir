<?php

/**
 * Class CrearAdminCommand
 * @author asdrubalivan
 */
class CrearAdminCommand extends CConsoleCommand
{
    public function run($args)
    {
        $sql = <<<EOF
INSERT INTO `sectir_users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `activation_key`, `created_on`, `updated_on`, `last_visit_on`, `password_set_on`, `email_verified`, `is_active`, `is_disabled`, `one_time_password_secret`, `one_time_password_code`, `one_time_password_counter`) VALUES
(1, 'admin', '$2y$10\$Gmbwwp6RtSfHksqFrXljv.ljW.eruHZ/.E9QGVZOuHfFt4OVZL./C', 'admin@admin.com', NULL, NULL, NULL, '2014-12-04 23:00:13', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2014-12-04 23:00:13', 0, 1, 0, NULL, NULL, 0);

EOF;
        Yii::app()->db->createCommand($sql)->execute();
    }
}

