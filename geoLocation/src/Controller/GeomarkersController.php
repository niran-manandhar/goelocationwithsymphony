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
  if (isset($_POST['submitLocation'])) {
    $em = $this->getDoctrine()->getManager();

       $loc = new Geomarkers();
       $loc->setTitle( urlencode($_POST["location_value"]));
       $loc->setLng(urlencode($_POST["longField_searched"]));

       $loc->setLat(urlencode($_POST["latField_searched"]));
       $loc->setAddress(urlencode($_POST["address_searched"]));
       $loc->setImage('1.jpg');






       // tell Doctrine you want to (eventually) save the Product (no queries yet)
       $em->persist($loc);

       // actually executes the queries (i.e. the INSERT query)
       $em->flush();

       $address = urlencode($_POST["address_searched"]);
       $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyC2ssmB4OYp3klzfoEhQFrbIL57NbOcnK4";
       $resp_json = file_get_contents($url);
       $resp = json_decode($resp_json, true);
       if ($resp['status']=='OK') {
         $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
         $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
         $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
         if ($lati && $longi && $formatted_address) {
           return $this->render('geomarkers/index.html.twig', array(
                 'longitude' => $longi, 'latitude' => $lati, 'formatted_address'=> $formatted_address,'datasaved'=> true
           ));
         } else {
           return false;
         }
       }
       else {
         echo "<strong>ERROR: {$resp['status']}</strong>";
         return false;
       }



  }
    else if (isset($_GET['submitForm'])) {

          $address = urlencode($_GET["address"]);
          $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyC2ssmB4OYp3klzfoEhQFrbIL57NbOcnK4";
          $resp_json = file_get_contents($url);
          $resp = json_decode($resp_json, true);
          if ($resp['status']=='OK') {
            $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
            $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
            $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
            if ($lati && $longi && $formatted_address) {
              return $this->render('geomarkers/index.html.twig', array(
                    'longitude' => $longi, 'latitude' => $lati, 'formatted_address'=> $formatted_address
              ));
            } else {
              return false;
            }
          }
          else {
            echo "<strong>ERROR: {$resp['status']}</strong>";
            return false;
          }
        }
        else {
          return $this->render('geomarkers/index.html.twig');
        }





      // return new Response('Saved new product with id '.$loc->getId());
    }

    /**
 * @Route("/geomarkers/show/{id}", name="geomarkers_show")
 */
public function showAction($id)
{

$repository = $this->getDoctrine()->getRepository(Geomarkers::class);
$geomarkers = $repository->find($id);
$address=$geomarkers->getAddress();
    if (!$geomarkers) {
        throw $this->createNotFoundException(
            'No product found for id '.$id
        );
    }



    $url = "https://maps.googleapis.com/maps/api/geocode/json?address={$address}&key=AIzaSyC2ssmB4OYp3klzfoEhQFrbIL57NbOcnK4";
    $resp_json = file_get_contents($url);
    $resp = json_decode($resp_json, true);
    if ($resp['status']=='OK') {
      $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
      $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
      $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
      if ($lati && $longi && $formatted_address) {
        return $this->render('geomarkers/get.html.twig',['location' => $geomarkers]);
      } else {
        return false;
      }
    }
    else {
      echo "<strong>ERROR: {$resp['status']}</strong>";
      return false;
    }



}

/**
* @Route("/geomarkers/showall", name="showall")
*/
public function showAll()
{

$repository = $this->getDoctrine()->getRepository(Geomarkers::class);
$geomarkers = $repository->findAll();

if (!$geomarkers) {
    throw $this->createNotFoundException(
        'No product found for id '.$id
    );
}




    return $this->render('geomarkers/showall.html.twig',['location' => $geomarkers]);

}
}
