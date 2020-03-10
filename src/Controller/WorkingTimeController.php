<?php

namespace App\Controller;

use App\Entity\WorkingTime;
use App\Form\WorkingTimeType;
use App\Repository\WorkingTimeRepository;
use App\Service\CalculateWage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/working/time")
 */
class WorkingTimeController extends AbstractController
{
    /**
     * @Route("/", name="working_time_index", methods={"GET"})
     */
    public function index(WorkingTimeRepository $workingTimeRepository): Response
    {
        return $this->render('working_time/index.html.twig', [
            'working_times' => $workingTimeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="working_time_new", methods={"GET","POST"})
     */
    public function new(Request $request, CalculateWage $calculateWage): Response
    {
        $workingTime = new WorkingTime();
        $form = $this->createForm(WorkingTimeType::class, $workingTime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $workingTime->setUser($this->getUser());
            $workingTime->setWagePerDay($calculateWage->calculate($workingTime->getDayAt(), $workingTime->getHours()));
            $entityManager->persist($workingTime);
            $entityManager->flush();

            return $this->redirectToRoute('working_time_index');
        }

        return $this->render('working_time/new.html.twig', [
            'working_time' => $workingTime,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="working_time_show", methods={"GET"})
     */
    public function show(WorkingTime $workingTime): Response
    {
        return $this->render('working_time/show.html.twig', [
            'working_time' => $workingTime,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="working_time_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, WorkingTime $workingTime, CalculateWage $calculateWage): Response
    {
        $form = $this->createForm(WorkingTimeType::class, $workingTime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $workingTime->setWagePerDay($calculateWage->calculate($workingTime->getDayAt(), $workingTime->getHours()));

            $entityManager->persist($workingTime);
            $entityManager->flush();

            return $this->redirectToRoute('working_time_index');
        }

        return $this->render('working_time/edit.html.twig', [
            'working_time' => $workingTime,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="working_time_delete", methods={"DELETE"})
     */
    public function delete(Request $request, WorkingTime $workingTime): Response
    {
        if ($this->isCsrfTokenValid('delete'.$workingTime->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($workingTime);
            $entityManager->flush();
        }

        return $this->redirectToRoute('working_time_index');
    }
}
