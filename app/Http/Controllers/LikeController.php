<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeRequest;
use App\Http\Requests\UnlikeRequest;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function like(Request $request)
    {
        $like = Like::where('user_id', $request->user()->id)
            ->where('likeable_type', $request->likeable_type)
            ->where('likeable_id', $request->id)
            ->first();
        if($like){
            $like->delete();
        } else{
           $l = new Like();
            $l->user_id = $request->user()->id;
            $l->likeable_type = $request->likeable_type;
            $l->likeable_id = $request->id;
            $l->save();
        }
        if ($request->ajax()) {
            return response()->json([
                'likes' => $request->likes()->count(),
            ]);
        }
        return redirect()->back();
    }
}
