<?php

namespace App\Supports;

class CommentsTree
{
    /**
     * Generate a tree from all comment in an array
     */
    public static function generate(array $comments): array
    {
        $hashTable = [];
        $tree = [];

        foreach ($comments as $comment) {
            $comment['comments'] = [];
            $hashTable[$comment['id']] = $comment;
        }
        unset($comment);

        foreach ($hashTable as $key => $value) {
            if ($value['comment_id']) {
                $hashTable[$value['comment_id']]['comments'][] = &$hashTable[$key];
            } else {
                $tree[] = &$hashTable[$key];
            }
        }

        return $tree;
    }
}
