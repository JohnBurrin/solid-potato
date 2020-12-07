<?php

namespace App\Http\Controllers;

use Backpack\PageManager\app\Models\Page;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PageController extends Controller
{
    private $user = null;
    private function setUser()
    {
        $this->user = \Auth::guard('backpack')->user();
    }

    public function index($slug, $subs = null)
    {
        $this->setUser();
        if (is_null($this->user)) {
            return redirect('/admin/login');
        }

        $page = Page::findBySlug($slug);
        $pages = Page::all()->where('is_published', true);

        if (! $page) {
            abort(404, 'Please go back to our <a href="' . url('') . '">homepage</a>.');
        }

        $this->data['title'] = $page->title;
        $this->data['page'] = $page->withFakes();
        $this->data['pages'] = $pages;
        $this->data['isadmin'] = $this->user->hasRole('Administrator') ?? null;

        return view('pages.'.$page->template, $this->data);
    }

    public function dashboard()
    {
        $this->setUser();
        if (is_null($this->user)) {
            return redirect('/admin/login');
        }

        $pages = Page::all()->where('is_published', true);

        $this->data['title'] = config('app.name');
        $this->data['newpages'] = Page::orderBy('created_at', 'desc')->where('is_published', true)->where('created_at', '<=', Carbon::today()->addDays(7))->take(2)->get();
        $this->data['latest'] = Page::orderBy('updated_at', 'desc')->where('is_published', true)->take(10)->get();
        $this->data['featured'] = Page::orderBy('created_at', 'desc')->where('is_published', true)->where('is_featured', true)->take(10)->get();
        $this->data['mydrafts'] = Page::orderBy('created_at', 'desc')->where('is_published', false)->where('user_id', $this->user->id)->take(10)->get();
        $this->data['isadmin'] = $this->user->hasRole('Administrator') ?? null;
        $this->data['pages'] = $pages;
        return view('dashboard', $this->data);
    }
}
