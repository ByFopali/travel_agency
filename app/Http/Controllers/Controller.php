<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      x={
 *          "logo": {
 *              "url": "https://via.placeholder.com/190x90.png?text=L5-Swagger"
 *          }
 *      },
 *      title="API for travel agency",
 *      description="API for travel agency",
 *      @OA\Contact(
 *          email="example@gmail.com"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 *     @OA\Server(
 *          url="http://127.0.0.1:8000/api",
 *          description="API for travel agency server"
 *  )
 *     @OA\Tag(
 *          name="Tours",
 *          description="Tour creating"
 * )
 *      @OA\Tag(
 *          name="Countries",
 *          description="Country creating"
 * )
 *      @OA\Tag(
 *          name="Discounts",
 *          description="Discount creating"
 * )
 *      @OA\Tag(
 *          name="Places",
 *          description="Place creating"
 * )
 *      @OA\Tag(
 *          name="Users",
 *          description="User creating"
 * )
 *      @OA\Tag(
 *          name="TourUsers",
 *          description="TourUser creating"
 * )
 *     @QA\SecurityScheme(
 *          type="apiKey",
 *          in="header",
 *          name="X-APP-ID",
 *          securityScheme="X-APP-ID"
 * )

 */

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
