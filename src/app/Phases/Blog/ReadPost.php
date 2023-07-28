<?php

namespace App\Phases\Blog;

use Adbar\Dot;
use Phase\Http\Phase\Phase;
use Phase\Http\Response\ViewResponse;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Post;

class ReadPost extends Phase
{
    public function handle(Dot $state): Response
    {
        $post = Post::find($this->params['id']);

        return new ViewResponse('post.single', ['post' => $post]);
    }
}