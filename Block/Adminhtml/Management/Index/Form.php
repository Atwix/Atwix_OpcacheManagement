<?php
/**
 * Created by PhpStorm.
 * User: weysman
 * Date: 5/12/17
 * Time: 10:57 PM
 */

namespace Glushko\OpCacheManagement\Block\Adminhtml\Management\Index;

use Magento\Backend\Block\Widget\Form\Generic as GenericFormWidget;

/**
 * Class Form
 */
class Form extends GenericFormWidget
{
    /**
     * @inheritdoc
     */
    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id' => 'edit_form',
                    'action' => $this->getUrl('adminhtml/*/save'),
                    'enctype' => 'multipart/form-data',
                    'method' => 'post',
                ],
            ]
        );

        $form->setUseContainer(true);
        $this->setForm($form);
        
        return parent::_prepareForm();
    }
}
