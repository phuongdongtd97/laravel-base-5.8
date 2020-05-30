<?php


namespace App\Http\Controllers\ApiControllers;


use App\Http\Requests\Test\StoreTestRequest;
use App\Http\Requests\Test\UpdateTestRequest;
use App\Http\Resources\Test\TestResource;
use App\Http\Resources\Test\TestResourceCollection;
use App\Repositories\Test\TestRepository;
use App\TraitHelpers\ApiResponseTrait;
use App\TraitHelpers\ResourceHelperTrait;
use Illuminate\Http\Request;

class TestController
{
    use ResourceHelperTrait, ApiResponseTrait;

    private $testRepository;

    public function __construct(TestRepository $testRepository)
    {
        $this->testRepository = $testRepository;
    }

    public function index(Request $request)
    {
        $tests = $this->testRepository->handleFilter(['*'], $request->name);
        $tests = $this->handlePaginate($tests, route('tests.index'));
        if ($tests) {
            return new TestResourceCollection($tests);
        } else {
            return response()->json($this->handleResourcesResponse(...[false, null, __('Không tìm thấy danh sách :modelName!', ['modelName' => 'test'])]));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTestRequest $request)
    {
        $testCreated = $this->testRepository->create($request->only(['title', 'content']));
        if ($testCreated) {
            return response()->json($this->handleExcuteActionResponse(...[true, __('Tạo :modelName thành công!', ['modelName' => 'test']), new TestResource($testCreated)]));
        }
        return response()->json($this->handleExcuteActionResponse(...[false, __('Tạo :modelName thất bại!', ['modelName' => 'test'])]));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $test = $this->testRepository->findOrFail($id);
        if ($test) {
            return response()->json($this->handleResourceResponse(...[true, new TestResource($test)]));
        }
        return response()->json($this->handleResourceResponse(...[false, null, __('Không tìm thấy :modelName!', ['modelName' => 'test'])]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTestRequest $request, $id)
    {
        $testUpdated = $this->testRepository->update($id, $request->only(['title', 'content']));

        if ($testUpdated) {
            return response()->json($this->handleExcuteActionResponse(...[true, __('Sửa :modelName thành công!', ['modelName' => 'test']), new TestResource($testUpdated)]));
        }
        return response()->json($this->handleExcuteActionResponse(...[false, __('Sửa :modelName thất bại!', ['modelName' => 'test'])]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->testRepository->delete($id);
        if ($deleted) {
            return response()->json($this->handleExcuteActionResponse(...[true, __('Xóa :modelName thành công!', ['modelName' => 'test'])]));
        }
        return response()->json($this->handleExcuteActionResponse(...[false, __('Xóa :modelName thất bại!', ['modelName' => 'test'])]));
    }
}
