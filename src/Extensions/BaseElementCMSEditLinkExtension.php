<?php

namespace Fromholdio\ElementalGroup\Extensions;

use Fromholdio\ElementalGroup\Model\ElementGroup;
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
            $link = Controller::join_links(
                $page->CMSEditLink(),
                'ItemEditForm/field/Elements/item/',
                $owner->ID
            );
        }
    }
}
