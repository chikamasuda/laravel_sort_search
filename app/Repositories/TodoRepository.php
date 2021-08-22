<?php

namespace App\Repositories;

use App\Models\Todo;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

/**
 * Class TodoRepository
 * @package App\Repositories
 * @version August 21, 2021, 9:32 pm JST
 */

class TodoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'title',
        'status'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Todo::class;
    }

    public function search($queryText, $status, $sort)
    {
        $query = Todo::where('user_id', Auth::id());
        if ($queryText != null) $query->where('title', 'LIKE', "%$queryText%");
        if ($status !== null) $query->where('status', $status);
        if ($sort === 'titleAsc') $query->orderBy('title', 'asc');
        if ($sort === 'titleDesc') $query->orderBy('title', 'desc');
        if ($sort === 'statusAsc') $query->orderBy('title', 'asc');
        if ($sort === 'statusDesc') $query->orderBy('title', 'desc');
        $todos = $query->get();
        return $todos;
    }
}
