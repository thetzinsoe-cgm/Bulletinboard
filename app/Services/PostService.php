<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Contracts\Dao\PostDaoInterface;
use App\Http\Requests\PostCreateRequest;
use App\Contracts\Services\PostServiceInterface;

class PostService implements PostServiceInterface
{
    private $postDao;
    /**
     * constructor class
     *
     * @param PostDaoInterface $postDao
     */
    public function __construct(PostDaoInterface $postDao)
    {
        $this->postDao = $postDao;
    }

    /**
     * Get user list
     * @return object
     */
    public function getPost(): object
    {
        if (Auth::guest()) {
            return $this->postDao->getAllPost();
        } else {
            return $this->postDao->getPublicPost();
        }
    }

    /**
     * Get My Post
     *
     * @return object
     */
    public function getMyPost(): object
    {
        return $this->postDao->getMyPost(Auth::user()->id);
    }

    /**
     * create post
     *
     * @return void
     */
    public function createPost(array $data): void
    {
        $data['created_by'] = auth()->user()->id ?? null;
        $this->postDao->createPost($data);
    }

    /**
     * Get one post
     * @return object
     * @param int $id
     */
    public function getPostById(int $id): object
    {
        return $this->postDao->getPostById($id);
    }

    /**
     * Update Post
     * @param array $data
     * @param int $id
     * @return void
     */
    public function updatePost(array $data, int $id): void
    {
        $data['updated_by'] = auth()->user()->id ?? null;
        $this->postDao->updatePost($data, $id);
    }

    /**
     * Delete user by id
     * @param int $id
     * @return void
     */
    public function deletePost(int $id): void
    {
        $this->postDao->deletePost($id);
    }

    /**
     * Export CSV
     *
     * @return array
     */
    public function exportCSV(): array
    {
        $postData = $this->postDao->getMyPost(Auth::user()->id, false);
        $csvFileName = 'post.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $csvFileName . '"',
        ];

        $callback = function () use ($postData) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['title', 'description', 'flag']);

            foreach ($postData as $post) {
                fputcsv($handle, [$post->title, $post->description, $post->flag]);
            }

            fclose($handle);
        };
        return [$callback, $headers];
    }

    /**
     * Import CSV
     *
     * @return void
     */
    public function importCSV($request): void
    {
        DB::transaction(function () use ($request) {
            foreach ($request->input('csv_data') as $index => $data) {
                if ($request->errors()->has("csv_data.$index")) {
                    Log::warning("Validation failed for row $index: " . implode(', ', $request->errors()->get("csv_data.$index")));
                    continue;
                }
                $this->postDao->createPost($data);
            }
        });
    }
}
