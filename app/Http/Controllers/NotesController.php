<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Note;

class NotesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    use ValidatesRequests;

    private function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'note' => 'required',
        ]);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * @OA\Get(
     *     path="/",
     *     @OA\Response(response="200", description="Display user noutes."),
     *     operationId = "index", 
     * )
     */


    public function index(Request $request)
    {
        $user = Auth::user();
        $notes = Note::isUser($user->id)->paginate(10);
        return view('notes.index', [
            'user' => $user,
            'notes' => $notes
        ]);
    }



    /**
     * @OA\Get(
     *     path="/notes/add",
     *     @OA\Response(response="200", description="front page add note."),
     *     operationId = "add",
     * )
     */

    public function add(Request $request)
    {
        return view('notes.add');
    }

    /**
     * @OA\Put(
     *     path="/notes/add",
     *     @OA\Response(response="200", description="add note."),
     *     operationId = "addPut",
     * )
     */

    public function addPut(Request $request)
    {
        $user = Auth::user();
        $this->store($request);
        $note = new Note;
        $note->user_id = $user->id;
        $note->name = $request->get('name');
        $note->note = $request->get('note');
        $note->save();
        return redirect()->route('update', ['id' => $note->id]);
    }


    /**
     * @OA\Get(
     *     path="/notes/update/{id}",
     *     @OA\Response(response="200", description="front page update note."),
     *     operationId = "update",
     *     @OA\Parameter ( 
     *          name = "id", 
     *          description = "note id", 
     *          required = true, 
     *          in = "path", 
     *          @OA\Schema ( 
     *              type ="integer" 
     *          )
     *     )  
     * )
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();
        $note = Note::isUser($user->id)->find($id);
        if ($note) {
            return view('notes.update', [
                'note' => $note
            ]);
        }
        return redirect()->route('list');
    }

    /**
     * @OA\Post(
     *     path="/notes/update/{id}",
     *     @OA\Response(response="200", description="update note."),
     *     operationId="updatePost",
     *     @OA\Parameter ( 
     *          name = "id", 
     *          description = "note id", 
     *          required = true, 
     *          in = "path", 
     *          @OA\Schema ( 
     *              type ="integer" 
     *          )
     *     )  
     * )
     */
    public function updatePost(Request $request, $id)
    {
        $user = Auth::user();
        $note = Note::isUser($user->id)->find($id);
        if ($note) {
            $this->store($request);
            $note->user_id = $user->id;
            $note->name = $request->get('name');
            $note->note = $request->get('note');
            $note->save();
        }

        return view('notes.update', [
            'note' => $note
        ]);
    }


    /**
     * @OA\Delete(
     *     path="/notes/delete/{id}",
     *     @OA\Response(response="200", description="delete note."),
     *     operationId = "delete",
     *     @OA\Parameter ( 
     *          name = "id", 
     *          description = "note id", 
     *          required = true, 
     *          in = "path", 
     *          @OA\Schema ( 
     *              type ="integer" 
     *          )
     *     )  
     * )
     */
    public function delete(Request $request, $id)
    {
        $user = Auth::user();
        Note::isUser($user->id)->where('id', $id)->delete();
        return redirect()->route('list');
    }



    /**
     * @OA\Get(
     *     path="/notes/detail/{id}",
     *     @OA\Response(response="200", description="detail page note."),
     *     operationId = "detail",
     *     @OA\Parameter ( 
     *          name = "id", 
     *          description = "note id", 
     *          required = true, 
     *          in = "path", 
     *          @OA\Schema ( 
     *              type ="integer" 
     *          )
     *     )  
     * )
     */
    public function detail(Request $request, $id)
    {
        $user = Auth::user();
        $note = Note::isUser($user->id)->find($id);
        if ($note) {
            return view('notes.detail', [
                'note' => $note
            ]);
        }
        return redirect()->route('list');
    }
}
