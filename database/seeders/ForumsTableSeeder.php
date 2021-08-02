<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Forum;
use App\Models\Comment;

class ForumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $forum= new Forum();
        $forum->title='Ayuda mis papás me abandonaron';
        $forum->description='necesito donde quedarme por un tiempo';
        $forum->documentId=1;
        $forum->userId=1;
        $forum->save();

        $forum= new Forum();
        $forum->title='Mi gato me araña mucho';
        $forum->description='como puedo hacerle para quitarle filo a sus uñas';
        $forum->documentId=1;
        $forum->userId=1;
        $forum->save();

        $forum= new Forum();
        $forum->title='Reprobe esta Materia';
        $forum->description='no inscriban con Miranda';
        $forum->documentId=1;
        $forum->userId=1;
        $forum->save();

        $comment=new Comment();
        $comment->userId=1;
        $comment->forumId=1;
        $comment->content='por pendejo';
        $comment->save();

        $comment=new Comment();
        $comment->userId=2;
        $comment->forumId=1;
        $comment->content='me paso lo mismo y mirame, soy el exito Cards assume no specific width to start, so they’ll be 100% wide unless otherwise stated. You can change this as needed with custom CSS, grid classes, grid Sass mixins, or utilities.Cards assume no specific width to start, so they’ll be 100% wide unless otherwise stated. You can change this as needed with custom CSS, grid classes, grid Sass mixins, or utilities.';
        $comment->save();

        $comment=new Comment();
        $comment->userId=3;
        $comment->forumId=1;
        $comment->content='toca independizarse';
        $comment->save();

        $comment=new Comment();
        $comment->userId=3;
        $comment->forumId=1;
        $comment->superCommentId=1;
        $comment->content='esto es una prueba';
        $comment->save();

        $comment=new Comment();
        $comment->userId=3;
        $comment->forumId=1;
        $comment->superCommentId=1;
        $comment->content='esto es otra prueba';
        $comment->save();

        
    }
}
