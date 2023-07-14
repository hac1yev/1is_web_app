
<?php

use App\Http\Controllers\Back\AdminCompaniesController\AdminCompaniesController;
use App\Http\Controllers\Back\AdminGeneralController\AdminGeneralController;
use App\Http\Controllers\Back\AdminProfileController\AdminProfileController;
use App\Http\Controllers\Back\BlogController\BlogController;
use App\Http\Controllers\Back\AdvertsController\AdvertsController;
use App\Http\Controllers\Back\AuthController\AuthController;
use App\Http\Controllers\Back\BannerImageController\BannerImageController;
use App\Http\Controllers\Back\ChangeDataController\ChangeDataController;
use App\Http\Controllers\Back\ContactController\ContactController;
use App\Http\Controllers\Back\ContactInfoController\ContactInfoController;
use App\Http\Controllers\Back\CvController\CvController;
use App\Http\Controllers\Back\LoginImageController\LoginImageController;
use App\Http\Controllers\Back\ReviewController\ReviewController;
use App\Http\Controllers\Back\SettingsController\SettingsController;
use App\Http\Controllers\Back\SocialMediaController\SocialMediaController;
use App\Http\Controllers\Back\StoriesController\StoriesController;
use App\Http\Controllers\Back\SubscribersController\SubscribersController;
use App\Http\Controllers\Back\TrainingsController\TrainingsController;
use App\Http\Controllers\Back\UserPolicyController\UserPolicyController;
use App\Http\Controllers\Back\VacancyController\VacancyController;
use App\Http\Controllers\Front\Blog\BlogFrontController;
use App\Http\Controllers\Front\Company\CompanyFrontController;
use App\Http\Controllers\Front\Contact\ContactFrontController;
use App\Http\Controllers\Front\Vacancy\VacancyFrontController;
use App\Http\Controllers\Front\Traning\TraningFrontController;
use App\Http\Controllers\Front\CV\CVFrontController;
use App\Http\Controllers\Front\Jobsearcher\JobsearcherController;
use App\Http\Controllers\Front\Policy\PolicyController;
use App\Http\Controllers\Front\Terms\TermsController;
use App\Http\Controllers\Front\Languages\LanguageController;
use App\Http\Controllers\Front\Account\AccountController;
use App\Http\Controllers\Front\GeneralController;
use Illuminate\Support\Facades\Route;

// /*
// |--------------------------------------------------------------------------
// | Web Routes
// |--------------------------------------------------------------------------
// |
// | Here is where you can register web routes for your application. These
// | routes are loaded by the RouteServiceProvider within a group which
// | contains the "web" middleware group. Now create something great!
// |
// */




Route::middleware('isAdminLogout')->group(function () {
    Route::get('/control/login', [AuthController::class, 'adminLogin'])->name('adminLogin');
    Route::post('/control/login', [AuthController::class, 'adminLogin_post'])->name('adminLogin_post');
});

