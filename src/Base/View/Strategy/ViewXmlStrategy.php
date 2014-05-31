<?php
/**
 * XML View Strategy
 *
 * @author Romain Perez <perez.romain@gmail.com>
 * @link https://github.com/rohm1
 */

namespace Base\View\Strategy;

use Base\View\Model\XmlModel;
use Base\View\Renderer\XmlRenderer;

use Zend\View\Strategy\JsonStrategy;
use Zend\View\ViewEvent;

class ViewXmlStrategy extends JsonStrategy
{
    /**
     * Constructor
     *
     * @param  XmlRenderer $renderer
     */
    public function __construct(XmlRenderer $renderer)
    {
        parent::__construct($renderer);
    }

    /**
     * Detect if we should use the XmlRenderer based on model type and/or
     * Accept header
     *
     * @param  ViewEvent $e
     * @return null|XmlRenderer
     */
    public function selectRenderer(ViewEvent $e)
    {
        $model = $e->getModel();

        if (!$model instanceof XmlModel) {
            // no XmlModel; do nothing
            return;
        }

        // XmlModel found
        return $this->renderer;
    }

    /**
     * Inject the response with the XML payload and appropriate Content-Type header
     *
     * @param  ViewEvent $e
     * @return void
     */
    public function injectResponse(ViewEvent $e)
    {
        $renderer = $e->getRenderer();
        if ($renderer !== $this->renderer) {
            // Discovered renderer is not ours; do nothing
            return;
        }

        parent::injectResponse($e);

        // sets the content type
        $response = $e->getResponse();
        $headers = $response->getHeaders();
        $headers->addHeaderLine('content-type', 'text/xml; charset=' . $this->charset);
    }
}
