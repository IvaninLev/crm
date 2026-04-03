<?php
namespace App\Http\Controllers;

use App\Enums\PaginationEnum;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserResource;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Inertia\Inertia;
use function Termwind\render;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function register()
    {
        return Inertia::render('auth');
    }

    public function index()
    {
        $query = TodoList::where('user_id', auth()->id());

        $paginated = (clone $query)
            ->orderBy('id', 'desc')
            ->paginate(PaginationEnum::PAGE_SIZE->value);

        $statusList = [
            'total' => $paginated->total(),
            'sending' => (clone $query)->where('status', TodoList::STATUS_PROGRESS)->count(),
            'done' => (clone $query)->where('status', TodoList::STATUS_DONE)->count(),
            'error' => (clone $query)->where('status', TodoList::STATUS_ERR)->count(),
        ];

        return Inertia::render('Home', [
            'tasks' => TaskResource::collection($paginated),
            'meta' =>[
                'total' => $paginated->total(),
                'per_page' => $paginated->perPage(),
                'current_page' => $paginated->currentPage(),
                'last_page' => $paginated->lastPage(),
                'stats' => $statusList,
            ]
        ]);


    }


    public function profile()
    {
        $user = auth()->user();

        return Inertia::render('Profile/Profile', [
            'user' => new UserResource($user)
        ]);
    }

}
