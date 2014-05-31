<?php
/**
 * XML Renderer
 *
 * @author Romain Perez <perez.romain@gmail.com>
 * @link https://github.com/rohm1
 */

namespace Base\View\Renderer;

use Base\View\Model\XmlModel;

use Zend\View\Exception\DomainException;
use Zend\View\Renderer\JsonRenderer;

class XmlRenderer extends JsonRenderer
{

    /**
     * Renders values as XML
     *
     * @param  XmlModel $nameOrModel
     * @param  null $values
     * @throws Exception\DomainException
     * @return string
     */
    public function render($nameOrModel, $values = null)
    {
        if (!$nameOrModel instanceof XmlModel) {
            throw new DomainException('Expecting an instance of XmlModel to render.');
        }

        return $nameOrModel->serialize();
    }

}
