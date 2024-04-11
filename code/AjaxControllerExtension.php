<?php

use SilverStripe\Core\Extension;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Core\Injector\Injector;
/**
 * Catches errors and returns an AjaxHTTPResponse.
 * Could also add some helpers to controller for ajax functionality.
 * In the end this may or may not be needed?
 *
 * @author Mark Guinn <mark@adaircreative.com>
 * @date 04.03.2014
 * @package silverstripe-ajax
 */
class AjaxControllerExtension extends Extension
{

    protected $ajaxResponse;

    /**
     * @param int            $errorCode
     * @param HTTPRequest $request
     */
    public function onBeforeHTTPError($errorCode, HTTPRequest $request)
    {
        // TODO: This should probably prevent the error page from generating in ajax and possibly return a json response
        // throw new SS_HTTPResponse_Exception($errorMessage, $errorCode);
    }


    /**
     * @return AjaxHTTPResponse
     */
    public function getAjaxResponse()
    {
        if (!isset($this->ajaxResponse)) {
            $request = null;
            if ($this->owner instanceof \SilverStripe\Control\HasRequestHandler) {
                $request = $this->owner->getRequestHandler()->getRequest();
            } else if ($this->owner instanceof \SilverStripe\Control\Controller) {
                $request = $this->owner->getRequest();
            }

            $this->ajaxResponse = Injector::inst()->create('AjaxHTTPResponse', $request);
        }
        return $this->ajaxResponse;
    }
}
