<?php

namespace App\Http\Controllers\V1\Users;

use App\Http\Controllers\V1\BaseController;
use Illuminate\Http\Request;
use App\Http\Responses\UserResponse;
use App\Repositories\Users\UsersRepository;

/**
 * Class UsersController
 *
 * @package App\Http\Controllers\V1\Users
 *
 * @author  Kacper Kowalski kacperk83@gmail.com
 */
class UsersController extends BaseController
{
    /**
     * @var UsersRepository $repo
     */
    private $repo;

    /**
     * @var UserResponse $userResponse
     */
    private $userResponse;

    /**
     * UsersController constructor.
     *
     * @param Request         $request
     * @param UsersRepository $repo
     * @param UserResponse    $response
     */
    public function __construct(
        Request $request,
        UsersRepository $repo,
        UserResponse $response
    ) {
        $this->repo = $repo;
        $this->userResponse = $response;

        parent::__construct($request);
    }

    /**
     * @return UserResponse
     */
    public function index()
    {
        //Additional validation
        $this->updateQueryParamRules('expand', 'array|in:creditcards');

        //Process query params
        $this->processQueryParams();

        // Get the data
        $collection = $this->repo->getAll($this->getCleanQueryParams());
        $users = $collection->all();

        //Make the retrieved objects available to the response
        $this->userResponse->setArrayOfObjects($users);

        //Return the response
        return $this->userResponse;
    }

    /**
     * @param int $id
     *
     * @return UserResponse
     */
    public function show(int $id)
    {
        //Don't allow these query params
        $this->deleteQueryParams([self::LIMIT, self::OFFSET]);

        //Additional validation
        $this->updateQueryParamRules(self::EXPAND, 'array|in:creditcards');

        //Process query params
        $this->processQueryParams();

        //Get the data
        $user = $this->repo->get($id, $this->getCleanQueryParams());

        //Make the retrieved object available to the response
        $this->userResponse->setSingleObject($user);

        //Return the response
        return $this->userResponse;
    }
}
