<?php
/**
 * @author Romain Perez <perez.romain@gmail.com>
 * @link https://github.com/rohm1
 */

return array(
    'service_manager' => array(
        'invokables' => array(
            'ViewXmlRenderer' => 'Base\View\Renderer\XmlRenderer',
        ),
        'factories' => array(
            'ViewXmlStrategy' => 'Base\Mvc\Service\ViewXmlStrategyFactory',
        ),
    ),
);
