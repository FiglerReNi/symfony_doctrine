<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\RedditPost;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RedditController extends Controller
{
    /**
     * @Route("/", name="list")
     */
    public function listAction(Request $request)
    {
        $posts = $this->getDoctrine()->getRepository('AppBundle:RedditPost')->findAll();
        return $this->render('reddit/index.html.twig', [
            'posts' => $posts
        ]);

//        $post = $this->getDoctrine()->getRepository('AppBundle:RedditPost')->find(1);
//        return $this->render('reddit/index.html.twig', [
//            'post' => $post
//        ]);

//        $post = $this->getDoctrine()->getRepository('AppBundle:RedditPost')->findOneBy([
//            'id' => 3
//        ]);
//        return $this->render('reddit/index.html.twig', [
//            'post' => $post
//        ]);

//        $posts = $this->getDoctrine()->getRepository('AppBundle:RedditPost')->findBy([
//            'id' => [1,3]
//        ]);
//        return $this->render('reddit/index.html.twig', [
//            'posts' => $posts
//        ]);
    }

//    /**
//     * @Route("/create", name="create")
//     */
//    public function createAction()
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $post = new RedditPost();
//        $post->setTitle('hello chris');
//
//        $em->persist($post);
//        $em->flush();
//
//        return $this->redirectToRoute('list');
//    }

    /**
     * @Route("/create/{text}", name="create")
     */
    public function createAction($text)
    {
        $em = $this->getDoctrine()->getManager();

        $post = new RedditPost();
        $post->setTitle('hello ' . $text);

        $em->persist($post);
        $em->flush();

        return $this->redirectToRoute('list');
    }

//    /**
//     * @Route("/update", name="update")
//     */
//    public function updateAction()
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $post = $em->getRepository('AppBundle:RedditPost')->find(2);
//        $post->setTitle('updated title');
//
//        $em->flush();
//
//        return $this->redirectToRoute('list');
//    }

    /**
     * @Route("/update/{id}/{text}", name="update")
     */
    public function updateAction($id, $text)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('AppBundle:RedditPost')->find($id);

        if(!$post){
            throw $this->createNotFoundException('thats not a record');
        }

        $post->setTitle('updated title ' . $text);

        $em->flush();

        return $this->redirectToRoute('list');
    }

//    /**
//     * @Route("/delete", name="delete")
//     */
//    public function deleteAction()
//    {
//        $em = $this->getDoctrine()->getManager();
//
//        $post = $em->getRepository('AppBundle:RedditPost')->find(5);
//
//        if(!$post){
//            throw $this->createNotFoundException('thats not a record');
//        }
//
//        $em->remove($post);
//        $em->flush();
//
//        return $this->redirectToRoute('list');
//    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('AppBundle:RedditPost')->find($id);

        if(!$post){
            throw $this->createNotFoundException('thats not a record');
        }

        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('list');
    }
}
