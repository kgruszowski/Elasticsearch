<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    /**
     * @Route("/", name="products_search")
     */
    public function indexAction(Request $request)
    {
        $form = $this->createFormBuilder(null, ['csrf_protection' => false])
            ->setMethod("GET")
            ->add('query', TextType::class)
            ->add('search', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);
        $results = [];

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $query = $data['query'];

            $page = $request->query->get('page');

            $paginator = $this->get('paginator');
            $paginator->setPage($page);

            $results = $this->get('elasticsearch.engine')->search($query, $paginator);

            return $this->render('search/index.html.twig', [
                'form' => $form->createView(),
                'results' => $results,
                'paginator' => $paginator->paginate($results['hits']['total'])
            ]);
        }

        return $this->render('search/index.html.twig', [
            'form' => $form->createView(),
            'results' => $results
        ]);
    }
}
