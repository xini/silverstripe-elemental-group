<?php

namespace Fromholdio\ElementalGroup\Extensions;

use Fromholdio\ElementalGroup\Model\ElementGroup;
use SilverStripe\CMS\Controllers\CMSPageEditController;
use SilverStripe\Control\Controller;
use SilverStripe\Core\Extension;

class BaseElementCMSEditLinkExtension extends Extension
{
    public function updateCMSEditLink(&$link)
    {
        $owner = $this->getOwner();

        $relationName = $owner->getAreaRelationName();
        $page = $owner->getPage(true);

        if (!$page) {
            return;
        }

        if ($page instanceof ElementGroup && $relationName === 'Elements') {
            // nested bock - we need to get edit link of parent block
            $link = $page->CMSEditLink();
            $link = preg_replace('/\/item\/([\d]+)\/edit/', '/item/$1', $link);
            $link = Controller::join_links(
                $link,
                'ItemEditForm/field/Elements/item/',
                $owner->ID,
                'edit'
            );
        }
    }
}
