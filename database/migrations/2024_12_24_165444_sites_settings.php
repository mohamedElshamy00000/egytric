<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('sites.site_name', '3x1');
        $this->migrator->add('sites.site_address', 'دمياط الجديدة');
        $this->migrator->add('sites.site_description', 'ايجي تريك');
        $this->migrator->add('sites.site_keywords', 'electric cars, السيارات الكهربائية');
        $this->migrator->add('sites.site_profile', '');
        $this->migrator->add('sites.site_logo', '');
        $this->migrator->add('sites.site_author', 'Mohamed hamed elshamy');
        $this->migrator->add('sites.site_email', 'info@egytric.com');
        $this->migrator->add('sites.site_phone', '+201207860084');
        $this->migrator->add('sites.site_social', []);
        $this->migrator->add('sites.site_video', 'https://creativegigstf.com/video/intro_3.mp4');

        $this->migrator->add('sites.site_aple_store', '');
        $this->migrator->add('sites.site_google_stroe', '');
        $this->migrator->add('sites.site_header_title', 'دليلك للسيارات الكهربائية في مصر');
        $this->migrator->add('sites.site_header_sub_title', 'مالك سيارة كهربائية أو بتفكر في التحول من البنزين للكهرباء؟ إيجيتريك هنا لمساعدتك.');
    }
};
