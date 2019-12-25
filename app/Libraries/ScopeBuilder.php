<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 8/6/19
 * Time: 2:09 PM
 */

namespace App\Libraries;


trait ScopeBuilder
{
    public function scopeLogicalScope($query, $column, $operator, $operand)
    {
        switch ($operator) {
            case 'IN':
                return $query->whereIn($column, $operand);
                break;
            case 'LIKE':
                return $query->where($column, 'LIKE', "%$operand%");
            default:
                return abort('400', 'invalid entry');
        }
    }

    public function scopeComparisonScope($query, $column, $operator, $operand)
    {
        return $query->where($column, $operator, $operand);
    }
}
