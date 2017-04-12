<?php

namespace AppBundle\Controller;

use Elasticsearch\ClientBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $defaultData = array('query' => 'Type your query here');
        $form = $this->createFormBuilder($defaultData)
            ->setMethod("GET")
            ->add('query', TextType::class)
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        $results = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $query = $data['query'];

            $results = $this->get('elasticsearch.engine')->search($query);
        }

        return $this->render('search/index.html.twig', [
            'form' => $form->createView(),
            'results' => $results
        ]);
    }
}
