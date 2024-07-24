<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(Request $request): View
    {
        $validated = $request->validate([
            'store_id' => 'integer|exists:stores,id',
        ]);

        $storeId = $validated['store_id'] ?? null;

        $news = News::with(['user', 'store'])->latest();

        if ($storeId) {
            $news->where('store_id', $storeId);
        }

        return view('news.list', [
            'selected' => $storeId,
            'stores' => Store::all(),
            'news' => $news->get(),
        ]);
    }

    public function create(): View
    {
        return view('news.create', [
            'stores' => Store::all(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'store_id' => 'required|integer|exists:stores,id',
            'title' => 'required|string|max:50',
            'content' => 'required|string|max:100',
        ]);

        if (News::where('store_id', $validated['store_id'])->count() >= 3) {
            return redirect(route('news.index'));
        }

        $request->user()->news()->create($validated);

        return redirect(route('news.index'));
    }

    public function edit(News $news): View
    {
        return view('news.edit', [
            'stores' => Store::all(),
            'new' => $news,
        ]);
    }

    public function show(int $id)
    {
        //
    }

    public function update(Request $request, News $news): RedirectResponse
    {
        $validated = $request->validate([
            'store_id' => 'required|integer|exists:stores,id',
            'title' => 'required|string|max:50',
            'content' => 'required|string|max:100',
        ]);

        $news->update($validated);

        return redirect(route('news.index'));
    }

    public function destroy(News $news): RedirectResponse
    {
        $news->delete();

        return redirect(route('news.index'));
    }
}
