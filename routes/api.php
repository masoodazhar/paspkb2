<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\WorkingOfAssemblyController;
use App\Http\Controllers\RoleOfAssemblyController;
use App\Http\Controllers\CabinetCompositionController;
use App\Http\Controllers\AssemblyTenureController;
use App\Http\Controllers\RulesOfProceduresController;
use App\Http\Controllers\ParliamentaryPrivilegesController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\OrganizationalChartController;
use App\Http\Controllers\DirectoryOfOfficersController;
use App\Http\Controllers\PowersFunctionsController;
use App\Http\Controllers\ContactListController;
use App\Http\Controllers\RulesController;
use App\Http\Controllers\thesindhtrans2016Controller;
use App\Http\Controllers\AssemblyLibraryController;
use App\Http\Controllers\SpeakersController;
use App\Http\Controllers\DeputySpeakerController;
use App\Http\Controllers\ListofMembersController;
use App\Http\Controllers\PastAssemblyMembersController;
use App\Http\Controllers\CurrentAssemblySummaryController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\OrderOfTheDaySummaryOfProceedingsController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\CallAttentionController;
use App\Http\Controllers\ResolutionsPassedController;
use App\Http\Controllers\StagesOfBillsController;
use App\Http\Controllers\BillsController;
use App\Http\Controllers\ActsController;
use App\Http\Controllers\MotionsController;
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
use App\Http\Controllers\MemebersDirectoryController;
use App\Http\Controllers\ParliamentaryCalendarController;
use App\Http\Controllers\CommitteeonGovernmentAssuranceController;
use App\Http\Controllers\MemeberPerformanceController;
use App\Http\Controllers\HomeApisController;
use App\Http\Controllers\SocialLinkController;
use App\Http\Controllers\ElectionControllerController;
use App\Http\Controllers\PublicAccountsCommitteeMemberController;
use App\Http\Controllers\AdvisorController;
use App\Http\Controllers\ContactusController;
use App\Http\Controllers\LegislationsControlle;
use App\Http\Controllers\OtherCommitteeController;
use App\Http\Controllers\OtherCommitteeDataController;
use App\Http\Controllers\OtherCommitteeMemberController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Other committees
Route::get('/allcommitteesheader/{locale?}', [OtherCommitteeController::class, 'getAllCommitteesHeader']);

Route::get('/othercommittee/{headerid?}/{locale?}', [OtherCommitteeDataController::class, 'get_othercommittees']);
Route::get('/othercommitteemembers/{headerid?}/{locale?}', [OtherCommitteeMemberController::class, 'get_othercommitteemembers']);

Route::get('/assemblytenure/{locale?}', [AssemblyTenureController::class, 'get_assemblytenure']);
Route::get('/about/{locale?}', [AboutController::class, 'get_about']);
Route::get('/messages/{locale?}', [MessageController::class, 'get_messages']);
Route::get('/workingofassembly/{locale?}', [WorkingOfAssemblyController::class, 'get_workingofassembly']);
Route::get('/roleofassembly/{locale?}', [RoleOfAssemblyController::class, 'get_roleofassembly']);

Route::get('/cabinetcomposition/{tenuresid?}/{locale?}', [CabinetCompositionController::class, 'get_cabinetcomposition']);

Route::get('/advisor/{tenuresid?}/{locale?}', [AdvisorController::class, 'get_advisor']);
Route::get('/specialadvisor/{tenuresid?}/{locale?}', [AdvisorController::class, 'get_specialadvisor']);

Route::get('/elections/{tenuresid?}/{locale?}', [ElectionControllerController::class, 'get_election']);


