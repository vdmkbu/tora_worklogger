<?php

namespace App\Services;


use Carbon\Carbon;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class FilterService
{
    public function filter(Request $request, Builder $query)
    {
        // если нет параметров, то выводим за текущий месяц
        if (empty($request->get('from_date')) && empty($request->get('to_date'))) {
            $query->where('date', 'LIKE', Carbon::now()->format('Y-m') . '-%');


            $interval = [
                'start' => (new Carbon('first day of this month'))->format('Y.m.d'),
                'end' => (new Carbon('last day of this month'))->format('Y.m.d')
            ];


        }

        // если выбран интервал
        if (!empty($from_date = $request->get('from_date')) && !empty($to_date = $request->get('to_date'))) {
            $query->where('date', '>=', $from_date)->where('date', '<=', $to_date);

            $interval = [
                'start' => (new Carbon($from_date))->format('Y.m.d'),
                'end' => (new Carbon($to_date))->format('Y.m.d')
            ];
        }

        if(!empty($from_date = $request->get('from_date')) && empty($request->get('to_date'))) {
            $query->where('date', '>=', $from_date);

            $interval = [
                'start' => (new Carbon($from_date))->format('Y.m.d'),
                'end' => (new Carbon())->format('Y.m.d')
            ];
        }

        if(empty($request->get('from_date')) && !empty($to_date = $request->get('to_date'))) {
            $query->where('date', '<=', $to_date);

            $interval = [
                'start' => '',
                'end' => (new Carbon($to_date))->format('Y.m.d')
            ];
        }

        return new FilterResult($query, $interval);
    }
}