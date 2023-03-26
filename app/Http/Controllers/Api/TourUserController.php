<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TourUser\TourUserStoreRequest;
use App\Http\Requests\TourUser\TourUserUpdateRequest;
use App\Http\Resources\TourResource;
use App\Http\Resources\TourUserResource;
use App\Models\TourUser;
use Illuminate\Support\Facades\Storage;

class TourUserController extends Controller
{

    /**
     * @OA\Get(
     *      path="/tour_users",
     *      operationId="getTourUsers",
     *      tags={"TourUsers"},
     *      summary="Get list of tour_users",
     *      description="Returns list of tour_users",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *       security={
     *           {"app_id": {}},
     *       }
     *     )
     *
     * Returns list of tour_users
     *
     * @OA\Get(
     *      path="/tour_users/{id}",
     *      operationId="getTourUserById",
     *      tags={"TourUsers"},
     *      summary="Get tour_user information",
     *      description="Returns tour_user data",
     *      @OA\Parameter(
     *          name="id",
     *          description="TourUser id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     *
     * Returns specific TourUser
     *
     * @OA\Post (
     *     path="/tour_users",
     *     tags={"TourUsers"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="tour_id",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="user_id",
     *                          type="integer"
     *                      )
     *                 ),
     *                 example={
     *                     "tour_id":"11",
     *                     "user_id":"4"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="tour_id", type="integer", example="11"),
     *              @OA\Property(property="user_id", type="integer", example="4"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="invalid",
     *          @OA\JsonContent(
     *              @OA\Property(property="msg", type="string", example="fail"),
     *          )
     *      )
     * )
     *
     * Create a TourUser
     *
     * @OA\Put (
     *     path="/tour_users/{id}",
     *     tags={"TourUsers"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="tour_id",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="user_id",
     *                          type="integer"
     *                      )
     *                 ),
     *                 example={
     *                     "tour_id":"11",
     *                     "user_id":"4"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="tour_id", type="integer", example="11"),
     *              @OA\Property(property="user_id", type="integer", example="4"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z")
     *          )
     *      )
     * )
     *
     * Update a TourUser
     *
     * @OA\Delete (
     *     path="/tour_users/{id}",
     *     tags={"TourUsers"},
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(property="msg", type="string", example="delete tour_user success")
     *         )
     *     )
     * )
     *
     * Delete a TourUser
     *
     */

    public function index()
    {
        return TourUserResource::collection(TourUser::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TourUserStoreRequest $request)
    {
        $data = $request->validated();

        $tourUser = TourUser::create($data);

        return new TourUserResource($tourUser);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(TourUser $tourUser)
    {
        return new TourUserResource($tourUser);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TourUserUpdateRequest $request, TourUser $tourUser)
    {
        $data = $request->validated();

        $tourUser->update($data);

        return new TourUserResource($tourUser);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TourUser $tourUser)
    {
        $tourUser->delete();

        return response(null, 204);
    }
}
