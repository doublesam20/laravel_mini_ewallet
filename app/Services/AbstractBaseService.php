<?php


namespace App\Services;

use App\Exceptions\APIException;
use Illuminate\Http\Request;

abstract class AbstractBaseService implements AppServiceInterface
{
    protected $model;

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        $model = $this->model->find($id);

        if (!$model) :
            throw new APIException('Data '. $id .' Not Found');
        endif;

        return $model;
    }

    public function create(Request $request)
    {
        $this->model->fill($request->all());
        $this->model->save();

        return $this->model;
    }

    public function update(Request $request, $id)
    {
        $model = $this->getById($id);
        $model->fill($request->all());
        $model->save();

        return $model;
    }

    public function delete($id)
    {
        $model = $this->getById($id);
        $model->delete();

        return $model;
    }
}
