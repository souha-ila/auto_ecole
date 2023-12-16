<?php

namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter {

    protected $allowedParms = [];

    protected $columnMap = [];

    protected $operatorMap = [
        'lt' => '<',
        'lte' => '<=',
        'eq' => '=',
        'ne' => '!=',
        'gt' => '>',
        'gte' => '>=',
        'in' => 'in',
        'like' => 'like'
    ];
    
    public function transform(Request $request) {
        $eloQuery = [];

        foreach ($this->allowedParms as $parm => $operators) {

            $query = $request->query($parm);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator)
            {
                if (isset($query[$operator]))
                {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloQuery;
    }
}