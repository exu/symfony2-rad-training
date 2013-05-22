<?php

namespace Context;

use Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\MinkContext;
use Behat\Symfony2Extension\Context\KernelAwareInterface;

use Symfony\Component\HttpKernel\KernelInterface;
use Doctrine\Common\Util\Inflector;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;


use App\Entity;

class FeatureContext extends MinkContext implements KernelAwareInterface
{
    private $kernel;

    public function __construct()
    {
        $this->useContext('homepage', new HomeContext());
        $this->useContext('contact-list',  new ContactsListContext());
        $this->useContext('contact-new',  new ContactsNewContext());
    }

    /**
     * @BeforeScenario
     */
    public function purgeDatabase()
    {
        (new ORMPurger(
            $this->getContainer()->get('doctrine.orm.default_entity_manager')))->purge();
    }

    /**
     * @BeforeScenario
     */
    public function clearMailerMessages()
    {
        $this->getContainer()->get('knp_rad.mailer.messages_store')->clear();
    }



    /**
     * @Given /^I am on the ([\w\s]+)( page)?$/
     * @When /^I go to the ([\w\s]+)( page)?$/
     */
    public function iAmOnThePage($page)
    {
        $this->getSession()->visit($this->generatePageUrl($page));
    }

    /**
     * Sets Kernel instance.
     *
     * @param KernelInterface $kernel HttpKernel instance
     */
    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * Returns Container instance.
     *
     * @return ContainerInterface
     */
    private function getContainer()
    {
        return $this->kernel->getContainer();
    }

    /**
     * Generates url with Router.
     *
     * @param string  $route
     * @param array   $parameters
     * @param Boolean $absolute
     *
     * @return string
     */
    private function generateUrl($route, array $parameters = array(), $absolute = false)
    {
        return $this->getContainer()->get('router')->generate($route, $parameters, $absolute);
    }

    /**
     * Generate page url from name and parameters.
     *
     * @param string $page
     * @param array  $parameters
     *
     * @return string
     */
    private function generatePageUrl($page, array $parameters = array())
    {
        $parts = explode(' ', trim($page), 2);
        if (2 === count($parts)) {
            $parts[1] = Inflector::camelize($parts[1]);
        }

        $route  = implode('_', $parts);
        $routes = $this->getContainer()->get('router')->getRouteCollection();

        if (null === $routes->get($route)) {
            $route = 'app_'.$route;
        }

        return $this->getMinkParameter('base_url').$this->generateUrl($route, $parameters);
    }

    /**
     * @Then /^I should be on the ([\w\s]+)( page)?$/
     */
    public function iShouldBeOnThePage($page)
    {
        $parameters = [];

        $this->assertSession()->statusCodeEquals(200);
        $this->assertSession()->addressEquals($this->generatePageUrl($page, $parameters));
    }
}
