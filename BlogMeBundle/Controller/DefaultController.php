<?php

namespace BlogMe\BlogMeBundle\Controller;

use BlogMe\BlogMeBundle\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
		//$this->createAction();
		$allArticles = $this->getAllArticles();

		$array = array(
			'name' => $name,
			'allArticles' => $allArticles
		);
        return $this->render('BlogMeBundle:Default:index.html.twig', $array);
    }

	public function createAction() {
		$article = new Article();
		$article->setTitle('Ein neues Projekt');
		$article->setSubtitle('Erstellt von Dennis und Fokke');
		$article->setMessage('Danke');

		$em = $this->getDoctrine()->getManager();
		$em->persist($article);
		$em->flush();

		return new Response('Created product id '.$article->getId());
	}

	public function getAllArticles() {
		$allArticles = $this->getDoctrine()->getRepository('BlogMeBundle:Article')->findAll();

		return $allArticles;
	}
}
