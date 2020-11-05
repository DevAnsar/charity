<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Upload;
use Illuminate\Http\Request;
use App\Models\Media;
use Illuminate\Support\Str;

class UploadController extends Controller
{

    public function getByUuid($uuid = '')
    {
        $uploadModel = Upload::query()->where('uuid', $uuid)->first();
        return $uploadModel;
    }

    /**
     * @param $uuid
     * @return
     */
    public function clear($uuid)
    {
        $uploadModel = $this->getByUuid($uuid);
        return $uploadModel->delete();
    }

    /**
     * clear all uploaded cache
     */
    public function clearAll()
    {
        Upload::query()->where('id', '>', 0)->delete();
        Media::query()->where('model_type', '=', 'App\Models\Upload')->delete();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function allMedia($collection = null)
    {
        $medias = Media::where('model_type', '=', 'App\Models\Upload');
        if ($collection) {
            $medias = $medias->where('collection_name', $collection);
        }
        $medias = $medias->orderBy('id','desc')->get();
        return $medias;
    }


    public function collectionsNames()
    {
        $medias = Media::all('collection_name')->pluck('collection_name','collection_name')->map(function ($c) {
            return ['value' => $c,
                'title' => Str::title(preg_replace('/_/', ' ', $c))
            ];
        })->unique();
        unset($medias['default']);
        $medias->prepend(['value' => 'default', 'title' => 'Default'],'default');
        return $medias;
    }

    /**
     * @param Request $request
     */
    public function store(Request $request)
    {

        $input = $request->all();
        try {

            $upload = Upload::create($input);
            $upload->addMedia($input['file'])
                ->withCustomProperties(['uuid' => $input['uuid']])
                ->toMediaCollection($input['field']);
        } catch (ValidatorException $e) {
//            Flash::error($e->getMessage());
        }
    }

    public function all($collection = null)
    {
//        return $collection;
        $allMedias = $this->allMedia($collection);
        return $allMedias->toJson();
    }
}
