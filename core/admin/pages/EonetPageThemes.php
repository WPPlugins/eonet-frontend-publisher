<?php

namespace Eonet\Core\Admin\Pages;

use Eonet\Core\Admin\EonetAdminPages;

if ( ! defined('ABSPATH') ) die('Forbidden');

class EonetPageThemes extends EonetAdminPages
{

    function getPageName()
    {
        return __('Themes', 'eonet-frontend-publisher');
    }

    function getPageSlug()
    {
        return 'themes';
    }

    function getPageIcon()
    {
        return 'fa fa-magic';
    }

    function getPageContent()
    {
        $args = array(
            'slug' => $this->getPageSlug(),
            'name' => $this->getPageName(),
        );
        return eonet_render_view($this->getPath().'views/'.$this->getPageSlug().'.php', $args);
    }

}