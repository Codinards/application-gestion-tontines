<?php

namespace App\Controller\Auth;

use App\Entity\Auth\User;
use App\Form\Auth\UserType;
use App\Repository\Auth\UserRepository;
use Njeaner\Symfrop\Core\Annotation\RouteAction;
use Njeaner\Symfrop\Core\Service\CONSTANTS;
use Njeaner\Symfrop\Permissions\ActionPermissions;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/auth/user/{_locale<fr|en|es|pt>?en}', requirements: ['_locale' => 'fr|en|es'])]
class UserController extends AbstractController
{
    #[Route('', name: 'app_auth_user_index', methods: ['GET'])]
    #[RouteAction(
        'app_auth_user_index',
        'app_auth_user_index',
        CONSTANTS::ROLE_ALL,
        isIndex: true,
        actionCondition: ActionPermissions::class,
        conditionOption: RouteAction::CONDITION_CHECK_ONE
    )]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('auth/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_auth_user_new', methods: ['GET', 'POST'])]
    #[RouteAction(
        'app_auth_user_new',
        'app_auth_user_new',
        CONSTANTS::ROLE_ALL_ADMINS,
        actionCondition: [ActionPermissions::class, 'createFirstAdmin'],
        conditionOption: RouteAction::CONDITION_CHECK_ONE
    )]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);
            $this->addFlash('success', 'the entity has been successfully created.');

            return $this->redirectToRoute('app_auth_user_index', ['_locale' => $request->getlocale()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('auth/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_auth_user_show', methods: ['GET'])]
    #[RouteAction('app_auth_user_show', 'app_auth_user_show', CONSTANTS::ROLE_ALL)]
    public function show(User $user): Response
    {
        return $this->render('auth/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_auth_user_edit', methods: ['GET', 'POST'])]
    #[RouteAction('app_auth_user_edit', 'app_auth_user_edit', CONSTANTS::ROLE_ALL_ADMINS)]
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->add($user, true);
            $this->addFlash('success', 'the entity has been successfully updated.');

            return $this->redirectToRoute('app_auth_user_show', ['id' => $user->getId(), '_locale' => $request->getlocale()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('auth/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_auth_user_delete', methods: ['POST'])]
    #[RouteAction('app_auth_user_delete', 'app_auth_user_delete', CONSTANTS::ROLE_SUPERADMIN)]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
            $this->addFlash('success', 'the entity has been successfully removed.');
        }

        return $this->redirectToRoute('app_auth_user_index', ['_locale' => $request->getlocale()], Response::HTTP_SEE_OTHER);
    }
}
