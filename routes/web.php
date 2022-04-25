<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssemblyController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\AssemblyTenureController;
use App\Http\Controllers\ParliamentaryYearsController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\MemebersDirectoryController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\WorkingOfAssemblyController;
use App\Http\Controllers\RoleOfAssemblyController;
use App\Http\Controllers\CabinetCompositionController;
use App\Http\Controllers\RulesOfProceduresController;
use App\Http\Controllers\ParliamentaryPrivilegesController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\DirectoryOfOfficersController;
use App\Http\Controllers\PowersFunctionsController;
use App\Http\Controllers\ContactListController;
use App\Http\Controllers\AssemblyLibraryController;
use App\Http\Controllers\OrganizationalChartController;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\thesindhtrans2016Controller;
use App\Http\Controllers\SpeakersController;
use App\Http\Controllers\DeputySpeakerController;
use App\Http\Controllers\ListofMembersController;
use App\Http\Controllers\PastAssemblyMembersController;
use App\Http\Controllers\CurrentAssemblySummaryController;
use App\Http\Controllers\MainSessionsController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\OrderOfTheDaySummaryOfProceedingsController;
use App\Http\Controllers\StagesOfBillsController;
use App\Http\Controllers\BillsController;
use App\Http\Controllers\ActsController;
use App\Http\Controllers\MotionsController;
use App\Http\Controllers\ParliamentaryCalendarController;
use App\Http\Controllers\CommitteeSystemDetailController;
use App\Http\Controllers\CommitteeRulesController;
use App\Http\Controllers\PublicAccountsCommitteeController;
use App\Http\Controllers\StandingCommitteesController;
use App\Http\Controllers\ReportsLaidController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\PressReleasesController;
use App\Http\Controllers\PictureGalleryController;
use App\Http\Controllers\TendersController;
use App\Http\Controllers\GlossaryController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\WebCastLiveVideoAudioController;
use App\Http\Controllers\VideoArchiveController;
use App\Http\Controllers\PublicationsController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\CallAttentionController;
use App\Http\Controllers\ResolutionsPassedController;
use App\Http\Controllers\StandingCommitteesCategoryController;
use App\Http\Controllers\CommitteeonGovernmentAssuranceController;
use App\Http\Controllers\MemeberPerformanceController;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\ProductController;
use App\Http\Controllers\SocialLinkController;
use App\Http\Controllers\ElectionControllerController;
use App\Http\Controllers\PublicAccountsCommitteeMemberController;
use App\Http\Controllers\AdvisorController;
use App\Http\Controllers\ContactusController;
use App\Models\User;
use App\Http\Controllers\OtherCommitteeController;
use App\Http\Controllers\OtherCommitteeDataController;
use App\Http\Controllers\OtherCommitteeMemberController;
use App\Http\Controllers\LegislationsControlle;


