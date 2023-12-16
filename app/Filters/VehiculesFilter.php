<?php

namespace App\Filters;

use Illuminate\Http\Request;

class VehiculesFilter extends ApiFilter{

    protected $allowedParms = [
        "autoEcoleId"=>["eq","ne"],
        "permisId"=>["eq","ne"],
        "modele"=>["eq","ne","gte","lte"],
        "matricule"=>["eq","ne"]
    ];

    protected $columnMap = [
        "autoEcoleId"=>"autoEcole_id",
        "permisId"=>"permis_id"
       
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