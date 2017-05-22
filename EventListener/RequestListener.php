<?php

namespace Elephantly\StaticContentBundle\EventListener;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Twig_Environment;
use Elephantly\ResourceBundle\Doctrine\ORM\GenericRepository;

/**
* primary @author purplebabar(lalung.alexandre@gmail.com)
*/
class RequestListener extends ContainerAware
{
    protected $twig;

    protected $staticContentRepository;

    function __construct(Twig_Environment $twig, GenericRepository $staticContentRepository)
    {
        $this->twig = $twig;
        $this->staticContentRepository = $staticContentRepository;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
            // Query values
            $staticValues = $this->staticContentRepository->findBy(array());

            // Adding Twig global
            foreach ($staticValues as $staticValue) {
                $this->twig->addGlobal($staticValue->getSlug(), $staticValue->getValue());
            }
    }

}
