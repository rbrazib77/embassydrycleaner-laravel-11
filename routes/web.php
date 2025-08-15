<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\{BannerSectionController,OurServiceSectionController,SettingController,SocialMediaLinkController,HowItWorkSectionController,VisitorController,PassionateAboutLaundrySectionController,FaqSectionController,PartnershipController,CareerController};

use Illuminate\Support\Facades\Route;



Route::middleware(['web'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    // অন্য public route
});


// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('admin')->middleware(['auth', 'verified'])->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


 Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/profile/store', [AdminController::class, 'ProfileStore'])->name('profile.store');
    Route::post('/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
    Route::get('/user/list', [AdminController::class, 'UserList'])->name('admin.user.list');
    Route::get('/new/user', [AdminController::class, 'NewUser'])->name('new.user');
    Route::post('/new/user/create', [AdminController::class, 'NewUserCreate'])->name('new.user.create');
    Route::get('/users/destroy/{id}', [AdminController::class, 'destroy'])->name('user.destroy');
});

Route::prefix('admin/banner')->middleware(['auth'])->group(function () {
    Route::get('index', [BannerSectionController::class, 'BannerIndex'])->name('admin.banner.index');
    Route::get('create', [BannerSectionController::class, 'BannerCreate'])->name('admin.banner.create');
    Route::post('store', [BannerSectionController::class, 'BannerStore'])->name('admin.banner.store');
    Route::post('update/{id}', [BannerSectionController::class, 'BannerUpdate'])->name('admin.banner.update');
    Route::get('destroy/{id}', [BannerSectionController::class, 'BannerDelete'])->name('admin.banner.destroy');
    Route::get('active-deactive/{id}', [BannerSectionController::class, 'toggleBannerSection'])->name('admin.banner.active.deactive');
});

Route::prefix('admin/our-service')->middleware(['auth'])->group(function () {
    Route::get('index', [OurServiceSectionController::class, 'OurServiceIndex'])->name('admin.service.index');
    Route::get('create', [OurServiceSectionController::class, 'OurServiceCreate'])->name('admin.service.create');
    Route::post('store', [OurServiceSectionController::class, 'OurServiceStore'])->name('admin.service.store');
    Route::post('update/{id}', [OurServiceSectionController::class, 'OurServiceUpdate'])->name('admin.service.update');
    Route::get('details/{id}', [OurServiceSectionController::class, 'OurServiceDetails'])->name('admin.service.details');
    Route::get('destroy/{id}', [OurServiceSectionController::class, 'OurServiceDelete'])->name('admin.service.destroy');
    Route::get('active-deactive/{id}', [OurServiceSectionController::class, 'toggleOurService'])->name('admin.service.active.deactive');
});

Route::prefix('admin/setting')->middleware(['auth'])->group(function () {
    Route::get('website/index', [SettingController::class, 'WebsiteIndex'])->name('admin.website.index');
    Route::post('website/update/{id}', [SettingController::class, 'WebsiteUpdate'])->name('admin.website.update');
});
Route::prefix('admin/social/media/link')->middleware(['auth'])->group(function () {
    Route::get('index', [SocialMediaLinkController::class, 'SocialMediaLinkIndex'])->name('admin.social.media.link.index');
    Route::get('create', [SocialMediaLinkController::class, 'SocialMediaLinkCreate'])->name('admin.social.media.link.create');
    Route::post('store', [SocialMediaLinkController::class, 'SocialMediaLinkStore'])->name('admin.social.media.link.store');
     Route::post('update/{id}', [SocialMediaLinkController::class, 'SocialMediaLinkUpdate'])->name('admin.social.media.link.update');
    Route::get('destroy/{id}', [SocialMediaLinkController::class, 'SocialMediaLinkDelete'])->name('admin.social.media.link.destroy');
    Route::get('active-deactive/{id}', [SocialMediaLinkController::class, 'toggleSocialMediaLink'])->name('admin.social.media.link.active.deactive');
});

Route::prefix('admin/how-it-works')->middleware(['auth'])->group(function () {
    Route::get('index', [HowItWorkSectionController::class, 'HowItWorksIndex'])->name('admin.how.it.works.index');
    Route::get('create', [HowItWorkSectionController::class, 'HowItWorksCreate'])->name('admin.how.it.works.create');
    Route::post('store', [HowItWorkSectionController::class, 'HowItWorksStore'])->name('admin.how.it.works.store');
    Route::get('destroy/{id}', [HowItWorkSectionController::class, 'HowItWorksDelete'])->name('admin.how.it.works.destroy');
    Route::post('update/{id}', [HowItWorkSectionController::class, 'HowItWorksUpdate'])->name('admin.how.it.works.update');
    Route::get('active-deactive/{id}', [HowItWorkSectionController::class, 'toggleHowItWorks'])->name('admin.how.it.works.active.deactive');
});


Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/user-activity/list', [VisitorController::class, 'index'])->name('admin.user-activity.index');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/passionate-about-laundry', [PassionateAboutLaundrySectionController::class, 'PassionateAboutLaundryCreate'])->name('admin.passionate.about.laundry.create');
     Route::post('/passionate-about-laundry/update{id}', [PassionateAboutLaundrySectionController::class, 'PassionateAboutLaundryUpdate'])->name('admin.passionate.about.laundry.update');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/faq-section', [FaqSectionController::class, 'FaqSectionIndex'])->name('admin.faq.section.index');
    Route::post('/faq-section/update/{id}', [FaqSectionController::class, 'FaqSectionUpdate'])->name('admin.faq.section.update');
    Route::post('/faq/question/answer/store', [FaqSectionController::class, 'FaqQuestionAnswerStore'])->name('admin.faq.question.answer.store');
    Route::post('/faq/question/answer/update/{id}', [FaqSectionController::class, 'FaqQuestionAnswerUpdate'])->name('admin.faq.question.answer.update');
    Route::get('/faq/question/answer/view/{id}', [FaqSectionController::class, 'FaqQuestionAnswerView'])->name('admin.faq.question.answer.view');
    Route::get('/faq/question/answer/destroy/{id}', [FaqSectionController::class, 'FaqQuestionAnswerDestroy'])->name('admin.faq.question.answer.destroy');
    Route::get('/faq/active-deactive/{id}', [FaqSectionController::class, 'toggleFaqQuestionAnswer'])->name('admin.faq.question.answer.active.deactive');

});

Route::prefix('admin/partnership')->middleware(['auth'])->group(function () {
    Route::get('/create', [PartnershipController::class, 'PartnershipCreate'])->name('admin.partnership.create');
    Route::post('/store', [PartnershipController::class, 'PartnershipStore'])->name('admin.partnership.store');
});

Route::prefix('admin/career')->middleware(['auth'])->group(function () {
    Route::get('/create', [CareerController::class, 'CareerCreate'])->name('admin.career.create');
    Route::post('/update/{id}', [CareerController::class, 'CareerUpdate'])->name('admin.career.update');
});













