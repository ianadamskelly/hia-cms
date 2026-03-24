<?php

use App\Http\Controllers\AdmissionInquiryController;
use App\Http\Controllers\CampusController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\StaffController;
use App\Models\Campus;
use App\Models\Event;
use App\Models\Post;
use App\Models\Programme;
use App\Models\Staff;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $featuredProgrammes = Programme::published()
        ->where('is_featured', true)
        ->orderBy('sort_order')
        ->take(4)
        ->get();

    $featuredCampuses = Campus::published()
        ->where('is_featured', true)
        ->orderBy('sort_order')
        ->take(3)
        ->get();

    $featuredStaff = Staff::featured()
        ->take(3)
        ->get();

    $latestPosts = Post::published()
        ->latest('published_at')
        ->take(3)
        ->get();

    $upcomingEvents = Event::published()
        ->upcoming()
        ->take(3)
        ->get();

    return view('pages.home', compact(
        'featuredProgrammes',
        'featuredCampuses',
        'featuredStaff',
        'latestPosts',
        'upcomingEvents'
    ));
})->name('home');


Route::get('/news', [PostController::class, 'index'])->name('posts.index');
Route::get('/news/{slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('/calendar', [\App\Http\Controllers\CalendarController::class, 'show'])->name('calendar.index');

Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{slug}', [EventController::class, 'show'])->name('events.show');

Route::get('/downloads', [DownloadController::class, 'index'])->name('downloads.index');
Route::get('/downloads/{slug}', [DownloadController::class, 'show'])->name('downloads.show');

Route::get('/programmes', [ProgrammeController::class, 'index'])->name('programmes.index');
Route::get('/programmes/{slug}', [ProgrammeController::class, 'show'])->name('programmes.show');

Route::get('/campuses', [CampusController::class, 'index'])->name('campuses.index');
Route::get('/campuses/{slug}', [CampusController::class, 'show'])->name('campuses.show');

Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
Route::get('/staff/{slug}', [StaffController::class, 'show'])->name('staff.show');

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::get('/admissions-inquiry', [AdmissionInquiryController::class, 'show'])->name('admissions.form');
Route::post('/admissions-inquiry', [AdmissionInquiryController::class, 'submit'])->name('admissions.submit');

Route::get('/{slug}', [PageController::class, 'show'])->name('pages.show');
