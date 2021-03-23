<?php

namespace Fromholdio\ElementalGroup\Model;

use DNADesign\Elemental\Models\BaseElement;
use DNADesign\Elemental\Models\ElementalArea;
use Fromholdio\ElementalMultiArea\Extensions\MultiElementalAreasExtension;

class ElementGroup extends BaseElement
{
    private static $table_name = 'ElementalGroup';
    private static $singular_name = 'Group';
    private static $plural_name = 'Groups';

    private static $inline_editable = false;

    private static $extensions = [
        MultiElementalAreasExtension::class
    ];

    private static $has_one = [
        'Elements' => ElementalArea::class
    ];

    private static $owns = [
        'Elements'
    ];

    private static $cascade_deletes = [
        'Elements'
    ];

    private static $cascade_duplicates = [
        'Elements'
    ];

    public function getIsElementEmpty()
    {
        return ($this->Elements()->Elements()->count() < 1);
    }

    public function getType()
    {
        return $this->i18n_singular_name();
    }
}
