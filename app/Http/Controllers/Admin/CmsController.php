<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CmsPage;
use Illuminate\Http\Request;
use Session;

class CmsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        Session::put('page', 'cms-pages');
        $CmsPages = CmsPage::get()->toArray();
        // dd($CmsPages);
        return view('admin.pages.cms_pages')->with(compact('CmsPages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CmsPage $cmsPage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id = null)
    {
        //
        if ($id == "") {
            $title = 'New CMS Page';
            $cmsPage = new CmsPage();
            $message = "CMS page created.";
        } else {
            $title = 'Edit CMS Page';
            $cmsPage = CmsPage::findOrFail($id);
            $message = "CMS Page updated";
        }

        if ($request->isMethod('post') || $request->isMethod('put')) {
            $data = $request->all();
            $rules = [
                "title" => "required",
                "url" => "required",
                "description" => "required"
            ];
            $customMessage = [
                'title.required' => 'Title is required',
                'url.required' => 'URL is required',
                'description.required' => 'Description is required',
            ];

            $this->validate($request, $rules, $customMessage);
            $cmsPage->title = $data['title'];
            $cmsPage->url = $data['url'];
            $cmsPage->description = $data['description'];
            $cmsPage->meta_title = $data['meta_title'];
            $cmsPage->meta_description = $data['meta_description'];
            $cmsPage->meta_keywords = $data['meta_keywords'];
            $cmsPage->status = 1;
            $cmsPage->save();
            return redirect('admin/cms-pages')->with('success_message', $message);
        }
        return view('admin.pages.add_edit_cms_page')->with(compact('title', 'cmsPage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = $request->all();
            // dd($data);
            if ($data['status'] === 'active') {
                $status = 0;
            } else {
                $status = 1;
            }
            CmsPage::where('id', $data['page_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'page_id' => $data['page_id']]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        CmsPage::destroy($id);
        return redirect('admin/cms-pages')->with('success_message', 'The page has been deleted.');
    }
}
