<?php declare(strict_types=1);
namespace AccessResource\Form\Admin;

use AccessResource\Entity\AccessRequest;
use AccessResource\Service\ServiceLocatorAwareTrait;
use Laminas\Form\Element;
use Laminas\Form\Fieldset;
use Laminas\Form\Form;

class AccessRequestForm extends Form
{
    use ServiceLocatorAwareTrait;

    public function init(): void
    {
        parent::init();

        // TODO Convert into a standard Omeka form (with name as in json-ld).

        $this->add([
            'name' => 'status',
            'type' => Element\Radio::class,
            'options' => [
                'label' => ' Status', // @translate
                'value_options' => $this->getStatusOptions(),
            ],
            'attributes' => [
                'value' => AccessRequest::STATUS_NEW,
            ],
        ]);

        $this->add([
            'name' => 'access_request_submit',
            'type' => Fieldset::class,
        ]);

        $this->get('access_request_submit')->add([
            'type' => Element\Submit::class,
            'name' => 'submit',
            'attributes' => [
                'value' => 'Save', // @translate
                'id' => 'submitbutton',
            ],
        ]);
    }

    protected function getStatusOptions()
    {
        return [
            AccessRequest::STATUS_NEW => 'New', // @translate
            AccessRequest::STATUS_RENEW => 'Renew', // @translate
            AccessRequest::STATUS_ACCEPTED => 'Accepted', // @translate
            AccessRequest::STATUS_REJECTED => 'Rejected', // @translate
        ];
    }
}
