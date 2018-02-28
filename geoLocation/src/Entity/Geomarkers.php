<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GeomarkersRepository")
 */
class Geomarkers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
        * @ORM\Column(type="string", length=100)
        */
       private $title;

       /**
           * @ORM\Column(type="string", length=100)
           */
          private $address;

          /**
     * @ORM\Column(type="decimal", scale=6, nullable=true)
     */
             private $lat;

             /**
        * @ORM\Column(type="decimal", scale=6, nullable=true)
        */
                private $lng;

                /**
                    * @ORM\Column(type="string", length=200)
                    */
                   private $image;


  public function getId()
  {
      return $this->id;
  }

  public function getTitle()
  {
      return $this->title;
  }

  public function setTitle($title)
  {
      $this->title = $title;
  }
  public function getAddress()
  {
      return $this->address;
  }

  public function setAddress($address)
  {
      $this->address = $address;
  }
  public function getLat()
  {
      return $this->lat;
  }

  public function setLat($lat)
  {
      $this->lat = $lat;
  }
  public function getLng()
  {
      return $this->lng;
  }

  public function setLng($lng)
  {
      $this->lng = $lng;
  }
  public function getImage()
  {
      return $this->image;
  }

  public function setImage($image)
  {
      $this->image = $image;
  }
  //php bin/console doctrine:query:sql 'SELECT * FROM Geomarkers'
}
