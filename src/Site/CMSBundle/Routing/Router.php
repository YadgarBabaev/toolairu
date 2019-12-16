<?php

namespace Site\CMSBundle\Routing;

use Symfony\Bundle\FrameworkBundle\Routing\Router as BaseRouter;
use Symfony\Component\HttpKernel\CacheWarmer\WarmableInterface;
use Symfony\Component\Config\ConfigCache;
use Symfony\Component\Config\ConfigCacheInterface;
use Symfony\Component\Config\ConfigCacheFactoryInterface;
use Symfony\Component\Config\ConfigCacheFactory;
use Symfony\Component\Routing\Generator\ConfigurableRequirementsInterface;


class Router extends BaseRouter implements WarmableInterface
{
    /**
     * @var ConfigCacheFactoryInterface|null
     */
    private $configCacheFactory;

    /**
     * @var ExpressionFunctionProviderInterface[]
     */
    private $expressionLanguageProviders = array();

    public function getExpressionLanguageProviders()
    {
//        return $this->()
    }

    public function getMatcher()
    {
        if (null !== $this->matcher) {
            return $this->matcher;
        }

        if (null === $this->options['cache_dir'] || null === $this->options['matcher_cache_class']) {
            $this->matcher = new $this->options['matcher_class']($this->getRouteCollection(), $this->context);
            if (method_exists($this->matcher, 'addExpressionLanguageProvider')) {
                foreach ($this->expressionLanguageProviders as $provider) {
                    $this->matcher->addExpressionLanguageProvider($provider);
                }
            }

            return $this->matcher;
        }
        $cache = $this->getConfigCacheFactory()->cache($this->options['cache_dir'] . '/' . $this->options['matcher_cache_class'] . '.php',
            function (ConfigCacheInterface $cache) {
            }
        );
        $dumper = $this->getMatcherDumperInstance();
        if (method_exists($dumper, 'addExpressionLanguageProvider')) {
            foreach ($this->expressionLanguageProviders as $provider) {
                $dumper->addExpressionLanguageProvider($provider);
            }
        }

        $options = array(
            'class' => $this->options['matcher_cache_class'],
            'base_class' => $this->options['matcher_base_class'],
        );

        $cache->write($dumper->dump($options), $this->getRouteCollection()->getResources());

        require_once $cache->getPath();
        return parent::getMatcher();
    }

    public function getGenerator()
    {
        if (null !== $this->generator) {
            return $this->generator;
        }

        if (null === $this->options['cache_dir'] || null === $this->options['generator_cache_class']) {
            $this->generator = new $this->options['generator_class']($this->getRouteCollection(), $this->context, $this->logger);
        } else {
            $cache = $this->getConfigCacheFactory()->cache($this->options['cache_dir'] . '/' . $this->options['generator_cache_class'] . '.php',
                function (ConfigCacheInterface $cache) {
                }
            );
            $dumper = $this->getGeneratorDumperInstance();
            $options = array(
                'class' => $this->options['generator_cache_class'],
                'base_class' => $this->options['generator_base_class'],
            );
            $cache->write($dumper->dump($options), $this->getRouteCollection()->getResources());
            require_once $cache->getPath();
            $this->generator = new $this->options['generator_cache_class']($this->context, $this->logger);
        }

        if ($this->generator instanceof ConfigurableRequirementsInterface) {
            $this->generator->setStrictRequirements($this->options['strict_requirements']);
        }
        parent::getGenerator();
        return $this->generator;
    }

    private function getConfigCacheFactory()
    {
        if (null === $this->configCacheFactory) {
            $this->configCacheFactory = new ConfigCacheFactory($this->options['debug']);
        }

        return $this->configCacheFactory;
    }

}