Route::middleware('isAdminLogin')->group(function () {
    Route::get('/admin', [AdminGeneralController::class, "adminIndex"])->name('adminIndex');

    //Profile Start

    Route::get('/admin/profile', [AdminProfileController::class, "adminProfileIndex"])->name('adminProfileIndex');
    Route::post('/admin/profile', [AdminProfileController::class, "adminProfilePost"])->name('adminProfilePost');

    Route::get('/admin/profile/password', [AdminProfileController::class, "adminProfilePassword"])->name('adminProfilePassword');
    Route::post('/admin/profile/password', [AdminProfileController::class, "adminProfilePasswordPost"])->name('adminProfilePasswordPost');

    Route::get('/admin/list', [AdminProfileController::class, "adminList"])->name('adminList');
    Route::post('/admin/list', [AdminProfileController::class, "adminListPost"])->name('adminListPost');
    Route::post('/admin/list/password', [AdminProfileController::class, "adminListPassword"])->name('adminListPassword');
    Route::post('/admin/list/delete', [AdminProfileController::class, "adminListDelete"])->name('adminListDelete');
    //Profile End

    //Start Settings
    Route::get('/admin/settings/seo', [SettingsController::class, "settingsSeoIndex"])->name('settingsSeoIndex');
    Route::post('/admin/settings/seo', [SettingsController::class, "settingsSeoPost"])->name('settingsSeoPost');

    Route::get('/admin/settings/logo-favicon', [SettingsController::class, "settingsLogoIndex"])->name('settingsLogoIndex');
    Route::post('/admin/settings/logo-favicon/logo', [SettingsController::class, "settingsLogoPost"])->name('settingsLogoPost');
    Route::post('/admin/settings/logo-favicon/favicon', [SettingsController::class, "settingsFaviconPost"])->name('settingsFaviconPost');

    Route::get('/admin/settings/categories', [SettingsController::class, "settingsCategoriesIndex"])->name('settingsCategoriesIndex');
    Route::post('/admin/settings/categories/edit', [SettingsController::class, "settingsCategoriesEdit"])->name('settingsCategoriesEdit');
    Route::post('/admin/settings/categories/add', [SettingsController::class, "settingsCategoriesAdd"])->name('settingsCategoriesAdd');
    Route::post('/admin/settings/categories', [SettingsController::class, "settingsCategoriesPost"])->name('settingsCategoriesPost');
    Route::post('/admin/categories/status', [SettingsController::class, "categoriesStatus"])->name('categoriesStatus');

    Route::get('/admin/settings/sectors', [SettingsController::class, "settingsSectorsIndex"])->name('settingsSectorsIndex');
    Route::post('/admin/settings/sectors/edit', [SettingsController::class, "settingsSectorsEdit"])->name('settingsSectorsEdit');
    Route::post('/admin/settings/sectors', [SettingsController::class, "settingsSectorsPost"])->name('settingsSectorsPost');
    Route::post('/admin/settings/sectors/add', [SettingsController::class, "settingsSectorsAdd"])->name('settingsSectorsAdd');
    Route::post('/admin/sectors/status', [SettingsController::class, "sectorsStatus"])->name('sectorsStatus');

    Route::get('/admin/settings/cities', [SettingsController::class, "settingsCitiesIndex"])->name('settingsCitiesIndex');
    Route::post('/admin/settings/cities/edit', [SettingsController::class, "settingsCitiesEdit"])->name('settingsCitiesEdit');
    Route::post('/admin/settings/cities', [SettingsController::class, "settingsCitiesPost"])->name('settingsCitiesPost');
    Route::post('/admin/settings/cities/add', [SettingsController::class, "settingsCitiesAdd"])->name('settingsCitiesAdd');
    Route::post('/admin/cities/status', [SettingsController::class, "citiesStatus"])->name('citiesStatus');

    Route::get('/admin/settings/education', [SettingsController::class, "settingsEducationIndex"])->name('settingsEducationIndex');
    Route::post('/admin/settings/education/edit', [SettingsController::class, "settingsEducationEdit"])->name('settingsEducationEdit');
    Route::post('/admin/settings/education', [SettingsController::class, "settingsEducationPost"])->name('settingsEducationPost');
    Route::post('/admin/settings/education/add', [SettingsController::class, "settingsEducationAdd"])->name('settingsEducationAdd');
    Route::post('/admin/education/status', [SettingsController::class, "educationStatus"])->name('educationStatus');

    Route::get('/admin/settings/experience', [SettingsController::class, "settingsExperienceIndex"])->name('settingsExperienceIndex');
    Route::post('/admin/settings/experience/edit', [SettingsController::class, "settingsExperienceEdit"])->name('settingsExperienceEdit');
    Route::post('/admin/settings/experience', [SettingsController::class, "settingsExperiencePost"])->name('settingsExperiencePost');
    Route::post('/admin/settings/experience/add', [SettingsController::class, "settingsExperienceAdd"])->name('settingsExperienceAdd');
    Route::post('/admin/experience/status', [SettingsController::class, "experienceStatus"])->name('experienceStatus');

    Route::get('/admin/settings/regions', [SettingsController::class, "settingsRegionsIndex"])->name('settingsRegionsIndex');
    Route::post('/admin/settings/regions/edit', [SettingsController::class, "settingsRegionsEdit"])->name('settingsRegionsEdit');
    Route::post('/admin/settings/regions', [SettingsController::class, "settingsRegionsPost"])->name('settingsRegionsPost');
    Route::post('/admin/settings/regions/add', [SettingsController::class, "settingsRegionsAdd"])->name('settingsRegionsAdd');
    Route::post('/admin/regions/status', [SettingsController::class, "regionsStatus"])->name('regionsStatus');

    Route::get('/admin/settings/genders', [SettingsController::class, "settingsGendersIndex"])->name('settingsGendersIndex');
    Route::post('/admin/settings/genders/edit', [SettingsController::class, "settingsGendersEdit"])->name('settingsGendersEdit');
    Route::post('/admin/settings/genders', [SettingsController::class, "settingsGendersPost"])->name('settingsGendersPost');
    Route::post('/admin/settings/genders/add', [SettingsController::class, "settingsGendersAdd"])->name('settingsGendersAdd');
    Route::post('/admin/genders/status', [SettingsController::class, "gendersStatus"])->name('gendersStatus');

    Route::get('/admin/settings/jobtype', [SettingsController::class, "settingsJobTypeIndex"])->name('settingsJobTypeIndex');
    Route::post('/admin/settings/jobtype/edit', [SettingsController::class, "settingsJobTypeEdit"])->name('settingsJobTypeEdit');
    Route::post('/admin/settings/jobtype', [SettingsController::class, "settingsJobTypePost"])->name('settingsJobTypePost');
    Route::post('/admin/settings/jobtype/add', [SettingsController::class, "settingsJobTypeAdd"])->name('settingsJobTypeAdd');
    Route::post('/admin/jobtype/status', [SettingsController::class, "jobtypeStatus"])->name('jobtypeStatus');

    Route::get('/admin/settings/accept-type', [SettingsController::class, "settingsAcceptIndex"])->name('settingsAcceptIndex');
    Route::post('/admin/settings/accept-type/edit', [SettingsController::class, "settingsAcceptEdit"])->name('settingsAcceptEdit');
    Route::post('/admin/settings/accept-type', [SettingsController::class, "settingsAcceptPost"])->name('settingsAcceptPost');
    Route::post('/admin/settings/accept-type/add', [SettingsController::class, "settingsAcceptAdd"])->name('settingsAcceptAdd');
    Route::post('/admin/accept-type/status', [SettingsController::class, "acceptStatus"])->name('acceptStatus');

    //End Settings

    //Start Contact Info
    Route::get('/admin/settings/contact', [ContactInfoController::class, "settingsContactIndex"])->name('settingsContactIndex');
    Route::post('/admin/settings/contact', [ContactInfoController::class, "settingsContactPost"])->name('settingsContactPost');
    //End Contact Info

    //Start Social Media
    Route::get('/admin/settings/social-media', [SocialMediaController::class, "settingsSocialIndex"])->name('settingsSocialIndex');
    Route::post('/admin/settings/social-media', [SocialMediaController::class, "settingsSocialPost"])->name('settingsSocialPost');

    //End Social Media

    //Start Blog
    Route::get('/admin/blog/list', [BlogController::class, "blogListIndex"])->name('blogListIndex');
    Route::get('/admin/blog/add', [BlogController::class, "blogAddIndex"])->name('blogAddIndex');
    Route::post('/admin/blog/add', [BlogController::class, "blogAddPost"])->name('blogAddPost');
    Route::get('/admin/blog/edit/{id}', [BlogController::class, "blogEditIndex"])->name('blogEditIndex');
    Route::post('/admin/blog/edit', [BlogController::class, "blogEditPost"])->name('blogEditPost');
    Route::post('/admin/blog/status', [BlogController::class, "blogStatusPost"])->name('blogStatusPost');
    Route::post('/admin/blog/delete', [BlogController::class, "blogDeletePost"])->name('blogDeletePost');
    //End Blog

    //Start Companies
    Route::get('/admin/companies/list', [AdminCompaniesController::class, "companiesList"])->name('companiesList');
    Route::get('/admin/companies/add', [AdminCompaniesController::class, "companiesAdd"])->name('companiesAdd');
    Route::post('/admin/companies/add', [AdminCompaniesController::class, "companiesAddPost"])->name('companiesAddPost');
    Route::post('/admin/companies/change/status', [AdminCompaniesController::class, "companiesStatus"])->name('companiesStatus');

    Route::get('/admin/companies/edit/{id}', [AdminCompaniesController::class, "companiesEdit"])->name('companiesEdit');
    Route::post('/admin/companies/edit', [AdminCompaniesController::class, "companiesEditPost"])->name('companiesEditPost');
    Route::post('/admin/companies/delete', [AdminCompaniesController::class, "companiesDelete"])->name('companiesDelete');

    //End Companies

    //Start Trainings
    Route::get('/admin/trainings/list', [TrainingsController::class, "trainingList"])->name('trainingList');
    Route::get('/admin/trainings/add', [TrainingsController::class, "trainingAdd"])->name('trainingAdd');
    Route::post('/admin/trainings/add', [TrainingsController::class, "trainingAddPost"])->name('trainingaddPost');

    Route::get('/admin/trainings/edit/{id}', [TrainingsController::class, "trainingEdit"])->name('trainingEdit');
    Route::post('/admin/trainings/edit/training/post', [TrainingsController::class, "trainingEditPost"])->name('trainingeditPost');
    Route::post('/admin/trainings/status', [TrainingsController::class, "trainingStatus"])->name('trainingStatus');
    Route::post('/admin/trainings/delete', [TrainingsController::class, "trainingDelete"])->name('trainingDelete');
    //End Trainings

    //Start Vacancies
    Route::get('/admin/vacancies/list', [VacancyController::class, "vacanciesList"])->name('vacanciesList');
    Route::get('/admin/vacancy/add', [VacancyController::class, "vacanciesAdd"])->name('vacanciesAdd');
    Route::post('/admin/vacancy/add', [VacancyController::class, "vacanciesAddPost"])->name('vacanciesAddPost');

    Route::get('/admin/vacancy/edit/{id}', [VacancyController::class, "vacanciesEdit"])->name('vacanciesEdit');
    Route::post('/admin/vacancy/edit', [VacancyController::class, "vacanciesEditPost"])->name('vacanciesEditPost');

    Route::post('/admin/vacancy/status', [VacancyController::class, "vacancyStatus"])->name('vacancyStatus');
    Route::post('/admin/vacancy/delete', [VacancyController::class, "vacancyDelete"])->name('vacancyDelete');
    //End Vacancies

    //Start CV
    Route::get('/admin/cvs/list', [CvController::class, "cvList"])->name('cvList');
    Route::get('/admin/cv/add', [CvController::class, "cvAdd"])->name('cvAdd');
    Route::get('/admin/cv/edit/{id}', [CvController::class, "cvEdit"])->name('cvEdit');
    Route::post('/admin/cv/edit', [CvController::class, "cvEditPost"])->name('cvEditPost');
    Route::post('/admin/cv/status', [CvController::class, "cvStatus"])->name('cvStatus');
    Route::post('/admin/cv/delete', [CvController::class, "cvDelete"])->name('cvDelete');
    //End CV

    //Start ChangeData
    Route::get('/admin/change-data/companies', [ChangeDataController::class, "companiesDataIndex"])->name('companiesDataIndex');
    Route::post('/admin/change-data/companies', [ChangeDataController::class, "companiesDataPost"])->name('companiesDataPost');
    //End ChangeData

    //Start Adverts
    Route::get('/admin/adverts/list', [AdvertsController::class, "advertListIndex"])->name('advertListIndex');
    Route::post('/admin/adverts/list', [AdvertsController::class, "advertListPost"])->name('advertListPost');
    Route::post('/admin/adverts/status', [AdvertsController::class, "advertStatus"])->name('advertStatus');
    Route::post('/admin/adverts/delete', [AdvertsController::class, "advertDelete"])->name('advertDelete');

    //End Adverts

    //Start UserLaw
    Route::get('/admin/policy/list', [UserPolicyController::class, "policyList"])->name('policyList');
    Route::post('/admin/policy/list', [UserPolicyController::class, "policyAddPost"])->name('policyAddPost');
    Route::post('/admin/policy/edit', [UserPolicyController::class, "policyEdit"])->name('policyEdit');
    Route::post('/admin/policy/edit/post', [UserPolicyController::class, "policyEditPost"])->name('policyEditPost');
    Route::post('/admin/policy/status', [UserPolicyController::class, "policyStatus"])->name('policyStatus');
    Route::post('/admin/policy/delete', [UserPolicyController::class, "policyDelete"])->name('policyDelete');

    Route::get('/admin/privacy/communication/list', [UserPolicyController::class, "privacyComList"])->name('privacyComList');
    Route::post('/admin/privacy/communication/list', [UserPolicyController::class, "privacyComAddPost"])->name('privacyComAddPost');
    Route::post('/admin/privacy/communication/edit', [UserPolicyController::class, "privacyComEdit"])->name('privacyComEdit');
    Route::post('/admin/privacy/communication/edit/post', [UserPolicyController::class, "privacyComEditPost"])->name('privacyComEditPost');
    Route::post('/admin/privacy/communication/status', [UserPolicyController::class, "privacyComStatus"])->name('privacyComStatus');
    Route::post('/admin/privacy/communication/delete', [UserPolicyController::class, "privacyComDelete"])->name('privacyComDelete');

    Route::get('/admin/privacy/software/list', [UserPolicyController::class, "privacyProList"])->name('privacyProList');
    Route::post('/admin/privacy/software/list', [UserPolicyController::class, "privacyProAddPost"])->name('privacyProAddPost');
    Route::post('/admin/privacy/software/edit', [UserPolicyController::class, "privacyProEdit"])->name('privacyProEdit');
    Route::post('/admin/privacy/software/edit/post', [UserPolicyController::class, "privacyProEditPost"])->name('privacyProEditPost');
    Route::post('/admin/privacy/software/status', [UserPolicyController::class, "privacyProStatus"])->name('privacyProStatus');
    Route::post('/admin/privacy/software/delete', [UserPolicyController::class, "privacyProDelete"])->name('privacyProDelete');

    //End UserLaw

    //Start Subscribers
    Route::get('/admin/subscribers', [SubscribersController::class, "subscribersIndex"])->name('subscribersIndex');
    Route::post('/admin/subscribers/status', [SubscribersController::class, "subscribersStatus"])->name('subscribersStatus');
    Route::post('/admin/subscribers/delete', [SubscribersController::class, "subscribersDelete"])->name('subscribersDelete');
    //End Subscribers

    //Start LoginImages
    Route::get('/admin/login-images', [LoginImageController::class, "imageIndex"])->name('imageIndex');
    Route::post('/admin/login-images', [LoginImageController::class, "imagePost"])->name('imagePost');
    Route::post('/admin/login-images/status', [LoginImageController::class, "imageStatus"])->name('imageStatus');
    Route::post('/admin/login-images/delete', [LoginImageController::class, "imageDelete"])->name('imageDelete');
    //End LoginImages

    //Start Story
    Route::get('/admin/stories', [StoriesController::class, "storyIndex"])->name('storyIndex');
    Route::post('/admin/stories', [StoriesController::class, "storyPost"])->name('storyPost');
    Route::post('/admin/stories/edit', [StoriesController::class, "storyEdit"])->name('storyEdit');
    Route::post('/admin/stories/edit/post', [StoriesController::class, "storyEditPost"])->name('storyEditPost');
    Route::post('/admin/stories/status', [StoriesController::class, "storyStatus"])->name('storyStatus');
    Route::post('/admin/stories/delete', [StoriesController::class, "storyDelete"])->name('storyDelete');
    //End Story

    //Start Contact
    Route::get('/admin/contact/list', [ContactController::class, "contactIndex"])->name('contactIndex');
    Route::post('/admin/contact/list', [ContactController::class, "contactGet"])->name('contactGet');
    Route::post('/admin/contact/delete', [ContactController::class, "contactDelete"])->name('contactDelete');
    //End Contact

    //Start Review
    Route::get('/admin/review/list', [ReviewController::class, "reviewIndex"])->name('reviewIndex');
    Route::get('/admin/review/edit/{id}', [ReviewController::class, "reviewEdit"])->name('reviewEdit');
    Route::post('/admin/review/edit', [ReviewController::class, "reviewPost"])->name('reviewPost');
    Route::post('/admin/review/status', [ReviewController::class, "reviewStatus"])->name('reviewStatus');
    Route::post('/admin/review/delete', [ReviewController::class, "reviewDelete"])->name('reviewDelete');
    //End Review

    //Start BannerImage
    Route::get('/admin/banner-image', [BannerImageController::class, "bannerImageIndex"])->name('bannerImageIndex');
    Route::post('/admin/banner-image', [BannerImageController::class, "bannerImagePost"])->name('bannerImagePost');

    //End BannerImage


    Route::get('/admin/logout', [AuthController::class, "adminLogout"])->name('adminLogout');
});



