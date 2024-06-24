<?php

namespace App\Repositories;

use App\Models\Content;

class ContentRepository implements ContentRepositoryInterface
{
    public function all(array $filters = null, int $perPage = 20)
    {
        $contents = Content::query();

        if ($filters && $filters['content']) {
            $contents->where('content', 'like', '%' . $filters['content'] . '%');
        }

        if ($filters && $filters['type']) {
            $contents->where('type', $filters['type']);
        }

        if ($filters && $filters['package']) {
            $contents->where('pack', $filters['package']);
        }
        return $contents->orderBy('id', 'desc')->cursorPaginate($perPage);
    }


    public function create(array $data)
    {
        return Content::create($data);
    }

    public function update(array $data, $id)
    {
        $content = Content::findOrFail($id);
        $content->update($data);
        return $content;
    }

    public function find($id)
    {
        return Content::findOrFail($id);
    }

    public function delete($id)
    {
        $content = Content::findOrFail($id);

        return $content->destroy($id);
    }
}