Route::get('/cabinetcompositionleaderofthehouse/{category?}/{locale?}', [CabinetCompositionController::class, 'get_cabinetcompositionCat']);
Route::get('/rulesofprocedures/{id?}/{locale?}', [RulesOfProceduresController::class, 'get_rulesofprocedures']);
Route::get('/parliamentaryprivileges/{status?}/{locale?}', [ParliamentaryPrivilegesController::class, 'get_parliamentaryprivileges']);
Route::get('/parliamentaryprivilegesbyid/{id?}/{locale?}', [ParliamentaryPrivilegesController::class, 'get_parliamentaryprivilegesByid']);
Route::get('/overview/{locale?}', [OverviewController::class, 'get_overview']);
Route::get('/organizationalchart/{locale?}', [OrganizationalChartController::class, 'get_organizationalchart']);
Route::get('/directoryofofficers/{locale?}', [DirectoryOfOfficersController::class, 'get_directoryofofficers']);
Route::get('/powersfunctionsheading/{locale?}', [PowersFunctionsController::class, 'get_powersfunctionsheading']);
Route::get('/powersfunctionsall/{locale?}', [PowersFunctionsController::class, 'get_powersfunctionsall']);
Route::get('/contactlist/{locale?}', [ContactListController::class, 'get_contactlist']);
Route::get('/rules/{id?}/{locale?}', [RulesController::class, 'get_rules']);
Route::get('/thesindhtrans2016/{id?}/{locale?}', [thesindhtrans2016Controller::class, 'get_thesindhtrans2016']);
Route::get('/assemblylibrary/{locale?}', [AssemblyLibraryController::class, 'get_assemblylibrary']);
Route::get('/speakersmain/{locale?}', [SpeakersController::class, 'get_speakersmain']);
Route::get('/speakers/{id?}/{locale?}', [SpeakersController::class, 'get_speakers']);
Route::get('/speakersformer/{locale?}', [SpeakersController::class, 'get_speakersformer']);
Route::get('/deputyspeakermain/{locale?}', [DeputySpeakerController::class, 'get_deputyspeakermain']);
Route::get('/deputyspeaker/{id?}/{locale?}', [DeputySpeakerController::class, 'get_deputyspeaker']);
Route::get('/deputyspeakerformer/{locale?}', [DeputySpeakerController::class, 'get_deputyspeakerformer']);
Route::get('/listofmembers/{id?}/{locale?}', [ListofMembersController::class, 'get_listofmembers']);
Route::get('/pastassemblymembers/{id?}/{locale?}', [PastAssemblyMembersController::class, 'get_pastassemblymembers']);
Route::get('/pastassemblymembersbyTenure/{tenureid?}/{locale?}', [PastAssemblyMembersController::class, 'get_pastassemblymembersbyTenure']);
Route::get('/currentassemblysummary/{id?}/{locale?}', [CurrentAssemblySummaryController::class, 'get_currentassemblysummary']);
Route::get('/sessions/{id?}/{locale?}', [SessionsController::class, 'get_sessions']);
Route::get('/orderofthedayagenda/{page?}/{tenureid?}/{locale?}', [OrderOfTheDaySummaryOfProceedingsController::class, 'get_orderofthedayagenda']);


Route::get('/orderofthedayagendasessionsbased/{tenureid?}/{mainsession?}/{locale?}', [OrderOfTheDaySummaryOfProceedingsController::class, 'get_orderofthedayagendasessionsbased']);
// Route::get('/summaryofproceedingasessionsbased/{tenureid?}/{mainsession?}/{page?}/{locale?}', [OrderOfTheDaySummaryOfProceedingsController::class, 'get_summaryofproceedingasessionsbased']);
// Route::get('/housedebtssessionsbased/{tenureid?}/{mainsession?}/{page?}/{locale?}', [OrderOfTheDaySummaryOfProceedingsController::class, 'get_housedebtssessionsbased']);
Route::get('/resolutionpassedsessionsbased/{tenureid?}/{mainsession?}/{locale?}', [OrderOfTheDaySummaryOfProceedingsController::class, 'get_resolutionpassedsessionsbased']);
Route::get('/questionasessionsbased/{tenureid?}/{mainsession?}/{locale?}', [OrderOfTheDaySummaryOfProceedingsController::class, 'get_questionasessionsbased']);
Route::get('/sittingsbyidorderoftheday/{id?}/{locale?}', [OrderOfTheDaySummaryOfProceedingsController::class, 'get_sittingsbyidorderoftheday']);
Route::get('/sittingsbyidquestion/{id?}/{locale?}', [OrderOfTheDaySummaryOfProceedingsController::class, 'get_sittingsbyidquestion']);


