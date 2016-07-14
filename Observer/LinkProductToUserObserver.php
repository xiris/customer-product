<?php namespace Xiris\CustomerProduct\Observer;

use Magento\Framework\Event\ObserverInterface;

class LinkProductToUserObserver implements ObserverInterface
{
    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected $session;

    public function __construct(\Magento\Backend\Model\Auth\Session $session)
    {
        $this->session = $session;
    }
    /**
     * Checking whether the using static urls in WYSIWYG allowed event
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        /** @var \Magento\User\Model\User $user */
        $user = $this->session->getUser();

        /** @var \Magento\Catalog\Model\Product $product */
        $product = $observer->getEvent()->getProduct();
        $product->setUserId($user->getId());
    }
}
