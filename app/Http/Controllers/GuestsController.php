<?php

namespace App\Http\Controllers;

use App\Guest;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class GuestsController extends BaseController
{
    /**
     * @var Guest
     */
    protected $guest;

    /**
     * GuestsController constructor.
     *
     * @param Guest $guest
     */
    public function __construct(Guest $guest)
    {
        $this->guest = $guest;
    }

    /**
     * List a paginated list of results
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        $limit = (int) $request->get('limit', 10);

        return $this->guest->paginate($limit);
    }

    /**
     * Fetch an individual item
     *
     * @param $id
     *
     * @return mixed
     */
    public function show($id)
    {
        return $this->guest->findOrFail($id);
    }

    /**
     * Creates a new item
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest($request);

        return response($this->guest->create(
            $request->all()
        ), 201);
    }

    /**
     * Update an existing item
     *
     * @param int     $id
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update($id, Request $request)
    {
        $this->validateRequest($request);

        return $this->guest->findOrFail($id)->update(
            $request->all()
        );
    }

    /**
     * Delete an item
     *
     * @param $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function destroy($id)
    {
        $this->guest
            ->findOrFail($id)
            ->delete();

        return response('', 204);
    }

    /**
     * @param Request $request
     */
    protected function validateRequest(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required'
        ]);
    }
}
