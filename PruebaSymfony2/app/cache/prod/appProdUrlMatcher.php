<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appProdUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appProdUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);

        // acme_store_homepage
        if (0 === strpos($pathinfo, '/store') && preg_match('#^/store(?:/(?P<nombre>[^/]++))?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'acme_store_homepage')), array (  '_controller' => 'Acme\\StoreBundle\\Controller\\DefaultController::createAction',  'nombre' => 'objeto',));
        }

        // acme_read_homepage
        if (0 === strpos($pathinfo, '/read') && preg_match('#^/read(?:/(?P<id>[^/]++))?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'acme_read_homepage')), array (  '_controller' => 'Acme\\StoreBundle\\Controller\\DefaultController::readAction',  'id' => 1,));
        }

        // acme_store_image
        if ($pathinfo === '/img') {
            return array (  '_controller' => 'Acme\\StoreBundle\\Controller\\DefaultController::imgAction',  '_route' => 'acme_store_image',);
        }

        // task_new
        if ($pathinfo === '/task') {
            return array (  '_controller' => 'Acme\\StoreBundle\\Controller\\DefaultController::newAction',  '_route' => 'task_new',);
        }

        // acme_inicio_homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'acme_inicio_homepage');
            }

            return array (  '_controller' => 'Acme\\InicioBundle\\Controller\\InicioController::indexAction',  '_route' => 'acme_inicio_homepage',);
        }

        // acme_contacto_homepage
        if ($pathinfo === '/contacto') {
            return array (  '_controller' => 'Acme\\InicioBundle\\Controller\\InicioController::contactoAction',  '_route' => 'acme_contacto_homepage',);
        }

        // acme_hello_homepage
        if (0 === strpos($pathinfo, '/hello') && preg_match('#^/hello(?:/(?P<name>[^/]++))?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'acme_hello_homepage')), array (  '_controller' => 'Acme\\HelloBundle\\Controller\\HelloController::indexAction',  'name' => 'luis',));
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
