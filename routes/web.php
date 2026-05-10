<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactSubmissionController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect('/en');
});

use App\Http\Controllers\PostController;

Route::group(['prefix' => '{locale}', 'where' => ['locale' => 'en|id']], function () {
    Route::get('/', [PostController::class, 'home'])->name('home');
    Route::get('/services', function () {
        return Inertia::render('Services');
    })->name('services');
    Route::get('/portfolio', [PostController::class, 'portfolio'])->name('portfolio');
    Route::get('/portfolio/{slug}', [PostController::class, 'show'])->name('portfolio.show');
    Route::get('/privacy-policy', function () {
        return Inertia::render('PrivacyPolicy');
    })->name('privacy');
    Route::get('/terms-of-service', function () {
        return Inertia::render('TermsOfService');
    })->name('terms');
    Route::get('/contact', function () {
        return Inertia::render('Contact');
    })->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard', [
            'recentPosts'   => \App\Models\Post::latest()->take(5)->get(),
            'totalPosts'    => \App\Models\Post::count(),
            'publishedPosts'=> \App\Models\Post::where('is_published', true)->count(),
            'draftPosts'    => \App\Models\Post::where('is_published', false)->count(),
            'totalContacts' => \App\Models\ContactSubmission::count(),
            'unreadContacts'=> \App\Models\ContactSubmission::where('is_read', false)->count(),
        ]);
    })->name('dashboard');

    Route::resource('posts', PostController::class)->except(['show']);
    Route::get('contact-submissions', [ContactSubmissionController::class, 'index'])->name('contact-submissions.index');
    Route::get('contact-submissions/export', [ContactSubmissionController::class, 'export'])->name('contact-submissions.export');
    Route::patch('contact-submissions/{contactSubmission}/read', [ContactSubmissionController::class, 'markRead'])->name('contact-submissions.read');
    Route::delete('contact-submissions/{contactSubmission}', [ContactSubmissionController::class, 'destroy'])->name('contact-submissions.destroy');
    Route::delete('contact-submissions', [ContactSubmissionController::class, 'bulkDestroy'])->name('contact-submissions.bulk-destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
