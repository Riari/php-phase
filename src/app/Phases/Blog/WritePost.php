<?php

namespace App\Phases\Blog;

use Adbar\Dot;
use Phase\Http\Phase\Phase;
use Phase\Http\Response\ViewResponse;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Post;

class WritePost extends Phase
{
    public function handle(Dot $state): Response
    {
        // TODO: Implement validation
        $payload = json_decode($this->request->getContent(), true);

        $post = Post::create($payload);

        return new ViewResponse('post/single.html', ['title' => $post->title, 'content' => $post->content]);
    }
}