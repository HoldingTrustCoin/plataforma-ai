<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    //index
    public function index(Request $request)
    {



        if ($request->s) {
            $pages =  Page::where('title', 'LIKE', '%' . $request->s . '%')
                ->orderBy('id', 'DESC')
                ->paginate(site('pagination'));
        } else {
            $pages =  Page::orderBy('id', 'DESC')
                ->paginate(site('pagination'));
        }



        $page_title = 'All Pages';


        return view('admin.pages.index', compact(
            'page_title',
            'pages',

        ));
    }


    // create page
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'seo' => 'required',
            'content' => 'required'
        ]);




        $store = new Page();
        $store->title = $request->title;
        $store->seo = $request->seo;
        $store->content = json_encode($request->content);
        $store->slug = $this->generateSlug($request->title);
        $store->save();

        return response()->json(['message' => 'Page saved successfully']);
    }


    private function generateSlug($title)
    {
        $slug = Str::slug($title);

        $count = 1;
        while (Page::where("slug", "=", $slug)->exists()) {
            // Slug already exists, append a number and increment it until it's unique
            $slug = Str::slug($title) . '-' . $count;
            $count++;
        }

        return $slug;
    }

    // retrive page edit view
    public function edit(Request $request)
    {
        $page = Page::find($request->route('id'));
        if (!$page) {
            abort(404);
        }

        $page_title = 'Edit '  . $page->title;

        return view('admin.pages.edit', compact(
            'page',
            'page_title'
        ));
    }

    // edit page
    public function editValidate(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'seo' => 'required',
            'content' => 'required'
        ]);




        $store = Page::find($request->route('id'));
        $store->title = $request->title;
        $store->seo = $request->seo;
        $store->content = json_encode($request->content);
        // $store->slug = $this->generateSlug($request->title);
        $store->save();

        return response()->json(['message' => 'Page saved successfully']);
    }


    // delete a page
    public function delete(Request $request)
    {
        $id = $request->route('id');
        $page = Page::find($id);
        if (!$page) {
            return response()->json(validationError('Page not found'), 422);
        }

        $page->delete();

        return response()->json(['message' => $page->title . ' has been deleted succesfully']);
    }
}
