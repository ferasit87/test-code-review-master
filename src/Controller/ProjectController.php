<?php

namespace Api\Controller; // namespace app controller

use App\Model;
use App\Storage\DataStorage;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController 
{
    /**
     * @var DataStorage
     */
    private $storage; // hint type DataStorage $storage

    public function __construct(DataStorage $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @param Request $request
     *
     * @Route("/project/{id}", name="project", method="GET")
     */
    public function projectAction(Request $request) // miss hit return valus and miss return response
    {
        try {
            $project = $this->storage->getProjectById($request->get('id'));

            return new Response($project->toJson()); // as api project need to return JsonResponse
        } catch (Model\NotFoundException $e) {
            return new Response('Not found', 404); // as api project need to return JsonResponse
        } catch (\Throwable $e) {  // Method does ot return this type
            return new Response('Something went wrong', 500); // as api project need to return JsonResponse
        }
    }

    /**
     * @param Request $request
     *
     * @Route("/project/{id}/tasks", name="project-tasks", method="GET")
     */
    public function projectTaskPagerAction(Request $request) // miss hint return type Response
    {
        $tasks = $this->storage->getTasksByProjectId( // this function get required parameters  id , limit and offset but here I see only id we always have
            $request->get('id'),
            $request->get('limit'), // ?? 10 or in function getTasksByProjectId declaration
            $request->get('offset') // ?? 0 or in function getTasksByProjectId declaration
        );

        return new Response(json_encode($tasks)); // as api project need to return JsonResponse
    }

    /**
     * @param Request $request
     *
     * @Route("/project/{id}/tasks", name="project-create-task", method="PUT") method post not put. add new resource with post
     */
    // post Request to create task better to be in Task controller
    public function projectCreateTaskAction(Request $request) // miss hint return type JsonResponse
    {
		$project = $this->storage->getProjectById($request->get('id')); // function maybe throw exception need to handle try catch
		if (!$project) {
			return new JsonResponse(['error' => 'Not found']); // need to return with code 404 not found
		}
		
		return new JsonResponse(
			$this->storage->createTask($_REQUEST, $project->getId())
		);
    }
}