Route::get('/orderofthedayagendabyid/{page?}/{id?}/{locale?}', [OrderOfTheDaySummaryOfProceedingsController::class, 'get_orderofthedayagendabyid']);
Route::get('/questions/{id?}/{locale?}', [QuestionsController::class, 'get_questions']);
Route::get('/callattention/{id?}/{locale?}', [CallAttentionController::class, 'get_callattention']);
Route::get('/resolutionspassed/{tenureid?}/{locale?}', [ResolutionsPassedController::class, 'get_resolutionspassed']);
Route::get('/resolutionspasseddetail/{id?}/{locale?}', [ResolutionsPassedController::class, 'get_resolutionspasseddetail']);
Route::get('/stagesofbills/{locale?}', [StagesOfBillsController::class, 'get_stagesofbills']);
Route::get('/bills/{tenure?}/{locale?}', [BillsController::class, 'get_bills']);
Route::get('/billsdetail/{id?}/{locale?}', [BillsController::class, 'get_billsdetail']);
Route::get('/acts/{tenure?}/{locale?}', [ActsController::class, 'get_acts']);
Route::get('/actdetail/{id?}/{locale?}', [ActsController::class, 'get_actdetail']);
Route::get('/getListOfAssembly/{locale?}', [MotionsController::class, 'get_getListOfAssembly']);
Route::get('/getListOfParliamentaryYears/{locale?}', [MotionsController::class, 'get_getListOfParliamentaryYears']);
Route::get('/getListOfOrderOfTheDaySummaryOfProceedings/{locale?}', [MotionsController::class, 'get_getListOfOrderOfTheDaySummaryOfProceedings']);
Route::get('/getListOfSessions/{locale?}', [MotionsController::class, 'get_getListOfSessions']);
Route::get('/motions/{tenureid?}/{locale?}', [MotionsController::class, 'get_motions']);
Route::get('/motionsdetail/{id?}/{locale?}', [MotionsController::class, 'get_motionsdetail']);
Route::get('/committeesystemdetail/{locale?}', [CommitteeSystemDetailController::class, 'get_committeesystemdetail']);
Route::get('/committeerules/{locale?}', [CommitteeRulesController::class, 'get_committeerules']);
Route::get('/publicaccountscommitteemembers/{page?}/{locale?}', [PublicAccountsCommitteeMemberController::class, 'get_publicaccountscommitteemembers']);
Route::get('/publicaccountscommittee/{page?}/{locale?}', [PublicAccountsCommitteeController::class, 'get_publicaccountscommittee']);
Route::get('/standingcommitteescategories/{locale?}', [StandingCommitteesController::class, 'get_standingcommitteescategories']);
Route::get('/standingcommittees/{category?}/{locale?}', [StandingCommitteesController::class, 'get_standingcommittees']);
Route::get('/standingcommitteesmembers/{category?}/{locale?}', [StandingCommitteesController::class, 'get_standingcommitteesmembers']);
Route::get('/getndingcommitteescategory_by_id/{id?}/{locale?}', [StandingCommitteesController::class, 'get_standingcommitteescategory_by_id']);
Route::get('/reportslaid/{tenureid?}/{locale?}', [ReportsLaidController::class, 'get_reportslaid']);
Route::get('/legislations/{tenureid?}/{locale?}', [LegislationsControlle::class, 'get_legislations']);
Route::get('/notifications/{pages?}/{locale?}', [NotificationsController::class, 'get_notifications']);
Route::get('/pressreleases/{pages?}/{locale?}', [PressReleasesController::class, 'get_pressreleases']);

Route::get('/speakerNews/{locale?}', [PressReleasesController::class, 'speakerNews']);
Route::get('/deputyspeakerNews/{pages?}/{locale?}', [PressReleasesController::class, 'deputyspeakerNews']);

Route::get('/picturegallery/{locale?}', [PictureGalleryController::class, 'get_picturegallery']);

Route::get('/picturegalleryspeaker/{locale?}', [PictureGalleryController::class, 'get_picturegallery_speaker']);
Route::get('/picturegallerydeputyspeaker/{locale?}', [PictureGalleryController::class, 'get_picturegallery_deputy_speaker']);


Route::get('/tenders/{pages?}/{locale?}', [TendersController::class, 'get_tenders']);
Route::get('/glossary/{locale?}', [GlossaryController::class, 'get_glossary']);
Route::get('/faqs/{locale?}', [FaqsController::class, 'get_faqs']);
Route::get('/webcastlivevideoaudio/{locale?}', [WebCastLiveVideoAudioController::class, 'get_webcastlivevideoaudio']);
Route::get('/webcastlivevideoaudiolast/{locale?}', [WebCastLiveVideoAudioController::class, 'get_webcastlivevideoaudiolast']);
Route::get('/videoarchive/{locale?}', [VideoArchiveController::class, 'get_videoarchive']);
Route::get('/videoarchiveLimit/{locale?}', [VideoArchiveController::class, 'get_videoarchiveLimit']);
Route::get('/publications_reports/{page?}/{tenureid?}/{title?}/{locale?}', [PublicationsController::class, 'get_publications_reports']);


