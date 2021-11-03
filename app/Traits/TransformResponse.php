<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

trait TransformResponse
{

    /**
     * @param Collection $data
     * @return array
     */
    protected function transformCollection(Collection $data): array
    {
        $instance = $data->first();
        $transformer = $instance->transformer;

        return $this->getTransformDataFromResource($data, $transformer);
    }

    /**
     * @param Model $instance
     * @return array
     */
    protected function transformInstance(Model $instance): array
    {
        $transformer = $instance->transformer;

        return $this->getTransformDataFromResource($instance, $transformer);
    }

    /**
     * @param Collection|Model $data
     * @param string|null $transformer
     * @return array
     */
    private function getTransformDataFromResource($data, ?string $transformer): array
    {
        if(!class_exists($transformer)){
            return $data->toArray();
        }

        $resource = $this->getResourceInstance($data, $transformer);

        if(!$resource instanceof JsonResource){
            return $data->toArray();
        }

        return $resource->response()->getData(TRUE)['data'];
    }

    /**
     * @param Collection|Model $data
     * @param string $transformer
     * @return JsonResource|null
     */
    private function getResourceInstance($data, string $transformer): ?JsonResource
    {
        $resource = null;

        if ($data instanceof Model) {
            $resource = new $transformer($data);
        } else if ($data instanceof Collection) {
            $resource = $transformer::collection($data);
        }

        return $resource;
    }
}
