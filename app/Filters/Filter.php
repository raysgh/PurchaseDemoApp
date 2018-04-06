<?php

namespace App\Filters;

use Illuminate\Http\Request;

class Filter
{
    protected $builder;

    protected $request;

    protected $filters = ['ordered', 'notOrdered', 'supplier', 'by'];

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        foreach($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;
    }

    public function ordered()
    {
          $this->builder->where('is_ordered', true);
    }

    public function notOrdered()
    {
          $this->builder->where('is_ordered', false);
    }

    public function supplier($id)
    {
          $this->builder->where('supplier_id', $id);
    }

    public function by()
    {
          $user = auth()->id();
          $this->builder->where('user_id', $user);
    }

    public function getFilters()
    {
        return array_filter($this->request->only($this->filters));
    }
}
