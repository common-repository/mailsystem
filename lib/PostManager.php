<?php

/**
 * Class PostManager
 */
class PostManager
{
    /**
     * @return array
     */
    public static function getAllPosts()
    {
        return get_posts([
            'post_type' => 'post',
            'post_status' => 'publish',
        ]);
    }

    /**
     * @param int $categoryId
     * @return array WP_Post
     */
    public function getPostsByCategory($categoryId = 0)
    {
        return get_posts([
            'post_type' => 'post',
            'post_status' => 'publish',
            'category' => $categoryId,
        ]);
    }

    /**
     * @param int $postId
     * @return null|WP_Post
     */
    public function getPostById($postId = 0)
    {
        return get_post((int)$postId);
    }

    /**
     * @param $user_id
     * @param $send_from_id
     * @param $post
     * @param $Importer
     * @return mixed
     */
    public function importPost($user_id, $send_from_id, $post, $Importer)
    {
        $data = [];
        $data['user_id'] = $user_id;
        $data['send_from_id'] = $send_from_id;
        $data['subject'] = $post->post_title;
        $data['body'] = $post->post_content;
        $data['type'] = 'publish';
        return $Importer->createLetter($data);
    }
}