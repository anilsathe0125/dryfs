<?php

use App\Models\Role;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\Backend\FaqController;
use App\Http\Controllers\Backend\TaxController;
use App\Http\Controllers\Backend\TicketController;
use App\Http\Controllers\User\TicketController as UserTicketController;
use App\Http\Controllers\Backend\ItemController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\StaffController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Payment\PaytmController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\Backend\BackupController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SocialController;
use App\Http\Controllers\Auth\Backend\LoginController;
use App\Http\Controllers\Auth\User\LoginController as UserLoginController;
use App\Http\Controllers\Backend\AccountController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\SitemapController;
use App\Http\Controllers\Auth\Backend\ForgotController;
use App\Http\Controllers\Auth\User\ForgotController as UserForgotController;
use App\Http\Controllers\Backend\CampaignController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CurrencyController;
use App\Http\Controllers\Backend\HomePageController;
use App\Http\Controllers\Backend\LanguageController;
use App\Http\Controllers\Frontend\CatalogController;
use App\Http\Controllers\Frontend\CompareController;
use App\Http\Controllers\User\SocialLoginController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\Backend\BcategoryController;
use App\Http\Controllers\Backend\FcategoryController;
use App\Http\Controllers\Backend\PromoCodeController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Payment\AuthorizeController;
use App\Http\Controllers\Auth\User\RegisterController;
use App\Http\Controllers\Backend\BulkDeleteController;
use App\Http\Controllers\Backend\CsvProductController;
use App\Http\Controllers\Backend\SmsSettingController;
use App\Http\Controllers\Backend\SubscriberController;
use App\Http\Controllers\Backend\TranactionController;
use App\Http\Controllers\Payment\SslCommerzController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Payment\MercadopagoController;
use App\Http\Controllers\Backend\EmailSettingController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\PaymentSettingController;
use App\Http\Controllers\Frontend\HomeCustomizeController;
use App\Http\Controllers\Backend\AttributeOptionController;
use App\Http\Controllers\Backend\ShippingServiceController;
use App\Http\Controllers\User\AccountController as UserAccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function(){

    //------------ AUTH ------------
    Route::get('/login', [LoginController::class, 'showForm'])->name('backend.login');
    Route::post('/login-submit', [LoginController::class, 'login'])->name('backend.login.submit');
    Route::get('/logout', [LoginController::class, 'logout'])->name('backend.logout');

    //------------ FORGOT ------------
    Route::get('/forgot', [ForgotController::class, 'showForm'])->name('backend.forgot');
    Route::post('/forgot-submit', [ForgotController::class, 'forgot'])->name('backend.forgot.submit');
    Route::get('/change-password/{token}', [ForgotController::class, 'showChangePasswordForm'])->name('backend.change.password.token');
    Route::post('/change-password-submit', [ForgotController::class, 'changePassword'])->name('backend.change.password');

    //------------ DASHBOARD & PROFILE ------------
    Route::get('/', [AccountController::class, 'index'])->name('backend.dashboard');
    Route::get('/profile', [AccountController::class, 'profileForm'])->name('backend.profile');
    Route::post('/profile/update', [AccountController::class, 'updateProfile'])->name('backend.profile.update');
    Route::get('/password', [AccountController::class, 'passwordResetForm'])->name('backend.password');
    Route::post('/password/update', [AccountController::class, 'updatePassword'])->name('backend.password.update');

    // ------ Delete Bulk Data -------
    Route::get('/bulk/deletes', [BulkDeleteController::class, 'bulkDelete'])->name('backend.bulk.delete');

    // ------ Manage Categories Permissions -------
    Route::group(['middleware' =>'permissions:Manage Categories'], function(){

        //------------ CATEGORY ------------
        Route::get('category/status/{id}/{status}', [CategoryController::class, 'status'])->name('backend.category.status');
        Route::get('category/feature/{id}/{status}', [CategoryController::class, 'feature'])->name('backend.category.feature');
        Route::resource('category', CategoryController::class)->except(['show'])->names([
            'index' => 'backend.category.index',
            'create' => 'backend.category.create',
            'store' => 'backend.category.store',
            'edit' => 'backend.category.edit',
            'update' => 'backend.category.update',
        ]);
        Route::get('category/destroy/{id}', [CategoryController::class, 'destroy'])->name('backend.category.destroy');
    });

    // ------ Manage Orders Permissions -------
    Route::group(['middleware' => 'permissions:Manage Orders'], function(){
        //------------ ORDER ------------
        Route::get('/orders', [OrderController::class, 'index'])->name('backend.order.index');
        Route::get('/order/delete/{id}', [OrderController::class, 'delete'])->name('backend.order.delete');
        Route::get('/order/print/{id}', [OrderController::class, 'printOrder'])->name('backend.order.print');
        Route::get('/order/invoice/{id}', [OrderController::class, 'invoice'])->name('backend.order.invoice');
        Route::get('/order/status/{id}/{field}/{value}', [OrderController::class, 'status'])->name('backend.order.status');
    });

    // ------ Manage Products Permissions -------
    Route::get('/notifications', [NotificationController::class, 'notifications'])->name('backend.notifications');
    Route::get('/notifications/view', [NotificationController::class, 'viewNotification'])->name('backend.view.notification');
    Route::get('/notifications/delete/{id}', [NotificationController::class, 'deleteNotification'])->name('backend.notification.delete');
    Route::get('/notifications/clear', [NotificationController::class, 'clearNotifications'])->name('backend.notifications.clear');

    // ------ Manage Products Permissions -------
    Route::group(['middleware' => 'permissions:Manage Products'], function(){

        //------------ ITEM ------------
        Route::get('/item/add', [ItemController::class, 'add'])->name('backend.item.add');
        Route::get('item/status/{id}/{status}', [ItemController::class, 'status'])->name('backend.item.status');
        Route::resource('item', ItemController::class)->except(['getSubcategory'])->names([
            'index' => 'backend.item.index',
            'create' => 'backend.item.create',
            'store' => 'backend.item.store',
            'edit' => 'backend.item.edit',
            'update' => 'backend.item.update',
        ]);
        Route::get('/item/destroy/{id}', [ItemController::class, 'destroy'])->name('backend.item.destroy');

        //------------ ITEM HIGHLIGHT ------------
        Route::get('/item/highlight/{item}', [ItemController::class, 'highlight'])->name('backend.item.highlight');
        Route::post('/item/highlight/update/{item}', [ItemController::class, 'highlightUpdate'])->name('backend.item.highlight.update');

        //------------ ITEM GALLERY ------------
        Route::get('/item/galleries/{item}', [ItemController::class, 'galleries'])->name('backend.item.gallery');
        Route::post('/item/galleries/update/{item}', [ItemController::class, 'galleriesUpdate'])->name('backend.item.galleries.update');
        Route::get('/item/galleries/destory/{gallery_id}', [ItemController::class, 'galleryDelete'])->name('backend.item.gallery.delete');

        //------------ BULK PRODUCT UPLOAD ------------
        Route::get('/product/csv/export', [CsvProductController::class, 'export'])->name('backend.csv.export');
        Route::get('/bulk/product/index', [CsvProductController::class, 'index'])->name('backend.bulk.product.index');
        Route::post('/csv/import', [CsvProductController::class, 'import'])->name('backend.csv.import');
        Route::get('/transaction/csv/export', [CsvProductController::class, 'transactionExport'])->name('backend.csv.transaction.export');
        Route::get('/order/csv/export', [CsvProductController::class, 'orderExport'])->name('backend.csv.order.export');

        //------------ DIGITAL PRODUCT ------------
        Route::get('/digital/create', [ItemController::class, 'digitalItemCreate'])->name('backend.digital.item.create');
        Route::post('/digital/store', [ItemController::class, 'digitalItemStore'])->name('backend.digital.item.store');
        Route::get('/digital/edit/{id}', [ItemController::class, 'digitalItemEdit'])->name('backend.digital.item.edit');

        //------------ LICENSE PRODUCT ------------
        Route::get('/license/create', [ItemController::class, 'licenseItemCreate'])->name('backend.license.item.create');
        Route::post('/license/store', [ItemController::class, 'licenseItemStore'])->name('backend.license.item.store');
        Route::get('/license/edit/{id}', [ItemController::class, 'licenseItemEdit'])->name('backend.license.item.edit');

        //------------ CAMPAIGN OFFER ------------
        Route::get('campaign/status/{id}/{status}/{type}', [CampaignController::class, 'status'])->name('backend.campaign.status');
        Route::resource('campaign', CampaignController::class)->except(['show'])->names([
            'index' => 'backend.campaign.index',
            'create' => 'backend.campaign.create',
            'store' => 'backend.campaign.store',
            'edit' => 'backend.campaign.edit',
            'update' => 'backend.campaign.update',
        ]);
        Route::get('/campaign/{id}', [CampaignController::class, 'destroy'])->name('backend.campaign.destroy');

        Route::prefix('{item}')->group(function() {

            //------------ ATTRIBUTE ------------
            Route::resource('attribute', AttributeController::class)->except(['show'])->names([
                'index' => 'backend.attribute.index',
                'create' => 'backend.attribute.create',
                'store' => 'backend.attribute.store',
                'edit' => 'backend.attribute.edit',
                'update' => 'backend.attribute.update',
            ]);
            Route::get('/attribute/destroy/{id}', [AttributeController::class, 'destroy'])->name('backend.attribute.destroy');

            //------------ ATTRIBUTE OPTION ------------
            Route::resource('option', AttributeOptionController::class)->except(['show'])->names([
                'index' => 'backend.option.index',
                'create' => 'backend.option.create',
                'store' => 'backend.option.store',
                'edit' => 'backend.option.edit',
                'update' => 'backend.option.update',
            ]);
            Route::get('/option/destroy/{id}', [AttributeOptionController::class, 'destroy'])->name('backend.option.destroy');
        });

        //------------ BRAND ------------
        Route::get('brand/status/{id}/{status}/{type}', [BrandController::class, 'status'])->name('backend.brand.status');
        Route::resource('brand', BrandController::class)->except(['show'])->names([
            'index' => 'backend.brand.index',
            'create' => 'backend.brand.create',
            'store' => 'backend.brand.store',
            'edit' => 'backend.brand.edit',
            'update' => 'backend.brand.update',
        ]);
        Route::get('/brand/destroy/{id}', [BrandController::class, 'destroy'])->name('backend.brand.destroy');

        //------------ REVIEW ------------
        Route::get('review/status/{id}/{status}', [ReviewController::class, 'status'])->name('backend.review.status');
        Route::resource('review', ReviewController::class)->except(['create', 'store', 'edit', 'update'])->names([
            'index' => 'backend.review.index',
            'show' => 'backend.review.show',
        ]);
        Route::get('/review/destroy/{id}', [ReviewController::class, 'destroy'])->name('backend.review.destroy');

    });

    // ------ Manage Ecommerce Permissions -------
    Route::group(['middleware' => 'permissions:Ecommerce'], function(){

        //------------ PROMO CODE ------------
        Route::get('code/status/{id}/{status}', [PromoCodeController::class, 'status'])->name('backend.code.status');
        Route::resource('code', PromoCodeController::class)->except(['show'])->names([
            'index' => 'backend.code.index',
            'create' => 'backend.code.create',
            'store' => 'backend.code.store',
            'edit' => 'backend.code.edit',
            'update' => 'backend.code.update',
        ]);
        Route::get('/code/destroy/{id}', [PromoCodeController::class, 'destroy'])->name('backend.code.destroy');

        //------------ SHIPPING SERVICE ------------
        Route::get('shipping/status/{id}/{status}', [ShippingServiceController::class, 'status'])->name('backend.shipping.status');
        Route::resource('shipping', ShippingServiceController::class)->except(['show'])->names([
            'index' => 'backend.shipping.index',
            'create' => 'backend.shipping.create',
            'store' => 'backend.shipping.store',
            'edit' => 'backend.shipping.edit',
            'update' => 'backend.shipping.update',
        ]);
        Route::get('/shipping/destroy/{id}', [ShippingServiceController::class, 'destroy'])->name('backend.shipping.destroy');

        //------------ TAX SETTING ------------
        Route::get('tax/status/{id}/{status}', [TaxController::class, 'status'])->name('backend.tax.status');
        Route::resource('tax', TaxController::class)->except(['show'])->names([
            'index' => 'backend.tax.index',
            'create' => 'backend.tax.create',
            'store' => 'backend.tax.store',
            'edit' => 'backend.tax.edit',
            'update' => 'backend.tax.update',
        ]);
        Route::get('/tax/destroy/{id}', [TaxController::class, 'destroy'])->name('backend.tax.destroy');

        //------------ CURRENCY ------------
        Route::get('currency/status/{id}/{status}', [CurrencyController::class, 'status'])->name('backend.currency.status');
        Route::resource('currency', CurrencyController::class)->except(['show'])->names([
            'index' => 'backend.currency.index',
            'create' => 'backend.currency.create',
            'store' => 'backend.currency.store',
            'edit' => 'backend.currency.edit',
            'update' => 'backend.currency.update',
        ]);
        Route::get('/currency/destroy/{id}', [CurrencyController::class, 'destroy'])->name('backend.currency.destroy');

        //------------ PAYMENT SETTING ------------
        Route::get('/setting/payment', [PaymentSettingController::class, 'payment'])->name('backend.setting.payment');
        Route::post('/setting/payment/update', [PaymentSettingController::class, 'update'])->name('backend.setting.payment.update');
    });

    // ------ Manage Settings Manage -------
    Route::group(['middleware' => 'permissions:Manage Site'], function () {
        //------------ SETTING ------------
        Route::get('/setting/menu', [SettingController::class, 'menu'])->name('backend.setting.menu');
        Route::get('/setting/social', [SettingController::class, 'social'])->name('backend.setting.social');
        Route::get('/setting/system', [SettingController::class, 'system'])->name('backend.setting.system');
        Route::post('/setting/update', [SettingController::class, 'update'])->name('backend.setting.update');
        Route::post('/setting/update/visible', [SettingController::class, 'visible'])->name('backend.setting.visible.update');
        Route::get('/announcement', [SettingController::class, 'announcement'])->name('backend.setting.announcement');
        Route::get('/maintenance', [SettingController::class, 'maintenance'])->name('backend.setting.maintenance');

        //------------ Home Page Customization ------------
        Route::get('/homepage', [HomePageController::class, 'index'])->name('backend.homepage');
        Route::post('/homepage/first/banner/update', [HomePageController::class, 'firstBannerUpdate'])->name('backend.first.banner.update');
        Route::post('/homepage/second/banner/update', [HomePageController::class, 'secondBannerUpdate'])->name('backend.second.banner.update');
        Route::post('/homepage/third/banner/update', [HomePageController::class, 'thirdBannerUpdate'])->name('backend.third.banner.update');
        Route::post('/homepage/popular/category/update', [HomePageController::class, 'popularCategoryUpdate'])->name('backend.popular.category.update');
        Route::post('/homepage/two/column/category/update', [HomePageController::class, 'twoColumnCategoryUpdate'])->name('backend.two.column.category.update');
        Route::post('/homepage/feature/category/update', [HomePageController::class, 'featureCategoryUpdate'])->name('backend.feature.category.update');
        Route::post('/homepage4/banner/update', [HomePageController::class, 'homepage4BannerUpdate'])->name('backend.homepage4.banner.update');
        Route::post('/homepage4/category/update', [HomePageController::class, 'homepage4CategoryUpdate'])->name('backend.homepage4.category.update');

        //------------ Section ------------
        Route::get('/setting/section', [SettingController::class, 'section'])->name('backend.setting.section');

        //------------ Email Template ------------
        Route::get('/setting/email', [EmailSettingController::class, 'email'])->name('backend.setting.email');
        Route::post('/setting/email/update', [EmailSettingController::class, 'emailUpdate'])->name('backend.email.update');
        Route::get('/setting/template/{template}/edit', [EmailSettingController::class, 'edit'])->name('backend.template.edit');
        Route::put('/setting/template/update/{template}', [EmailSettingController::class, 'update'])->name('backend.template.update');

        //------------ SMS ------------
        Route::get('/setting/configuration/sms', [SmsSettingController::class, 'sms'])->name('backend.setting.sms');
        Route::post('/setting/sms/update', [SmsSettingController::class, 'smsUpdate'])->name('backend.sms.update');

        //------------ Slider ------------
        Route::resource('slider', SliderController::class)->except(['show'])->names([
            'index' => 'backend.slider.index',
            'create' => 'backend.slider.create',
            'store' => 'backend.slider.store',
            'edit' => 'backend.slider.edit',
            'update' => 'backend.slider.update',
        ]);
        Route::get('/slider/destroy/{id}', [SliderController::class, 'destroy'])->name('backend.slider.destroy');

        //------------ Service ------------
        Route::resource('service', ServiceController::class)->except(['show'])->names([
            'index' => 'backend.service.index',
            'create' => 'backend.service.create',
            'store' => 'backend.service.store',
            'edit' => 'backend.service.edit',
            'update' => 'backend.service.update',
        ]);
        Route::get('/service/destroy/{id}', [ServiceController::class, 'destroy'])->name('backend.service.destroy');

        //------------ Social ------------
        Route::resource('social', SocialController::class)->except(['show'])->names([
            'index' => 'backend.social.index',
            'create' => 'backend.social.create',
            'store' => 'backend.social.store',
            'edit' => 'backend.social.edit',
            'update' => 'backend.social.update',
        ]);
        Route::get('/social/destroy/{id}', [SocialController::class, 'destroy'])->name('backend.social.destroy');

        //------------ Generate Sitemap ------------
        Route::get('/sitemap', [SitemapController::class, 'index'])->name('backend.sitemap.index');
        Route::get('/sitemap/add', [SitemapController::class, 'add'])->name('backend.sitemap.add');
        Route::post('/sitemap/store', [SitemapController::class, 'store'])->name('backend.sitemap.store');
        Route::get('/sitemap/delete/{id}', [SitemapController::class, 'delete'])->name('backend.sitemap.delete');
        Route::post('/sitemap/download', [SitemapController::class, 'download'])->name('backend.sitemap.download');

        //------------ Language Setting ------------
        Route::resource('language', LanguageController::class)->except(['show'])->names([
            'index' => 'backend.language.index',
            'create' => 'backend.language.create',
            'store' => 'backend.language.store',
            'edit' => 'backend.language.edit',
            'update' => 'backend.language.update',
        ]);
        Route::get('/language/destroy/{id}', [LanguageController::class, 'destroy'])->name('backend.language.destroy');
        Route::get('/language/status/{id}/{status}', [LanguageController::class, 'status'])->name('backend.language.status');
    });

    //------------ Manage USER Permissions --------
    Route::group(['middleware' => 'permissions:Customer List'], function(){
        //------------ USER ------------
        Route::resource('user', UserController::class)->except(['create', 'store', 'edit'])->names([
            'index' => 'backend.user.index',
            'show' => 'backend.user.show',
            'update' => 'backend.user.update',
        ]);
        Route::get('user/destroy/{id}', [UserController::class, 'destroy'])->name('backend.user.destroy');
    });

    //------------ SYSTEM BACKUP ------------
    Route::get('/system/backup', [BackupController::class, 'systemBackup'])->name('backend.system.backup');
    Route::get('/database/backup', [BackupController::class, 'databaseBackup'])->name('backend.database.backup');

    //------------ Manage Tickets Permissions ------------
    Route::group(['middleware' => 'permissions:Manage Tickets'], function(){
        //------------ TICKET ------------
        Route::get('ticket/status/{id}', [TicketController::class, 'status'])->name('backend.ticket.status');
        Route::resource('ticket', TicketController::class)->except(['show'])->names([
            'index' => 'backend.ticket.index',
            'create' => 'backend.ticket.create',
            'store' => 'backend.ticket.store',
            'edit' => 'backend.ticket.edit',
            'update' => 'backend.ticket.update',
        ]);
        Route::get('ticket/destroy/{id}', [TicketController::class, 'destroy'])->name('backend.ticket.destroy');
    });

    //------------ Manage TRANSACTIONS   Permissions ------------
    Route::group(['middleware' => 'permissions:Transactions'], function(){
        //------------ TRANSACTIONS ------------
        Route::get('/transactions', [TranactionController::class, 'index'])->name('backend.transaction.index');
        Route::get('/transaction/delete/{id}', [TranactionController::class, 'delete'])->name('backend.transaction.delete');
    });

    //------------ Manage Faqs Permissions ------------
    Route::group(['middleware' => 'permissions:Manage Faqs Contents'], function () {
        //------------ FAQ CATEGORY ------------
        Route::get('faq-category/status/{id}/{status}', [FcategoryController::class, 'status'])->name('backend.fcategory.status');
        Route::resource('fcategory', FcategoryController::class)->except(['show'])->names([
            'index' => 'backend.fcategory.index',
            'create' => 'backend.fcategory.create',
            'store' => 'backend.fcategory.store',
            'edit' => 'backend.fcategory.edit',
            'update' => 'backend.fcategory.update',
        ]);
        Route::get('fcategory/destroy/{id}', [FcategoryController::class, 'destroy'])->name('backend.fcategory.destroy');

        //------------ FAQ ------------
        Route::resource('faq', FaqController::class)->except(['show'])->names([
            'index' => 'backend.faq.index',
            'create' => 'backend.faq.create',
            'store' => 'backend.faq.store',
            'edit' => 'backend.faq.edit',
            'update' => 'backend.faq.update',
        ]);
        Route::get('faq/destroy/{id}', [FaqController::class, 'destroy'])->name('backend.faq.destroy');
    });

    //------------ Manage Blogs Permissions ------------
    Route::group(['middleware' => 'permissions:Manage Blogs'], function () {
        //------------ Posts/Blogs CATEGORY ------------
        Route::get('bcategory/status/{id}/{status}', [BcategoryController::class, 'status'])->name('backend.bcategory.status');
        Route::resource('bcategory', BcategoryController::class)->except(['show'])->names([
            'index' => 'backend.bcategory.index',
            'create' => 'backend.bcategory.create',
            'store' => 'backend.bcategory.store',
            'edit' => 'backend.bcategory.edit',
            'update' => 'backend.bcategory.update',
        ]);
        Route::get('bcategory/destroy/{id}', [BcategoryController::class, 'destroy'])->name('backend.bcategory.destroy');

        //------------ Posts/Blogs ------------
        Route::resource('post', PostController::class)->except(['show'])->names([
            'index' => 'backend.post.index',
            'create' => 'backend.post.create',
            'store' => 'backend.post.store',
            'edit' => 'backend.post.edit',
            'update' => 'backend.post.update',
        ]);
        Route::get('post/destroy/{id}', [PostController::class, 'destroy'])->name('backend.post.destroy');
        Route::get('post/delete-photo/{key}/{id}', [PostController::class, 'deletePhoto'])->name('backend.post.delete.photo');
    });

    //------------ Manage Page Permissions ------------
    Route::group(['middleware' => 'permissions:Manage Pages'], function () {
        //------------ Pages ------------
        Route::get('page/pos/{id}/{pos}', [PageController::class, 'pos'])->name('backend.page.pos');
        Route::resource('page', PageController::class)->except(['show'])->names([
            'index' => 'backend.page.index',
            'create' => 'backend.page.create',
            'store' => 'backend.page.store',
            'edit' => 'backend.page.edit',
            'update' => 'backend.page.update',
        ]);
        Route::get('page/destroy/{id}', [PageController::class, 'destroy'])->name('backend.page.destroy');
    });

    //------------ Manage System User Permission ------------
    Route::group(['middleware' => 'permissions:Manage System User'], function () {
        //------------ Role ------------
        Route::resource('role', RoleController::class)->except(['show'])->names([
            'index' => 'backend.role.index',
            'create' => 'backend.role.create',
            'store' => 'backend.role.store',
            'edit' => 'backend.role.edit',
            'update' => 'backend.role.update',
        ]);
        Route::get('role/destroy/{id}', [RoleController::class, 'destroy'])->name('backend.role.destroy');

        //------------ Role ------------
        Route::resource('staff', StaffController::class)->except(['show'])->names([
            'index' => 'backend.staff.index',
            'create' => 'backend.staff.create',
            'store' => 'backend.staff.store',
            'edit' => 'backend.staff.edit',
            'update' => 'backend.staff.update',
        ]);
        Route::get('staff/destroy/{id}', [StaffController::class, 'destroy'])->name('backend.staff.destroy');
    });

    //------------ Manage System User Permission ------------
    Route::group(['middleware' => 'permissions:Subscriber List'], function () {
        //------------ Role ------------
        Route::get('/subscribers', [SubscriberController::class, 'index'])->name('backend.subscribers.index');
        Route::get('/subscribers/delete/{id}', [SubscriberController::class, 'delete'])->name('backend.subscribers.delete');
        Route::get('/subscribers/send-mail', [SubscriberController::class, 'sendMail'])->name('backend.subscribers.mail');
        Route::post('/subscribers/send-mail/submit', [SubscriberController::class, 'sendMailSubmit'])->name('backend.subscribers.mail.submit');
    });

}); // admin prefix ends here


