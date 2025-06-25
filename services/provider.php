<?php

/*------------------------------------------------------------------------
# mod_jocustomcode - JO's Custom Code
# ------------------------------------------------------------------------
# author    JL TRYOEN / RBO Team > Project::: RumahBelanja.com & AppsNity.com
# Copyright (C) 2010 www.joomlahill.com. All Rights Reserved.
# Copyright (C) 2025 www.jltryoen.fr All Rights Reserved.
# @license  http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
# Websites: http://www.jltryoen.fr
-------------------------------------------------------------------------*/

\defined('_JEXEC') or die;

use Joomla\CMS\Extension\Service\Provider\Module as ModuleServiceProvider;
use Joomla\CMS\Extension\Service\Provider\ModuleDispatcherFactory as ModuleDispatcherFactoryServiceProvider;
use Joomla\CMS\Extension\Service\Provider\HelperFactory as HelperFactoryServiceProvider;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

/**
 * The articles module service provider.
 *
 * @since  5.2.0
 */
return new class () implements ServiceProviderInterface {
    /**
     * Registers the service provider with a DI container.
     *
     * @param   Container  $container  The DI container.
     *
     * @return  void
     *
     * @since   5.2.0
     */
    public function register(Container $container)
    {
        $container->registerServiceProvider(
            new ModuleDispatcherFactoryServiceProvider('\\JLTRY\\Module\\JOCustomCode')
        );
        $container->registerServiceProvider(
            new HelperFactoryServiceProvider('\\JLTRY\\Module\\JOCustomCode\\Site\\Helper')
        );
        $container->registerServiceProvider(new ModuleServiceProvider());
    }
};
