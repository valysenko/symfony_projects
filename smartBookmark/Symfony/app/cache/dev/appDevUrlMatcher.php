<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
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
        $context = $this->context;
        $request = $this->request;

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_purge
                if ($pathinfo === '/_profiler/purge') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:purgeAction',  '_route' => '_profiler_purge',);
                }

                if (0 === strpos($pathinfo, '/_profiler/i')) {
                    // _profiler_info
                    if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                    }

                    // _profiler_import
                    if ($pathinfo === '/_profiler/import') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:importAction',  '_route' => '_profiler_import',);
                    }

                }

                // _profiler_export
                if (0 === strpos($pathinfo, '/_profiler/export') && preg_match('#^/_profiler/export/(?P<token>[^/\\.]++)\\.txt$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_export')), array (  '_controller' => 'web_profiler.controller.profiler:exportAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            if (0 === strpos($pathinfo, '/_configurator')) {
                // _configurator_home
                if (rtrim($pathinfo, '/') === '/_configurator') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_configurator_home');
                    }

                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
                }

                // _configurator_step
                if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_configurator_step')), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',));
                }

                // _configurator_final
                if ($pathinfo === '/_configurator/final') {
                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
                }

            }

        }

        // vladyslav_smart_bookmark_homepage
        if (preg_match('#^/(?P<_locale>[^/]++)/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'vladyslav_smart_bookmark_homepage')), array (  '_controller' => 'Vladyslav\\SmartBookmarkBundle\\Controller\\DefaultController::indexAction',));
        }

        // index_page
        if (preg_match('#^/(?P<_locale>[^/]++)/?$#s', $pathinfo, $matches)) {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'index_page');
            }

            return $this->mergeDefaults(array_replace($matches, array('_route' => 'index_page')), array (  '_controller' => 'Vladyslav\\SmartBookmarkBundle\\Controller\\IndexController::indexAction',));
        }

        // cabinet
        if (preg_match('#^/(?P<_locale>[^/]++)/cabinet(?:/(?P<page>\\d+)(?:/(?P<category_id>\\d+))?)?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'cabinet')), array (  '_controller' => 'Vladyslav\\SmartBookmarkBundle\\Controller\\CabinetController::cabinetAction',  'page' => 1,  'category_id' => 0,));
        }

        // add_bookmark
        if (preg_match('#^/(?P<_locale>[^/]++)/cabinet/add$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'add_bookmark')), array (  '_controller' => 'Vladyslav\\SmartBookmarkBundle\\Controller\\CabinetController::addBookmarkAction',));
        }

        // delete_bookmark
        if (preg_match('#^/(?P<_locale>[^/]++)/cabinet/delete/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'delete_bookmark')), array (  '_controller' => 'Vladyslav\\SmartBookmarkBundle\\Controller\\CabinetController::deleteBookmarkAction',));
        }

        // add_responsed_bookmark
        if (preg_match('#^/(?P<_locale>[^/]++)/cabinet/add/responsed/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'add_responsed_bookmark')), array (  '_controller' => 'Vladyslav\\SmartBookmarkBundle\\Controller\\CabinetController::addResponsedBookmarkAction',));
        }

        // delete_responsed_bookmark
        if (preg_match('#^/(?P<_locale>[^/]++)/cabinet/delete/responsed/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'delete_responsed_bookmark')), array (  '_controller' => 'Vladyslav\\SmartBookmarkBundle\\Controller\\CabinetController::deleteResponsedBookmarkAction',));
        }

        // add_all
        if (preg_match('#^/(?P<_locale>[^/]++)/cabinet/add/all$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'add_all')), array (  '_controller' => 'Vladyslav\\SmartBookmarkBundle\\Controller\\CabinetController::addAllAction',));
        }

        // delete_all
        if (preg_match('#^/(?P<_locale>[^/]++)/cabinet/delete/all$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'delete_all')), array (  '_controller' => 'Vladyslav\\SmartBookmarkBundle\\Controller\\CabinetController::deleteAllAction',));
        }

        // cabinet_mail
        if (preg_match('#^/(?P<_locale>[^/]++)/cabinet/mail$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'cabinet_mail')), array (  '_controller' => 'Vladyslav\\SmartBookmarkBundle\\Controller\\CabinetController::sendMailAction',));
        }

        // send_bookmark
        if (preg_match('#^/(?P<_locale>[^/]++)/cabinet/send/(?P<id>\\d+)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'send_bookmark')), array (  '_controller' => 'Vladyslav\\SmartBookmarkBundle\\Controller\\CabinetController::sendBookmarkAction',));
        }

        // responsed_bookmarks
        if (preg_match('#^/(?P<_locale>[^/]++)/cabinet/responsed(?:/(?P<page>\\d+))?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'responsed_bookmarks')), array (  '_controller' => 'Vladyslav\\SmartBookmarkBundle\\Controller\\CabinetController::responsedBookmarksAction',  'page' => 1,));
        }

        // popular_bookmarks
        if (preg_match('#^/(?P<_locale>[^/]++)/cabinet/popular(?:/(?P<category_id>\\d+))?$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'popular_bookmarks')), array (  '_controller' => 'Vladyslav\\SmartBookmarkBundle\\Controller\\CabinetController::popularAction',  'category_id' => 0,));
        }

        // login_path
        if (preg_match('#^/(?P<_locale>[^/]++)/login$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'login_path')), array (  '_controller' => 'Vladyslav\\SmartBookmarkBundle\\Controller\\SecurityController::loginAction',));
        }

        // registration_path
        if (preg_match('#^/(?P<_locale>[^/]++)/registration$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'registration_path')), array (  '_controller' => 'Vladyslav\\SmartBookmarkBundle\\Controller\\SecurityController::registrationAction',));
        }

        // restore_password
        if (preg_match('#^/(?P<_locale>[^/]++)/restore/password$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'restore_password')), array (  '_controller' => 'Vladyslav\\SmartBookmarkBundle\\Controller\\SecurityController::restorePasswordAction',));
        }

        // user_edit
        if (preg_match('#^/(?P<_locale>[^/]++)/cabinet/user/edit$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'user_edit')), array (  '_controller' => 'Vladyslav\\SmartBookmarkBundle\\Controller\\CabinetController::editUserAction',));
        }

        if (0 === strpos($pathinfo, '/log')) {
            // check_path
            if ($pathinfo === '/login_check') {
                return array('_route' => 'check_path');
            }

            // logout
            if ($pathinfo === '/logout') {
                return array('_route' => 'logout');
            }

        }

        // slash_page
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'slash_page');
            }

            return array (  '_controller' => 'Vladyslav\\SmartBookmarkBundle\\Controller\\IndexController::slashAction',  '_route' => 'slash_page',);
        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
