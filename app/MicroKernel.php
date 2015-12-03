<?php
namespace App;

use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

class MicroKernel extends Kernel
{
    use MicroKernelTrait;

    public function registerBundles()
    {
        return [
            new FrameworkBundle(),
            new TwigBundle(),
        ];
    }

    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
        $routes->add('/{path}', 'kernel:indexAction', 'index')
            ->addRequirements(['path' => '.+'])
            ->addDefaults(['path' => '']);
    }

    protected function configureContainer(ContainerBuilder $c, LoaderInterface $loader)
    {
        $c->loadFromExtension('framework', ['secret' => '12345', 'templating' => ['engines' => ['twig']]]);
    }

    public function indexAction($path)
    {
        if ($path === '') {
            $path = 'index';
        }

        $templateFile = __DIR__ . '/resources/' . $path . '.html.twig';
        if (!is_file($templateFile)) {
            throw new NotFoundHttpException;
        }

        $templateData = [];

        foreach (['global', $path] as $dataFileSuffix) {
            $dataPath = __DIR__ . '/data/' . $dataFileSuffix . '.json';
            if (is_file($dataPath)) {
                $templateData = array_merge($templateData, json_decode(file_get_contents($dataPath), true));
            }
        }

        return $this->container->get('templating')->renderResponse($path . '.html.twig', $templateData);
    }
}
