<?php

use AncientWorks\Artifact\Artifact;
use AncientWorks\Artifact\Modules\OxygenUnloader\Unloader;

defined('ABSPATH') || exit; ?>

<div class=" jp-dash-item">
    <div class="dops-card dops-section-header is-compact">
        <div class="dops-section-header__label">
            <span class="dops-section-header__label-text"> <b> <?= Unloader::$module_name ?> </b> <code> <?= Unloader::$module_version ?> </code> </span>
        </div>
        <div class="dops-section-header__actions"></div>
    </div>
    <div class="dops-card dops-banner has-call-to-action is-product" style="<?= !Unloader::is_mu_installed() ? 'border-left:initial;' : '' ?>">
        <div class="dops-banner__icon-plan">
            <img src="https://cdn.jsdelivr.net/wp/plugins/jetpack/trunk/images/products/product-jetpack-security-bundle.svg" width="32" height="32" alt="">
        </div>
        <div class="dops-banner__content">
            <div class="dops-banner__info">
                <div class="dops-banner__title">Load Oxygen Builder only for users with privilege access.</div>
            </div>
            <div class="dops-banner__action">
                <a href="<?= add_query_arg([
                                'page' => Artifact::$slug,
                                'route' => 'dashboard',
                                'module_id' => Unloader::$module_id,
                                'action' => 'toggleMUPlugin',
                                '_wpnonce' => wp_create_nonce('artifact')
                            ], admin_url('admin.php')) ?>" type="button" class="dops-button is-compact is-primary"><?= Unloader::is_mu_installed() ? 'disable' : 'enable' ?></a>
            </div>
        </div>
    </div>
</div>