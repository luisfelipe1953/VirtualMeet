<?php

namespace App\Repositories;

use App\Models\Day;
use App\Models\Time;
use App\Models\Event;
use App\Models\Category;
use App\Repositories\BaseRepository;

class EventRepository extends BaseRepository
{
    public $model;

    public function __construct(Event $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    /**
     * Filter events by day and category
     *
     * @param int $day_id
     * @param int $category_id
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function filter(int $day_id, int $category_id)
    {
        return $this->model->where('day_id', $day_id)
            ->where('category_id', $category_id)
            ->get();
    }

    /**
     * Get the number of events with a given category id
     *
     * @param int $category_id
     * @return int
     */
    public function countByCategory(int $category_id)
    {
        return $this->model->where('category_id', $category_id)->count();
    }

    /**
     * Order events by a given column and direction
     *
     * @param string $time
     * @param string $direction
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function orderBy(string $column, string $time)
    {
        return $this->model->orderBy($column, $time)->get();
    }

    public function orderByTake(string $column, string $time)
    {
        return $this->model->orderBy($column, $time)->take(5)->get();
    }

    /**
     * Get the categories, days, and times for creating a new event
     *
     * @return array
     */
    public function getDateFormCreate()
    {
        $categories = Category::all();
        $days = Day::all();
        $times = Time::all();

        return [
            'categories' => $categories,
            'days' => $days,
            'times' => $times,
        ];
    }
}