/*                       MembersDirectoryController
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::group(['prefix' => 'en'], function () {
//     App::setLocale('en');
//     Route::get('/{locale?}', [HomeController::class, 'mainindex'])->name('home')->middleware('auth');
// });

// Route::prefix('{locale?}')->middleware('locale')->group(function() {

// });

// Route::get('{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);


Route::group([
    'prefix' => '{locale?}',
    'where' => ['locale' => '[a-zA-Z]{2}'],
    'middleware' => 'Localization'
    ], function() {

        Route::get('/superadmin', function () {
            return redirect('en/superadmin');
        });

        Route::get('/', function () {
            return redirect('en/home');
        });
        // Route::get('{locales}/', function ($locales) {
        //     if (! in_array($locales, ['en', 'es', 'fr'])) {
        //         dd($locales);
        //     }

        //     // App::setLocale($locales);

        //     //
        // });
        // $locale = App::getLocale();
        // if (! in_array($locale, ['en', 'ur', 'sd'])) {
        //     dd($locale);
        // }else{
        //     dd($locale);
        // }
        Route::resource('about', AboutController::class)->middleware('auth');



Route::get('/home', [HomeController::class, 'mainindex'])->name('home');

// Route::get('/aas/{locale?}', function ($locale = null) {
//     if (isset($locale) && in_array($locale, config('app.available_locales'))) {
//         app()->setLocale($locale);
//     }

//     return view('partials.language_switcher');
// });


Route::put('/register', function () {
    return view('index');
})->middleware('auth');





Route::resource('/assembly',AssemblyController::class)->middleware('auth');
Route::resource('/party',PartyController::class)->middleware('auth');
Route::resource('/assemblytenure', AssemblyTenureController::class)->middleware('auth');
Route::resource('/parliamentaryyear',ParliamentaryYearsController::class)->middleware('auth');
Route::resource('/messages', MessageController::class)->middleware('auth');
Route::resource('/workingofassembly',WorkingOfAssemblyController::class )->middleware('auth');
Route::resource('/roleofassembly', RoleOfAssemblyController::class)->middleware('auth');
Route::resource('/cabinetcomposition',CabinetCompositionController::class)->middleware('auth');

Route::resource('/advisor',AdvisorController::class)->middleware('auth');

Route::resource('/elections',ElectionControllerController::class)->middleware('auth');
Route::resource('/rulesofprocedures',RulesOfProceduresController::class)->middleware('auth');
Route::resource('/parliamentaryprivileges', ParliamentaryPrivilegesController::class)->middleware('auth');



Route::resource('/committeeongovernmentassurance', CommitteeonGovernmentAssuranceController::class)->middleware('auth');
// ABOUT SECERTARIATE
Route::resource('/overview',OverviewController::class)->middleware('auth');
Route::resource('/organizationalchart', OrganizationalChartController::class)->middleware('auth');
Route::resource('/directoryofofficers', DirectoryOfOfficersController::class)->middleware('auth');
Route::resource('/powersfunctions', PowersFunctionsController::class)->middleware('auth');
Route::resource('/contactlist', ContactListController::class)->middleware('auth');
Route::resource('/rules', RulesController::class)->middleware('auth');
Route::resource('/thesindhtrans2016', thesindhtrans2016Controller::class)->middleware('auth');
Route::resource('/assemblylibrary', AssemblyLibraryController::class)->middleware('auth');

// MEMBER
Route::resource('/speakers', SpeakersController::class)->middleware('auth');
Route::resource('/deputyspeaker', DeputySpeakerController::class)->middleware('auth');
Route::resource('/membersdirectory', MemebersDirectoryController::class)->middleware('auth');
Route::resource('/listofmembers', ListofMembersController::class );
Route::resource('/pastassemblymembers', PastAssemblyMembersController::class)->middleware('auth');


// ASSEMBLY BUSINESS
Route::resource('/currentassemblysummary', CurrentAssemblySummaryController::class)->middleware('auth');
Route::resource('/mainsessions', MainSessionsController::class)->middleware('auth');
Route::resource('/sessions', SessionsController::class)->middleware('auth');
Route::resource('/otdsummaryofproceedings',OrderOfTheDaySummaryOfProceedingsController::class)->middleware('auth');

Route::get('/housedebates', function () {
    return view('housedebates');
})->name('housedebates');

Route::resource('/questions', QuestionsController::class)->middleware('auth');
Route::resource('/callattention', CallAttentionController::class)->middleware('auth');
Route::resource('/resolutionspassed', ResolutionsPassedController::class)->middleware('auth');
Route::resource('/stagesofbills', StagesOfBillsController::class)->middleware('auth');
Route::resource('/bills', BillsController::class)->middleware('auth');
Route::resource('/acts',ActsController::class)->middleware('auth');
Route::resource('/motions', MotionsController::class)->middleware('auth');
Route::resource('/parliamentarycalendar', ParliamentaryCalendarController::class)->middleware('auth');

// COMMITTEE
Route::resource('/committeesystemdetail', CommitteeSystemDetailController::class)->middleware('auth');
Route::resource('/committeerules', CommitteeRulesController::class)->middleware('auth');
Route::resource('/publicaccountscommittee', PublicAccountsCommitteeController::class)->middleware('auth');
Route::resource('/publicaccountscommitteemember', PublicAccountsCommitteeMemberController::class)->middleware('auth');
Route::resource('/standingcommittees', StandingCommitteesController::class)->middleware('auth');
Route::resource('/standingcommitteescategory', StandingCommitteesCategoryController::class)->middleware('auth');
Route::resource('/reportslaid', ReportsLaidController::class)->middleware('auth');

// OTHER
Route::resource('/othercommittee',OtherCommitteeController::class)->middleware('auth');
Route::resource('/othercommitteedata',OtherCommitteeDataController::class)->middleware('auth');
Route::resource('/othercommitteemember',OtherCommitteeMemberController::class)->middleware('auth');

// Legislations
Route::resource('/legislations',LegislationsControlle::class)->middleware('auth');

Route::get('/committeesonrulesofprocedureprivileges', function () {
    return view('committeesonrulesofprocedureprivileges');
})->name('committeesonrulesofprocedureprivileges');


// MEDIA CENTRE
Route::resource('/notifications', NotificationsController::class)->middleware('auth');
Route::resource('/pressreleases', PressReleasesController::class)->middleware('auth');
Route::resource('/picturegallery', PictureGalleryController::class)->middleware('auth');
Route::resource('/tenders', TendersController::class)->middleware('auth');
Route::resource('/glossary', GlossaryController::class)->middleware('auth');
Route::resource('/faqs', FaqsController::class)->middleware('auth');
Route::resource('/webcastlivevideoaudio', WebCastLiveVideoAudioController::class)->middleware('auth');
Route::resource('/videoarchive', VideoArchiveController::class)->middleware('auth');

Route::resource('/membersperformancereport', MemeberPerformanceController::class)->middleware('auth');

Route::get('/newsandactivities', function () {
    return view('newsandactivities');
})->name('newsandactivities');

Route::get('/jobs', function () {
    return view('jobs');
})->name('jobs');



Route::get('/sociallink', [SocialLinkController::class, 'index'])->name('sociallink');
Route::put('/sociallink', [SocialLinkController::class, 'update'])->name('sociallinkupdate');

Route::get('/contactus', [ContactusController::class, 'index'])->name('contactus');
Route::put('/contactus', [ContactusController::class, 'update'])->name('contactusupdate');


// Publications
Route::resource('/publications', PublicationsController::class)->middleware('auth');

Route::get('/reports', function () {
    return view('reports');
})->name('reports');


Route::get('/superadmin', [HomeController::class, 'index'])->name('superadmin');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::resource('roles', RoleController::class)->middleware('auth');
    Route::resource('users', UserController::class)->middleware('auth');
    // Route::resource('products', ProductController::class)->middleware('auth');

Auth::routes();

});

