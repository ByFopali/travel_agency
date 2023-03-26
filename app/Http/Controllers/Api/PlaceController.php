<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Place\PlaceStoreRequest;
use App\Http\Requests\Place\PlaceUpdateRequest;
use App\Http\Resources\PlaceResource;
use App\Models\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{

    /**
     * @OA\Get(
     *      path="/places",
     *      operationId="getPlaces",
     *      tags={"Places"},
     *      summary="Get list of places",
     *      description="Returns list of places",
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
     * Returns list of places
     *
     * @OA\Get(
     *      path="/places/{id}",
     *      operationId="getPlaceById",
     *      tags={"Places"},
     *      summary="Get place information",
     *      description="Returns place data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Place id",
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
     * Returns specific Place
     *
     * @OA\Post (
     *     path="/places",
     *     tags={"Places"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="country_id",
     *                          type="integer"
     *                      )
     *                 ),
     *                 example={
     *                     "name":"Crystalvista Cove",
     *                     "country_id":"10"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="Crystalvista Cove"),
     *              @OA\Property(property="country_id", type="integer", example="10"),
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
     * Create a Place
     *
     * @OA\Put (
     *     path="/places/{id}",
     *     tags={"Places"},
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
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="country_id",
     *                          type="integer"
     *                      )
     *                 ),
     *                 example={
     *                     "name":"Crystalvista Cove",
     *                     "country_id":"10"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="Crystalvista Cove"),
     *              @OA\Property(property="country_id", type="integer", example="10"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z")
     *          )
     *      )
     * )
     *
     * Update a Place
     *
     * @OA\Delete (
     *     path="/places/{id}",
     *     tags={"Places"},
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
     *             @OA\Property(property="msg", type="string", example="delete place success")
     *         )
     *     )
     * )
     *
     * Delete a Place
     *
     */

    public function index()
    {
        return PlaceResource::collection(Place::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlaceStoreRequest $request)
    {
        $created_place = Place::create($request->validated());

        return new PlaceResource($created_place);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        return new PlaceResource($place);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlaceUpdateRequest $request, Place $place)
    {
        $place->update($request->validated());

        return new PlaceResource($place);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        $place->delete();

        return response(null, 204);
    }
}
