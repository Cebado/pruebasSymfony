<?php

namespace Acme\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\StoreBundle\Entity\Product;
use Acme\StoreBundle\Entity\Picture;
use Acme\StoreBundle\Entity\Task;
use Acme\StoreBundle\Form\Type\PictureType;
use Acme\StoreBundle\Form\Type\TaskType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    
    public function createAction($nombre)
    {
        $product = new Product();
        $product->setName($nombre);
        $product->setPrice('19.99');
        $product->setDescription('Lorem ipsum dolor');

        $em = $this->getDoctrine()->getManager();
        $em->persist($product);
        $em->flush();

        return new Response('Created product id '.$product->getId());
    }
    
    
    public function readAction($id)
    {
    $product = $this->getDoctrine()
        ->getRepository('AcmeStoreBundle:Product')
        ->find($id);

    if (!$product) {
        throw $this->createNotFoundException(
            'No product found for id '.$id
        );
    }else{
        return $this->render(
            'AcmeStoreBundle:Default:read.html.twig',
            array('producto' => $product)
        );
    }

    }
    
    public function imgAction(Request $request)
    {
        $picture = new Picture();
        $form = $this -> createForm(new PictureType(), $picture);

        if($request->isMethod('POST'))
        {
            $form->bind($this->getRequest());
            if($form->isValid())
            {
                $picture->upload();
                $em = $this -> getDoctrine() -> getManager();
                $em->persist($picture);
                $em->flush();
 
             }else
            {
                $this->get('session')->getFlashBag()->add('fail', 'Fallo en el envío del formulario');
                return $this->redirect($this->generateUrl('acme_inicio_homepage'));
            }
        }

        return $this->render('AcmeStoreBundle:Default:img.html.twig', array('pictureform' => $form->createView()));
    }
    
    public function newAction(Request $request)
    {
        // crea una task y le asigna algunos datos ficticios para este ejemplo
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

      /*  $form = $this->createFormBuilder($task)
            ->add('task', 'text')
            ->add('dueDate', 'date')
            ->getForm();*/
        $form = $this->createForm(new TaskType(), $task);

        if ($request->isMethod('POST')) {
        $form->bind($request);

        if ($form->isValid()) {
            // realiza alguna acción, tal como guardar la tarea en la base de datos

            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirect($this->generateUrl('acme_inicio_homepage'));
        }
    }
        
        return $this->render('AcmeStoreBundle:Default:new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
