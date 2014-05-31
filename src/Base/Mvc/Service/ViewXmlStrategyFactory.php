<?php
/**
 * @author Romain Perez <perez.romain@gmail.com>
 * @link https://github.com/rohm1
 */

namespace Base\Mvc\Service;

use Base\View\Strategy\ViewXmlStrategy;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ViewXmlStrategyFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $xmlRenderer = $serviceLocator->get('ViewXmlRenderer');
        return new ViewXmlStrategy($xmlRenderer);
    }
}
