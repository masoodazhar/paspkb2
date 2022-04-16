<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
           'super-admin-list',
           'super-admin-create',
           'super-admin-edit',
           'super-admin-delete',


           'role-list',
           'role-create',
           'role-edit',
           'role-delete',

           'assembly-list',
           'assembly-create',
           'assembly-edit',
           'assembly-delete',

           'assembly-tenure-list',
           'assembly-tenure-create',
           'assembly-tenure-edit',
           'assembly-tenure-delete',

           'parliamentory-year-list',
           'parliamentory-year-create',
           'parliamentory-year-edit',
           'parliamentory-year-delete',

           'social-links-list',
           'social-links-create',
           'social-links-edit',
           'social-links-delete',

           'about-list',
           'about-create',
           'about-edit',
           'about-delete',

           'messages-list',
           'messages-edit',

        //    2nd
            
        'working-of-assembly-list',
        'working-of-assembly-edit',

        'cabinetco-mposition-list',
        'cabinetco-mposition-create',
        'cabinetco-mposition-edit',
        'cabinetco-mposition-delete',

        'rules-of-procedures-list',
        'rules-of-procedures-edit',

        'parliamentary-privileges-list',
        'parliamentary-privileges-create',
        'parliamentary-privileges-edit',
        'parliamentary-privileges-delete',

        'overview-list',
        'overview-edit',

        'organizational-chart-list',
        'organizational-chart-edit',

        'directory-of-officers-list',
        'directory-of-officers-create',
        'directory-of-officers-edit',
        'directory-of-officers-delete',

        'powers-and-functions-list',
        'powers-and-functions-create',
        'powers-and-functions-edit',
        'powers-and-functions-delete',

        'contact-list-list',
        'contact-list-create',
        'contact-list-edit',
        'contact-list-delete',

        'rules-list',
        'rules-create',
        'rules-edit',
        'rules-delete',

        'the-sindh-trans2016-list',
        'the-sindh-trans2016-create',
        'the-sindh-trans2016-edit',
        'the-sindh-trans2016-delete',

        'assembly-library-list',
        'assembly-library-create',
        'assembly-library-edit',
        'assembly-library-delete',

        'speakers-list',
        'speakers-create',
        'speakers-edit',
        'speakers-delete',

        'deputy-speaker-list',
        'deputy-speaker-create',
        'deputy-speaker-edit',
        'deputy-speaker-delete',

        'list-of-members-list',
        'list-of-members-create',
        'list-of-members-edit',
        'list-of-members-delete',

        'members-directory-list',
        'members-directory-create',
        'members-directory-edit',
        'members-directory-delete',

        'members-performance-report-list',
        'members-performance-report-create',
        'members-performance-report-edit',
        'members-performance-report-delete',

        'past-assembly-members-list',
        'past-assembly-members-create',
        'past-assembly-members-edit',
        'past-assembly-members-delete',

        'current-assembly-summary-list',
        'current-assembly-summary-create',
        'current-assembly-summary-edit',
        'current-assembly-summary-delete',

        'main-sessions-list',
        'main-sessions-create',
        'main-sessions-edit',
        'main-sessions-delete',

        'sessions-list',
        'sessions-create',
        'sessions-edit',
        'sessions-delete',

        'order-of-the-day-summary-of-proceedings-list',
        'order-of-the-day-summary-of-proceedings-create',
        'order-of-the-day-summary-of-proceedings-edit',
        'order-of-the-day-summary-of-proceedings-delete',

        'questions-list',
        'questions-create',
        'questions-edit',
        'questions-delete',

        'resolutions-passed-list',
        'resolutions-passed-create',
        'resolutions-passed-edit',
        'resolutions-passed-delete',

        'call-attention-list',
        'call-attention-create',
        'call-attention-edit',
        'call-attention-delete',

        'stages-of-bills-list',
        'stages-of-bills-edit',

        'bills-list',
        'bills-create',
        'bills-edit',
        'bills-delete',

        'acts-list',
        'acts-create',
        'acts-edit',
        'acts-delete',

        'motions-list',
        'motions-create',
        'motions-edit',
        'motions-delete',

        'parliamentary-calendar-list',
        'parliamentary-calendar-create',
        'parliamentary-calendar-edit',
        'parliamentary-calendar-delete',

        'committee-system-detail-list',
        'committee-system-detail-create',
        'committee-system-detail-edit',
        'committee-system-detail-delete',

        'committee-rules-list',
        'committee-rules-create',
        'committee-rules-edit',
        'committee-rules-delete',

        'public-accounts-committee-list',
        'public-accounts-committee-create',
        'public-accounts-committee-edit',
        'public-accounts-committee-delete',

        'standing-committees-list',
        'standing-committees-create',
        'standing-committees-edit',
        'standing-committees-delete',

        'committee-on-government-assurance-list',
        'committee-on-government-assurance-create',
        'committee-on-government-assurance-edit',
        'committee-on-government-assurance-delete',

        'reports-laid-list',
        'reports-laid-create',
        'reports-laid-edit',
        'reports-laid-delete',

        'notifications-list',
        'notifications-create',
        'notifications-edit',
        'notifications-delete',

        'press-releases-list',
        'press-releases-create',
        'press-releases-edit',
        'press-releases-delete',

        'picture-gallery-list',
        'picture-gallery-create',
        'picture-gallery-edit',
        'picture-gallery-delete',

        'tenders-list',
        'tenders-create',
        'tenders-edit',
        'tenders-delete',

        'glossary-list',
        'glossary-edit',

        'faqs-list',
        'faqs-create',
        'faqs-edit',
        'faqs-delete',  

        'video-archive-list',
        'video-archive-create',
        'video-archive-edit',
        'video-archive-delete',

        'publications-list',
        'publications-create',
        'publications-edit',
        'publications-delete',

        
        ];
     
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}