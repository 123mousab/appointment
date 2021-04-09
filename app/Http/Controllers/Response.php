<?php


namespace App\Http\Controllers;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\ForwardsCalls;

class Response
{
    use ForwardsCalls;

    public $status = 200;
    public $code = 0;
    public $message = 'تمت العملية بنجاح';
    public $data = null;
    public $errors = null;
    public $trace = null;
    private $withPagination = false;
    private $mapInto;

    public function __construct($status, $data = null)
    {
        $this->status = $status;
        $this->data = $data;
    }

    public static function success($data = null)
    {
        return new static(200, $data);
    }

    public static function error($code = 500, $errors = null)
    {
        return (new static($code))->withErrors($errors);
    }

    public function withMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    public function withData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function withErrors($errors)
    {
        $this->errors = $errors;
        return $this;
    }

    public function withTrace($trace)
    {
        $this->trace = $trace;
        return $this;
    }

    public function withPagination($withPagination = true)
    {
        $this->withPagination = $withPagination;
        return $this;
    }

    public function mapInto($mapInto)
    {
        if($this->data instanceof LengthAwarePaginator) {
            $this->data->getCollection()->transform(function($item) use ($mapInto) {
                return new $mapInto($item);
            });
        } else if($this->data instanceof Collection) {
            $this->data->transform(function($item) use ($mapInto) {
                return new $mapInto($item);
            });
        } else {
            $this->data = new $mapInto($this->data);
        }

        return $this;
    }

    private function data()
    {
        if($this->withPagination && ($this->data instanceof LengthAwarePaginator)) {
            return $this->paginate();
        }

        return $this->data;
    }

    private function paginate()
    {
        $data = $this->data->toArray();
        $resources= $this->data->getCollection();
        unset($data['data']);
        unset($data['links']);
        return [
            'resources' => $resources,
            'pagination' => $data
        ];
    }

    private function jsonSerialize()
    {
        $data = [
            'status' => $this->status,
            'code' => $this->code,
            'data' => $this->data(),
            'message' => $this->message,
            'errors' => $this->errors,
        ];
        if($this->trace) {
            $data['trace'] = $this->trace;
        }
        return $data;
    }

    public function send()
    {
        return response()->json($this->jsonSerialize(), $this->status);
    }

    public function __call($name, $arguments)
    {
        if($this->data instanceof LengthAwarePaginator) {
            $this->data->getCollection()->transform(function($item) use ($name, $arguments) {
                return $this->forwardCallTo($item, $name, $arguments);
            });
        } else if($this->data instanceof Collection) {
            $this->data->transform(function($item) use ($name, $arguments) {
                return $this->forwardCallTo($item, $name, $arguments);
            });
        } else {
            $this->data = $this->forwardCallTo($this->data, $name, $arguments);
        }

        return $this;
    }
}
