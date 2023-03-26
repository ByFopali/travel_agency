<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Discount\DiscountStoreRequest;
use App\Http\Requests\Discount\DiscountUpdateRequest;
use App\Http\Resources\DiscountResource;
use App\Models\Discount;

class DiscountController extends Controller
{
    /**
     * @OA\Get(
     *      path="/discounts",
     *      operationId="getDiscounts",
     *      tags={"Discounts"},
     *      summary="Get list of discounts",
     *      description="Returns list of discounts",
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
     * Returns list of discounts
     *
     * @OA\Get(
     *      path="/discounts/{id}",
     *      operationId="getDiscountById",
     *      tags={"Discounts"},
     *      summary="Get discount information",
     *      description="Returns discount data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Discount id",
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
     * Returns specific Discount
     *
     * @OA\Post (
     *     path="/discounts",
     *     tags={"Discounts"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="size",
     *                          type="integer"
     *                      )
     *                 ),
     *                 example={
     *                     "size":"50"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="size", type="integer", example="50"),
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
     * Create a Discount
     *
     * @OA\Put (
     *     path="/discounts/{id}",
     *     tags={"Discounts"},
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
     *                          property="size",
     *                          type="integer"
     *                      )
     *                 ),
     *                 example={
     *                     "size":"50"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(property="id", type="number", example=1),
     *              @OA\Property(property="size", type="integer", example="50"),
     *              @OA\Property(property="updated_at", type="string", example="2021-12-11T09:25:53.000000Z"),
     *              @OA\Property(property="created_at", type="string", example="2021-12-11T09:25:53.000000Z")
     *          )
     *      )
     * )
     *
     * Update a Discount
     *
     * @OA\Delete (
     *     path="/discounts/{id}",
     *     tags={"Discounts"},
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
     *             @OA\Property(property="msg", type="string", example="delete discount success")
     *         )
     *     )
     * )
     *
     * Delete a Country
     *
     */


    public function index()
    {
        return DiscountResource::collection(Discount::all());
//        return CountryResource::collection(Country::with('places')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountStoreRequest $request)
    {
        $created_discount = Discount::create($request->validated());

        return new DiscountResource($created_discount);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        return new DiscountResource($discount);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DiscountUpdateRequest $request, Discount $discount)
    {
        $discount->update($request->validated());

        return new DiscountResource($discount);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();

        return response(null, 204);
    }
}
