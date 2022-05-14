<?php

namespace App\Modules\Test\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Modules\Test\Requests\TestRequest;
use App\Modules\Test\Resources\TestResource;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TestController extends Controller
{
    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        [$column, $order] = explode(',', $request->input('sortBy', 'id,asc'));
        $pageSize = (int) $request->input('pageSize', 10);

        $resource = Test::query()
            ->when($request->filled('search'), function (Builder $q) use ($request) {
                $q->where(Test::COLUMN_NAME, 'like', '%'.$request->search.'%');
            })
            ->orderBy($column, $order)->paginate($pageSize);

        return TestResource::collection($resource);
    }

    /**
     * Store a newly created resource in storage.
     * @param TestRequest $request
     * @return JsonResponse
     */
    public function store(TestRequest $request)
    {
        $data = $request->validated();
        $test = new Test($data);
        $test->save();

        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully created',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Test $test
     * @return TestResource
     */
    public function show(Test $test)
    {
        return new TestResource($test);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TestRequest $request
     * @param Test $test
     * @return JsonResponse
     */
    public function update(TestRequest $request, Test $test)
    {
        $data = $request->validated();
        $test->fill($data)->save();

        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully updated',
        ]);
    }

    /**
     * @param Test $test
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Test $test)
    {
        $test->delete();

        return response()->json([
            'type' => self::RESPONSE_TYPE_SUCCESS,
            'message' => 'Successfully deleted',
        ]);
    }
}
