<?php

namespace AncientWorks\Artifact\Modules\OxygenUnloader;

use AncientWorks\Artifact\Admin\DashboardController;
use AncientWorks\Artifact\Module;
use AncientWorks\Artifact\Utils\Notice;

/**
 * @package AncientWorks\Artifact
 * @since 0.0.1
 * @author ancientworks <mail@ancient.works>
 * @link https://github.com/artifact-modules/oxygen-unloader
 */
class Unloader extends Module
{
    public static $module_id = 'oxygen_unloader';
    public static $module_version = '0.0.1';
    public static $module_name = 'Oxygen Builder Unloader';

    protected static $mu_filename = 'mu_unload_oxygen.php';

    public static function install_mu()
    {
        self::uninstall_mu();

        if (!file_exists(WPMU_PLUGIN_DIR) || !is_dir(WPMU_PLUGIN_DIR)) {
            mkdir(WPMU_PLUGIN_DIR);
        }

        copy(
            plugin_dir_path(__FILE__) . '/' . self::$mu_filename,
            WPMU_PLUGIN_DIR . '/' . self::$mu_filename
        );
    }

    public static function uninstall_mu()
    {
        if (self::is_mu_installed()) {
            unlink(WPMU_PLUGIN_DIR . '/' . self::$mu_filename);
        }
    }

    public static function is_mu_installed()
    {
        return file_exists(WPMU_PLUGIN_DIR . '/' . self::$mu_filename);
    }

    public function boot()
    {
        DashboardController::registerModulePanel('grid', self::$module_id, self::$module_id . '::panel', [$this, 'handlePanel']);
    }

    public function handlePanel()
    {
        if ($_REQUEST['action'] === 'toggleMUPlugin') {
            if (self::is_mu_installed()) {
                self::uninstall_mu();
                Notice::success('<b>'.self::$module_name.'</b>: disabled');
            } else {
                self::install_mu();
                Notice::success('<b>'.self::$module_name.'</b>: enabled');
            }
            return true;
        }
    }

}
