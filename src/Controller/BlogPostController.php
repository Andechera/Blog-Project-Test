<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Form\BlogPostType;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// BlogPostController gestisce la logica CRUD per i post del blog.
class BlogPostController extends AbstractController
{
    // Variabile che conterrà l'entityManager una volta creato il post.
    private $em;

    // Creaiamo il post(oggetto) con la variabile già assegnata all'entityManager, così da poterlo richiamare in ogni metodo.
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    // Definizione rotta per la visualizzazione dei post
    #[Route('/blog', name: 'app_blog_post')]
    // Metodo per visualizzare la lista di tutti i post. Utilizza KNP Paginator per gestire la paginazione.
    public function index(Request $request, PaginatorInterface $paginator): Response
    {
        $queryPosts = $this->em->getRepository(BlogPost::class)
                                ->createQueryBuilder('post')
                                ->orderBy('post.createdAt', 'DESC');

        $posts = $paginator->paginate(
            $queryPosts,
            $request->query->getInt('page', 1),
            5
        );

        return $this->render('blog_post/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    // Definizione rotta per creare un post
    #[Route('/create-post', name: 'create-post')]
    // Metodo per creare un nuovo post. Usa BlogPostType per creare il form di inserimento.
    public function create(Request $req): Response
    {
        $post = new BlogPost();
        $form = $this->createForm(BlogPostType::class, $post);
        $form->handleRequest($req);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($post);
            $this->em->flush();

            $this->addFlash('message', 'Il post è stato inserito con successo!');
            return $this->redirectToRoute('app_blog_post');
        }

        return $this->render('blog_post/post.html.twig', [
            'form' => $form->createview(),
        ]);
    }

    // Definizione rotta per modificare un post
    #[Route('/edit-post/{id}', name: 'edit-post')]
    // Metodo per modificare un post. Richiede request e id per modificare il giusto post selezionato.
    public function edit(Request $req, $id)
    {
        $post = $this->em->getRepository(BlogPost::class)->find($id);
        $form = $this->createForm(BlogPostType::class, $post);
        $form->handleRequest($req);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($post);
            $this->em->flush();

            $this->addFlash('message', 'Il post è stato modificato con successo!');
            return $this->redirectToRoute('app_blog_post');
        }

        return $this->render('blog_post/post.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // Definizione rotta per cancellare un post
    #[Route('/delete-post/{id}', name: 'delete-post')]
    // Metodo per cancellare un post. Richiede l'id per cancellare il giusto post selezionato.
    public function delete($id)
    {

        $post = $this->em->getRepository(BlogPost::class)->find($id);

        $this->em->remove($post);
        $this->em->flush();

        $this->addFlash('message', 'Il post è stato eliminato con successo!');
        return $this->redirectToRoute('app_blog_post');
    }
}
