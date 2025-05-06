<?php

namespace App\Helpers;

class Filter
{
    public static function prepare(array $data)
    {
        $trash              = $data['filter']['trash']      ?? $data['default']['filter']['trash']      ?? false;
        $order_column       = $data['order']['column']      ?? $data['default']['order']['column']      ?? 'created_at';
        $order_direction    = $data['order']['direction']   ?? $data['default']['order']['direction']   ?? 'desc';
        $per_page           = $data['pagination']['limit']  ?? $data['default']['pagination']['limit']  ?? 10;


        return [
            'trash' => $trash,
            'order_column' => $order_column,
            'order_direction' => $order_direction,
            'per_page' => $per_page,
        ];
    }


    public static function search($query, array $searches)
    {
        if(empty($searches)) return $query;

        foreach ($searches as $search) {
            if (is_array($search) && isset($search['column'], $search['value'])) {
                $column     = $search['column'];
                $value      = $search['value'];
                $operator   = $search['operator'] ?? '=';
                $boolean    = $search['boolean']   ?? 'and';

                $query->where($column, $operator, $value, $boolean);
            } else {
                $query->where(function ($query) use ($search) {
                    return $this->prepareSearch($query, $search);
                });
            }
        }

        return $query;
    }
}
