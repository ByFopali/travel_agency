<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tour\TourStoreRequest;
use App\Http\Requests\Tour\TourUpdateRequest;
use App\Http\Resources\TourResource;
use App\Http\Resources\TourSecondResource;
use App\Http\Resources\UserResource;
use App\Models\Tour;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TourController extends Controller
{
    /**
     * @OA\Get(
     *      path="/tours",
     *      operationId="getTours",
     *      tags={"Tours"},
     *      summary="Get list of tours",
     *      description="Returns list of tours",
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
     * Returns list of tours
     *
     * @OA\Get(
     *      path="/tours/{id}",
     *      operationId="getTourById",
     *      tags={"Tours"},
     *      summary="Get tour information",
     *      description="Returns tour data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Tour id",
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
     * Returns specific Tour
     *
     * @OA\Post (
     *     path="/tours",
     *     tags={"Tours"},
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
     *                          property="price",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="description",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="image",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="place_id",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="discount_id",
     *                          type="integer"
     *                      ),
     *                 ),
     *                 example={
     *                     "name":"SkyRun Adventure",
     *                     "price":"399",
     *                     "description":"SkyRun Adventure is an exhilarating tour that takes you high above the ground, giving you a bird's-eye view of the stunning scenery below",
     *                     "image":"lW9pR5ma7o5NuUemvwbHlIsKym64gXqAp6moLt8z.png",
     *                     "place_id":"5",
     *                     "discount_id":"6",
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="SkyRun Adventure"),
     *              @OA\Property(property="price", type="int", example="399"),
     *              @OA\Property(property="description", type="string", example="SkyRun Adventure is an exhilarating tour that takes you high above the ground, giving you a bird's-eye view of the stunning scenery below"),
     *              @OA\Property(property="image", type="string", example="images/lW9pR5ma7o5NuUemvwbHlIsKym64gXqAp6moLt8z.png"),
     *              @OA\Property(property="place_id", type="int", example="5"),
     *              @OA\Property(property="discount_id", type="int", example="6"),
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
     * Create a Tour
     *
     * @OA\Put (
     *     path="/tours/{id}",
     *     tags={"Tours"},
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
     *                          property="price",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="description",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="image",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="place_id",
     *                          type="integer"
     *                      ),
     *                      @OA\Property(
     *                          property="discount_id",
     *                          type="integer"
     *                      ),
     *                 ),
     *                 example={
     *                     "name":"SkyRun Adventure",
     *                     "price":"399",
     *                     "description":"SkyRun Adventure is an exhilarating tour that takes you high above the ground, giving you a bird's-eye view of the stunning scenery below",
     *                     "image":"lW9pR5ma7o5NuUemvwbHlIsKym64gXqAp6moLt8z.png",
     *                     "place_id":"5",
     *                     "discount_id":"6",
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="name", type="string", example="SkyRun Adventure"),
     *              @OA\Property(property="price", type="int", example="399"),
     *              @OA\Property(property="description", type="string", example="SkyRun Adventure is an exhilarating tour that takes you high above the ground, giving you a bird's-eye view of the stunning scenery below"),
     *              @OA\Property(property="image", type="string", example="images/lW9pR5ma7o5NuUemvwbHlIsKym64gXqAp6moLt8z.png"),
     *              @OA\Property(property="place_id", type="int", example="5"),
     *              @OA\Property(property="discount_id", type="int", example="6"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z")
     *          )
     *      )
     * )
     *
     * Update a Tour
     *
     * @OA\Delete (
     *     path="/tours/{id}",
     *     tags={"Tours"},
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
     *             @OA\Property(property="msg", type="string", example="delete tour success")
     *         )
     *     )
     * )
     *
     * Delete a Tour
     *
     */


    public function index()
    {
        return TourResource::collection(Tour::paginate(10));
    }
//        return CountryResource::collection(Country::with('places')->get());

    public function store(TourStoreRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = Storage::disk('public')->put('/images', $data['image']);
        }

        $tour = Tour::create($data);

        return new TourResource($tour);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tour $tour)
    {
        return new TourResource($tour);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TourUpdateRequest $request, Tour $tour)
    {
        $data = $request->validated();
//        dd($data);
        if (isset($data['image'])){
            $prev_image = $tour->image;
            Storage::disk('public')->delete($prev_image);
            $data['image'] = Storage::disk('public')->put('/images', $data['image']);
        }
//        dd($data);
        $tour->update($data);
//        dd($tour);
        return new TourResource($tour);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tour $tour)
    {
        if(isset($tour->image)){
            $prev_image = $tour->image;
            Storage::disk('public')->delete($prev_image);
        }

        $tour->delete();

        return response(null, 204);
    }
}
