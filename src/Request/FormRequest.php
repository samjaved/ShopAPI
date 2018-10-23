<?php

namespace App\Request;

use RuntimeException;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Based on SymfonyFormRequest class from NoFrameworkBundle
 */
class FormRequest
{
    /** @var Request */
    private $request;

    /** @var FormFactoryInterface */
    private $formFactory;

    /** @var FormInterface */
    private $form;

    /**
     * @param Request $request
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(Request $request, FormFactoryInterface $formFactory)
    {
        $this->request = $request;
        $this->formFactory = $formFactory;
    }

    /**
     * Attempt to handle a form and return true when handled and data is valid.
     *
     * @param string $formType
     * @param array|object $bindData
     * @param array $options
     *
     * @return bool
     */
    public function handle($formType, $bindData = null, array $options = array()): bool
    {
        if ($this->form !== null) {
            throw new RuntimeException('Form already handled');
        }

        $this->form = $this->formFactory->create($formType, $bindData, $options);
        $this->form->handleRequest($this->request);

        //If no data was sent => force commit empty form (API behaviour)
        if (!$this->form->isSubmitted()) {
            $this->form->submit([]);
        }

        return $this->form->isValid();
    }

    /**
     * Use this to retrieve the validated data from the form even when you attached `$bindData`.
     *
     * Only by using this method you can mock the form handling by providing a replacement valid value in tests.
     *
     * @return mixed
     */
    public function getValidData()
    {
        $this->assertFormHandled();

        return $this->form->getData();
    }

    /**
     * @return \Symfony\Component\Form\FormInterface
     */
    public function getForm(): FormInterface
    {
        $this->assertFormHandled();

        return $this->form;
    }

    private function assertFormHandled()
    {
        if ($this->form === null) {
            throw new RuntimeException('Form was not handled yet');
        }
    }
}
