<?php
/**
 * XML View Model
 *
 * @author Romain Perez <perez.romain@gmail.com>
 * @link https://github.com/rohm1
 */

namespace Base\View\Model;

use DOMDocument;
use DOMElement;
use DOMNodeList;

use Zend\View\Model\ViewModel;

class XmlModel extends ViewModel
{
    /**
     * The DOMDocument the XML is created from
     *
     * @var DOMDocument
     */
    protected $dom;

    /**
     * A XML model generally is terminal
     *
     * @var bool
     */
    protected $terminate = true;

    /**
     * Serialize to XML
     *
     * @return string
     */
    public function serialize()
    {
        $this->dom = new DOMDocument();
        $e = $this->walk($this->getVariables());
        $this->dom->appendChild($e);

        return $this->dom->saveXML();
    }

    /**
     * Walks through data
     *
     * @param type $data
     * @return DOMElement
     */
    protected function walk($data)
    {
        $node = $this->dom->createElement('root');

        foreach ($data as $key => $value) {

            if ($key == '@attributes') {
                $this->addAttributes($node, $value);
                continue;
            }

            if (is_numeric($key)) {
                $key = 'item' . $key;
            }

            $e = $this->dom->createElement($key);

            if (is_array($value)) {
                $this->appendChilds($e, $this->walk($value)->childNodes);
            } elseif (preg_match('/[<>"\']/', $value)) {
                $e->appendChild($this->dom->createCDATASection($value));
            } else {
                if (is_bool($value)) {
                    $value = $value ? 'true' : 'false';
                }
                $e->nodeValue = $value;
            }

            $node->appendChild($e);
        }

        return $node;
    }

    /**
     * Adds attributes to a DOMElement
     *
     * @param DOMElement $e
     * @param array $attributes
     */
    protected function addAttributes(DOMElement $e, $attributes)
    {
        foreach ($attributes as $attributeName => $attributeValue) {
            $e->setAttribute($attributeName, $attributeValue);
        }
    }

    /**
     * Adds childs to a DOMElement given a DOMNodeList
     *
     * @param DOMElement $e
     * @param DOMNodeList $childs
     */
    protected function appendChilds(DOMElement $e, DOMNodeList $childs)
    {
        while ($childs->length != 0) {
            $e->appendChild($childs->item(0));
        }
    }
}
