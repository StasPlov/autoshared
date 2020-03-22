<?php

namespace App\Controller;

use App\Entity\CatalogAuto;
use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class APIController extends AbstractController
{
    
    // API
    /** Добаление нового авто
    * @Route("/api/add_auto/token={token}&mark={mark}&model={model}&sterring={sterring}&description={description}", name="ApiAddAuto", requirements={"description"=".+"})
    */
    public function ApiAddAuto(EntityManagerInterface $entityManager, Request $request) 
    {
        // Добавеляем в массив данные полученые из GET запроса к серверу.
        $data = [
            'token'=>$request->get('token'),
            'mark'=>$request->get('mark'),
            'model'=>$request->get('model'),
            'sterring'=>$request->get('sterring'),
            'description'=>$request->get('description'),
            
        ];
        
        // Првоеряем переданый ключ (token), если он не верный -> возвращаем респонс с ошибкой
        if($data['token'] != $_ENV['APP_SECRET']) {
            return new Response('Неверный ключ');
        }

        // Создаем объект сущьности (Entity) CatalogAuto для рабты с БД
        $catalogAuto = new CatalogAuto();

        $catalogAuto->setMark($data['mark']);
        $catalogAuto->setModel($data['model']);
        $catalogAuto->setSteering($data['sterring']);
        $catalogAuto->setDescription($data['description']);

        //Создаем новый объект в БД
        $entityManager->persist($catalogAuto); 
        $entityManager->flush();
        
        return new Response('Объект добавлен');
    }


    /** Удаление авто 
    * @Route("/api/delete_auto/token={token}&{id}", name="ApiDeleteAuto")
    */
    public function ApiDeleteAuto(CatalogAuto $catalogAuto, EntityManagerInterface $entityManager, Request $request) 
    {
        $token = $request->get('token');

        if($token != $_ENV['APP_SECRET']) {
            return new Response('Неверный ключ');
        }
        
        $entityManager->remove($catalogAuto);
        $entityManager->flush();
        
        return new Response('Объект удален');
    }


    /** Обновление данных по авто 
    * @Route("/api/update_auto/token={token}&mark={mark}&model={model}&sterring={sterring}&description={description}&id={id}", name="ApiUpdateAuto", requirements={"description"=".+"})
    */
    public function ApiUpdateAuto(CatalogAuto $catalogAuto, EntityManagerInterface $entityManager, Request $request) 
    {
        $data = [
            'token'=>$request->get('token'),
            'mark'=>$request->get('mark'),
            'model'=>$request->get('model'),
            'sterring'=>$request->get('sterring'),
            'description'=>$request->get('description')
        ];
        

        if($data['token'] != $_ENV['APP_SECRET']) {
            return new Response('Неверный ключ');
        }

        $catalogAuto->setMark($data['mark']);
        $catalogAuto->setModel($data['model']);
        $catalogAuto->setSteering($data['sterring']);
        $catalogAuto->setDescription($data['description']);
        
        // Обновляем дынные в БД
        $entityManager->flush();
        
        return new Response('Объект обновлен');
    }

    /** Получение всех авто
    * @Route("/api/get_all_auto", name="ApiGetAllAuto")
    */
    public function ApiGetAllAuto(EntityManagerInterface $entityManager) 
    {
        $allAuto = $entityManager->getRepository(CatalogAuto::class)->findBy([], ['id' => 'DESC']);
        return new Response($this->json($allAuto));
    }

    /** Получение Данных авто по id в БД
    * @Route("/api/get_auto/&id={id}", name="ApiGetAllAuto")
    */
    public function catalogAutoGet(EntityManagerInterface $entityManager, Request $request) 
    {
        $Auto = $entityManager->getRepository(CatalogAuto::class)->findBy(['id' => $request->get('id')]);
        return new Response($this->json($Auto));
    }

    /** Добаление нового коментария
    * @Route("/api/add_comment/&content={content}&pageid={pageid}", name="catalogAutoAddComment")
    */
    public function catalogAutoAddComment(EntityManagerInterface $entityManager, Request $request) 
    {
        $comment_text = $request->get('content');
        $page_id = $request->get('pageid');
        
        $catalogAuto = $entityManager->getRepository(CatalogAuto::class)->findOneBy(['id' => $page_id]);

        $comment = new Comment();
        $comment->setContent($comment_text);
        $comment->setPage($catalogAuto);

        $entityManager->persist($comment);
        $entityManager->flush();

        return new Response('Коментарий добавлен');
    }
}