Route::get('login/user-verification/{verification}',[AccountController::class,'user_verification'])->name('user_verification');
Route::get('login/reset-password/{verification}',[AccountController::class,'forget_verification'])->name('forget_verification');
Route::get('/login', [AccountController::class, 'login'])->name('login');
Route::get('/sel', [AccountController::class, 'sel'])->name('sel');
Route::post('/select_post', [AccountController::class, 'select_post'])->name('select_post');
Route::get('/forget', [AccountController::class, 'forget'])->name('forget');
Route::post('/forget_post', [AccountController::class, 'forget_post'])->name('forget_post');
Route::get('/confirmpass', [AccountController::class, 'confirmpass'])->name('confirmpass');
Route::post('/confirm_post', [AccountController::class, 'confirm_post'])->name('confirm_post');
Route::get('/google/login', [AccountController::class, 'googlelogin'])->name('googlelogin');
Route::get('/google/login/callback', [AccountController::class, 'callback'])->name('callback');

Route::post('/loginu', [AccountController::class, 'login_post'])->name('login_post');
Route::get('/logout', [AccountController::class, "logout"])->name('logout');
Route::get('/register', [AccountController::class, 'register'])->name('register');
Route::post('/registeru', [AccountController::class, 'register_post'])->name('register_post');
Route::post('/news', [AccountController::class, 'newslatter'])->name('newslatter');