// ************************************ ADMIN PANEL ENDS**********************************************

// ************************************ GLOBAL LOCALIZATION ******************************************

Route::group(['middleware' => 'maintainance'], function(){
    Route::group(['middleware' => 'localize'], function(){
        // ************************************ USER PANEL **********************************************
        Route::prefix('user')->group(function(){

            //------------ Auth ------------
            Route::get('/login', [UserLoginController::class, 'showForm'])->name('user.login');
            Route::post('/login-submit', [UserLoginController::class, 'login'])->name('user.login.submit');
            Route::get('/logout', [UserLoginController::class, 'logout'])->name('user.logout');

            //------------ Register ------------
            Route::get('/register', [RegisterController::class, 'showForm'])->name('user.register'); // not being used yet.
            Route::post('/register-submit', [RegisterController::class, 'register'])->name('user.register.submit');
            Route::get('/verify-link/{token}', [RegisterController::class, 'verify'])->name('user.account.verify');

            //------------ Forgot ------------
            Route::get('/forgot', [UserForgotController::class, 'showForm'])->name('user.forgot');
            Route::post('/forgot-submit', [UserForgotController::class, 'forgot'])->name('user.forgot.submit');
            Route::get('/change-password/{token}', [UserForgotController::class, 'showChangePasswordForm'])->name('user.change.password.token');
            Route::post('/change-password-submit', [UserForgotController::class, 'changePassword'])->name('user.change.password');

            //------------ DASHBOARD ------------
            Route::get('/dashboard', [UserAccountController::class, 'index'])->name('user.dashboard');
            Route::get('/profile', [UserAccountController::class, 'profile'])->name('user.profile');
            Route::post('/profile/update', [UserAccountController::class, 'profileUpdate'])->name('user.profile.update');

            //------------ Ticket ------------
            Route::get('/ticket', [UserTicketController::class, 'ticket'])->name('user.ticket');
            Route::get('/ticket/new', [UserTicketController::class, 'ticketNew'])->name('user.ticket.create');
            Route::post('/ticket/store', [UserTicketController::class, 'ticketStore'])->name('user.ticket.store');
            Route::get('/ticket/view/{id}', [UserTicketController::class, 'ticketView'])->name('user.ticket.view');
            Route::post('/ticket/reply/store', [UserTicketController::class, 'ticketReply'])->name('user.ticket.reply');
            Route::get('/ticket/delete/{id}', [UserTicketController::class, 'ticketDelete'])->name('user.ticket.delete');

            //------------ Setting ------------
            Route::get('/addresses', [UserAccountController::class, 'addresses'])->name('user.address');
            Route::post('/billing/addresses', [UserAccountController::class, 'billingSubmit'])->name('user.billing.submit');
            Route::post('/shipping/addresses', [UserAccountController::class, 'shippingSubmit'])->name('user.shipping.submit');

            //------------ Order ------------
            Route::get('/orders', [UserOrderController::class, 'index'])->name('user.order.index');
            Route::get('/order/print/{id}', [UserOrderController::class, 'printOrder'])->name('user.order.print');
            Route::get('/order/invoice/{id}', [UserOrderController::class, 'details'])->name('user.order.invoice');

        });

        //------------ Third Party Logins ------------=
        Route::get('auth/{provider}', [SocialLoginController::class, 'redirectToProvider'])->name('social.provider');
        Route::get('auth/{provider}/callback', [SocialLoginController::class, 'handleProviderCallback']);

        // ************************************ USER PANEL ENDS*******************************************

        // ************************************ FRONTEND **********************************************
        //------------ FRONT ------------
        Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
        Route::get('/extra-index', [FrontendController::class, 'extraIndex'])->name('frontend.extraindex');
        Route::get('/product/{slug}', [FrontendController::class, 'product'])->name('frontend.product');
        Route::get('/campaign/products', [FrontendController::class, 'campaignProducts'])->name('frontend.campaign');
        Route::get('/blog', [FrontendController::class, 'blog'])->name('frontend.blog');
        Route::get('/blog/{slug}', [FrontendController::class, 'blogDetails'])->name('frontend.blog.details');
        Route::get('/brands', [FrontendController::class, 'brands'])->name('frontend.brands');
        Route::get('/faq', [FrontendController::class, 'faq'])->name('frontend.faq');
        Route::get('/faq/{slug}', [FrontendController::class, 'faqDetails'])->name('frontend.faq.details');
        Route::get('/contact', [FrontendController::class, 'contact'])->name('frontend.contact');
        Route::post('/contact/submit', [FrontendController::class, 'contactEmail'])->name('frontend.contact.submit');
        Route::get('/reviews', [FrontendController::class, 'reviews'])->name('frontend.reviews');
        Route::get('/top-reviews', [FrontendController::class, 'topReviews'])->name('frontend.top.reviews');
        Route::post('/review/submit', [FrontendController::class, 'reviewSubmit'])->name('frontend.review.submit');
        Route::post('/subscriber/submit', [FrontendController::class, 'subscriberSubmit'])->name('frontend.subscriber.submit');
        Route::get('/subt/currency/{id}', [FrontendController::class, 'currency'])->name('frontend.currency.setup');

        // -------- Extra Index Route --------------
        Route::get('/popular/category/get/{slug}/{type}/{check}', [HomeCustomizeController::class, 'getCategory'])->name('frontend.popular.category');
        Route::get('/popular/get/type/{type}', [HomeCustomizeController::class, 'getProducts'])->name('frontend.get.product');

        //------------ Compare Product ------------
        Route::get('/compare/product/{id}', [CompareController::class, 'compare'])->name('frontend.compare.product');
        Route::get('/compare/remove/{id}', [CompareController::class, 'compareRemove'])->name('frontend.compare.remove');
        Route::get('/compare/products', [CompareController::class, 'compareProducts'])->name('frontend.compare.index');

        //------------ Cart ------------
        Route::get('/cart', [CartController::class, 'index'])->name('frontend.cart');
        Route::get('/front/cart/clear', [CartController::class, 'cartClear'])->name('frontend.cart.clear');
        Route::get('/header/cart/load', [CartController::class, 'headerCartLoad'])->name('frontend.header.cart');
        Route::get('/main/cart/load', [CartController::class, 'cartLoad'])->name('frontend.load.cart');
        Route::post('/cart/submit', [CartController::class, 'store'])->name('frontend.cart.submit');
        Route::get('/product/add/cart', [CartController::class, 'addToCart'])->name('frontend.add.to.cart');
        Route::get('/product/cart/update/{id}', [CartController::class, 'update'])->name('frontend.update.single');

        Route::post('/promo/submit', [CartController::class, 'promoStore'])->name('frontend.promo.submit');
        Route::get('/cart/destroy/{id}', [CartController::class, 'destroy'])->name('frontend.cart.destroy');
        Route::post('/shipping/submit', [CartController::class, 'shippingStore'])->name('frontend.shipping.submit');
        Route::post('/shipping/charge/get', [CartController::class, 'shippingCharge'])->name('frontend.shipping.charge');

        //------------ Catalog ------------
        Route::get('/catalog', [CatalogController::class, 'index'])->name('frontend.catalog');
        Route::get('/catalog/view/{type}', [CatalogController::class, 'viewType'])->name('frontend.catalog.view');

        //------------ Checkout ------------
        Route::get('/checkout/billing/address', [CheckoutController::class, 'shippingAddress'])->name('frontend.checkout.billing');
        Route::post('/checkout/billing/store', [CheckoutController::class, 'billingStore'])->name('frontend.checkout.store');
        Route::get('/checkout/shipping/address', [CheckoutController::class, 'shipping'])->name('frontend.checkout.shipping');
        Route::post('/checkout/shipping/store', [CheckoutController::class, 'shippingStore'])->name('frontend.checkout.shipping.store');
        Route::get('/checkout/review/payment', [CheckoutController::class, 'payment'])->name('frontend.checkout.payment');
        Route::post('/checkout-submit', [CheckoutController::class, 'checkout'])->name('frontend.checkout.submit');
        Route::get('/checkout/success', [CheckoutController::class, 'paymentSuccess'])->name('frontend.checkout.success');
        Route::get('/checkout/cancel', [CheckoutController::class, 'paymentCancel'])->name('frontend.checkout.cancel');

        //------------ Track Order ------------
        Route::get('/track/order', [FrontendController::class, 'trackOrder'])->name('frontend.track.order');
        Route::get('/track/order/submit', [FrontendController::class, 'track'])->name('frontend.track.order.submit');

        //------------ Clear Cache ------------
        Route::get('/cache/clear', function(){
            Artisan::call('cache:clear');
            Artisan::call('config:clear');
            Artisan::call('route:clear');
            Artisan::call('view:clear');
            return redirect()->route('backend.dashboard')->withSuccess(__('System Cache Has Been Removed.'));
        })->name('frontend.cache.clear');

        //------------ Pages ------------
        Route::get('/{slug}', [FrontendController::class, 'page'])->name('frontend.page');

        // ************************************ FRONTEND ENDS**********************************************


    });
    // ************************************ GLOBAL LOCALIZATION ENDS **************************************
});


Route::get('/website/maintainance', [FrontendController::class, 'maintenance'])->name('frontend.maintainance');
