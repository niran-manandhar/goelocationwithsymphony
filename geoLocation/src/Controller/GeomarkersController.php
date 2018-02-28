<?php

namespace App\Controller;
use App\Entity\Geomarkers;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Flex\Response;
class GeomarkersController extends Controller
{
    /**
     * @Route("/geomarkers", name="geomarkers")
     */
    public function index()
    {
    $em = $this->getDoctrine()->getManager();

       $loc = new Geomarkers();
       $loc->setTitle('Kathmandu');
       $loc->setLng(19.99);
       $loc->setLat(19.99);
       $loc->setAddress('My home town');
       $loc->setImage('1.jpg');

       // tell Doctrine you want to (eventually) save the Product (no queries yet)
       $em->persist($loc);

       // actually executes the queries (i.e. the INSERT query)
       $em->flush();
return $this->render('geomarkers/index.html.twig', ['location' => $loc]);
      // return new Response('Saved new product with id '.$loc->getId());
    }

    /**
 * @Route("/geomarkers/{id}", name="geomarkers_show")
 */
public function showAction($id)
{

$repository = $this->getDoctrine()->getRepository(Geomarkers::class);
$geomarkers = $repository->find($id);

    if (!$geomarkers) {
        throw $this->createNotFoundException(
            'No product found for id '.$id
        );
    }
    return $this->render('geomarkers/get.html.twig', ['location' => $geomarkers]);
}
}