Route::get('/', [GeneralController::class, 'index'])->name('index');
Route::post('/like', [GeneralController::class, 'like'])->name('indexlike');
Route::post('/dislike', [GeneralController::class, 'dislike'])->name('idislike');
Route::get('/load-more', [GeneralController::class, 'loadMore'])->name('loadMore');
Route::get('/load-less', [GeneralController::class, 'loadLess'])->name('loadLess');


Route::get('/cv',[CVFrontController::class, 'cvAdd'])->name('cvindex')->middleware('isLogin');
;
Route::get('/cvedit/{id}',[CVFrontController::class, 'cvedit'])->name('cvedit');
Route::post('/cvv',[CVFrontController::class, 'cvPost'])->name('cvPost');
Route::post('/cv/update',[CVFrontController::class, 'cveditPost'])->name('cveditPost');
Route::post('/cvdel',[CVFrontController::class, 'delport'])->name('delport');


Route::get('/blog',[BlogFrontController::class, 'allblogs'])->name('allblogs');
Route::get('/blogview/{title}-{id}',[BlogFrontController::class, 'detail'])->name('blogdetail');
Route::get('/blogaxtar',[BlogFrontController::class, 'blogsearch'])->name('blogsearch');


Route::get('/announces',[VacancyFrontController::class, 'companies'])->name('announcesindex');
Route::get('/announces/create',[VacancyFrontController::class, 'createAnnounces'])->name('createAnnounces');
Route::post('/announces/createe',[VacancyFrontController::class, 'elanPost'])->name('elanPost');
Route::post('addcompany',[VacancyFrontController::class, 'addcompany'])->name('addcompany');
Route::get('/announces/my',[VacancyFrontController::class, 'myAnnounces'])->name('myAnnounces');
Route::get('/announces/edit/{id}',[VacancyFrontController::class, 'elanEdit'])->name('elanEdit');
Route::post('/announces/update',[VacancyFrontController::class, 'elanEditPost'])->name('elanEditPost');
Route::get('/allvacancy',[VacancyFrontController::class, 'vacancies'])->name('allvacancies');
Route::get('/vacancy/{id}',[VacancyFrontController::class, 'detail'])->name('vacancydetail');
Route::get('/vsearch',[VacancyFrontController::class, 'vsearch'])->name('vsearch');
Route::post('/favorites', [VacancyFrontController::class, 'like'])->name('like');
Route::post('/disslike', [VacancyFrontController::class, 'dislike'])->name('dislike');
Route::get('/candidate',[VacancyFrontController::class, 'candidate'])->name('candidate');
Route::get('/delete/{id}',[VacancyFrontController::class, 'delete'])->name('delete');
Route::get('/compedit/{id}',[VacancyFrontController::class, 'compedit'])->name('compedit');
Route::post('companiesEditPost',[VacancyFrontController::class, 'companiesEditPost'])->name('companiesEditPost');
Route::post('selectcv',[VacancyFrontController::class, 'selectcv'])->name('selectcv');
Route::post('asantmur',[VacancyFrontController::class, 'asantmur'])->name('asantmur');
Route::get('/candidate/{id}/cv', [VacancyFrontController::class, 'downloadcv'])->name('downloadcvv');



