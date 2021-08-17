<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Forum;
use App\Models\Category;
use App\Models\Document;
use App\Models\Comment;
use App\Models\Log;
use App\Models\User;
use App\Models\Role;
use Auth;
use Image;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($documentId)
    {
        $forums=Forum::where('documentId',$documentId)
        ->join('users','forums.userId','users.id')
        ->select('forums.*','users.username','users.id as userId','users.profilePicture')
        ->orderBy('created_at','desc')
        ->get();
        if ($forums==null) {
            $forums="hola";
        }
        $categories=$this->getCategories();
        $document=Document::find($documentId);
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('forum.index',compact('forums','categories','document','rol'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($documentId)
    {
        $forum=new Forum();
        $categories=$this->getCategories();
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('forum.create',compact('forum','categories','documentId','rol'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $forum=new Forum();
        $forum->title=$request['title'];
        $forum->description=$request['description'];
        $forum->documentId=$request['documentId'];
        $forum->userId=Auth::id();
        $forum->save();
        $documentId=$request['documentId'];
        return $this->index($documentId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $forum=Forum::where('forums.id',$id)
        ->join('users','forums.userId','users.id')
        ->select('forums.*','users.username','users.id as userId','users.profilePicture')
        ->first();
        $mycomments=Comment::where('forumId',$id)->whereNull('superCommentId')
        ->join('users','comments.userId','users.id')
        ->select('users.id as userId','users.username','users.profilePicture','comments.content','comments.created_at','comments.id')
        ->orderBy('created_at','desc')
        ->get();
        $comments=[];
        foreach ($mycomments as $mycomment) {
            $comment=[
                "id"=>$mycomment->id,
                "content"=>$mycomment->content,
                "userId"=>$mycomment->userId,
                "username"=>$mycomment->username,
                "created_at"=>$mycomment->created_at,
                "subComments"=>Comment::where('superCommentId',$mycomment->id)
                ->join('users','comments.userId','users.id')
                ->select('users.id as userId','users.username','users.profilePicture','comments.content','comments.created_at','comments.id')
                ->orderBy('created_at','desc')
                ->get()
                
            ];

            array_push($comments,$comment);
        }
        $categories=$this->getCategories();
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('forum.show',compact('forum','categories','comments','rol'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $forum=Forum::find($id);
        $documentId=$forum->documentId;
        $categories=$this->getCategories();
        $user=Auth::user();
        $rol=Role::find($user->roleid);
        return view('forum.edit',compact('forum','documentId','categories','rol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $forum=Forum::find($id);
        $forum->title=$request['title'];
        $forum->description=$request['description'];
        $forum->save();
        Log::guardar($forum->id,'Edito un Foro');
        return $this->show($forum->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $forum=Forum::find($id);
        $comments=Comment::where('forumId',$forum->id);
        $documentId=$forum->documentId;
        foreach ($comments as $comment) {
            $comment::whereNotNull('superCommentId')
            ->delete();
        }
        $comments->delete();
        $forum->delete();
        Log::guardar($id,'Elimino un Foro');
        return $this->index($documentId);
    }

    public function comentarios($id)
    {
        Comment::where('superCommentId',$id)->delete();
        Comment::find($id)->delete();
    }

    public function getCategories(){
        $cateories=Category::
        whereNull('superCategory')->get();
        $categories=[];
        foreach ($cateories as $category) {
            $mySubCategories=Category::where('superCategory',$category->id)->get();
            $x=[];
            foreach ($mySubCategories as $mySubCategory) {
                $mymySubCategory=[
                    'id'=>$mySubCategory->id,
                    'name'=>$mySubCategory->name,
                    'subCategories'=>Category::where('superCategory',$mySubCategory->id)->get()
                ];
                array_push($x, $mymySubCategory);
            }
            
            $myCategory=[
                'id'=>$category->id,
                'name'=>$category->name,
                'subCategories'=>$x
            ];
            array_push($categories, $myCategory);
        }
        return $categories;
    }

    public function commentStore(Request $request){
        $comment=new Comment();
        $comment->content=$request['content'];
        $comment->forumId=$request['forumId'];
        $comment->superCommentId=$request['superCommentId'];
        $comment->userId=Auth::id();
        $comment->save();
        return redirect()->back();
    }
}
