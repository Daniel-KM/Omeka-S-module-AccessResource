<?php
namespace AccessResource\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class ConfigForm extends Form
{
    public function init()
    {
        $this
            ->add([
                'name' => 'accessresource_access_mode',
                'type' => Element\Radio::class,
                'options' => [
                    'label' => 'Restricted access mode (to be set in config/local.config.php)', // @translate
                    'info' => 'Access to a media is "reserved" when it has the property "curation:reservedAccess" filled.', // @translate
                    'documentation' => 'https://github.com/Daniel-KM/Omeka-S-module-AccessResource#access-mode',
                    'value_options' => [
                        'global' => 'Global: all users, included guests, have access to all reserved medias', // @translate
                        'individual' => 'Individual: guests should request access to each reserved media', // @translate
                    ],
                ],
                'attributes' => [
                    'id' => 'accessresource_access_mode',
                    'required' => true,
                    'disabled' => 'disabled',
                    'style' => 'display: block;',
                ],
            ])
        ;

        $this->getInputFilter()
            ->add([
                'name' => 'accessresource_access_mode',
                'required' => false,
            ])
        ;
    }
}