Route::get('/memebersdirectory/{tenure?}/{locale?}', [MemebersDirectoryController::class, 'get_memebersdirectory']);
Route::get('/memebersdirectoryByAge/{tenure?}/{locale?}', [MemebersDirectoryController::class, 'get_memebersdirectoryByAge']);
Route::get('/memebersdirectoryBySeat/{tenure?}/{locale?}', [MemebersDirectoryController::class, 'get_memebersdirectoryBySeat']);
Route::get('/memebersdirectoryByBirth/{tenure?}/{locale?}', [MemebersDirectoryController::class, 'get_memebersdirectoryByBirth']);
Route::get('/memebersdirectoryByContact/{tenure?}/{locale?}', [MemebersDirectoryController::class, 'get_memebersdirectoryByContact']);
Route::get('/memebersdirectorysubjects/{tenure?}/{locale?}', [MemebersDirectoryController::class, 'get_memebersdirectorysubjects']);
Route::get('/memebersdirectoryParty/{tenure?}/{locale?}', [MemebersDirectoryController::class, 'get_memebersdirectoryParty']);
Route::get('/memebersdirectoryassemblies/{tenure?}/{locale?}', [MemebersDirectoryController::class, 'get_memebersdirectoryassemblies']);
Route::get('/memebersdirectorybyalpha/{tenure?}/{alpha?}/{locale?}', [MemebersDirectoryController::class, 'get_memebersdirectorybyalpha']);
Route::post('/advanceSearch/{locale?}', [MemebersDirectoryController::class, 'advanceSearch']);



Route::get('/memebersdirectoryByDestrict/{tenure?}/{locale?}', [MemebersDirectoryController::class, 'get_memebersdirectoryByDestrict']);
Route::get('/memebersdirectoryByParty/{tenure?}/{locale?}', [MemebersDirectoryController::class, 'get_memebersdirectoryByParty']);
Route::get('/parliamentarycalendar/{tenure?}/{locale?}', [ParliamentaryCalendarController::class, 'get_parliamentarycalendar']);
Route::get('/committeeongovernmentassurance/{locale?}', [CommitteeonGovernmentAssuranceController::class, 'get_committee_government_assurance']);
Route::get('/committeeongovernmentassurancebyassembly/{assembly?}/{locale?}', [CommitteeonGovernmentAssuranceController::class, 'get_committee_government_assurance_byassembly']);
Route::get('/committeeongovernmentassurancemembers/{assembly?}/{locale?}', [CommitteeonGovernmentAssuranceController::class, 'get_committee_government_assurance_members']);
Route::get('/committeeongovernmentassurancemembersSpeaker/{locale?}', [CommitteeonGovernmentAssuranceController::class, 'get_speakersmain']);
Route::get('/committeeongovernmentassurancemembersDeputySpeaker/{locale?}', [CommitteeonGovernmentAssuranceController::class, 'get_deputyspeakermain']);
Route::get('/membersperformancereport/{member?}/{locale?}', [MemeberPerformanceController::class, 'get_membersperformancereport']);
Route::get('/memberprofile/{member?}/{locale?}', [MemeberPerformanceController::class, 'get_memberprofile']);

// FOR HOME PAGE APIs
Route::get('/speakersmessages/{locale?}', [HomeApisController::class, 'get_speakersmessages']);
Route::get('/sessionsorderoftheday/{locale?}', [HomeApisController::class, 'get_sessionsorderoftheday']);
Route::get('/sessionssummery/{locale?}', [HomeApisController::class, 'get_sessionssummery']);
Route::get('/sessionshouse/{locale?}', [HomeApisController::class, 'get_sessionshouse']);
Route::get('/sessionsresolution/{locale?}', [HomeApisController::class, 'get_sessionsresolution']);
Route::get('/sessionsquestion/{locale?}', [HomeApisController::class, 'get_sessionsquestion']);
Route::get('/toppressreleases/{locale?}', [HomeApisController::class, 'get_pressrelease']);
Route::get('/topnewsandactivities/{locale?}', [HomeApisController::class, 'get_newsandactivities']);

Route::get('/notificationSessions/{locale?}', [HomeApisController::class, 'get_notificationSessions']);
Route::get('/notificationMembers/{locale?}', [HomeApisController::class, 'get_notificationMembers']);
Route::get('/notificationCommittees/{locale?}', [HomeApisController::class, 'get_notificationCommittees']);
Route::get('/notificationGeneral/{locale?}', [HomeApisController::class, 'get_notificationGeneral']);

Route::get('/sociallinks/{locale?}', [SocialLinkController::class, 'get_sociallink']);
Route::get('/contactus/{locale?}', [ContactusController::class, 'get_contactus']);
