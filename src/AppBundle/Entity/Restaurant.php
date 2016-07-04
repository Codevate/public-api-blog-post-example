<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;

/**
 * @ORM\Table(name="restaurant", indexes={@ORM\Index(name="hashid_idx", columns={"hashid"})})
 * @ORM\Entity()
 * @JMS\ExclusionPolicy("all")
 */
class Restaurant
{
  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   *
   * @JMS\Expose
   * @JMS\Groups({"Default"})
   */
  private $id;

  /**
   * @var string
   *
   * @ORM\Column(name="hashid", type="string", length=255, nullable=true)
   */
  private $hashid;

  /**
   * @var string
   *
   * @ORM\Column(name="name", type="string", length=255)
   *
   * @JMS\Expose
   * @JMS\Groups({"Default", "widget"})
   */
  private $name;

  /**
   * @var array
   *
   * @ORM\Column(name="menu", type="array")
   */
  private $menu;

  /**
   * @var Company
   *
   * @ORM\ManyToOne(targetEntity="Company", inversedBy="restaurants")
   */
  private $company;

  public function __construct()
  {
    $this->restaurants = new ArrayCollection();
  }

  /**
   * Get id
   *
   * @return integer
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set hashid
   *
   * @param string $hashid
   * @return $this
   */
  public function setHashid($hashid)
  {
    $this->hashid = $hashid;

    return $this;
  }

  /**
   * Get hashid
   *
   * @return string
   */
  public function getHashid()
  {
    return $this->hashid;
  }

  /**
   * Set name
   *
   * @param string $name
   * @return $this
   */
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get name
   *
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set menu
   *
   * @param string $menu
   * @return $this
   */
  public function setMenu($menu)
  {
    $this->menu = $menu;

    return $this;
  }

  /**
   * Get menu
   *
   * @return string
   */
  public function getMenu()
  {
    return $this->menu;
  }

  /**
   * Set company
   *
   * @param Company $company
   * @return $this
   */
  public function setCompany(Company $company = null)
  {
    $this->company = $company;

    return $this;
  }

  /**
   * Get company
   *
   * @return Company
   */
  public function getCompany()
  {
    return $this->company;
  }
}