Route::get('/company',[CompanyFrontController::class, 'companies'])->name('allcompany');
Route::get('/companyvacancies/{id}', [CompanyFrontController::class, 'compvac'])->name('compvac');
Route::get('/company/{id}',[CompanyFrontController::class, 'detail'])->name('compdetail');
Route::get('/companyaxtar',[CompanyFrontController::class, 'compsearch'])->name('compsearch');
Route::post('/comment',[CompanyFrontController::class, 'addComment'])->name('addComment');
Route::post('/compfavorites', [CompanyFrontController::class, 'like'])->name('complike');
Route::post('/compdisslike', [CompanyFrontController::class, 'dislike'])->name('compdislike');

Route::get('/contact',[ContactFrontController::class, 'index'])->name('contactindex'); 
Route::post('/contactpost',[ContactFrontController::class, 'contactpost'])->name('contactpost'); 




Route::get('/tranings',[TraningFrontController::class, 'alltrainings'])->name('trainings');
Route::get('/traningview/{id}',[TraningFrontController::class, 'detail'])->name('trainingsdetail');
Route::get('/traning/create',[TraningFrontController::class, 'trainingCreate'])->name('traningcreate');
Route::post('/traning/createe',[TraningFrontController::class, 'trainingAddPost'])->name('trainingAddPost');
Route::get('/traning/edit/{id}',[TraningFrontController::class, 'trainingEdit'])->name('traniningedit');
Route::post('/training/edit/training/post', [TraningFrontController::class, "trainingEditPost"])->name('trainingEditPost');
Route::get('/telimaxtar',[TraningFrontController::class, 'telimaxtar'])->name('telimaxtar');




Route::post('/cvfavorites', [JobsearcherController::class, 'like'])->name('cvlike');
Route::post('/cvdisslike', [JobsearcherController::class, 'dislike'])->name('cvdislike');
Route::get('/jobsearcher',[JobsearcherController::class, 'jobsearch'])->name('jobsearch');
Route::get('/jobsearcher/{id}', [JobsearcherController::class, 'detail'])->name('jobsearchdetail');
Route::get('/cvaxtar',[JobsearcherController::class, 'cvaxtar'])->name('cvaxtar');
Route::get('/jobsearcher/{id}/cv', [JobsearcherController::class, 'downloadcv'])->name('downloadcv');


Route::get('/policy',[PolicyController::class, 'index'])->name('policy');

Route::get('/terms',[TermsController::class, 'index'])->name('terms');

Route::get('/profile',[AccountController::class, 'profile'])->name('profile');
Route::post('/profile',[AccountController::class, 'updatePassword'])->name('updatePassword');

Route::get('/{lang}', [LanguageController::class, 'setLang']);


