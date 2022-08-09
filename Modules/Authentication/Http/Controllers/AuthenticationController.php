<?php

namespace Modules\Authentication\Http\Controllers;

use App\Http\Traits\GeneralTrait;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Authentication\Http\Requests\TestRequest;
use Modules\Authentication\Transformers\UserResource;

class AuthenticationController extends Controller
{
    use GeneralTrait;

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(TestRequest $request)
    {
        /*        $users = User::get();
                return $this->returnData(['users'], [UserResource::collection($users)]);

                $users = User::find(2);
                return $this->returnData(['users'], [new UserResource($users)]);*/
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('authentication::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('authentication::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('authentication::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
